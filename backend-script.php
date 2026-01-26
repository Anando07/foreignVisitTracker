<?php

include('config.php'); 

$searchTerm = $_GET['term'];
$sql = "SELECT * FROM ForeignVisit WHERE Name LIKE '%".$searchTerm."%'"; 
$result = $db->query($sql); 
if ($result->num_rows > 0) {
  $tutorialData = array(); 
  while($row = $result->fetch_assoc()) {

   $data['id']    = $row['ID']; 
   $data['value'] = $row['Name'];
   array_push($tutorialData, $data);
} 
}
 echo json_encode($tutorialData);
?>