<?php
require_once 'MedicalRecordDAOImpl.php';
require_once 'MedicalRecord.php';

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

// Assuming you retrieve the RecordID after insertion
// This depends on your implementation details on how you handle auto-incremented IDs post-insertion
$recordId = 1; // Replace with the actual ID or retrieval method

// Read a medical record from the database
$retrievedRecord = $medicalRecordDAO->readMedicalRecord($recordId);
echo "Retrieved Record: ";
print_r($retrievedRecord);
echo "\n";

$medicalRecord->setRecordId($recordId); // Set the record ID to identify which record to update
$medicalRecordDAO->updateMedicalRecord($medicalRecord);
echo "\nMedical record updated\n";

// Delete a medical record from the database
$medicalRecordDAO->deleteMedicalRecord($recordId);
echo "\nMedical record deleted\n";


?>