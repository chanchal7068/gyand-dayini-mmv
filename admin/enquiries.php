<?php
$adminTitle = 'Inquiries & Messages';
require_once __DIR__ . '/auth.php';
require_admin();

if (isset($_GET['read'])) { $pdo->prepare("UPDATE enquiries SET is_read=1 WHERE id=?")->execute([(int)$_GET['read']]); redirect(url('admin/enquiries.php')); }
if (isset($_GET['del']))  { $pdo->prepare("DELETE FROM enquiries WHERE id=?")->execute([(int)$_GET['del']]); redirect(url('admin/enquiries.php')); }

$rows = get_rows('enquiries', '1', 'created_at DESC', 300);

if (isset($_GET['export'])) {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=enquiries-' . date('Y-m-d') . '.csv');
    $out = fopen('php://output', 'w'); fwrite($out, "\xEF\xBB\xBF");
    fputcsv($out, ['Name','Mobile','Email','Course','Subject','Message','Type','Date']);
    foreach ($rows as $r) fputcsv($out, [$r['name'],$r['phone'],$r['email'],$r['course'],$r['subject'],$r['message'],$r['type'],$r['created_at']]);
    exit;
}

include __DIR__ . '/inc/header.php';
?>
<div class="topline">
  <h1>📥 Inquiries &amp; Messages</h1>
  <a class="btn btn-ghost btn-sm" href="<?= url('admin/enquiries.php?export=1') ?>">Export CSV</a>
</div>

<div class="panel" style="padding:6px 12px">
  <table class="grid">
    <thead><tr><th>Name / Message</th><th>Contact Info</th><th>Type</th><th>Date</th><th style="width:170px">Actions</th></tr></thead>
    <tbody>
    <?php foreach ($rows as $r): ?>
      <tr id="e<?= (int)$r['id'] ?>">
        <td>
          <b><?= e($r['name']) ?></b> <?= $r['is_read'] ? '' : '<span class="badge off">NEW</span>' ?>
          <?php if ($r['course']): ?><div class="hint"><?= e($r['course']) ?></div><?php endif; ?>
          <?php if ($r['message']): ?><div style="color:var(--a-muted);font-size:.88rem;margin-top:4px"><?= nl2br(e($r['message'])) ?></div><?php endif; ?>
        </td>
        <td><a href="tel:+91<?= e($r['phone']) ?>"><?= e($r['phone']) ?></a><?php if ($r['email']): ?><div class="hint"><?= e($r['email']) ?></div><?php endif; ?></td>
        <td><?= $r['type'] === 'admission' ? 'Admission' : 'General' ?></td>
        <td><?= fdate($r['created_at'], 'd M Y') ?><div class="hint"><?= fdate($r['created_at'], 'h:i A') ?></div></td>
        <td>
          <a class="btn btn-gold btn-sm" href="https://wa.me/91<?= e($r['phone']) ?>" target="_blank">WhatsApp</a>
          <?php if (!$r['is_read']): ?><a class="btn btn-ghost btn-sm" href="?read=<?= (int)$r['id'] ?>">Mark Read</a><?php endif; ?>
          <a class="btn btn-danger btn-sm" href="?del=<?= (int)$r['id'] ?>" onclick="return confirm('Delete this inquiry?')">Delete</a>
        </td>
      </tr>
    <?php endforeach; ?>
    <?php if (!$rows): ?><tr><td colspan="5" style="color:var(--a-muted)">No inquiries received yet.</td></tr><?php endif; ?>
    </tbody>
  </table>
</div>
<?php include __DIR__ . '/inc/footer.php'; ?>

