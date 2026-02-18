<?php

class ForeignVisitService
{
    private $db;

    public function __construct(mysqli $db)
    {
        $this->db = $db;
    }

    /* =========================
       DELETE VISIT
    ========================= */
    public function delete(int $id): void
    {
        $stmt = $this->db->prepare(
            "SELECT GO FROM ForeignVisit WHERE ID=?"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_assoc();

        if ($res && $res['GO']) {
            $file = "uploads/" . $res['GO'];
            if (file_exists($file)) unlink($file);
        }

        $r = $this->db->query(
            "SELECT RevGO FROM RevisedGO WHERE ID=$id"
        );
        while ($row = $r->fetch_assoc()) {
            $f = "uploads/" . $row['RevGO'];
            if (file_exists($f)) unlink($f);
        }

        $this->db->query("DELETE FROM RevisedGO WHERE ID=$id");
        $this->db->query("DELETE FROM ForeignVisit WHERE ID=$id");
    }

    /* =========================
       SAVE VISIT
    ========================= */
    public function save(array $data, array $files, bool $update, bool $unreported): array
    {
        $errors = [];

        /* ---------- VALIDATION ---------- */
        if (!$unreported) {
            if (empty($data['serviceID']) || !ctype_digit($data['serviceID'])) {
                $errors['serviceID'] = "Valid Service ID required.";
            }
            if (empty($data['name'])) {
                $errors['name'] = "Name is required.";
            }
        }

        if (!empty($errors)) {
            return [
                'status' => 'error',
                'errors' => $errors
            ];
        }

        /* ---------- INSERT / UPDATE ---------- */
        if ($update || $unreported) {
            // simplified (you already have full SQL)
            return [
                'status'   => 'success',
                'message'  => $unreported
                    ? "Unreported visit updated successfully."
                    : "Foreign visit updated successfully.",
                'redirect' => $unreported
                    ? "UnreportedVisits"
                    : "ViewVisits"
            ];
        }

        return [
            'status'   => 'success',
            'message'  => "Foreign visit entry added successfully.",
            'redirect' => "NewEntry"
        ];
    }
}
