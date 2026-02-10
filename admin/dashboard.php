<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
include("../config.php");

$user_id        = $_SESSION['login_user_id'] ?? '';
$username       = $_SESSION['login_user'] ?? '';
$user_fullname  = $_SESSION['user_name'] ?? 'User';
$designation    = $_SESSION['user_designation'] ?? 'N/A';

// ======================
// DASHBOARD STATS
// ======================

// Total users
$qUsers = mysqli_query($db, "SELECT COUNT(ID) AS total FROM Admin");
$totalUsers = mysqli_fetch_assoc($qUsers)['total'] ?? 0;

// Total foreign visits
$qVisits = mysqli_query($db, "SELECT COUNT(ID) AS total FROM ForeignVisit");
$totalVisits = mysqli_fetch_assoc($qVisits)['total'] ?? 0;

// Total unique countries
$qCountries = mysqli_query($db, "SELECT COUNT(DISTINCT DestinationCountry) AS total FROM ForeignVisit");
$totalCountry = mysqli_fetch_assoc($qCountries)['total'] ?? 0;

// ======================
// TABLE DATA
// ======================

// Users
$users = mysqli_query($db, "SELECT ID, Name, UserName, Email, Designation, Status FROM Admin ORDER BY ID DESC");

// Visits
$visits = mysqli_query($db, "SELECT ID, Name, Designation, Office, ServiceID, Cadre, DestinationCountry, Purpose, StartDate, EndDate FROM ForeignVisit ORDER BY ID DESC");

// Countries for table
$countries = mysqli_query($db, "SELECT DISTINCT DestinationCountry FROM ForeignVisit ORDER BY DestinationCountry ASC");


// ======= Country Chart Data =======
$countryCounts = mysqli_query($db, "SELECT DestinationCountry, COUNT(*) AS total FROM ForeignVisit GROUP BY DestinationCountry ORDER BY total DESC");
$countryLabels = [];
$countryData   = [];
while($row = mysqli_fetch_assoc($countryCounts)){
    $countryLabels[] = $row['DestinationCountry'];
    $countryData[]   = (int)$row['total'];
}

// ======= Purpose Chart Data =======
$purposeCounts = mysqli_query($db, "SELECT Purpose, COUNT(*) AS total FROM ForeignVisit GROUP BY Purpose ORDER BY total DESC");
$purposeLabels = [];
$purposeData   = [];
while($row = mysqli_fetch_assoc($purposeCounts)){
    $purposeLabels[] = $row['Purpose'];
    $purposeData[]   = (int)$row['total'];
}
// ======= Designation Chart Data =======
$designationCounts = mysqli_query($db, "SELECT Designation, COUNT(*) AS total FROM ForeignVisit GROUP BY Designation ORDER BY total DESC");
$designationLabels = [];
$designationData   = [];
while($row = mysqli_fetch_assoc($designationCounts)){
    $designationLabels[] = $row['Designation'];
    $designationData[]   = (int)$row['total'];
}
// ======= Funding Chart Data =======
$fundingCounts = mysqli_query($db, "SELECT FundingSource, COUNT(*) AS total FROM ForeignVisit GROUP BY FundingSource ORDER BY total DESC");
$fundingLabels = [];
$fundingData   = [];
while($row = mysqli_fetch_assoc($fundingCounts)){
    $fundingLabels[] = $row['FundingSource'];
    $fundingData[]   = (int)$row['total'];
}
// ======= Office Chart Data =======
$officeCounts = mysqli_query($db, "SELECT Office, COUNT(*) AS total FROM ForeignVisit GROUP BY Office ORDER BY total DESC");
$officeLabels = [];
$officeData   = [];
while($row = mysqli_fetch_assoc($officeCounts)){
    $officeLabels[] = $row['Office'];
    $officeData[]   = (int)$row['total'];
}
// ======= Cadre Chart Data =======
$cadreCounts = mysqli_query($db, "SELECT Cadre, COUNT(*) AS total FROM ForeignVisit GROUP BY Cadre ORDER BY total DESC");
$cadreLabels = [];
$cadreData   = [];
while($row = mysqli_fetch_assoc($cadreCounts)){
    $cadreLabels[] = $row['Cadre'];
    $cadreData[]   = (int)$row['total'];
}


?>

<!-- ======================
     WELCOME CARD
====================== -->
<div class="fvt-welcome-card">
    <h3>Welcome Back, <?= htmlspecialchars($user_fullname); ?> 👋</h3>
    <p><?= htmlspecialchars($designation); ?> | Manage your tasks according to your role permissions.</p>
</div>

<!-- ======================
     PIE CHARTS SIDE BY SIDE
====================== -->
<div class="fvt-card" style="display:flex; justify-content:space-around; flex-wrap:wrap; gap:20px; text-align:center;">
    <div style="flex:1 1 400px; max-width:500px;">
        <h3>Foreign Visits by Purpose</h3>
        <canvas id="purposePieChart"></canvas>
    </div>
    <div style="flex:1 1 400px; max-width:500px;">
        <h3>Foreign Visits by Country</h3>
        <canvas id="countryPieChart"></canvas>
    </div>
</div>
<div class="fvt-card" style="display:flex; justify-content:space-around; flex-wrap:wrap; gap:20px; text-align:center;">
    <div style="flex:1 1 400px; max-width:500px;">
        <h3>Designated Foreign Visits</h3>
        <canvas id="designationPieChart"></canvas>
    </div>
    <div style="flex:1 1 400px; max-width:500px;">
        <h3>Foreign Visits by Funding Source</h3>
        <canvas id="fundingPieChart"></canvas>
    </div>
</div>
<div class="fvt-card" style="display:flex; justify-content:space-around; flex-wrap:wrap; gap:20px; text-align:center;">
    <div style="flex:1 1 400px; max-width:500px;">
        <h3>Office Foreign Visits</h3>
        <canvas id="officePieChart"></canvas>
    </div>
    <div style="flex:1 1 400px; max-width:500px;">
        <h3>Foreign Visits by Cadre</h3>
        <canvas id="cadrePieChart"></canvas>
    </div>
</div>
<!-- ======================
     STATS BOXES
====================== -->
<div class="fvt-stats">
    <div class="stat-box clickable" onclick="showSection('usersSection')">
        <h2><?= $totalUsers; ?></h2>
        <p>Total Users</p>
    </div>

    <div class="stat-box clickable" onclick="showSection('visitsSection')">
        <h2><?= $totalVisits; ?></h2>
        <p>Foreign Visits</p>
    </div>

    <div class="stat-box clickable" onclick="showSection('countrySection')">
        <h2><?= $totalCountry; ?></h2>
        <p>Destination Countries</p>
    </div>
</div>

<!-- ======================
     USERS TABLE
====================== -->
<div class="fvt-card" id="usersSection" style="display:none;">
    <h3>User List</h3>
    <button class="btn btn-primary mb-2" onclick="printTable('userTable')">Print Users</button>
    <input type="text" id="userSearch" class="fvt-input" placeholder="Search users...">
    <table class="fvt-table" id="userTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Designation</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1; while($row = mysqli_fetch_assoc($users)): ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= htmlspecialchars($row['Name']); ?></td>
                <td><?= htmlspecialchars($row['UserName']); ?></td>
                <td><?= htmlspecialchars($row['Email']); ?></td>
                <td><?= htmlspecialchars($row['Designation']); ?></td>
                <td><?= $row['Status']==1 ? "<span class='badge badge-success'>Active</span>" : "<span class='badge badge-danger'>Inactive</span>"; ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- ======================
     VISITS TABLE
====================== -->
<div class="fvt-card" id="visitsSection" style="display:none;">
    <h3>Foreign Visit List</h3>
    <button class="btn btn-primary mb-2" onclick="printTable('visitTable')">Print Visits</button>
    <input type="text" id="visitSearch" class="fvt-input" placeholder="Search visits...">
    <table class="fvt-table" id="visitTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Designation</th>
                <th>Office</th>
                <th>ServiceID</th>
                <th>Cadre</th>
                <th>Destination Country</th>
                <th>Purpose</th>
                <th>Start Date</th>
                <th>End Date</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1; while($row = mysqli_fetch_assoc($visits)): ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= htmlspecialchars($row['Name']); ?></td>
                <td><?= htmlspecialchars($row['Designation']); ?></td>
                <td><?= htmlspecialchars($row['Office']); ?></td>
                <td><?= htmlspecialchars($row['ServiceID']); ?></td>
                <td><?= htmlspecialchars($row['Cadre']); ?></td>
                <td><?= htmlspecialchars($row['DestinationCountry']); ?></td>
                <td><?= htmlspecialchars($row['Purpose']); ?></td>
                <td><?= htmlspecialchars($row['StartDate']); ?></td>
                <td><?= htmlspecialchars($row['EndDate']); ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- ======================
     COUNTRIES TABLE
====================== -->
<div class="fvt-card" id="countrySection" style="display:none;">
    <h3>Destination Countries</h3>
    <button class="btn btn-primary mb-2" onclick="printTable('countryTable')">Print Countries</button>
    <input type="text" id="countrySearch" class="fvt-input" placeholder="Search countries...">
    <table class="fvt-table" id="countryTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Country</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1; while($row = mysqli_fetch_assoc($countries)): ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= htmlspecialchars($row['DestinationCountry']); ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- ======================
     SCRIPTS
====================== -->
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Chart.js Data Labels plugin -->
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
<script>
/* Show Sections */
function showSection(id){
    ['usersSection','visitsSection','countrySection'].forEach(sec=>{
        document.getElementById(sec).style.display = (sec===id)?'block':'none';
    });
}

/* Search function */
function setupSearch(inputId, tableId){
    const input = document.getElementById(inputId);
    input?.addEventListener('keyup', function(){
        const value = this.value.toLowerCase();
        document.querySelectorAll(`#${tableId} tbody tr`).forEach(row=>{
            const match = Array.from(row.cells).some(td=>td.textContent.toLowerCase().includes(value));
            row.style.display = match?'':'none';
        });
    });
}
setupSearch('userSearch','userTable');
setupSearch('visitSearch','visitTable');
setupSearch('countrySearch','countryTable');

/* Print Table */
function printTable(tableId){
    const table = document.getElementById(tableId);
    const newWin = window.open('', '', 'width=1000,height=600');
    newWin.document.write('<html><head><title>Print</title>');
    newWin.document.write('<style>table{width:100%;border-collapse:collapse;}th,td{border:1px solid #333;padding:5px;text-align:left;}tr:nth-child(even){background:#f2f2f2;}</style>');
    newWin.document.write('</head><body>');
    newWin.document.write(table.outerHTML);
    newWin.document.write('</body></html>');
    newWin.document.close();
    newWin.print();
}

// ===== Country Pie Chart =====
const ctxCountry = document.getElementById('countryPieChart').getContext('2d');
const countryPieChart = new Chart(ctxCountry, {
    type: 'pie',
    data: {
        labels: <?= json_encode($countryLabels); ?>,
        datasets: [{
            data: <?= json_encode($countryData); ?>,
            backgroundColor: [
                '#FF6384','#36A2EB','#FFCE56','#4BC0C0','#9966FF','#FF9F40',
                '#8AFF33','#FF33F6','#33FFF2','#F633FF','#FF3333','#33FF57'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position:'bottom', align:'center', labels:{ boxWidth:20 } },
            title: { display:true, text:'Foreign Visits by Destination Country' }
        }
    }
});

// ===== Purpose Pie Chart =====
const ctxPurpose = document.getElementById('purposePieChart').getContext('2d');
const purposePieChart = new Chart(ctxPurpose, {
    type: 'pie',
    data: {
        labels: <?= json_encode($purposeLabels); ?>,
        datasets: [{
            data: <?= json_encode($purposeData); ?>,
            backgroundColor: [
                '#FF6384','#36A2EB','#FFCE56','#4BC0C0','#9966FF','#FF9F40',
                '#8AFF33','#FF33F6','#33FFF2','#F633FF','#FF3333','#33FF57'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position:'bottom', align:'center', labels:{ boxWidth:20 } },
            title: { display:true, text:'Foreign Visits by Purpose' }
        }
    }
});
// ===== Designation Pie Chart =====
const ctxDesignation = document.getElementById('designationPieChart').getContext('2d');
const designationPieChart = new Chart(ctxDesignation, {
    type: 'pie',
    data: {
        labels: <?= json_encode($designationLabels); ?>,
        datasets: [{
            data: <?= json_encode($designationData); ?>,
            backgroundColor: [
                '#FF6384','#36A2EB','#FFCE56','#4BC0C0','#9966FF','#FF9F40',
                '#8AFF33','#FF33F6','#33FFF2','#F633FF','#FF3333','#33FF57'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position:'bottom', align:'center', labels:{ boxWidth:20 } },
            title: { display:true, text:'Foreign Visits by Designation' }
        }
    }
});
// ===== Funding Pie Chart =====
const ctxFunding = document.getElementById('fundingPieChart').getContext('2d');
const fundingPieChart = new Chart(ctxFunding, {
    type: 'pie',
    data: {
        labels: <?= json_encode($fundingLabels); ?>,
        datasets: [{
            data: <?= json_encode($fundingData); ?>,
            backgroundColor: [
                '#FF6384','#36A2EB','#FFCE56','#4BC0C0','#9966FF','#FF9F40',
                '#8AFF33','#FF33F6','#33FFF2','#F633FF','#FF3333','#33FF57'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position:'bottom', align:'center', labels:{ boxWidth:20 } },
            title: { display:true, text:'Foreign Visits by Funding Source' }
        }
    }
});
// ===== Office Pie Chart =====
const ctxOffice = document.getElementById('officePieChart').getContext('2d');
const officePieChart = new Chart(ctxOffice, {
    type: 'pie',
    data: {
        labels: <?= json_encode($officeLabels); ?>,
        datasets: [{
            data: <?= json_encode($officeData); ?>,
            backgroundColor: [
                '#FF6384','#36A2EB','#FFCE56','#4BC0C0','#9966FF','#FF9F40',
                '#8AFF33','#FF33F6','#33FFF2','#F633FF','#FF3333','#33FF57'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position:'bottom', align:'center', labels:{ boxWidth:20 } },
            title: { display:true, text:'Foreign Visits by Office' }
        }
    }
});
// ===== Cadre Pie Chart =====
const ctxCadre = document.getElementById('cadrePieChart').getContext('2d');
const cadrePieChart = new Chart(ctxCadre, {
    type: 'pie',
    data: {
        labels: <?= json_encode($cadreLabels); ?>,
        datasets: [{
            data: <?= json_encode($cadreData); ?>,
            backgroundColor: [
                '#FF6384','#36A2EB','#FFCE56','#4BC0C0','#9966FF','#FF9F40',
                '#8AFF33','#FF33F6','#33FFF2','#F633FF','#FF3333','#33FF57'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position:'bottom', align:'center', labels:{ boxWidth:20 } },
            title: { display:true, text:'Foreign Visits by Cadre' }
        }
    }
});
</script>
