<?php
require_once '../../db/AbstractDAO.php';
require_once 'DoctorDAO.php';
require_once 'Doctor.php';
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

                    $sql = "INSERT INTO Doctor (Username, Password, Email, Address , PhoneNumber, CIN) VALUES (:Username, :Password, :Email, :PhoneNumber, :Address, :CIN)";
                    $stmt = $this->_connection->prepare($sql);
                    /*if ($this->_connection === null) {
                        die("Database connection is null.");
                    }*/
                    $stmt->bindParam(":Username", $username, PDO::PARAM_STR);
                    $stmt->bindParam(":Password", $password, PDO::PARAM_STR);
                    $stmt->bindParam(":Email", $email, PDO::PARAM_STR);
                    $stmt->bindParam(":Address", $address, PDO::PARAM_STR);
                    $stmt->bindParam(":PhoneNumber", $phoneNumber, PDO::PARAM_STR);
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
                // if ($this->usernameExists($username)) {
                //     throw new Exception("Username already exists. Please choose a different username.");
                // }
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
    public function getAllDoctors() {
        try {
            $sql = "SELECT * FROM Doctor";
            $stmt = $this->_connection->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $doctors = array();
    
            foreach ($result as $doctor) {
                $doctors[] = new Doctor(
                    $doctor['DoctorID'],
                    $doctor['Username'],
                    $doctor['Password'], 
                    $doctor['Email'],
                    $doctor['Address'],
                    $doctor['PhoneNumber'],
                    $doctor['CIN']
                );
            }
    
            return $doctors;
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getDoctorById($doctorId) {
        try {
            $sql = "SELECT * FROM Doctor WHERE DoctorID = ?";
            $stmt = $this->_connection->prepare($sql);
            $stmt->execute([$doctorId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result){
                $doctor = new Doctor(
                    $result['DoctorID'],
                    $result['Username'],
                    $result['Password'], 
                    $result['Email'],
                    $result['Address'],
                    $result['PhoneNumber'],
                    $result['CIN']
                );
                return $doctor;
            }
            else{
                return null;
            }

        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getDoctorByCIN($cin) {
        try {
            $sql = "SELECT * FROM Doctor WHERE CIN = :CIN";
            $stmt = $this->_connection->prepare($sql);
            $stmt->bindParam(":CIN", $cin, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result){
                $doctor = new Doctor(
                    $result['DoctorID'],
                    $result['Username'],
                    $result['Password'], 
                    $result['Email'],
                    $result['Address'],
                    $result['PhoneNumber'],
                    $result['CIN']
                );
                return $doctor;
            }
            else{
                return null;
            }

        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
}
?>