<?php
error_reporting (E_ALL ^ E_NOTICE);
include("config.php");
session_start();
if(isset($_SESSION['login_user'])) {
    $word = $_SESSION['login_user'];
    //echo "Welcome, " . $word; 
} else {
    die("<br><br><center>You are presently logged out. Please log in to access this page. <br> <br> <a href = ./Login.php> Click here to log in </a></center>");
}
?>
<!DOCTYPE html>
<html>
<head>

<title> Passport/NID </title>
<link rel = "shortcut icon" type = "image/jpeg" href = "./VisitIcon.jpeg">

<style>
img {
  display: block;
  margin-left: auto;
  margin-right: auto; 
}  
</style>  
<br>
<img src="Logo.png" alt="Logo" width="150" height="150" >
<h1 align = "center"> Internal Resources Division (IRD) </h1>  
<h2 align="center"> View and Edit Passport and National Identity (NID) Information </h2>
<h4 align="right"> <a href = "ActionType.php"> Home</a> &nbsp; &nbsp; &nbsp; <a href = "Logout.php">Sign Out</a> </h4> 
</head>
<body>
<br><br><br>
<center> 
<button onclick=" window.open('./PN_ReportIndividualByID.php', '_blank'); return false;">By Service ID</button>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<button onclick=" window.open('./PN_ReportIndividualByName.php', '_blank'); return false;">By Name</button> 
</center>

</body>
</html>