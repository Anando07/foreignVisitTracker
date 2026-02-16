<?php
/* =========================
   AUTHORIZATION
========================= */
if (!isset($_SESSION['role_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

if (!in_array((int)$_SESSION['role_id'], [1,2,5], true)) {
    header("Location: base.php?page=home");
    exit;
}

/* =========================
   EDIT MODE / UNREPORTED MODE
========================= */
$update = false;
$isUnreportedMode = false;  // flag for unreported visits
$data = [];

if (!empty($_GET['edit']) || !empty($_GET['id']) || !empty($_GET['unreported'])) {
    $update = true;

    if (!empty($_GET['unreported'])) {
        $id = (int)$_GET['unreported'];
        $isUnreportedMode = true;
    } else {
        $id = isset($_GET['edit']) ? (int)$_GET['edit'] : (int)$_GET['id'];
    }

    $stmt = $db->prepare("SELECT * FROM ForeignVisit WHERE ID=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $data = $stmt->get_result()->fetch_assoc();

    if (!$data) {
        exit("Record not found");
    }
}

// Determine required flags
$goRequired = !$isUnreportedMode; // GO file required only in New/Edit
$datesRequired = $isUnreportedMode; // Actual Departure/Arrival required only in Unreported
?>

<div class="fvt-card">
    <div class="fvt-header">
        <?= $update
            ? ($isUnreportedMode ? "✏️ Edit Unreported Visit" : "✏️ Edit Foreign Visit")
            : "➕ New Foreign Visit Entry"
        ?>
    </div>

    <form id="foreignVisitForm" method="post" action="../action_page.php" enctype="multipart/form-data">
        <input type="hidden" name="update" value="<?= $update ? 1 : 0 ?>">
        <input type="hidden" name="id" value="<?= $data['ID'] ?? '' ?>">
        <input type="hidden" name="unreported_mode" value="<?= $isUnreportedMode ? 1 : 0 ?>">

        <div class="fvt-grid">

            <!-- Service ID -->
            <div class="fvt-group">
                <label>Service ID <span class="required">*</span></label>
                <input type="number" name="serviceID" class="fvt-input" required value="<?= $data['ServiceID'] ?? '' ?>">
                <div class="error-msg"></div>
            </div>

            <!-- Cadre -->
            <div class="fvt-group">
                <label>Cadre <span class="required">*</span></label>
                <select name="cadreName" class="fvt-input" required>
                    <option value="">Select</option>
                    <?php
                    foreach(file("../data/cadre.txt", FILE_IGNORE_NEW_LINES) as $line){
                        [$value,$label] = array_map('trim', explode('|',$line));
                        $sel = (($data['Cadre'] ?? '') === $value) ? 'selected' : '';
                        echo "<option value='$value' $sel>$label</option>";
                    }
                    ?>
                </select>
                <div class="error-msg"></div>
            </div>

            <!-- Name -->
            <div class="fvt-group">
                <label>Name <span class="required">*</span></label>
                <input type="text" name="name" class="fvt-input" required value="<?= $data['Name'] ?? '' ?>">
                <div class="error-msg"></div>
            </div>
           
            <!-- Passport -->
            <div class="fvt-group">
                <label>Passport No</label>
                <input type="text" name="passport" class="fvt-input" value="<?= $data['Passport'] ?? '' ?>">
                <div class="error-msg"></div>
            </div>
            
            <!-- NID -->
            <div class="fvt-group">
                <label>NID</label>
                <input type="text" name="nid" class="fvt-input" value="<?= $data['NID'] ?? '' ?>">
                <div class="error-msg"></div>
            </div>

            <!-- Office -->
            <div class="fvt-group">
                <label>Office <span class="required">*</span></label>
                <select name="office" id="office" class="fvt-input" required>
                    <option value="">Select</option>
                    <?php
                    $offices = ["MoF"=>"Ministry of Finance","IRD"=>"IRD","NBR"=>"NBR","NSD"=>"NSD","TAT"=>"TAT","CEVT"=>"CEVT"];
                    foreach($offices as $k=>$v){
                        $sel = (($data['Office'] ?? '')==$k)?'selected':''; 
                        echo "<option value='$k' $sel>$v</option>";
                    }
                    ?>
                </select>
                <div class="error-msg"></div>
            </div>

            <!-- Designation -->
            <div class="fvt-group">
                <label>Designation <span class="required">*</span></label>
                <select name="designation" id="designation" class="fvt-input" required>
                    <option value="">Select Office First</option>
                </select>
                <div class="error-msg"></div>
            </div>

            <!-- Grade -->
            <div class="fvt-group">
                <label>Grade <span class="required">*</span></label>
                <select name="grade" class="fvt-input" required>
                    <option value="">Select</option>
                    <?php for($i=1; $i<=20; $i++): ?>
                    <option value="<?= $i ?>" <?= (($data['Grade']??'')==$i)?'selected':'' ?>>Grade-<?= $i ?></option>
                    <?php endfor; ?>
                </select>
                <div class="error-msg"></div>
            </div>

            <!-- Workplace -->
            <div class="fvt-group">
                <label>Workplace <span class="required">*</span></label>
                <input type="text" name="workplace" class="fvt-input" required value="<?= $data['Workplace'] ?? '' ?>">
                <div class="error-msg"></div>
            </div>

            <!-- Destination Country -->
            <div class="fvt-group">
                <label>Destination Country <span class="required">*</span></label>
                <select name="destination_country" class="fvt-input" required>
                    <option value="">Select</option>
                    <?php
                    foreach(file("../data/countries.txt", FILE_IGNORE_NEW_LINES) as $c){
                        $sel = (($data['DestinationCountry']??'')==$c)?'selected':''; 
                        echo "<option $sel>$c</option>";
                    }
                    ?>
                </select>
                <div class="error-msg"></div>
            </div>

            <!-- Purpose -->
            <div class="fvt-group">
                <label>Purpose <span class="required">*</span></label>
                <select name="purpose" class="fvt-input" required>
                    <option value="">Select</option>
                    <?php
                    foreach(file("../data/visit_purpose.txt", FILE_IGNORE_NEW_LINES) as $line){
                        [$code,$display] = explode('|',$line);
                        $sel = (($data['Purpose']??'')==$code)?'selected':''; 
                        echo "<option value='$code' $sel>$display</option>";
                    }
                    ?>
                </select>
                <div class="error-msg"></div>
            </div>

            <!-- Fund -->
            <div class="fvt-group">
                <label>Fund <span class="required">*</span></label>
                <select name="fund" class="fvt-input" required>
                    <option value="">Select</option>
                    <?php
                    foreach(file("../data/fund.txt", FILE_IGNORE_NEW_LINES) as $f){
                        $sel = (($data['FundingSource']??'')==$f)?'selected':''; 
                        echo "<option $sel>$f</option>";
                    }
                    ?>
                </select>
                <div class="error-msg"></div>
            </div>

            <!-- Dates -->
            <div class="fvt-group">
                <label>From Date <span class="required">*</span></label>
                <input type="date" name="from_date" class="fvt-input" required value="<?= $data['StartDate'] ?? '' ?>">
                <div class="error-msg"></div>
            </div>

            <div class="fvt-group">
                <label>To Date <span class="required">*</span></label>
                <input type="date" name="to_date" class="fvt-input" required value="<?= $data['EndDate'] ?? '' ?>">
                <div class="error-msg"></div>
            </div>

            <!-- Actual Departure -->
            <div class="fvt-group">
                <label>Actual Departure <?= $datesRequired ? '<span class="required">*</span>' : '' ?></label>
                <input type="date" name="actual_departure" class="fvt-input" <?= $datesRequired ? 'required' : '' ?> value="<?= $data['ActualDeparture'] ?? '' ?>">
                <div class="error-msg"></div>
            </div>

            <!-- Actual Arrival -->
            <div class="fvt-group">
                <label>Actual Arrival <?= $datesRequired ? '<span class="required">*</span>' : '' ?></label>
                <input type="date" name="actual_arrival" class="fvt-input" <?= $datesRequired ? 'required' : '' ?> value="<?= $data['ActualArrival'] ?? '' ?>">
                <div class="error-msg"></div>
            </div>

            <!-- GO File -->
            <div class="fvt-group">
                <label>GO / Order File <?= $goRequired ? '<span class="required">*</span>' : '' ?></label>
                <input type="file" name="go_file" class="fvt-input" <?= $goRequired ? 'required' : '' ?>>
                <div class="error-msg"></div>
            </div>

        </div>

        <div style="text-align: center;" class="fvt-actions">
            <button type="reset" class="fvt-btn fvt-btn-secondary">Reset</button>
            <button type="submit" class="fvt-btn fvt-btn-success"><?= $update?'Update':'Submit' ?></button>
        </div>
    </form>
</div>

<script>
document.getElementById("foreignVisitForm").addEventListener("submit", function(e){
    let ok=true;
    document.querySelectorAll(".error-msg").forEach(x=>x.innerText="");
    document.querySelectorAll(".fvt-input").forEach(x=>x.classList.remove("error"));

    function err(el,msg){
        el.classList.add("error");
        el.nextElementSibling.innerText=msg;
        ok=false;
    }

    document.querySelectorAll(".fvt-input[required]").forEach(el=>{
        if(!el.value) err(el,"Required");
    });

    let f=document.querySelector("[name='from_date']").value;
    let t=document.querySelector("[name='to_date']").value;
    if(f && t && t<f) err(document.querySelector("[name='to_date']"),"End date cannot be before start date");

    // Only validate actual dates if required
    let dep=document.querySelector("[name='actual_departure']");
    let arr=document.querySelector("[name='actual_arrival']");
    if(dep.required && arr.required && dep.value && arr.value && arr.value<dep.value)
        err(arr,"Arrival cannot be before departure");

    // GO file validation if required
    let file=document.querySelector("[name='go_file']");
    if(file.required && file.files.length){
        let ext=file.files[0].name.split('.').pop().toLowerCase();
        if(!['pdf','jpg','jpeg'].includes(ext)) err(file,"Only PDF/JPG allowed");
        if(file.files[0].size>512*1024) err(file,"Max 512 KB");
    }

    if(!ok) e.preventDefault();
});

document.getElementById('designation').dataset.selected = "<?= $data['Designation'] ?? '' ?>";
</script>
