<?php
include("config.php");
session_start();
if(isset($_SESSION['login_user'])) {
    $word = $_SESSION['login_user'];
    //echo "Welcome, " . $word; 
} else {
    die("<br><br><center>You are presently logged out. Please log in to access this page. <br> <br> <a href = ./Login.php> Click here to log in </a></center>");
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
<img src="Logo.jpeg" alt="Logo" width="150" height="150" >
<h1 align = "center"> Internal Resources Division (IRD) </h1>  
<h2 align="center"> Passport and National Identity (NID) Information Entry Form </h2>
<h4 align="right"> <a href = "ActionType.php"> Home</a> &nbsp; &nbsp; &nbsp; <a href = "Logout.php">Sign Out</a> </h4>

<script>

var mealsByCategory = {
    Administration: ["Senior Secretary", "Secretary", "Additional Secretary", "Joint Secretary", "Deputy Secretary", "First Secretary", "Sr. Asssistant Secretary", "Second Secretary", "Assistant Secretary"],  
    Tax: ["Member", "President", "Additional Secretary", "Joint Secretary", "Commissioner of Taxes", "Additional Commissioner of Taxes", "Deputy Secretary", "Joint Commissioner of Taxes", "First Secretary", "Deputy Commissioner of Taxes", "Second Secretary", "Assistant Commissioner of Taxes"],
    Customs: ["Member", "President", "Additional Secretary", "Joint Secretary", "Commissioner", "Additional Commissioner", "Deputy Secretary", "Joint Commissioner", "First Secretary", "Deputy Commissioner", "Second Secretary", "Assistant Commissioner"],
    "Non Cadre": ["Director", "System Analyst", "Deputy Secretary", "Programmer", "Registrar", "Deputy Director", "Sr. Assistant Secretary", "Assistant Director", "Assistant Programmer", "Assistant Maintenance Engineer", "Assistant Registrar", "Accounts Officer", "Assistant Secretary", "Revenue Officer"],
    "Not Applicable": ["Administrative Officer", "Personal Officer", "Assistant Revenue Officer", "Assistant Accounts Officer", "Computer Operator", "Accountant", "Supervisor", "UDA", "DEO", "Office Assistant", "Office Sohayak"]  
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

  <select name="cadreName" id="cadreName" onchange="changedesig(this.value);" text-align:center> 
    <option value="" ></option>  
    <option value="Administration" <?php if($n['Cadre']=="Administration") echo 'selected="selected"'; ?>>BCS (Administration)</option>  
    <option value="Tax" <?php if($n['Cadre']=="Tax") echo 'selected="selected"'; ?>>BCS (Tax)</option>  
    <option value="Customs" <?php if($n['Cadre']=="Customs") echo 'selected="selected"'; ?>>BCS (Customs)</option>
    <option value="Non Cadre" <?php if($n['Cadre']=="Non Cadre") echo 'selected="selected"'; ?>>Non Cadre</option>   
    <option value="Not Applicable" <?php if($n['Cadre']=="Not Applicable") echo 'selected="selected"'; ?>>Not Applicable</option>   

  </select>  

  &nbsp; &nbsp; Office:<span class="red-star">* </span> &nbsp;  
  <select name="office" onchange='CheckPlace(this.value); ' text-align:center>  
  	<option value="IRD" <?php if($n['Office']=="IRD") echo 'selected="selected"'; ?>>Internal Resources Division (IRD)</option>  
    <option value="NBR" <?php if($n['Office']=="NBR") echo 'selected="selected"'; ?>>National Board of Revenue (NBR)</option>  
    <option value="NSD" <?php if($n['Office']=="NSD") echo 'selected="selected"'; ?>>National Savings Department (NSD)</option>  
    <option value="TAT" <?php if($n['Office']=="TAT") echo 'selected="selected"'; ?>>Taxes Appellate Tribunal (TAT)</option>  
    <option value="CEVT" <?php if($n['Office']=="CEVT") echo 'selected="selected"'; ?>>Customs, Excise and VAT Appellate Tribunal (CEVT)</option>
    <option value="Others" <?php if($n['Office']=="Others") echo 'selected="selected"'; ?>>Others</option>   

  </select>    

  <br> <br>
  Name:<span class="red-star">* </span> &nbsp; <input type="text" name="name" value = "<?php echo $n['Name']; ?>" size="22" maxlength="22"> &nbsp;&nbsp;
  Designation:<span class="red-star">* </span> &nbsp; 
  <?php if ($update == true): ?> 
  <select name="designation" id = "designation" text-align:center> 
    <option value="Senior Secretary" <?php if($n['Designation']=="Senior Secretary") echo 'selected="selected"'; ?>>Senior Secretary</option>
    <option value="Secretary" <?php if($n['Designation']=="Secretary") echo 'selected="selected"'; ?>>Secretary</option>
    <option value="Additional Secretary" <?php if($n['Designation']=="Additional Secretary") echo 'selected="selected"'; ?>>Additional Secretary</option>
    <option value="Member" <?php if($n['Designation']=="Member") echo 'selected="selected"'; ?>>Member</option>
    <option value="President" <?php if($n['Designation']=="President") echo 'selected="selected"'; ?>>President</option>
    <option value="Joint Secretary" <?php if($n['Designation']=="Joint Secretary") echo 'selected="selected"'; ?>>Joint Secretary</option>
    <option value="Commissioner of Taxes" <?php if($n['Designation']=="Commissioner of Taxes") echo 'selected="selected"'; ?>>Commissioner of Taxes</option>
    <option value="Commissioner" <?php if($n['Designation']=="Commissioner") echo 'selected="selected"'; ?>>Commissioner</option>
    <option value="Additional Commissioner of Taxes" <?php if($n['Designation']=="Additional Commissioner of Taxes") echo 'selected="selected"'; ?>>Additional Commissioner of Taxes</option>  
    <option value="Additional Commissioner" <?php if($n['Designation']=="Additional Commissioner") echo 'selected="selected"'; ?>>Additional Commissioner</option>
    <option value="Director" <?php if($n['Designation']=="Director") echo 'selected="selected"'; ?>>Director</option>
    <option value="Deputy Secretary" <?php if($n['Designation']=="Deputy Secretary") echo 'selected="selected"'; ?>>Deputy Secretary</option>
    <option value="Joint Commissioner of Taxes" <?php if($n['Designation']=="Joint Commissioner of Taxes") echo 'selected="selected"'; ?>>Joint Commissioner of Taxes</option>
    <option value="Joint Commissioner" <?php if($n['Designation']=="Joint Commissioner") echo 'selected="selected"'; ?>>Joint Commissioner</option>
    <option value="System Analyst" <?php if($n['Designation']=="System Analyst") echo 'selected="selected"'; ?>>System Analyst</option>
    <option value="First Secretary" <?php if($n['Designation']=="First Secretary") echo 'selected="selected"'; ?>>First Secretary</option>
    <option value="Registrar" <?php if($n['Designation']=="Registrar") echo 'selected="selected"'; ?>>Registrar</option>
    <option value="Senior Assistant Secretary" <?php if($n['Designation']=="Senior Assistant Secretary") echo 'selected="selected"'; ?>>Senior Assistant Secretary</option>
    <option value="Deputy Commissioner of Taxes" <?php if($n['Designation']=="Deputy Commissioner of Taxes") echo 'selected="selected"'; ?>>Deputy Commissioner of Taxes</option>
    <option value="Deputy Commissioner" <?php if($n['Designation']=="Deputy Commissioner") echo 'selected="selected"'; ?>>Deputy Commissioner</option> 
    <option value="Programmer" <?php if($n['Designation']=="Programmer") echo 'selected="selected"'; ?>>Programmer</option>
    <option value="Deputy Director" <?php if($n['Designation']=="Deputy Director") echo 'selected="selected"'; ?>>Deputy Director</option>
    <option value="Second Secretary" <?php if($n['Designation']=="Second Secretary") echo 'selected="selected"'; ?>>Second Secretary</option>
    <option value="Assistant Secretary" <?php if($n['Designation']=="Assistant Secretary") echo 'selected="selected"'; ?>>Assistant Secretary</option>
    <option value="Assistant Commissioner of Taxes" <?php if($n['Designation']=="Assistant Commissioner of Taxes") echo 'selected="selected"'; ?>>Assistant Commissioner of Taxes</option>
    <option value="Assistant Commissioner" <?php if($n['Designation']=="Assistant Commissioner") echo 'selected="selected"'; ?>>Assistant Commissioner</option>
    <option value="Assistant Programmer" <?php if($n['Designation']=="Assistant Programmer") echo 'selected="selected"'; ?>>Assistant Programmer</option>
    <option value="Assistant Maintenance Engineer" <?php if($n['Designation']=="Assistant Maintenance Engineer") echo 'selected="selected"'; ?>>Assistant Maintenance Engineer</option>
    <option value="Assistant Director" <?php if($n['Designation']=="Assistant Director") echo 'selected="selected"'; ?>>Assistant Director</option>
    <option value="Assistant Registrar" <?php if($n['Designation']=="Assistant Registrar") echo 'selected="selected"'; ?>>Assistant Registrar</option>
    <option value="Accounts Officer" <?php if($n['Designation']=="Accounts Officer") echo 'selected="selected"'; ?>>Accounts Officer</option>
    <option value="Revenue Officer" <?php if($n['Designation']=="Revenue Officer") echo 'selected="selected"'; ?>>Revenue Officer</option>
    <option value="Administrative Officer" <?php if($n['Designation']=="Administrative Officer") echo 'selected="selected"'; ?>>Administrative Officer</option>
    <option value="Personal Officer" <?php if($n['Designation']=="Personal Officer") echo 'selected="selected"'; ?>>Personal Officer</option>
    <option value="Assistant Revenue Officer" <?php if($n['Designation']=="Assistant Revenue Officer") echo 'selected="selected"'; ?>>Assistant Revenue Officer</option>
    <option value="Assistant Accounts Officer" <?php if($n['Designation']=="Assistant Accounts Officer") echo 'selected="selected"'; ?>>Assistant Accounts Officer</option>
    <option value="Computer Operator" <?php if($n['Designation']=="Computer Operator") echo 'selected="selected"'; ?>>Computer Operator</option>
    <option value="Accountant" <?php if($n['Designation']=="Accountant") echo 'selected="selected"'; ?>>Accountant</option> 
    <option value="Supervisor" <?php if($n['Designation']=="Supervisor") echo 'selected="selected"'; ?>>Supervisor</option>
    <option value="UDA" <?php if($n['Designation']=="UDA") echo 'selected="selected"'; ?>>UDA</option>
    <option value="DEO" <?php if($n['Designation']=="DEO") echo 'selected="selected"'; ?>>DEO</option>
    <option value="Office Assistant" <?php if($n['Designation']=="Office Assistant") echo 'selected="selected"'; ?>>Office Assistant</option>
    <option value="Office Sohayok" <?php if($n['Designation']=="Office Sohayok") echo 'selected="selected"'; ?>>Office Sohayok</option>
  </select> 
  <?php endif ?> 

 <?php if ($update == false): ?> 
  <select name="designation2" id = "designation2" text-align:center> 
    <option value="" disabled selected>Select</option>
  </select>
 <?php endif ?> 

  &nbsp; &nbsp; Grade:<span class="red-star">* </span> &nbsp; &nbsp;   <select name="grade" onchange='CheckPlace(this.value); ' text-align:center> 
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
  let x2 = document.forms["frm1"]["cadreName"].value;
  if (x2 == "") {
    alert("Cadre must be selected.");
    return false;
  } 
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
 