<?php
require_once __DIR__ . '/includes/functions.php';
$pageTitle = 'Notices & Circulars';
$notices = get_rows('notices', 'is_active=1', 'notice_date DESC, sort_order ASC');
include __DIR__ . '/includes/header.php';
?>
<section class="pagehead">
  <div class="wrap">
    <p class="crumbs"><a href="<?= url('index.php') ?>">Home</a> &rsaquo; Information Center &rsaquo; Notices &amp; Circulars</p>
    <h1>Notices &amp; Circulars</h1>
    <p class="sub">Official announcements regarding admissions, examinations, scholarships, and college updates</p>
  </div>
</section>

<section class="section">
  <div class="wrap layout">
    <div class="reveal">
      <ul class="notice-list">
        <?php foreach ($notices as $n):
          $href = $n['file_path'] ? media($n['file_path']) : ($n['link_url'] ?: '#'); ?>
          <li>
            <div class="notice-date"><b><?= $n['notice_date'] ? fdate($n['notice_date'], 'd') : '—' ?></b><span><?= $n['notice_date'] ? fdate($n['notice_date'], 'M y') : '' ?></span></div>
            <div>
              <a href="<?= e($href) ?>"<?= $n['file_path'] ? ' target="_blank" rel="noopener"' : '' ?>><?= e($n['title']) ?></a>
              <?= $n['is_new'] ? '<span class="tag-new">NEW</span>' : '' ?>
              <?php if ($n['file_path']): ?><div class="note">Download Attachment (PDF)</div><?php endif; ?>
            </div>
          </li>
        <?php endforeach; ?>
      </ul>
      <?php if (!$notices): ?><p class="note">No notices currently published.</p><?php endif; ?>
    </div>

    <aside class="sidebar">
      <div class="side-box">
        <h4>Useful Links</h4>
        <ul class="side-nav">
          <li><a href="https://www.mgkvp.ac.in" target="_blank" rel="noopener">MGKVP University Website</a></li>
          <li><a href="https://scholarship.up.gov.in" target="_blank" rel="noopener">UP Scholarship Portal</a></li>
          <li><a href="<?= url('page/academic-calendar') ?>">Academic Calendar</a></li>
          <li><a href="<?= url('page/examinations') ?>">Examinations &amp; Results</a></li>
        </ul>
      </div>
      <div class="side-box">
        <h4>Information Helpdesk</h4>
        <p style="font-size:.93rem;color:var(--muted)">For queries or clarifications regarding any official notice, please contact during office hours.</p>
        <a class="btn btn-gold btn-sm" style="width:100%" href="tel:+91<?= e(setting('phone1')) ?>"><?= e(setting('phone1')) ?></a>
      </div>
    </aside>
  </div>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>

