<?php
require_once '../User/User.php';
require_once '../Nurse/Nurse.php';
require_once '../Doctor/Doctor.php';
require_once '../Doctor/DoctorDAO.php';
require_once '../Doctor/DoctorDAOImpl.php';
require_once '../Nurse/Nurse.php';
require_once '../Nurse/NurseDAO.php';
require_once '../Nurse/NurseDAOImpl.php';


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
    public function createNurse($nurse)
    {
        $nurseDAO = new NurseDAOImpl();
        return $nurseDAO->addNurse($nurse);
    }
    public function deleteNurse($nurse)
    {
        if ($nurse instanceof Nurse) {
            $nurseId = $nurse->getUserID();
            $nurseDAO = new NurseDAOImpl();
            return $nurseDAO->deleteNurse($nurseId);
        } else {
            throw new Exception("The provided object is not an instance of Nurse.");
        }
    }
}
?>