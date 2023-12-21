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

// class AppointmentDAO {
//     private static $instance = null;
//     private $dbConnection; // Database connection object

//     // Private constructor for Singleton
//     private function __construct() {
//         // Initialize the database connection here
//         $this->dbConnection = new PDO('mysql:host=your_host;dbname=your_db', 'username', 'password');
//     }

//     // Singleton getInstance method
//     public static function getInstance() {
//         if (self::$instance == null) {
//             self::$instance = new AppointmentDAO();
//         }
//         return self::$instance;
//     }

//     // Create an appointment
//     public function createAppointment($appointmentDetails) {
//         $sql = "INSERT INTO appointments (column1, column2, ...) VALUES (:value1, :value2, ...)";
//         $stmt = $this->dbConnection->prepare($sql);

//         // Bind parameters from $appointmentDetails
//         // Assuming $appointmentDetails is an associative array
//         foreach ($appointmentDetails as $key => $value) {
//             $stmt->bindValue(':'.$key, $value);
//         }

//         $stmt->execute();
//     }

//     // Read an appointment
//     public function readAppointment($appointmentId) {
//         $sql = "SELECT * FROM appointments WHERE id = :appointmentId";
//         $stmt = $this->dbConnection->prepare($sql);
//         $stmt->bindValue(':appointmentId', $appointmentId);
//         $stmt->execute();

//         return $stmt->fetch(PDO::FETCH_ASSOC);
//     }

//     // Update an appointment
//     public function updateAppointment($appointmentId, $newDetails) {
//         $sql = "UPDATE appointments SET column1 = :value1, column2 = :value2, ... WHERE id = :appointmentId";
//         $stmt = $this->dbConnection->prepare($sql);

//         // Bind parameters
//         foreach ($newDetails as $key => $value) {
//             $stmt->bindValue(':'.$key, $value);
//         }
//         $stmt->bindValue(':appointmentId', $appointmentId);

//         $stmt->execute();
//     }

//     // Delete an appointment
//     public function deleteAppointment($appointmentId) {
//         $sql = "DELETE FROM appointments WHERE id = :appointmentId";
//         $stmt = $this->dbConnection->prepare($sql);
//         $stmt->bindValue(':appointmentId', $appointmentId);

//         $stmt->execute();
//     }
// }


// class MedicalRecordDAO {
//     private static $instance = null;
//     private $dbConnection;

//     // Private constructor for Singleton
//     private function __construct() {
//         // Initialize the database connection
//         $this->dbConnection = new PDO('mysql:host=your_host;dbname=your_db', 'username', 'password');
//     }

//     // Singleton getInstance method
//     public static function getInstance() {
//         if (self::$instance == null) {
//             self::$instance = new MedicalRecordDAO();
//         }
//         return self::$instance;
//     }

//     // Create a medical record
//     public function createMedicalRecord($recordDetails) {
//         $sql = "INSERT INTO medical_records (column1, column2, ...) VALUES (:value1, :value2, ...)";
//         $stmt = $this->dbConnection->prepare($sql);

//         // Bind parameters
//         foreach ($recordDetails as $key => $value) {
//             $stmt->bindValue(':'.$key, $value);
//         }

//         $stmt->execute();
//     }

//     // Read a medical record
//     public function readMedicalRecord($recordId) {
//         $sql = "SELECT * FROM medical_records WHERE id = :recordId";
//         $stmt = $this->dbConnection->prepare($sql);
//         $stmt->bindValue(':recordId', $recordId);
//         $stmt->execute();

//         return $stmt->fetch(PDO::FETCH_ASSOC);
//     }

//     // Update a medical record
//     public function updateMedicalRecord($recordId, $newDetails) {
//         $sql = "UPDATE medical_records SET column1 = :value1, column2 = :value2, ... WHERE id = :recordId";
//         $stmt = $this->dbConnection->prepare($sql);

//         // Bind parameters
//         foreach ($newDetails as $key => $value) {
//             $stmt->bindValue(':'.$key, $value);
//         }
//         $stmt->bindValue(':recordId', $recordId);

//         $stmt->execute();
//     }

//     // Delete a medical record
//     public function deleteMedicalRecord($recordId) {
//         $sql = "DELETE FROM medical_records WHERE id = :recordId";
//         $stmt = $this->dbConnection->prepare($sql);
//         $stmt->bindValue(':recordId', $recordId);

//         $stmt->execute();
//     }
// }
class AppointmentDAO {
    private static $instance = null;
    private $appointments = []; // Array to store appointments

    // Private constructor for Singleton
    private function __construct() {
    }

    // Singleton getInstance method
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new AppointmentDAO();
        }
        return self::$instance;
    }

    // Create an appointment
    public function createAppointment($appointmentId, $appointmentDetails) {
        $this->appointments[$appointmentId] = $appointmentDetails;
        echo "Appointment created with ID: $appointmentId\n";
    }

    // Read an appointment
    public function readAppointment($appointmentId) {
        if (isset($this->appointments[$appointmentId])) {
            echo "Appointment details for ID $appointmentId: ";
            print_r($this->appointments[$appointmentId]);
            echo "\n";
        } else {
            echo "No appointment found with ID: $appointmentId\n";
        }
    }

    // Update an appointment
    public function updateAppointment($appointmentId, $newDetails) {
        if (isset($this->appointments[$appointmentId])) {
            $this->appointments[$appointmentId] = $newDetails;
            echo "Appointment updated with ID: $appointmentId\n";
        } else {
            echo "No appointment found with ID: $appointmentId\n";
        }
    }

    // Delete an appointment
    public function deleteAppointment($appointmentId) {
        if (isset($this->appointments[$appointmentId])) {
            unset($this->appointments[$appointmentId]);
            echo "Appointment deleted with ID: $appointmentId\n";
        } else {
            echo "No appointment found with ID: $appointmentId\n";
        }
    }
}

class MedicalRecordDAO {
    private static $instance = null;
    private $medicalRecords = []; // Array to store medical records

    // Private constructor for Singleton
    private function __construct() {
    }

    // Singleton getInstance method
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new MedicalRecordDAO();
        }
        return self::$instance;
    }

    // Create a medical record
    public function createMedicalRecord($recordId, $recordDetails) {
        $this->medicalRecords[$recordId] = $recordDetails;
        echo "Medical record created with ID: $recordId\n";
    }

    // Read a medical record
    public function readMedicalRecord($recordId) {
        if (isset($this->medicalRecords[$recordId])) {
            echo "Medical record details for ID $recordId: ";
            print_r($this->medicalRecords[$recordId]);
            echo "\n";
        } else {
            echo "No medical record found with ID: $recordId\n";
        }
    }

    // Update a medical record
    public function updateMedicalRecord($recordId, $newDetails) {
        if (isset($this->medicalRecords[$recordId])) {
            $this->medicalRecords[$recordId] = $newDetails;
            echo "Medical record updated with ID: $recordId\n";
        } else {
            echo "No medical record found with ID: $recordId\n";
        }
    }

    // Delete a medical record
    public function deleteMedicalRecord($recordId) {
        if (isset($this->medicalRecords[$recordId])) {
            unset($this->medicalRecords[$recordId]);
            echo "Medical record deleted with ID: $recordId\n";
        } else {
            echo "No medical record found with ID: $recordId\n";
        }
    }
}

?>
