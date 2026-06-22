<?php

use Core\App;
use Core\Database;

requireAdmin();

$db = App::resolve(Database::class);
$clubs = $db->query('SELECT id, name FROM clubs ORDER BY name ASC')->findAll();

view('admin/events/form.view.php', [
    'heading' => 'Add Event',
    'event' => null,
    'clubs' => $clubs,
    'errors' => [],
]);
