<?php
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$query = "select * from clubs";

$clubs = $db->query($query)->findAll();

$name = $_SESSION['username']??"Guest";

view('index.view.php', [
    'heading' => 'AAU Clubs Platform',
    'clubs' => $clubs,
    'name' => $name,
]);
