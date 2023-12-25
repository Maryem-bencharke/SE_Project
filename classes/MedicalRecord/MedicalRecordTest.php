<?php

require_once 'MedicalRecord.php';
require_once 'MedicalRecordDAOImpl.php';

// Create an instance of MedicalRecordDAOImpl
$medicalRecordDAO = new MedicalRecordDAOImpl();

// Example data for creating a new medical record
$medicalRecord = new MedicalRecord(null, 1, 1, 1, '2023-01-01', 'Example medical record', 'Example treatment plan', 'Example test results', null);

// Test createMedicalRecord
$medicalRecordDAO->createMedicalRecord($medicalRecord);
echo "Medical record created.\n";

// Test readMedicalRecord (use an existing RecordID from your database)
$recordId = 1; // Example RecordID
$readMedicalRecord = $medicalRecordDAO->readMedicalRecord($recordId);
echo "Read Medical Record:\n";
print_r($readMedicalRecord);

// Test updateMedicalRecord (use an existing RecordID from your database)
$medicalRecord->setRecordId($recordId);
$medicalRecordDAO->updateMedicalRecord($medicalRecord);
echo "Medical record updated.\n";

// Test deleteMedicalRecord (use an existing RecordID from your database)
$medicalRecordDAO->deleteMedicalRecord($recordId);
echo "Medical record deleted.\n";
