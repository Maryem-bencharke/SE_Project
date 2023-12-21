<?php
abstract class User {
    protected $userID;
    protected $name;
    protected $password;
    protected $email;
    protected $address;
    protected $phoneNumber;
    protected $CIN;

    public function __construct($userID, $name, $password, $email, $address, $phoneNumber, $CIN) {
        $this->userID = $userID;
        $this->name = $name;
        $this->password = $password;
        $this->email = $email;
        $this->address = $address;
        $this->phoneNumber = $phoneNumber;
        $this->CIN = $CIN;
    }

    // Getters
    public function getUserID() {
        return $this->userID;
    }

    public function getName() {
        return $this->name;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getPhoneNumber() {
        return $this->phoneNumber;
    }

    public function getCIN() {
        return $this->CIN;
    }

    // Setters
    public function setUserID($userID) {
        $this->userID = $userID;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function setPhoneNumber($phoneNumber) {
        $this->phoneNumber = $phoneNumber;
    }

    public function setCIN($CIN) {
        $this->CIN = $CIN;
    }
}
?>
