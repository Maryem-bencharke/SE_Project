<?php
require_once '../User/User.php';
require_once '../Nurse/nurse.php';
class Administrator extends User {
    public function __construct($userID, $name, $password, $email, $address, $phoneNumber, $CIN) {
        parent::__construct($userID, $name, $password, $email, $address, $phoneNumber, $CIN);
    }
    public function createDoctor($doctor)
    {
        $doctorDAO = new DoctorDAOImpl();
        return $doctorDAO->createDoctor($doctor);
    }
    public function deleteDoctor($doctor)
    {
        $doctorDAO = new DoctorDAOImpl();
        return $doctorDAO->deleteDoctor($doctor);
    }
    public function createNurse()
    {

    }
    public function deleteNurse()
    {

    }
}
?>