<?php
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$query = "select * from clubs";

$clubs = $db->query($query)->findAll();

view('clubs/index.view.php', [
    'clubs' => $clubs
]);
