<?php
require_once 'DoctorDAOImpl.php';
require_once 'Doctor.php';
require_once '../Patient/Patient.php';


$doctor = new Doctor(1, "DrExample", "password123", "dr.example@example.com", "123 Main St", "1234567890", "CIN123456");
$patient = new Patient(1, "John", "Doe", "1990-01-01", "Male", "O+", "123-456-7890", "123 Patient St", "Peanuts", "john.doe@example.com", "CIN123456", "Insurance Plan ABC", "Jane Doe", "098-765-4321", "456 Emergency St", "jane.doe@example.com", "Sister", "AB-", "CIN654321");

try {
    $doctor->getPatient($patient.getFirstName(),$patient.getLastName());
    echo "Patient found successfully!";
} catch (Exception $e) {
    echo "Error finding patient: " . $e->getMessage();
}

$patient->setLastName("UpdatedLastName");
try {
    $doctor->updatePatient($patient);
    echo "Patient updated successfully!";
} catch (Exception $e) {
    echo "Error updating patient: " . $e->getMessage();
}

?>