<?php
require_once 'PatientDAOImpl.php';
require_once 'Patient.php';
$patient = new Patient(
    12,
    "mohammed",
    "mohammed",
    "1990-05-15",
    "Female",
    "AB+",
    "555-1234",
    "789 Meknes, Maroc", 
    "none",
    "mohammed.mohammed@gmail.com",
    "ABC456",
    "wafa Insurance",
    "fatiha mohammed",
    "555-5678",
    "123 Elm St, Townsville",
    "mohammed.mohammed@example.com",
    "Spouse",
    "A+",
    "XYZ123"
);
$patientDAO = new PatientDAOImpl();
$patientDAO->addPatient($patient);
echo "\nadded \n";
//$patientDAO->deletePatient($patient);
// test getPatient
$patientDAO = new PatientDAOImpl();
$patient = $patientDAO->getPatient("Mohamed", "Ben Ali");
//echo $patient->getFirstName();
foreach($patient as $patient){
    echo $patient->getFirstName();
    echo "\n";

}
// test getAllPatients
$patientDAO = new PatientDAOImpl();
$patients = $patientDAO->getAllPatients();
foreach($patients as $patient){
    echo $patient->getFirstName();
    echo "\n";
}


?>