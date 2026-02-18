<?php
class ForeignVisitService {
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function getVisitById($id){
        $stmt = $this->db->prepare("SELECT * FROM ForeignVisit WHERE ID=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function saveVisit($data, $files, $isEdit=false, $id=0){
        if ($isEdit && empty($id)) {
            return ['error' => 'Invalid update request'];
        }

        $unreported = isset($data['unreported_mode']) && $data['unreported_mode'] == 1;

        // Collect fields
        $serviceID = trim($data['serviceID'] ?? '');
        $cadre = trim($data['cadreName'] ?? '');
        $office = trim($data['office'] ?? '');
        $name = trim($data['name'] ?? '');
        $designation = trim($data['designation'] ?? '');
        $grade = trim($data['grade'] ?? '');
        $workplace = trim($data['workplace'] ?? '');
        $destCountry = trim($data['destination_country'] ?? '');
        $funding = trim($data['fund'] ?? '');
        $purpose = trim($data['purpose'] ?? '');
        $startDate = trim($data['from_date'] ?? '');
        $endDate = trim($data['to_date'] ?? '');
        $actualDep = trim($data['actual_departure'] ?? '');
        $actualArr = trim($data['actual_arrival'] ?? '');
        $passport = trim($data['passport'] ?? '') ?: null;
        $nid = trim($data['nid'] ?? '') ?: null;

        $editor = $_SESSION['login_user_id'];
        $uploader = $_SESSION['login_user_id'];

        $errors = [];

        /* ====================== VALIDATION ====================== */
        if (!$unreported) {
            if ($serviceID === '') $errors[] = "Service ID required";
            if ($cadre === '') $errors[] = "Cadre required";
            if ($office === '') $errors[] = "Office required";
            if ($name === '') $errors[] = "Name required";
            if ($designation === '') $errors[] = "Designation required";
            if ($grade === '') $errors[] = "Grade required";
            if ($workplace === '') $errors[] = "Workplace required";
            if ($destCountry === '') $errors[] = "Destination country required";
            if ($funding === '') $errors[] = "Funding required";
            if ($purpose === '') $errors[] = "Purpose required";
            if ($startDate === '') $errors[] = "From date required";
            if ($endDate === '') $errors[] = "To date required";

            if (!$isEdit && empty($files['go_file']['name'])) {
                $errors[] = "GO file required";
            }

            $actualDep = null;
            $actualArr = null;
        }

        if ($unreported) {
            if ($actualDep === '') $errors[] = "Actual Departure required";
            if ($actualArr === '') $errors[] = "Actual Arrival required";
        }

        /* ====================== FILE VALIDATION ====================== */
        $fileName = null;
        if (!empty($files['go_file']['name'])) {
            $allowedTypes = ['image/jpeg','application/pdf'];
            $fileType = $files['go_file']['type'];
            $fileSize = $files['go_file']['size'];

            if (!in_array($fileType, $allowedTypes)) {
                $errors[] = "GO file must be JPG or PDF";
            }
            if ($fileSize > 512 * 1024) { // 512 KB
                $errors[] = "GO file must be less than 512 KB";
            }

            if (empty($errors)) {
                $fileName = time().'_'.$files['go_file']['name'];
                move_uploaded_file($files['go_file']['tmp_name'], "uploads/".$fileName);
            }
        }

        if (!empty($errors)) {
            return ['error' => implode('<br>', $errors)];
        }

        /* ====================== DAYS ====================== */
        $days = 0;
        if ($startDate && $endDate) {
            $days = (strtotime($endDate) - strtotime($startDate)) / 86400 + 1;
        }

        /* ====================== UPDATE ====================== */
        if ($isEdit) {

            if ($unreported) {
                $stmt = $this->db->prepare("
                    UPDATE ForeignVisit
                    SET ActualDeparture=?, ActualArrival=?, Editor=?
                    WHERE ID=?
                ");
                $stmt->bind_param("ssii", $actualDep, $actualArr, $editor, $id);
            } else {
                $stmt = $this->db->prepare("
                    UPDATE ForeignVisit SET
                    ServiceID=?, Cadre=?, Office=?, Name=?, Designation=?, Grade=?, Workplace=?,
                    DestinationCountry=?, FundingSource=?, Purpose=?, StartDate=?, EndDate=?,
                    Days=?, Passport=?, NID=?, Editor=?
                    WHERE ID=?
                ");
                $stmt->bind_param(
                    "isssssssssssissii",
                    $serviceID,$cadre,$office,$name,$designation,$grade,$workplace,
                    $destCountry,$funding,$purpose,$startDate,$endDate,
                    $days,$passport,$nid,$editor,$id
                );
            }

            $stmt->execute();

            if ($fileName) {
                $this->db->query("INSERT INTO RevisedGO (ID, RevGO) VALUES ($id,'$fileName')");
            }

            // Return type for controller to redirect correctly
            return [
                'success' => $unreported
                    ? "Unreported foreign visit updated successfully."
                    : "Foreign visit updated successfully.",
                'type' => $unreported ? 'unreported_update' : 'update'
            ];
        }

        /* ====================== INSERT ====================== */
        $stmt = $this->db->prepare("
            INSERT INTO ForeignVisit
            (ServiceID,Cadre,Office,Name,Designation,Grade,Workplace,
             DestinationCountry,FundingSource,Purpose,
             StartDate,EndDate,Days,GO,Passport,NID,Uploader)
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
        ");
        $stmt->bind_param(
            "issssissssssissss",
            $serviceID,$cadre,$office,$name,$designation,$grade,$workplace,
            $destCountry,$funding,$purpose,$startDate,$endDate,$days,
            $fileName,$passport,$nid,$uploader
        );
        $stmt->execute();

        return ['success' => "Foreign visit added successfully.", 'type' => 'insert'];
    }

    public function getAllVisits(){
        $res = $this->db->query("SELECT * FROM ForeignVisit ORDER BY ID DESC");
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllUnreportedVisits(){
        $res = $this->db->query("
            SELECT * FROM ForeignVisit
            WHERE EndDate < CURDATE() AND ActualArrival IS NULL
            ORDER BY EndDate ASC
        ");
        return $res->fetch_all(MYSQLI_ASSOC);
    }
}

?>