<?php
class MedicalRecord {
    private $_recordId;
    private $_dateCreated;
    private $_treatmentPlan;
    private $_testResults;
    private $_imageData;
    private $_doctorId;
    private $_nurseId;
    private $_patientId;
// Constructor
    public function __construct($recordId, $dateCreated, $treatmentPlan, $testResults, $imageData, $doctorId,
    $nurseId, $patientId) {
        $this->_recordId = $recordId;
        $this->_dateCreated = $dateCreated;
        $this->_treatmentPlan = $treatmentPlan;
        $this->_testResults = $testResults;
        $this->_imageData = $imageData;
        $this->_doctorId = $doctorId;
        $this->_nurseId = $nurseId;
        $this->_patientId = $patientId;
    }

    // Getters
    public function getRecordId() {
        return $this->_recordId;
    }

    public function getDateCreated() {
        return $this->_dateCreated;
    }

    public function getTreatmentPlan() {
        return $this->_treatmentPlan;
    }

    public function getTestResults() {
        return $this->_testResults;
    }

    public function getImageData() {
        return $this->_imageData;
    }

    // Setters
    public function setRecordId($recordId) {
        $this->_recordId = $recordId;
    }

    public function setDateCreated($dateCreated) {
        $this->_dateCreated = $dateCreated;
    }

    public function setTreatmentPlan($treatmentPlan) {
        $this->_treatmentPlan = $treatmentPlan;
    }

    public function setTestResults($testResults) {
        $this->_testResults = $testResults;
    }

    public function setImageData($imageData) {
        $this->_imageData = $imageData;
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
