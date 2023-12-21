<?php
require_once 'Db.php'; 

class MedicalRecordDAO extends AbstractDAO {
    private static $instance = null;

    // Private constructor for Singleton
    private function __construct() {
        parent::__construct(); 
    }

    // Singleton getInstance method
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new MedicalRecordDAO();
        }
        return self::$instance;
    }

    // Create a medical record
    public function createMedicalRecord($recordDetails) {
        $sql = "INSERT INTO MedicalRecord (PatientID, DoctorID, NurseID, DateCreated, Record, TreatmentPlan, TestResults, ImageData) VALUES (:PatientID, :DoctorID, :NurseID, :DateCreated, :Record, :TreatmentPlan, :TestResults, :ImageData)";
        $stmt = $this->_connection->prepare($sql);

        // Bind parameters
        $stmt->bindValue(':PatientID', $recordDetails['PatientID']);
        $stmt->bindValue(':DoctorID', $recordDetails['DoctorID']);
        $stmt->bindValue(':NurseID', $recordDetails['NurseID']);
        $stmt->bindValue(':DateCreated', $recordDetails['DateCreated']);
        $stmt->bindValue(':Record', $recordDetails['Record']);
        $stmt->bindValue(':TreatmentPlan', $recordDetails['TreatmentPlan']);
        $stmt->bindValue(':TestResults', $recordDetails['TestResults']);
        $stmt->bindValue(':ImageData', $recordDetails['ImageData']);

        $stmt->execute();
    }

    // Read a medical record
    public function readMedicalRecord($recordId) {
        $sql = "SELECT * FROM MedicalRecord WHERE RecordID = :RecordID";
        $stmt = $this->_connection->prepare($sql);
        $stmt->bindValue(':RecordID', $recordId);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update a medical record
    public function updateMedicalRecord($recordData) {
        $sql = "UPDATE MedicalRecord SET PatientID = ?, DoctorID = ?, NurseID = ?, DateCreated = ?, Record = ?, TreatmentPlan = ?, TestResults = ?, ImageData = ? WHERE RecordID = ?";
        $stmt = $this->_connection->prepare($sql);
    
        $stmt->execute([
            $recordData['PatientID'],
            $recordData['DoctorID'],
            $recordData['NurseID'],
            $recordData['DateCreated'],
            $recordData['Record'],
            $recordData['TreatmentPlan'],
            $recordData['TestResults'],
            $recordData['ImageData'],
            $recordData['RecordID']
        ]);
    }
    

    // Delete a medical record
    public function deleteMedicalRecord($recordId) {
        $sql = "DELETE FROM MedicalRecord WHERE RecordID = :RecordID";
        $stmt = $this->_connection->prepare($sql);
        $stmt->bindValue(':RecordID', $recordId);

        $stmt->execute();
    }
}
?>
