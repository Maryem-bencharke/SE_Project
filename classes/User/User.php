<?php
require_once '../../db/AbstractDAO.php';

class User {
    private $_userID;
    private $_name;
    private $_password;
    private $_email;
    private $_address;
    private $_phoneNumber;
    private $_CIN;

    public function __construct($userID, $name, $password, $email, $address, $phoneNumber, $CIN) {
        $this->_userID = $userID;
        $this->_name = $name;
        $this->_password = $password;
        $this->_email = $email;
        $this->_address = $address;
        $this->_phoneNumber = $phoneNumber;
        $this->_CIN = $CIN;
    }

    // Getters
    public function getUserID() {
        return $this->_userID;
    }

    public function getName() {
        return $this->_name;
    }

    public function getPassword() {
        return $this->_password;
    }

    public function getEmail() {
        return $this->_email;
    }

    public function getAddress() {
        return $this->_address;
    }

    public function getPhoneNumber() {
        return $this->_phoneNumber;
    }

    public function getCIN() {
        return $this->_CIN;
    }

    // Setters
    public function setUserID($userID) {
        $this->_userID = $userID;
    }

    public function setName($name) {
        $this->_name = $name;
    }

    public function setPassword($password) {
        $this->_password = $password;
    }

    public function setEmail($email) {
        $this->_email = $email;
    }

    public function setAddress($address) {
        $this->_address = $address;
    }

    public function setPhoneNumber($phoneNumber) {
        $this->_phoneNumber = $phoneNumber;
    }

    public function setCIN($CIN) {
        $this->_CIN = $CIN;
    }
}
?>
