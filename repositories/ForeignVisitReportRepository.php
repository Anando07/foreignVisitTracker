<?php
class ForeignVisitReportRepository
{
    private $db;

    public function __construct(mysqli $db)
    {
        $this->db = $db;
    }

    // Fetch filtered visits
    public function getFilteredVisits(array $filters, string $startDate = '', string $endDate = ''): array
    {
        $sql = "SELECT fv.*, a.name AS uploader_name
                FROM ForeignVisit fv
                LEFT JOIN admin a ON a.ID = fv.Uploader
                WHERE 1=1";

        foreach ($filters as $field => $value) {
            if (!empty($value)) {
                $escaped = mysqli_real_escape_string($this->db, $value);
                switch ($field) {
                    case 'service_id': $sql .= " AND fv.ServiceID = '$escaped'"; break;
                    case 'name':       $sql .= " AND fv.Name LIKE '%$escaped%'"; break;
                    case 'designation':$sql .= " AND fv.Designation LIKE '%$escaped%'"; break;
                    case 'cadre':      $sql .= " AND fv.Cadre LIKE '%$escaped%'"; break;
                    case 'office':     $sql .= " AND fv.Office LIKE '%$escaped%'"; break;
                    case 'country':    $sql .= " AND fv.DestinationCountry LIKE '%$escaped%'"; break;
                    case 'fund':       $sql .= " AND fv.FundingSource LIKE '%$escaped%'"; break;
                    case 'purpose':    $sql .= " AND fv.Purpose LIKE '%$escaped%'"; break;
                }
            }
        }

        if (!empty($startDate) && !empty($endDate)) {
            $sql .= " AND fv.StartDate BETWEEN '" . mysqli_real_escape_string($this->db, $startDate) . "' 
                                     AND '" . mysqli_real_escape_string($this->db, $endDate) . "'";
        }

        $sql .= " ORDER BY fv.StartDate DESC";

        $res = mysqli_query($this->db, $sql);
        return mysqli_fetch_all($res, MYSQLI_ASSOC);
    }

    // Fetch visit counts for maximum/minimum reports
    public function getVisitCounts(string $order = 'DESC', string $startDate = '', string $endDate = ''): array
    {
        $dateCondition = '';
        if (!empty($startDate) && !empty($endDate)) {
            $dateCondition = " AND fv.StartDate BETWEEN '" . mysqli_real_escape_string($this->db, $startDate) . "' 
                                              AND '" . mysqli_real_escape_string($this->db, $endDate) . "'";
        }

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

        $res = mysqli_query($this->db, $sql);
        return mysqli_fetch_all($res, MYSQLI_ASSOC);
    }

    // Fetch dropdown lists for search fields
    public function getDropdownValues(): array
    {
        $fields = [
            'ServiceID' => [],
            'Name' => [],
            'Designation' => [],
            'Cadre' => [],
            'Office' => [],
            'DestinationCountry' => [],
            'FundingSource' => [],
            'Purpose' => [],
        ];

        foreach ($fields as $field => $arr) {
            $res = mysqli_query($this->db, "SELECT DISTINCT $field FROM ForeignVisit ORDER BY $field");
            while ($row = mysqli_fetch_assoc($res)) {
                $fields[$field][] = $row[$field];
            }
        }

        return $fields;
    }
}