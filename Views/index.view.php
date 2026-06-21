
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>AAU Clubs Platform | Home</title>
  <link rel="stylesheet" href="style.css">
</head>
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
        <div class="clubs-grid">
          
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
      </div>
    </section>

    <section id="register" class="section">
        <div class="container">
            <div class="section-header"><h2>Join a Club</h2></div>
            <?php if (isset($_GET['error']) && $_GET['error'] === 'email_taken') : ?>
              <p style="color: red; text-align: center; font-weight: bold;">
                  This email is already registered. Please login or use a different email.
              </p>
            <?php endif; ?>
            <form action="register" method="POST" class="form-card">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="full_name" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div class="form-group">
                    <label>Select Club</label>
                    <select name="club" required>
                        <option value="art">Art & Culture Club</option>
                        <option value="hackathon">Hackathon Club</option>
                        <option value="sports">Sports Club</option>
                        <option value="red-cross">Red Cross AAU Branch</option>
                        <option value="literature">AAU Literature Club</option>
                        <option value="debate">AAU Debate Club</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit Registration</button>
            </form>
        </div>
    </section>
  </main>

  <?php  require basePath("Views/partials/footer.php") ?>
  <script src="script.js"></script>
</body>
</html>
