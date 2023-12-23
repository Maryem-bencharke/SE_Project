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

    //zidi doctorId nurseId patientId setters ou lgetters dyalohoum
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
    
    public function getAppointmentsPerDay($doctorId, $date) {
        $sql = "SELECT * FROM Appointment WHERE DoctorID = ? AND AppointmentDate = ?";
        $stmt = $this->_connection->prepare($sql);
        $stmt->execute([$doctorId, $date]);
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

}
//test
$appointmentDAO = new AppointmentDAOImpl();
$appointment = new Appointment(1, "2021-03-01", "Pending");
$appointmentDAO->createAppointment($appointment);
$appointment = $appointmentDAO->readAppointment(1);
$appointment->setAppointmentDate("2021-03-02");
$appointment->setAppointmentStatus("Approved");
$appointmentDAO->updateAppointment($appointment);
$appointmentDAO->deleteAppointment(1);



?> 
