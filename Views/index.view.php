<?php
// 1. Include the necessary files for the session
// require 'Core/Session.php';
// require 'Core/functions.php';

// Get the user from the session (if logged in)
$user = \Core\Session::get('user');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>AAU Clubs Platform | Home</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header class="site-header">
    <nav class="nav-container">
      <a href="index.php" class="brand">
        <img src="images/AAULogo.png" alt="AAU" class="brand-logo">
        <span class="brand-title">AAU Clubs Platform</span>
      </a>
      <ul class="nav-menu">
        <li><a href="index.php">Home</a></li>
        <li><a href="clubs.php" class="active">Clubs</a></li>
        <li><a href="key-dates.php">Key Dates</a></li>
        <li><a href="contact.html">Contact</a></li>
        
        
        <?php if ($user): ?>
            <li><a href="admin.php">Admin Panel</a></li>
            <li><a href="php/logout.php">Logout (<?= htmlspecialchars($user['full_name']) ?>)</a></li>
        <?php else: ?>
          <li><a href="index.php#register" class="btn btn-primary" style="color:#000; padding:5px 10px;">Join</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </header>

  <main>
    <section class="hero">
      <div class="hero-content">
        <h1>Discover AAU Student Life</h1>
        <p>Connect with student clubs, attend events, and find your community.</p>
        <div class="hero-actions">
          <a href="/clubs" class="btn btn-primary">Explore Clubs</a>
          <a href="key-dates.php" class="btn btn-outline">View Key Dates</a>
        </div>
      </div>
    </section>

    <section id="clubs" class="section section-alt">
      <div class="container">
        <div class="section-header">
          <h2>Student Clubs</h2>
        </div>
        <div class="clubs-grid">
          
          <!-- LINK TO ART CLUB -->
          <article class="club-card">
            <div class="club-card-image"><img src="images/art3.jpg"></div>
            <div class="club-card-body">
              <h3>Art & Culture Club</h3>
              <p>Express creativity through painting and cultural showcases.</p>
              <a href="club.php?slug=art" class="btn btn-primary">View Club</a>
            </div>
          </article>

          <!-- LINK TO HACKATHON CLUB -->
          <article class="club-card">
            <div class="club-card-image"><img src="images/hack5.jpg"></div>
            <div class="club-card-body">
              <h3>Hackathon Club</h3>
              <p>Build software, compete, and learn programming.</p>
              <a href="club.php?slug=hackathon" class="btn btn-primary">View Club</a>
            </div>
          </article>

          <!-- LINK TO SPORTS CLUB -->
          <article class="club-card">
            <div class="club-card-image"><img src="images/sport.jpg"></div>
            <div class="club-card-body">
              <h3>Sports Club</h3>
              <p>Football, basketball, and athletics for all AAU students.</p>
              <a href="club.php?slug=sports" class="btn btn-primary">View Club</a>
            </div>
          </article>

          <!-- Add these to the clubs-grid in index.php -->
          <article class="club-card">
              <div class="club-card-image"><img src="images/red-cross.png"></div>
              <div class="club-card-body">
                  <h3>Red Cross Branch</h3>
                  <p>Humanitarian service and first aid training.</p>
                  <a href="club.php?slug=red-cross" class="btn btn-primary">View Club</a>
              </div>
          </article>

          <article class="club-card">
              <div class="club-card-image"><img src="images/literature.jpg"></div>
              <div class="club-card-body">
                  <h3>Literature Club</h3>
                  <p>Poetry nights and creative writing workshops.</p>
                  <a href="club.php?slug=literature" class="btn btn-primary">View Club</a>
              </div>
          </article>

          <article class="club-card">
              <div class="club-card-image"><img src="images/Debate.jpg"></div>
              <div class="club-card-body">
                  <h3>AAU Debate Club</h3>
                  <p>Critical thinking and public speaking excellence.</p>
                  <a href="club.php?slug=debate" class="btn btn-primary">View Club</a>
              </div>
          </article>

        </div>
      </div>
    </section>

    <!-- Registration Form Section (Rame's Section) -->
    <section id="register" class="section">
        <div class="container">
            <div class="section-header"><h2>Join a Club</h2></div>
            <?php if (isset($_GET['error']) && $_GET['error'] === 'email_taken') : ?>
    <p style="color: red; text-align: center; font-weight: bold;">
        This email is already registered. Please login or use a different email.
    </p>
<?php endif; ?>
            <form action="php/register.php" method="POST" class="form-card">
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
                    <input type="password" name="password" id="reg-password" required>
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

  <footer class="site-footer">
      <p>&copy; 2024 Addis Ababa University Clubs Platform</p>
  </footer>

  <script src="script.js"></script>
</body>
</html>
