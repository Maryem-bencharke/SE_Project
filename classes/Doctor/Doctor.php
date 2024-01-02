<?php
require_once __DIR__ . '/../User/User.php';
require_once __DIR__ . '/../Patient/Patient.php';
require_once __DIR__ . '/../Appointment/Appointment.php';
require_once __DIR__ . '/../Appointment/AppointmentDAOImpl.php';
require_once __DIR__ . '/../Patient/PatientDAOImpl.php';

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

    public function getAppointmentsPerDay( $date){
        $doctorId = $this->getUserID();
        $appointmentDAO = new AppointmentDAOImpl();
        //return $appointmentDAO->getAppointmentsPerDay($doctorId, $date);
        $appointments = $appointmentDAO->getAppointmentsPerDay($doctorId, $date);

        // Count the number of appointments returned
        $appointmentCount = count($appointments);
        return $appointmentCount;
   
}
}

?>
