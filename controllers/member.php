<?php
use Core\App;
use Core\Database;

if (!isset($_SESSION['user'])) {
    header('Location: /login');
    exit();
}

$db = App::resolve(Database::class);

$loggedInUser = $_SESSION['user'];
$isAdmin = isset($loggedInUser['role']) && $loggedInUser['role'] === 'admin';

if ($isAdmin) {
    $members = $db->query("SELECT * FROM users ORDER BY created_at DESC")->findAll();
} else {
    $me = $db->query("SELECT * FROM users WHERE id = ?", [$loggedInUser['id']])->find();
    $members = $db->query(
        "SELECT * FROM users WHERE club_id = ?",
        [$me['club_id']]
    )->findAll();
}

view('member.view.php', [
    'members' => $members,
    'isAdmin' => $isAdmin,
]);
