<?php
require_once 'NurseDAO.php';
require_once 'Nurse.php';
require_once '../../db/AbstractDAO.php';
require_once(__DIR__ . '/../Patient/Patient.php');
class NurseDAOImpl extends AbstractDAO implements NurseDAO{
    public function getNurse($Username, $Password){
        try{
            $query = "SELECT * FROM nurse WHERE Username = :Username";
            $stmt = $this->_connection->prepare($query);
            $stmt->bindParam(':Username', $Username);
            $stmt->execute();
            $rowCount = $stmt->rowCount();

            if($rowCount > 0){
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                //check Password
                // TODO : hash Password
                if($row['Password'] != $Password){
                    throw new Exception("Wrong Password");
                }
                $nurse = new Nurse($row['NurseID'], $row['Username'], $row['Password'], $row['Email'], $row['Address'], $row['PhoneNumber'], $row['CIN']);
                return $nurse;
            }
            else{
                throw new Exception("No nurse found");
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    public function getNurseById($id){
        try{
            $query = "SELECT * FROM nurse WHERE NurseId = :id";
            $stmt = $this->_connection->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $rowCount = $stmt->rowCount();

            if($rowCount > 0){
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $nurse = new Nurse($row['NurseID'], $row['Username'], $row['Password'], $row['Email'], $row['Address'], $row['PhoneNumber'], $row['CIN']);
                return $nurse;
            }
            else{
                throw new Exception("No nurse found");
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    public function updateNurse($nurse){
        if ($nurse instanceof Nurse){
       
    try {
        $nurseID = $nurse->getUserID();
        $username = $nurse->getName();
        // if ($this->usernameExists($username)) {
        //     throw new Exception("Username already exists. Please choose a different username.");
        // }
        $email = $nurse->getEmail();
        $phoneNumber = $nurse->getPhoneNumber();
        $address = $nurse->getAddress();
        $cin = $nurse->getCIN();

    try {
        $sql = "UPDATE Nurse SET Username=:Username, Email=:Email, PhoneNumber=:PhoneNumber, Address=:Address WHERE NurseID=:NurseID";
        $stmt = $this->_connection->prepare($sql);

        $stmt->bindParam(":Username", $username, PDO::PARAM_STR);
        $stmt->bindParam(":Email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":PhoneNumber", $phoneNumber, PDO::PARAM_STR);
        $stmt->bindParam(":Address", $address, PDO::PARAM_STR);
        $stmt->bindParam(":NurseID", $nurseID, PDO::PARAM_INT);
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
                    throw new Exception("Not an instance of Nurse");
                }
            }



    public function deleteNurse($id){
        try{
            $query = "DELETE FROM nurse WHERE NurseId = :id";
            $stmt = $this->_connection->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    public function addNurse($nurse){
        if ($nurse instanceof Nurse){
            try{
                $query = "INSERT INTO nurse (Username, Password, Email, , PhoneNumber,Address, CIN) VALUES (:Username, :Password, :Email,  :phoneNumber,:Address, :CIN ) 
                ON DUPLICATE KEY UPDATE Username = :Username, Password = :Password, Email = :Email,  PhoneNumber = :phoneNumber, Address = :Address,CIN = :CIN ";
                $stmt = $this->_connection->prepare($query);
                $name = $nurse->getName();
                $stmt->bindParam(':Username', $name);
                $Password = $nurse->getPassword();
                $stmt->bindParam(':Password', $Password);
                $Email = $nurse->getEmail();
                $stmt->bindParam(':Email', $Email);
        
                $phoneNumber = $nurse->getPhoneNumber();
                $stmt->bindParam(':phoneNumber', $phoneNumber);
                $Address = $nurse->getAddress();
                $stmt->bindParam(':Address', $Address);
                $CIN = $nurse->getCIN();
                $stmt->bindParam(':CIN', $CIN);
                $stmt->execute();
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        else {
            throw new Exception("Not an instance of Nurse");

        }
    }
    public function getNurseByCIN($nurseCIN){
        try{
            $query = "SELECT * FROM nurse WHERE CIN = :CIN";
            $stmt = $this->_connection->prepare($query);
            $stmt->bindParam(':CIN', $nurseCIN);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if($row){
                $nurse = new Nurse($row['NurseID'], $row['Username'], $row['Password'], $row['Email'], $row['Address'], $row['PhoneNumber'], $row['CIN']);
                return $nurse;
            }
            else{
                return null;
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return null;
        }
    }
    public function getAllNurses() {
            $nurses = array();
            try {
                $sql = "SELECT * FROM Nurse";
                $stmt = $this->_connection->prepare($sql);
                $stmt->execute();
    
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $nurse = new Nurse(
                        $row['NurseID'],
                        $row['Username'],
                        $row['Password'],
                        $row['Email'],
                        $row['PhoneNumber'],
                        $row['Address'],
                        $row['CIN']
                    );
                    array_push($nurses, $nurse);
                }
            } catch (PDOException $e) {
                // Handle exception
                echo "Error: " . $e->getMessage();
            }
            return $nurses;
        }
    }
    

?>