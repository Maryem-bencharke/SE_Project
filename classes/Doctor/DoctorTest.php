<?php
require_once 'DoctorDAOImpl.php';
require_once 'Doctor.php';
//test
$doctorDAO = new DoctorDAOImpl();
$doctor = new Doctor(1, "DrExample", "password123", "dr.example@example.com", "123 Main St", "1234567890", "CIN123456");
try {
    $doctorDAO->createDoctor($doctor);
    echo "Doctor created successfully!";
} catch (Exception $e) {
    echo "Error creating doctor: " . $e->getMessage();
}


$cin = "CIN123456";
try {
    $retrievedDoctor = $doctorDAO->getDoctor($cin);
    echo "Doctor Name: " . $retrievedDoctor->getName();
} catch (Exception $e) {
    echo "Error retrieving doctor: " . $e->getMessage();
}


$doctor->setEmail("new.email@example.com");
try {
    $doctorDAO->updateDoctor($doctor);
    echo "Doctor updated successfully!";
} catch (Exception $e) {
    echo "Error updating doctor: " . $e->getMessage();
}

$date = "2023-12-20"; // Example date
try {
    $appointmentCount = $doctor->getAppointmentsPerDay($doctor, $date);
    echo "Appointments on $date: $appointmentCount";
} catch (Exception $e) {
    echo "Error getting appointments: " . $e->getMessage();
}

/*
try {
    $doctorDAO->deleteDoctor($doctor);
    echo "Doctor deleted successfully!";
} catch (Exception $e) {
    echo "Error deleting doctor: " . $e->getMessage();
}
*/
?>
