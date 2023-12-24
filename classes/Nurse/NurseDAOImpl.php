<?php
require_once 'NurseDAO.php';
require_once '../../db/AbstractDAO.php';
require_once '../Patient/Patient.php';
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
            try{
                // Check if the new username already exists (excluding the current record)
                $checkQuery = "SELECT COUNT(*) FROM nurse WHERE Username = :Username AND NurseId != :userID";
                $checkStmt = $this->_connection->prepare($checkQuery);
                $name = $nurse->getName();
                $checkStmt->bindParam(':Username', $name);
                $userID = $nurse->getUserID();
                $checkStmt->bindParam(':userID', $userID);
                $checkStmt->execute();
                $rowCount = $checkStmt->fetchColumn();

                if ($rowCount > 0) {
                    throw new Exception("New username already exists");
                }
                $query = "UPDATE nurse SET Username = :Username, Password = :Password, Email = :Email, Address = :Address, PhoneNumber = :phoneNumber, CIN = :CIN WHERE NurseId = :userID ";
                $stmt = $this->_connection->prepare($query);
                $name = $nurse->getName();
                $stmt->bindParam(':Username', $name);
                $password = $nurse->getPassword();
                $stmt->bindParam(':Password', $password);
                $email = $nurse->getEmail();
                $stmt->bindParam(':Email', $email);
                $address = $nurse->getAddress();
                $stmt->bindParam(':Address', $address);
                $phoneNumber = $nurse->getPhoneNumber();
                $stmt->bindParam(':phoneNumber', $phoneNumber);
                $CIN = $nurse->getCIN();
                $stmt->bindParam(':CIN', $CIN);
                $userID = $nurse->getUserID();
                $stmt->bindParam(':userID', $userID);

                $stmt->execute();
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
                $query = "INSERT INTO nurse (Username, Password, Email, Address, PhoneNumber, CIN) VALUES (:Username, :Password, :Email, :Address, :phoneNumber, :CIN ) 
                ON DUPLICATE KEY UPDATE Username = :Username, Password = :Password, Email = :Email, Address = :Address, PhoneNumber = :phoneNumber, CIN = :CIN ";
                $stmt = $this->_connection->prepare($query);
                $name = $nurse->getName();
                $stmt->bindParam(':Username', $name);
                $Password = $nurse->getPassword();
                $stmt->bindParam(':Password', $Password);
                $Email = $nurse->getEmail();
                $stmt->bindParam(':Email', $Email);
                $Address = $nurse->getAddress();
                $stmt->bindParam(':Address', $Address);
                $phoneNumber = $nurse->getPhoneNumber();
                $stmt->bindParam(':phoneNumber', $phoneNumber);
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
}
?>