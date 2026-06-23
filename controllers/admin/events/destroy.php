<?php

use Core\App;
use Core\Database;

requireAdmin();

$db = App::resolve(Database::class);
$id = $_POST['id'] ?? null;

if (!$id) {
    abort();
}

$event = $db->query('SELECT * FROM events WHERE id = ?', [$id])->find();

if (!$event) {
    abort();
}

$db->query('DELETE FROM events WHERE id = ?', [$id]);

redirect('/admin/events');
