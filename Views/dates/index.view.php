

<?php  view("partials/head.php") ?>
<body>

  <?php view("partials/header.php") ?>

  <main>
    <section class="page-hero">
      <div class="container">
        <h1>Key Dates & Deadlines</h1>
        <p>Stay up to date with upcoming events, registration deadlines, and weekly meeting schedules for all AAU clubs.</p>
      </div>
    </section>

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
          <a href="/register" class="btn btn-primary">Register for Reminders</a>
        </p>
      </div>
    </section>
  </main>

  <?php view("partials/footer.php") ?>

  <script src="script.js"></script>
</body>
</html>


