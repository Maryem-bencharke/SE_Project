<?php
require_once '../User/User.php';
require_once '../Patient/Patient.php';
require_once '../Appointment/AppointmentDAOImpl.php';

// Doctor class extending User
class Doctor extends User
{

    public function __construct($userID, $name, $password, $email, $address, $phoneNumber, $CIN) {
        parent::__construct($userID, $name, $password, $email, $address, $phoneNumber, $CIN);
    }


    public function getPatient($firstName, $lastName)
    {
        $patientDAO = new PatientDAOImpl();
        return $patientDAO->getPatient($firstName, $lastName);
    }

    public function updatePatient($patient)
    {
        $patientDAO = new PatientDAOImpl();
        return $patientDAO->updatePatient($patient);

    }

    public function getAppointmentsPerDay($doctor, $date){
    if ($doctor instanceof Doctor) {
        $doctorId = $doctor->getUserID();
        $appointmentDAO = new AppointmentDAOImpl();
        //return $appointmentDAO->getAppointmentsPerDay($doctorId, $date);
        $appointments = $appointmentDAO->getAppointmentsPerDay($doctorId, $date);

        // Count the number of appointments returned
        $appointmentCount = count($appointments);
        return $appointmentCount;
    } else {
        throw new Exception("The provided object is not an instance of Doctor.");
    }
}
}

?>
