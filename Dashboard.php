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
<h2 align="center"> Dashboard </h2>
<h4 align="right"> <a href = "ActionType.php"> Home</a> &nbsp; &nbsp; &nbsp; <a href = "Logout.php">Sign Out</a> </h4>

<script>
function validateForm() { 
  let x = document.forms["frm2"]["dashReq"].value;
  if (x == "") {
    alert("Country must be filled out");  
    return false;
  }
}
</script> 
 
</head>
<body style="background-color:powderblue;">
<br> <br> 
<form id="frm2" method="POST" action="ShowDashboard.php" onsubmit="return validateForm()"> 
  <center>Last &nbsp;<select name="dashReq" onchange='CheckPlace(this.value); ' text-align:center>  
   <option>5</option>
   <option>10</option>
   <option>15</option>
   <option>20</option>
   <option>30</option>
   <option>50</option>
   <option>75</option>	
   <option>100</option>
   <option>150</option>	  
   <option>200</option>
   <option>250</option>		  
   <option>300</option>
   <option>350</option>	  
   <option>400</option>
   <option>450</option>		  
   <option>500</option>

  </select> &nbsp; Entries  </center> <br>
  <center>

</center><br>
<center><input type="submit" value="View"> </center>
</form> 
<br> <br>
<footer>
  <p> <b> Developed by: ICT Cell, IRD. </b><br> <br>
  <a href="mailto:info@ird.gov.bd">info@ird.gov.bd</a>, +880 1817102041, <a href=http://www.ird.gov.bd>www.ird.gov.bd</a> </p>
</footer>
</body>
</html> 