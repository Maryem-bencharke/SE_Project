<?php
require_once 'User.php';
require_once '../db/db.php';
require_once 'patient.php';
require_once 'AppointmentDAO.php';

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


// DoctorDAO Interface
interface DoctorDAO {
    public function createDoctor($doctor);
    public function getDoctor($cin);
    public function updateDoctor($doctor);
    public function deleteDoctor($doctor);
}

// DoctorDAOImpl class implementing DoctorDAO
class DoctorDAOImpl extends AbstractDAO implements DoctorDAO {

    public function usernameExists($username) {
        $sql = "SELECT COUNT(*) FROM Doctor WHERE Username = :Username";
        $stmt = $this->_connection->prepare($sql);
        $stmt->bindParam(":Username", $username, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function createDoctor($doctor) {
        if ($doctor instanceof Doctor) {

            try {
                $username = $doctor->getName();
                if ($this->usernameExists($username)) {
                    throw new Exception("Username already exists. Please choose a different username.");
                }
                $password = $doctor->getPassword();
                $email = $doctor->getEmail();
                $phoneNumber = $doctor->getPhoneNumber();
                $address = $doctor->getAddress();
                $CIN = $doctor->getCIN();
                try {

                    $sql = "INSERT INTO Doctor (Username, Password, Email, PhoneNumber, Address, CIN) VALUES (:Username, :Password, :Email, :PhoneNumber, :Address, :CIN)";
                    $stmt = $this->_connection->prepare($sql);
                    /*if ($this->_connection === null) {
                        die("Database connection is null.");
                    }*/
                    $stmt->bindParam(":Username", $username, PDO::PARAM_STR);
                    $stmt->bindParam(":Password", $password, PDO::PARAM_STR);
                    $stmt->bindParam(":Email", $email, PDO::PARAM_STR);
                    $stmt->bindParam(":PhoneNumber", $phoneNumber, PDO::PARAM_STR);
                    $stmt->bindParam(":Address", $address, PDO::PARAM_STR);
                    $stmt->bindParam(":CIN", $CIN, PDO::PARAM_STR);

                    $stmt->execute();
                }


                catch(PDOException $e){
                    echo $e->getMessage();
                }
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        else{
            throw new Exception("Not an instance of Doctor");
        }
    }


    public function getDoctor($cin)
    {
        try {
            $sql = 'SELECT * FROM Doctor WHERE CIN =:CIN';
            $stmt = $this->_connection->prepare($sql);
            $stmt->bindParam(":CIN", $cin, PDO::PARAM_STR);
            $stmt->execute();
            $doctor = $stmt->fetch(PDO::FETCH_ASSOC);
            $doctor = new Doctor($doctor['DoctorID'], $doctor['Username'], $doctor['Password'], $doctor['Email'], $doctor['Address'], $doctor['PhoneNumber'], $doctor['CIN']);
            return $doctor;
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }


    public function updateDoctor($doctor) {
        if ($doctor instanceof Doctor) {
            try {
                $doctorID = $doctor->getUserID();
                $username = $doctor->getName();
                if ($this->usernameExists($username)) {
                    throw new Exception("Username already exists. Please choose a different username.");
                }
                $email = $doctor->getEmail();
                $phoneNumber = $doctor->getPhoneNumber();
                $address = $doctor->getAddress();
                $cin = $doctor->getCIN();

            try {
                $sql = "UPDATE Doctor SET Username=:Username, Email=:Email, PhoneNumber=:PhoneNumber, Address=:Address WHERE DoctorID=:DoctorID";
                $stmt = $this->_connection->prepare($sql);

                $stmt->bindParam(":Username", $username, PDO::PARAM_STR);
                $stmt->bindParam(":Email", $email, PDO::PARAM_STR);
                $stmt->bindParam(":PhoneNumber", $phoneNumber, PDO::PARAM_STR);
                $stmt->bindParam(":Address", $address, PDO::PARAM_STR);
                $stmt->bindParam(":DoctorID", $doctorID, PDO::PARAM_INT);
                    $stmt->execute();
                }
                catch(PDOException $e){
                    echo $e->getMessage();
                }
                            }
                            catch(PDOException $e){
                                echo $e->getMessage();
                            }
                        }
                        else{
                            throw new Exception("Not an instance of Doctor");
                        }
                    }



    public function deleteDoctor($doctor) {
        if ($doctor instanceof Doctor){
            try {
                $doctorID = $doctor->getUserID();
                try{
                $sql = "DELETE FROM Doctor WHERE DoctorID=:doctorID";
                $stmt = $this->_connection->prepare($sql);
                $stmt->bindParam(":doctorID", $doctorID, PDO::PARAM_INT);
                $stmt->execute();
            }catch(PDOException $e){
                    echo $e->getMessage();
                }
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        else{
            throw new Exception("Not an instance of Doctor");
        }
    }


}


//test
$doctorDAO = new DoctorDAOImpl();
$doctor = new Doctor(1, "DrExample", "password123", "dr.example@example.com", "123 Main St", "1234567890", "CIN123456");
try {
    $doctorDAO->createDoctor($doctor);
    echo "Doctor created successfully!";
} catch (Exception $e) {
    echo "Error creating doctor: " . $e->getMessage();
}


$cin = "CIN123456";
try {
    $retrievedDoctor = $doctorDAO->getDoctor($cin);
    echo "Doctor Name: " . $retrievedDoctor->getName();
} catch (Exception $e) {
    echo "Error retrieving doctor: " . $e->getMessage();
}


$doctor->setEmail("new.email@example.com");
try {
    $doctorDAO->updateDoctor($doctor);
    echo "Doctor updated successfully!";
} catch (Exception $e) {
    echo "Error updating doctor: " . $e->getMessage();
}

$date = "2023-12-20"; // Example date
try {
    $appointmentCount = $doctor->getAppointmentsPerDay($doctor, $date);
    echo "Appointments on $date: $appointmentCount";
} catch (Exception $e) {
    echo "Error getting appointments: " . $e->getMessage();
}


try {
    $doctorDAO->deleteDoctor($doctor);
    echo "Doctor deleted successfully!";
} catch (Exception $e) {
    echo "Error deleting doctor: " . $e->getMessage();
}

?>
