<?php require_once __DIR__."/../controllers/ForeignVisitReportController.php";?>
<div class="fvt-card">
    <div class="fvt-page-header">
        Time Based Different Type Report
    </div>

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
            <input type="text" name="search_value" id="searchValueInput" list="searchValueList"
                   placeholder="Type to search..." value="<?= htmlspecialchars($searchValue) ?>" class="wide-field" required>
            <datalist id="searchValueList"></datalist>

            <!-- Date From -->
            <input type="date" name="start_date" value="<?= htmlspecialchars($startDate) ?>" class="narrow-field">

            <!-- Date To -->
            <input type="date" name="end_date" value="<?= htmlspecialchars($endDate) ?>" class="narrow-field">

            <!-- Buttons Group -->
            <div class="button-group">
                <button type="submit" class="btn btn-search">Search</button>
                <button type="button" id="resetBtn" class="btn btn-reset">Reset</button>

                <?php if (!empty($searchValue)): 
                    $encodedValue = urlencode($searchValue);
                    $pdfFile = '';
                    switch($searchType) {
                        case 'service_id': $pdfFile = "pdf/templates/pdfReportIndividualByID.php?idReq=$encodedValue&FromDate=$startDate&ToDate=$endDate"; break;
                        case 'name':       $pdfFile = "pdf/templates/pdfReportIndividualByName.php?nameReq=$encodedValue&FromDate=$startDate&ToDate=$endDate"; break;
                        case 'designation':$pdfFile = "pdf/templates/pdfReportIndividualByDesignation.php?designationReq=$encodedValue&FromDate=$startDate&ToDate=$endDate"; break;
                        case 'cadre':      $pdfFile = "pdf/templates/pdfReportIndividualByCadre.php?cadreReq=$encodedValue&FromDate=$startDate&ToDate=$endDate"; break;
                        case 'office':     $pdfFile = "pdf/templates/pdfReportIndividualByOffice.php?officeReq=$encodedValue&FromDate=$startDate&ToDate=$endDate"; break;
                        case 'country':    $pdfFile = "pdf/templates/pdfReportIndividualByCountry.php?countryReq=$encodedValue&FromDate=$startDate&ToDate=$endDate"; break;
                        case 'fund':       $pdfFile = "pdf/templates/pdfReportIndividualByFund.php?fundReq=$encodedValue&FromDate=$startDate&ToDate=$endDate"; break;
                        case 'purpose':    $pdfFile = "pdf/templates/pdfReportIndividualByPurpose.php?purposeReq=$encodedValue&FromDate=$startDate&ToDate=$endDate"; break;
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
                    <th>Designation/Office</th>
                    <th>Country</th>
                    <th>Funding</th>
                    <th>Purpose</th>
                    <th>Start Date<br>(Actual Departure)</th>
                    <th>Days</th>
                    <th>GO</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($result)): $i = 1; ?>
                    <?php foreach ($result as $row): ?>
                        <?php
                            $actualDeparture = ($row["ActualDeparture"] == "0000-00-00" || empty($row["ActualDeparture"])) ? "Unreported" : $row["ActualDeparture"];
                            $rev_go_links = '';
                            if(isset($db)) {
                                $res_rev = mysqli_query($db, "SELECT * FROM RevisedGO WHERE ID = " . intval($row["ID"]));
                                if($res_rev && mysqli_num_rows($res_rev) > 0){
                                    while($rev = mysqli_fetch_assoc($res_rev)){
                                        $rev_go_links .= "<br><a href='uploads/".htmlspecialchars($rev["RevGO"])."' target='_blank'>Click</a>";
                                    }
                                }
                            }
                        ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= htmlspecialchars($row["ServiceID"]) ?><br>(<?= htmlspecialchars($row["Cadre"]) ?>)</td>
                            <td><?= htmlspecialchars($row["Name"]) ?></td>
                            <td><?= htmlspecialchars($row["Designation"]) ?><br>(Grade-<?= htmlspecialchars($row["Grade"]) ?><br><?= htmlspecialchars($row["Workplace"]) ?><br><?= htmlspecialchars($row["Office"]) ?>)</td>
                            <td><?= htmlspecialchars($row["DestinationCountry"]) ?></td>
                            <td><?= htmlspecialchars($row["FundingSource"]) ?></td>
                            <td><?= htmlspecialchars($row["Purpose"]) ?></td>
                            <td><?= htmlspecialchars($row["StartDate"]) ?><br>(<?= htmlspecialchars($actualDeparture) ?>)</td>
                            <td><?= htmlspecialchars($row["Days"]) ?></td>
                            <td>
                                <a href='uploads/<?= htmlspecialchars($row["GO"]) ?>' target='_blank'>Click</a>
                                <?= $rev_go_links ?>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
                    <tr>
                        <td colspan="10" style="text-align:center;">No records found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="table-pagination" data-table="reportTable" style="margin-top:10px; text-align:center;"></div>
    </div>
</div>

<link rel="stylesheet" href="assets/css/report-type.css?v=<?= filemtime('assets/css/report-type.css'); ?>">

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchTypeEl = document.getElementById('searchType');
    const searchValueInput = document.getElementById('searchValueInput');
    const searchValueList = document.getElementById('searchValueList');
    const resetBtn = document.getElementById('resetBtn');

    const services     = <?= json_encode($services) ?>;
    const names        = <?= json_encode($names) ?>;
    const designations = <?= json_encode($designations) ?>;
    const cadres       = <?= json_encode($cadres) ?>;
    const offices      = <?= json_encode($offices) ?>;
    const countries    = <?= json_encode($countries) ?>;
    const funds        = <?= json_encode($funds) ?>;
    const purposes     = <?= json_encode($purposes) ?>;

    let selectedType  = "<?= $searchType ?>";
    let selectedValue = "<?= $searchValue ?>";

    function populateDatalist() {
        searchValueList.innerHTML = '';
        let arr = [];
        switch(searchTypeEl.value) {
            case 'service_id': arr = services; break;
            case 'name':       arr = names; break;
            case 'designation':arr = designations; break;
            case 'cadre':      arr = cadres; break;
            case 'office':     arr = offices; break;
            case 'country':    arr = countries; break;
            case 'fund':       arr = funds; break;
            case 'purpose':    arr = purposes; break;
        }
        arr.forEach(val => {
            const option = document.createElement('option');
            option.value = val;
            searchValueList.appendChild(option);
        });

        searchValueInput.value = selectedType === searchTypeEl.value ? selectedValue : '';
    }

    if (searchTypeEl.value) populateDatalist();

    searchTypeEl.addEventListener('change', function() {
        selectedType = searchTypeEl.value;
        selectedValue = '';
        populateDatalist();
    });

    resetBtn.addEventListener('click', function() {
        document.getElementById('reportForm').reset();
        searchValueList.innerHTML = '';
        selectedType = '';
        selectedValue = '';
        window.location.href = "base.php?page=Report";
    });
});
</script>