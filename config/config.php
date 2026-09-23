<?php
/* =========================================================
   Gyandayini Women's College — Site Configuration
   After uploading to production / Hostinger, update these 4 lines
   ========================================================= */


define('DB_HOST', 'localhost');
define('DB_NAME', 'gdmmv');     // Hostinger database name
define('DB_USER', 'root');     // Hostinger database user
define('DB_PASS', '');   // Hostinger database password

/* Site ka base URL — https ke saath, aakhir me slash nahi */
define('BASE_URL', 'http://localhost/gdmmv');

/* Timezone */
date_default_timezone_set('Asia/Kolkata');

/* Error display — live site par 0 rakhein */
define('DEBUG_MODE', 0);

if (DEBUG_MODE) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
    error_reporting(0);
}

define('UPLOAD_DIR', dirname(__DIR__) . '/uploads');
define('UPLOAD_URL', BASE_URL . '/uploads');

session_name('GDMMVSESS');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
