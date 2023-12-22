<?php
/*
require_once 'DoctorDAO.php';
require_once '../db/db.php';

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

    public function findDoctor($cin) {
        $sql = "SELECT * FROM Doctor WHERE CIN = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$cin]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateDoctor($doctor, $cin) {
        $sql = "UPDATE Doctor SET Username = ?, Email = ?, PhoneNumber = ?, Address = ? WHERE CIN = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $doctor['Username'],
            $doctor['Email'],
            $doctor['PhoneNumber'],
            $doctor['Address'],
            $cin
        ]);
    }
    
    public function deleteDoctor($cin) {
        $sql = "DELETE FROM Doctor WHERE CIN = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$cin]);
    }
}
