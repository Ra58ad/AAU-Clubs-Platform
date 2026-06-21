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
    
    require basePath("views/{$code}.php");

    die();
}

function authorize($condition, $status = 403){
    if(!$condition){
        abort($status);
    }
}

function basePath($path){
    return $path;
}

function view($path, $attributes = []){
    extract($attributes);

    require BASE_PATH . "Views\\" . $path;
}

function redirect($path){
    header("location: {$path}");
    exit();
}

function old($key, $default = ''){
    return Core\Session::get('old')[$key] ?? $default;
}
