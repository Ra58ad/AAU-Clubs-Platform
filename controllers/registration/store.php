<?php

use Core\App;
use Core\Database;
use Core\Authenticator;

$db = App::resolve(Database::class);
$errors = [];

if(! \Core\Validator::string($_POST["full_name"], 1, 100)){
    $errors['full_name'] = 'A full name of not more than 100 characters is required';
}

if(! \Core\Validator::string($_POST["username"], 1, 100)){
    $errors['username'] = 'A username of no more than 100 characters is required';
}
    
if(! \Core\Validator::email($_POST["email"])){
    $errors['email'] = 'Please provide a valid email address.';
}

if(! \Core\Validator::string($_POST["password"], 8, 255)){
    $errors['password'] = 'An password of no less than 8 and no more than 250 characters is required';
}


$user = $db->query('select * from users where username = ?', [$_POST['username']])->find();
if ($user){
    $errors['email'] = 'An account with this username or email already exists.';
}

$user = $db->query('select * from users where email = ?', [$_POST['email']])->find();
if ($user){
    $errors['email'] = 'An account with this username or email already exists.';
}

if(!empty($errors)){
    return view('registration/create.view.php', [
        'heading' => 'Sign Up',
        'errors' => $errors
    ]);
}

$club = $db->query("SELECT id FROM clubs WHERE name = :name", [
    'name' => $_POST['club']
])->find();

$db->query('INSERT into users(club_id, full_name, username, email, password, club, role) VALUES(?, ?, ?, ?, ?, ?, ?)', [
    $club['id'],
    $_POST['full_name'],
    $_POST["username"], 
    $_POST['email'],
    password_hash($_POST["password"], PASSWORD_BCRYPT),
    $_POST['club'],
    'admin'
]);

$user = $db->query('select * from users where username = ?', [
    $_POST["username"],
])->find();

(new Authenticator())->login([
    'username' => $_POST['username'],
    'id' => $user['id'],
    'role' => 'admin',
]);

header('location: /');
exit();
