<?php
require_once '../../db/AbstractDAO.php';
require_once 'AppointmentDAO.php';
require_once 'Appointment.php';

class AppointmentDAOImpl extends AbstractDAO implements AppointmentDAO {
    
    public function createAppointment($appointment) {
        $sql = "INSERT INTO Appointment (PatientID, DoctorID, NurseID, AppointmentDate, Status) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->_connection->prepare($sql);
        $stmt->execute([
            $appointment->getPatientId(),
            $appointment->getAppointmentDate(),
            $appointment->getAppointmentStatus(),
            $appointment->getDoctorId(),
            $appointment->getNurseId(),
        ]);
    }

    public function readAppointment($appointmentId) {
        $sql = "SELECT * FROM Appointment WHERE appointmentId = ?";
        $stmt = $this->_connection->prepare($sql);
        $stmt->execute([$appointmentId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateAppointment($appointment) {
        if ($appointment instanceof Appointment){
            try{
            $sql = "UPDATE Appointment SET PatientID = ?, DoctorID = ?, NurseID = ?, AppointmentDate = ?, Status = ? WHERE AppointmentID = ?";
            $stmt = $this->_connection->prepare($sql);
            $stmt->execute([
                $appointment->getPatientId(),
                $appointment->getDoctorId(),
                $appointment->getNurseId(),
                $appointment->getAppointmentDate(),
                $appointment->getAppointmentStatus(),
                $appointment->getAppointmentId()
            ]);
            return true;
            }
            catch(Exception $e){
                echo $e->getMessage();
                return false;
            }
        }
        else{
            return false;
        }

    }

    public function deleteAppointment($appointmentId) {
        $sql = "DELETE FROM Appointment WHERE appointmentId = ?";
        $stmt = $this->_connection->prepare($sql);
        $stmt->execute([$appointmentId]);
    }


    public function getAppointmentsByPatient($patientId) {
        $sql = "SELECT * FROM Appointment WHERE PatientID = ?";
        $stmt = $this->_connection->prepare($sql);
        $stmt->execute([$patientId]);
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAppointmentsPerDay($doctorId, $date) {
        $sql = "SELECT * FROM Appointment WHERE DoctorID = ? AND AppointmentDate = ?";
        $stmt = $this->_connection->prepare($sql);
        $stmt->execute([$doctorId, $date]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAppointmentsByNurse($nurseId) {
        $sql = "SELECT * FROM Appointment WHERE NurseID = ?";
        $stmt = $this->_connection->prepare($sql);
        $stmt->execute([$nurseId]);
        // return an appointment
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $appointments = array();
        foreach ($result as $appointment) {
            $appointments[] = new Appointment(
                $appointment['AppointmentID'],
                $appointment['AppointmentDate'],
                $appointment['Status'],
                $appointment['DoctorID'],
                $appointment['NurseID'],
                $appointment['PatientID']
            );
        }
        return $appointments;

        //  $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAppointmentById($appointmentId) {
        $sql = "SELECT * FROM Appointment WHERE AppointmentID = ?";
        $stmt = $this->_connection->prepare($sql);
        $stmt->execute([$appointmentId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $appointment = new Appointment(
                $result['AppointmentID'],
                $result['AppointmentDate'],
                $result['Status'],
                $result['DoctorID'],
                $result['NurseID'],
                $result['PatientID']
            );
        } else {
            $appointment = null;
        }
        return $appointment;
    }
    public function addAppointment($appointment) {
        try {
            if($appointment instanceof Appointment){
                $sql = "INSERT INTO Appointment (AppointmentDate, Status, DoctorID, NurseID, PatientID) VALUES (?, ?, ?, ?, ?)";
                $stmt = $this->_connection->prepare($sql);
                $stmt->execute([
                    $appointment->getAppointmentDate(),
                    $appointment->getAppointmentStatus(),
                    $appointment->getDoctorId(),
                    $appointment->getNurseId(),
                    $appointment->getPatientId()
                ]);
                return true;
            }
            else{
                return false;
            }
 
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}

?>