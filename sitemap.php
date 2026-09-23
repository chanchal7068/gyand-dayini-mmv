<?php
require_once __DIR__ . '/includes/functions.php';
header('Content-Type: application/xml; charset=utf-8');
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <?php foreach (['index.php','courses.php','faculty.php','gallery.php','notices.php','events.php','admission.php','contact.php'] as $f): ?>
  <url><loc><?= url($f) ?></loc><changefreq>weekly</changefreq></url>
  <?php endforeach; ?>
  <?php foreach (get_rows('pages') as $p): ?>
  <url><loc><?= url('page/' . $p['slug']) ?></loc><lastmod><?= date('Y-m-d', strtotime($p['updated_at'])) ?></lastmod></url>
  <?php endforeach; ?>
</urlset>
