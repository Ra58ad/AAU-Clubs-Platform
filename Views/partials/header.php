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
