<?php
// init.php
error_reporting(E_ALL ^ E_NOTICE);
session_start();

// Database config
// include("config.php");
require_once "config.php";
// Include helper classes
// include("services/auth.php");
require_once "services/auth.php";
// Create Auth instance
$auth = new Auth($db);
?>
