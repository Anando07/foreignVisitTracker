<?php
 require_once __DIR__."/../controllers/ForeignVisitController.php";
?>

<div class="fvt-card" id="visitsSection">
    <h3 style="color:red; text-align:center;">Unreported Foreign Visits</h3>

    <!-- Search and Print/PDF -->
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">
        <!-- Search box -->
        <input type="text" class="table-search fvt-input" placeholder="Search visits..." data-table="visitTable" style="width:48%;">

        <!-- Buttons -->
        <div style="display:flex; gap:10px;">
            <!-- Print Button -->
            <button class="btn btn-primary" onclick="printVisitTable()">
                🖨️ Print Visits
            </button>

            <!-- PDF Button -->
            <button class="btn btn-success" onclick="window.open('../pdfUnreportedCases.php', '_blank')">
                📄 Generate PDF
            </button>
        </div>
    </div>

    <div style="overflow-x:auto;">
        <table class="fvt-table" id="visitTable">
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
                    <th>Uploaded by</th>
                    <?php if (in_array($roleId, [1, 5])): ?>
                        <th>Actions</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($allUnreportedVisits as $i => $visit): 
                    $actualDeparture = ($visit["ActualDeparture"] == "0000-00-00") ? "Unreported" : $visit["ActualDeparture"];
                    $actualArrival   = ($visit["ActualArrival"] == "0000-00-00") ? "Unreported" : $visit["ActualArrival"];

                    // Revised GO links
                    $rev_go_links = '';
                    $result2 = mysqli_query($db, "SELECT * FROM RevisedGO WHERE ID = " . $visit["ID"]);
                    if($result2->num_rows > 0){
                        while($row2 = $result2->fetch_assoc()){
                            $rev_go_links .= "<br><a href='../uploads/".$row2["RevGO"]."' target='_blank'>Click</a>";
                        }
                    }
                ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= $visit["ServiceID"] ?><br>(<?= $visit["Cadre"] ?>)</td>
                    <td><?= htmlspecialchars($visit["Name"]) ?></td>
                    <td><?= htmlspecialchars($visit["Designation"]) ?><br>(Grade-<?= $visit["Grade"] ?>)</td>
                    <td><?= htmlspecialchars($visit["Workplace"]) ?>, <?= htmlspecialchars($visit["Office"]) ?></td>
                    <td><?= htmlspecialchars($visit["DestinationCountry"]) ?></td>
                    <td><?= htmlspecialchars($visit["FundingSource"]) ?></td>
                    <td><?= htmlspecialchars($visit["Purpose"]) ?></td>
                    <td><?= $visit["StartDate"] ?><br>(<?= $actualDeparture ?>)</td>
                    <td><?= $visit["EndDate"] ?><br>(<?= $actualArrival ?>)</td>
                    <td><?= $visit["Days"] ?></td>
                    <td>
                        <a href='../uploads/<?= $visit["GO"] ?>' target='_blank'>Click</a>
                        <?= $rev_go_links ?>
                    </td>
                    <td><?= htmlspecialchars($visit['editor_name'] ?? $visit['Editor']) ?></td>
                    <?php if (in_array($roleId, [1, 5])): ?>
                        <td>
                            <button title="Reported" class="btn btn-sm btn-warning"
                                onclick="confirmReportedVisit(<?= $visit['ID'] ?>)">
                                ✏️
                            </button>
                        </td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="table-pagination" data-table="visitTable" style="margin-top:10px; text-align:center;"></div>
    </div>
</div>

<script>
function printVisitTable() {
    const visits = <?php echo json_encode($allVisits); ?>;
    const logoUrl = "http://localhost/foreignVisitTracker/assets/images/Logo.png";

    const header = `
        <div style="text-align:center; margin-bottom:20px;">
            <img src="${logoUrl}" style="height:80px; margin-bottom:10px;">
            <h2>Government's People Republic of Bangladesh</h2>
            <h2>Internal Resources Division</h2>
            <h3>Ministry of Finance</h3>
            <h2>Bangladesh Secretariat, Dhaka-1000</h2>
            <h4 style="margin:10px 0;">All Foreign Visits List of FVT</h4>
        </div>
    `;

    let html = `<table style="width:100%; border-collapse:collapse;" border="1" cellpadding="5">
        <thead>
            <tr style="background:#f2f2f2;">
                <th>#</th>
                <th>ID</th>
                <th>Name</th>
                <th>Designation</th>
                <th>Workplace</th>
                <th>Country</th>
                <th>Funding</th>
                <th>Purpose</th>
                <th>Start Date (Departure)</th>
                <th>End Date (Arrival)</th>
                <th>Days</th>
            </tr>
        </thead>
        <tbody>`;

    visits.forEach((v, i) => {
        const actualDeparture = (v.ActualDeparture == "0000-00-00") ? "Unreported" : v.ActualDeparture;
        const actualArrival   = (v.ActualArrival == "0000-00-00") ? "Unreported" : v.ActualArrival;
        html += `
            <tr>
                <td>${i+1}</td>
                <td>${v.ServiceID} (${v.Cadre})</td>
                <td>${v.Name}</td>
                <td>${v.Designation} (Grade-${v.Grade})</td>
                <td>${v.Workplace}, ${v.Office}</td>
                <td>${v.DestinationCountry}</td>
                <td>${v.FundingSource}</td>
                <td>${v.Purpose}</td>
                <td>${v.StartDate} (${actualDeparture})</td>
                <td>${v.EndDate} (${actualArrival})</td>
                <td>${v.Days}</td>
            </tr>`;
    });

    html += `</tbody></table>`;

    const newWin = window.open("", "_blank");
    newWin.document.write(`
        <html>
        <head>
            <title>Unreported Foreign Visits</title>
            <style>
                body { font-family: Arial, sans-serif; }
                table, th, td { border:1px solid #000; border-collapse: collapse; padding:5px; }
                th { background:#f2f2f2; }
                img { display:block; margin:auto; }
            </style>
        </head>
        <body>${header}${html}</body>
        </html>
    `);
    newWin.document.close();
    newWin.onload = function(){ newWin.print(); newWin.close(); };
}
</script>
