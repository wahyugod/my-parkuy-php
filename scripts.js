document.addEventListener("DOMContentLoaded", function () {
  // Navbar toggle (keeps existing behavior without Bootstrap JS)
  const toggler = document.querySelector(".navbar-toggler");
  const menu = document.querySelector("#mainNav");
  if (toggler && menu) {
    toggler.addEventListener("click", function () {
      menu.classList.toggle("show");
    });
  }

  // Animate on Scroll using IntersectionObserver
  const aosElements = Array.from(document.querySelectorAll(".aos"));
  if ("IntersectionObserver" in window && aosElements.length) {
    const observer = new IntersectionObserver(
      (entries, obs) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add("aos-show");
            obs.unobserve(entry.target); // one-pass: do not hide again
          }
        });
        // If all elements have been shown, disconnect observer
        if (aosElements.every((el) => el.classList.contains("aos-show"))) {
          obs.disconnect();
        }
      },
      {
        root: null,
        rootMargin: "0px 0px -10% 0px", // show slightly before fully in view
        threshold: 0.1,
      }
    );

    aosElements.forEach((el) => observer.observe(el));
  } else {
    // Fallback: reveal instantly if IO not supported
    aosElements.forEach((el) => el.classList.add("aos-show"));
  }

  // Preloader fade out on window load
  window.addEventListener("load", function () {
    let preloader = document.getElementById("preloader");
    let mainContent = document.querySelector("main");
    let navbar = document.querySelector("nav");

    if (preloader) {
      if (mainContent) mainContent.style.display = "block";
      if (navbar) navbar.style.display = "flex";

      preloader.style.opacity = "0";

      setTimeout(function () {
        preloader.style.display = "none";
      }, 800);
    }
  });

  // Dark mode toggle with persistence
  const THEME_KEY = "theme-preference";
  const root = document.body;
  const btn = document.getElementById("theme-toggle");
  const setIcon = () => {
    if (!btn) return;
    const i = btn.querySelector("i");
    if (!i) return;
    // Toggle icon classes for basic feedback
    if (root.classList.contains("dark")) {
      i.classList.remove("bi-sun");
      i.classList.add("bi-moon-stars");
    } else {
      i.classList.remove("bi-moon-stars");
      i.classList.add("bi-sun");
    }
  };

  // Restore preference on load
  try {
    const saved = localStorage.getItem(THEME_KEY);
    if (saved === "dark") {
      root.classList.add("dark");
    } else if (saved === "light") {
      root.classList.remove("dark");
    }
  } catch (e) {
    // ignore storage errors (e.g., privacy mode)
  }
  setIcon();

  if (btn) {
    btn.addEventListener("click", () => {
      root.classList.toggle("dark");
      setIcon();
      try {
        localStorage.setItem(
          THEME_KEY,
          root.classList.contains("dark") ? "dark" : "light"
        );
      } catch (e) {
        // ignore storage errors
      }
    });
  }
  // scripts.js

  // Active Nav Link on Scroll (Versi Sliding Underline)
  const sections = document.querySelectorAll("main section[id]");
  const navLinks = document.querySelectorAll(
    ".navbar-nav .nav-link[href^='#']"
  );
  const magicLine = document.getElementById("magic-line");

  if (sections.length && navLinks.length && magicLine) {
    // Fungsi untuk menggerakkan magic line
    const moveMagicLine = (targetLink) => {
      if (targetLink) {
        magicLine.style.width = `${targetLink.offsetWidth}px`;
        magicLine.style.left = `${targetLink.offsetLeft}px`;
      }
    };

    // Posisikan magic line di link pertama saat halaman dimuat
    const firstActiveLink =
      document.querySelector(".navbar-nav .nav-link.active") || navLinks[0];
    if (firstActiveLink) {
      setTimeout(() => moveMagicLine(firstActiveLink), 100);
    }

    const observerOptions = {
      root: null,
      rootMargin: "-20% 0px -80% 0px",
      threshold: 0,
    };

    const sectionObserver = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          const targetId = `#${entry.target.id}`;
          const activeLink = document.querySelector(
            `.navbar-nav .nav-link[href='${targetId}']`
          );

          navLinks.forEach((link) => link.classList.remove("active"));
          if (activeLink) {
            activeLink.classList.add("active");
            moveMagicLine(activeLink); // Panggil fungsi untuk menggerakkan garis
          }
        }
      });
    }, observerOptions);

    sections.forEach((section) => sectionObserver.observe(section));

    // Perbarui posisi magic line jika ukuran window berubah
    window.addEventListener("resize", () => {
      const currentActiveLink = document.querySelector(
        ".navbar-nav .nav-link.active"
      );
      if (currentActiveLink) {
        moveMagicLine(currentActiveLink);
      }
    });
  }
});
