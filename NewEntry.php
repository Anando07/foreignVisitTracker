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
   EDIT MODE
========================= */
$update = false;
$data = [];

if (!empty($_GET['edit'])) {
    $update = true;
    $id = (int)$_GET['edit'];

    $stmt = $db->prepare("SELECT * FROM ForeignVisit WHERE ID=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $data = $stmt->get_result()->fetch_assoc();

    if (!$data) exit("Record not found");
}
?>

<div class="fvt-card">
    <div class="fvt-header">
        <?= $update ? "✏️ Edit Foreign Visit" : "➕ New Foreign Visit Entry" ?>
    </div>

<form id="foreignVisitForm" method="post" action="../action_page.php" enctype="multipart/form-data">
<input type="hidden" name="update" value="<?= $update?1:0 ?>">
<input type="hidden" name="id" value="<?= $data['ID'] ?? '' ?>">

<div class="fvt-grid">

<!-- Service ID -->
<div class="fvt-group">
<label>Service ID <span class="required">*</span></label>
<input type="number" name="serviceID" class="fvt-input" required value="<?= $data['ServiceID'] ?? '' ?>">
</div>

<!-- Cadre -->
<div class="fvt-group">
<label>Cadre <span class="required">*</span></label>
<select name="cadreName" id="cadreName" class="fvt-input" required>
<option value="">Select</option>
<?php
foreach (file("../data/cadre.txt", FILE_IGNORE_NEW_LINES) as $line) {
    [$value, $label] = array_map('trim', explode('|', $line));
    $sel = (($data['Cadre'] ?? '') === $value) ? 'selected' : '';
    echo "<option value=\"$value\" $sel>$label</option>";
}
?>
</select>
</div>

<!-- Name -->
<div class="fvt-group">
<label>Name <span class="required">*</span></label>
<input type="text" name="name" class="fvt-input" required value="<?= $data['Name'] ?? '' ?>">
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
</div>

<!-- Designation -->
<div class="fvt-group">
<label>Designation <span class="required">*</span></label>
<select name="designation" id="designation" class="fvt-input" required>
<option value="">Select Office First</option>
</select>
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
</div>

<!-- Workplace -->
<div class="fvt-group">
<label>Workplace <span class="required">*</span></label>
<input type="text" name="workplace" class="fvt-input" required value="<?= $data['Workplace'] ?? '' ?>">
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
</div>

<!-- Purpose -->
<div class="fvt-group">
<label>Purpose <span class="required">*</span></label>
<select name="purpose" class="fvt-input" required>
    <option value="">Select</option>
    <?php
    foreach(file("../data/visit_purpose.txt", FILE_IGNORE_NEW_LINES) as $line){
        list($code, $display) = explode('|', $line);
        $sel = (($data['Purpose']??'') == $code) ? 'selected' : '';
        echo "<option value='$code' $sel>$display</option>";
    }
    ?>
</select>

</div>

<!-- Fund -->
<div class="fvt-group">
<label>Fund <span class="required">*</span></label>
<select name="fund" class="fvt-input" required>
<option value="">Select</option>
<?php
foreach(file("../data/fund.txt", FILE_IGNORE_NEW_LINES) as $f){
    $sel = (($data['Fund']??'')==$f)?'selected':'';
    echo "<option $sel>$f</option>";
}
?>
</select>
</div>

<!-- Dates -->
<div class="fvt-group">
<label>From Date <span class="required">*</span></label>
<input type="date" name="from_date" class="fvt-input" required value="<?= $data['FromDate'] ?? '' ?>">
</div>

<div class="fvt-group">
<label>To Date <span class="required">*</span></label>
<input type="date" name="to_date" class="fvt-input" required value="<?= $data['ToDate'] ?? '' ?>">
</div>

<div class="fvt-group">
<label>Actual Departure</label>
<input type="date" name="actual_departure" class="fvt-input" value="<?= $data['ActualDeparture'] ?? '' ?>">
</div>

<div class="fvt-group">
<label>Actual Arrival</label>
<input type="date" name="actual_arrival" class="fvt-input" value="<?= $data['ActualArrival'] ?? '' ?>">
</div>

<!-- GO File -->
<div class="fvt-group">
<label>GO / Order File <?= $update?'':'<span class="required">*</span>' ?></label>
<input type="file" name="go_file" class="fvt-input" <?= $update?'':'required' ?>>
</div>

</div>

<div class="fvt-actions">
<a href="base.php?page=ShowDashboard" class="fvt-btn fvt-btn-secondary">Cancel</a>
<button type="submit" class="fvt-btn fvt-btn-success"><?= $update?'Update':'Submit' ?></button>
</div>
</form>

<script>
    // Pass selected designation for edit mode
    document.getElementById('designation').dataset.selected = "<?= $data['Designation'] ?? '' ?>";
</script>


