<?php
// Database Connection 
include("config.php");
//Check for connection error 
$select = "SELECT * FROM images"; 

$result = $db->query($select);

while($row = $result->fetch_object()){ 
  $pdf = $row->file_name; 
  $path = $row->file_name;
  $date = $row->uploaded_on;
  //echo '<a href="www.mit.edu"> Click here </a>'; 
  //echo '<a href="./uploads/08731972.pdf"> Click here </a>';

  //echo '<a href="./uploads/'.$path.'"> Click here </a>';
  echo '<a href="./uploads/'.$path.'">'.$pdf.' </a>';
  echo '<br>';
}

//echo '<h1>Here is the information PDF</h1>';
//echo '<strong>Created Date : </strong>'.$date;
//echo '<strong>File Name : </strong>'.$pdf;

?>
<br/><br/>
<a href="./uploads/<?php echo $path; ?>"/><?php echo $path; ?></a>


