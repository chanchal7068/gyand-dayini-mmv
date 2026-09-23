<?php
require_once __DIR__ . '/includes/functions.php';

$slug = $_GET['slug'] ?? '';
$page = $slug ? get_page($slug) : null;

if (!$page) {
    http_response_code(404);
    $pageTitle = 'Page Not Found';
    include __DIR__ . '/includes/header.php';
    echo '<section class="section"><div class="wrap center" style="max-width:640px">
            <h1>Sorry, this page is not available</h1>
            <p style="color:var(--muted)">The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>
            <a class="btn btn-gold" href="' . url('index.php') . '">Return to Home</a>
          </div></section>';
    include __DIR__ . '/includes/footer.php';
    exit;
}

$pageTitle = $page['title'];
$metaDesc  = $page['meta_desc'] ?: excerpt($page['content'], 160);

/* sibling navigation — links in the same parent menu group */
$siblings = [];
$groupName = '';
foreach (menu_tree() as $m) {
    foreach ($m['children'] as $c) {
        if (trim($c['url'], '/') === 'page/' . $slug) {
            $siblings  = $m['children'];
            $groupName = $m['title'];
            break 2;
        }
    }
}

include __DIR__ . '/includes/header.php';
?>

<section class="pagehead">
  <div class="wrap">
    <p class="crumbs"><a href="<?= url('index.php') ?>">Home</a> <?= $groupName ? '&rsaquo; ' . e($groupName) : '' ?> &rsaquo; <?= e($page['title']) ?></p>
    <h1><?= e($page['title']) ?></h1>
    <?php if ($page['subtitle']): ?><p class="sub"><?= e($page['subtitle']) ?></p><?php endif; ?>
  </div>
</section>

<section class="section">
  <div class="wrap layout">
    <article class="prose reveal">
      <?php if ($page['banner']): ?>
        <img src="<?= e(media($page['banner'])) ?>" alt="" style="border-radius:var(--radius-lg);margin-bottom:26px">
      <?php endif; ?>
      <?= $page['content'] ?>
      <p style="color:var(--muted-2);font-size:.84rem;margin-top:34px">Last Updated : <?= fdate($page['updated_at']) ?></p>
    </article>

    <aside class="sidebar">
      <?php if ($siblings): ?>
      <div class="side-box">
        <h4><?= e($groupName) ?></h4>
        <ul class="side-nav">
          <?php foreach ($siblings as $s): ?>
            <li><a href="<?= e(menu_link($s)) ?>" style="<?= trim($s['url'],'/') === 'page/'.$slug ? 'color:var(--gold)' : '' ?>"><?= e($s['title']) ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <?php endif; ?>

      <div class="side-box">
        <h4>Contact Us</h4>
        <p style="font-size:.92rem;color:var(--muted);margin-bottom:10px"><?= e(setting('address')) ?></p>
        <p style="font-size:.95rem;margin:0"><a href="tel:+91<?= e(setting('phone1')) ?>"><?= e(setting('phone1')) ?></a><br>
        <a href="mailto:<?= e(setting('email')) ?>"><?= e(setting('email')) ?></a></p>
        <a class="btn btn-gold btn-sm" style="margin-top:16px;width:100%" href="<?= url('admission.php') ?>">Admission Info</a>
      </div>

      <?php $recent = get_rows('notices', 'is_active=1', 'notice_date DESC', 4); if ($recent): ?>
      <div class="side-box">
        <h4>Latest Notices</h4>
        <ul class="side-nav">
          <?php foreach ($recent as $n): ?>
            <li><a href="<?= url('notices.php') ?>"><?= e($n['title']) ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <?php endif; ?>
    </aside>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>

