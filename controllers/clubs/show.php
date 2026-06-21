<?php
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$slug = $_GET['slug'] ?? 'art';

$query = "SELECT * FROM clubs WHERE slug = :slug";

$club = $db->query($query, ['slug' => $slug])->find();
if (!$club) { abort(); }

$query = "SELECT * FROM events WHERE club_id = :id AND is_highlight = 1";

$media = $db->query($query, ['id' => $club['id']])->findAll();



view('clubs/show.view.php', [
    'heading' => 'Notes',
    'club' => $club, 
    'media' => $media
]);
