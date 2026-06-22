<?php

use Core\App;
use Core\Database;

requireAdmin();

$db = App::resolve(Database::class);

$clubs = $db->query("SELECT * FROM clubs ORDER BY id DESC")->findAll();

view('admin/clubs/index.view.php', [
    'heading' => 'Manage Clubs',
    'clubs' => $clubs,
]);
