<?php
require_once __DIR__ . '/auth.php';
require_admin();
require_once __DIR__ . '/entities.php';

$t = $_GET['t'] ?? '';
if (!isset($ENTITIES[$t])) { redirect(url('admin/index.php')); }

$en     = $ENTITIES[$t];
$table  = $en['table'];
$fields = $en['fields'];
$action = $_GET['a'] ?? 'list';
$id     = (int)($_GET['id'] ?? 0);
$flash  = ''; $flashType = 'ok';

/* ---------------- DELETE ---------------- */
if ($action === 'delete' && $id) {
    $pdo->prepare("DELETE FROM `$table` WHERE id=?")->execute([$id]);
    redirect(url("admin/manage.php?t=$t&msg=deleted"));
}

/* ---------------- SAVE ---------------- */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_check()) {
        $flash = 'Session expired. Please save again.'; $flashType = 'err';
    } else {
        $data = [];
        foreach ($fields as $name => $f) {
            switch ($f['type']) {
                case 'check':
                    $data[$name] = isset($_POST[$name]) ? 1 : 0;
                    break;
                case 'number':
                case 'parent':
                    $data[$name] = (int)($_POST[$name] ?? 0);
                    break;
                case 'date':
                    $data[$name] = ($_POST[$name] ?? '') !== '' ? $_POST[$name] : null;
                    break;
                case 'image':
                    $up = upload_file($name, $f['folder'] ?? 'pages');
                    if ($up) $data[$name] = $up;
                    elseif (isset($_POST[$name . '_existing'])) $data[$name] = $_POST[$name . '_existing'];
                    break;
                default:
                    $data[$name] = trim($_POST[$name] ?? '');
            }
        }
        if (isset($fields['slug']) && $data['slug'] === '') $data['slug'] = slugify($data['title'] ?? '');

        try {
            if ($id) {
                $sets = implode(', ', array_map(fn($k) => "`$k`=?", array_keys($data)));
                $st = $pdo->prepare("UPDATE `$table` SET $sets WHERE id=?");
                $st->execute([...array_values($data), $id]);
                $flash = 'Changes saved successfully.';
            } else {
                $cols = implode(',', array_map(fn($k) => "`$k`", array_keys($data)));
                $qs   = implode(',', array_fill(0, count($data), '?'));
                $st = $pdo->prepare("INSERT INTO `$table` ($cols) VALUES ($qs)");
                $st->execute(array_values($data));
                $id = (int)$pdo->lastInsertId();
                $flash = 'New entry added successfully.';
            }
            $action = 'edit';
        } catch (Exception $ex) {
            $flash = 'Could not save: ' . $ex->getMessage(); $flashType = 'err';
        }
    }
}

$adminTitle = $en['label'];
include __DIR__ . '/inc/header.php';

if (($_GET['msg'] ?? '') === 'deleted') { $flash = 'Entry deleted successfully.'; }

/* ---------------- FORM ---------------- */
if ($action === 'edit' || $action === 'new'):
    $row = [];
    if ($id) {
        $st = $pdo->prepare("SELECT * FROM `$table` WHERE id=? LIMIT 1");
        $st->execute([$id]);
        $row = $st->fetch() ?: [];
    }
?>
  <div class="topline">
    <h1><?= $id ? 'Edit' : 'Add New' ?> — <?= e($en['label']) ?></h1>
    <a class="btn btn-ghost btn-sm" href="<?= url("admin/manage.php?t=$t") ?>">← Back to List</a>
  </div>
  <?php if ($flash): ?><div class="msg <?= $flashType ?>"><?= e($flash) ?></div><?php endif; ?>

  <div class="panel">
    <form class="form" method="post" enctype="multipart/form-data" action="<?= url("admin/manage.php?t=$t&a=edit&id=$id") ?>">
      <?= csrf_field() ?>
      <?php foreach ($fields as $name => $f):
        $val = $row[$name] ?? ($f['default'] ?? ''); ?>
        <div>
          <?php if ($f['type'] === 'check'): ?>
            <div class="check">
              <input type="checkbox" id="f_<?= $name ?>" name="<?= $name ?>" value="1" <?= $val ? 'checked' : '' ?>>
              <label for="f_<?= $name ?>"><?= e($f['label']) ?></label>
            </div>

          <?php elseif ($f['type'] === 'html'): ?>
            <label for="f_<?= $name ?>"><?= e($f['label']) ?></label>
            <textarea class="html" id="f_<?= $name ?>" name="<?= $name ?>"><?= e($val) ?></textarea>
            <p class="hint">HTML formatting supported — &lt;p&gt; &lt;h3&gt; &lt;ul&gt;&lt;li&gt; &lt;table&gt; &lt;a href&gt; &lt;strong&gt;</p>

          <?php elseif ($f['type'] === 'textarea'): ?>
            <label for="f_<?= $name ?>"><?= e($f['label']) ?></label>
            <textarea id="f_<?= $name ?>" name="<?= $name ?>"><?= e($val) ?></textarea>

          <?php elseif ($f['type'] === 'image'): ?>
            <label><?= e($f['label']) ?></label>
            <?php if ($val): ?>
              <div class="thumb-now">
                <?php if (preg_match('/\.(jpe?g|png|gif|webp)$/i', $val)): ?>
                  <img src="<?= e(media($val)) ?>" alt="">
                <?php else: ?>
                  <a href="<?= e(media($val)) ?>" target="_blank">📎 View Current File</a>
                <?php endif; ?>
                <span class="hint">Selecting a new file will replace the current one</span>
              </div>
            <?php endif; ?>
            <input type="hidden" name="<?= $name ?>_existing" value="<?= e($val) ?>">
            <input type="file" name="<?= $name ?>">

          <?php elseif ($f['type'] === 'select'): ?>
            <label for="f_<?= $name ?>"><?= e($f['label']) ?></label>
            <select id="f_<?= $name ?>" name="<?= $name ?>">
              <?php foreach ($f['options'] as $o): ?>
                <option value="<?= e($o) ?>" <?= $val === $o ? 'selected' : '' ?>><?= e($o) ?></option>
              <?php endforeach; ?>
            </select>

          <?php elseif ($f['type'] === 'parent'): ?>
            <label for="f_<?= $name ?>"><?= e($f['label']) ?></label>
            <select id="f_<?= $name ?>" name="<?= $name ?>">
              <option value="0">— Top Level (Main Menu) —</option>
              <?php foreach ($pdo->query("SELECT id,title FROM menus WHERE parent_id=0 ORDER BY sort_order") as $p): ?>
                <option value="<?= (int)$p['id'] ?>" <?= (int)$val === (int)$p['id'] ? 'selected' : '' ?>><?= e($p['title']) ?></option>
              <?php endforeach; ?>
            </select>

          <?php else: ?>
            <label for="f_<?= $name ?>"><?= e($f['label']) ?></label>
            <input type="<?= $f['type'] === 'number' ? 'number' : ($f['type'] === 'date' ? 'date' : 'text') ?>"
                   id="f_<?= $name ?>" name="<?= $name ?>" value="<?= e($val) ?>" <?= !empty($f['req']) ? 'required' : '' ?>>
          <?php endif; ?>
          <?php if (!empty($f['hint'])): ?><p class="hint"><?= e($f['hint']) ?></p><?php endif; ?>
        </div>
      <?php endforeach; ?>

      <div style="display:flex;gap:12px;flex-wrap:wrap">
        <button class="btn btn-gold" type="submit">Save Changes</button>
        <a class="btn btn-ghost" href="<?= url("admin/manage.php?t=$t") ?>">Cancel</a>
        <?php if ($id): ?>
          <a class="btn btn-danger" href="<?= url("admin/manage.php?t=$t&a=delete&id=$id") ?>"
             onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
        <?php endif; ?>
      </div>
    </form>
  </div>

<?php else:
/* ---------------- LIST ---------------- */
  $q = trim($_GET['q'] ?? '');
  $order = $en['order'] ?? 'sort_order ASC, id ASC';
  if ($q) {
      $firstCol = $en['list'][0];
      $st = $pdo->prepare("SELECT * FROM `$table` WHERE `$firstCol` LIKE ? ORDER BY $order");
      $st->execute(['%' . $q . '%']);
      $rows = $st->fetchAll();
  } else {
      $rows = $pdo->query("SELECT * FROM `$table` ORDER BY $order")->fetchAll();
  }
?>
  <div class="topline">
    <h1><?= $en['icon'] ?> <?= e($en['label']) ?></h1>
    <span class="who">Welcome, <?= e($me['name'] ?: $me['username']) ?></span>
  </div>
  <?php if ($flash): ?><div class="msg <?= $flashType ?>"><?= e($flash) ?></div><?php endif; ?>

  <div class="toolbar">
    <a class="btn btn-gold" href="<?= url("admin/manage.php?t=$t&a=new") ?>">+ Add New</a>
    <form class="search" method="get">
      <input type="hidden" name="t" value="<?= e($t) ?>">
      <input type="text" name="q" placeholder="Search…" value="<?= e($q) ?>">
      <button class="btn btn-ghost btn-sm" type="submit">Search</button>
    </form>
  </div>

  <div class="panel" style="padding:6px 12px">
    <table class="grid">
      <thead><tr>
        <?php foreach ($en['list'] as $col): ?><th><?= e($fields[$col]['label'] ?? $col) ?></th><?php endforeach; ?>
        <th style="width:150px">Actions</th>
      </tr></thead>
      <tbody>
      <?php foreach ($rows as $r): ?>
        <tr>
          <?php foreach ($en['list'] as $col):
            $v = $r[$col] ?? ''; ?>
            <td>
              <?php if (($fields[$col]['type'] ?? '') === 'image' && $v): ?>
                <img src="<?= e(media($v)) ?>" alt="">
              <?php elseif (($fields[$col]['type'] ?? '') === 'check'): ?>
                <span class="badge <?= $v ? 'on' : 'off' ?>"><?= $v ? 'Yes' : 'No' ?></span>
              <?php elseif ($col === 'parent_id'): ?>
                <?= $v ? e($pdo->query("SELECT title FROM menus WHERE id=" . (int)$v)->fetchColumn()) : '—' ?>
              <?php else: ?>
                <?= e(mb_strimwidth((string)$v, 0, 70, '…')) ?>
              <?php endif; ?>
            </td>
          <?php endforeach; ?>
          <td>
            <a class="btn btn-ghost btn-sm" href="<?= url("admin/manage.php?t=$t&a=edit&id=" . (int)$r['id']) ?>">Edit</a>
            <a class="btn btn-danger btn-sm" href="<?= url("admin/manage.php?t=$t&a=delete&id=" . (int)$r['id']) ?>"
               onclick="return confirm('Delete this record?')">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>
      <?php if (!$rows): ?><tr><td colspan="9" style="color:var(--a-muted)">No entries found. Click "+ Add New" above to create one.</td></tr><?php endif; ?>
      </tbody>
    </table>
  </div>
<?php endif; ?>

<?php include __DIR__ . '/inc/footer.php'; ?>

