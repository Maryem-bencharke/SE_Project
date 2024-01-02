<?php
class Patient{
    private $_patientID;
    private $_firstName;
    private $_lastName;
    private $_birthDate;
    private $_gender;
    private $_bloodGroup;
    private $_phoneNumber;
    private $_address;
    private $_allergies;
    private $_email;
    private $_CIN;
    private $_InsuranceInfo;
    private $_emergencyContactName;
    private $_emergencyContactPhone;
    private $_emergencyContactAddress;
    private $_emergencyContactEmail;
    private $_emergencyContactRelation;
    private $_emergencyContactBloodGroup;
    private $_emergencyContactCIN;
    //getters
    public function getPatientID(){
        return $this->_patientID;
    }
    public function getFirstName(){
        return $this->_firstName;
    }
    public function getLastName(){
        return $this->_lastName;
    }
    public function getBirthDate(){
        return $this->_birthDate;
    }
    public function getGender(){
        return $this->_gender;
    }
    public function getBloodGroup(){
        return $this->_bloodGroup;
    }
    public function getPhoneNumber(){
        return $this->_phoneNumber;
    }
    public function getAddress(){
        return $this->_address;
    }
    public function getAllergies(){
        return $this->_allergies;
    }
    public function getCIN(){
        return $this->_CIN;
    }
    public function getEmail(){
        return $this->_email;
    }
    public function getInsuranceInfo(){
        return $this->_InsuranceInfo;
    }
    public function getEmergencyContactName(){
        return $this->_emergencyContactName;
    }
    public function getEmergencyContactPhone(){
        return $this->_emergencyContactPhone;
    }
    public function getEmergencyContactAddress(){
        return $this->_emergencyContactAddress;
    }
    public function getEmergencyContactEmail(){
        return $this->_emergencyContactEmail;
    }
    public function getEmergencyContactRelation(){
        return $this->_emergencyContactRelation;
    }
    public function getEmergencyContactBloodGroup(){
        return $this->_emergencyContactBloodGroup;
    }
    public function getEmergencyContactCIN(){
        return $this->_emergencyContactCIN;
    }
    //setters
    public function setPatientID($patientID){
        $this->_patientID = $patientID;
    }
    public function setFirstName($firstName){
        $this->_firstName = $firstName;
    }
    public function setLastName($lastName){
        $this->_lastName = $lastName;
    }
    public function setBirthDate($birthDate){
        $this->_birthDate = $birthDate;
    }
    public function setGender($gender){
        $this->_gender = $gender;
    }
    public function setBloodGroup($bloodGroup){
        $this->_bloodGroup = $bloodGroup;
    }
    public function setPhoneNumber($phoneNumber){
        $this->_phoneNumber = $phoneNumber;
    }
    public function setAddress($address){
        $this->_address = $address;
    }
    public function setAllergies($allergies){
        $this->_allergies = $allergies;
    }
    public function setCIN($CIN){
        $this->_CIN = $CIN;
    }
    public function setEmail($email){
        $this->_email = $email;
    }
    public function setInsuranceInfo($InsuranceInfo){
        $this->_InsuranceInfo = $InsuranceInfo;
    }
    public function setEmergencyContactName($emergencyContactName){
        $this->_emergencyContactName = $emergencyContactName;
    }
    public function setEmergencyContactPhone($emergencyContactPhone){
        $this->_emergencyContactPhone = $emergencyContactPhone;
    }
    public function setEmergencyContactEmail($emergencyContactEmail){
        $this->_emergencyContactEmail = $emergencyContactEmail;
    }
    public function setEmergencyContactAddress($emergencyContactAddress){
        $this->_emergencyContactAddress = $emergencyContactAddress;
    }
    public function setEmergencyContactRelation($emergencyContactRelation){
        $this->_emergencyContactRelation = $emergencyContactRelation;
    }
    public function setEmergencyContactBloodGroup($emergencyContactBloodGroup){
        $this->_emergencyContactBloodGroup = $emergencyContactBloodGroup;
    }
    public function setEmergencyContactCIN($emergencyContactCIN){
        $this->_emergencyContactCIN = $emergencyContactCIN;
    }
    //constructor
    // public function __construct($patientID, $CIN, $birthDate, $firstName, $lastName, $email, $bloodGroup, $address, $phoneNumber, $emergencyContact, $allergies, $emergencyContactName, $emergencyContactPhone, $emergencyContactEmail, $emergencyContactAddress, $emergencyContactRelation, $emergencyContactBloodGroup){
    public function __construct($patientID, $firstName, $lastName, $birthDate,$gender,$bloodGroup, $phoneNumber, $address, $allergies, $email, $CIN, $InsuranceInfo, $emergencyContactName, $emergencyContactPhone, $emergencyContactAddress, $emergencyContactEmail, $emergencyContactRelation, $emergencyContactBloodGroup, $emergencyContactCIN){
        $this->_patientID = $patientID;
        $this->_CIN = $CIN;
        $this->_birthDate = $birthDate;
        $this->_firstName = $firstName;
        $this->_lastName = $lastName;
        $this->_email = $email;
        $this->_gender = $gender;
        $this->_bloodGroup = $bloodGroup;
        $this->_address = $address;
        $this->_phoneNumber = $phoneNumber;
        $this->_InsuranceInfo = $InsuranceInfo;
        $this->_allergies = $allergies;
        $this->_emergencyContactName = $emergencyContactName;
        $this->_emergencyContactPhone = $emergencyContactPhone;
        $this->_emergencyContactEmail = $emergencyContactEmail;
        $this->_emergencyContactAddress = $emergencyContactAddress;
        $this->_emergencyContactRelation = $emergencyContactRelation;
        $this->_emergencyContactBloodGroup = $emergencyContactBloodGroup;
        $this->_emergencyContactCIN = $emergencyContactCIN;
    }
    
}

?>  