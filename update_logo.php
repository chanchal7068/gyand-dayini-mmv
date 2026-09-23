<?php
require_once __DIR__ . '/includes/functions.php';
$pdo->prepare("UPDATE settings SET svalue = ? WHERE skey = ?")->execute(['assets/img/college-building.jpg', 'logo_large']);
echo "Updated logo_large to assets/img/college-building.jpg\n";
