<?php  view("partials/head.php") ?>
<body>
<?php  view("partials/header.php") ?>

  <main>
    <section class="page-hero">
      <h1>Contact Us</h1>
      <p>Reach out to the AAU Clubs Platform team or get in touch with individual clubs.</p>
    </section>

    <section class="section">
      <div class="container contact-grid">
        <div class="contact-info-card">
          <h3>Platform Contact</h3>
          <div class="contact-item">
            <span class="contact-icon" aria-hidden="true">@</span>
            <div>
              <strong>Email</strong>
              <a href="mailto:clubs@aau.edu.et">clubs@aau.edu.et</a>
            </div>
          </div>
          <div class="contact-item">
            <span class="contact-icon" aria-hidden="true">☎</span>
            <div>
              <strong>Phone</strong>
              <span>+251 11 123 4567</span>
            </div>
          </div>
          <div class="contact-item">
            <span class="contact-icon" aria-hidden="true">📍</span>
            <div>
              <strong>Office</strong>
              <span>Student Affairs Building, Room 204<br>Addis Ababa University, Main Campus</span>
            </div>
          </div>
          <div class="contact-item">
            <span class="contact-icon" aria-hidden="true">🕐</span>
            <div>
              <strong>Office Hours</strong>
              <span>Monday – Friday, 9:00 AM – 5:00 PM</span>
            </div>
          </div>
          <h3 style="margin-top: 1.5rem; color: var(--navy); font-size: 1rem;">Social Media</h3>
          <div class="social-links">
            <a href="#" class="social-link" aria-label="Facebook">FB</a>
            <a href="#" class="social-link" aria-label="Twitter">TW</a>
            <a href="#" class="social-link" aria-label="Instagram">IG</a>
            <a href="#" class="social-link" aria-label="Telegram">TG</a>
          </div>

          <h3 class="club-contacts-heading">Club Contacts</h3>
          <ul class="club-contacts-list">
            <li><strong>Hackathon Club</strong> — <a href="mailto:hackathon@aau.edu.et">hackathon@aau.edu.et</a></li>
            <li><strong>Art &amp; Culture Club</strong> — <a href="mailto:art@aau.edu.et">art@aau.edu.et</a></li>
            <li><strong>Sports Club</strong> — <a href="mailto:sports@aau.edu.et">sports@aau.edu.et</a></li>
            <li><strong>Red-cross AAU Branch</strong> — <a href="mailto:red-cross-AAU-Branch@aau.edu.et">sports@aau.edu.et</a></li>
            <li><strong>AAU Literature Club</strong> — <a href="mailto:AAU-Literature@aau.edu.et">sports@aau.edu.et</a></li>
            <li><strong>AAU Debate Club Club</strong> — <a href="mailto:AAU-Debate-Club@aau.edu.et">sports@aau.edu.et</a></li>

          </ul>
        </div>

        <form id="contact-form" class="form-card" novalidate>
          <h3 style="color: var(--navy); margin-bottom: 1.25rem;">Send a Message</h3>
          <div class="form-group">
            <label for="contact-name">Your Name</label>
            <input type="text" id="contact-name" name="name" placeholder="Full name" autocomplete="name">
            <span class="error-message" role="alert"></span>
          </div>
          <div class="form-group">
            <label for="contact-email">Email</label>
            <input type="email" id="contact-email" name="email" placeholder="you@aau.edu.et" autocomplete="email">
            <span class="error-message" role="alert"></span>
          </div>
          <div class="form-group">
            <label for="contact-subject">Subject</label>
            <input type="text" id="contact-subject" name="subject" placeholder="How can we help?">
            <span class="error-message" role="alert"></span>
          </div>
          <div class="form-group">
            <label for="contact-message">Message</label>
            <textarea id="contact-message" name="message" rows="5" placeholder="Write your message here..."></textarea>
            <span class="error-message" role="alert"></span>
          </div>
          <button type="submit" class="btn btn-primary">Send Message</button>
          <p id="contact-success" class="success-message" role="status">
            Your message has been sent successfully. We will get back to you soon.
          </p>
        </form>
      </div>
    </section>
  </main>

<?php  view("partials/footer.php") ?>

  <script src="script.js"></script>
</body>
</html>
