<?php
require_once 'AdministratorDAOImpl.php';
require_once 'Administrator.php';
require_once '../Doctor/Doctor.php';
require_once '../Nurse/Nurse.php';

$admin = new Administrator(1, "AdminUser", "adminPass123", "admin@example.com", "123 Admin St", "123-456-7890", "ADMINCIN123");
$doctor = new Doctor(1, "DoctorUser", "doctorPass123", "doctor@example.com", "456 Doctor St", "234-567-8901", "DOCTORCIN123");
$nurse = new Nurse(1, "NurseUser", "nursePass123", "nurse@example.com", "789 Nurse St", "345-678-9012", "NURSECIN123");



    try {
        $admin->createDoctor($doctor);
        echo "Doctor created successfully!";
    } catch (Exception $e) {
        echo "Error creating doctor: " . $e->getMessage();
    }




    try {
        $admin->deleteDoctor($doctor);
        echo "Doctor deleted successfully!";
    } catch (Exception $e) {
        echo "Error deleting doctor: " . $e->getMessage();
    }




try {
        $admin->createNurse($nurse);
        echo "Nurse created successfully!";
    } catch (Exception $e) {
        echo "Error creating nurse: " . $e->getMessage();
    }


try {
    $admin->deleteNurse($nurse);
    echo "Nurse deleted successfully!";
} catch (Exception $e) {
    echo "Error deleting nurse: " . $e->getMessage();
}

?>