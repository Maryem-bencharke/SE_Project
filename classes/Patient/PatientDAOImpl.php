<?php
require_once '../../db/AbstractDAO.php';
require_once 'PatientDAO.php';
require_once 'Patient.php';
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
                    $sql = "INSERT INTO patient (CIN , BirthDate, FirstName, LastName,Gender, Email, PhoneNumber, BloodGroup, Address, Allergies, InsuranceInfo, emergencyContactName, emergencyContactPhone, emergencyContactEmail , emergencyContactAddress, emergencyContactRelation, emergencyContactBloodGroup, emergencyContactCIN)VALUES (:CIN, :BirthDate, :FirstName, :LastName, :Gender, :Email, :PhoneNumber, :BloodGroup, :Address, :Allergies, :InsuranceInfo, :EmergencyContactName,:EmergencyContactPhone, :EmergencyContactEmail,:EmergencyContactAddress,:EmergencyContactRelation, :EmergencyContactBloodGroup, :EmergencyContactCIN )";
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


    /*public function getPatient($patientFirstName, $patientLastName){
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
    }*/
    public function getPatient($patientFirstName, $patientLastName){
        try{
            $sql = "SELECT * FROM patient WHERE FirstName=:PatientFirstName AND LastName=:PatientLastName";
            $stmt = $this->_connection->prepare($sql);
            $stmt->bindParam(":PatientFirstName", $patientFirstName, PDO::PARAM_STR);
            $stmt->bindParam(":PatientLastName", $patientLastName, PDO::PARAM_STR);
            $stmt->execute();
    
            $patients = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $patients[] = new Patient($row['PatientID'], $row['FirstName'], $row['LastName'], $row['BirthDate'], $row['Gender'], $row['BloodGroup'], $row['PhoneNumber'], $row['Address'], $row['Allergies'], $row['Email'], $row['CIN'], $row['InsuranceInfo'], $row['emergencyContactName'], $row['emergencyContactPhone'], $row['emergencyContactAddress'], $row['emergencyContactEmail'], $row['emergencyContactRelation'], $row['emergencyContactBloodGroup'], $row['emergencyContactCIN']);
            }
            return $patients;
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
    public function getPatientById($patientID) {
        try {
            $sql = "SELECT * FROM patient WHERE PatientID = :PatientID";
            $stmt = $this->_connection->prepare($sql);
            $stmt->bindParam(":PatientID", $patientID, PDO::PARAM_INT);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                $patient = new Patient(
                    $row['PatientID'],
                    $row['FirstName'],
                    $row['LastName'],
                    $row['BirthDate'],
                    $row['Gender'],
                    $row['BloodGroup'],
                    $row['PhoneNumber'],
                    $row['Address'],
                    $row['Allergies'],
                    $row['Email'],
                    $row['CIN'],
                    $row['InsuranceInfo'],
                    $row['emergencyContactName'],
                    $row['emergencyContactPhone'],
                    $row['emergencyContactEmail'],
                    $row['emergencyContactAddress'],
                    $row['emergencyContactRelation'],
                    $row['emergencyContactBloodGroup'],
                    $row['emergencyContactCIN']
                    // Add any other fields that your Patient class requires
                );
                return $patient;
            }
            return null;
        } catch (PDOException $e) {
            // Handle exception
            echo $e->getMessage();
            return null;
        }
    }
}
?>