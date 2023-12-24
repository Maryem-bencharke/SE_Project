
<?php
interface PatientDAO{
    public function addPatient($patient);
    public function updatePatient($patient);
    public function deletePatient($patient);
    public function getPatient($patientFirstName, $patientLastName);
    public function getAllPatients();
    public function getPatientByName($name);
}
?>