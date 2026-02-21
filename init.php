<?php
// init.php
error_reporting(E_ALL ^ E_NOTICE);
session_start();

// Database config
require_once "config.php";

// Include Auth
require_once "services/Auth.php";

// Create Auth instance
$auth = new Auth($db);