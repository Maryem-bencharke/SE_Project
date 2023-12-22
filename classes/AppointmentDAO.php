<?php

 require 'db/db.php';

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

    public function __construct($appointmentId, $appointmentDate, $appointmentStatus) {
        $this->_appointmentId = $appointmentId;
        $this->_appointmentDate = $appointmentDate;
        $this->_appointmentStatus = $appointmentStatus;
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
}
class AppointmentDAOImpl extends AbstractDAO implements AppointmentDAO {
    
    public function createAppointment($appointment) {
        $sql = "INSERT INTO Appointment (appointmentDate, appointmentStatus) VALUES (?, ?)";
        $stmt = $this->_connection->prepare($sql);
        $stmt->execute([
            $appointment->getAppointmentDate(),
            $appointment->getAppointmentStatus()
        ]);
    }

    public function readAppointment($appointmentId) {
        $sql = "SELECT * FROM Appointment WHERE appointmentId = ?";
        $stmt = $this->_connection->prepare($sql);
        $stmt->execute([$appointmentId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateAppointment($appointment) {
        $sql = "UPDATE Appointment SET appointmentDate = ?, appointmentStatus = ? WHERE appointmentId = ?";
        $stmt = $this->_connection->prepare($sql);
        $stmt->execute([
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
}



?> 
