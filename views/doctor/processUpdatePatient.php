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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patientDao = new PatientDaoImpl();

    // Extract and sanitize input
    $patientID = $_POST['patientID'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $birthDate = $_POST['birthdate'];
    $cin = htmlspecialchars($_POST['cin']);  // Sanitization is done at the DAO level
    $phoneNumber = htmlspecialchars($_POST['phonenumber']);  // Sanitization is done at the DAO level
    $address = htmlspecialchars($_POST['address']);  
    $bloodgroup = htmlspecialchars($_POST['bloodgroup']);  
    $gender = htmlspecialchars($_POST['gender']);  
    $email = htmlspecialchars($_POST['email']);  
    
    $allergies = htmlspecialchars($_POST['allergies']);  
    $InsuranceInfo = htmlspecialchars($_POST['InsuranceInfo']);  
    $EmergencyContactName = htmlspecialchars($_POST['EmergencyContactName']);  
    $EmergencyContactPhone = htmlspecialchars($_POST['EmergencyContactPhone']);  

    $EmergencyContactEmail = htmlspecialchars($_POST['EmergencyContactEmail']);  

    $EmergencyContactAddress = htmlspecialchars($_POST['EmergencyContactAddress']);
    $EmergencyContactRelation = htmlspecialchars($_POST['EmergencyContactRelation']);
    $EmergencyContactBloodGroup = htmlspecialchars($_POST['EmergencyContactBloodGroup']);
    $EmergencyContactCIN = htmlspecialchars($_POST['EmergencyContactCIN']);





    //$gender

    //$bloodType
     
            // Sanitization is done at the DAO level

    // ... retrieve other fields ...

    // Create a Patient object
    $patient = new Patient(
        $patientID,
        $firstName,
        $lastName,
        $birthDate,
        $gender,
        $bloodgroup,
        $phoneNumber,
        $address,
        $allergies,
        $email,
        $cin,
        $InsuranceInfo,
        $EmergencyContactName,
        $EmergencyContactPhone,
        $EmergencyContactAddress,

        $EmergencyContactEmail,
        $EmergencyContactRelation,
        $EmergencyContactBloodGroup,
        $EmergencyContactCIN

        

        

        // ... other fields ...
    );

    // Update patient details using the DAO method
    try {
        $patientDao->updatePatient($patient);
        //echo "Patient updated successfully.";
        $_SESSION['success_message'] = "Patient updated successfully.";
        echo "<script>window.location.href = 'patients.php';</script>";

        // Redirect or offer a link back to the dashboard
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}
        ?>

</div>

</main>
</body>
