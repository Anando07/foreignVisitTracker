<?php
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
<h2 align="center"> Time based Report (Fund-wise) </h2>
<h4 align="right"> <a href = "ActionType.php"> Home</a> &nbsp; &nbsp; &nbsp; <a href = "Logout.php">Sign Out</a> </h4>

<script>
function validateForm() { 
  let x = document.forms["frm2"]["fundReq"].value;
  if (x == "") {
    alert("Fund must be selected");  
    return false;
  }
  let a = document.forms["frm2"]["officeReq"].value;
  if (a == "") {
    alert("Office must be selected");  
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

<form id="frm2" method="POST" action="ShowFundReport.php" onsubmit="return validateForm()"> 
 <center> Fund: &nbsp;&nbsp;&nbsp;   <select name="fundReq" text-align:center>  
    <option value="Self">Self</option>
    <option value="GoB">GoB</option>
    <option value="Project">Project</option>
    <option value="IO">International Organisations</option>
    <option value="FS">Foreign Scholarship</option> 
    <option value="BS">Bangladeshi Scholarship</option> 
    <option value="University">University</option> 
    <option value="Employer">Employer</option>
    <option value="Others">Others</option>
  </select> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br> <br>
    Office: &nbsp;&nbsp;&nbsp; <select name="officeReq" onchange='CheckPlace(this.value); ' text-align:center>  
  	<option value="IRD" >Internal Resources Division (IRD)</option>  
    <option value="NBR" >National Board of Revenue (NBR)</option>  
    <option value="NSD" >National Savings Department (NSD)</option>  
    <option value="TAT" >Taxes Appellate Tribunal (TAT)</option>  
    <option value="CEVT" >Customs, Excise and VAT Appellate Tribunal (CEVT)</option>
    <option value="Others" >Others</option>   

  </select> </center><br>
  <center>From: &nbsp;&nbsp;&nbsp; <input type="date" name="FromDate" id="FromDate"> 
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; To: &nbsp;&nbsp;&nbsp; <input type="date" name="ToDate" id="ToDate"> </center><br>

</center><br>
<center><input type="submit" value="View Report"> </center>
</form>  <br> <br>
<footer>
  <p> <b> Developed by: ICT Cell, IRD. </b><br> <br>
  <a href="mailto:info@ird.gov.bd">info@ird.gov.bd</a>, +880 1817102041, <a href=http://www.ird.gov.bd>www.ird.gov.bd</a> </p>
</footer>
</body>
</html> 