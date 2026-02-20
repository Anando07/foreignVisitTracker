<?php

// =========================
// ACCESS CONTROL
// =========================
$allowedRoles = ['Administrator', 'Admin', 'Operator'];
if (!isset($_SESSION['login_role']) || !in_array($_SESSION['login_role'], $allowedRoles, true)) {
    die("Unauthorized access.");
}

// =========================
// INIT DB, REPO & SERVICE
// =========================
// Assumes $db is already initialized before including this controller
$repo    = new ForeignVisitReportRepository($db);
$service = new ForeignVisitReportService($repo);

// =========================
// INITIALIZE VARIABLES
// =========================
$result      = [];
$searchType  = $_POST['search_type'] ?? '';
$searchValue = $_POST['search_value'] ?? '';
$startDate   = $_POST['start_date'] ?? '';
$endDate     = $_POST['end_date'] ?? '';
$visitType   = $_POST['visit_type'] ?? '';

// =========================
// HANDLE SEARCH OR MAX/MIN REPORT
// =========================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // If search type and value are provided
    if (!empty($searchType) && !empty($searchValue)) {
        $filters = [
            'service_id'  => $searchType === 'service_id' ? $searchValue : '',
            'name'        => $searchType === 'name' ? $searchValue : '',
            'designation' => $searchType === 'designation' ? $searchValue : '',
            'cadre'       => $searchType === 'cadre' ? $searchValue : '',
            'office'      => $searchType === 'office' ? $searchValue : '',
            'country'     => $searchType === 'country' ? $searchValue : '',
            'fund'        => $searchType === 'fund' ? $searchValue : '',
            'purpose'     => $searchType === 'purpose' ? $searchValue : '',
        ];

        $result = $service->searchVisits($filters, $startDate, $endDate);
    }

    // If max/min visit report is requested
    if (!empty($visitType)) {
        $result = $service->getVisitCounts($visitType, $startDate, $endDate);
    }
}

// =========================
// FETCH DROPDOWN VALUES
// =========================
$dropdowns = $service->getDropdownValues();
$services     = $dropdowns['ServiceID'] ?? [];
$names        = $dropdowns['Name'] ?? [];
$designations = $dropdowns['Designation'] ?? [];
$cadres       = $dropdowns['Cadre'] ?? [];
$offices      = $dropdowns['Office'] ?? [];
$countries    = $dropdowns['DestinationCountry'] ?? [];
$funds        = $dropdowns['FundingSource'] ?? [];
$purposes     = $dropdowns['Purpose'] ?? [];
