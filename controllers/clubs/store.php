<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
$errors = [];

if(! \Core\Validator::string($_POST["name"], 1, 100)){
    $errors['name'] = 'A name of no more than 100 characters is required';
}

if(! \Core\Validator::string($_POST["body"], 1, 1000)){
    $errors['body'] = 'A body of no more than 1000 characters is required';
}

if(!empty($errors)){
    return view('notes/create', [
        'heading' => 'Create a Note',
        'errors' => $errors
    ]);
}

$db->query('INSERT into notes(name, userID, body, date) VALUES(?, ?, ?, ?)', [
    $_POST["name"], 
    $_SESSION['user']['id'],
    $_POST["body"],
    date('Y-m-d'),
]);
    
header('location: /notes');
die();

