<?php
// 1. Include the necessary files for the session
require basePath('Core/Session.php');
session_start();

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
        <h1>Sorry! Page not found!</h1>
        <div class="hero-actions">
          <a href="/" class="btn btn-primary">Go back to home</a>
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
