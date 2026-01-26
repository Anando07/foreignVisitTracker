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
<title> Edit Information </title>
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
<h2 align="center"> Time based Report (Individual) </h2>
<h4 align="right"> <a href = "ActionType.php"> Home</a> &nbsp; &nbsp; &nbsp; <a href = "Logout.php">Sign Out</a> </h4>

<script>
function validateForm() {
  let x = document.forms["frm2"]["idReq"].value;
  if (x == "") {
    alert("Service ID must be filled out");
    return false;
  }
  let y = document.forms["frm2"]["FromDate"].value;
  if (y == "") {
  	alert("From Date must be filled out"); 
  	return false;
  }
  let z = document.forms["frm2"]["ToDate"].value;
  if (z == "") {
  	alert("To Date must be filled out");
  	return false;
  }
}
</script>

</head>
<body>
<br> <br> <br> <br>
<form id="frm2" method="POST" action="ShowIDEdit.php" onsubmit="return validateForm()">
  <center>Service ID: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="idReq" size="50" maxlength="50"> </center><br>
  <center>From: &nbsp;&nbsp;&nbsp; <input type="date" name="FromDate" id="FromDate">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; To: &nbsp;&nbsp;&nbsp; <input type="date" name="ToDate" id="ToDate"> </center><br>

</center><br>
<center><input type="submit" value="View Report"> </center>
</form>

</body>
</html> 