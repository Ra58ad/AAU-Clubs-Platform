<?php
require 'Core/Database.php';
require 'Core/functions.php';
$config = require 'config.php';
$db = new \Core\Database($config['database'], $config['username'], $config['password']);

$slug = $_GET['slug'] ?? 'art';
$club = $db->query("SELECT * FROM clubs WHERE slug = :slug", ['slug' => $slug])->find();
if (!$club) { abort(); }

$media = $db->query("SELECT * FROM events WHERE club_id = :id AND is_highlight = 1", ['id' => $club['id']])->findAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><title><?= $club['name'] ?> | AAU</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="page-hero"><h1><?= $club['name'] ?></h1><p><?= $club['description'] ?></p></header>
    <main class="container">
        <section class="club-detail-grid" style="display:grid; grid-template-columns:1fr 1fr; gap:2rem; padding:2rem 0;">
            <img src="<?= $club['hero_image'] ?>" style="width:100%; border-radius:12px;">
            <div><h2>About Us</h2><p><?= nl2br($club['about_us']) ?></p></div>
        </section>
        <h2>Gallery & Highlights</h2>
        <div class="gallery-grid" style="display:grid; grid-template-columns:repeat(auto-fill, minmax(250px,1fr)); gap:1rem;">
            <?php foreach ($media as $item): ?>
                <div class="gallery-item">
                    <?php if ($item['media_type'] === 'image'): ?>
                        <img src="<?= $item['media_url'] ?>" style="width:100%; height:200px; object-fit:cover;">
                    <?php else: ?>
                        <video controls style="width:100%; height:200px;"><source src="<?= $item['media_url'] ?>"></video>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
    <script src="script.js"></script>
</body>
</html>