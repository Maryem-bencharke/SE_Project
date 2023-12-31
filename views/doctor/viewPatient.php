<?php
require_once "../../classes/Patient/patientDaoImpl.php";

// check if the user is logged in
session_start();
if(!isset($_SESSION["userID"])){
    header("Location: ../../index.php");
    exit();
}
// check: if the user is a nurse
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
    <link rel="stylesheet" href="../../css/Doctor/Patient.css">
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

$patientDao = new PatientDaoImpl();
$patientID = $_GET['id'] ?? null; // Use null coalescing operator for PHP 7+
//$firstName = urldecode($_GET['fn'] ?? '');
//$lastName = urldecode($_GET['ln'] ?? '');

if ($patientID) {
    $patient = $patientDao->getPatientById($patientID); // Assuming you have this method
    // Now $patient contains the patient's details
     if (isset($patient)) {?> 
        <form action="viewPatient.php" method="post">
        <input type="hidden" name="patientID" value="<?php echo htmlspecialchars($patient->getPatientID()); ?>">

        <div class="mb-3">
            <label for="firstName" class="form-label">First Name:</label>
            <input type="text" class="form-control" name="firstName" id="firstName" value="<?php echo htmlspecialchars($patient->getFirstName()); ?>" readonly>
        </div>

        <div class="mb-3">
            <label for="lastName" class="form-label">Last Name:</label>
            <input type="text" class="form-control" name="lastName" id="lastName" value="<?php echo htmlspecialchars($patient->getLastName()); ?>" readonly>
        </div>
      
        <div class="mb-3">
            <label for="cin" class="form-label">CIN:</label>
            <input type="text" class="form-control" name="cin" id="cin" value="<?php echo htmlspecialchars($patient->getCIN()); ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="birthdate" class="form-label">BirthDate:</label>
            <input type="text" class="form-control" name="birthdate" id="birthdate" value="<?php echo htmlspecialchars($patient->getBirthDate()); ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="gender" class="form-label">Gender:</label>
            <input type="text" class="form-control" name="gender" id="gender" value="<?php echo htmlspecialchars($patient->getGender()); ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="text" class="form-control" name="email" id="email" value="<?php echo htmlspecialchars($patient->getEmail()); ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="phonenumber" class="form-label">PhoneNumber:</label>
            <input type="text" class="form-control" name="phonenumber" id="phonenumber" value="<?php echo htmlspecialchars($patient->getPhoneNumber()); ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="bloodgroup" class="form-label">BloodGroup:</label>
            <input type="text" class="form-control" name="bloodgroup" id="bloodgroup" value="<?php echo htmlspecialchars($patient->getBloodGroup()); ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address:</label>
            <input type="text" class="form-control" name="address" id="address" value="<?php echo htmlspecialchars($patient->getAddress()); ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="allergies" class="form-label">Allergies:</label>
            <input type="text" class="form-control" name="allergies" id="allergies" value="<?php echo htmlspecialchars($patient->getAllergies()); ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="InsuranceInfo" class="form-label">InsuranceInfo:</label>
            <input type="text" class="form-control" name="InsuranceInfo" id="InsuranceInfo" value="<?php echo htmlspecialchars($patient->getInsuranceInfo()); ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="EmergencyContactName" class="form-label">EmergencyContactName:</label>
            <input type="text" class="form-control" name="EmergencyContactName" id="EmergencyContactName" value="<?php echo htmlspecialchars($patient->getEmergencyContactName()); ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="EmergencyContactPhone" class="form-label">EmergencyContactPhone:</label>
            <input type="text" class="form-control" name="EmergencyContactPhone" id="EmergencyContactPhone" value="<?php echo htmlspecialchars($patient->getEmergencyContactPhone()); ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="EmergencyContactEmail" class="form-label">EmergencyContactEmail:</label>
            <input type="text" class="form-control" name="EmergencyContactEmail" id="EmergencyContactEmail" value="<?php echo htmlspecialchars($patient->getEmergencyContactEmail()); ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="EmergencyContactAddress" class="form-label">EmergencyContactAddress:</label>
            <input type="text" class="form-control" name="EmergencyContactAddress" id="EmergencyContactAddress" value="<?php echo htmlspecialchars($patient->getEmergencyContactAddress()); ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="EmergencyContactRelation" class="form-label">EmergencyContactRelation:</label>
            <input type="text" class="form-control" name="EmergencyContactRelation" id="EmergencyContactRelation" value="<?php echo htmlspecialchars($patient->getEmergencyContactRelation()); ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="EmergencyContactBloodGroup" class="form-label">EmergencyContactBloodGroup:</label>
            <input type="text" class="form-control" name="EmergencyContactBloodGroup" id="EmergencyContactBloodGroup" value="<?php echo htmlspecialchars($patient->getEmergencyContactBloodGroup()); ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="EmergencyContactCIN" class="form-label">EmergencyContactCIN:</label>
            <input type="text" class="form-control" name="EmergencyContactCIN" id="EmergencyContactCIN" value="<?php echo htmlspecialchars($patient->getEmergencyContactCIN()); ?>" readonly>
        </div>


    </form>
<?php  } 

}?>

                      
        </div>
      
    </main>
</body>
<!-- js -->
<script src="../../js/Doctor/Patient.js"></script>
</html>
