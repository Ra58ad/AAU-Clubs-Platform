(function () {
  "use strict";

  /* Mobile navigation */
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

  /* Highlight current page in navbar */
  const currentPage =
    window.location.pathname.split("/").pop() || "index.html";
  document.querySelectorAll(".nav-menu a").forEach(function (link) {
    const href = link.getAttribute("href");
    if (href === currentPage || (currentPage === "" && href === "index.html")) {
      link.classList.add("active");
    } else {
      link.classList.remove("active");
    }
  });

  function isValidEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.trim());
  }

  function isValidName(name) {
    return name.trim().length >= 2;
  }

  function showFieldError(input, message) {
    const group = input.closest(".form-group");
    if (!group) return;
    const errorEl = group.querySelector(".error-message");
    input.classList.add("error");
    if (errorEl) {
      errorEl.textContent = message;
      errorEl.classList.add("visible");
    }
  }

  function clearFieldError(input) {
    const group = input.closest(".form-group");
    if (!group) return;
    const errorEl = group.querySelector(".error-message");
    input.classList.remove("error");
    if (errorEl) {
      errorEl.textContent = "";
      errorEl.classList.remove("visible");
    }
  }

  function clearFormErrors(form) {
    form.querySelectorAll("input, select, textarea").forEach(clearFieldError);
  }

  function showSuccess(form, messageEl) {
    if (messageEl) messageEl.classList.add("visible");
    form.reset();
    clearFormErrors(form);
  }

  function hideSuccess(messageEl) {
    if (messageEl) messageEl.classList.remove("visible");
  }

  /* Contact form */
  const contactForm = document.getElementById("contact-form");
  const contactSuccess = document.getElementById("contact-success");

  if (contactForm) {
    contactForm.addEventListener("submit", function (e) {
      e.preventDefault();
      hideSuccess(contactSuccess);
      clearFormErrors(contactForm);

      const nameInput = contactForm.querySelector("#contact-name");
      const emailInput = contactForm.querySelector("#contact-email");
      const messageInput = contactForm.querySelector("#contact-message");
      const subjectInput = contactForm.querySelector("#contact-subject");
      let valid = true;

      if (!isValidName(nameInput.value)) {
        showFieldError(nameInput, "Please enter your name.");
        valid = false;
      }

      if (!isValidEmail(emailInput.value)) {
        showFieldError(emailInput, "Please enter a valid email address.");
        valid = false;
      }

      if (subjectInput && !subjectInput.value.trim()) {
        showFieldError(subjectInput, "Please enter a subject.");
        valid = false;
      }

      if (messageInput.value.trim().length < 10) {
        showFieldError(messageInput, "Message must be at least 10 characters.");
        valid = false;
      }

      if (!valid) return;
      showSuccess(contactForm, contactSuccess);
    });

    contactForm.querySelectorAll("input, textarea").forEach(function (field) {
      field.addEventListener("input", function () {
        clearFieldError(field);
        hideSuccess(contactSuccess);
      });
    });
  }

  /* Registration form (home page) */
  const registerForm = document.getElementById("register-form");
  const registerSuccess = document.getElementById("register-success");

  if (registerForm) {
    registerForm.addEventListener("submit", function (e) {
      e.preventDefault();
      hideSuccess(registerSuccess);
      clearFormErrors(registerForm);

      const nameInput = registerForm.querySelector("#reg-name");
      const emailInput = registerForm.querySelector("#reg-email");
      const clubInput = registerForm.querySelector("#reg-club");
      let valid = true;

      if (!isValidName(nameInput.value)) {
        showFieldError(nameInput, "Please enter your full name (at least 2 characters).");
        valid = false;
      }

      if (!isValidEmail(emailInput.value)) {
        showFieldError(emailInput, "Please enter a valid email address.");
        valid = false;
      }

      if (!clubInput.value) {
        showFieldError(clubInput, "Please select a club.");
        valid = false;
      }

      if (!valid) return;
      showSuccess(registerForm, registerSuccess);
    });

    registerForm.querySelectorAll("input, select").forEach(function (field) {
      field.addEventListener("input", function () {
        clearFieldError(field);
        hideSuccess(registerSuccess);
      });
    });
  }
})();
