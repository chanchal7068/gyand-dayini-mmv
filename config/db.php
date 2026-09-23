<?php
require_once __DIR__ . '/config.php';

try {
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]);
    $pdo->exec("SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci");
} catch (PDOException $e) {
    if (DEBUG_MODE) {
        die('Database connection failed: ' . $e->getMessage());
    }
    die('<div style="font-family:system-ui;padding:40px;text-align:center">
        <h2>Database se connection nahi ho paya</h2>
        <p>Kripya <code>config/config.php</code> me database ki details check karein.</p></div>');
}
