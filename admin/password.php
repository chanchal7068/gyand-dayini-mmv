<?php
$adminTitle = 'Change Password';
require_once __DIR__ . '/auth.php';
require_admin();

$flash = ''; $type = 'ok';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && csrf_check()) {
    $old = $_POST['old'] ?? ''; $new = $_POST['new'] ?? ''; $again = $_POST['again'] ?? '';
    $st = $pdo->prepare("SELECT * FROM admins WHERE id=?");
    $st->execute([$me_id = admin_user()['id']]);
    $row = $st->fetch();

    if (!$row || !password_verify($old, $row['password'])) { $flash = 'Current password is incorrect.'; $type = 'err'; }
    elseif (strlen($new) < 8) { $flash = 'New password must be at least 8 characters long.'; $type = 'err'; }
    elseif ($new !== $again) { $flash = 'New passwords do not match.'; $type = 'err'; }
    else {
        $pdo->prepare("UPDATE admins SET password=? WHERE id=?")
            ->execute([password_hash($new, PASSWORD_DEFAULT), $me_id]);
        $flash = 'Password updated successfully.';
    }
}
include __DIR__ . '/inc/header.php';
?>
<div class="topline"><h1>🔒 Change Password</h1></div>
<?php if ($flash): ?><div class="msg <?= $type ?>"><?= e($flash) ?></div><?php endif; ?>
<div class="panel" style="max-width:480px">
  <form class="form" method="post">
    <?= csrf_field() ?>
    <div><label>Current Password</label><input type="password" name="old" required></div>
    <div><label>New Password</label><input type="password" name="new" required></div>
    <div><label>Confirm New Password</label><input type="password" name="again" required></div>
    <button class="btn btn-gold" type="submit">Update Password</button>
  </form>
</div>
<?php include __DIR__ . '/inc/footer.php'; ?>

