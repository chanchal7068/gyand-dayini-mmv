<?php
require_once __DIR__ . '/functions.php';
$S = settings();
$pageTitle = $pageTitle ?? $S['site_name_en'] ?? 'College';
$metaDesc  = $metaDesc  ?? setting('meta_desc');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($pageTitle) ?> | <?= e(setting('site_name_en')) ?></title>
<meta name="description" content="<?= e($metaDesc) ?>">
<meta property="og:title" content="<?= e($pageTitle) ?>">
<meta property="og:description" content="<?= e($metaDesc) ?>">
<meta property="og:image" content="<?= e(media(setting('logo'))) ?>">
<meta property="og:type" content="website">
<link rel="icon" href="<?= e(media(setting('logo'))) ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Mukta:wght@300;400;600;700&family=Marcellus&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= url('assets/css/style.css') ?>?v=<?= time() ?>">
<script>
  (function(){
    try {
      if (localStorage.getItem('gd_theme') === 'dark') {
        document.documentElement.classList.add('theme-dark');
      }
    } catch(e){}
  })();
</script>
</head>
<body>
<a class="skip" href="#main">Skip to main content</a>

<div class="topbar">
  <div class="wrap">
    <div class="tb-left">
      <span>Office Hours: <b><?= e(setting('working_hours')) ?></b></span>
      <span>Phone: <b><?= e(setting('phone1')) ?><?= setting('phone2') ? ', ' . e(setting('phone2')) : '' ?></b></span>
    </div>
    <div class="tb-tools" role="group" aria-label="Theme Options">
      <button id="themeToggle" class="theme-toggle-btn" title="Toggle Dark / Light Theme" aria-label="Toggle Dark / Light Theme">🌓 <span>Theme</span></button>
    </div>
  </div>
</div>

<header class="masthead">
  <div class="wrap">
    <a class="crest" href="<?= url('index.php') ?>" aria-label="Home">
      <img src="<?= e(media(setting('logo'))) ?>" alt="<?= e(setting('site_name_en')) ?> Logo">
    </a>
    <div class="mast-text">
      <h1 class="hi" style="font-size:inherit"><?= e(setting('site_name_en')) ?></h1>
      <p class="en"><?= e(setting('site_name_hi')) ?></p>
      <p class="aff"><?= e(setting('affiliation_en')) ?></p>
    </div>
    <div class="mast-cta" style="display:flex; flex-direction:row; align-items:center; gap:10px; flex-shrink:0;">
      <?php if (setting('admission_open') === '1'): ?>
        <a class="btn btn-gold btn-sm" href="<?= url('admission.php') ?>">Admission 2026-27</a>
      <?php endif; ?>
      <a class="btn btn-ghost btn-sm" href="<?= url('notices.php') ?>">Notices</a>
    </div>
  </div>
</header>

<nav class="navbar" aria-label="Main Navigation">
  <div class="wrap">
    <button class="nav-toggle" aria-expanded="false" aria-controls="mainmenu">☰ Menu</button>
    <ul class="nav-list" id="mainmenu">
      <?php foreach (menu_tree() as $m): $has = !empty($m['children']); ?>
        <li class="<?= $has ? 'has-sub' : '' ?>">
          <a href="<?= e(menu_link($m)) ?>"<?= $m['open_new'] ? ' target="_blank" rel="noopener"' : '' ?>><?= e($m['title']) ?></a>
          <?php if ($has): ?>
            <ul class="subnav">
              <?php foreach ($m['children'] as $c): ?>
                <li><a href="<?= e(menu_link($c)) ?>"<?= $c['open_new'] ? ' target="_blank" rel="noopener"' : '' ?>><?= e($c['title']) ?></a></li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</nav>
<main id="main">
