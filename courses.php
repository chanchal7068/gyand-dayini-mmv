<?php
require_once __DIR__ . '/includes/functions.php';
$pageTitle = 'Courses & Programs';
$courses = get_rows('courses');
include __DIR__ . '/includes/header.php';
?>
<section class="pagehead">
  <div class="wrap">
    <p class="crumbs"><a href="<?= url('index.php') ?>">Home</a> &rsaquo; Academics &rsaquo; Courses &amp; Programs</p>
    <h1>Undergraduate Degree Programs</h1>
    <p class="sub">Affiliated to Mahatma Gandhi Kashi Vidyapith, Varanasi</p>
  </div>
</section>

<section class="section">
  <div class="wrap">
    <div class="grid g-2">
      <?php foreach ($courses as $c): ?>
        <article class="card course-card reveal" id="c<?= (int)$c['id'] ?>">
          <span class="meta"><?= e($c['short_name']) ?></span>
          <h3><?= e($c['name']) ?></h3>
          <dl>
            <dt>Duration</dt><dd><?= e($c['duration']) ?></dd>
            <dt>Eligibility</dt><dd><?= e($c['eligibility']) ?></dd>
            <dt>Seats</dt><dd><?= e($c['seats']) ?></dd>
            <dt>Subjects</dt><dd><?= e($c['subjects']) ?></dd>
          </dl>
          <p><?= e($c['description']) ?></p>
          <a class="btn btn-gold btn-sm" href="<?= url('admission.php') ?>">Apply for Admission</a>
        </article>
      <?php endforeach; ?>
    </div>

    <div class="card reveal" style="margin-top:34px">
      <h3>General Admission Guidelines</h3>
      <ul class="tick-list">
        <li>Admissions are granted strictly on merit based on 10+2 (Intermediate) marks.</li>
        <li>Prospectus and application forms are available at the college administrative office.</li>
        <li>Academic sessions and classes commence in August every year.</li>
        <li>Statutory reservation policies of UP Govt. and affiliating university are strictly followed.</li>
      </ul>
      <a class="btn btn-ghost btn-sm" href="<?= url('page/fee-structure') ?>">View Fee Structure</a>
    </div>
  </div>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>

