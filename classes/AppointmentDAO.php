<?php
require_once 'Db.php'; 

class AppointmentDAO extends AbstractDAO {
    private static $instance = null;

    // Private constructor for Singleton
    private function __construct() {
        parent::__construct(); 
    }

    // Singleton getInstance method
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new AppointmentDAO();
        }
        return self::$instance;
    }

    // Create an appointment
    public function createAppointment($appointmentDetails) {
        $sql = "INSERT INTO Appointment (PatientID, DoctorID, NurseID, AppointmentDate, Status) VALUES (:PatientID, :DoctorID, :NurseID, :AppointmentDate, :Status)";
        $stmt = $this->_connection->prepare($sql);

        // Bind parameters from $appointmentDetails
        $stmt->bindValue(':PatientID', $appointmentDetails['PatientID']);
        $stmt->bindValue(':DoctorID', $appointmentDetails['DoctorID']);
        $stmt->bindValue(':NurseID', $appointmentDetails['NurseID']);
        $stmt->bindValue(':AppointmentDate', $appointmentDetails['AppointmentDate']);
        $stmt->bindValue(':Status', $appointmentDetails['Status']);

        $stmt->execute();
    }

    // Read an appointment
    public function readAppointment($appointmentId) {
        $sql = "SELECT * FROM Appointment WHERE AppointmentID = :AppointmentID";
        $stmt = $this->_connection->prepare($sql);
        $stmt->bindValue(':AppointmentID', $appointmentId);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update an appointment
    public function updateAppointment($appointmentData) {
        $sql = "UPDATE Appointment SET PatientID = ?, DoctorID = ?, NurseID = ?, AppointmentDate = ?, Status = ? WHERE AppointmentID = ?";
        $stmt = $this->_connection->prepare($sql);
    
        $stmt->execute([
            $appointmentData['PatientID'],
            $appointmentData['DoctorID'],
            $appointmentData['NurseID'],
            $appointmentData['AppointmentDate'],
            $appointmentData['Status'],
            $appointmentData['AppointmentID']
        ]);
    }
    
    // Delete an appointment
    public function deleteAppointment($appointmentId) {
        $sql = "DELETE FROM Appointment WHERE AppointmentID = :AppointmentID";
        $stmt = $this->_connection->prepare($sql);
        $stmt->bindValue(':AppointmentID', $appointmentId);

        $stmt->execute();
    }
}
?>
