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
$track = 0;

if (isset($_GET['edit'])) { 
     $id = $_GET['edit'];  
     $update = true;  
     $record = mysqli_query($db, "SELECT * FROM ForeignVisit WHERE ID = $id");  

     if (count($record) == 1 ) {
        $n = mysqli_fetch_array($record);
    }
 }
?>
<link rel = "shortcut icon" type = "image/jpeg" href = "./VisitIcon.jpeg">
<style>
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

footer {
  text-align: center;
  padding: 3px;
  background-color: DarkSalmon;
  color: black;
}
</style>

</style>  
<br>
<h2 align="center"> New Foreign Visit Entry Form </h2>

<script>
function validateForm() { 
  let x = document.forms["frm1"]["serviceID"].value;
  if (x == "") {
    alert("Service ID must be filled out");
    return false;
  }
  let y = document.forms["frm1"]["name"].value;
  if (y == "") {
    alert("Name must be filled out");
    return false;
  }
  let z = document.forms["frm1"]["designation"].value;
  if (z == "") {
    alert("Designation must be filled out");
    return false;
  }  
  let a = document.forms["frm1"]["workplace"].value;
  if (a == "") {
    alert("Workplace must be filled out");
    return false;
  }// StartDate    
  let b = new Date (document.forms["frm1"]["StartDate"].value);
  if (b == "") {
    alert("Start Date must be filled out");
    return false;
  }// StartDate      
  let c = new Date (document.forms["frm1"]["EndDate"].value);
  if (c == "") { 
    alert("End Date must be filled out");
    return false;
  }// //Purpose,  FundingSource //file
  let d = document.forms["frm1"]["Purpose"].value;
  if (d == "") {
    alert("Purpose must be filled out");
    return false;
  }  
  let e = document.forms["frm1"]["FundingSource"].value;
  if (e == "") {
    alert("Funding Source must be filled out");
    return false;
  }  
  let f = document.forms["frm1"]["file"].value;
  if (f == "") {
    alert("GO must be uploaded");
    return false;
  }
}

var mealsByCategory = {
    MoF: ["Minister", "State Minister", "PS to Minister", "PS to State Minister", "Sr. Assistant Secretary", "Public Relations Officer", "APS to Minister", "APS to State Minister", "Administrative Officer","Others"],  
    IRD: ["Senior Secretary", "Secretary", "Additional Secretary", "Joint Secretary", "Deputy Secretary", "Private Secretary", "System Analyst", "Sr. Asssistant Secretary", "Programmer", "Assistant Secretary", "Assistant Programmer", "Assistant Maintenance Engineer", "Administrative Officer", "Personal Officer", "Assistant Accounts Officer", "Computer Operator", "Accountant", "Supervisor", "UDA", "DEO", "Office Assistant", "Office Sohayak", "Others"],  
    NBR: ["Chairman", "Member", "Commissioner of Taxes", "Commissioner", "Director General", "System Manager", "Additional Commissioner of Taxes", "Additional Commissioner", "Senior System Analyst", "Senior Maintenance Engineer", "Joint Commissioner of Taxes", "Joint Commissioner", "First Secretary", "Director", "System Analyst", "Deputy Commissioner of Taxes", "Deputy Commissioner", "Second Secretary", "Programmer", "Maintenance Engineer", "Assistant Director", "Assistant Commissioner of Taxes", "Assistant Commissioner", "Assistant Programmer", "Assistant Maintenance Engineer", "Statistical Officer", "Revenue Officer", "Assistant Revenue Officer", "Others"], 
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
<body style="background-color:powderblue;">   
<br>
Please fill up the following fields according to Government Order (GO), upload the GO in pdf/jpg format, and click "Submit":
<br>
<span class="red-star"> (Fields with * are mandatory) </span>

<form id="frm1" method="POST" action="action_page.php" enctype="multipart/form-data" onsubmit="return validateForm()"> 

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
  <br><br> <input type="text" name="cadreOthers" id="cadreOthers" style='display:none;' />
  <?php endif ?> 

  <br><br>Office:<span class="red-star">* </span> &nbsp;  
  <select name="office" id="office" onchange="changedesig(this.value);" text-align:center>  
  	<option value="" ></option>  
    <option value="MoF" <?php if($n['Office']=="MoF") echo 'selected="selected"'; ?>>Ministry of Finance</option>  
    <option value="IRD" <?php if($n['Office']=="IRD") echo 'selected="selected"'; ?>>Internal Resources Division (IRD)</option>  
    <option value="NBR" <?php if($n['Office']=="NBR") echo 'selected="selected"'; ?>>National Board of Revenue (NBR)</option>  
    <option value="NSD" <?php if($n['Office']=="NSD") echo 'selected="selected"'; ?>>National Savings Department (NSD)</option>  
    <option value="TAT" <?php if($n['Office']=="TAT") echo 'selected="selected"'; ?>>Taxes Appellate Tribunal (TAT)</option>  
    <option value="CEVT" <?php if($n['Office']=="CEVT") echo 'selected="selected"'; ?>>Customs, Excise and VAT Appellate Tribunal (CEVT)</option>

  </select>    

  <br> <br>
  Name:<span class="red-star">* </span> &nbsp; <input type="text" name="name" value = "<?php echo $n['Name']; ?>" size="40" maxlength="40"><br> <br>
  Designation:<span class="red-star">* </span> &nbsp; 
<?php if ($update == true): ?> 
  <input type="text" name="designation" id = "designation" value = "<?php echo $n['Designation']; ?>" size="40" maxlength="40">
<?php endif ?> 

 <?php if ($update == false): ?> 
  <select name="designation2" id = "designation2" onchange='CheckDesig2(this.value);' text-align:center> 
    <option value="" disabled selected>Select</option> 
  </select>
  <br> <br> <input type="text" name="desigOthers" id="desigOthers" style='display:none;' />

 <?php endif ?> 

  <br> <br> Grade:<span class="red-star">* </span> &nbsp; &nbsp; <select name="grade" onchange='CheckPlace(this.value); ' text-align:center> 
    <option value="" ></option> 
    <option value= 0 <?php if($n['Grade']== 0 ) echo 'selected="selected"'; ?>> 0 </option>  
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
  &nbsp; &nbsp; Workplace:<span class="red-star">* </span> &nbsp; <input type="text" name="workplace" value = "<?php echo $n['Workplace']; ?>" size="40" maxlength="60"><br> <br>
  
  Destination Country:<span class="red-star">* </span>
  <select name="destCountry" onchange='CheckPlace(this.value); ' text-align:center>
   <option value="" ></option>
   <option value="Afganistan" <?php if($n['DestinationCountry']=="Afganistan") echo 'selected="selected"'; ?>>Afghanistan</option>
   <option value="Albania" <?php if($n['DestinationCountry']=="Albania") echo 'selected="selected"'; ?>>Albania</option>
   <option value="Algeria" <?php if($n['DestinationCountry']=="Algeria") echo 'selected="selected"'; ?>>Algeria</option>
   <option value="American Samoa" <?php if($n['DestinationCountry']=="American Samoa") echo 'selected="selected"'; ?>>American Samoa</option>
   <option value="Andorra" <?php if($n['DestinationCountry']=="Andorra") echo 'selected="selected"'; ?>>Andorra</option>
   <option value="Angola" <?php if($n['DestinationCountry']=="Angola") echo 'selected="selected"'; ?>>Angola</option>
   <option value="Anguilla" <?php if($n['DestinationCountry']=="Anguilla") echo 'selected="selected"'; ?>>Anguilla</option>
   <option value="Antigua & Barbuda" <?php if($n['DestinationCountry']=="Antigua & Barbuda") echo 'selected="selected"'; ?>>Antigua & Barbuda</option>
   <option value="Argentina" <?php if($n['DestinationCountry']=="Argentina") echo 'selected="selected"'; ?>>Argentina</option>
   <option value="Armenia" <?php if($n['DestinationCountry']=="Armenia") echo 'selected="selected"'; ?>>Armenia</option>
   <option value="Aruba" <?php if($n['DestinationCountry']=="Aruba") echo 'selected="selected"'; ?>>Aruba</option>
   <option value="Australia" <?php if($n['DestinationCountry']=="Australia") echo 'selected="selected"'; ?>>Australia</option>
   <option value="Austria" <?php if($n['DestinationCountry']=="Austria") echo 'selected="selected"'; ?>>Austria</option>
   <option value="Azerbaijan" <?php if($n['DestinationCountry']=="Azerbaijan") echo 'selected="selected"'; ?>>Azerbaijan</option>
   <option value="Bahamas" <?php if($n['DestinationCountry']=="Bahamas") echo 'selected="selected"'; ?>>Bahamas</option>
   <option value="Bahrain" <?php if($n['DestinationCountry']=="Bahrain") echo 'selected="selected"'; ?>>Bahrain</option> 
   <option value="Bangladesh" <?php if($n['DestinationCountry']=="Bangladesh") echo 'selected="selected"'; ?>>Bangladesh</option>
   <option value="Barbados" <?php if($n['DestinationCountry']=="Barbados") echo 'selected="selected"'; ?>>Barbados</option>
   <option value="Belarus" <?php if($n['DestinationCountry']=="Belarus") echo 'selected="selected"'; ?>>Belarus</option>
   <option value="Belgium" <?php if($n['DestinationCountry']=="Belgium") echo 'selected="selected"'; ?>>Belgium</option>
   <option value="Belize" <?php if($n['DestinationCountry']=="Belize") echo 'selected="selected"'; ?>>Belize</option>
   <option value="Benin" <?php if($n['DestinationCountry']=="Benin") echo 'selected="selected"'; ?>>Benin</option>
   <option value="Bermuda" <?php if($n['DestinationCountry']=="Bermuda") echo 'selected="selected"'; ?>>Bermuda</option>
   <option value="Bhutan" <?php if($n['DestinationCountry']=="Bhutan") echo 'selected="selected"'; ?>>Bhutan</option>
   <option value="Bolivia" <?php if($n['DestinationCountry']=="Bolivia") echo 'selected="selected"'; ?>>Bolivia</option>
   <option value="Bonaire" <?php if($n['DestinationCountry']=="Bonaire") echo 'selected="selected"'; ?>>Bonaire</option>
   <option value="Bosnia & Herzegovina" <?php if($n['DestinationCountry']=="Bosnia & Herzegovina") echo 'selected="selected"'; ?>>Bosnia & Herzegovina</option>
   <option value="Botswana" <?php if($n['DestinationCountry']=="Botswana") echo 'selected="selected"'; ?>>Botswana</option>
   <option value="Brazil" <?php if($n['DestinationCountry']=="Brazil") echo 'selected="selected"'; ?>>Brazil</option>
   <option value="British Indian Ocean Ter" <?php if($n['DestinationCountry']=="British Indian Ocean Ter") echo 'selected="selected"'; ?>>British Indian Ocean Ter</option>
   <option value="Brunei" <?php if($n['DestinationCountry']=="Brunei") echo 'selected="selected"'; ?>>Brunei</option>
   <option value="Bulgaria" <?php if($n['DestinationCountry']=="Bulgaria") echo 'selected="selected"'; ?>>Bulgaria</option>
   <option value="Burkina Faso" <?php if($n['DestinationCountry']=="Burkina Faso") echo 'selected="selected"'; ?>>Burkina Faso</option>
   <option value="Burundi" <?php if($n['DestinationCountry']=="Burundi") echo 'selected="selected"'; ?>>Burundi</option>
   <option value="Cambodia" <?php if($n['DestinationCountry']=="Cambodia") echo 'selected="selected"'; ?>>Cambodia</option>
   <option value="Cameroon" <?php if($n['DestinationCountry']=="Cameroon") echo 'selected="selected"'; ?>>Cameroon</option>
   <option value="Canada" <?php if($n['DestinationCountry']=="Canada") echo 'selected="selected"'; ?>>Canada</option>
   <option value="Canary Islands" <?php if($n['DestinationCountry']=="Canary Islands") echo 'selected="selected"'; ?>>Canary Islands</option>
   <option value="Cape Verde" <?php if($n['DestinationCountry']=="Cape Verde") echo 'selected="selected"'; ?>>Cape Verde</option>
   <option value="Cayman Islands" <?php if($n['DestinationCountry']=="Cayman Islands") echo 'selected="selected"'; ?>>Cayman Islands</option>
   <option value="Central African Republic" <?php if($n['DestinationCountry']=="Central African Republic") echo 'selected="selected"'; ?>>Central African Republic</option>
   <option value="Chad" <?php if($n['DestinationCountry']=="Chad") echo 'selected="selected"'; ?>>Chad</option>
   <option value="Channel Islands" <?php if($n['DestinationCountry']=="Channel Islands") echo 'selected="selected"'; ?>>Channel Islands</option>
   <option value="Chile" <?php if($n['DestinationCountry']=="Chile") echo 'selected="selected"'; ?>>Chile</option>
   <option value="China" <?php if($n['DestinationCountry']=="China") echo 'selected="selected"'; ?>>China</option>
   <option value="Christmas Island" <?php if($n['DestinationCountry']=="Christmas Island") echo 'selected="selected"'; ?>>Christmas Island</option>
   <option value="Cocos Island" <?php if($n['DestinationCountry']=="Cocos Island") echo 'selected="selected"'; ?>>Cocos Island</option>
   <option value="Colombia" <?php if($n['DestinationCountry']=="Colombia") echo 'selected="selected"'; ?>>Colombia</option>
   <option value="Comoros" <?php if($n['DestinationCountry']=="Comoros") echo 'selected="selected"'; ?>>Comoros</option>
   <option value="Congo" <?php if($n['DestinationCountry']=="Congo") echo 'selected="selected"'; ?>>Congo</option>
   <option value="Cook Islands" <?php if($n['DestinationCountry']=="Cook Islands") echo 'selected="selected"'; ?>>Cook Islands</option>
   <option value="Costa Rica" <?php if($n['DestinationCountry']=="Costa Rica") echo 'selected="selected"'; ?>>Costa Rica</option>
   <option value="Cote DIvoire" <?php if($n['DestinationCountry']=="Cote DIvoire") echo 'selected="selected"'; ?>>Cote DIvoire</option>
   <option value="Croatia" <?php if($n['DestinationCountry']=="Croatia") echo 'selected="selected"'; ?>>Croatia</option>
   <option value="Cuba" <?php if($n['DestinationCountry']=="Cuba") echo 'selected="selected"'; ?>>Cuba</option>
   <option value="Curaco" <?php if($n['DestinationCountry']=="Curaco") echo 'selected="selected"'; ?>>Curacao</option>
   <option value="Cyprus" <?php if($n['DestinationCountry']=="Cyprus") echo 'selected="selected"'; ?>>Cyprus</option>
   <option value="Czech Republic" <?php if($n['DestinationCountry']=="Czech Republic") echo 'selected="selected"'; ?>>Czech Republic</option>
   <option value="Denmark" <?php if($n['DestinationCountry']=="Denmark") echo 'selected="selected"'; ?>>Denmark</option>
   <option value="Djibouti" <?php if($n['DestinationCountry']=="Djibouti") echo 'selected="selected"'; ?>>Djibouti</option>
   <option value="Dominica" <?php if($n['DestinationCountry']=="Dominica") echo 'selected="selected"'; ?>>Dominica</option>
   <option value="Dominican Republic" <?php if($n['DestinationCountry']=="Dominican Republic") echo 'selected="selected"'; ?>>Dominican Republic</option>
   <option value="East Timor" <?php if($n['DestinationCountry']=="East Timor") echo 'selected="selected"'; ?>>East Timor</option>
   <option value="Ecuador" <?php if($n['DestinationCountry']=="Ecuador") echo 'selected="selected"'; ?>>Ecuador</option>
   <option value="Egypt" <?php if($n['DestinationCountry']=="Egypt") echo 'selected="selected"'; ?>>Egypt</option>
   <option value="El Salvador" <?php if($n['DestinationCountry']=="El Salvador") echo 'selected="selected"'; ?>>El Salvador</option>
   <option value="Equatorial Guinea" <?php if($n['DestinationCountry']=="Equatorial Guinea") echo 'selected="selected"'; ?>>Equatorial Guinea</option>
   <option value="Eritrea" <?php if($n['DestinationCountry']=="Eritrea") echo 'selected="selected"'; ?>>Eritrea</option>
   <option value="Estonia" <?php if($n['DestinationCountry']=="Estonia") echo 'selected="selected"'; ?>>Estonia</option>
   <option value="Ethiopia" <?php if($n['DestinationCountry']=="Ethiopia") echo 'selected="selected"'; ?>>Ethiopia</option>
   <option value="Falkland Islands" <?php if($n['DestinationCountry']=="Falkland Islands") echo 'selected="selected"'; ?>>Falkland Islands</option>
   <option value="Faroe Islands" <?php if($n['DestinationCountry']=="Faroe Islands") echo 'selected="selected"'; ?>>Faroe Islands</option>
   <option value="Fiji" <?php if($n['DestinationCountry']=="Fiji") echo 'selected="selected"'; ?>>Fiji</option>
   <option value="Finland" <?php if($n['DestinationCountry']=="Finland") echo 'selected="selected"'; ?>>Finland</option>
   <option value="France" <?php if($n['DestinationCountry']=="France") echo 'selected="selected"'; ?>>France</option>
   <option value="French Guiana" <?php if($n['DestinationCountry']=="French Guiana") echo 'selected="selected"'; ?>>French Guiana</option>
   <option value="French Polynesia" <?php if($n['DestinationCountry']=="French Polynesia") echo 'selected="selected"'; ?>>French Polynesia</option>
   <option value="French Southern Ter" <?php if($n['DestinationCountry']=="French Southern Ter") echo 'selected="selected"'; ?>>French Southern Ter</option>
   <option value="Gabon" <?php if($n['DestinationCountry']=="Gabon") echo 'selected="selected"'; ?>>Gabon</option>
   <option value="Gambia" <?php if($n['DestinationCountry']=="Gambia") echo 'selected="selected"'; ?>>Gambia</option>
   <option value="Georgia" <?php if($n['DestinationCountry']=="Georgia") echo 'selected="selected"'; ?>>Georgia</option>
   <option value="Germany" <?php if($n['DestinationCountry']=="Germany") echo 'selected="selected"'; ?>>Germany</option>
   <option value="Ghana" <?php if($n['DestinationCountry']=="Ghana") echo 'selected="selected"'; ?>>Ghana</option>
   <option value="Gibraltar" <?php if($n['DestinationCountry']=="Gibraltar") echo 'selected="selected"'; ?>>Gibraltar</option>
   <option value="Great Britain" <?php if($n['DestinationCountry']=="Great Britain") echo 'selected="selected"'; ?>>Great Britain</option>
   <option value="Greece" <?php if($n['DestinationCountry']=="Greece") echo 'selected="selected"'; ?>>Greece</option>
   <option value="Greenland" <?php if($n['DestinationCountry']=="Greenland") echo 'selected="selected"'; ?>>Greenland</option>
   <option value="Grenada" <?php if($n['DestinationCountry']=="Grenada") echo 'selected="selected"'; ?>>Grenada</option>
   <option value="Guadeloupe" <?php if($n['DestinationCountry']=="Guadeloupe") echo 'selected="selected"'; ?>>Guadeloupe</option>
   <option value="Guam" <?php if($n['DestinationCountry']=="Guam") echo 'selected="selected"'; ?>>Guam</option>
   <option value="Guatemala" <?php if($n['DestinationCountry']=="Guatemala") echo 'selected="selected"'; ?>>Guatemala</option>
   <option value="Guinea" <?php if($n['DestinationCountry']=="Guinea") echo 'selected="selected"'; ?>>Guinea</option>
   <option value="Guyana" <?php if($n['DestinationCountry']=="Guyana") echo 'selected="selected"'; ?>>Guyana</option>
   <option value="Haiti" <?php if($n['DestinationCountry']=="Haiti") echo 'selected="selected"'; ?>>Haiti</option>
   <option value="Hawaii" <?php if($n['DestinationCountry']=="Hawaii") echo 'selected="selected"'; ?>>Hawaii</option>
   <option value="Honduras" <?php if($n['DestinationCountry']=="Honduras") echo 'selected="selected"'; ?>>Honduras</option>
   <option value="Hong Kong" <?php if($n['DestinationCountry']=="Hong Kong") echo 'selected="selected"'; ?>>Hong Kong</option>
   <option value="Hungary" <?php if($n['DestinationCountry']=="Hungary") echo 'selected="selected"'; ?>>Hungary</option>
   <option value="Iceland" <?php if($n['DestinationCountry']=="Iceland") echo 'selected="selected"'; ?>>Iceland</option>
   <option value="Indonesia" <?php if($n['DestinationCountry']=="Indonesia") echo 'selected="selected"'; ?>>Indonesia</option>
   <option value="India" <?php if($n['DestinationCountry']=="India") echo 'selected="selected"'; ?>>India</option>
   <option value="Iran" <?php if($n['DestinationCountry']=="Iran") echo 'selected="selected"'; ?>>Iran</option>
   <option value="Iraq" <?php if($n['DestinationCountry']=="Iraq") echo 'selected="selected"'; ?>>Iraq</option>
   <option value="Ireland" <?php if($n['DestinationCountry']=="Ireland") echo 'selected="selected"'; ?>>Ireland</option>
   <option value="Isle of Man" <?php if($n['DestinationCountry']=="Isle of Man") echo 'selected="selected"'; ?>>Isle of Man</option>
   <option value="Israel" <?php if($n['DestinationCountry']=="Israel") echo 'selected="selected"'; ?>>Israel</option>
   <option value="Italy" <?php if($n['DestinationCountry']=="Italy") echo 'selected="selected"'; ?>>Italy</option>
   <option value="Jamaica" <?php if($n['DestinationCountry']=="Jamaica") echo 'selected="selected"'; ?>>Jamaica</option>
   <option value="Japan" <?php if($n['DestinationCountry']=="Japan") echo 'selected="selected"'; ?>>Japan</option> 
   <option value="Jordan" <?php if($n['DestinationCountry']=="Jordan") echo 'selected="selected"'; ?>>Jordan</option>
   <option value="Kazakhstan" <?php if($n['DestinationCountry']=="Kazakhstan") echo 'selected="selected"'; ?>>Kazakhstan</option>
   <option value="Kenya" <?php if($n['DestinationCountry']=="Kenya") echo 'selected="selected"'; ?>>Kenya</option>
   <option value="Kiribati" <?php if($n['DestinationCountry']=="Kiribati") echo 'selected="selected"'; ?>>Kiribati</option>
   <option value="Korea North" <?php if($n['DestinationCountry']=="Korea North") echo 'selected="selected"'; ?>>Korea North</option>
   <option value="Korea South" <?php if($n['DestinationCountry']=="Korea South") echo 'selected="selected"'; ?>>Korea South</option>
   <option value="Kuwait" <?php if($n['DestinationCountry']=="Kuwait") echo 'selected="selected"'; ?>>Kuwait</option>
   <option value="Kyrgyzstan" <?php if($n['DestinationCountry']=="Kyrgyzstan") echo 'selected="selected"'; ?>>Kyrgyzstan</option>
   <option value="Laos" <?php if($n['DestinationCountry']=="Laos") echo 'selected="selected"'; ?>>Laos</option>
   <option value="Latvia" <?php if($n['DestinationCountry']=="Latvia") echo 'selected="selected"'; ?>>Latvia</option>
   <option value="Lebanon" <?php if($n['DestinationCountry']=="Lebanon") echo 'selected="selected"'; ?>>Lebanon</option>
   <option value="Lesotho" <?php if($n['DestinationCountry']=="Lesotho") echo 'selected="selected"'; ?>>Lesotho</option>
   <option value="Liberia" <?php if($n['DestinationCountry']=="Liberia") echo 'selected="selected"'; ?>>Liberia</option>
   <option value="Libya" <?php if($n['DestinationCountry']=="Libya") echo 'selected="selected"'; ?>>Libya</option>
   <option value="Liechtenstein" <?php if($n['DestinationCountry']=="Liechtenstein") echo 'selected="selected"'; ?>>Liechtenstein</option>
   <option value="Lithuania" <?php if($n['DestinationCountry']=="Lithuania") echo 'selected="selected"'; ?>>Lithuania</option>
   <option value="Luxembourg" <?php if($n['DestinationCountry']=="Luxembourg") echo 'selected="selected"'; ?>>Luxembourg</option>
   <option value="Macau" <?php if($n['DestinationCountry']=="Macau") echo 'selected="selected"'; ?>>Macau</option>
   <option value="Macedonia" <?php if($n['DestinationCountry']=="Macedonia") echo 'selected="selected"'; ?>>Macedonia</option>
   <option value="Madagascar" <?php if($n['DestinationCountry']=="Madagascar") echo 'selected="selected"'; ?>>Madagascar</option>
   <option value="Malaysia" <?php if($n['DestinationCountry']=="Malaysia") echo 'selected="selected"'; ?>>Malaysia</option>
   <option value="Malawi" <?php if($n['DestinationCountry']=="Malawi") echo 'selected="selected"'; ?>>Malawi</option>
   <option value="Maldives" <?php if($n['DestinationCountry']=="Maldives") echo 'selected="selected"'; ?>>Maldives</option>
   <option value="Mali" <?php if($n['DestinationCountry']=="Mali") echo 'selected="selected"'; ?>>Mali</option>
   <option value="Malta" <?php if($n['DestinationCountry']=="Malta") echo 'selected="selected"'; ?>>Malta</option>
   <option value="Marshall Islands" <?php if($n['DestinationCountry']=="Marshall Islands") echo 'selected="selected"'; ?>>Marshall Islands</option>
   <option value="Martinique" <?php if($n['DestinationCountry']=="Martinique") echo 'selected="selected"'; ?>>Martinique</option>
   <option value="Mauritania" <?php if($n['DestinationCountry']=="Mauritania") echo 'selected="selected"'; ?>>Mauritania</option>
   <option value="Mauritius" <?php if($n['DestinationCountry']=="Mauritius") echo 'selected="selected"'; ?>> Mauritius</option>
   <option value="Mayotte" <?php if($n['DestinationCountry']=="Mayotte") echo 'selected="selected"'; ?>>Mayotte</option>
   <option value="Mexico" <?php if($n['DestinationCountry']=="Mexico") echo 'selected="selected"'; ?>>Mexico</option>
   <option value="Midway Islands" <?php if($n['DestinationCountry']=="Midway Islands") echo 'selected="selected"'; ?>>Midway Islands</option>
   <option value="Moldova" <?php if($n['DestinationCountry']=="Moldova") echo 'selected="selected"'; ?>>Moldova</option>
   <option value="Monaco" <?php if($n['DestinationCountry']=="Monaco") echo 'selected="selected"'; ?>>Monaco</option>
   <option value="Mongolia" <?php if($n['DestinationCountry']=="Mongolia") echo 'selected="selected"'; ?>>Mongolia</option>
   <option value="Montserrat" <?php if($n['DestinationCountry']=="Montserrat") echo 'selected="selected"'; ?>>Montserrat</option>
   <option value="Morocco" <?php if($n['DestinationCountry']=="Morocco") echo 'selected="selected"'; ?>>Morocco</option>
   <option value="Mozambique" <?php if($n['DestinationCountry']=="Mozambique") echo 'selected="selected"'; ?>>Mozambique</option>
   <option value="Myanmar" <?php if($n['DestinationCountry']=="Myanmar") echo 'selected="selected"'; ?>>Myanmar</option>
   <option value="Nambia" <?php if($n['DestinationCountry']=="Nambia") echo 'selected="selected"'; ?>>Nambia</option>
   <option value="Nauru" <?php if($n['DestinationCountry']=="Nauru") echo 'selected="selected"'; ?>>Nauru</option>
   <option value="Nepal" <?php if($n['DestinationCountry']=="Nepal") echo 'selected="selected"'; ?>>Nepal</option>
   <option value="Netherland Antilles" <?php if($n['DestinationCountry']=="Netherland Antilles") echo 'selected="selected"'; ?>>Netherland Antilles</option>
   <option value="Netherlands" <?php if($n['DestinationCountry']=="Netherlands") echo 'selected="selected"'; ?>>Netherlands (Holland, Europe)</option>
   <option value="Nevis" <?php if($n['DestinationCountry']=="Nevis") echo 'selected="selected"'; ?>>Nevis</option>
   <option value="New Caledonia" <?php if($n['DestinationCountry']=="New Caledonia") echo 'selected="selected"'; ?>>New Caledonia</option>
   <option value="New Zealand" <?php if($n['DestinationCountry']=="New Zealand") echo 'selected="selected"'; ?>>New Zealand</option>
   <option value="Nicaragua" <?php if($n['DestinationCountry']=="Nicaragua") echo 'selected="selected"'; ?>>Nicaragua</option>
   <option value="Niger" <?php if($n['DestinationCountry']=="Niger") echo 'selected="selected"'; ?>>Niger</option>
   <option value="Nigeria" <?php if($n['DestinationCountry']=="Nigeria") echo 'selected="selected"'; ?>>Nigeria</option>
   <option value="Niue" <?php if($n['DestinationCountry']=="Niue") echo 'selected="selected"'; ?>>Niue</option>
   <option value="Norfolk Island" <?php if($n['DestinationCountry']=="Norfolk Island") echo 'selected="selected"'; ?>>Norfolk Island</option>
   <option value="Norway" <?php if($n['DestinationCountry']=="Norway") echo 'selected="selected"'; ?>>Norway</option>
   <option value="Oman" <?php if($n['DestinationCountry']=="Oman") echo 'selected="selected"'; ?>>Oman</option>
   <option value="Pakistan" <?php if($n['DestinationCountry']=="Pakistan") echo 'selected="selected"'; ?>>Pakistan</option>
   <option value="Palau Island" <?php if($n['DestinationCountry']=="Palau Island") echo 'selected="selected"'; ?>>Palau Island</option>
   <option value="Palestine" <?php if($n['DestinationCountry']=="Palestine") echo 'selected="selected"'; ?>>Palestine</option>
   <option value="Panama" <?php if($n['DestinationCountry']=="Panama") echo 'selected="selected"'; ?>>Panama</option>
   <option value="Papua New Guinea" <?php if($n['DestinationCountry']=="Papua New Guinea") echo 'selected="selected"'; ?>>Papua New Guinea</option>
   <option value="Paraguay" <?php if($n['DestinationCountry']=="Paraguay") echo 'selected="selected"'; ?>>Paraguay</option>
   <option value="Peru" <?php if($n['DestinationCountry']=="Peru") echo 'selected="selected"'; ?>>Peru</option>
   <option value="Phillipines" <?php if($n['DestinationCountry']=="Phillipines") echo 'selected="selected"'; ?>>Philippines</option>
   <option value="Pitcairn Island" <?php if($n['DestinationCountry']=="Pitcairn Island") echo 'selected="selected"'; ?>>Pitcairn Island</option>
   <option value="Poland" <?php if($n['DestinationCountry']=="Poland") echo 'selected="selected"'; ?>>Poland</option>
   <option value="Portugal" <?php if($n['DestinationCountry']=="Portugal") echo 'selected="selected"'; ?>>Portugal</option>
   <option value="Puerto Rico" <?php if($n['DestinationCountry']=="Puerto Rico") echo 'selected="selected"'; ?>>Puerto Rico</option>
   <option value="Qatar" <?php if($n['DestinationCountry']=="Qatar") echo 'selected="selected"'; ?>>Qatar</option>
   <option value="Republic of Montenegro" <?php if($n['DestinationCountry']=="Republic of Montenegro") echo 'selected="selected"'; ?>>Republic of Montenegro</option>
   <option value="Republic of Serbia" <?php if($n['DestinationCountry']=="Republic of Serbia") echo 'selected="selected"'; ?>>Republic of Serbia</option>
   <option value="Reunion" <?php if($n['DestinationCountry']=="Reunion") echo 'selected="selected"'; ?>>Reunion</option>
   <option value="Romania" <?php if($n['DestinationCountry']=="Romania") echo 'selected="selected"'; ?>>Romania</option>
   <option value="Russia" <?php if($n['DestinationCountry']=="Russia") echo 'selected="selected"'; ?>>Russia</option>
   <option value="Rwanda" <?php if($n['DestinationCountry']=="Rwanda") echo 'selected="selected"'; ?>>Rwanda</option>
   <option value="St Barthelemy" <?php if($n['DestinationCountry']=="St Barthelemy") echo 'selected="selected"'; ?>>St Barthelemy</option>
   <option value="St Eustatius" <?php if($n['DestinationCountry']=="St Eustatius") echo 'selected="selected"'; ?>>St Eustatius</option>
   <option value="St Helena" <?php if($n['DestinationCountry']=="St Helena") echo 'selected="selected"'; ?>>St Helena</option>
   <option value="St Kitts-Nevis" <?php if($n['DestinationCountry']=="St Kitts-Nevis") echo 'selected="selected"'; ?>>St Kitts-Nevis</option>
   <option value="St Lucia" <?php if($n['DestinationCountry']=="St Lucia") echo 'selected="selected"'; ?>>St Lucia</option>
   <option value="St Maarten" <?php if($n['DestinationCountry']=="St Maarten") echo 'selected="selected"'; ?>>St Maarten</option>
   <option value="St Pierre & Miquelon" <?php if($n['DestinationCountry']=="St Pierre & Miquelon") echo 'selected="selected"'; ?>>St Pierre & Miquelon</option>
   <option value="St Vincent & Grenadines" <?php if($n['DestinationCountry']=="St Vincent & Grenadines") echo 'selected="selected"'; ?>>St Vincent & Grenadines</option>
   <option value="Saipan" <?php if($n['DestinationCountry']=="Saipan") echo 'selected="selected"'; ?>>Saipan</option>
   <option value="Samoa" <?php if($n['DestinationCountry']=="Samoa") echo 'selected="selected"'; ?>>Samoa</option>
   <option value="Samoa American" <?php if($n['DestinationCountry']=="Samoa American") echo 'selected="selected"'; ?>>Samoa American</option>
   <option value="San Marino" <?php if($n['DestinationCountry']=="San Marino") echo 'selected="selected"'; ?>>San Marino</option>
   <option value="Sao Tome & Principe" <?php if($n['DestinationCountry']=="Sao Tome & Principe") echo 'selected="selected"'; ?>>Sao Tome & Principe</option>
   <option value="Saudi Arabia" <?php if($n['DestinationCountry']=="Saudi Arabia") echo 'selected="selected"'; ?>>Saudi Arabia</option>
   <option value="Senegal" <?php if($n['DestinationCountry']=="Senegal") echo 'selected="selected"'; ?>>Senegal</option>
   <option value="Seychelles" <?php if($n['DestinationCountry']=="Seychelles") echo 'selected="selected"'; ?>>Seychelles</option>
   <option value="Sierra Leone" <?php if($n['DestinationCountry']=="Sierra Leone") echo 'selected="selected"'; ?>>Sierra Leone</option>
   <option value="Singapore" <?php if($n['DestinationCountry']=="Singapore") echo 'selected="selected"'; ?>>Singapore</option>
   <option value="Slovakia" <?php if($n['DestinationCountry']=="Slovakia") echo 'selected="selected"'; ?>>Slovakia</option>
   <option value="Slovenia" <?php if($n['DestinationCountry']=="Slovenia") echo 'selected="selected"'; ?>>Slovenia</option>
   <option value="Solomon Islands" <?php if($n['DestinationCountry']=="Solomon Islands") echo 'selected="selected"'; ?>>Solomon Islands</option>
   <option value="Somalia" <?php if($n['DestinationCountry']=="Somalia") echo 'selected="selected"'; ?>>Somalia</option>
   <option value="South Africa" <?php if($n['DestinationCountry']=="South Africa") echo 'selected="selected"'; ?>>South Africa</option>
   <option value="Spain" <?php if($n['DestinationCountry']=="Spain") echo 'selected="selected"'; ?>>Spain</option>
   <option value="Sri Lanka" <?php if($n['DestinationCountry']=="Sri Lanka") echo 'selected="selected"'; ?>>Sri Lanka</option>
   <option value="Sudan" <?php if($n['DestinationCountry']=="Sudan") echo 'selected="selected"'; ?>>Sudan</option>
   <option value="Suriname" <?php if($n['DestinationCountry']=="Suriname") echo 'selected="selected"'; ?>>Suriname</option>
   <option value="Swaziland" <?php if($n['DestinationCountry']=="Swaziland") echo 'selected="selected"'; ?>>Swaziland</option>
   <option value="Sweden" <?php if($n['DestinationCountry']=="Sweden") echo 'selected="selected"'; ?>>Sweden</option>
   <option value="Switzerland" <?php if($n['DestinationCountry']=="Switzerland") echo 'selected="selected"'; ?>>Switzerland</option>
   <option value="Syria" <?php if($n['DestinationCountry']=="Syria") echo 'selected="selected"'; ?>>Syria</option>
   <option value="Tahiti" <?php if($n['DestinationCountry']=="Tahiti") echo 'selected="selected"'; ?>>Tahiti</option>
   <option value="Taiwan" <?php if($n['DestinationCountry']=="Taiwan") echo 'selected="selected"'; ?>>Taiwan</option>
   <option value="Tajikistan" <?php if($n['DestinationCountry']=="Tajikistan") echo 'selected="selected"'; ?>>Tajikistan</option>
   <option value="Tanzania" <?php if($n['DestinationCountry']=="Tanzania") echo 'selected="selected"'; ?>>Tanzania</option>
   <option value="Thailand" <?php if($n['DestinationCountry']=="Thailand") echo 'selected="selected"'; ?>>Thailand</option>
   <option value="Togo" <?php if($n['DestinationCountry']=="Togo") echo 'selected="selected"'; ?>>Togo</option>
   <option value="Tokelau" <?php if($n['DestinationCountry']=="Tokelau") echo 'selected="selected"'; ?>>Tokelau</option>
   <option value="Tonga" <?php if($n['DestinationCountry']=="Tonga") echo 'selected="selected"'; ?>>Tonga</option>
   <option value="Trinidad & Tobago" <?php if($n['DestinationCountry']=="Trinidad & Tobago") echo 'selected="selected"'; ?>>Trinidad & Tobago</option>
   <option value="Tunisia" <?php if($n['DestinationCountry']=="Tunisia") echo 'selected="selected"'; ?>>Tunisia</option>
   <option value="Turkey" <?php if($n['DestinationCountry']=="Turkey") echo 'selected="selected"'; ?>>Turkey</option>
   <option value="Turkmenistan" <?php if($n['DestinationCountry']=="Turkmenistan") echo 'selected="selected"'; ?>>Turkmenistan</option>
   <option value="Turks & Caicos Is" <?php if($n['DestinationCountry']=="Turks & Caicos Is") echo 'selected="selected"'; ?>>Turks & Caicos Is</option>
   <option value="Tuvalu" <?php if($n['DestinationCountry']=="Tuvalu") echo 'selected="selected"'; ?>>Tuvalu</option>
   <option value="Uganda" <?php if($n['DestinationCountry']=="Uganda") echo 'selected="selected"'; ?>>Uganda</option>
   <option value="United Kingdom" <?php if($n['DestinationCountry']=="United Kingdom") echo 'selected="selected"'; ?>>United Kingdom</option>
   <option value="Ukraine" <?php if($n['DestinationCountry']=="Ukraine") echo 'selected="selected"'; ?>>Ukraine</option>
   <option value="United Arab Erimates" <?php if($n['DestinationCountry']=="United Arab Erimates") echo 'selected="selected"'; ?>>United Arab Emirates</option>
   <option value="United States of America" <?php if($n['DestinationCountry']=="United States of America") echo 'selected="selected"'; ?>>United States of America</option>
   <option value="Uraguay" <?php if($n['DestinationCountry']=="Uraguay") echo 'selected="selected"'; ?>>Uruguay</option>
   <option value="Uzbekistan" <?php if($n['DestinationCountry']=="Uzbekistan") echo 'selected="selected"'; ?>>Uzbekistan</option>
   <option value="Vanuatu" <?php if($n['DestinationCountry']=="Vanuatu") echo 'selected="selected"'; ?>>Vanuatu</option>
   <option value="Vatican City State" <?php if($n['DestinationCountry']=="Vatican City State") echo 'selected="selected"'; ?>>Vatican City State</option>
   <option value="Venezuela" <?php if($n['DestinationCountry']=="Venezuela") echo 'selected="selected"'; ?>>Venezuela</option>
   <option value="Vietnam" <?php if($n['DestinationCountry']=="Vietnam") echo 'selected="selected"'; ?>>Vietnam</option>
   <option value="Virgin Islands (Brit)" <?php if($n['DestinationCountry']=="Virgin Islands (Brit)") echo 'selected="selected"'; ?>>Virgin Islands (Brit)</option>
   <option value="Virgin Islands (USA)" <?php if($n['DestinationCountry']=="Virgin Islands (USA)") echo 'selected="selected"'; ?>>Virgin Islands (USA)</option>
   <option value="Wake Island" <?php if($n['DestinationCountry']=="Wake Island") echo 'selected="selected"'; ?>>Wake Island</option>
   <option value="Wallis & Futana Is" <?php if($n['DestinationCountry']=="Wallis & Futana Is") echo 'selected="selected"'; ?>>Wallis & Futana Is</option>
   <option value="Yemen" <?php if($n['DestinationCountry']=="Yemen") echo 'selected="selected"'; ?>>Yemen</option>
   <option value="Zaire" <?php if($n['DestinationCountry']=="Zaire") echo 'selected="selected"'; ?>>Zaire</option>
   <option value="Zambia" <?php if($n['DestinationCountry']=="Zambia") echo 'selected="selected"'; ?>>Zambia</option>
   <option value="Zimbabwe" <?php if($n['DestinationCountry']=="Zimbabwe") echo 'selected="selected"'; ?>>Zimbabwe</option>
 </select>
 <br> <br>
 Start Date:<span class="red-star">* </span> 
 <input type="date" id="StartDate" name="StartDate" value = "<?php echo $n['StartDate']; ?>"> &nbsp; &nbsp;
 End Date:<span class="red-star">* </span> <input type="date" id="EndDate" name="EndDate" value = "<?php echo $n['EndDate']; ?>"> 
 <br> <br> 
 <span class="italic-font"> Actual Departure: </span> <input type="date" id="ActualDeparture" name="ActualDeparture" value = "<?php echo $n['ActualDeparture']; ?>"> &nbsp; &nbsp;
 <span class="italic-font"> Actual Arrival: </span> <input type="date" id="ActualArrival" name="ActualArrival" value = "<?php echo $n['ActualArrival']; ?>"> 
 <br> <br> 
 Purpose of visit:<span class="red-star">* </span>    

 <select name="Purpose" onchange='CheckPlace(this.value); ' text-align:center>
    <option value="" ></option> 
    <option value="Official Trip" <?php if($n['Purpose']=="Official Trip") echo 'selected="selected"'; ?>>Official Trip</option>
    <option value="EBL" <?php if($n['Purpose']=="EBL") echo 'selected="selected"'; ?>>Ex-Bangladesh leave (Religious/Medical/Family Visit/Tourism etc.)</option>
     <option value="Deputation" <?php if($n['Purpose']=="Deputation") echo 'selected="selected"'; ?>>Deputation</option>
    <option value="Study Leave" <?php if($n['Purpose']=="Study Leave") echo 'selected="selected"'; ?>>Study Leave</option>
    <option value="Lien" <?php if($n['Purpose']=="Lien") echo 'selected="selected"'; ?>>Lien</option>
    <option value="EL" <?php if($n['Purpose']=="EL") echo 'selected="selected"'; ?>>Extraordinary Leave</option> 
    <option value="Others" <?php if($n['Purpose']=="Others") echo 'selected="selected"'; ?>>Others</option>
 </select> 
 &nbsp; &nbsp; Funding Source:<span class="red-star">* </span>
 <select name="FundingSource" onchange='CheckPlace(this.value); ' text-align:center>
    <option value="" ></option> 
    <option value="Self" <?php if($n['FundingSource']=="Self") echo 'selected="selected"'; ?>>Self</option>
    <option value="GoB" <?php if($n['FundingSource']=="GoB") echo 'selected="selected"'; ?>>GoB</option>
    <option value="Project" <?php if($n['FundingSource']=="Project") echo 'selected="selected"'; ?>>Project</option>
    <option value="BO" <?php if($n['FundingSource']=="BO") echo 'selected="selected"'; ?>>Bangladeshi Organisation</option>
    <option value="IO" <?php if($n['FundingSource']=="IO") echo 'selected="selected"'; ?>>International Organisation</option>
    <option value="FS" <?php if($n['FundingSource']=="FS") echo 'selected="selected"'; ?>>Foreign Scholarship</option> 
    <option value="BS" <?php if($n['FundingSource']=="BS") echo 'selected="selected"'; ?>>Bangladeshi Scholarship</option> 
    <option value="University" <?php if($n['FundingSource']=="University") echo 'selected="selected"'; ?>>University</option> 
    <option value="Employer" <?php if($n['FundingSource']=="Employer") echo 'selected="selected"'; ?>>Employer</option>
    <option value="Others" <?php if($n['FundingSource']=="Others") echo 'selected="selected"'; ?>>Others</option>
 </select>
 <br> <br>
 Upload the GO (pdf/jpg):<span class="red-star">* </span> <input type="file" id="file" name="file"><br><br>

<?php if ($update == true): ?>
   <input type="button" class="button2" onclick="myFunction()" value="Update">
<?php else: ?>
   <input type="button" class="button2" onclick="myFunction()" value="Submit">
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

function myFunction() {
  let x = document.forms["frm1"]["serviceID"].value;
  if (x == "") {
    alert("Service ID must be filled out.");
    return false;
  }//"cadreEdit" 
  
 <?php if ($update == false): ?>
  let x2 = document.forms["frm1"]["cadreName"].value;
  if (x2 == "") {
    alert("Cadre must be selected.");
    return false;
  } 
  <?php endif ?>

  <?php if ($update == true): ?>
  let x2 = document.forms["frm1"]["cadreEdit"].value;
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
    alert("Designation must be written.");
    return false; 
  }
  if ((z == "Others")) { 
  	let zOthers = document.forms["frm1"]["desigOthers"].value; 
  	if(zOthers == ""){
    	alert("Designation must be written.");
    	return false;   		
  	}

  }    
  <?php endif ?> 
  <?php if ($update == false): ?>
  let z = document.forms["frm1"]["designation2"].value;
  if (z == "") {
    alert("Designation must be selected.");
    return false; 
  }
  if ((z == "Others")) { 
  	let zOthers = document.forms["frm1"]["desigOthers"].value; 
  	if(zOthers == "") {
    	alert("Designation must be written.");
    	return false;   		
  	}

  }      
  <?php endif ?>
  let z2 = document.forms["frm1"]["grade"].value;
  if (z2 == "") {
    alert("Grade must be filled out.");
    return false;
  }// StartDate     

  let a = document.forms["frm1"]["workplace"].value;
  if (a == "") {
    alert("Workplace must be filled out.");
    return false;
  }
  let a2 = document.forms["frm1"]["destCountry"].value;// StartDate     destCountry
  if (a2 == "") {
    alert("Destination Country must be selected.");
    return false;
  }// StartDate       
  let b = document.forms["frm1"]["StartDate"].value;
  if (b == "") {
    alert("Start Date must be filled out.");
    return false;
  }// StartDate      
  let c = document.forms["frm1"]["EndDate"].value;
  if (c == "") { 
    alert("End Date must be filled out.");
    return false;
  }// //Purpose,  FundingSource //file
  let d = document.forms["frm1"]["Purpose"].value;
  if (d == "") {
    alert("Purpose must be filled out.");
    return false;
  }  
  let e = document.forms["frm1"]["FundingSource"].value;
  if (e == "") {
    alert("Funding Source must be filled out.");
    return false;
  }  
  let f = document.forms["frm1"]["file"].value;
  if (f == "") {
    alert("GO must be uploaded.");
    return false;
  }      

  if(confirm("Are you sure to submit?")){ 
    document.getElementById("frm1").submit();  
  }
  
}
</script>

 