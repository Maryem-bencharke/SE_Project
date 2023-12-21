<?php

include 'class1.php';

// Creating an instance of AppointmentDAO
$appointmentDAO = AppointmentDAO::getInstance();

// Creating an appointment
$appointmentId = 1;
$appointmentDetails = ['date' => '2023-12-22', 'time' => '10:00', 'doctor' => 'Dr. Smith'];
$appointmentDAO->createAppointment($appointmentId, $appointmentDetails);

// Reading the created appointment
$appointmentDAO->readAppointment($appointmentId);

// Updating the appointment
$newDetails = ['date' => '2023-12-23', 'time' => '11:00', 'doctor' => 'Dr. Johnson'];
$appointmentDAO->updateAppointment($appointmentId, $newDetails);
$appointmentDAO->readAppointment($appointmentId);

// Deleting the appointment
$appointmentDAO->deleteAppointment($appointmentId);
$appointmentDAO->readAppointment($appointmentId);

// Creating an instance of MedicalRecordDAO
$medicalRecordDAO = MedicalRecordDAO::getInstance();

// Creating a medical record
$recordId = 101;
$recordDetails = ['patientName' => 'John Doe', 'recordDate' => '2023-12-22', 'notes' => 'General Checkup'];
$medicalRecordDAO->createMedicalRecord($recordId, $recordDetails);

// Reading the created medical record
$medicalRecordDAO->readMedicalRecord($recordId);

// Updating the medical record
$newRecordDetails = ['patientName' => 'John Doe', 'recordDate' => '2023-12-25', 'notes' => 'Follow-up Visit'];
$medicalRecordDAO->updateMedicalRecord($recordId, $newRecordDetails);
$medicalRecordDAO->readMedicalRecord($recordId);

// Deleting the medical record
$medicalRecordDAO->deleteMedicalRecord($recordId);
$medicalRecordDAO->readMedicalRecord($recordId);

?>
