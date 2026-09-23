<?php
require_once __DIR__ . '/auth.php';
if (admin_user()) redirect(url('admin/index.php'));

$err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check()) {
        $err = 'Session expired. Please try again.';
    } else {
        $u = trim($_POST['username'] ?? '');
        $p = $_POST['password'] ?? '';
        $st = $pdo->prepare("SELECT * FROM admins WHERE username=? LIMIT 1");
        $st->execute([$u]);
        $row = $st->fetch();
        if ($row && password_verify($p, $row['password'])) {
            session_regenerate_id(true);
            $_SESSION['admin'] = ['id' => $row['id'], 'username' => $row['username'], 'name' => $row['full_name']];
            $pdo->prepare("UPDATE admins SET last_login=NOW() WHERE id=?")->execute([$row['id']]);
            redirect(url('admin/index.php'));
        }
        $err = 'Invalid username or password.';
    }
}
?>
<!DOCTYPE html><html lang="en"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Admin Login — <?= e(setting('site_name_en')) ?></title>
<link href="https://fonts.googleapis.com/css2?family=Mukta:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= url('admin/assets/admin.css') ?>">
</head><body>
<div class="login-wrap">
  <form class="login-card" method="post">
    <?= csrf_field() ?>
    <img src="<?= e(media(setting('logo'))) ?>" alt="<?= e(setting('site_name_en')) ?>">
    <h1><?= e(setting('site_name_en')) ?></h1>
    <p class="sub">Website Administration Portal</p>
    <?php if ($err): ?><div class="msg err"><?= e($err) ?></div><?php endif; ?>
    <div style="margin-bottom:14px"><label>Username</label><input type="text" name="username" required autofocus></div>
    <div style="margin-bottom:20px"><label>Password</label><input type="password" name="password" required></div>
    <button class="btn btn-gold" style="width:100%;justify-content:center" type="submit">Sign In</button>
    <p style="text-align:center;margin:18px 0 0"><a href="<?= url('index.php') ?>" style="font-size:.85rem">← Return to Website</a></p>
  </form>
</div>
</body></html>
