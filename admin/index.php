<?php
$adminTitle = 'Dashboard';
require_once __DIR__ . '/auth.php';
require_admin();
include __DIR__ . '/inc/header.php';

$unread = count_rows('enquiries', 'is_read=0');
$recent = get_rows('enquiries', '1', 'created_at DESC', 6);
?>
<div class="topline">
  <h1>Dashboard</h1>
  <span class="who">Welcome, <?= e($me['name'] ?: $me['username']) ?> · <a href="<?= url('index.php') ?>" target="_blank">View Website ↗</a></span>
</div>

<div class="cards">
  <div class="kpi"><b><?= count_rows('pages') ?></b><span>Pages</span></div>
  <div class="kpi"><b><?= count_rows('notices') ?></b><span>Notices</span></div>
  <div class="kpi"><b><?= count_rows('gallery') ?></b><span>Gallery Photos</span></div>
  <div class="kpi"><b><?= count_rows('faculty') ?></b><span>Faculty</span></div>
  <div class="kpi"><b style="color:<?= $unread ? 'var(--a-rose)' : 'var(--a-gold)' ?>"><?= $unread ?></b><span>Unread Inquiries</span></div>
</div>

<div class="panel">
  <h2>Quick Actions</h2>
  <div style="display:flex;gap:10px;flex-wrap:wrap">
    <a class="btn btn-gold btn-sm" href="<?= url('admin/manage.php?t=notices&a=new') ?>">+ New Notice</a>
    <a class="btn btn-ghost btn-sm" href="<?= url('admin/manage.php?t=gallery&a=new') ?>">+ Add Photo</a>
    <a class="btn btn-ghost btn-sm" href="<?= url('admin/manage.php?t=events&a=new') ?>">+ New Event</a>
    <a class="btn btn-ghost btn-sm" href="<?= url('admin/manage.php?t=pages') ?>">Manage Pages</a>
    <a class="btn btn-ghost btn-sm" href="<?= url('admin/settings.php') ?>">Site Settings</a>
  </div>
</div>

<div class="panel">
  <h2>Recent Inquiries</h2>
  <table class="grid">
    <thead><tr><th>Name</th><th>Mobile</th><th>Type</th><th>Date</th><th>Action</th></tr></thead>
    <tbody>
    <?php foreach ($recent as $r): ?>
      <tr>
        <td><?= e($r['name']) ?> <?= $r['is_read'] ? '' : '<span class="badge off">NEW</span>' ?></td>
        <td><?= e($r['phone']) ?></td>
        <td><?= $r['type'] === 'admission' ? 'Admission' : 'Contact' ?></td>
        <td><?= fdate($r['created_at'], 'd M Y, h:i A') ?></td>
        <td><a class="btn btn-ghost btn-sm" href="<?= url('admin/enquiries.php#e' . (int)$r['id']) ?>">View</a></td>
      </tr>
    <?php endforeach; ?>
    <?php if (!$recent): ?><tr><td colspan="5" style="color:var(--a-muted)">No inquiries received yet.</td></tr><?php endif; ?>
    </tbody>
  </table>
</div>
<?php include __DIR__ . '/inc/footer.php'; ?>

