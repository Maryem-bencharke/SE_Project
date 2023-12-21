
<?php
require_once '../db.php';
require_once 'class1.php'; 

class Doctor extends User {
    private $db;
    public function __construct($userID, $name, $password, $email, $address, $phoneNumber, $CIN) {
        parent::__construct($userID, $name, $password, $email, $address, $phoneNumber, $CIN);

        $this->db = Db::getInstance()->getConnection();

    }

  
    // Additional methods specific to Doctor
    public function searchPatient() {
        
    }

    public function updatePatient() {
    }
}
?>