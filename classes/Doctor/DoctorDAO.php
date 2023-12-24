<?php
interface DoctorDAO {
    public function createDoctor($doctor);
    public function getDoctor($cin);
    public function updateDoctor($doctor);
    public function deleteDoctor($doctor);
}
?>