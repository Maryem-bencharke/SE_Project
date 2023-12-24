<?php
interface MedicalRecordDAO {
    public function createMedicalRecord($medicalRecord);
    public function readMedicalRecord($recordId);
    public function updateMedicalRecord($medicalRecord);
    public function deleteMedicalRecord($recordId);
}
?>