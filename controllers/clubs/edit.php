<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
$id = $_GET["id"];

$note = $db->query("select * from notes where id = ?", [$id])->findOrFail();

authorize($note['userID']==$_SESSION['user']['id']);   

view('notes/edit.view.php', [
        'heading' => 'Edit Note',
        'errors' => [],
        'note' => $note,
    ]);

    

