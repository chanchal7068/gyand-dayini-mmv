<?php
require_once dirname(__DIR__) . '/includes/functions.php';

function admin_user() { return $_SESSION['admin'] ?? null; }

function require_admin() {
    if (!admin_user()) {
        redirect(url('admin/login.php'));
    }
}
