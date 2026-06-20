<?php
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$query = "select * from notes where userID = ?";

$notes = $db->query($query, [$_SESSION['user']['id']])->findAll();

view('notes/index.view.php', [
    'heading' => 'My Notes',
    'notes' => $notes
]);
