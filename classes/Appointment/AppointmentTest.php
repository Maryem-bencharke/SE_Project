<?php
require_once 'AppointmentDAOImpl.php';
require_once 'Appointment.php';
$appointmentDAO = new AppointmentDAOImpl();
// Read an appointment from the database
$fetchedAppointmentData = $appointmentDAO->readAppointment(1); 

if ($fetchedAppointmentData) {
    // Create an Appointment object using the fetched data
    $appointment = new Appointment(
        $fetchedAppointmentData['AppointmentID'],
        $fetchedAppointmentData['AppointmentDate'],
        $fetchedAppointmentData['Status'],
        $fetchedAppointmentData['DoctorID'] ?? null,
        $fetchedAppointmentData['NurseID'] ?? null,
        $fetchedAppointmentData['PatientID'] ?? null
    );

    // Update the appointment details
    $appointment->setAppointmentDate("2021-03-02");
    $appointment->setAppointmentStatus("Approved");

    // Update the appointment in the database
    $appointmentDAO->updateAppointment($appointment);
} else {
    echo "No appointment found with the specified ID.";
}
?>