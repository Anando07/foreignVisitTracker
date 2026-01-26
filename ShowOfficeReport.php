<?php
error_reporting (E_ALL ^ E_NOTICE);
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
</style>  
<br> 
<img src="Logo.png" alt="Logo" width="150" height="150" >
<h1 align = "center"> Internal Resources Division (IRD) </h1>   
<h2 align="center"> Time based Report (Office-wise) </h2>
<h4 align="right"> <a href = "ActionType.php"> Home</a> &nbsp; &nbsp; &nbsp; <a href = "Logout.php">Sign Out</a> </h4>

<style>
table {
border:2px solid black;
width: 100%;
color: #588c7e;
font-family: monospace;
font-size: 15px;
text-align: center;
}
th {
	border:2px solid black;
background-color: #588c7e;
color: black;
}
tr:nth-child(even) {border:2px solid black; background-color: #f2f2f2}
td {
	border:2px solid black;
}
</style>

</head>
<body>
<table>
<tr>
<th>ID</th>
<th>Name</th>
<th>Designation</th>
<th>Workplace</th>
<th>Country</th>
<th>Funding</th>
<th>Purpose</th>
<th>Start Date <br> (Actual Departure)</th>
<th>End Date <br> (Actual Arrival)</th>
<th>Days</th>
<th>GO</th>
<th>Uploaded by</th>
</tr> 
<?php 
include("config.php");
//$TrackingID = $_POST['TrackingID'];
$officeReq = $_POST['officeReq']; 
$startDate = $_POST['FromDate'];
$endDate = $_POST['ToDate'];

if($officeReq == ""){
	die("<br><br><center> Sorry. Office field cannot be left empty. <center><br><br>");
}

if($startDate == ""){
	die("<br><br><center> Sorry. From Date field cannot be left empty. <center><br><br>");
}

if($endDate == ""){
	die("<br><br><center> Sorry. To Date field cannot be left empty. <center><br><br>");
} 

$dateS = strtotime($startDate); 
$dateE = strtotime($endDate);
$dateDiff = ($dateE - $dateS);
$daysInitial = round(($dateDiff)/(60*60*24)); 
$days = $daysInitial + 1;

if($days < 0){
	die("<br><br><center> Sorry. To Date has to be later than From Date. <center><br><br>");
}  

$dateSq = date('Y-m-d',$dateS);
$dateEq = date('Y-m-d',$dateE);

$link = "NewEntry.php?edit=";  
$officeReqEncoded = urlencode($officeReq);
$officeReqDecoded = urldecode($officeReq);
//echo '<a href=pdfReportIndividualByOffice.php?officeReq='.$officeReqEncoded.'&FromDate='.$startDate.'&ToDate='.$endDate.' target="_blank"> <p style="text-align:center"> Download Report </p></a>'; 
//echo '<a href = uploads.html?id='.$nameReqEncoded.'> Link </a>';

if($officeReq == "NBRT"){
	$ofct = "NBR";
	$cadt = "Tax";
	$sql1 = "SELECT * from ForeignVisit WHERE Office = '" . $ofct . "' AND Cadre = '" . $cadt . "' ORDER BY StartDate desc";
}

else if($officeReq == "NBRC"){
	$ofcc = "NBR";
	$cadc = "Customs";
	$sql1 = "SELECT * from ForeignVisit WHERE Office = '" . $ofcc . "' AND Cadre = '" . $cadc . "' ORDER BY StartDate desc";
}
else{ 
	echo '<a href=pdfReportIndividualByOffice.php?officeReq='.$officeReqEncoded.'&FromDate='.$startDate.'&ToDate='.$endDate.' target="_blank"> <p style="text-align:center"> Download Report </p></a>'; 
	$sql1 = "SELECT * from ForeignVisit WHERE Office = '" . $officeReq . "' ORDER BY StartDate desc"; 
}  

$result = mysqli_query($db,$sql1);
//$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
//$active = $row['active']; 
//$count = mysqli_num_rows($result); 

if ($result->num_rows > 0) {
    // output data of each row  
    //echo "<br>";
    echo "<center> <b> <u> Office Search Result (" . $officeReq . ")" . "</u> </b> </center> <br>";
    echo "IO = International Organisation, FS = Foreign Scholarship, BS = Bangladeshi Scholarship, EBL = Ex-Bangladesh Leave, EL = Extraordinary Leave <br> <br>";
    while($row = $result->fetch_assoc()) {
    	$dateDBS = strtotime($row["StartDate"]); 
    	$dateDBSq = date('Y-m-d',$dateDBS);
      $sql2 = "SELECT * from RevisedGO WHERE ID = " . $row["ID"]; 
      $result2 = mysqli_query($db,$sql2);  

    	if(($dateDBSq >= $dateSq) && ($dateDBSq <= $dateEq)) {
          echo "<tr><td>" . $row["ServiceID"]. "<br>(" . $row["Cadre"]. ")" . "</td><td>" . $row["Name"]. "</td><td>" . $row["Designation"] . "<br>(Grade-" . $row["Grade"] . ") " . "</td><td>" . $row["Workplace"] . ", " . $row["Office"] . "</td><td>" . $row["DestinationCountry"] . "</td><td>" . $row["FundingSource"] . "</td><td>" . $row["Purpose"] . "</td><td>" . $row["StartDate"]. "<br>(";

          if ($row["ActualDeparture"] == "0000-00-00") {
            echo "Unreported)" . "</td><td>" . $row["EndDate"] . "<br>(";

            if ($row["ActualArrival"] == "0000-00-00") {
              echo "Unreported)" . "</td><td>" . $row["Days"] . "</td><td>" . '<a href="./uploads/'.$row["GO"].'" target="_blank"> Click </a>';
            }
            else if ($row["ActualArrival"] != "0000-00-00") {
              echo $row["ActualArrival"] . ")" . "</td><td>" . $row["Days"] . "</td><td>" . '<a href="./uploads/'.$row["GO"].'" target="_blank"> Click </a>';
            } 
          }

          else if ($row["ActualDeparture"] != "0000-00-00") {
            echo $row["ActualDeparture"]. ")" . "</td><td>" . $row["EndDate"] . "<br>(" . $row["ActualArrival"]. ")" . "</td><td>" . $row["Days"] . "</td><td>" . '<a href="./uploads/'.$row["GO"].'" target="_blank"> Click </a>';
          }
            
          if($result2->num_rows > 0) {
            while($row2 = $result2->fetch_assoc()) { 
                //echo "<br> Click"; 
                echo "<br>". '<a href="./uploads/'.$row2["RevGO"].'" target="_blank"> Click</a>'; 
              }
              //echo "</td><td> <a href = '".$link. $row["ID"] ."'> Edit </a> </td></tr>";                
            }
            echo "</td><td>". $row["Uploader"] . "</td>";     
         }
         //
      } 
     echo "</td></tr></table>"; 
} else {
    echo "<br> <center> <b> 0 results found. <b> </center> <br>";
}
?>
</table>

</body>
</html>