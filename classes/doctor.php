<?php
require 'User.php';
require '../db/db.php';

// Doctor class extending User
class Doctor extends User  {

    public function __construct($userID, $username, $password, $email, $address, $phoneNumber, $CIN) {
        parent::__construct($userID, $username, $password, $email, $address, $phoneNumber, $CIN);
    }

    /*public function searchPatient($firstName, $lastName) {
        $sql = "SELECT * FROM Patient WHERE FirstName LIKE ? AND LastName LIKE ?";
        $stmt = $this->_connection->prepare($sql);
        $likeFirstName = '%' . $firstName . '%';
        $likeLastName = '%' . $lastName . '%';
        $stmt->bindParam(1, $likeFirstName);
        $stmt->bindParam(2, $likeLastName);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }*/
    public function updatePatient(){

    }
}

// DoctorDAO Interface
interface DoctorDAO {
    public function createDoctor($doctor);
    public function findDoctor($cin);
    public function updateDoctor($doctor, $cin);
    public function deleteDoctor($cin);
}

// DoctorDAOImpl class implementing DoctorDAO
class DoctorDAOImpl extends AbstractDAO implements DoctorDAO {


    public function createDoctor($doctor) {
        if ($doctor instanceof Doctor) {
            try {
                $username = $doctor->getName();
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


    public function findDoctor($cin) {
        $sql = "SELECT * FROM Doctor WHERE CIN = :CIN";
        $stmt = $this->_connection->prepare($sql);
        $stmt->bindParam(":CIN", $cin, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateDoctor($doctor, $cin) {

        if ($doctor instanceof Doctor){
            try {
                $username = $doctor->getName();
                $email = $doctor->getEmail();
                $phoneNumber = $doctor->getPhoneNumber();
                $address = $doctor->getAddress();
                try{
                $sql = "UPDATE Doctor SET Username=:Username, Email=:Email, PhoneNumber=:PhoneNumber, Address=:Address WHERE CIN=:CIN";
                $stmt = $this->_connection->prepare($sql);

                $stmt->bindParam(":Username", $username, PDO::PARAM_STR);
                $stmt->bindParam(":Email", $email, PDO::PARAM_STR);
                $stmt->bindParam(":PhoneNumber", $phoneNumber, PDO::PARAM_STR);
                $stmt->bindParam(":Address", $address, PDO::PARAM_STR);
                $stmt->bindParam(":CIN", $cin, PDO::PARAM_STR);

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


    public function deleteDoctor($cin) {
        $sql = "DELETE FROM Doctor WHERE CIN = :CIN";
        $stmt = $this->_connection->prepare($sql);
        $stmt->bindParam(":CIN", $cin, PDO::PARAM_STR);
        $stmt->execute();
    }
}
$userID = 1;
$username = "DrJohnDoe";
$password = "password123";
$email = "dr.johndoe@example.com";
$phoneNumber = "1234567890";
$address = "123 Main St";
$CIN = "CIN123456";

$doctor = new Doctor($userID, $username, $password, $email, $address, $phoneNumber, $CIN);

$doctorDAO = new DoctorDAOImpl();

try {
    $doctorDAO->createDoctor($doctor);
    echo "Doctor added successfully!";
} catch (Exception $e) {
    echo "Error adding doctor: " . $e->getMessage();
}


//change find to get
//change name in diagram to username