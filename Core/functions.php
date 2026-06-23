<?php


//use Core\Response;

function dd($value){
    echo "<pre>";

    var_dump($value);
    
    echo "</pre>";

    die();
}

function filterByType($items, $type) {
    return array_filter($items, function($item) use ($type) {
        return $item['type'] === $type;
    });
}

function urlIs($value){
    return $_SERVER['REQUEST_URI'] === $value;
}

function abort($code = 404){
    http_response_code($code);
    
    require basePath("Views/{$code}.php");

    die();
}

function authorize($condition, $status = 403){
    if(!$condition){
        abort($status);
    }
}

function basePath($path = ''){
    $base = rtrim(str_replace('\\', '/', BASE_PATH), '/') . '/';

    if ($path === '') {
        return $base;
    }

    return $base . ltrim(str_replace('\\', '/', $path), '/');
}

function view($path, $attributes = []){
    extract($attributes);

    require basePath('Views/' . ltrim(str_replace('\\', '/', $path), '/'));
}

function redirect($path){
    header("location: {$path}");
    exit();
}

function old($key, $default = ''){
    return Core\Session::get('old')[$key] ?? $default;
}

function requireAuth(){
    authorize(isset($_SESSION['user']));
}

function isAdmin(){
    return ($_SESSION['user']['role'] ?? '') === 'admin';
}

function requireAdmin(){
    authorize(isset($_SESSION['user']) && isAdmin());
}

function imageSrc($path){
    if (!$path) {
        return '/images/AAULogo.png';
    }

    $path = str_replace('\\', '/', $path);
    $base = rtrim(str_replace('\\', '/', BASE_PATH), '/');

    if (str_starts_with($path, $base)) {
        return '/' . ltrim(substr($path, strlen($base)), '/');
    }

    if (str_starts_with($path, '/')) {
        return $path;
    }

    return '/' . ltrim($path, '/');
}

function handleHeroImageUpload(array $file, ?string $currentPath = null): array
{
    if (($file['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
        if ($currentPath) {
            return ['path' => $currentPath, 'error' => null];
        }

        $default = basePath('images/AAULogo.png');
        return ['path' => realpath($default) ?: $default, 'error' => null];
    }

    if ($file['error'] !== UPLOAD_ERR_OK) {
        return ['path' => null, 'error' => 'Image upload failed. Please try again.'];
    }

    $allowed = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    $mime = mime_content_type($file['tmp_name']);

    if (!in_array($mime, $allowed, true)) {
        return ['path' => null, 'error' => 'Please upload a valid image (JPG, PNG, GIF, or WebP).'];
    }

    return saveUploadedFile($file, $mime, 'club_');
}

function handleEventMediaUpload(array $file, ?string $currentPath = null, ?string $currentType = null): array
{
    if (($file['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
        return [
            'path' => $currentPath,
            'type' => $currentType,
            'error' => null,
        ];
    }

    if ($file['error'] !== UPLOAD_ERR_OK) {
        return ['path' => null, 'type' => null, 'error' => 'Media upload failed. Please try again.'];
    }

    $mime = mime_content_type($file['tmp_name']);
    $imageMimes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    $videoMimes = ['video/mp4', 'video/webm', 'video/quicktime'];

    if (in_array($mime, $imageMimes, true)) {
        $upload = saveUploadedFile($file, $mime, 'event_img_');
        return [
            'path' => $upload['path'],
            'type' => $upload['error'] ? null : 'image',
            'error' => $upload['error'],
        ];
    }

    if (in_array($mime, $videoMimes, true)) {
        $upload = saveUploadedFile($file, $mime, 'event_vid_');
        return [
            'path' => $upload['path'],
            'type' => $upload['error'] ? null : 'video',
            'error' => $upload['error'],
        ];
    }

    return ['path' => null, 'type' => null, 'error' => 'Please upload a valid image or video file.'];
}

function saveUploadedFile(array $file, string $mime, string $prefix): array
{
    $uploadDir = basePath('images/uploads');

    if (!is_dir($uploadDir) && !mkdir($uploadDir, 0755, true)) {
        return ['path' => null, 'error' => 'Could not create upload directory.'];
    }

    $extension = match ($mime) {
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/gif' => 'gif',
        'image/webp' => 'webp',
        'video/mp4' => 'mp4',
        'video/webm' => 'webm',
        'video/quicktime' => 'mov',
        default => 'bin',
    };

    $filename = uniqid($prefix, true) . '.' . $extension;
    $destination = $uploadDir . '/' . $filename;

    if (!move_uploaded_file($file['tmp_name'], $destination)) {
        return ['path' => null, 'error' => 'Could not save uploaded file.'];
    }

    return ['path' => realpath($destination) ?: $destination, 'error' => null];
}

function slugify($text){
    $text = strtolower(trim($text));
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    return trim($text, '-');
}

function normalizeDatetime(string $value): string
{
    $value = str_replace('T', ' ', trim($value));

    if (strlen($value) === 16) {
        $value .= ':00';
    }

    return $value;
}
