<?php

use Core\App;
use Core\Database;

requireAdmin();

$db = App::resolve(Database::class);
$errors = [];

$id = $_POST['id'] ?? null;

if (!$id) {
    abort();
}

$club = $db->query('SELECT * FROM clubs WHERE id = ?', [$id])->find();

if (!$club) {
    abort();
}

$name = trim($_POST['name'] ?? '');
$slug = trim($_POST['slug'] ?? '') ?: slugify($name);
$description = trim($_POST['description'] ?? '');
$aboutUs = trim($_POST['about_us'] ?? '');
$contactEmail = trim($_POST['contact_email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$currentHeroImage = $_POST['current_hero_image'] ?? $club['hero_image'];

if (!Core\Validator::string($name, 1, 100)) {
    $errors['name'] = 'Club name is required (max 100 characters).';
}

if (!Core\Validator::string($slug, 1, 50)) {
    $errors['slug'] = 'Slug is required (max 50 characters).';
} else {
    $slug = slugify($slug);
    $existing = $db->query('SELECT id FROM clubs WHERE slug = ? AND id != ?', [$slug, $id])->find();
    if ($existing) {
        $errors['slug'] = 'This slug is already in use.';
    }
}

if ($contactEmail && !Core\Validator::email($contactEmail)) {
    $errors['contact_email'] = 'Please provide a valid email address.';
}

$upload = handleHeroImageUpload($_FILES['hero_image'] ?? [], $currentHeroImage);
if ($upload['error']) {
    $errors['hero_image'] = $upload['error'];
}

if (!empty($errors)) {
    return view('admin/clubs/form.view.php', [
        'heading' => 'Edit Club',
        'club' => array_merge($club, $_POST, ['hero_image' => $currentHeroImage]),
        'errors' => $errors,
    ]);
}

$db->query(
    'UPDATE clubs SET name = ?, slug = ?, description = ?, about_us = ?, contact_email = ?, phone = ?, hero_image = ? WHERE id = ?',
    [$name, $slug, $description, $aboutUs, $contactEmail ?: null, $phone ?: null, $upload['path'], $id]
);

redirect('/admin/clubs');
