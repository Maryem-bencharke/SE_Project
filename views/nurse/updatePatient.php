<?php
require_once "../../classes/Patient/patientDaoImpl.php";

// check if the user is logged in
session_start();
if(!isset($_SESSION["userID"])){
    header("Location: ../../index.php");
    exit();
}
// check: if the user is a nurse
if($_SESSION["role"] != "nurse"){
    header("Location: ../../index.php");
    exit();
}
$patientDao = new PatientDaoImpl();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the updated patient information from the form
    $patientID = $_POST['patientID'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $cin = $_POST['cin'];
    $birthdate = $_POST['birthdate'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $bloodgroup = $_POST['bloodgroup'];
    $address = $_POST['address'];
    $allergies = $_POST['allergies'];
    $insuranceInfo = $_POST['InsuranceInfo'];
    $emergencyContactName = $_POST['EmergencyContactName'];
    $emergencyContactPhone = $_POST['EmergencyContactPhone'];
    $emergencyContactEmail = $_POST['EmergencyContactEmail'];
    $emergencyContactAddress = $_POST['EmergencyContactAddress'];
    $emergencyContactRelation = $_POST['EmergencyContactRelation'];
    $emergencyContactBloodGroup = $_POST['EmergencyContactBloodGroup'];
    $emergencyContactCIN = $_POST['EmergencyContactCIN'];

    $updatedPatient = new Patient($patientID, $firstName, $lastName,  $birthdate, $gender,$bloodgroup,$phonenumber,$address,$allergies,  $email,$cin, $insuranceInfo, $emergencyContactName, $emergencyContactPhone,$emergencyContactAddress, $emergencyContactEmail, $emergencyContactRelation, $emergencyContactBloodGroup, $emergencyContactCIN);
    
    $success = $patientDao->updatePatient($updatedPatient);
    if ($success) {
        $_SESSION['success_message'] = "Patient updated successfully.";
        header("Location: ./patients.php");
        exit();
    } else {
        $_SESSION['error_message'] = "An error occurred while updating the patient.";
        header("Location: ./patients.php");
        exit();
    }
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
    $patientID = $_GET['id'] ?? null; 

    if ($patientID) {
        $patient = $patientDao->getPatientById($patientID); 
        if (isset($patient)) {?> 
            <form action="updatePatient.php" method="post">
            <input type="hidden" name="patientID" value="<?php echo htmlspecialchars($patient->getPatientID()); ?>">

            <div class="mb-3">
                <label for="firstName" class="form-label">First Name:</label>
                <input type="text" class="form-control" name="firstName" id="firstName" value="<?php echo htmlspecialchars($patient->getFirstName()); ?>" >
            </div>

            <div class="mb-3">
                <label for="lastName" class="form-label">Last Name:</label>
                <input type="text" class="form-control" name="lastName" id="lastName" value="<?php echo htmlspecialchars($patient->getLastName()); ?>" >
            </div>
        
            <div class="mb-3">
                <label for="cin" class="form-label">CIN:</label>
                <input type="text" class="form-control" name="cin" id="cin" value="<?php echo htmlspecialchars($patient->getCIN()); ?>" >
            </div>
            <div class="mb-3">
                <label for="birthdate" class="form-label">BirthDate:</label>
                <input type="text" class="form-control" name="birthdate" id="birthdate" value="<?php echo htmlspecialchars($patient->getBirthDate()); ?>" >
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Gender:</label>
                <select class="form-select" name="gender" id="gender">
                    <option value="male" <?php echo ($patient->getGender() === 'M') ? 'selected' : ''; ?>>M</option>
                    <option value="female" <?php echo ($patient->getGender() === 'F') ? 'selected' : ''; ?>>F</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="text" class="form-control" name="email" id="email" value="<?php echo htmlspecialchars($patient->getEmail()); ?>" >
            </div>
            <div class="mb-3">
                <label for="phonenumber" class="form-label">PhoneNumber:</label>
                <input type="tel" class="form-control" name="phonenumber" id="phonenumber" value="<?php echo htmlspecialchars($patient->getPhoneNumber()); ?>" >
            </div>
            <div class="mb-3">
            <label for="bloodgroup" class="form-label">Blood Group:</label>
            <select class="form-select" name="bloodgroup" id="bloodgroup">
                <option value="A+" <?php echo ($patient->getBloodGroup() === 'A+') ? 'selected' : ''; ?>>A+</option>
                <option value="A-" <?php echo ($patient->getBloodGroup() === 'A-') ? 'selected' : ''; ?>>A-</option>
                <option value="B+" <?php echo ($patient->getBloodGroup() === 'B+') ? 'selected' : ''; ?>>B+</option>
                <option value="B-" <?php echo ($patient->getBloodGroup() === 'B-') ? 'selected' : ''; ?>>B-</option>
                <option value="AB+" <?php echo ($patient->getBloodGroup() === 'AB+') ? 'selected' : ''; ?>>AB+</option>
                <option value="AB-" <?php echo ($patient->getBloodGroup() === 'AB-') ? 'selected' : ''; ?>>AB-</option>
                <option value="O+" <?php echo ($patient->getBloodGroup() === 'O+') ? 'selected' : ''; ?>>O+</option>
                <option value="O-" <?php echo ($patient->getBloodGroup() === 'O-') ? 'selected' : ''; ?>>O-</option>
            </select>
        </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address:</label>
                <input type="text" class="form-control" name="address" id="address" value="<?php echo htmlspecialchars($patient->getAddress()); ?>" >
            </div>
            <div class="mb-3">
                <label for="allergies" class="form-label">Allergies:</label>
                <input type="text" class="form-control" name="allergies" id="allergies" value="<?php echo htmlspecialchars($patient->getAllergies()); ?>" >
            </div>
            <div class="mb-3">
                <label for="InsuranceInfo" class="form-label">InsuranceInfo:</label>
                <input type="text" class="form-control" name="InsuranceInfo" id="InsuranceInfo" value="<?php echo htmlspecialchars($patient->getInsuranceInfo()); ?>" >
            </div>
            <div class="mb-3">
                <label for="EmergencyContactName" class="form-label">EmergencyContactName:</label>
                <input type="text" class="form-control" name="EmergencyContactName" id="EmergencyContactName" value="<?php echo htmlspecialchars($patient->getEmergencyContactName()); ?>" >
            </div>
            <div class="mb-3">
                <label for="EmergencyContactPhone" class="form-label">EmergencyContactPhone:</label>
                <input type="tel" class="form-control" name="EmergencyContactPhone" id="EmergencyContactPhone" value="<?php echo htmlspecialchars($patient->getEmergencyContactPhone()); ?>" >
            </div>
            <div class="mb-3">
                <label for="EmergencyContactEmail" class="form-label">EmergencyContactEmail:</label>
                <input type="email" class="form-control" name="EmergencyContactEmail" id="EmergencyContactEmail" value="<?php echo htmlspecialchars($patient->getEmergencyContactEmail()); ?>" >
            </div>
            <div class="mb-3">
                <label for="EmergencyContactAddress" class="form-label">EmergencyContactAddress:</label>
                <input type="text" class="form-control" name="EmergencyContactAddress" id="EmergencyContactAddress" value="<?php echo htmlspecialchars($patient->getEmergencyContactAddress()); ?>" >
            </div>
            <div class="mb-3">
                <label for="EmergencyContactRelation" class="form-label">Emergency Contact Relation:</label>
                <select class="form-select" name="EmergencyContactRelation" id="EmergencyContactRelation">
                    <option value="spouse" <?php echo ($patient->getEmergencyContactRelation() === 'spouse') ? 'selected' : ''; ?>>Spouse</option>
                    <option value="parent" <?php echo ($patient->getEmergencyContactRelation() === 'parent') ? 'selected' : ''; ?>>Parent</option>
                    <option value="sibling" <?php echo ($patient->getEmergencyContactRelation() === 'sibling') ? 'selected' : ''; ?>>Sibling</option>
                    <option value="child" <?php echo ($patient->getEmergencyContactRelation() === 'child') ? 'selected' : ''; ?>>Child</option>
                    <option value="friend" <?php echo ($patient->getEmergencyContactRelation() === 'friend') ? 'selected' : ''; ?>>Friend</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="EmergencyContactBloodGroup" class="form-label">Emergency Contact Blood Group:</label>
                <select class="form-select" name="EmergencyContactBloodGroup" id="EmergencyContactBloodGroup">
                    <option value="A+" <?php echo ($patient->getEmergencyContactBloodGroup() === 'A+') ? 'selected' : ''; ?>>A+</option>
                    <option value="A-" <?php echo ($patient->getEmergencyContactBloodGroup() === 'A-') ? 'selected' : ''; ?>>A-</option>
                    <option value="B+" <?php echo ($patient->getEmergencyContactBloodGroup() === 'B+') ? 'selected' : ''; ?>>B+</option>
                    <option value="B-" <?php echo ($patient->getEmergencyContactBloodGroup() === 'B-') ? 'selected' : ''; ?>>B-</option>
                    <option value="AB+" <?php echo ($patient->getEmergencyContactBloodGroup() === 'AB+') ? 'selected' : ''; ?>>AB+</option>
                    <option value="AB-" <?php echo ($patient->getEmergencyContactBloodGroup() === 'AB-') ? 'selected' : ''; ?>>AB-</option>
                    <option value="O+" <?php echo ($patient->getEmergencyContactBloodGroup() === 'O+') ? 'selected' : ''; ?>>O+</option>
                    <option value="O-" <?php echo ($patient->getEmergencyContactBloodGroup() === 'O-') ? 'selected' : ''; ?>>O-</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="EmergencyContactCIN" class="form-label">EmergencyContactCIN:</label>
                <input type="number" class="form-control" name="EmergencyContactCIN" id="EmergencyContactCIN" value="<?php echo htmlspecialchars($patient->getEmergencyContactCIN()); ?>" >
            </div>


            <button type="submit" class="btn btn-primary">Update Patient</button>
        </form>
        <?php  

        } 
        // update the patient
        else {
            echo "<p>There is no patient with ID $patientID.</p>";
        }


}?>




    </div>

    </main>
</body>
