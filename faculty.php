<?php
require_once __DIR__ . '/includes/functions.php';
$pageTitle = 'Faculty & Staff';
$staff = get_rows('faculty');
include __DIR__ . '/includes/header.php';
?>
<section class="pagehead">
  <div class="wrap">
    <p class="crumbs"><a href="<?= url('index.php') ?>">Home</a> &rsaquo; Academics &rsaquo; Faculty &amp; Staff</p>
    <h1>Our Faculty &amp; Staff</h1>
    <p class="sub">Experienced, qualified, and dedicated academic team</p>
  </div>
</section>

<section class="section">
  <div class="wrap">
    <div class="grid g-4">
      <?php foreach ($staff as $f): ?>
        <div class="card person reveal">
          <div class="photo"><img src="<?= e(media($f['photo'], 'assets/img/avatar.svg')) ?>" alt="<?= e($f['name']) ?>" loading="lazy"></div>
          <h3><?= e($f['name']) ?></h3>
          <p class="role"><?= e($f['designation']) ?></p>
          <p class="dept"><?= e($f['department']) ?><?= $f['qualification'] ? ' · ' . e($f['qualification']) : '' ?></p>
        </div>
      <?php endforeach; ?>
    </div>
    <p class="note" style="margin-top:26px">Faculty profiles and qualifications can be managed through the admin panel.</p>
  </div>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>

