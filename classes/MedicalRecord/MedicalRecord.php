<?php
class MedicalRecord {
    private $_recordId;
    private $_dateCreated;
    private $_treatmentPlan;
    private $_testResults;
    private $_imageData;
// Constructor
    public function __construct($recordId, $dateCreated, $treatmentPlan, $testResults, $imageData) {
        $this->_recordId = $recordId;
        $this->_dateCreated = $dateCreated;
        $this->_treatmentPlan = $treatmentPlan;
        $this->_testResults = $testResults;
        $this->_imageData = $imageData;
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
}


?>
