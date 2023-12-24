<?php
require_once '../../db/AbstractDAO.php';
require_once 'MedicalRecordDAO.php';

class MedicalRecordDAOImpl extends AbstractDAO implements MedicalRecordDAO {
    
    public function createMedicalRecord($medicalRecord) {
        // Prepare an SQL statement to insert a new medical record
        $sql = "INSERT INTO MedicalRecord (PatientID, DoctorID, NurseID, DateCreated, Record, TreatmentPlan, TestResults, ImageData) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->_connection->prepare($sql);

        // Execute the statement with values from the MedicalRecord object
        $stmt->execute([
            $medicalRecord->getPatientID(),
            $medicalRecord->getDoctorID(),
            $medicalRecord->getNurseID(),
            $medicalRecord->getDateCreated(),
            $medicalRecord->getRecord(),
            $medicalRecord->getTreatmentPlan(),
            $medicalRecord->getTestResults(),
            $medicalRecord->getImageData()
        ]);
        // Add error handling as necessary
    }

    public function readMedicalRecord($recordId) {
        // Prepare an SQL statement to read a medical record by ID
        $sql = "SELECT * FROM MedicalRecord WHERE RecordID = ?";
        $stmt = $this->_connection->prepare($sql);
        $stmt->execute([$recordId]);

        // Fetch and return the record
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateMedicalRecord($medicalRecord) {
        // Prepare an SQL statement to update a medical record
        $sql = "UPDATE MedicalRecord SET PatientID = ?, DoctorID = ?, NurseID = ?, DateCreated = ?, Record = ?, TreatmentPlan = ?, TestResults = ?, ImageData = ? WHERE RecordID = ?";
        $stmt = $this->_connection->prepare($sql);

        // Execute the statement with updated values
        $stmt->execute([
            $medicalRecord->getPatientID(),
            $medicalRecord->getDoctorID(),
            $medicalRecord->getNurseID(),
            $medicalRecord->getDateCreated(),
            $medicalRecord->getRecord(),
            $medicalRecord->getTreatmentPlan(),
            $medicalRecord->getTestResults(),
            $medicalRecord->getImageData(),
            $medicalRecord->getRecordId()
        ]);
        // Add error handling as necessary
    }

    public function deleteMedicalRecord($recordId) {
        // Prepare an SQL statement to delete a medical record by ID
        $sql = "DELETE FROM MedicalRecord WHERE RecordID = ?";
        $stmt = $this->_connection->prepare($sql);
        $stmt->execute([$recordId]);
        // Add error handling as necessary
    }
}

?>