<?php

require 'db/db.php'; 

interface MedicalRecordDAO {
    public function createMedicalRecord($medicalRecord);
    public function readMedicalRecord($recordId);
    public function updateMedicalRecord($medicalRecord);
    public function deleteMedicalRecord($recordId);
}

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


class MedicalRecord {
    private $_recordId;
    private $_dateCreated;
    private $_treatmentPlan;
    private $_testResults;
    private $_imageData;
// Constructor
    public function __construct($recordId, $dateCreated, $treatmentPlan, $testResults, $imageData) {
        $this->_recordId = $recordId;
        $this->_dateCreated = $dateCreated;
        $this->_treatmentPlan = $treatmentPlan;
        $this->_testResults = $testResults;
        $this->_imageData = $imageData;
    }

    // Getters
    public function getRecordId() {
        return $this->_recordId;
    }

    public function getDateCreated() {
        return $this->_dateCreated;
    }

    public function getTreatmentPlan() {
        return $this->_treatmentPlan;
    }

    public function getTestResults() {
        return $this->_testResults;
    }

    public function getImageData() {
        return $this->_imageData;
    }

    // Setters
    public function setRecordId($recordId) {
        $this->_recordId = $recordId;
    }

    public function setDateCreated($dateCreated) {
        $this->_dateCreated = $dateCreated;
    }

    public function setTreatmentPlan($treatmentPlan) {
        $this->_treatmentPlan = $treatmentPlan;
    }

    public function setTestResults($testResults) {
        $this->_testResults = $testResults;
    }

    public function setImageData($imageData) {
        $this->_imageData = $imageData;
    }
}

// Create a new MedicalRecord instance
$medicalRecord = new MedicalRecord(
    null, // RecordID is auto-increment, so pass null or don't include it in the constructor
    1,    // PatientID
    2,    // DoctorID
    3,    // NurseID
    '2023-01-01', // DateCreated
    'Sample Medical Record', // Record
    'Treatment Plan',        // TreatmentPlan
    'Test Results',          // TestResults
    null  // ImageData (binary data or null)
);

// Create a new medical record in the database
$medicalRecordDAO = new MedicalRecordDAOImpl();
$medicalRecordDAO->createMedicalRecord($medicalRecord);
echo "\nMedical record added\n";

// Read a medical record from the database
$retrievedRecord = $medicalRecordDAO->readMedicalRecord(1); // Assuming 1 is a valid RecordID
echo "Retrieved Record: ";
print_r($retrievedRecord);
echo "\n";

// Update a medical record in the database
$medicalRecord->setRecordId("Updated Medical Record"); // Modify the record or other properties as needed
$medicalRecordDAO->updateMedicalRecord($medicalRecord);
echo "\nMedical record updated\n";

// Delete a medical record from the database
$medicalRecordDAO->deleteMedicalRecord(1); // Assuming 1 is a valid RecordID
echo "\nMedical record deleted\n";

?>
