/* ज्ञानदायिनी महिला महाविद्यालय — front-end behaviour */
(function () {
  'use strict';

  /* ---- mobile nav ---- */
  var toggle = document.querySelector('.nav-toggle');
  var list = document.querySelector('.nav-list');
  if (toggle && list) {
    toggle.addEventListener('click', function () {
      list.classList.toggle('open');
      toggle.setAttribute('aria-expanded', list.classList.contains('open'));
    });
  }
  document.querySelectorAll('.has-sub > a').forEach(function (a) {
    a.addEventListener('click', function (ev) {
      if (window.innerWidth <= 860) {
        ev.preventDefault();
        a.parentElement.classList.toggle('open');
      }
    });
  });

  /* ---- hero slideshow ---- */
  var slides = document.querySelectorAll('.hero-slide');
  if (slides.length > 1) {
    var i = 0;
    setInterval(function () {
      slides[i].classList.remove('on');
      i = (i + 1) % slides.length;
      slides[i].classList.add('on');
    }, 6500);
  }

  /* ---- scroll reveal ---- */
  var io = 'IntersectionObserver' in window
    ? new IntersectionObserver(function (entries) {
        entries.forEach(function (en) {
          if (en.isIntersecting) { en.target.classList.add('seen'); io.unobserve(en.target); }
        });
      }, { threshold: 0.12 })
    : null;
  document.querySelectorAll('.reveal').forEach(function (el, n) {
    el.style.transitionDelay = (n % 4) * 90 + 'ms';
    if (io) io.observe(el); else el.classList.add('seen');
  });

  /* ---- number counters ---- */
  function countUp(el) {
    var target = parseInt(el.dataset.count, 10) || 0;
    var t0 = null;
    function step(ts) {
      if (!t0) t0 = ts;
      var p = Math.min((ts - t0) / 1400, 1);
      el.textContent = Math.floor(target * (1 - Math.pow(1 - p, 3))).toLocaleString('en-IN');
      if (p < 1) requestAnimationFrame(step);
      else el.textContent = target.toLocaleString('en-IN') + (el.dataset.suffix || '');
    }
    requestAnimationFrame(step);
  }
  var counters = document.querySelectorAll('[data-count]');
  if (counters.length) {
    var co = 'IntersectionObserver' in window
      ? new IntersectionObserver(function (es) {
          es.forEach(function (en) { if (en.isIntersecting) { countUp(en.target); co.unobserve(en.target); } });
        }, { threshold: 0.5 })
      : null;
    counters.forEach(function (c) { if (co) co.observe(c); else countUp(c); });
  }

  /* ---- ticker: duplicate content for seamless loop ---- */
  var move = document.querySelector('.ticker-move');
  if (move && move.children.length) { move.innerHTML += move.innerHTML; }

  /* ---- gallery filter ---- */
  var filterBtns = document.querySelectorAll('.gal-filter button');
  filterBtns.forEach(function (b) {
    b.addEventListener('click', function () {
      filterBtns.forEach(function (x) { x.classList.remove('on'); });
      b.classList.add('on');
      var cat = (b.dataset.cat || '').toLowerCase();
      document.querySelectorAll('.masonry figure').forEach(function (f) {
        var fcat = (f.dataset.cat || '').toLowerCase();
        f.style.display = (cat === 'all' || fcat === cat) ? '' : 'none';
      });
    });
  });

  /* ---- gallery lightbox viewer with next / prev ---- */
  var lb = document.querySelector('.lightbox');
  if (lb) {
    var lbImg = lb.querySelector('.lb-img');
    var lbCaption = lb.querySelector('.lb-caption');
    var lbCounter = lb.querySelector('.lb-counter');
    var btnPrev = lb.querySelector('.lb-prev');
    var btnNext = lb.querySelector('.lb-next');
    var btnClose = lb.querySelector('.lb-close');

    var currentImages = [];
    var currentIndex = 0;

    function getVisibleGalleryImages() {
      var list = [];
      var figures = document.querySelectorAll('.masonry figure');
      if (figures.length) {
        figures.forEach(function (fig) {
          if (fig.style.display !== 'none') {
            var im = fig.querySelector('img');
            var cap = fig.querySelector('figcaption');
            if (im) {
              list.push({
                src: im.dataset.full || im.src,
                alt: im.alt || '',
                caption: cap ? cap.textContent.trim() : (im.alt || ''),
                element: im
              });
            }
          }
        });
      } else {
        document.querySelectorAll('.gal-strip img, .masonry img').forEach(function (im) {
          list.push({
            src: im.dataset.full || im.src,
            alt: im.alt || '',
            caption: im.alt || '',
            element: im
          });
        });
      }
      return list;
    }

    function showImage(index) {
      if (!currentImages.length) return;
      if (index < 0) index = currentImages.length - 1;
      if (index >= currentImages.length) index = 0;
      currentIndex = index;

      var item = currentImages[currentIndex];
      if (lbImg) {
        lbImg.src = item.src;
        lbImg.alt = item.alt;
      }
      if (lbCaption) {
        lbCaption.textContent = item.caption || '';
        lbCaption.style.display = item.caption ? '' : 'none';
      }
      if (lbCounter) {
        lbCounter.textContent = (currentIndex + 1) + ' / ' + currentImages.length;
      }
    }

    function openLightbox(clickedEl) {
      currentImages = getVisibleGalleryImages();
      if (!currentImages.length) return;

      var foundIdx = -1;
      for (var i = 0; i < currentImages.length; i++) {
        if (currentImages[i].element === clickedEl || currentImages[i].src === (clickedEl.dataset.full || clickedEl.src)) {
          foundIdx = i;
          break;
        }
      }
      if (foundIdx === -1) foundIdx = 0;

      showImage(foundIdx);
      lb.classList.add('on');
      document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
      lb.classList.remove('on');
      document.body.style.overflow = '';
    }

    // Set cursor on masonry and strip images
    document.querySelectorAll('.masonry img, .gal-strip img').forEach(function (im) {
      im.style.cursor = 'zoom-in';
      im.addEventListener('click', function (e) {
        e.preventDefault();
        openLightbox(im);
      });
    });

    if (btnPrev) {
      btnPrev.addEventListener('click', function (e) {
        e.stopPropagation();
        showImage(currentIndex - 1);
      });
    }

    if (btnNext) {
      btnNext.addEventListener('click', function (e) {
        e.stopPropagation();
        showImage(currentIndex + 1);
      });
    }

    if (btnClose) {
      btnClose.addEventListener('click', function (e) {
        e.stopPropagation();
        closeLightbox();
      });
    }

    lb.addEventListener('click', function (e) {
      if (e.target === lb || e.target.classList.contains('lb-wrap') || e.target.classList.contains('lb-img-container')) {
        closeLightbox();
      }
    });

    document.addEventListener('keydown', function (ev) {
      if (!lb.classList.contains('on')) return;
      if (ev.key === 'Escape') {
        closeLightbox();
      } else if (ev.key === 'ArrowLeft') {
        showImage(currentIndex - 1);
      } else if (ev.key === 'ArrowRight') {
        showImage(currentIndex + 1);
      }
    });
  }

  /* ---- theme toggle (White / Black mode) ---- */
  var btnT = document.getElementById('themeToggle');
  function setTheme(isDark) {
    if (isDark) {
      document.documentElement.classList.add('theme-dark');
      document.body.classList.add('theme-dark');
      if (btnT) {
        btnT.innerHTML = '☀️ <span>Light Mode</span>';
        btnT.title = 'Switch to White (Light Mode)';
      }
    } else {
      document.documentElement.classList.remove('theme-dark');
      document.body.classList.remove('theme-dark');
      if (btnT) {
        btnT.innerHTML = '🌙 <span>Dark Mode</span>';
        btnT.title = 'Switch to Black (Dark Mode)';
      }
    }
  }

  var savedTheme = null;
  try { savedTheme = localStorage.getItem('gd_theme'); } catch (e) {}
  if (savedTheme === 'dark') {
    setTheme(true);
  } else {
    setTheme(false); // Default: Pure White Light Mode
  }

  if (btnT) {
    btnT.addEventListener('click', function () {
      var isDark = document.documentElement.classList.contains('theme-dark') || document.body.classList.contains('theme-dark');
      var makeDark = !isDark;
      setTheme(makeDark);
      try { localStorage.setItem('gd_theme', makeDark ? 'dark' : 'light'); } catch (e) {}
    });
  }

  /* ---- active nav highlight ---- */
  var here = location.pathname.split('/').pop() + location.search;
  document.querySelectorAll('.nav-list a').forEach(function (a) {
    var href = a.getAttribute('href') || '';
    if (href && here && href.indexOf(here) > -1 && here !== '') a.classList.add('active');
  });
})();
