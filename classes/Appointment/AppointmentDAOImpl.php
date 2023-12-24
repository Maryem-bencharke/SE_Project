<?php
require_once '../../db/AbstractDAO.php';
require_once 'AppointmentDAO.php';

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
    public function getAppointmentsPerDay($doctorId, $date) {
        $sql = "SELECT * FROM Appointment WHERE DoctorID = ? AND AppointmentDate = ?";
        $stmt = $this->_connection->prepare($sql);
        $stmt->execute([$doctorId, $date]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>