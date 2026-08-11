/**
 * CLF Theme — Main JavaScript (Bold Conviction)
 * Scroll reveals, mobile nav, apply form steps, give page interactions.
 */

document.addEventListener('DOMContentLoaded', function () {

  /* ---- Scroll reveal ---- */
  var revealEls = document.querySelectorAll('.clf-reveal');
  if ('IntersectionObserver' in window && revealEls.length) {
    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) {
        if (e.isIntersecting) e.target.classList.add('is-visible');
      });
    }, { threshold: 0.12 });
    revealEls.forEach(function (el) { observer.observe(el); });
  } else {
    revealEls.forEach(function (el) { el.classList.add('is-visible'); });
  }

  /* ---- Mobile nav toggle ---- */
  var toggle = document.getElementById('clfMenuToggle');
  var links  = document.getElementById('clfNavLinks');
  if (toggle && links) {
    toggle.addEventListener('click', function () {
      var open = links.classList.toggle('open');
      toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
    document.addEventListener('click', function (e) {
      if (!toggle.contains(e.target) && !links.contains(e.target)) {
        links.classList.remove('open');
        toggle.setAttribute('aria-expanded', 'false');
      }
    });
  }

  /* ---- Apply form: multi-step navigation (global for onclick=) ---- */
  window._clfCurrent = 1;
  var TOTAL_STEPS = 5;

  window.clfGoTo = function (n) {
    var prev = document.getElementById('step' + window._clfCurrent);
    if (prev) prev.classList.remove('active');

    var items = document.querySelectorAll('.step-item');
    if (items.length) {
      items.forEach(function (item, i) {
        item.classList.remove('active', 'done');
        if (i < n - 1) item.classList.add('done');
      });
      if (items[n - 1]) items[n - 1].classList.add('active');
    }

    window._clfCurrent = n;
    var next = document.getElementById('step' + n);
    if (next) next.classList.add('active');

    var fill = document.getElementById('progressFill');
    if (fill) fill.style.width = (n / TOTAL_STEPS * 100) + '%';

    window.scrollTo({ top: 0, behavior: 'smooth' });
  };

  window.clfToggle = function (id, show) {
    var el = document.getElementById(id);
    if (!el) return;
    el.classList.toggle('visible', !!show);
  };

  /* ---- Give page: amount & frequency selectors ---- */
  window.clfSelectAmount = function (el) {
    document.querySelectorAll('.amount-btn').forEach(function (b) { b.classList.remove('selected'); });
    el.classList.add('selected');
  };

  window.clfSelectFreq = function (el) {
    document.querySelectorAll('.freq-btn').forEach(function (b) { b.classList.remove('selected'); });
    el.classList.add('selected');
  };

});
