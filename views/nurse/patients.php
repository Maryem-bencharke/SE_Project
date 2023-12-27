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

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/Nurse/Patient.css">
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
            <table id ="patients" class ="table table-striped table-bordered table-sm" cellspacing="0" width = "100%">
                <thead>
                    <tr>
                        <th class="th-sm">CIN</th>
                        <th class="th-sm">First Name</th>
                        <th class="th-sm">Last Name</th>
                        <th class ="th-sm">Date of Birth</th>
                        <th class ="th-sm">Blood Group</th>
                        <th class ="th-sm">Phone Number</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $patientDao = new PatientDaoImpl();
                        $patients = $patientDao->getAllPatients();
                        foreach($patients as $patient){
                            echo "<tr>";
                            $cin = $patient->getCIN();
                            $firstName = $patient->getFirstName();
                            $lastName = $patient->getLastName();
                            $dateOfBirth = $patient->getBirthDate();
                            $bloodGroup = $patient->getBloodGroup();
                            $phoneNumber = $patient->getPhoneNumber();
                    
                            echo "<td>" . $cin . "</td>";
                            echo "<td>" . $firstName . "</td>";
                            echo "<td>" . $lastName . "</td>";
                            echo "<td>" .$dateOfBirth . "</td>";
                            echo "<td>" . $bloodGroup . "</td>";
                            echo "<td>" . $phoneNumber . "</td>";
                            echo "</tr>";
                        }
                    ?>
            </table>
        </div>
      
    </main>
</body>
<!-- js -->
<script src="../../js/Nurse/Patient.js"></script>
</html>