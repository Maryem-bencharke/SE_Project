<?php
require 'User.php';
require '../db/db.php';
require 'Patient.php';
require 'Appointment.php';
//max appointment per day for a doctor are 10
class Nurse extends User{

    public function __construct($userID, $username, $password, $email, $address, $phoneNumber, $CIN) {
        parent::__construct($userID, $username, $password, $email, $address, $phoneNumber, $CIN);
    }
    public function changePatientName($patient, $firstName, $lastName){
        if ($patient instanceof Patient){
            $patient->setFirstName($firstName);
            $patient->setLastName($lastName);
            $patientDAO = new PatientDAOImpl();
            $patientDAO->updatePatient($patient);
        }
        else{
            throw new Exception("Not an instance of Patient");
        }
    }
    public function changePatientAddress($patient, $address){
        if ($patient instanceof Patient){
            $patient->setAddress($address);
            $patientDAO = new PatientDAOImpl();
            $patientDAO->updatePatient($patient);
        }
        else{
            throw new Exception("Not an instance of Patient");
        }

    }
    public function changePatientPhoneNumber($patient, $phoneNumber){
        if ($patient instanceof Patient){
            $patient->setPhoneNumber($phoneNumber);
            $patientDAO = new PatientDAOImpl();
            $patientDAO->updatePatient($patient);
        }
        else{
            throw new Exception("Not an instance of Patient");
        }
    }
    public function changePatientEmail($patient, $email){
        if ($patient instanceof Patient){
            $patient->setEmail($email);
            $patientDAO = new PatientDAOImpl();
            $patientDAO->updatePatient($patient);
        }
        else{
            throw new Exception("Not an instance of Patient");
        }
    }

    public function changePatientInsurance($patient, $insurance){
        if ($patient instanceof Patient){
            $patient->setInsuranceInfo($insurance);
            $patientDAO = new PatientDAOImpl();
            $patientDAO->updatePatient($patient);
        }
        else{
            throw new Exception("Not an instance of Patient");
        }
    }
    public function changePatientAllergies($patient, $allergies){
        if ($patient instanceof Patient){
            $patient->setAllergies($allergies);
            $patientDAO = new PatientDAOImpl();
            $patientDAO->updatePatient($patient);
        }
        else{
            throw new Exception("Not an instance of Patient");
        }
    }
    public function changePatientEmergencyContact($patient, $emergencyContactName, $emergencyContactPhone, $emergencyContactAddress, $emergencyContactRelation, $emergencyContactBloodGroup, $emergencyContactCIN){
        if ($patient instanceof Patient){
            $patient->setEmergencyContactName($emergencyContactName);
            $patient->setEmergencyContactPhone($emergencyContactPhone);
            $patient->setEmergencyContactAddress($emergencyContactAddress);
            $patient->setEmergencyContactRelation($emergencyContactRelation);
            $patient->setEmergencyContactBloodGroup($emergencyContactBloodGroup);
            $patient->setEmergencyContactCIN($emergencyContactCIN);
            $patientDAO = new PatientDAOImpl();
            $patientDAO->updatePatient($patient);
        }
        else{
            throw new Exception("Not an instance of Patient");
        }
    }

    public function getPatient($firstName, $lastName) {
        $patientDAO = new PatientDAOImpl();
        return $patientDAO->getPatient($firstName, $lastName);
    }
    public function addPatient($patient){
        $patientDAO = new PatientDAOImpl();
        $patientDAO->addPatient($patient);
    }
    public function addAppointments($appointment){
        if($appointment instanceof Appointment){
            // $doctorId = $appointment->getDoctorID();
            // $doctor = new DoctorDAOImpl();
            // $doctor = $doctor->getDoctor($doctorId);
            // if($doctor->getAppointmentsPerDay() >= 10){
            //     throw new Exception("Doctor not available");
            // }
            $appointmentDAO = new AppointmentDAOImpl();
            $appointmentDAO->addAppointment($appointment);
        }
        else{
            throw new Exception("Not an instance of Appointment");
        }
    }
    public function changeAppointmentStatus($appointment, $status){
        if ($appointment instanceof Appointment){
            $appointment->setStatus($status);
            $appointmentDAO = new AppointmentDAOImpl();
            $appointmentDAO->updateAppointment($appointment);
        }
        else{
            throw new Exception("Not an instance of Appointment");
        }
    }
    public function changeAppointmentDate($appointment, $date){
        if ($appointment instanceof Appointment){
            // check if the doctor is available that day
            // $doctorId = $appointment->getDoctorID();
            // $doctor = new DoctorDAOImpl();
            // $doctor = $doctor->getDoctor($doctorId);
            // if($doctor->getAppointmentsPerDay() >= 10){
            //     throw new Exception("Doctor not available");
            // }
            $appointment->setAppointmentDate($date);
            $appointmentDAO = new AppointmentDAOImpl();
            $appointmentDAO->updateAppointment($appointment);
        }
        else{
            throw new Exception("Not an instance of Appointment");
        }
    }
    public function changeAppointmentDoctor($appointment, $doctor){
        if ($doctor instanceof Doctor){
            if ($appointment instanceof Appointment){
            //     if($doctor->getAppointmentsPerDay() >= 10){
            //         throw new Exception("Doctor not available");
            //     }
                $appointment->setDoctorID($doctor);
                $appointmentDAO = new AppointmentDAOImpl();
                $appointmentDAO->updateAppointment($appointment);
            }
            else{
                throw new Exception("Not an instance of Appointment");
            }
        }
        else{
            throw new Exception("Not an instance of Doctor");
        }
       
    }
    public function searchAppointmentsPatient($patient){
        if ($patient instanceof Patient){
            $appointmentDAO = new AppointmentDAOImpl();
            return $appointmentDAO->getAppointmentsByPatient($patient);
        }
        else{
            throw new Exception("Not an instance of Patient");
        }
    }

}
?>