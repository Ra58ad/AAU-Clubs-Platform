<?php
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
$id = $_GET["id"];

$query = "select * from notes where id = ?";

$note = $db->query($query, [$id])->findOrFail();

authorize($note['userID']==$_SESSION['user']['id']);        


view('notes/show.view.php', [
    'heading' => 'Notes',
    'note' => $note
]);
