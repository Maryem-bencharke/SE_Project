<?php
require_once "../../classes/MedicalRecord/MedicalRecordDaoImpl.php";

// check if the user is logged in
session_start();
if(!isset($_SESSION["userID"])){
    header("Location: ../../index.php");
    exit();
}
// check: if the user is a doctor
if($_SESSION["role"] != "doctor"){
    header("Location: ../../index.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/Doctor/MedicalRecord.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css"></style>
    <script type="text/javascript" src="http://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
    <title>Hospital</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
            <div class="container">
                <a class="navbar-brand text12">Hospital management system</a>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="./dashboard.php">Dashboard</a>
                    </li>
                    </ul>
                </div>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#logout">Logout</button>
                <div class="modal fade" id="logout" tabindex="-1" aria-labelledby="logoutLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="logoutLabel">Logout</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <i class="fa fa-question-circle"></i> Are you sure you want to logout ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <!-- <button type="button" class="btn btn-danger">Logout</button> -->
                            <a href="../../logout.php" class="btn btn-danger btn-block">Logout</a>
                        </div>
                        </div>
                    </div>
                </div>
               
            </div>
        </nav>
    </header>
    <main>
    
        <div class ="m-4">
        <?php
        $medicalRecordDAO = new MedicalRecordDaoImpl();
        $patientID = $_GET['id'] ?? null;
        if ($patientID) {
            $medicalRecord = $medicalRecordDAO->getMedicalRecordByPatientId($patientID);
        } else {
            echo "No patient selected.";
            exit;
        }  
        if ($medicalRecord) {
            $recordId = $medicalRecord['RecordID']; 
        
            $fullMedicalRecord = $medicalRecordDAO->readMedicalRecord($recordId);
        
        } else {
            echo "No medical record found for the given patient ID.";
        }



        if (isset($fullMedicalRecord) && $fullMedicalRecord) {
            echo "<div class='medical-record-details'>";
            echo "<h3>Medical Record Details</h3>";
        
            echo "<div class='mb-3'>";
            echo "<label for='dateCreated' class='form-label'>Date Created:</label>";
            echo "<input type='text' class='form-control' id='dateCreated' value='" . htmlspecialchars($fullMedicalRecord['DateCreated']) . "' readonly>";
            echo "</div>";
        
            echo "<div class='mb-3'>";
            echo "<label for='treatmentPlan' class='form-label'>Treatment Plan:</label>";
            echo "<input type='text' class='form-control' id='treatmentPlan' value='" . htmlspecialchars($fullMedicalRecord['TreatmentPlan']) . "' readonly>";
            echo "</div>";
        
            echo "<div class='mb-3'>";
            echo "<label for='testResults' class='form-label'>Test Results:</label>";
            echo "<input type='text' class='form-control' id='testResults' value='" . htmlspecialchars($fullMedicalRecord['TestResults']) . "' readonly>";
            echo "</div>";
        
            if (!empty($fullMedicalRecord['ImageData'])) {
                echo "<div class='mb-3'>";
                echo "<label for='imageData' class='form-label'>Image:</label><br>";
                echo "<img src='data:image/jpeg;base64," . base64_encode($fullMedicalRecord['ImageData']) . "' alt='Medical Image'>";
                echo "</div>";
            }
        
            echo "<div class='mb-3'>";
            echo "<label for='doctorId' class='form-label'>Doctor ID:</label>";
            echo "<input type='text' class='form-control' id='doctorId' value='" . htmlspecialchars($fullMedicalRecord['DoctorID']) . "' readonly>";
            echo "</div>";
        
            echo "<div class='mb-3'>";
            echo "<label for='nurseId' class='form-label'>Nurse ID:</label>";
            echo "<input type='text' class='form-control' id='nurseId' value='" . htmlspecialchars($fullMedicalRecord['NurseID']) . "' readonly>";
            echo "</div>";
        
            echo "<div class='mb-3'>";
            echo "<label for='record' class='form-label'>Record:</label>";
            echo "<input type='text' class='form-control' id='record' value='" . htmlspecialchars($fullMedicalRecord['Record']) . "' readonly>";
            echo "</div>";
        
            echo "</div>";

        } else {
            echo "<p>No detailed medical record found.</p>";
        }?>


                      
        </div>
      
    </main>
</body>
<!-- js -->
<script src="../../js/Doctor/MedicalRecord.js"></script>
</html>
