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

      navToggle.setAttribute(
        "aria-expanded",
        navMenu.classList.contains("open")
      );
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
  const currentPage =
    window.location.pathname.split("/").pop() || "index.html";

  document.querySelectorAll(".nav-menu a").forEach(function (link) {
    const href = link.getAttribute("href");

    if (href === currentPage) {
      link.classList.add("active");
    } else {
      link.classList.remove("active");
    }
  });

  /* =========================
     VALIDATION HELPERS
  ========================= */
  function isValidEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.trim());
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
      e.preventDefault();

      const nameInput = document.getElementById("contact-name");
      const emailInput = document.getElementById("contact-email");
      const messageInput = document.getElementById("contact-message");

      let valid = true;
      clearErrors(contactForm);

      if (!isValidName(nameInput.value)) {
        showError(nameInput, "Enter name");
        valid = false;
      }

      if (!isValidEmail(emailInput.value)) {
        showError(emailInput, "Enter valid email");
        valid = false;
      }

      if (messageInput.value.trim().length < 10) {
        showError(messageInput, "Message too short");
        valid = false;
      }

      if (!valid) return;

      contactForm.submit(); // allow PHP submit
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
      const clubInput = document.getElementById("reg-club");

      let valid = true;

      clearErrors(registerForm);

      if (!isValidName(nameInput.value)) {
        showError(nameInput, "Enter full name");
        valid = false;
      }

      if (!isValidEmail(emailInput.value)) {
        showError(emailInput, "Enter valid email");
        valid = false;
      }

      if (!clubInput.value) {
        showError(clubInput, "Select a club");
        valid = false;
      }

      // STOP only if invalid
      if (!valid) {
        event.preventDefault();
      }
    });
  }

})();