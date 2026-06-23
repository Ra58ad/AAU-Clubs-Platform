<?php

use Core\App;
use Core\Database;

requireAdmin();

$db = App::resolve(Database::class);
$id = $_POST['id'] ?? null;

if (!$id) {
    abort();
}

$club = $db->query('SELECT * FROM clubs WHERE id = ?', [$id])->find();

if (!$club) {
    abort();
}

$db->query('DELETE FROM clubs WHERE id = ?', [$id]);

redirect('/admin/clubs');
