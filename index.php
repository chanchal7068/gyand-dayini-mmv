<?php
require_once __DIR__ . '/includes/functions.php';
$pageTitle = 'Home';

$sliders   = get_rows('sliders');
$notices   = get_rows('notices', 'is_active=1', 'notice_date DESC, sort_order ASC', 8);
$quick     = get_rows('quicklinks');
$courses   = get_rows('courses');
$leaders   = get_rows('leaders');
$gallery   = get_rows('gallery', 'is_active=1', 'sort_order ASC', 6);
$events    = get_rows('events', 'is_active=1', 'event_date DESC', 3);
$about     = get_page('about-college');

$icons = [
  'edit'  => '<path d="M4 20h16M6 16l10-10 4 4-10 10H6z"/>',
  'coin'  => '<circle cx="12" cy="12" r="9"/><path d="M12 7v10M9.5 9.5h4a1.8 1.8 0 010 3.6h-3a1.8 1.8 0 000 3.6h4"/>',
  'university' => '<path d="M3 10l9-5 9 5M5 10v9m5-9v9m4-9v9m5-9v9M3 21h18"/>',
  'result'=> '<path d="M6 3h9l4 4v14H6z"/><path d="M9 12h7M9 16h5M9 8h4"/>',
  'book'  => '<path d="M4 5a2 2 0 012-2h13v18H6a2 2 0 01-2-2z"/><path d="M8 7h8M8 11h6"/>',
  'file'  => '<path d="M7 3h7l5 5v13H7z"/><path d="M14 3v5h5"/>',
  'shield'=> '<path d="M12 3l8 3v6c0 5-3.5 8-8 9-4.5-1-8-4-8-9V6z"/><path d="M9 12l2 2 4-4"/>',
  'phone' => '<path d="M5 3h4l2 5-3 2a13 13 0 006 6l2-3 5 2v4a2 2 0 01-2 2A17 17 0 013 5a2 2 0 012-2z"/>',
  'link'  => '<path d="M10 13a5 5 0 007 0l3-3a5 5 0 00-7-7l-2 2"/><path d="M14 11a5 5 0 00-7 0l-3 3a5 5 0 007 7l2-2"/>',
];

include __DIR__ . '/includes/header.php';
?>

<!-- ================= HERO ================= -->
<section class="hero">
  <div class="hero-stack" aria-hidden="true">
    <?php foreach ($sliders as $k => $s): ?>
      <div class="hero-slide<?= $k === 0 ? ' on' : '' ?>" style="background-image:url('<?= e(media($s['image'])) ?>')"></div>
    <?php endforeach; ?>
    <?php if (!$sliders): ?><div class="hero-slide on" style="background-image:url('<?= e(media('')) ?>')"></div><?php endif; ?>
  </div>

  <div class="wrap hero-inner">
    <p class="eyebrow"><?= e(setting('tagline')) ?></p>
    <h1><?= e(setting('site_name_en')) ?></h1>
    <p class="motto">“<?= e(setting('motto')) ?>”</p>
    <p class="lead"><?= e(setting('hero_line')) ?></p>
    <div class="hero-actions">
      <a class="btn btn-gold" href="<?= url('admission.php') ?>">Apply for Admission</a>
      <a class="btn btn-ghost" href="<?= url('page/about-college') ?>">About College</a>
    </div>
  </div>
</section>

<!-- ================= NOTICE TICKER ================= -->
<?php if ($notices): ?>
<div class="ticker">
  <div class="ticker-label">Announcements</div>
  <div class="ticker-track">
    <div class="ticker-move">
      <?php foreach ($notices as $n): ?>
        <a href="<?= url('notices.php') ?>"><?= e($n['title']) ?><?= $n['is_new'] ? '<span class="tag-new">NEW</span>' : '' ?></a>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<?php endif; ?>

<!-- ================= QUICK LINKS ================= -->
<?php if ($quick): ?>
<section class="section tight">
  <div class="wrap">
    <div class="quicklinks reveal">
      <?php foreach ($quick as $q):
        $ic = $icons[$q['icon']] ?? $icons['link'];
        $href = preg_match('~^https?://~', $q['url']) ? $q['url'] : url($q['url']); ?>
        <a class="ql" href="<?= e($href) ?>"<?= preg_match('~^https?://~', $q['url']) ? ' target="_blank" rel="noopener"' : '' ?>>
          <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><?= $ic ?></svg>
          <span><?= e($q['title']) ?></span>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ================= ABOUT ================= -->
<section class="section">
  <div class="wrap split">
    <div class="reveal">
      <div class="section-head">
        <span class="kicker">About Us</span>
        <h2>Empowering Women Through Higher Education</h2>
      </div>
      <p><?= e(excerpt($about['content'] ?? '', 380)) ?></p>
      <ul class="tick-list">
        <li>Dedicated Women's College — Safe, secure, and disciplined campus environment</li>
        <li>Undergraduate degree programs affiliated to Mahatma Gandhi Kashi Vidyapith</li>
        <li>Comprehensive guidance for state scholarships and fee reimbursement</li>
        <li>100% Ragging-Free, inclusive, and student-focused institution</li>
      </ul>
      <a class="btn btn-gold" href="<?= url('page/about-college') ?>">Read More</a>
    </div>

    <div class="about-figure reveal">
      <img src="<?= url('assets/img/college-building.jpg') ?>" alt="<?= e(setting('site_name_en')) ?> Campus Building" loading="lazy">
      <div class="badge">
        <span><?= e(setting('stat_years', '25')) ?>+</span>
        <small>Years of Service</small>
      </div>
    </div>
  </div>
</section>

<!-- ================= STATS ================= -->
<section class="section tight">
  <div class="wrap">
    <div class="stats reveal">
      <div class="stat"><b data-count="<?= (int)setting('stat_students', 1200) ?>" data-suffix="+">0</b><span>Enrolled Students</span></div>
      <div class="stat"><b data-count="<?= (int)setting('stat_faculty', 24) ?>">0</b><span>Faculty &amp; Staff</span></div>
      <div class="stat"><b data-count="<?= (int)setting('stat_courses', 2) ?>">0</b><span>Undergraduate Faculties</span></div>
      <div class="stat"><b data-count="<?= (int)setting('stat_years', 25) ?>" data-suffix="+">0</b><span>Years of Excellence</span></div>
    </div>
  </div>
</section>

<!-- ================= COURSES ================= -->
<?php if ($courses): ?>
<section class="section">
  <div class="wrap">
    <div class="section-head center">
      <span class="kicker">Academics</span>
      <h2>Programs Offered</h2>
      <p>Undergraduate degree courses conducted as per Mahatma Gandhi Kashi Vidyapith curriculum.</p>
    </div>
    <div class="grid g-2">
      <?php foreach ($courses as $c): ?>
        <article class="card course-card reveal">
          <span class="meta"><?= e($c['short_name']) ?></span>
          <h3><?= e($c['name']) ?></h3>
          <dl>
            <dt>Duration</dt><dd><?= e($c['duration']) ?></dd>
            <dt>Eligibility</dt><dd><?= e($c['eligibility']) ?></dd>
            <dt>Subjects</dt><dd><?= e($c['subjects']) ?></dd>
          </dl>
          <p><?= e(excerpt($c['description'], 160)) ?></p>
          <a class="btn btn-ghost btn-sm" href="<?= url('courses.php#c' . (int)$c['id']) ?>">View Details</a>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ================= FOUNDERS ================= -->
<?php if ($leaders): ?>
<hr class="rule">
<section class="section">
  <div class="wrap">
    <div class="section-head center">
      <span class="kicker">Tribute</span>
      <h2>Our Inspiration &amp; Founders</h2>
      <p>Built upon the visionary dedication and sacrifice of our esteemed founders.</p>
    </div>
    <div class="grid g-3">
      <?php foreach ($leaders as $l): ?>
        <div class="card person reveal">
          <div class="photo"><img src="<?= e(media($l['photo'])) ?>" alt="<?= e($l['name']) ?>" loading="lazy"></div>
          <h3><?= e($l['name']) ?></h3>
          <p class="role"><?= e($l['designation']) ?></p>
          <?php if ($l['link_url']): ?><a class="btn btn-ghost btn-sm" style="margin-top:12px" href="<?= url($l['link_url']) ?>">Learn More</a><?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ================= NOTICES + EVENTS ================= -->
<section class="section section-alt">
  <div class="wrap grid g-2" style="align-items:start">
    <div class="reveal">
      <div class="section-head"><span class="kicker">Notice Board</span><h2>Circulars &amp; Notices</h2></div>
      <ul class="notice-list">
        <?php foreach (array_slice($notices, 0, 5) as $n): ?>
          <li>
            <div class="notice-date"><b><?= $n['notice_date'] ? fdate($n['notice_date'], 'd') : '—' ?></b><span><?= $n['notice_date'] ? fdate($n['notice_date'], 'M y') : '' ?></span></div>
            <div>
              <a href="<?= $n['file_path'] ? e(media($n['file_path'])) : ($n['link_url'] ? e($n['link_url']) : url('notices.php')) ?>"><?= e($n['title']) ?></a>
              <?= $n['is_new'] ? '<span class="tag-new">NEW</span>' : '' ?>
            </div>
          </li>
        <?php endforeach; ?>
      </ul>
      <a class="btn btn-ghost btn-sm" style="margin-top:18px" href="<?= url('notices.php') ?>">View All Notices</a>
    </div>

    <div class="reveal">
      <div class="section-head"><span class="kicker">Campus Life</span><h2>Recent Events &amp; Activities</h2></div>
      <div class="grid" style="gap:16px">
        <?php foreach ($events as $ev): ?>
          <article class="card" style="display:grid;grid-template-columns:96px 1fr;gap:16px;padding:16px;align-items:center">
            <img src="<?= e(media($ev['image'])) ?>" alt="" style="width:96px;height:80px;object-fit:cover;border-radius:8px" loading="lazy">
            <div>
              <span class="meta"><?= e(fdate($ev['event_date'])) ?></span>
              <h3 style="font-size:1.02rem;margin:.2em 0"><?= e($ev['title']) ?></h3>
              <p style="margin:0;font-size:.88rem"><?= e(excerpt($ev['description'], 90)) ?></p>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
      <a class="btn btn-ghost btn-sm" style="margin-top:18px" href="<?= url('events.php') ?>">View All Events</a>
    </div>
  </div>
</section>

<!-- ================= GALLERY STRIP ================= -->
<?php if ($gallery): ?>
<section class="section">
  <div class="wrap">
    <div class="section-head center">
      <span class="kicker">Highlights</span>
      <h2>Campus Gallery</h2>
    </div>
    <div class="masonry reveal">
      <?php foreach ($gallery as $g): ?>
        <figure data-cat="<?= e($g['category']) ?>">
          <img src="<?= e(media($g['image'])) ?>" alt="<?= e($g['title']) ?>" loading="lazy">
          <?php if ($g['title']): ?><figcaption><?= e($g['title']) ?></figcaption><?php endif; ?>
        </figure>
      <?php endforeach; ?>
    </div>
    <div class="center" style="margin-top:26px"><a class="btn btn-gold" href="<?= url('gallery.php') ?>">View Full Gallery</a></div>
  </div>
</section>
<?php endif; ?>

<!-- ================= CTA ================= -->
<section class="section tight">
  <div class="wrap">
    <div class="card reveal" style="text-align:center;border:1px solid var(--line);padding:44px 26px">
      <h2><?= e(setting('admission_note')) ?></h2>
      <p style="color:var(--muted);margin-inline:auto">Application forms and prospectus are available at the college office. Inquire online or contact us directly.</p>
      <div class="hero-actions">
        <a class="btn btn-gold" href="<?= url('admission.php') ?>">Inquire Online</a>
        <a class="btn btn-ghost" href="tel:+91<?= e(setting('phone1')) ?>">Call Us — <?= e(setting('phone1')) ?></a>
      </div>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>

