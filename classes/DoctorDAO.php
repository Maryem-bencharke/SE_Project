<?php

interface DoctorDAO {
    public function createDoctor($doctor);
    public function findDoctor($doctorID);
    public function updateDoctor($doctor);
    public function deleteDoctor($doctorID);
}
?>