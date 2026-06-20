<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);


$query = "select * from notes where id = ?";

$note = $db->query($query, [$_POST["id"]])->findOrFail();

authorize($note['userID']==$_SESSION['user']['id']);        

$query = "delete from notes where id = ?";

$db->query($query, [$_POST["id"]]);

header('location: /notes');

die();
