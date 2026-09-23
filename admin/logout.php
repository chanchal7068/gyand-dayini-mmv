<?php
require_once __DIR__ . '/auth.php';
$_SESSION = [];
session_destroy();
redirect(url('admin/login.php'));
