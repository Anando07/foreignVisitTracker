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
<h2 align="center"> Passport and National Identity (NID) Information </h2>
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
<th>Passport No</th>
<th>Passport Expiry Date</th>
<th>NID</th>
<th>Entered by</th>
<th>Action</th>
</tr> 
<?php 
include("config.php");
//$TrackingID = $_POST['TrackingID'];
$idReq = $_POST['idReq']; 

if($idReq == ""){
	die("<br><br><center> Sorry. Service ID field cannot be left empty. <center><br><br>");
}

$link = "PN_NewEntry.php?edit=";  
$idReqEncoded = urlencode($idReq);
$idReqDecoded = urldecode($idReq);
echo '<a href=PN_pdfReportIndividualByID.php?idReq='.$idReqEncoded.' target="_blank"> <p style="text-align:center"> Download Report </p></a>'; 

$sql1 = "SELECT * from PassNID WHERE ServiceID = " . $idReq;
 
$result = mysqli_query($db,$sql1);

$count = mysqli_num_rows($result);

if ($result->num_rows > 0) {
    // output data of each row
    //echo "<br> <br><br><br>";
    echo "<center> <b> <u> Service ID Search Result (". $idReq . ")</u> </b> </center> <br>"; 
    echo "<center> Number of matches found: <b>". $count . " </b> </center> <br>";

    while($row = $result->fetch_assoc()) {
         echo "<tr><td>" . $row["ServiceID"]. "<br>(" . $row["Cadre"]. ")" . "</td><td>" . $row["Name"]. "</td><td>" . $row["Designation"] . ", " . $row["Office"] . "<br>(Grade-" . $row["Grade"] . ") " . "</td><td>" . $row["Passport"] . "</td><td>" . $row["ExpiryDate"] . "</td><td>" . $row["NID_Num"] . "</td><td>" . $row["Uploader"] .  "</td><td> <a href = '".$link. $row["ID"] ."'> Edit </a> </td></tr>";      
    } 
     echo "</td></tr></table>"; 
} else {
    echo "<br> <center> <b> 0 results found. <b> </center> <br>";
}
?>
</table>

</body>
</html>