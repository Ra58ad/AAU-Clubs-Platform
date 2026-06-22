<?php

use Core\App;
use Core\Database;

requireAdmin();

$db = App::resolve(Database::class);
$id = $_GET['id'] ?? null;

if (!$id) {
    abort();
}

$club = $db->query('SELECT * FROM clubs WHERE id = ?', [$id])->find();

if (!$club) {
    abort();
}

view('admin/clubs/form.view.php', [
    'heading' => 'Edit Club',
    'club' => $club,
    'errors' => [],
]);
