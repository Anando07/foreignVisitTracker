<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
require_once "config.php";

/* =========================
   FORM INPUT
========================= */
$visitType  = $_POST['visit_type']  ?? ''; // maximum | minimum
$startDate  = $_POST['start_date']  ?? '';
$endDate    = $_POST['end_date']    ?? '';
$result     = null;

/* =========================
   VALIDATE DATE RANGE
========================= */
$dateCondition = '';
if (!empty($startDate) && !empty($endDate)) {
    $dateCondition = " AND fv.StartDate BETWEEN '" . mysqli_real_escape_string($db, $startDate) . "'
                                        AND '" . mysqli_real_escape_string($db, $endDate) . "'";
}

/* =========================
   QUERY
========================= */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && in_array($visitType, ['maximum','minimum'])) {

    $order = ($visitType === 'maximum') ? 'DESC' : 'ASC';

    $sql = "
        SELECT 
            fv.ServiceID,
            fv.Name,
            fv.Designation,
            fv.Office,
            fv.DestinationCountry,
            fv.FundingSource,
            fv.Purpose,
            COUNT(*) AS visit_times
        FROM ForeignVisit fv
        WHERE 1=1
        $dateCondition
        GROUP BY fv.ServiceID, fv.Name, fv.Designation, fv.Office, 
                 fv.DestinationCountry, fv.FundingSource, fv.Purpose
        ORDER BY visit_times $order
    ";

    $result = mysqli_query($db, $sql);
}
?>

<div class="fvt-card">
    <h2 class="report-title">Maximum / Minimum Foreign Visit Report</h2>

    <form method="post" class="fvt-form" id="reportForm">
        <div class="form-grid">

            <!-- Report Type -->
            <select name="visit_type" id="visitType" required>
                <option value="">Select Report Type</option>
                <option value="maximum" <?= $visitType=='maximum'?'selected':'' ?>>Maximum Visits</option>
                <option value="minimum" <?= $visitType=='minimum'?'selected':'' ?>>Minimum Visits</option>
            </select>
            
            <!-- Date From -->
            <input type="date" name="start_date" id="startDate" value="<?= htmlspecialchars($startDate) ?>" class="narrow-field">

            <!-- Date To -->
            <input type="date" name="end_date" id="endDate" value="<?= htmlspecialchars($endDate) ?>" class="narrow-field">

            <div class="button-group">
                <button type="submit" class="btn btn-search">Search</button>

                <!-- Reset Button -->
                <button type="reset" id="resBtn" class="btn btn-reset">Reset</button>

                <?php if($visitType): ?>
                    <a href="../pdfMaxMinReport.php?visit_type=<?= $visitType ?>&start_date=<?= $startDate ?>&end_date=<?= $endDate ?>"
                       target="_blank"
                       class="btn btn-download">PDF</a>
                <?php endif; ?>
            </div>

        </div>
    </form>

    <div class="table-wrapper">
        <table class="fvt-table" id="reportTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Service ID</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Office</th>
                    <th>Country</th>
                    <th>Funding</th>
                    <th>Purpose</th>
                    <th>Visit Times</th>
                </tr>
            </thead>

            <tbody>
                <?php if($result && mysqli_num_rows($result)): $i=1; ?>
                    <?php while($row=mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= htmlspecialchars($row['ServiceID']) ?></td>
                            <td><?= htmlspecialchars($row['Name']) ?></td>
                            <td><?= htmlspecialchars($row['Designation']) ?></td>
                            <td><?= htmlspecialchars($row['Office']) ?></td>
                            <td><?= htmlspecialchars($row['DestinationCountry']) ?></td>
                            <td><?= htmlspecialchars($row['FundingSource']) ?></td>
                            <td><?= htmlspecialchars($row['Purpose']) ?></td>
                            <td style="font-weight:bold; text-align:center;">
                                <?= $row['visit_times'] ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php elseif($_SERVER['REQUEST_METHOD']==='POST'): ?>
                    <tr>
                        <td colspan="9" style="text-align:center;">No records found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="table-pagination" data-table="reportTable"></div>
    </div>
</div>

<link rel="stylesheet"
      href="../assets/css/report-type.css?v=<?= filemtime('../assets/css/report-type.css'); ?>">

<script>
document.getElementById('resetBtn').onclick = () => {
    // Clear all three fields
    document.getElementById('visitType').value = '';
    document.getElementById('startDate').value = '';
    document.getElementById('endDate').value = '';

    // Optional: refresh page to clear table
    window.location.href = "base.php?page=MaximumMinimumReport";
};
</script>

<script>
document.getElementById('resBtn').onclick = () => {
    // Clear all three fields
    document.getElementById('visitType').value = '';
    document.getElementById('startDate').value = '';
    document.getElementById('endDate').value = '';

    // Optional: refresh page to clear table
    window.location.href = "base.php?page=MaxMinReport";
};
</script>
