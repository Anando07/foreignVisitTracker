<?php
// config.php
define('DB_USERNAME', 'root'); 
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');
define('DB_DATABASE', 'irdvisit');

$db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($db->connect_error) {
    die("Database connection failed: " . $db->connect_error);
}

$db->set_charset("utf8mb4");