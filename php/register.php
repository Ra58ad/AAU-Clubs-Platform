<?php
require '../Core/Database.php';
$config = require '../config.php';
$db = new \Core\Database($config['database'], $config['username'], $config['password']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // 1. Check if the email already exists
    $user = $db->query("SELECT * FROM users WHERE email = :email", [
        'email' => $email
    ])->find();

    if ($user) {
        // Redirect back with an error message in the URL
        header('Location: ../index.php?error=email_taken');
        exit();
    }

    // 2. Find the club details
    $club = $db->query("SELECT id, name FROM clubs WHERE slug = :slug", [
        'slug' => $_POST['club']
    ])->find();

    // 3. If email is unique, proceed with registration
    $db->query("INSERT INTO users (club_id, full_name, email, password, club, role) VALUES (?, ?, ?, ?, ?, ?)", [
        $club['id'],
        $_POST['full_name'],
        $email,
        password_hash($_POST['password'], PASSWORD_BCRYPT),
        $club['name'],
        'member'
    ]);

    header('Location: ../index.php?success=1');
    exit();
}