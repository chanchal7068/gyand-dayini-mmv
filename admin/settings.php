<?php
$adminTitle = 'Site Settings';
require_once __DIR__ . '/auth.php';
require_admin();

$groups = [
  'Institution Profile' => [
    'site_name_en'   => ['College Name (English)', 'text'],
    'site_name_hi'   => ['College Name (Hindi)', 'text'],
    'affiliation_en' => ['Affiliation Line (English)', 'text'],
    'affiliation_hi' => ['Affiliation Line (Hindi)', 'text'],
    'tagline'        => ['Tagline', 'text'],
    'motto'          => ['Motto', 'text'],
    'hero_line'      => ['Hero Section Description', 'textarea'],
    'logo'           => ['Logo (Standard)', 'file'],
    'logo_large'     => ['Logo / Building Photo (Large)', 'file'],
  ],
  'Contact Information' => [
    'address'       => ['Campus Address', 'textarea'],
    'phone1'        => ['Primary Phone', 'text'],
    'phone2'        => ['Secondary Phone', 'text'],
    'whatsapp'      => ['WhatsApp Number (with country code, e.g. 91...)', 'text'],
    'email'         => ['Email Address', 'text'],
    'working_hours' => ['Office Working Hours', 'text'],
    'map_embed'     => ['Google Maps Embed URL', 'textarea'],
  ],
  'Social Media Links' => [
    'facebook'  => ['Facebook Page URL', 'text'],
    'instagram' => ['Instagram Profile URL', 'text'],
    'youtube'   => ['YouTube Channel URL', 'text'],
    'twitter'   => ['X / Twitter URL', 'text'],
  ],
  'Statistics & Admissions' => [
    'stat_students'  => ['Enrolled Students Count', 'text'],
    'stat_faculty'   => ['Faculty & Staff Count', 'text'],
    'stat_courses'   => ['Faculties / Streams Count', 'text'],
    'stat_years'     => ['Years of Experience', 'text'],
    'admission_open' => ['Show Admission Banner (1 = Yes, 0 = No)', 'text'],
    'admission_note' => ['Admission Announcement Text', 'text'],
  ],
  'SEO & Footer' => [
    'meta_desc'   => ['Default Meta Description', 'textarea'],
    'footer_note' => ['Footer Copyright Line', 'text'],
  ],
];

$flash = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && csrf_check()) {
    $st = $pdo->prepare("INSERT INTO settings (skey,svalue) VALUES (?,?) ON DUPLICATE KEY UPDATE svalue=VALUES(svalue)");
    foreach ($groups as $fields) {
        foreach ($fields as $key => $meta) {
            if ($meta[1] === 'file') {
                $up = upload_file($key, 'pages');
                $val = $up ?: ($_POST[$key . '_existing'] ?? '');
            } else {
                $val = trim($_POST[$key] ?? '');
            }
            $st->execute([$key, $val]);
        }
    }
    $flash = 'Settings saved successfully.';
}

$S = [];
foreach ($pdo->query("SELECT skey,svalue FROM settings") as $r) $S[$r['skey']] = $r['svalue'];
include __DIR__ . '/inc/header.php';
?>
<div class="topline"><h1>⚙️ Site Settings</h1></div>
<?php if ($flash): ?><div class="msg ok"><?= e($flash) ?></div><?php endif; ?>

<form method="post" enctype="multipart/form-data">
  <?= csrf_field() ?>
  <?php foreach ($groups as $gname => $fields): ?>
    <div class="panel">
      <h2><?= e($gname) ?></h2>
      <div class="form">
        <div class="row">
          <?php foreach ($fields as $key => $meta): [$label, $type] = $meta; $val = $S[$key] ?? ''; ?>
            <div style="<?= $type === 'textarea' ? 'grid-column:1/-1' : '' ?>">
              <label for="s_<?= $key ?>"><?= e($label) ?></label>
              <?php if ($type === 'textarea'): ?>
                <textarea id="s_<?= $key ?>" name="<?= $key ?>" style="min-height:90px"><?= e($val) ?></textarea>
              <?php elseif ($type === 'file'): ?>
                <?php if ($val): ?><div class="thumb-now"><img src="<?= e(media($val)) ?>" alt=""></div><?php endif; ?>
                <input type="hidden" name="<?= $key ?>_existing" value="<?= e($val) ?>">
                <input type="file" name="<?= $key ?>">
              <?php else: ?>
                <input type="text" id="s_<?= $key ?>" name="<?= $key ?>" value="<?= e($val) ?>">
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
  <button class="btn btn-gold" type="submit">Save All Settings</button>
</form>
<?php include __DIR__ . '/inc/footer.php'; ?>

