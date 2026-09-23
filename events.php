<?php
require_once __DIR__ . '/includes/functions.php';
$pageTitle = 'Events & Achievements';
$events = get_rows('events', 'is_active=1', 'event_date DESC');
include __DIR__ . '/includes/header.php';
?>
<section class="pagehead">
  <div class="wrap">
    <p class="crumbs"><a href="<?= url('index.php') ?>">Home</a> &rsaquo; Information Center &rsaquo; Events</p>
    <h1>Events &amp; Achievements</h1>
    <p class="sub">College activities, celebrations, and student achievements</p>
  </div>
</section>

<section class="section">
  <div class="wrap grid g-3">
    <?php foreach ($events as $ev): ?>
      <article class="card reveal" style="padding:0;overflow:hidden">
        <img src="<?= e(media($ev['image'])) ?>" alt="" style="height:190px;width:100%;object-fit:cover" loading="lazy">
        <div style="padding:22px">
          <span class="meta"><?= e(fdate($ev['event_date'])) ?></span>
          <h3><?= e($ev['title']) ?></h3>
          <p><?= e($ev['description']) ?></p>
        </div>
      </article>
    <?php endforeach; ?>
    <?php if (!$events): ?><p class="note">No events currently published.</p><?php endif; ?>
  </div>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>

