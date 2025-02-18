<?php
// Enable error reporting for debugging (remove in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database configuration
if (!defined('DB_HOST')) {
    define('DB_HOST', '127.0.0.1'); // Use IP address for reliability
}
if (!defined('DB_USER')) {
    define('DB_USER', 'root'); // Database username
}
if (!defined('DB_PASS')) {
    define('DB_PASS', ''); // Database password
}
if (!defined('DB_NAME')) {
    define('DB_NAME', 'wartung_db'); // Database name
}
if (!defined('DB_PORT')) {
    define('DB_PORT', 3307); // Replace 3306 with your actual port if different
}

define('ENVIRONMENT', 'staging');

// Connect to the database
$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Define root directory
define('ROOT_DIR', __DIR__);

?>
