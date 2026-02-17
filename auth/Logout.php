<?php
require_once("../init.php");

// Destroy session
$auth->logout();

// Create fresh session for flash message
session_start();
$_SESSION['msg'] = "You have successfully logged out.";
$_SESSION['msg_type'] = "success";

// Redirect to login
header("Location: login.php");
exit();
