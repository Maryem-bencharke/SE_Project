<?php
require_once 'DoctorDAO.php';
require_once '../db.php'; // Adjust the path as necessary

class DoctorDAOImpl implements DoctorDAO {
    private $db;

    public function __construct() {
        $this->db = Db::getInstance()->getConnection();
    }

    public function createDoctor($doctor) {
        
        $sql = "INSERT INTO Doctor (Username, Password, Email, PhoneNumber, Address, CIN) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $doctor['Username'],
            $doctor['Password'],
            $doctor['Email'],
            $doctor['PhoneNumber'],
            $doctor['Address'],
            $doctor['CIN']
        ]);
    }

    public function findDoctor($doctorID) {
        $sql = "SELECT * FROM Doctor WHERE DoctorID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$doctorID]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateDoctor($doctor) {
        $sql = "UPDATE Doctor SET Username = ?, Password = ?, Email = ?, PhoneNumber = ?, Address = ?, CIN = ? WHERE DoctorID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $doctor['Username'],
            $doctor['Password'],
            $doctor['Email'],
            $doctor['PhoneNumber'],
            $doctor['Address'],
            $doctor['CIN'],
            $doctor['DoctorID']
        ]);
    }

    public function deleteDoctor($doctorID) {
        $sql = "DELETE FROM Doctor WHERE DoctorID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$doctorID]);
    }
}
?>