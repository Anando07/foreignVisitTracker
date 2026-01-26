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

<title> Individual Report </title>
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
<h2 align="center"> Passport and National Identity (NID) Information </h2> 
<h4 align="right"> <a href = "ActionType.php"> Home</a> &nbsp; &nbsp; &nbsp; <a href = "Logout.php">Sign Out</a> </h4>

<script>
function validateForm() { 
  let x = document.forms["frm2"]["nameReq"].value;
  if (x == "") {
    alert("Name must be filled out");
    return false;
  }
}
</script>

</head>
<body>
<br> <br> <br> <br>
<form id="frm2" method="POST" action="PN_ShowNameReport.php" onsubmit="return validateForm()">
  <div class="autocomplete-container">
  <center>Name: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="nameReq" id="nameReq" size="50" maxlength="50"> </center>
</div>
<br>
<br>

<center><input type="submit" value="View Infomation"> </center>
</form>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script type="text/javascript" src="frontend-script-pn.js"></script>

</body>
</html> 