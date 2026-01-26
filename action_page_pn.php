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
$office = $_POST['office'];
$name = $_POST['name'];

if ($_POST['update'] == true){   
    $designation = $_POST['designation'];
}
if ($_POST['update'] == false){   
    $designation2 = $_POST['designation2']; 
}  

if ($_POST['update'] == true){   
    $cadre = $_POST['cadreEdit'];
}
if ($_POST['update'] == false){   
    $cadre = $_POST['cadreName']; 
}  

$grade = $_POST['grade'];
$passport = $_POST['passport'];
$expiryDate = $_POST['expiryDate'];
$nidnum = $_POST['nidnum']; 

if($serviceID==""){
    die("<br><br><center>Sorry. <b> The Service ID field cannot be left empty. </b> Please resubmit with valid input. <br> <br> <a href = ./NewEntry.php> Click here to retry </a></center>");
}
if($cadre==""){
    die("<br><br><center>Sorry. <b> The Cadre field cannot be left empty. </b> Please resubmit with valid input. <br> <br> <a href = ./NewEntry.php> Click here to retry </a></center>");
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

if (!preg_match("/^[a-zA-Z. ]*$/",$name)) { 
  //$nameErr = "Only letters and white space allowed";
    die("<br><br><center>Sorry. <b>Only letters and white space are allowed in the Name field.</b> Please resubmit with valid input. <br> <br> <a href = ./NewEntry.php> Click here to retry </a></center>");
} 
if ($_POST['update'] == true){   
    $id = $_POST['id'];  
      
    $record = "UPDATE PassNID SET ServiceID ='$serviceID', Cadre = '$cadre', Office = '$office', Name = '$name', Designation = '$designation', Grade = '$grade', Passport = '$passport', ExpiryDate = '$expiryDate', NID_Num = '$nidnum', Uploader = '$word' WHERE ID = '$id' ";    
    //echo "Edit Successful.";  
    $_SESSION['message'] = "Address updated!";      
    //GO = '$fileName' 

    if ($db->query($record) === TRUE) { 
        echo "<br><br><br><br><center> Thank you for updating the Passport/NID information. <br> <br>";
        //echo "<br> <br> Dropdown Workplace is ".$wkplc."<br>"; 
        echo "<a href= ./ActionType.php>Click here to go back to home page</a> </center>";
    
    } else {
        echo "Error: " . $record . "<br>" . $conn->error;
    }  
} 

if ($_POST['update'] == false) { 

    $check_sql = "SELECT * from PassNID WHERE ServiceID = " . $serviceID . " AND Cadre = '" . $cadre . "'";
    $check_result = mysqli_query($db,$check_sql);
    $check_count = mysqli_num_rows($check_result);

    if ($check_count == 0) {

        $sql = "INSERT INTO PassNID (ServiceID, Cadre, Office, Name, Designation, Grade, Passport, ExpiryDate, NID_Num, Uploader) VALUES ('".$serviceID."','".$cadre."','".$office."','".$name."','".$designation2."','".$grade."','".$passport."','".$expiryDate."','".$nidnum."','".$word."')"; 

        if ($db->query($sql) === TRUE) {  
            echo "<br><br><br><br><center> Thank you for entering Passport/NID information. <br> <br>";
        
            echo "<a href= ./ActionType.php>Click here to go back to home page</a> </center>";

        }

        else {
            echo "Error: " . $sql . "<br>" . $conn->error;    
        }
    }

    else if ($check_count > 0) {
        echo "<br><br><br><br><center> Sorry. Passport/NID information of <b> Service ID: " . $serviceID . " of " . $cadre . " cadre </b> have already been entered. <br> <br>";
        echo "Please <a href= ./PN_ReportType.php>Click here</a> to edit this person's Passport/NID information. </center>";
    }    
} 

$db->close(); 
?> 