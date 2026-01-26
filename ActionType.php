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
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Home Page </title>
	<link rel = "shortcut icon" type = "image/jpeg" href = "./VisitIcon.jpeg">
	<style>
	.button {
  	background-color: #f44336;
  	color: white;
  	padding: 10px 15px;
  	text-align: center;
  	text-decoration: none;
  	display: inline-block;
  	font-size: 16px;
  	margin: 2px 2px;
  	cursor: pointer;
  	}
	.button2 {
  	background-color: #4CAF50;
  	color: white;
  	padding: 4px 4px;
  	text-align: center;
  	text-decoration: none;
  	display: inline-block;
  	font-size: 16px;
  	margin: 1px 1px;
  	cursor: pointer;
  	}  
	.button3 {
  	background-color: #FFFF00;
  	color: black;
  	padding: 4px 4px;
  	text-align: center;
  	text-decoration: none;
  	display: inline-block;
  	font-size: 16px;
  	margin: 1px 1px;
  	cursor: pointer;
  	}  	
footer {
  text-align: center;
  padding: 3px;
  background-color: DarkSalmon;
  color: black;
}
	</style>
<h4 align="center"> Welcome, <?php echo $word ?>! </h4>
<h4 align="right"> <a href = "Logout.php">Sign Out</a> </h4>

<center>
<img src="Logo.png" style="max-width:100%; height:auto; alt="Logo" width="150" height="80" > &nbsp; &nbsp; &nbsp; &nbsp;
<img src="VisitIcon.png" style="max-width:100%; height:auto; alt="Logo" width="150" height="140" >
</center>

<h2 align="center"> Welcome to Foreign Visit Tracker (FVT) of IRD! </h2> 
<h3 align="center"> It tracks Foreign Visits of all officials of IRD and its subordinate departments. </h3>
<h3 align="center"> <font color="green">Please select your <u> desired action</u> from the options below.</font> </h3>
</head>
<body style="background-color:powderblue;">  
<center>

<?php if (($word == "irdmof") || ($word == "sami.kabir") || ($word == "farhad.pathan") || ($word == "moinul.alam") || ($word == "anando.biswas")) : ?>
<button class="button2" onclick="window.location.href = './NewEntry.php';"> New Entry </button> 
&nbsp;&nbsp;
<?php endif ?>

<button class="button2" onclick="window.location.href = './ReportType.php';"> Time based Report (Individual) </button>
&nbsp;&nbsp;
<button class="button2" onclick="window.location.href = './ReportIndividualByOffice.php';"> Time based Report (Office) </button>
&nbsp;&nbsp;
<button class="button2" onclick="window.location.href = './ReportIndividualByCountry.php';"> Time based Report (Country) </button> 
&nbsp;&nbsp;
<button class="button2" onclick="window.location.href = './ReportIndividualByFund.php';"> Time based Report (Fund) </button> 
&nbsp;&nbsp;
<button class="button2" onclick="window.location.href = './ReportOverall.php';"> Individual Report (Overall) </button>
&nbsp;&nbsp;&nbsp;&nbsp; <br> <br>

<button class="button" onclick="window.location.href = './UnreportedCases.php';"> Show Unreported Cases </button>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <button class="button2" onclick="window.location.href = './PNV_ReportType.php';"> View Passport/NID </button>

<?php if (($word == "irdmof") || ($word == "sami.kabir") || ($word == "farhad.pathan") || ($word == "moinul.alam") || ($word == "anando.biswas")) : ?>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <button class="button3" onclick="window.location.href = './EditInfo.php';"> Edit Information </button>
<?php endif ?>

<?php if (($word == "irdmof") || ($word == "sami.kabir") || ($word == "farhad.pathan") || ($word == "moinul.alam") || ($word == "anando.biswas")) : ?>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <button class="button2" onclick="window.location.href = './PassportNID.php';"> Passport/NID </button>
<?php endif ?>

<?php if (($word == "irdmof") || ($word == "sami.kabir") || ($word == "farhad.pathan") || ($word == "moinul.alam") || ($word == "anando.biswas")) : ?>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <button class="button3" onclick="window.location.href = './Dashboard.php';"> Dashboard </button>
<?php endif ?>
 		 

</center> <br><br>
<footer>
  <p> <b> Developed by: ICT Cell, IRD. </b><br> <br>
  <a href="mailto:info@ird.gov.bd">info@ird.gov.bd</a>, <a href="tel:+8801817102041"> +880 1817102041</a>, <a href=http://www.ird.gov.bd target="_blank">www.ird.gov.bd</a> </p>
</footer>
</body>
</html>