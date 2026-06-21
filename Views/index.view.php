
<?php  view("partials/head.php") ?>
<body>
<?php view("partials/header.php") ?>

  <main>
    <section class="hero">
      <div class="hero-content">
        <h1>Discover AAU Student Life</h1>
        <p>Connect with student clubs, attend events, and find your community.</p>
        <div class="hero-actions">
          <a href="/clubs" class="btn btn-primary">Explore Clubs</a>
          <a href="/key-dates" class="btn btn-outline">View Key Dates</a>
        </div>
      </div>
    </section>

    <section id="clubs" class="section section-alt">
      <div class="container">
        <div class="section-header">
          <h2>Student Clubs</h2>
        </div>
          
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
                                <a href="/club?slug=<?= $club['slug'] ?>" class="btn btn-primary">View Club</a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
          </section>

      </div>
    </section>

    
  </main>

  <?php  require basePath("Views/partials/footer.php") ?>
  <script src="script.js"></script>
</body>
</html>
