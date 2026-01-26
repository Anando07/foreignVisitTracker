<?php 
DEFINE('DB_USERNAME', 'root'); 
DEFINE('DB_PASSWORD', '');
DEFINE('DB_HOST', 'localhost');
//DEFINE('DB_DATABASE', 'ForeignVisitTrackerIRD');
DEFINE('DB_DATABASE', 'irdvisit');

$db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
?>