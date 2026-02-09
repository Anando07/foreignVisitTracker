<?php 
// Include the database configuration file  
include("config.php");
session_start();
if(isset($_SESSION['login_user'])) {
    $word = $_SESSION['login_user'];
    //echo "Welcome, " . $word; 
} else {
    die("<br><br><center>You are presently logged out. Please log in to access this page. <br> <br> <a href = ./Login.php> Click here to log in </a></center>");
}

$serviceID = $_POST['serviceID'];

if ($_POST['update'] == false){ 
   $cadre = $_POST['cadreName'];//cadreOthers
	
	if($cadre == "Other Cadres") {
    		$cadre = $_POST['cadreOthers'];
	}
}

if ($_POST['update'] == true){ 
$cadreEdit = $_POST['cadreEdit'];//cadreOthers
}

$office = $_POST['office'];
$name = $_POST['name'];

if ($_POST['update'] == true){   
    $designation = $_POST['designation'];
    /*if($designation == "Others") {
        $designation = $_POST['desigOthers']; 
    }*/
}

if ($_POST['update'] == false){    
    $designation2 = $_POST['designation2'];
    if($designation2 == "Others") {
        $designation2 = $_POST['desigOthers']; 
        //echo $designation2;
    } 
}  

//$designation2 = $_POST['designation2'];
$grade = $_POST['grade'];
$workplace = $_POST['workplace']; 
$destCountry = $_POST['destCountry'];   
$startDate = $_POST['StartDate']; 
$endDate = $_POST['EndDate'];

$actualDeparture = $_POST['ActualDeparture']; 
$actualArrival = $_POST['ActualArrival']; 

$purpose = $_POST['Purpose'];
$fundingSource = $_POST['FundingSource'];

$dateS = strtotime($startDate); 
$dateE = strtotime($endDate);
$dateDiff = ($dateE - $dateS); 
$daysInitial = round(($dateDiff)/(60*60*24)); 
$days = $daysInitial + 1;
//$days = 5;
//$GO = $_POST['myfile'];  

if($serviceID==""){
    die("<br><br><center>Sorry. <b> The Service ID field cannot be left empty. </b> Please resubmit with valid input. <br> <br> <a href = ./NewEntry.php> Click here to retry </a></center>");
}

if ($_POST['update'] == true){   
    if($cadreEdit==""){
        die("<br><br><center>Sorry. <b>The Cadre field cannot be left empty. </b> Please resubmit with valid input. <br> <br> <a href = ./NewEntry.php> Click here to retry </a></center>");
    }
}
if ($_POST['update'] == false){   
    if($cadre==""){
        die("<br><br><center>Sorry. <b>The Cadre field cannot be left empty. </b> Please resubmit with valid input. <br> <br> <a href = ./NewEntry.php> Click here to retry </a></center>"); 
    }
}

if($name==""){
    die("<br><br><center>Sorry. <b>The Name field cannot be left empty. </b> Please resubmit with valid input. <br> <br> <a href = ./NewEntry.php> Click here to retry </a></center>");
}
if ($_POST['update'] == true){   
    if($designation==""){
        die("<br><br><center>Sorry. <b>The Designation field cannot be left empty. </b> Please resubmit with valid input. <br> <br> <a href = ./NewEntry.php> Click here to retry </a></center>");
    }
}
if ($_POST['update'] == false){   
    if($designation2==""){
        die("<br><br><center>Sorry. <b>The Designation field cannot be left empty. </b> Please resubmit with valid input. <br> <br> <a href = ./NewEntry.php> Click here to retry </a></center>"); 
    }
}
if($workplace==""){
    die("<br><br><center>Sorry. <b>The Workplace field cannot be left empty. </b> Please resubmit with valid input. <br> <br> <a href = ./NewEntry.php> Click here to retry </a></center>");
}
if($destCountry==""){
    die("<br><br><center>Sorry. <b>The Destination Country field cannot be left empty. </b> Please resubmit with valid input. <br> <br> <a href = ./NewEntry.php> Click here to retry </a></center>");
}
if($startDate==""){
    die("<br><br><center>Sorry. <b>The Start Date field cannot be left empty. </b> Please resubmit with valid input. <br> <br> <a href = ./NewEntry.php> Click here to retry </a></center>");
}
if($endDate==""){
    die("<br><br><center>Sorry. <b>The End Date field cannot be left empty. </b> Please resubmit with valid input. <br> <br> <a href = ./NewEntry.php> Click here to retry </a></center>");
}
if($purpose==""){
    die("<br><br><center>Sorry. <b>The Purpose of visit cannot be left empty. </b> Please resubmit with valid input. <br> <br> <a href = ./NewEntry.php> Click here to retry </a></center>");
}
if($days < 0){
     echo "<br> <br> <br>";
     echo '<html> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <img src="cross.png" alt = "Success" width="150" height="150" > </html>'; 
    die("<br><br><center>Sorry. <b>End Date cannot be earlier than the Start Date. </b> Please resubmit with valid input. <br> <br> <a href = ./NewEntry.php> Click here to retry </a></center>");
}
if (!preg_match("/^[a-zA-Z. ]*$/",$name)) { //!preg_match("/^[a-zA-Z ]*$/",$name)
  //$nameErr = "Only letters and white space allowed";
     echo "<br> <br> <br>";
     echo '<html> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <img src="cross.png" alt = "Success" width="150" height="150" > </html>';
    die("<br><br><center>Sorry. <b>Only letters and white space are allowed in the Name field.</b> Please resubmit with valid input. <br> <br> <a href = ./NewEntry.php> Click here to retry </a></center>");
} 

if(($actualDeparture != "") && ($actualDeparture != "")) {
    
    $dateAS = strtotime($actualDeparture); 
    $dateAE = strtotime($actualArrival);
    $dateADiff = ($dateAE - $dateAS); 
    $daysAInitial = round(($dateADiff)/(60*60*24)); 
    $daysA = $daysAInitial + 1;   
    
    if($daysA < 0) {
        
        die("<br><br><center>Sorry. <b>Actual Arrival cannot be earlier than the Actual Departure. </b> Please resubmit with valid input. <br> <br> <a href = ./NewEntry.php> Click here to retry </a></center>");     
    }
    
}
  
//$days=date_diff($startDate,$endDate);



$t = time();
$targetDir = "uploads/";
//$fileName = "xyz.pdf";
$fileName = basename($_FILES["file"]["name"]);
$fileName = $t . $fileName;
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION); 

if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
    //echo "File Uploaded"; 
} 
else{ 
    echo "File NOT uploaded";
} 
//if (isset($_POST['update'])) 
if ($_POST['update'] == true){   
    $id = $_POST['id'];  
      
    $record = "UPDATE ForeignVisit SET ServiceID ='$serviceID', Cadre = '$cadreEdit', Office = '$office', Name = '$name', Designation = '$designation', Grade = '$grade', Workplace = '$workplace', DestinationCountry = '$destCountry', FundingSource = '$fundingSource', Purpose = '$purpose', StartDate = '$startDate', EndDate = '$endDate', ActualDeparture = '$actualDeparture', ActualArrival = '$actualArrival', Days = '$days', Uploader = '$word' WHERE ID = '$id' ";    
    //echo "Edit Successful.";  
    $_SESSION['message'] = "Address updated!";      
    //GO = '$fileName' 

    $record2 = "INSERT INTO RevisedGO (ID, RevGO) VALUES ('".$id."','".$fileName."')";

    if ($db->query($record) === TRUE) { 
         echo "<br> <br> <br>";
         echo '<html> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <img src="SuccessIcon.png" alt = "Success" width="150" height="150" > </html>';  
        echo "<br><br><br><br><center> Thank you for updating the GO information. <br> <br>";
        //echo "<br> <br> Dropdown Workplace is ".$wkplc."<br>"; 
        echo "<a href= ./ActionType.php>Click here to go back to home page</a> </center>";
    
    } else {
        echo "Error: " . $record . "<br>" . $conn->error;
    } 

    if ($db->query($record2) === TRUE) {
        //echo "<br><br><br><br><center> Thank you for updating the GO information. <br> <br>"; 
        //echo "<br> <br> Dropdown Workplace is ".$wkplc."<br>"; 
        //echo "<a href= ./ActionType.php>Click here to go back to home page</a> </center>"; 
    
    } else {
        echo "Error: " . $record2 . "<br>" . $conn->error;
    }    
    //header('location: formBeng.php'); 
    //die ("Update Successful.");    
} 

if ($_POST['update'] == false) {

    $sql = "INSERT INTO ForeignVisit (ServiceID, Cadre, Office, Name, Designation, Grade, Workplace, DestinationCountry, FundingSource, Purpose, StartDate, EndDate, ActualDeparture, ActualArrival, Days, GO, Uploader) VALUES ('".$serviceID."','".$cadre."','".$office."','".$name."','".$designation2."','".$grade."','".$workplace."','".$destCountry."','".$fundingSource."','".$purpose."','".$startDate."','".$endDate."','".$actualDeparture."','".$actualArrival."','".$days."','".$fileName."','".$word."')";

    if ($db->query($sql) === TRUE) {  
         echo "<br> <br> <br>";
         echo '<html> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <img src="SuccessIcon.png" alt = "Success" width="150" height="150" > </html>';  
	
        echo "<br><br><br><br><center> Thank you for entering new GO information. <br> <br>";
        //echo "<br> <br> Dropdown Workplace is ".$wkplc."<br>";
        echo "<a href= ./ActionType.php>Click here to go back to home page</a> </center>";
    
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} 

$db->close(); 
?> 