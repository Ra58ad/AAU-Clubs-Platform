<?php
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$query = "select * from clubs";

$clubs = $db->query($query)->findAll();

view('registration/create.view.php', [
        'heading' => 'Register',
        'errors' => [],
        "clubs" => $clubs,
    ]);



