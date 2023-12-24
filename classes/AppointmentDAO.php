<?php

 require '../db/db.php';

interface AppointmentDAO {
    public function createAppointment($appointment);
    public function readAppointment($appointmentId);
    public function updateAppointment($appointment);
    public function deleteAppointment($appointmentId);
}
class Appointment {
    private $_appointmentId;
    private $_appointmentDate;
    private $_appointmentStatus;
    private $_doctorId;
    private $_nurseId;
    private $_patientId;

    
    public function __construct($appointmentId, $appointmentDate, $appointmentStatus, $doctorId,
    $nurseId, $patientId) 
    {
        $this->_appointmentId = $appointmentId;
        $this->_appointmentDate = $appointmentDate;
        $this->_appointmentStatus = $appointmentStatus;
        $this->_doctorId = $doctorId;
        $this->_nurseId = $nurseId;
        $this->_patientId = $patientId;
    }

    // Getters
    public function getAppointmentId() {
        return $this->_appointmentId;
    }

    public function getAppointmentDate() {
        return $this->_appointmentDate;
    }

    public function getAppointmentStatus() {
        return $this->_appointmentStatus;
    }

    // Setters
    public function setAppointmentId($appointmentId) {
        $this->_appointmentId = $appointmentId;
    }

    public function setAppointmentDate($appointmentDate) {
        $this->_appointmentDate = $appointmentDate;
    }

    public function setAppointmentStatus($appointmentStatus) {
        $this->_appointmentStatus = $appointmentStatus;
    }
    public function setDoctorId($doctorId) {
        $this->_doctorId = $doctorId;
    }

    public function setNurseId($nurseId) {
        $this->_nurseId = $nurseId;
    }

    public function setPatientId($patientId) {
        $this->_patientId = $patientId;
    }

    // Getters
    public function getDoctorId() {
        return $this->_doctorId;
    }

    public function getNurseId() {
        return $this->_nurseId;
    }

    public function getPatientId() {
        return $this->_patientId;
    }
}
class AppointmentDAOImpl extends AbstractDAO implements AppointmentDAO {
    
    public function createAppointment($appointment) {
        $sql = "INSERT INTO Appointment (PatientID, DoctorID, NurseID, AppointmentDate, Status) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->_connection->prepare($sql);
        $stmt->execute([
            $appointment->getPatientId(),
            $appointment->getAppointmentDate(),
            $appointment->getAppointmentStatus(),
            $appointment->getDoctorId(),
            $appointment->getNurseId(),
        ]);
    }

    public function readAppointment($appointmentId) {
        $sql = "SELECT * FROM Appointment WHERE appointmentId = ?";
        $stmt = $this->_connection->prepare($sql);
        $stmt->execute([$appointmentId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateAppointment($appointment) {
        $sql = "UPDATE Appointment SET PatientID = ?, DoctorID = ?, NurseID = ?, AppointmentDate = ?, Status = ? WHERE AppointmentID = ?";
        $stmt = $this->_connection->prepare($sql);
        $stmt->execute([
            $appointment->getPatientId(),
            $appointment->getDoctorId(),
            $appointment->getNurseId(),
            $appointment->getAppointmentDate(),
            $appointment->getAppointmentStatus(),
            $appointment->getAppointmentId()
        ]);
    }

    public function deleteAppointment($appointmentId) {
        $sql = "DELETE FROM Appointment WHERE appointmentId = ?";
        $stmt = $this->_connection->prepare($sql);
        $stmt->execute([$appointmentId]);
    }


    public function getAppointmentsByPatient($patientId) {
        $sql = "SELECT * FROM Appointment WHERE PatientID = ?";
        $stmt = $this->_connection->prepare($sql);
        $stmt->execute([$patientId]);
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    

}

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
