<?php

require 'Core/Session.php';


$config = require 'config.php';
$db = new \Core\Database($config['database'], $config['username'], $config['password']);

// Fetch all clubs from the database
$clubs = $db->query("SELECT * FROM clubs")->findAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Clubs | AAU Clubs Platform</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Navbar -->
    <header class="site-header">
        <nav class="nav-container">
            <a href="index.php" class="brand">
                <img src="images/AAULogo.png" alt="AAU Logo" class="brand-logo">
                <span class="brand-title">AAU Clubs Platform</span>
            </a>
            <ul class="nav-menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="clubs.php" class="active">Clubs</a></li>
                <li><a href="key-dates.php">Key Dates</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="index.php#register" class="btn btn-primary" style="color:#000; padding:5px 10px;">Join</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="page-hero">
            <h1>Student Clubs Directory</h1>
            <p>Discover the community that fits your passion.</p>
        </section>

        <section class="section section-alt">
            <div class="container">
                <div class="clubs-grid">
                    <?php foreach ($clubs as $club): ?>
                        <article class="club-card">
                            <div class="club-card-image">
                                <img src="<?= $club['hero_image'] ?>" alt="<?= $club['name'] ?>">
                            </div>
                            <div class="club-card-body">
                                <h3><?= htmlspecialchars($club['name']) ?></h3>
                                <p><?= htmlspecialchars($club['description']) ?></p>
                                <!-- THIS LINK TELLS club.php WHICH CLUB TO SHOW -->
                                <a href="club.php?slug=<?= $club['slug'] ?>" class="btn btn-primary">View Club</a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </main>

    <footer class="site-footer">
        <p>&copy; 2024 Addis Ababa University Clubs Platform</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>
