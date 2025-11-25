/**
 * Simple dropdown/megamenu handler
 * - Hover on desktop shows megamenu (CSS handles hover)
 * - On touch/devices we toggle `.open` class on click
 */
document.addEventListener('DOMContentLoaded', function () {
  const nav = document.querySelector('.topbar-nav');
  if (!nav) return;

  // Toggle on click for touch devices
  nav.addEventListener('click', function (e) {
    const li = e.target.closest('li.has-dropdown');
    if (!li) return;

    // If screen is small, toggle open class
    if (window.innerWidth <= 992) {
      e.preventDefault();
      li.classList.toggle('open');
      // close siblings
      [...li.parentElement.children].forEach(sib => {
        if (sib !== li) sib.classList.remove('open');
      });
    }
  });

  // Close megamenu when clicking outside
  document.addEventListener('click', function (e) {
    if (!e.target.closest('.topbar-nav')) {
      document.querySelectorAll('.topbar-nav li.has-dropdown.open').forEach(el => el.classList.remove('open'));
    }
  });
});
