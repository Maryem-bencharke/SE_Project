<?php
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
?>