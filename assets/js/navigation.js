/**
 * Accessible slide-in navigation drawer.
 *
 * Progressive enhancement: the navigation lives visibly in the footer
 * (#site-footer-nav) and is reachable without JS via the header anchor.
 * When JS runs, the header button clones that menu into an off-canvas
 * drawer with backdrop, focus trap, Escape handling and an animated
 * hamburger-to-close icon.
 */
(function () {
  var button = document.querySelector(".menu-button");
  var drawer = document.getElementById("menu-drawer");
  var backdrop = document.querySelector(".menu-backdrop");
  var source = document.querySelector("#site-footer-nav .mainnav");

  if (!button || !drawer || !backdrop || !source) {
    return;
  }

  // The footer navigation is the single source of truth — clone it.
  var clone = source.cloneNode(true);
  clone.removeAttribute("id");
  clone.setAttribute("aria-label", button.getAttribute("aria-label"));
  drawer.appendChild(clone);

  var lastFocus = null;

  function focusable() {
    return drawer.querySelectorAll("a[href], button:not([disabled])");
  }

  function isOpen() {
    return button.getAttribute("aria-expanded") === "true";
  }

  function finishClose() {
    if (!isOpen()) {
      drawer.hidden = true;
      backdrop.hidden = true;
    }
    drawer.removeEventListener("transitionend", finishClose);
  }

  function open() {
    lastFocus = document.activeElement;
    drawer.hidden = false;
    backdrop.hidden = false;
    // Force reflow so the transform transition actually runs.
    void drawer.offsetWidth;
    button.setAttribute("aria-expanded", "true");
    button.classList.add("is-active");
    drawer.classList.add("is-open");
    backdrop.classList.add("is-open");
    document.body.classList.add("menu-open");

    var f = focusable();
    if (f.length) {
      f[0].focus();
    }
  }

  function close(returnFocus) {
    button.setAttribute("aria-expanded", "false");
    button.classList.remove("is-active");
    drawer.classList.remove("is-open");
    backdrop.classList.remove("is-open");
    document.body.classList.remove("menu-open");

    drawer.addEventListener("transitionend", finishClose);
    // Fallback when transitions are disabled (reduced motion).
    window.setTimeout(finishClose, 400);

    if (returnFocus && lastFocus) {
      lastFocus.focus();
    }
  }

  button.addEventListener("click", function (event) {
    event.preventDefault();
    if (isOpen()) {
      close(true);
    } else {
      open();
    }
  });

  backdrop.addEventListener("click", function () {
    close(true);
  });

  document.addEventListener("keydown", function (event) {
    if (!isOpen()) {
      return;
    }

    if (event.key === "Escape") {
      close(true);
      return;
    }

    if (event.key === "Tab") {
      var f = focusable();
      if (!f.length) {
        return;
      }
      var first = f[0];
      var last = f[f.length - 1];

      if (event.shiftKey && document.activeElement === first) {
        event.preventDefault();
        last.focus();
      } else if (!event.shiftKey && document.activeElement === last) {
        event.preventDefault();
        first.focus();
      }
    }
  });
})();
