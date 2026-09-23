<?php
require_once dirname(__DIR__) . '/config/db.php';

/* ---------- mbstring polyfills (agar server par mbstring off ho) ---------- */

if (!function_exists('mb_strlen')) {
    function mb_strlen($s, $enc = null) { return preg_match_all('/./us', (string)$s); }
}
if (!function_exists('mb_substr')) {
    function mb_substr($s, $start, $len = null, $enc = null) {
        preg_match_all('/./us', (string)$s, $m);
        $sl = array_slice($m[0], $start, $len);
        return implode('', $sl);
    }
}
if (!function_exists('mb_strimwidth')) {
    function mb_strimwidth($s, $start, $width, $trim = '', $enc = null) {
        $s = mb_substr((string)$s, $start);
        return mb_strlen($s) > $width ? mb_substr($s, 0, $width) . $trim : $s;
    }
}

/* ---------- Basic helpers ---------- */

function e($str) { return htmlspecialchars((string)$str, ENT_QUOTES, 'UTF-8'); }

function url($path = '') { return BASE_URL . '/' . ltrim($path, '/'); }

function redirect($to) { header('Location: ' . $to); exit; }

function slugify($text) {
    $text = trim($text);
    $text = preg_replace('~[^\pL\pN\d]+~u', '-', $text);
    $text = trim($text, '-');
    $text = strtolower($text);
    return $text !== '' ? $text : 'page-' . time();
}

/* Image path resolver: DB me full URL bhi ho sakta hai, uploads ka naam bhi */
function media($path, $fallback = 'assets/img/placeholder.jpg') {
    if (!$path) return url($fallback);
    if (preg_match('~^https?://~i', $path)) return $path;
    if (strpos($path, 'assets/') === 0) return url($path);
    return UPLOAD_URL . '/' . ltrim($path, '/');
}

/* ---------- Settings ---------- */

function settings() {
    global $pdo;
    static $cache = null;
    if ($cache === null) {
        $cache = [];
        try {
            foreach ($pdo->query("SELECT skey, svalue FROM settings") as $r) {
                $cache[$r['skey']] = $r['svalue'];
            }
        } catch (Exception $ex) { $cache = []; }
    }
    return $cache;
}

function setting($key, $default = '') {
    $s = settings();
    return isset($s[$key]) && $s[$key] !== '' ? $s[$key] : $default;
}

/* ---------- Menu ---------- */

function menu_tree() {
    global $pdo;
    static $tree = null;
    if ($tree !== null) return $tree;

    $rows = $pdo->query("SELECT * FROM menus WHERE is_active=1 ORDER BY sort_order ASC, id ASC")->fetchAll();
    $byParent = [];
    foreach ($rows as $r) { $byParent[(int)$r['parent_id']][] = $r; }
    $tree = [];
    foreach (($byParent[0] ?? []) as $top) {
        $top['children'] = $byParent[(int)$top['id']] ?? [];
        $tree[] = $top;
    }
    return $tree;
}

function menu_link($item) {
    $u = trim($item['url']);
    if ($u === '' || $u === '#') return 'javascript:void(0);';
    if (preg_match('~^https?://~i', $u)) return $u;
    return url($u);
}

/* ---------- Content fetchers ---------- */

function get_page($slug) {
    global $pdo;
    $st = $pdo->prepare("SELECT * FROM pages WHERE slug=? AND is_active=1 LIMIT 1");
    $st->execute([$slug]);
    return $st->fetch();
}

function get_rows($table, $where = 'is_active=1', $order = 'sort_order ASC, id ASC', $limit = null) {
    global $pdo;
    $sql = "SELECT * FROM `$table`" . ($where ? " WHERE $where" : '') .
           ($order ? " ORDER BY $order" : '') . ($limit ? " LIMIT $limit" : '');
    try { return $pdo->query($sql)->fetchAll(); } catch (Exception $ex) { return []; }
}

function count_rows($table, $where = '1') {
    global $pdo;
    try { return (int)$pdo->query("SELECT COUNT(*) FROM `$table` WHERE $where")->fetchColumn(); }
    catch (Exception $ex) { return 0; }
}

/* ---------- Upload ---------- */

function upload_file($field, $folder = 'pages') {
    if (empty($_FILES[$field]['name'])) return '';
    $f = $_FILES[$field];
    if ($f['error'] !== UPLOAD_ERR_OK) return '';

    $allowed = ['jpg','jpeg','png','gif','webp','pdf','doc','docx','xls','xlsx'];
    $ext = strtolower(pathinfo($f['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowed, true)) return '';
    if ($f['size'] > 12 * 1024 * 1024) return '';

    $dir = UPLOAD_DIR . '/' . $folder;
    if (!is_dir($dir)) @mkdir($dir, 0755, true);

    $name = slugify(pathinfo($f['name'], PATHINFO_FILENAME)) . '-' . date('YmdHis') . '.' . $ext;
    if (move_uploaded_file($f['tmp_name'], $dir . '/' . $name)) {
        return $folder . '/' . $name;
    }
    return '';
}

/* ---------- CSRF ---------- */

function csrf_token() {
    if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(24));
    return $_SESSION['csrf'];
}

function csrf_field() { return '<input type="hidden" name="_token" value="' . csrf_token() . '">'; }

function csrf_check() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') return true;
    return isset($_POST['_token']) && hash_equals($_SESSION['csrf'] ?? '', $_POST['_token']);
}

/* ---------- Misc ---------- */

function fdate($d, $fmt = 'd M Y') { return $d ? date($fmt, strtotime($d)) : ''; }

function excerpt($html, $len = 220) {
    $t = trim(preg_replace('/\s+/u', ' ', strip_tags($html)));
    return mb_strlen($t) > $len ? mb_substr($t, 0, $len) . '…' : $t;
}

function is_current($slug) {
    $cur = $_GET['slug'] ?? basename($_SERVER['PHP_SELF'], '.php');
    return $cur === $slug;
}
