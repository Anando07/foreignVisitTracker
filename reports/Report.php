<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();

/* =========================
   FORM INPUTS
========================= */
$searchType  = $_POST['search_type']  ?? '';
$searchValue = $_POST['search_value'] ?? '';
$startDate   = $_POST['start_date'] ?? '';
$endDate     = $_POST['end_date'] ?? '';

$result = null; // Initialize empty

/* =========================
   Only run query if Search button is clicked
========================= */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /* =========================
       BASE QUERY
    ========================== */
    $sql = "
        SELECT 
            fv.*,
            a.name AS uploader_name
        FROM ForeignVisit fv
        LEFT JOIN admin a ON a.ID = fv.Uploader
        WHERE 1=1
    ";

    /* =========================
       FILTERS
    ========================== */
    if (!empty($searchType) && !empty($searchValue)) {
        $escapedValue = mysqli_real_escape_string($db, $searchValue);

        switch($searchType) {
            case 'service_id': $sql .= " AND fv.ServiceID = '$escapedValue'"; break;
            case 'name':       $sql .= " AND fv.Name LIKE '%$escapedValue%'"; break;
            case 'designation':$sql .= " AND fv.Designation LIKE '%$escapedValue%'"; break;
            case 'cadre':      $sql .= " AND fv.Cadre LIKE '%$escapedValue%'"; break;
            case 'office':     $sql .= " AND fv.Office LIKE '%$escapedValue%'"; break;
            case 'country':    $sql .= " AND fv.DestinationCountry LIKE '%$escapedValue%'"; break;
            case 'fund':       $sql .= " AND fv.FundingSource LIKE '%$escapedValue%'"; break;
            case 'purpose':    $sql .= " AND fv.Purpose LIKE '%$escapedValue%'"; break;
        }
    }

    if (!empty($startDate) && !empty($endDate)) {
        $sql .= " AND fv.StartDate BETWEEN '" . mysqli_real_escape_string($db, $startDate) . "' 
                                     AND '" . mysqli_real_escape_string($db, $endDate) . "'";
    }

    $sql .= " ORDER BY fv.StartDate DESC";

    // Execute query
    $result = mysqli_query($db, $sql);
}

/* =========================
   DROPDOWN DATA FOR DATALIST
========================= */
$services     = [];
$names        = [];
$designations = [];
$cadres       = [];
$offices      = [];
$countries    = [];
$funds        = [];
$purposes     = [];

$res = mysqli_query($db, "SELECT DISTINCT ServiceID FROM ForeignVisit ORDER BY ServiceID");
while($row = mysqli_fetch_assoc($res)) $services[] = $row['ServiceID'];

$res = mysqli_query($db, "SELECT DISTINCT Name FROM ForeignVisit ORDER BY Name");
while($row = mysqli_fetch_assoc($res)) $names[] = $row['Name'];

$res = mysqli_query($db, "SELECT DISTINCT Designation FROM ForeignVisit ORDER BY Designation");
while($row = mysqli_fetch_assoc($res)) $designations[] = $row['Designation'];

$res = mysqli_query($db, "SELECT DISTINCT Cadre FROM ForeignVisit ORDER BY Cadre");
while($row = mysqli_fetch_assoc($res)) $cadres[] = $row['Cadre'];

$res = mysqli_query($db, "SELECT DISTINCT Office FROM ForeignVisit ORDER BY Office");
while($row = mysqli_fetch_assoc($res)) $offices[] = $row['Office'];

$res = mysqli_query($db, "SELECT DISTINCT DestinationCountry FROM ForeignVisit ORDER BY DestinationCountry");
while($row = mysqli_fetch_assoc($res)) $countries[] = $row['DestinationCountry'];

$res = mysqli_query($db, "SELECT DISTINCT FundingSource FROM ForeignVisit ORDER BY FundingSource");
while($row = mysqli_fetch_assoc($res)) $funds[] = $row['FundingSource'];

$res = mysqli_query($db, "SELECT DISTINCT Purpose FROM ForeignVisit ORDER BY Purpose");
while($row = mysqli_fetch_assoc($res)) $purposes[] = $row['Purpose'];
?>

<div class="fvt-card">
    <h2 class="report-title">Time Based Different Type Report</h2>

    <form method="post" class="fvt-form" id="reportForm">
        <div class="form-grid">
            <!-- Search Type -->
            <select name="search_type" id="searchType" required class="wide-field">
                <option value="">Select Search Type</option>
                <option value="service_id" <?= $searchType=='service_id'?'selected':'' ?>>Service ID</option>
                <option value="name" <?= $searchType=='name'?'selected':'' ?>>Name</option>
                <option value="designation" <?= $searchType=='designation'?'selected':'' ?>>Designation</option>
                <option value="cadre" <?= $searchType=='cadre'?'selected':'' ?>>Cadre</option>
                <option value="office" <?= $searchType=='office'?'selected':'' ?>>Office</option>
                <option value="country" <?= $searchType=='country'?'selected':'' ?>>Country</option>
                <option value="fund" <?= $searchType=='fund'?'selected':'' ?>>Funding</option>
                <option value="purpose" <?= $searchType=='purpose'?'selected':'' ?>>Purpose</option>
            </select>

            <!-- Search Value Input with datalist -->
            <input type="text" name="search_value" id="searchValueInput" list="searchValueList" placeholder="Type to search..." value="<?= htmlspecialchars($searchValue) ?>" class="wide-field" required>
            <datalist id="searchValueList"></datalist>

            <!-- Date From -->
            <input type="date" name="start_date" value="<?= htmlspecialchars($startDate) ?>" class="narrow-field">

            <!-- Date To -->
            <input type="date" name="end_date" value="<?= htmlspecialchars($endDate) ?>" class="narrow-field">

            <!-- Buttons Group -->
            <div class="button-group">
                <button type="submit" class="btn btn-search">Search</button>
                <button type="button" id="resetBtn" class="btn btn-reset">Reset</button>

                <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($searchValue)):
                    $encodedValue = urlencode($searchValue);
                    $pdfFile = '';
                    switch($searchType) {
                        case 'service_id': $pdfFile = "../pdfReportIndividualByID.php?idReq=$encodedValue&FromDate=$startDate&ToDate=$endDate"; break;
                        case 'name':       $pdfFile = "../pdfReportIndividualByName.php?nameReq=$encodedValue&FromDate=$startDate&ToDate=$endDate"; break;
                        case 'designation':$pdfFile = "../pdfReportIndividualByDesignation.php?designationReq=$encodedValue&FromDate=$startDate&ToDate=$endDate"; break;
                        case 'cadre':      $pdfFile = "../pdfReportIndividualByCadre.php?cadreReq=$encodedValue&FromDate=$startDate&ToDate=$endDate"; break;
                        case 'office':     $pdfFile = "../pdfReportIndividualByOffice.php?officeReq=$encodedValue&FromDate=$startDate&ToDate=$endDate"; break;
                        case 'country':    $pdfFile = "../pdfReportIndividualByCountry.php?countryReq=$encodedValue&FromDate=$startDate&ToDate=$endDate"; break;
                        case 'fund':       $pdfFile = "../pdfReportIndividualByFund.php?fundReq=$encodedValue&FromDate=$startDate&ToDate=$endDate"; break;
                        case 'purpose':    $pdfFile = "../pdfReportIndividualByPurpose.php?purposeReq=$encodedValue&FromDate=$startDate&ToDate=$endDate"; break;
                    }
                ?>
                    <a href="<?= $pdfFile ?>" target="_blank" class="btn btn-download">PDF</a>
                <?php endif; ?>
            </div>
        </div>
    </form>

    <!-- Result Table -->
    <div class="table-wrapper">
        <table class="fvt-table" id="reportTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Workplace</th>
                    <th>Country</th>
                    <th>Funding</th>
                    <th>Purpose</th>
                    <th>Start Date<br>(Actual Departure)</th>
                    <th>End Date<br>(Actual Arrival)</th>
                    <th>Days</th>
                    <th>GO</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && mysqli_num_rows($result) > 0): ?>
                    <?php $i = 1; ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <?php
                            $actualDeparture = ($row["ActualDeparture"] == "0000-00-00" || empty($row["ActualDeparture"])) ? "Unreported" : $row["ActualDeparture"];
                            $actualArrival   = ($row["ActualArrival"] == "0000-00-00" || empty($row["ActualArrival"])) ? "Unreported" : $row["ActualArrival"];

                            $rev_go_links = '';
                            $res_rev = mysqli_query($db, "SELECT * FROM RevisedGO WHERE ID = " . intval($row["ID"]));
                            if($res_rev && mysqli_num_rows($res_rev) > 0){
                                while($rev = mysqli_fetch_assoc($res_rev)){
                                    $rev_go_links .= "<br><a href='../uploads/".htmlspecialchars($rev["RevGO"])."' target='_blank'>Click</a>";
                                }
                            }
                        ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= htmlspecialchars($row["ServiceID"]) ?><br>(<?= htmlspecialchars($row["Cadre"]) ?>)</td>
                            <td><?= htmlspecialchars($row["Name"]) ?></td>
                            <td><?= htmlspecialchars($row["Designation"]) ?><br>(Grade-<?= htmlspecialchars($row["Grade"]) ?>)</td>
                            <td><?= htmlspecialchars($row["Workplace"]) ?>, <?= htmlspecialchars($row["Office"]) ?></td>
                            <td><?= htmlspecialchars($row["DestinationCountry"]) ?></td>
                            <td><?= htmlspecialchars($row["FundingSource"]) ?></td>
                            <td><?= htmlspecialchars($row["Purpose"]) ?></td>
                            <td><?= htmlspecialchars($row["StartDate"]) ?><br>(<?= htmlspecialchars($actualDeparture) ?>)</td>
                            <td><?= htmlspecialchars($row["EndDate"]) ?><br>(<?= htmlspecialchars($actualArrival) ?>)</td>
                            <td><?= htmlspecialchars($row["Days"]) ?></td>
                            <td>
                                <a href='../uploads/<?= htmlspecialchars($row["GO"]) ?>' target='_blank'>Click</a>
                                <?= $rev_go_links ?>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endwhile; ?>
                <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
                    <tr>
                        <td colspan="12" style="text-align:center;">No records found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Pagination container -->
        <div class="table-pagination" data-table="reportTable" style="margin-top:10px; text-align:center;"></div>
    </div>
</div>
<link rel="stylesheet" href="assets/css/report-type.css?v=<?= filemtime('assets/css/report-type.css'); ?>">
<script>
    window.services = <?= json_encode($services) ?>;
    window.names = <?= json_encode($names) ?>;
    window.designations = <?= json_encode($designations) ?>;
    window.cadres = <?= json_encode($cadres) ?>;
    window.offices = <?= json_encode($offices) ?>;
    window.countries = <?= json_encode($countries) ?>;
    window.funds = <?= json_encode($funds) ?>;
    window.purposes = <?= json_encode($purposes) ?>;
    window.selectedType = "<?= $searchType ?>";
    window.selectedValue = "<?= $searchValue ?>";

    // Reset form
    resetBtn.addEventListener('click', function() {
        document.getElementById('reportForm').reset();
        searchValueList.innerHTML = '';
        selectedType = '';
        selectedValue = '';
        window.location.href = "base.php?page=Report";
    });
</script>
