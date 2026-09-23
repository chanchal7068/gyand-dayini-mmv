<?php
require_once dirname(__DIR__) . '/auth.php';
require_admin();
require_once dirname(__DIR__) . '/entities.php';
$me = admin_user();
$cur = $_GET['t'] ?? basename($_SERVER['PHP_SELF'], '.php');
?>
<!DOCTYPE html><html lang="en"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= e($adminTitle ?? 'Administration') ?> — <?= e(setting('site_name_en')) ?></title>
<link href="https://fonts.googleapis.com/css2?family=Mukta:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= url('admin/assets/admin.css') ?>">
</head><body>
<div class="shell">
  <aside class="side">
    <div class="brand">
      <img src="<?= e(media(setting('logo'))) ?>" alt="<?= e(setting('site_name_en')) ?>">
      <b><?= e(setting('site_name_en')) ?></b>
    </div>
    <nav>
      <a href="<?= url('admin/index.php') ?>" class="<?= $cur === 'index' ? 'on' : '' ?>">📊 <span>Dashboard</span></a>
      <div class="grp">CONTENT MANAGEMENT</div>
      <?php foreach ($ENTITIES as $key => $en): ?>
        <a href="<?= url('admin/manage.php?t=' . $key) ?>" class="<?= $cur === $key ? 'on' : '' ?>"><?= $en['icon'] ?> <span><?= e($en['label']) ?></span></a>
      <?php endforeach; ?>
      <div class="grp">SYSTEM &amp; SETTINGS</div>
      <a href="<?= url('admin/enquiries.php') ?>" class="<?= $cur === 'enquiries' ? 'on' : '' ?>">📥 <span>Inquiries</span></a>
      <a href="<?= url('admin/settings.php') ?>" class="<?= $cur === 'settings' ? 'on' : '' ?>">⚙️ <span>Site Settings</span></a>
      <a href="<?= url('admin/password.php') ?>" class="<?= $cur === 'password' ? 'on' : '' ?>">🔒 <span>Change Password</span></a>
      <a href="<?= url('index.php') ?>" target="_blank">🌐 <span>View Website</span></a>
      <a href="<?= url('admin/logout.php') ?>">🚪 <span>Logout</span></a>
    </nav>
  </aside>
  <div class="main">
