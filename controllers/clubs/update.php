<?php

use Core\App;
use Core\Database;
$db = App::resolve(Database::class);


$query = "select * from notes where id = ?";

$note = $db->query($query, [$_POST["id"]])->findOrFail();

authorize($note['userID']==$_SESSION['user']['id']);   

if(! \Core\Validator::string($_POST["name"], 1, 100)){
    $errors['name'] = 'A name of no more than 100 characters is required';
}

if(! \Core\Validator::string($_POST["body"], 1, 1000)){
    $errors['body'] = 'A body of no more than 1000 characters is required';
}

if(!empty($errors)){
    return view('notes/edit', [
        'heading' => 'Edit Note',
        'errors' => $errors
    ]);
}

$query = "update notes set name = ?, body = ? where id = ?";


$db->query($query, [
        $_POST["name"], 
        $_POST["body"],
        $_POST['id'],
]);

header("location: /note?id={$_POST["id"]}");
die();


