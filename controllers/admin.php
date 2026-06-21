<?php
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$query = "SELECT * FROM users ORDER BY id DESC";

$users = $db->query($query)->findAll();


view('admin.view.php', [
    'heading' => 'AAU Clubs Platform',
    'users' => $users,
]);
