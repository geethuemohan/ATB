/* ============================================================
   ATB CORPORATE — SHARED SCRIPT
   Sticky header · FAB · mobile nav · FAQ ·
   insights filter · long-form TOC side rail
   ============================================================ */
(function () {
  'use strict';

  /* ---- Sticky header shadow ---- */
  var header = document.getElementById('site-header');
  if (header) {
    window.addEventListener('scroll', function () {
      header.classList.toggle('scrolled', window.scrollY > 40);
    }, { passive: true });
  }

  /* ---- Floating Action Button ---- */
  var fab = document.getElementById('fab');
  var fabTrigger = document.getElementById('fab-trigger');
  if (fab && fabTrigger) {
    fabTrigger.addEventListener('click', function (e) {
      e.stopPropagation();
      var open = fab.classList.toggle('open');
      fabTrigger.setAttribute('aria-expanded', open);
    });
    document.addEventListener('click', function (e) {
      if (!fab.contains(e.target)) {
        fab.classList.remove('open');
        fabTrigger.setAttribute('aria-expanded', 'false');
      }
    });
  }

  /* ---- Mobile navigation ---- */
  var navToggle = document.getElementById('nav-toggle');
  var mobileNav = document.getElementById('mobile-nav');
  var navClose  = document.getElementById('mobile-nav-close');
  function closeMobile() {
    if (!mobileNav || !mobileNav.classList.contains('open')) return;
    mobileNav.classList.remove('open');
    document.body.style.overflow = '';
    if (navToggle) navToggle.focus();   // return focus to the toggle
  }
  function trapTab(e) {
    if (e.key !== 'Tab' || !mobileNav.classList.contains('open')) return;
    var f = mobileNav.querySelectorAll('a, button');
    if (!f.length) return;
    var first = f[0], last = f[f.length - 1];
    if (e.shiftKey && document.activeElement === first) { e.preventDefault(); last.focus(); }
    else if (!e.shiftKey && document.activeElement === last) { e.preventDefault(); first.focus(); }
  }
  if (navToggle && mobileNav) {
    navToggle.addEventListener('click', function () {
      mobileNav.classList.add('open');
      document.body.style.overflow = 'hidden';
      if (navClose) navClose.focus();   // move focus into the panel
    });
    mobileNav.addEventListener('keydown', trapTab);   // trap Tab while open
  }
  if (navClose) navClose.addEventListener('click', closeMobile);
  if (mobileNav) {
    mobileNav.querySelectorAll('a').forEach(function (a) {
      a.addEventListener('click', closeMobile);
    });
  }

  /* ---- Global Escape handler ---- */
  document.addEventListener('keydown', function (e) {
    if (e.key !== 'Escape') return;
    if (fab) { fab.classList.remove('open'); }
    if (fabTrigger) fabTrigger.setAttribute('aria-expanded', 'false');
    closeMobile();
  });

  /* ---- FAQ accordion ---- */
  var faqItems = document.querySelectorAll('.faq__item');
  faqItems.forEach(function (item) {
    var q = item.querySelector('.faq__q');
    var a = item.querySelector('.faq__a');
    if (!q || !a) return;
    q.addEventListener('click', function () {
      var isOpen = item.classList.contains('open');
      faqItems.forEach(function (other) {
        other.classList.remove('open');
        var oa = other.querySelector('.faq__a');
        if (oa) oa.style.maxHeight = null;
        var oq = other.querySelector('.faq__q');
        if (oq) oq.setAttribute('aria-expanded', 'false');
      });
      if (!isOpen) {
        item.classList.add('open');
        a.style.maxHeight = a.scrollHeight + 'px';
        q.setAttribute('aria-expanded', 'true');
      }
    });
  });

  /* ---- Insights subject filter (sticky sidebar + mobile dropdown) ---- */
  var subjectItems  = document.querySelectorAll('.subject-rail__item');
  var subjectSelect = document.getElementById('subject-select');
  var insightCards  = document.querySelectorAll('[data-insight-card]');
  var filterEmpty   = document.querySelector('.filter-empty');
  if (insightCards.length && (subjectItems.length || subjectSelect)) {
    function applyFilter(f) {
      var shown = 0;
      insightCards.forEach(function (card) {
        var match = f === 'all' || card.getAttribute('data-category') === f;
        card.style.display = match ? '' : 'none';
        if (match) shown++;
      });
      subjectItems.forEach(function (item) {
        var on = item.getAttribute('data-filter') === f;
        item.classList.toggle('active', on);
        item.setAttribute('aria-pressed', on ? 'true' : 'false');
      });
      if (subjectSelect && subjectSelect.value !== f) subjectSelect.value = f;
      if (filterEmpty) filterEmpty.style.display = shown === 0 ? 'block' : 'none';
    }
    subjectItems.forEach(function (item) {
      item.addEventListener('click', function () {
        applyFilter(item.getAttribute('data-filter'));
      });
    });
    if (subjectSelect) {
      subjectSelect.addEventListener('change', function () {
        applyFilter(subjectSelect.value);
      });
    }
    /* Populate article counts per subject */
    subjectItems.forEach(function (item) {
      var f = item.getAttribute('data-filter');
      var n = f === 'all'
        ? insightCards.length
        : document.querySelectorAll('[data-insight-card][data-category="' + f + '"]').length;
      var countEl = item.querySelector('[data-count]');
      if (countEl) countEl.textContent = n;
    });
  }

  /* ---- Long-form TOC: floating side rail + scroll-spy ---- */
  var toc = document.querySelector('.toc');
  if (toc && 'IntersectionObserver' in window) {
    var rail = document.createElement('nav');
    rail.className = 'toc-rail';
    rail.setAttribute('aria-label', 'Section navigation');
    var railLabel = document.createElement('div');
    railLabel.className = 'toc-rail__label';
    railLabel.textContent = 'On This Page';
    rail.appendChild(railLabel);
    var railList = document.createElement('ul');
    var spied = [];
    toc.querySelectorAll('a[href^="#"]').forEach(function (link) {
      var id = link.getAttribute('href').slice(1);
      var sec = document.getElementById(id);
      if (!sec) return;
      var li = document.createElement('li');
      var a = document.createElement('a');
      a.href = '#' + id;
      a.textContent = link.textContent;
      li.appendChild(a);
      railList.appendChild(li);
      spied.push({ link: a, sec: sec });
    });
    if (spied.length) {
      rail.appendChild(railList);
      document.body.appendChild(rail);

      /* Collect every full-width block the rail must not overlap:
         wide sections (any section whose container is NOT narrow),
         part-divider bands, the intro/TOC section, the hero, the
         closing band and the footer. The rail fades out whenever one
         of these sits beside it, and fades back in only when the
         space to its left is occupied by narrow content. */
      var wideBlocks = [];
      function addWide(el) {
        if (el && wideBlocks.indexOf(el) === -1) wideBlocks.push(el);
      }
      document.querySelectorAll('.section').forEach(function (sec) {
        var c = sec.querySelector(':scope > .container');
        if (c && !c.classList.contains('container--narrow')) addWide(sec);
      });
      document.querySelectorAll('.part-divider').forEach(function (el) {
        addWide(el);
      });
      addWide(toc.closest('.section'));
      addWide(document.querySelector('.page-hero'));
      addWide(document.querySelector('.closing'));
      addWide(document.querySelector('.footer'));

      function updateRail() {
        var railTop = 100;
        var railBottom = 128 + rail.offsetHeight + 24;
        var clash = false;
        for (var i = 0; i < wideBlocks.length; i++) {
          var r = wideBlocks[i].getBoundingClientRect();
          if (r.top < railBottom && r.bottom > railTop) { clash = true; break; }
        }
        rail.classList.toggle('visible', !clash);
      }
      updateRail();
      window.addEventListener('scroll', updateRail, { passive: true });
      window.addEventListener('resize', updateRail, { passive: true });

      /* Scroll-spy: highlight the section currently in view */
      var spyObs = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (!entry.isIntersecting) return;
          spied.forEach(function (s) { s.link.classList.remove('active'); });
          for (var i = 0; i < spied.length; i++) {
            if (spied[i].sec === entry.target) {
              spied[i].link.classList.add('active');
              break;
            }
          }
        });
      }, { rootMargin: '-15% 0px -75% 0px' });
      spied.forEach(function (s) { spyObs.observe(s.sec); });
    }
  }

})();
