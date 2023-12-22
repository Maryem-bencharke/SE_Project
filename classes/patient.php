<?php
require 'db/db.php';
require 'enum.php';
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
        $this->gender = $gender;
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
interface PatientDAO{
    public function addPatient($patient);
    public function updatePatient($patient);
    public function deletePatient($patient);
    public function getPatient($patientFirstName, $patientLastName);
    public function getAllPatients();
    public function getPatientByName($name);
}

class PatientDAOImpl extends AbstractDAO implements PatientDAO{
    public function addPatient($patient){
        if($patient instanceof Patient ){
            try{
                $firstName = $patient->getFirstName();
                $lastName = $patient->getLastName();
                $birthDate = $patient->getBirthDate();
                $gender = $patient->getGender();
                $bloodGroup = $patient->getBloodGroup();
                $phoneNumber =  $patient->getPhoneNumber();
                $address =  $patient->getAddress();
                $allergies =   $patient->getAllergies();
                $CIN = $patient->getCIN();
                $email = $patient->getEmail();
                $InsuranceInfo = $patient->getInsuranceInfo();
                $emergencyContactName = $patient->getEmergencyContactName();
                $emergencyContactPhone =  $patient->getEmergencyContactPhone();
                $emergencyContactAddress = $patient->getEmergencyContactAddress();
                $emergencyContactEmail = $patient->getEmergencyContactEmail();
                $emergencyContactRelation = $patient->getEmergencyContactRelation();
                $emergencyContactBloodGroup = $patient->getEmergencyContactBloodGroup();
                $emergencyContactCIN = $patient->getEmergencyContactCIN();
                try{
                    // $sql ="INSERT INTO patient SET CIN=:CIN, BirthDate=:BirthDate, FirstName=:FirstName, LastName=:LastName,Gender=:Gender, Email=:Email, PhoneNumber=:PhoneNumber, BloodGroup=:BloodGroup, Address=:Address, Allergies=:Allergies,InsuranceInfo=:InsuranceInfo,  emergencyContactName=:EmergencyContactName, emergencyContactPhone=:EmergencyContactPhone, emergencyContactEmail=:EmergencyContactEmail, emergencyContactAddress=:EmergencyContactAddress, emergencyContactRelation=:EmergencyContactRelation, emergencyContactBloodGroup=:EmergencyContactBloodGroup , emergencyContactCIN=:EmergencyContactCIN, WHERE PatientID=:PatientID";
                    $sql = "INSERT INTO patient (CIN , BirthDate, FirstName, LastName,Gender, Email, PhoneNumber, BloodGroup, Address, Allergies, InsuranceInfo, emergencyContactName, emergencyContactPhone, emergencyContactEmail , emergencyContactAddress, emergencyContactRelation, emergencyContactBloodGroup, emergencyContactCIN)VALUES (:CIN, :BirthDate, :FirstName, :LastName, :Gender, :Email, :PhoneNumber, :BloodGroup, :Address, :Allergies, :InsuranceInfo, :EmergencyContactName,:EmergencyContactPhone, :EmergencyContactEmail,:EmergencyContactAddress,:EmergencyContactRelation, :EmergencyContactBloodGroup, :EmergencyContactCIN )";
                    $stmt = $this->_connection->prepare($sql);
                    //$stmt = Db::getInstance();
                    //$stmt = $stmt->getConnection();
                    //$stmt = $stmt->prepare($sql);
                    $stmt->bindParam(":CIN", $CIN, PDO::PARAM_STR);
                    $stmt->bindParam(":BirthDate", $birthDate, PDO::PARAM_STR);
                    $stmt->bindParam(":FirstName", $firstName, PDO::PARAM_STR);
                    $stmt->bindParam(":LastName", $lastName, PDO::PARAM_STR);
                    $stmt->bindParam(":Gender",$gender,PDO::PARAM_STR);
                    $stmt->bindParam(":Email", $email, PDO::PARAM_STR);
                    $stmt->bindParam(":PhoneNumber", $phoneNumber, PDO::PARAM_STR);
                    $stmt->bindParam(":BloodGroup", $bloodGroup, PDO::PARAM_STR);
                    $stmt->bindParam(":Address", $address, PDO::PARAM_STR);
                    $stmt->bindParam(":Allergies", $allergies, PDO::PARAM_STR);
                    $stmt->bindParam(":InsuranceInfo", $InsuranceInfo, PDO::PARAM_STR);
                    $stmt->bindParam(":EmergencyContactName", $emergencyContactName, PDO::PARAM_STR);
                    $stmt->bindParam(":EmergencyContactPhone", $emergencyContactPhone, PDO::PARAM_STR);
                    $stmt->bindParam(":EmergencyContactEmail", $emergencyContactEmail, PDO::PARAM_STR);
                    $stmt->bindParam(":EmergencyContactAddress", $emergencyContactAddress, PDO::PARAM_STR);
                    $stmt->bindParam(":EmergencyContactRelation", $emergencyContactRelation, PDO::PARAM_STR);
                    $stmt->bindParam(":EmergencyContactBloodGroup", $emergencyContactBloodGroup, PDO::PARAM_STR);
                    $stmt->bindParam(":EmergencyContactCIN", $emergencyContactCIN, PDO::PARAM_STR);
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
        if ($patient instanceof Patient){
            try{
                $patientID = $patient->getPatientID();
                $firstName = $patient->getFirstName();
                $lastName = $patient->getLastName();
                $birthDate = $patient->getBirthDate();
                $gender = $patient->getGender();
                $bloodGroup = $patient->getBloodGroup();
                $phoneNumber =  $patient->getPhoneNumber();
                $address =  $patient->getAddress();
                $allergies =   $patient->getAllergies();
                $CIN = $patient->getCIN();
                $email = $patient->getEmail();
                $InsuranceInfo = $patient->getInsuranceInfo();
                $emergencyContactName = $patient->getEmergencyContactName();
                $emergencyContactPhone =  $patient->getEmergencyContactPhone();
                $emergencyContactAddress = $patient->getEmergencyContactAddress();
                $emergencyContactEmail = $patient->getEmergencyContactEmail();
                $emergencyContactRelation = $patient->getEmergencyContactRelation();
                $emergencyContactBloodGroup = $patient->getEmergencyContactBloodGroup();
                $emergencyContactCIN = $patient->getEmergencyContactCIN();
                try{
                    // $sql = "UPDATE patient SET CIN=:CIN, BirthDate=:BirthDate, FirstName=:FirstName, LastName=:LastName, Email=:Email, PhoneNumber=:Phone, BloodGroup=:BloodGroup, Address=:Address, Allergies=:Allergies, emergencyContactName=:EmergencyContactName, emergencyContactPhone=:EmergencyContactPhone, emergencyContactEmail=:EmergencyContactEmail, emergencyContactAddress=:EmergencyContactAddress, emergencyContactRelation=:EmergencyContactRelation, emergencyContactBloodGroup=:EmergencyContactBloodGroup WHERE PatientID=:PatientID";
                    $sql ="UPDATE patient SET CIN=:CIN, BirthDate=:BirthDate, FirstName=:FirstName, LastName=:LastName,Gender=:Gender, Email=:Email, PhoneNumber=:PhoneNumber, BloodGroup=:BloodGroup, Address=:Address, Allergies=:Allergies,InsuranceInfo=:InsuranceInfo,  emergencyContactName=:EmergencyContactName, emergencyContactPhone=:EmergencyContactPhone, emergencyContactEmail=:EmergencyContactEmail, emergencyContactAddress=:EmergencyContactAddress, emergencyContactRelation=:EmergencyContactRelation, emergencyContactBloodGroup=:EmergencyContactBloodGroup , emergencyContactCIN=:EmergencyContactCIN, WHERE PatientID=:PatientID";
                    $stmt = $this->_connection->prepare($sql);
                    $stmt->bindParam(":CIN", $CIN, PDO::PARAM_STR);
                    $stmt->bindParam(":BirthDate", $birthDate, PDO::PARAM_STR);
                    $stmt->bindParam(":FirstName", $firstName, PDO::PARAM_STR);
                    $stmt->bindParam(":LastName", $lastName, PDO::PARAM_STR);
                    $stmt->bindParam(":Gender",$gender,PDO::PARAM_STR);
                    $stmt->bindParam(":Email", $email, PDO::PARAM_STR);
                    $stmt->bindParam(":PhoneNumber", $phoneNumber, PDO::PARAM_STR);
                    $stmt->bindParam(":BloodGroup", $bloodGroup, PDO::PARAM_STR);
                    $stmt->bindParam(":Address", $address, PDO::PARAM_STR);
                    $stmt->bindParam(":Allergies", $allergies, PDO::PARAM_STR);
                    $stmt->bindParam(":InsuranceInfo", $InsuranceInfo, PDO::PARAM_STR);
                    $stmt->bindParam(":EmergencyContactName", $emergencyContactName, PDO::PARAM_STR);
                    $stmt->bindParam(":EmergencyContactPhone", $emergencyContactPhone, PDO::PARAM_STR);
                    $stmt->bindParam(":EmergencyContactEmail", $emergencyContactEmail, PDO::PARAM_STR);
                    $stmt->bindParam(":EmergencyContactAddress", $emergencyContactAddress, PDO::PARAM_STR);
                    $stmt->bindParam(":EmergencyContactRelation", $emergencyContactRelation, PDO::PARAM_STR);
                    $stmt->bindParam(":EmergencyContactBloodGroup", $emergencyContactBloodGroup, PDO::PARAM_STR);
                    $stmt->bindParam(":EmergencyContactCIN", $emergencyContactCIN, PDO::PARAM_STR);
                    $stmt->bindParam(":PatientID", $patientID, PDO::PARAM_INT);
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

    public function deletePatient($patient){
        if ($patient instanceof Patient){
            try{
                $patientID = $patient->getPatientID();
                try{
                    $sql = "DELETE FROM patient WHERE PatientID=:PatientID";
                    $stmt = $this->_connection->prepare($sql);
                    $stmt->bindParam(":PatientID", $patientID, PDO::PARAM_INT);
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

    public function getPatient($patientFirstName, $patientLastName){
        try{
            $sql = "SELECT * FROM patient WHERE FirstName=:PatientFirstName AND LastName=:PatientLastName";
            $stmt = $this->_connection->prepare($sql);
            $stmt->bindParam(":PatientFirstName", $patientFirstName, PDO::PARAM_INT);  
            $stmt->bindParam(":PatientLastName", $patientLastName, PDO::PARAM_INT);
            $stmt->execute();
            $patient = $stmt->fetch(PDO::FETCH_ASSOC);
            $patient = new Patient($patient['PatientID'], $patient['FirstName'], $patient['LastName'],$patient['BirthDate'],$patient['Gender'], $patient['BloodGroup'], $patient['PhoneNumber'], $patient['Address'], $patient['Allergies'], $patient['Email'],  $patient['CIN'],  $patient['InsuranceInfo'], $patient['emergencyContactName'], $patient['emergencyContactPhone'], $patient['emergencyContactAddress'], $patient['emergencyContactEmail'], $patient['emergencyContactRelation'], $patient['emergencyContactBloodGroup'], $patient['emergencyContactCIN']);            
            return $patient;
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }


    public function getAllPatients(){
        try{
            $sql = "SELECT * FROM patient";
            $stmt = $this->_connection->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $patients = array();
            foreach($result as $patient){
                $patients[] = new Patient($patient['PatientID'], $patient['FirstName'], $patient['LastName'],$patient['BirthDate'],$patient['Gender'], $patient['BloodGroup'], $patient['PhoneNumber'], $patient['Address'], $patient['Allergies'], $patient['Email'],  $patient['CIN'],  $patient['InsuranceInfo'], $patient['emergencyContactName'], $patient['emergencyContactPhone'], $patient['emergencyContactAddress'], $patient['emergencyContactEmail'], $patient['emergencyContactRelation'], $patient['emergencyContactBloodGroup'], $patient['emergencyContactCIN']);            }
            return $patients;
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    public function getPatientByName($name){
        try{
            $sql = "SELECT * FROM patient WHERE FirstName=:FirstName OR LastName=:LastName";
            $stmt = $this->_connection->prepare($sql);
            $stmt->bindParam(":FirstName", $name, PDO::PARAM_INT);  
            $stmt->bindParam(":LastName", $name, PDO::PARAM_INT);
            $stmt->execute();
            $patient = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $patient = $stmt->fetch(PDO::FETCH_ASSOC);
            $patient = new Patient($patient['PatientID'], $patient['FirstName'], $patient['LastName'],$patient['BirthDate'],$patient['Gender'], $patient['BloodGroup'], $patient['PhoneNumber'], $patient['Address'], $patient['Allergies'], $patient['Email'],  $patient['CIN'],  $patient['InsuranceInfo'], $patient['emergencyContactName'], $patient['emergencyContactPhone'], $patient['emergencyContactAddress'], $patient['emergencyContactEmail'], $patient['emergencyContactRelation'], $patient['emergencyContactBloodGroup'], $patient['emergencyContactCIN']);            
            return $patient;
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}
//test
// $patient = new Patient(11, "12345678", "1999-01-01", "Mohamed", "Ben Ali", "mohamed@gmail.com", "12345678", 'A_Plus', "Maroc", "12345678", "12345678", "none", "Mohamed", "12345678", "mohamed@gmail.com", "Maroc", "Father", 'A_Plus');
// $patientDAO = new PatientDAOImpl();
// $patientDAO->addPatient($patient);
// // test update
// $patient = new Patient(12, "1234564478", "1999-01-01", "Mohamed", "fzefzefz Ali", "mohamed@gmail.com", "12345678", 'A_Plus', "Maroc", "12345678", "12345678", "none", "Mohamed", "12345678", "mohamed@gmail.com", "Maroc", "Father", 'A_Plus');
// $patientDAO = new PatientDAOImpl();
// $patientDAO->updatePatient($patient);
// test delete
$patient = new Patient(
    12,
    "Alice",
    "Smith",
    "1990-05-15",
    "Female",
    "AB+",
    "555-1234",
    "789 Meknes, Maroc",  // Properly escaped address
    "none",
    "alice.smith@gmail.com",
    "ABC456",
    "wafa Insurance",
    "test Johnson",
    "555-5678",
    "123 Elm St, Townsville",
    "bob.johnson@example.com",
    "Spouse",
    "A+",
    "XYZ123"
);
$patientDAO = new PatientDAOImpl();
$patientDAO->addPatient($patient);
echo "\nadded \n";
//$patientDAO->deletePatient($patient);
// test getPatient
$patientDAO = new PatientDAOImpl();
$patient = $patientDAO->getPatient("Mohamed", "Ben Ali");
echo $patient->getFirstName();
// test getAllPatients
$patientDAO = new PatientDAOImpl();
$patients = $patientDAO->getAllPatients();
foreach($patients as $patient){
   echo $patient->getFirstName();
   echo "\n";
}

?>  