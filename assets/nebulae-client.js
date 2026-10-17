/**
 * @license MIT
 * nebulae-client.js — Client Progressive Enhancement for nebulae.raggiesoft.com
 * Implements Modern Web Guidance dark-mode-toggle and instant 9-property route search.
 */
(function () {
  var meta = document.querySelector('meta[name="color-scheme"]');
  var themeBtn = document.getElementById('theme-toggle');
  var themeLabel = document.getElementById('theme-toggle-label');
  var searchInput = document.getElementById('nebulae-search');
  var filterBtns = Array.prototype.slice.call(document.querySelectorAll('[data-constellation-filter]'));
  var cards = Array.prototype.slice.call(document.querySelectorAll('[data-constellation-id]'));
  var countEl = document.getElementById('visible-route-count');
  var activeConstellation = 'all';

  function getSystemScheme() {
    return window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
  }

  function getRenderedScheme() {
    var stored = null;
    try { stored = localStorage.getItem('color-scheme'); } catch (e) {}
    return (stored === 'light' || stored === 'dark') ? stored : getSystemScheme();
  }

  function updateThemeLabel() {
    if (!themeLabel) return;
    var current = getRenderedScheme();
    var stored = null;
    try { stored = localStorage.getItem('color-scheme'); } catch (e) {}
    if (stored === 'light' || stored === 'dark') {
      themeLabel.textContent = current === 'dark' ? '🌌 Deep Space (Pinned)' : '☀️ Star-Chart (Pinned)';
    } else {
      themeLabel.textContent = current === 'dark' ? '🌌 System (Deep Space)' : '☀️ System (Star-Chart)';
    }
  }

  if (themeBtn && meta) {
    updateThemeLabel();
    themeBtn.addEventListener('click', function () {
      var current = getRenderedScheme();
      var target = current === 'dark' ? 'light' : 'dark';
      var sys = getSystemScheme();
      try {
        if (target === sys) {
          localStorage.removeItem('color-scheme');
          meta.content = 'light dark';
        } else {
          localStorage.setItem('color-scheme', target);
          meta.content = target;
        }
      } catch (e) {
        meta.content = target;
      }
      updateThemeLabel();
    });
  }

  function applyFilter() {
    var q = String(searchInput ? searchInput.value : '').trim().toLowerCase();
    var totalVisible = 0;

    cards.forEach(function (card) {
      var cid = card.getAttribute('data-constellation-id');
      var matchesConstellation = (activeConstellation === 'all' || activeConstellation === cid);
      if (!matchesConstellation) {
        card.style.display = 'none';
        return;
      }
      var items = Array.prototype.slice.call(card.querySelectorAll('.route-item'));
      var visibleInCard = 0;
      items.forEach(function (item) {
        var text = (item.textContent || '').toLowerCase();
        var show = !q || text.indexOf(q) !== -1;
        item.style.display = show ? '' : 'none';
        if (show) {
          visibleInCard++;
          totalVisible++;
        }
      });
      card.style.display = visibleInCard > 0 ? '' : 'none';
    });

    if (countEl) {
      countEl.textContent = String(totalVisible);
    }
  }

  if (searchInput) {
    searchInput.addEventListener('input', applyFilter);
  }

  filterBtns.forEach(function (btn) {
    btn.addEventListener('click', function () {
      activeConstellation = btn.getAttribute('data-constellation-filter') || 'all';
      filterBtns.forEach(function (b) {
        b.setAttribute('aria-pressed', b === btn ? 'true' : 'false');
      });
      applyFilter();
    });
  });
})();
