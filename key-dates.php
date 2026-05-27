<?php
// 1. Core Integration & Session
require 'Core/Database.php';
require 'Core/Session.php';
require 'Core/functions.php';

session_start();

// 2. Database connection
$config = require 'config.php';
$db = new \Core\Database($config['database'], $config['username'], $config['password']);

// 3. Fetch all schedule items (is_highlight = 0 means schedule, not gallery)
$items = $db->query("SELECT * FROM events WHERE is_highlight = 0 ORDER BY event_date ASC")->findAll();

// Helper to filter items by type
function filterByType($items, $type) {
    return array_filter($items, function($item) use ($type) {
        return $item['type'] === $type;
    });
}

$upcomingEvents = filterByType($items, 'event');
$deadlines = filterByType($items, 'deadline');
$meetings = filterByType($items, 'meeting');

// Check user session for Nav logic
$user = \Core\Session::get('user');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Key Dates | AAU Clubs Platform</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- EMBEDDED NAVIGATION -->
  <header class="site-header">
    <nav class="nav-container" aria-label="Main navigation">
      <a href="index.php" class="brand">
        <img src="images/AAULogo.png" alt="Addis Ababa University" class="brand-logo">
        <span class="brand-title">AAU Clubs Platform</span>
      </a>
      <button class="nav-toggle" type="button" aria-label="Toggle menu" aria-expanded="false">
        <span></span><span></span><span></span>
      </button>
      <ul class="nav-menu">
        <li><a href="index.php">Home</a></li>
        <li><a href="clubs.php">Clubs</a></li>
        <li><a href="key-dates.php" class="active">Key Dates</a></li>
        <li><a href="contact.html">Contact</a></li>
        <li><a href="index.php#register" class="btn btn-primary" style="color:#000; padding:5px 10px;">Join</a></li>

      </ul>
    </nav>
  </header>

  <main>
    <!-- HERO SECTION -->
    <section class="page-hero">
      <div class="container">
        <h1>Key Dates & Deadlines</h1>
        <p>Stay up to date with upcoming events, registration deadlines, and weekly meeting schedules for all AAU clubs.</p>
      </div>
    </section>

    <!-- SECTION 1: UPCOMING EVENTS -->
    <section class="section">
      <div class="container">
        <div class="section-header">
          <span class="section-label">Mark Your Calendar</span>
          <h2>Major Events</h2>
        </div>
        
        <div class="dates-list">
          <?php if (empty($upcomingEvents)): ?>
            <p style="text-align:center; color: var(--text-muted);">No major events currently scheduled.</p>
          <?php else: ?>
            <?php foreach ($upcomingEvents as $e): 
                $date = new DateTime($e['event_date']); ?>
                <article class="date-item">
                  <div class="date-badge">
                    <span class="day"><?= $date->format('d') ?></span>
                    <span class="month"><?= $date->format('M') ?></span>
                  </div>
                  <div class="date-content">
                    <span class="date-tag event">Event</span>
                    <h3><?= htmlspecialchars($e['title']) ?></h3>
                    <p><?= htmlspecialchars($e['description']) ?></p>
                  </div>
                </article>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>
    </section>

    <!-- SECTION 2: REGISTRATION DEADLINES -->
    <section class="section section-alt">
      <div class="container">
        <div class="section-header">
          <span class="section-label">Don't Miss Out</span>
          <h2>Important Deadlines</h2>
        </div>
        
        <div class="dates-list">
          <?php if (empty($deadlines)): ?>
            <p style="text-align:center; color: var(--text-muted);">No active deadlines at the moment.</p>
          <?php else: ?>
            <?php foreach ($deadlines as $e): 
                $date = new DateTime($e['event_date']); ?>
                <article class="date-item">
                  <div class="date-badge">
                    <span class="day"><?= $date->format('d') ?></span>
                    <span class="month"><?= $date->format('M') ?></span>
                  </div>
                  <div class="date-content">
                    <span class="date-tag deadline">Deadline</span>
                    <h3><?= htmlspecialchars($e['title']) ?></h3>
                    <p><?= htmlspecialchars($e['description']) ?></p>
                  </div>
                </article>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>
    </section>

    <!-- SECTION 3: WEEKLY MEETINGS -->
    <section class="section">
      <div class="container">
        <div class="section-header">
          <span class="section-label">Weekly Schedule</span>
          <h2>Club Meetings</h2>
        </div>
        
        <div class="dates-list">
          <?php if (empty($meetings)): ?>
            <p style="text-align:center; color: var(--text-muted);">Check back later for updated meeting schedules.</p>
          <?php else: ?>
            <?php foreach ($meetings as $e): 
                $date = new DateTime($e['event_date']); ?>
                <article class="date-item">
                  <div class="date-badge" style="background: var(--gold); color: var(--navy-dark);">
                    <span class="day"><?= $date->format('D') ?></span>
                    <span class="month">Weekly</span>
                  </div>
                  <div class="date-content">
                    <span class="date-tag meeting">Meeting</span>
                    <h3><?= htmlspecialchars($e['title']) ?></h3>
                    <p><?= htmlspecialchars($e['description']) ?></p>
                  </div>
                </article>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
        
        <p style="text-align: center; margin-top: 3rem;">
          <a href="index.php#register" class="btn btn-primary">Register for Reminders</a>
        </p>
      </div>
    </section>
  </main>

  <!-- Shared Footer (You can embed this too if you don't use footer.php) -->
  <?php if (file_exists('includes/footer.php')) { include 'includes/footer.php'; } else { ?>
    <footer class="site-footer">
        <div class="container" style="text-align:center;">
            <p>&copy; <?= date('Y') ?> Addis Ababa University Clubs Platform</p>
            <p style="font-size:0.8rem; opacity:0.7;">Nahim | Rame | Sead | Sinen | Tsegaye</p>
        </div>
    </footer>
  <?php } ?>

  <script src="script.js"></script>
</body>
</html>