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
<img src="Logo.png" alt="Logo" width="150" height="150" >
<h1 align = "center"> Internal Resources Division (IRD) </h1>  
<h2 align="center"> Time based Report (Office-wise) </h2>
<h4 align="right"> <a href = "ActionType.php"> Home</a> &nbsp; &nbsp; &nbsp; <a href = "Logout.php">Sign Out</a> </h4>

<script>
function validateForm() { 
  let x = document.forms["frm2"]["officeReq"].value;
  if (x == "") {
    alert("Office must be filled out");
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
<body style="background-color:powderblue;">
<br>
<form id="frm2" method="POST" action="ShowOfficeReport.php" onsubmit="return validateForm()"> 
  <center>Office: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   <select name="officeReq" onchange='CheckPlace(this.value); ' text-align:center>  
  	<option value="IRD" >Internal Resources Division (IRD)</option>  
    <option value="NBR" >National Board of Revenue (NBR)</option>  
    <option value="NBRT" >National Board of Revenue (NBR) - Tax</option> 
    <option value="NBRC" >National Board of Revenue (NBR) - Customs</option> 
    <option value="NSD" >National Savings Department (NSD)</option>  
    <option value="TAT" >Taxes Appellate Tribunal (TAT)</option>  
    <option value="CEVT" >Customs, Excise and VAT Appellate Tribunal (CEVT)</option>
    <option value="Others" >Others</option>   

  </select> </center><br>
  <center>From: &nbsp;&nbsp;&nbsp; <input type="date" name="FromDate" id="FromDate">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; To: &nbsp;&nbsp;&nbsp; <input type="date" name="ToDate" id="ToDate"> </center><br>

</center><br>
<center><input type="submit" value="View Report"> </center>
</form>
<br> <br> <br> <br> <br>
<footer>
  <p> <b> Developed by: ICT Cell, IRD. </b><br> <br>
  <a href="mailto:info@ird.gov.bd">info@ird.gov.bd</a>, <a href="tel:+8801817102041"> +880 1817102041</a>, <a href=http://www.ird.gov.bd target="_blank">www.ird.gov.bd</a> </p>
</footer>
</body>
</html> 