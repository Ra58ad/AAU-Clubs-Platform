<?php  view("partials/head.php") ?>
<body>
    <?php  view("partials/header.php") ?>

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
                                <img src="<?= imageSrc($club['hero_image']) ?>" alt="<?= htmlspecialchars($club['name']) ?>">
                            </div>
                            <div class="club-card-body">
                                <h3><?= htmlspecialchars($club['name']) ?></h3>
                                <p><?= htmlspecialchars($club['description']) ?></p>
                                <!-- THIS LINK TELLS club.php WHICH CLUB TO SHOW -->
                                <a href="/club?slug=<?= $club['slug'] ?>" class="btn btn-primary">View Club</a>
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
