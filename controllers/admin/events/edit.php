<?php

use Core\App;
use Core\Database;

requireAdmin();

$db = App::resolve(Database::class);
$id = $_GET['id'] ?? null;

if (!$id) {
    abort();
}

$event = $db->query('SELECT * FROM events WHERE id = ?', [$id])->find();

if (!$event) {
    abort();
}

$clubs = $db->query('SELECT id, name FROM clubs ORDER BY name ASC')->findAll();

view('admin/events/form.view.php', [
    'heading' => 'Edit Event',
    'event' => $event,
    'clubs' => $clubs,
    'errors' => [],
]);
