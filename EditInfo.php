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
if (($word != "irdmof") && ($word != "sami.kabir") && ($word != "farhad.pathan") && ($word != "moinul.alam") && ($word != "anando.biswas")) {
	die("<br><br><br><center> Sorry! You are not authorized to view this page. </center>");	
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
footer {
  text-align: center;
  padding: 3px;
  background-color: DarkSalmon;
  color: black;
}
</style>  
<br>
<img src="Logo.png" alt="Logo" width="150" height="150" >
<h1 align = "center"> Internal Resources Division (IRD) </h1>  
<h2 align="center"> Time based Report (Individual) </h2>
<h4 align="right"> <a href = "ActionType.php"> Home</a> &nbsp; &nbsp; &nbsp; <a href = "Logout.php">Sign Out</a> </h4> 
</head>
<body style="background-color:powderblue;">
<br><br><br>
<center> 
<button onclick=" window.open('./EditIndividualByID.php', '_blank'); return false;">By Service ID</button>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<button onclick=" window.open('./EditIndividualByName.php', '_blank'); return false;">By Name</button> 
</center> <br> <br> <br> <br> <br> <br> <br>
<footer> 
  <p> <b> Developed by: ICT Cell, IRD. </b><br> <br>
  <a href="mailto:info@ird.gov.bd">info@ird.gov.bd</a>, <a href="tel:+8801817102041"> +880 1817102041</a>, <a href=http://www.ird.gov.bd target="_blank">www.ird.gov.bd</a> </p>
</footer>
</body>
</html>