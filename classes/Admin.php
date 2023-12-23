<?php
require 'User.php';
require '../db/db.php';
require 'nurse.php';
require 'Doctor.php';
class Administrator extends User {
    public function __construct($adminID, $username, $password, $email, $address, $phoneNumber, $CIN) {
        parent::__construct($adminID, $username, $password, $email, $address, $phoneNumber, $CIN);
    }
    public function getPatient($firstName, $lastName)
    {
        $patientDAO = new PatientDAOImpl();
        return $patientDAO->getPatient($firstName, $lastName);
    }

}






?>