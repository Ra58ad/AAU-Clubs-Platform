
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><title><?= $club['name'] ?> | AAU</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php view("partials/header.php") ?>
    <section class="page-hero"><h1><?= $club['name'] ?></h1><p><?= $club['description'] ?></p></section>
    <main class="container">
        <section class="club-detail-grid" style="display:grid; grid-template-columns:1fr 1fr; gap:2rem; padding:2rem 0;">
            <img src="<?= imageSrc($club['hero_image']) ?>" style="width:100%; border-radius:12px;">
            <div><h2>About Us</h2><p><?= nl2br($club['about_us']) ?></p></div>
        </section>
        <h2>Gallery & Highlights</h2>
        <div class="gallery-grid" style="display:grid; grid-template-columns:repeat(auto-fill, minmax(250px,1fr)); gap:1rem;">
            <?php foreach ($media as $item): ?>
                <div class="gallery-item">
                    <?php if ($item['media_type'] === 'image'): ?>
                        <img src="<?= imageSrc($item['media_url']) ?>" style="width:100%; height:200px; object-fit:cover;">
                    <?php else: ?>
                        <video controls style="width:100%; height:200px;"><source src="<?= imageSrc($item['media_url']) ?>"></video>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
    <script src="script.js"></script>
</body>
</html>
