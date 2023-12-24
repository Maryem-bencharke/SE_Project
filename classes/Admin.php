<?php
require_once 'User.php';
require_once '../db/db.php';
require_once 'nurse.php';
require_once 'Doctor.php';
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
    public function createNurse()
    {

    }
    public function deleteNurse()
    {

    }
}

interface AdministratorDAO {
    public function createAdministrator($administrator);
    public function updateAdministrator($administrator);
    public function deleteAdministrator($administrator);
}
class AdministratorDAOImpl extends AbstractDAO implements AdministratorDAO {
    public function usernameExists($username) {
        $sql = "SELECT COUNT(*) FROM Administrator WHERE Username = :Username";
        $stmt = $this->_connection->prepare($sql);
        $stmt->bindParam(":Username", $username, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }
    public function createAdministrator($administrator) {
        if ($administrator instanceof Administrator) {
            try {
                $username = $administrator->getName();
                if ($this->usernameExists($username)) {
                    throw new Exception("Username already exists. Please choose a different username.");
                }
                $password = $administrator->getPassword();
                $email = $administrator->getEmail();
                $phoneNumber = $administrator->getPhoneNumber();
                $address = $administrator->getAddress();
                $CIN = $administrator->getCIN();
                try {

                    $sql = "INSERT INTO Administrator (Username, Password, Email, PhoneNumber, Address, CIN) VALUES (:Username, :Password, :Email, :PhoneNumber, :Address, :CIN)";
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
            throw new Exception("Not an instance of Administrator");
        }
    }



    public function updateAdministrator($administrator) {
        if ($administrator instanceof Administrator) {
            try {
                $adminID = $administrator->getUserID();
                $username = $administrator->getName();
                if ($this->usernameExists($username)) {
                    throw new Exception("Username already exists. Please choose a different username.");
                }
                $email = $administrator->getEmail();
                $phoneNumber = $administrator->getPhoneNumber();
                $address = $administrator->getAddress();
                $cin = $administrator->getCIN();

                try {
                    $sql = "UPDATE Administrator  SET Username=:Username, Email=:Email, PhoneNumber=:PhoneNumber, Address=:Address WHERE AdminID=:AdminID";
                    $stmt = $this->_connection->prepare($sql);

                    $stmt->bindParam(":Username", $username, PDO::PARAM_STR);
                    $stmt->bindParam(":Email", $email, PDO::PARAM_STR);
                    $stmt->bindParam(":PhoneNumber", $phoneNumber, PDO::PARAM_STR);
                    $stmt->bindParam(":Address", $address, PDO::PARAM_STR);
                    $stmt->bindParam(":AdminID", $adminID, PDO::PARAM_INT);
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
            throw new Exception("Not an instance of Administrator");
        }
    }

    public function deleteAdministrator($administrator) {
        if ($administrator instanceof Administrator){
            try {
                $administratorID = $administrator->getUserID();
                try{
                    $sql = "DELETE FROM Administrator WHERE AdminID=:adminID";
                    $stmt = $this->_connection->prepare($sql);
                    $stmt->bindParam(":adminID", $administratorID, PDO::PARAM_INT);
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
            throw new Exception("Not an instance of Administrator");
        }
    }
}


//test
// Create a new Administrator
$admin = new Administrator(1, "AdminUser", "adminPass123", "admin@example.com", "123 Admin St", "123-456-7890", "ADMINCIN123");
$adminDAO = new AdministratorDAOImpl();

try {
    $adminDAO->createAdministrator($admin);
    echo "Administrator created successfully!\n";
} catch (Exception $e) {
    echo "Error creating administrator: " . $e->getMessage() . "\n";
}

// Update Administrator
$admin->setEmail("newadminemail@example.com");
try {
    $adminDAO->updateAdministrator($admin);
    echo "Administrator updated successfully!\n";
} catch (Exception $e) {
    echo "Error updating administrator: " . $e->getMessage() . "\n";
}


// Delete Administrator
try {
    $adminDAO->deleteAdministrator($admin);
    echo "Administrator deleted successfully!\n";
} catch (Exception $e) {
    echo "Error deleting administrator: " . $e->getMessage() . "\n";
}





?>