(function () {
  "use strict";

  /* =========================
     MOBILE NAVIGATION
  ========================= */
  const navToggle = document.querySelector(".nav-toggle");
  const navMenu = document.querySelector(".nav-menu");

  if (navToggle && navMenu) {
    navToggle.addEventListener("click", function () {
      navMenu.classList.toggle("open");
      navToggle.setAttribute("aria-expanded", navMenu.classList.contains("open"));
    });

    navMenu.querySelectorAll("a").forEach(function (link) {
      link.addEventListener("click", function () {
        navMenu.classList.remove("open");
        navToggle.setAttribute("aria-expanded", "false");
      });
    });
  }

  /* =========================
     ACTIVE NAV LINK
  ========================= */
  const path = window.location.pathname.split("/").pop();
  const currentPage = path === "" ? "index.php" : path;

  document.querySelectorAll(".nav-menu a").forEach(function (link) {
    const href = link.getAttribute("href");
    if (href === currentPage || (currentPage === "index.php" && href === "index.html")) {
      link.classList.add("active");
    } else {
      link.classList.remove("active");
    }
  });

  /* =========================
     VALIDATION HELPERS
  ========================= */
  
  // Email validation: no spaces allowed, exactly one @ symbol
  function isValidEmail(email) {
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailPattern.test(email.trim());
  }

  // Strong Password: Min 12 chars, at least one Uppercase, one Lowercase, one Digit, and one Special Char
  function isStrongPassword(pass) {
    var passPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{12,}$/;
    return passPattern.test(pass);
  }

  function isValidName(name) {
    return name.trim().length >= 2;
  }

  function showError(input, message) {
    const group = input.closest(".form-group");
    if (!group) return;
    const errorEl = group.querySelector(".error-message");
    if (!errorEl) return;

    input.classList.add("error");
    errorEl.textContent = message;
    errorEl.classList.add("visible");
  }

  function clearErrors(form) {
    form.querySelectorAll(".error-message").forEach(function (el) {
      el.textContent = "";
      el.classList.remove("visible");
    });
    form.querySelectorAll("input, select, textarea").forEach(function (el) {
      el.classList.remove("error");
    });
  }

  /* =========================
     CONTACT FORM
  ========================= */
  const contactForm = document.getElementById("contact-form");
  if (contactForm) {
    contactForm.addEventListener("submit", function (e) {
      const nameInput = document.getElementById("contact-name");
      const emailInput = document.getElementById("contact-email");
      const messageInput = document.getElementById("contact-message");

      let valid = true;
      clearErrors(contactForm);

      if (!isValidName(nameInput.value)) {
        showError(nameInput, "Enter a valid name (min. 2 chars)");
        valid = false;
      }
      if (!isValidEmail(emailInput.value)) {
        showError(emailInput, "Invalid Email: No spaces allowed and must contain exactly one @ symbol.");
        valid = false;
      }
      if (messageInput.value.trim().length < 10) {
        showError(messageInput, "Message must be at least 10 characters.");
        valid = false;
      }

      if (!valid) e.preventDefault();
    });
  }

  /* =========================
     REGISTRATION FORM
  ========================= */
  const registerForm = document.getElementById("register-form");
  if (registerForm) {
    registerForm.addEventListener("submit", function (event) {
      const nameInput = document.getElementById("reg-name");
      const emailInput = document.getElementById("reg-email");
      const passwordInput = document.getElementById("password");
      const clubInput = document.getElementById("reg-club");

      let valid = true;
      clearErrors(registerForm);

      // Validate Name
      if (!isValidName(nameInput.value)) {
        showError(nameInput, "Enter full name (min. 2 chars)");
        valid = false;
      }

      // Validate Email with your specific logic
      if (!isValidEmail(emailInput.value)) {
        showError(emailInput, "Invalid Email: No spaces allowed and must contain exactly one @ symbol.");
        valid = false;
      }

      // Validate Password with your specific Strong Password logic
      if (!isStrongPassword(passwordInput.value)) {
        showError(passwordInput, "Password too weak! Must be at least 12 characters and include uppercase, lowercase, a digit, and a special character.");
        valid = false;
      }

      // Validate Club Selection
      if (!clubInput.value) {
        showError(clubInput, "Please select a club to join.");
        valid = false;
      }

      if (!valid) {
        event.preventDefault(); // Stops form submission
      }
    });
  }

})();
