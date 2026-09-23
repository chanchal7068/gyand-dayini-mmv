<?php
require_once __DIR__ . '/includes/functions.php';
$pageTitle = 'Photo Gallery';
$items = get_rows('gallery');

// Categories in specified order: Photos, Video, News, Campus, Events
$definedCats = ['Photos', 'Video', 'News', 'Campus', 'Events'];
$dbCats = [];
foreach ($items as $it) {
    if (!empty($it['category'])) {
        $found = false;
        foreach ($definedCats as $dc) {
            if (strcasecmp($dc, $it['category']) === 0) {
                $found = true;
                break;
            }
        }
        if (!$found) {
            $dbCats[$it['category']] = true;
        }
    }
}
$allCats = array_merge($definedCats, array_keys($dbCats));

include __DIR__ . '/includes/header.php';
?>
<section class="pagehead">
  <div class="wrap">
    <p class="crumbs"><a href="<?= url('index.php') ?>">Home</a> &rsaquo; Gallery</p>
    <h1>Campus Photo Gallery</h1>
    <p class="sub">Glimpses of campus life, academic events, and student celebrations</p>
  </div>
</section>

<section class="section">
  <div class="wrap">
    <div class="gal-filter">
      <button class="on" data-cat="all">All</button>
      <?php foreach ($allCats as $c): ?>
        <button data-cat="<?= e(strtolower($c)) ?>"><?= e($c) ?></button>
      <?php endforeach; ?>
    </div>
    <div class="masonry">
      <?php foreach ($items as $g): ?>
        <figure data-cat="<?= e(strtolower($g['category'])) ?>">
          <img src="<?= e(media($g['image'])) ?>" data-full="<?= e(media($g['image'])) ?>" alt="<?= e($g['title']) ?>" loading="lazy">
          <?php if ($g['title']): ?><figcaption><?= e($g['title']) ?></figcaption><?php endif; ?>
        </figure>
      <?php endforeach; ?>
    </div>
    <?php if (!$items): ?><p class="note">No photos uploaded yet.</p><?php endif; ?>
  </div>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>

