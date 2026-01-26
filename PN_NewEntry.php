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
if (($word != "irdmof") && ($word != "sami.kabir") && ($word != "farhad.pathan") && ($word != "moinul.alam") && ($word != "anando.biswas")) {
	die("<br><br><br><center> Sorry! You are not authorized to view this page </center>");	
}
$update = false; 

if (isset($_GET['edit'])) {
     $id = $_GET['edit'];  
     $update = true;  
     $record = mysqli_query($db, "SELECT * FROM PassNID WHERE ID = $id");   

     if (count($record) == 1 ) {
        $n = mysqli_fetch_array($record);
    }
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

.red-star {
    color: red;
}

.italic-font {
	font-style: italic;
}

</style>  
<br>
<img src="Logo.png" alt="Logo" width="150" height="150" >
<h1 align = "center"> Internal Resources Division (IRD) </h1>  
<h2 align="center"> Passport and National Identity (NID) Information Entry Form </h2>
<h4 align="right"> <a href = "ActionType.php"> Home</a> &nbsp; &nbsp; &nbsp; <a href = "Logout.php">Sign Out</a> </h4>

<script>

var mealsByCategory = {
    MoF: ["Minister", "State Minister", "PS to Minister", "PS to State Minister", "Sr. Assistant Secretary", "Public Relations Officer", "APS to Minister", "APS to State Minister", "Administrative Officer","Others"],  
    IRD: ["Senior Secretary", "Secretary", "Additional Secretary", "Joint Secretary", "Deputy Secretary", "System Analyst", "Sr. Asssistant Secretary", "Programmer", "Assistant Secretary", "Assistant Programmer", "Assistant Maintenance Engineer", "Administrative Officer", "Personal Officer", "Assistant Accounts Officer", "Computer Operator", "Accountant", "Supervisor", "UDA", "DEO", "Office Assistant", "Office Sohayak", "Others"],  
    NBR: ["Chairman", "Member", "Commissioner of Taxes", "Commissioner", "Additional Commissioner of Taxes", "Additional Commissioner", "Joint Commissioner of Taxes", "Joint Commissioner", "First Secretary", "Deputy Commissioner of Taxes", "Deputy Commissioner", "Second Secretary", "Assistant Commissioner of Taxes", "Assistant Commissioner", "Others"], 
    NSD: ["Director General", "Director", "System Analyst", "Deputy Director", "Programmer", "Assistant Director", "Savings Officer", "Others"],
    TAT: ["President", "Member", "Registrar", "Assistant Registrar", "Others"],
    CEVT: ["President", "Member", "Registrar", "Assistant Registrar", "Revenue Officer", "Assistant Revenue Officer", "Others"]  
}   

    function changedesig(value) { 
        if (value.length == 0) document.getElementById("designation2").innerHTML = "<option></option>";
        else {
            var catOptions = "";
            for (categoryId in mealsByCategory[value]) {
                catOptions += "<option>" + mealsByCategory[value][categoryId] + "</option>";
            }
            document.getElementById("designation2").innerHTML = catOptions;
        }
    } 
</script>

</head>
<body>   
<br>
Please fill up the following fields and click "Submit". Either <b> Passport </b> or <b>NID</b> must be filled out.
<br>
<span class="red-star"> (Fields with * are mandatory) </span>

<form id="frm1" method="POST" action="action_page_pn.php" enctype="multipart/form-data" onsubmit="return validateForm()"> 

  <input type="hidden" name="id" value= "<?php echo $id; ?>" > 
  <input type="hidden" name="update" value = "<?php echo $update; ?>" >  
  <br>
  Service ID:<span class="red-star">* </span> &nbsp; <input type="number" name="serviceID" value = "<?php echo $n['ServiceID']; ?>" size="20" maxlength="20"> 
  &nbsp; &nbsp; Cadre:<span class="red-star">* </span> &nbsp;  

<?php if ($update == true): ?> 
  <input type="text" name="cadreEdit" id = "cadreEdit" value = "<?php echo $n['Cadre']; ?>" size="40" maxlength="40">
<?php endif ?> 

<?php if ($update == false): ?> 
  <select name="cadreName" id="cadreName" onchange='CheckCadre(this.value);' text-align:center>   
    <option value="" ></option>  
    <option value="Administration" <?php if($n['Cadre']=="Administration") echo 'selected="selected"'; ?>>BCS (Administration)</option>  
    <option value="Tax" <?php if($n['Cadre']=="Tax") echo 'selected="selected"'; ?>>BCS (Tax)</option>   
    <option value="Customs" <?php if($n['Cadre']=="Customs") echo 'selected="selected"'; ?>>BCS (Customs)</option>
    <option value="Non Cadre" <?php if($n['Cadre']=="Non Cadre") echo 'selected="selected"'; ?>>Non Cadre</option>   
    <option value="Not Applicable" <?php if($n['Cadre']=="Not Applicable") echo 'selected="selected"'; ?>>Not Applicable</option>  
        <option value="Other Cadres" <?php if($n['Cadre']=="Other Cadres") echo 'selected="selected"'; ?>>Other Cadres</option>   
  </select>  
  <br><br> <input type="text" name="cadreOthers" id="cadreOthers" style='display:none;' /> <br>
<?php endif ?>

  Office:<span class="red-star">* </span> &nbsp;  
  <select name="office" id="office" onchange="changedesig(this.value);" text-align:center>  
    <option value="MoF" <?php if($n['Office']=="MoF") echo 'selected="selected"'; ?>>Ministry of Finance</option>  
  	<option value="IRD" <?php if($n['Office']=="IRD") echo 'selected="selected"'; ?>>Internal Resources Division (IRD)</option>  
    <option value="NBR" <?php if($n['Office']=="NBR") echo 'selected="selected"'; ?>>National Board of Revenue (NBR)</option>  
    <option value="NSD" <?php if($n['Office']=="NSD") echo 'selected="selected"'; ?>>National Savings Department (NSD)</option>  
    <option value="TAT" <?php if($n['Office']=="TAT") echo 'selected="selected"'; ?>>Taxes Appellate Tribunal (TAT)</option>  
    <option value="CEVT" <?php if($n['Office']=="CEVT") echo 'selected="selected"'; ?>>Customs, Excise and VAT Appellate Tribunal (CEVT)</option>

  </select>    

  <br> <br>
  Name:<span class="red-star">* </span> &nbsp; <input type="text" name="name" value = "<?php echo $n['Name']; ?>" size="22" maxlength="22"> &nbsp;&nbsp;
  Designation:<span class="red-star">* </span> &nbsp; 
  <?php if ($update == true): ?> 
  <input type="text" name="designation" id = "designation" value = "<?php echo $n['Designation']; ?>" size="40" maxlength="40">
  <?php endif ?> 

 <?php if ($update == false): ?> 
  <select name="designation2" id = "designation2" onchange='CheckDesig2(this.value);' text-align:center> 
    <option value="" disabled selected>Select</option> 
  </select>
  <br> <br> <input type="text" name="desigOthers" id="desigOthers" style='display:none;' /> <br>

 <?php endif ?> 

  Grade:<span class="red-star">* </span> &nbsp; &nbsp;   <select name="grade" onchange='CheckPlace(this.value); ' text-align:center> 
    <option value="" ></option>
    <option value= 1 <?php if($n['Grade']== 1 ) echo 'selected="selected"'; ?>> 1 </option>  
    <option value= 2 <?php if($n['Grade']== 2 ) echo 'selected="selected"'; ?>> 2 </option>  
    <option value= 3 <?php if($n['Grade']== 3 ) echo 'selected="selected"'; ?>> 3 </option>  
    <option value= 4 <?php if($n['Grade']== 4 ) echo 'selected="selected"'; ?>> 4 </option>  
    <option value= 5 <?php if($n['Grade']== 5 ) echo 'selected="selected"'; ?>> 5 </option>  
    <option value= 6 <?php if($n['Grade']== 6 ) echo 'selected="selected"'; ?>> 6 </option>  
    <option value= 7 <?php if($n['Grade']== 7 ) echo 'selected="selected"'; ?>> 7 </option>  
    <option value= 8 <?php if($n['Grade']== 8 ) echo 'selected="selected"'; ?>> 8 </option>  
    <option value= 9 <?php if($n['Grade']== 9 ) echo 'selected="selected"'; ?>> 9 </option>  
    <option value= 10 <?php if($n['Grade']== 10 ) echo 'selected="selected"'; ?>> 10 </option>  
    <option value= 11 <?php if($n['Grade']== 11 ) echo 'selected="selected"'; ?>> 11 </option>  
    <option value= 12 <?php if($n['Grade']== 12 ) echo 'selected="selected"'; ?>> 12 </option>  
    <option value= 13 <?php if($n['Grade']== 13 ) echo 'selected="selected"'; ?>> 13 </option>  
    <option value= 14 <?php if($n['Grade']== 14 ) echo 'selected="selected"'; ?>> 14 </option>  
    <option value= 15 <?php if($n['Grade']== 15 ) echo 'selected="selected"'; ?>> 15 </option>   
    <option value= 16 <?php if($n['Grade']== 16 ) echo 'selected="selected"'; ?>> 16 </option>  
    <option value= 17 <?php if($n['Grade']== 17 ) echo 'selected="selected"'; ?>> 17 </option>  
    <option value= 18 <?php if($n['Grade']== 18 ) echo 'selected="selected"'; ?>> 18 </option>  
    <option value= 19 <?php if($n['Grade']== 19 ) echo 'selected="selected"'; ?>> 19 </option>  
    <option value= 20 <?php if($n['Grade']== 20 ) echo 'selected="selected"'; ?>> 20 </option>   
  </select>   
  <br> <br> Passport No: &nbsp; <input type="text" name="passport" value = "<?php echo $n['Passport']; ?>" size="20" maxlength="20"> &nbsp;&nbsp;
  Expiry Date: <input type="date" id="expiryDate" name="expiryDate" value = "<?php echo $n['ExpiryDate']; ?>"> <br> <br>
  National Identity (NID): &nbsp; <input type="number" name="nidnum" value = "<?php echo $n['NID_Num']; ?>" size="25" maxlength="25"> <br> <br>
  

<?php if ($update == true): ?>
   <input type="button" onclick="myFunction()" value="Update">
<?php else: ?>
   <input type="button" onclick="myFunction()" value="Submit">
<?php endif ?> 
&nbsp; &nbsp; 


</form>

<script>
function CheckCadre(val){
 var element3=document.getElementById('cadreOthers');
 if(val=="Other Cadres")
   element3.style.display='block';
 else  
   element3.style.display='none';
}   

function CheckDesig2(val){
 var element2=document.getElementById('desigOthers');
 if(val=="Others")
   element2.style.display='block';
 else  
   element2.style.display='none'; 
}  

function CheckPlace(val){
 var element=document.getElementById('wkplc');
 if(val=='Project'||val=='Others')
   element.style.display='block';
 else  
   element.style.display='none';
}  

function myFunction() {
  let x = document.forms["frm1"]["serviceID"].value;
  if (x == "") {
    alert("Service ID must be filled out.");
    return false;
  }

  <?php if ($update == true): ?> 
  let x2 = document.forms["frm1"]["cadreEdit"].value;
  if (x2 == "") {
    alert("Cadre name must be written.");
    return false;
  } 
  <?php endif ?>  
  
  <?php if ($update == false): ?> 
  let x2 = document.forms["frm1"]["cadreName"].value;
  if (x2 == "") {
    alert("Cadre must be selected.");
    return false;
  } 
  <?php endif ?>

  let x3 = document.forms["frm1"]["office"].value; 
  if (x3 == "") {
    alert("Office must be selected.");
    return false;
  }   
  let y = document.forms["frm1"]["name"].value;
  if (y == "") {
    alert("Name must be filled out.");
    return false;
  }
  <?php if ($update == true): ?>
  let z = document.forms["frm1"]["designation"].value;
  if (z == "") { 
    alert("Designation must be selected.");
    return false; 
  }  
  <?php endif ?>
  <?php if ($update == false): ?>
  let z = document.forms["frm1"]["designation2"].value;
  if (z == "") {
    alert("Designation must be selected.");
    return false; 
  }  
  <?php endif ?>
  let z2 = document.forms["frm1"]["grade"].value;
  if (z2 == "") {
    alert("Grade must be filled out.");
    return false;
  }// StartDate     

  let pass = document.forms["frm1"]["passport"].value;
  let natid = document.forms["frm1"]["nidnum"].value;
  if ((pass == "") && (natid == "")) {
    alert("Either Passport or NID must be filled out.");
    return false;
  }

  if(confirm("Are you sure to submit?")){ 
    document.getElementById("frm1").submit();  
  }
  
}
</script>

</body>
</html>
 