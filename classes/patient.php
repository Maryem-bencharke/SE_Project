<?php
require '../db/db.php';
require '../enum.php';
class Patient{
    private $_patientID;
    private $_CIN;
    private $_birthDate;
    private $_firstName;
    private $_lastName;
    private $_email;
    private $_phone;
    private $_bloodGroup;
    private $_address;
    private $_phoneNumber;
    private $_emergencyContact;
    private $_allergies;
    private $_emergencyContactName;
    private $_emergencyContactPhone;
    private $_emergencyContactEmail;
    private $_emergencyContactAddress;
    private $_emergencyContactRelation;
    private $_emergencyContactBloodGroup;
    //getters
    public function getPatientID(){
        return $this->_patientID;
    }
    public function getCIN(){
        return $this->_CIN;
    }
    public function getBirthDate(){
        return $this->_birthDate;
    }
    public function getFirstName(){
        return $this->_firstName;
    }
    public function getLastName(){
        return $this->_lastName;
    }
    public function getEmail(){
        return $this->_email;
    }
    public function getPhone(){
        return $this->_phone;
    }
    public function getBloodGroup(){
        return $this->_bloodGroup;
    }
    public function getAddress(){
        return $this->_address;
    }
    public function getPhoneNumber(){
        return $this->_phoneNumber;
    }
    public function getEmergencyContact(){
        return $this->_emergencyContact;
    }
    public function getAllergies(){
        return $this->_allergies;
    }
    public function getEmergencyContactName(){
        return $this->_emergencyContactName;
    }
    public function getEmergencyContactPhone(){
        return $this->_emergencyContactPhone;
    }
    public function getEmergencyContactEmail(){
        return $this->_emergencyContactEmail;
    }
    public function getEmergencyContactAddress(){
        return $this->_emergencyContactAddress;
    }
    public function getEmergencyContactRelation(){
        return $this->_emergencyContactRelation;
    }
    public function getEmergencyContactBloodGroup(){
        return $this->_emergencyContactBloodGroup;
    }
    //setters
    public function setPatientID($patientID){
        $this->_patientID = $patientID;
    }
    public function setCIN($CIN){
        $this->_CIN = $CIN;
    }
    public function setBirthDate($birthDate){
        $this->_birthDate = $birthDate;
    }
    public function setFirstName($firstName){
        $this->_firstName = $firstName;
    }
    public function setLastName($lastName){
        $this->_lastName = $lastName;
    }
    public function setEmail($email){
        $this->_email = $email;
    }
    public function setPhone($phone){
        $this->_phone = $phone;
    }
    public function setBloodGroup($bloodGroup){
        $this->_bloodGroup = $bloodGroup;
    }
    public function setAddress($address){
        $this->_address = $address;
    }
    public function setPhoneNumber($phoneNumber){
        $this->_phoneNumber = $phoneNumber;
    }
    public function setEmergencyContact($emergencyContact){
        $this->_emergencyContact = $emergencyContact;
    }
    public function setAllergies($allergies){
        $this->_allergies = $allergies;
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
    //constructor
    public function __construct($patientID, $CIN, $birthDate, $firstName, $lastName, $email, $phone, $bloodGroup, $address, $phoneNumber, $emergencyContact, $allergies, $emergencyContactName, $emergencyContactPhone, $emergencyContactEmail, $emergencyContactAddress, $emergencyContactRelation, $emergencyContactBloodGroup){
        $this->_patientID = $patientID;
        $this->_CIN = $CIN;
        $this->_birthDate = $birthDate;
        $this->_firstName = $firstName;
        $this->_lastName = $lastName;
        $this->_email = $email;
        $this->_phone = $phone;
        $this->_bloodGroup = $bloodGroup;
        $this->_address = $address;
        $this->_phoneNumber = $phoneNumber;
        $this->_emergencyContact = $emergencyContact;
        $this->_allergies = $allergies;
        $this->_emergencyContactName = $emergencyContactName;
        $this->_emergencyContactPhone = $emergencyContactPhone;
        $this->_emergencyContactEmail = $emergencyContactEmail;
        $this->_emergencyContactAddress = $emergencyContactAddress;
        $this->_emergencyContactRelation = $emergencyContactRelation;
        $this->_emergencyContactBloodGroup = $emergencyContactBloodGroup;
    }

}
 
interface PatientDAO{
    public function addPatient($patient);
    public function updatePatient($patient);
    public function deletePatient($patient);
    public function getPatient($patientID);
    public function getPatients();
}

class PatientDAOImpl extends AbstractDAO implements PatientDAO{
    public function addPatient($patient){
        if($patient instanceof Patient ){
            try{
                $CIN = $patient->getCIN();
                $birthDate = $patient->getBirthDate();
                $firstName = $patient->getFirstName();
                $lastName = $patient->getLastName();
                $email = $patient->getEmail();
                $phone = $patient->getPhone();
                $bloodGroup = $patient->getBloodGroup();
                $address =  $patient->getAddress();
                $phoneNumber =  $patient->getPhoneNumber();
                $emergencyContact = $patient->getEmergencyContact();
                $allergies =   $patient->getAllergies();
                $emergencyContactName = $patient->getEmergencyContactName();
                $emergencyContactPhone =  $patient->getEmergencyContactPhone();
                $emergencyContactEmail = $patient->getEmergencyContactEmail();
                $emergencyContactAddress = $patient->getEmergencyContactAddress();
                $emergencyContactRelation = $patient->getEmergencyContactRelation();
                $emergencyContactBloodGroup = $patient->getEmergencyContactBloodGroup();
                try{
                $sql = "INSERT INTO patient (CIN, BirthDate, FirstName, LastName, Email, PhoneNumber, BloodGroup, Address, Allergies, EmergencyContactName, EmergencyContactPhone, EmergencyContactEmail, EmergencyContactAddress, EmergencyContactRelation, EmergencyContactBloodGroup) VALUES (:CIN, :BirthDate, :FirstName, :LastName, :Email, :Phone, :BloodGroup, :Address, :Allergies, :EmergencyContactName, :EmergencyContactPhone, :EmergencyContactEmail, :EmergencyContactAddress, :EmergencyContactRelation, :EmergencyContactBloodGroup)";
                $stmt = $this->_connection->prepare($sql);
                //$stmt = Db::getInstance();
                //$stmt = $stmt->getConnection();
                //$stmt = $stmt->prepare($sql);
                $stmt->bindParam(":CIN", $CIN, PDO::PARAM_STR);
                $stmt->bindParam(":BirthDate", $birthDate, PDO::PARAM_STR);
                $stmt->bindParam(":FirstName", $firstName, PDO::PARAM_STR);
                $stmt->bindParam(":LastName", $lastName, PDO::PARAM_STR);
                $stmt->bindParam(":Email", $email, PDO::PARAM_STR);
                $stmt->bindParam(":Phone", $phone, PDO::PARAM_STR);
                $stmt->bindParam(":BloodGroup", $bloodGroup, PDO::PARAM_STR);
                $stmt->bindParam(":Address", $address, PDO::PARAM_STR);
                $stmt->bindParam(":Allergies", $allergies, PDO::PARAM_STR);
                $stmt->bindParam(":EmergencyContactName", $emergencyContactName, PDO::PARAM_STR);
                $stmt->bindParam(":EmergencyContactPhone", $emergencyContactPhone, PDO::PARAM_STR);
                $stmt->bindParam(":EmergencyContactEmail", $emergencyContactEmail, PDO::PARAM_STR);
                $stmt->bindParam(":EmergencyContactAddress", $emergencyContactAddress, PDO::PARAM_STR);
                $stmt->bindParam(":EmergencyContactRelation", $emergencyContactRelation, PDO::PARAM_STR);
                $stmt->bindParam(":EmergencyContactBloodGroup", $emergencyContactBloodGroup, PDO::PARAM_STR);
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
            throw new Exception("Not an instance of Patient");
        }
    }
    
    public function updatePatient($patient){
    }
    
    public function deletePatient($patient){
        // implementation goes here
    }
    
    public function getPatient($patientID){
        // implementation goes here
    }
    
    public function getPatients(){
        // implementation goes here
    }
}
//test 
$patient = new Patient(1, "12345678", "1999-01-01", "Mohamed", "Ben Ali", "mohamed@gmail", "12345678", 'A_Plus', "Tunis", "12345678", "12345678", "none", "Mohamed", "12345678", "mohamed@gmail", "Tunis", "Father", 'A_Plus');
$patientDAO = new PatientDAOImpl();
$patientDAO->addPatient($patient);

?>  