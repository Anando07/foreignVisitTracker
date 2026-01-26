<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
include("../config.php");

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

// Data for Pie Chart
$countryCounts = mysqli_query($db, "SELECT DestinationCountry, COUNT(*) AS total FROM ForeignVisit GROUP BY DestinationCountry ORDER BY total DESC");
$chartLabels = [];
$chartData = [];
while($row = mysqli_fetch_assoc($countryCounts)){
    $chartLabels[] = $row['DestinationCountry'];
    $chartData[] = (int)$row['total'];
}
?>

<!-- ======================
     WELCOME CARD
====================== -->
<div class="fvt-card">
    <h3>Welcome Back, <?= htmlspecialchars($user_fullname); ?> 👋</h3>
    <p><?= htmlspecialchars($designation); ?> | Manage your tasks according to your role permissions.</p>
</div>
<!-- ======================
     PIE CHART
====================== -->
<div class="fvt-card" style="text-align:center;">
    <h3>Foreign Visits by Country</h3>
    <div style="width:100%; max-width:500px; margin:0 auto;">
        <canvas id="countryPieChart" style="width:100%; height:400px;"></canvas>
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

/* Pie Chart */
const ctx = document.getElementById('countryPieChart').getContext('2d');
const countryPieChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: <?= json_encode($chartLabels); ?>,
        datasets: [{
            data: <?= json_encode($chartData); ?>,
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
            legend: {
                position: 'bottom',  // moves legend below
                align: 'center',     // horizontal alignment
                labels: { boxWidth: 20 } // optional: size of legend color box
            },
            title: {
                display: true,
                text: 'Foreign Visits by Destination Country'
            }
        }
    }
});

</script>
