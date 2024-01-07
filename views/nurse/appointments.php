<?php
require_once "../../classes/Nurse/nurseDAOImpl.php";
require_once "../../classes/Appointment/AppointmentDAOImpl.php";
require_once "../../classes/Doctor/DoctorDaoImpl.php";
require_once "../../classes/Doctor/Doctor.php";

require_once "../../classes/Patient/PatientDaoImpl.php";


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
if (isset($_SESSION["success_message_appointment"])){
    if ($_SESSION["success_message_appointment"] != false){
        $successMessage ="Appointment updated successfully.";
        $_SESSION["success_message_appointment"] = false;
    }
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
                    <li class="nav-item">
                        <a class="nav-link" href="./appointments.php">Appointments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./patients.php">Patients</a>
                    </li>
                </ul>
            </div>
            <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a href="./addAppointment.php" class="nav-link btn btn-success text-white" >Add Appointment</a>
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
    <?php if (!empty($successMessage)): ?>
        <div class="container mt-4">

            <div class="alert alert-success" role="alert">
                <?php echo $successMessage; ?>
            </div>
        </div>
    <?php endif; ?>
    <div class ="m-4">
        <table id ="patients" class ="table table-striped table-bordered table-sm" cellspacing="0" width = "100%">
            <thead>
            <tr>
                <th class="th-sm">Date</th>
                <th class="th-sm">Status</th>
                <th class="th-sm">Doctor</th>
                <th class ="th-sm">Patient</th>
                <th class="th-sm">Actions</th>

            </tr>
            </thead>
            <tbody>
            <?php
            $appointmentDao = new AppointmentDAOImpl();
            $appointments = $appointmentDao->getAppointmentsByNurse($_SESSION["userID"]);
            if(count($appointments) == 0){
                echo "<tr>";
                echo "<td colspan='4'>No appointments found</td>";
                echo "</tr>";
            }

            foreach($appointments as $appointment){
                if($appointment instanceof Appointment){
                    try{
                    echo "<tr>";
                    $date = $appointment->getAppointmentDate();
                    $status = $appointment->getAppointmentStatus();
                    $doctorId = $appointment->getDoctorId();
                    $doctorDao = new DoctorDaoImpl();
                    $doctor = $doctorDao->getDoctorById($doctorId);
                    $doctorName = $doctor->getName();
                    $patientId = $appointment->getPatientId();
                    $patientDao = new PatientDaoImpl();
                    $patient = $patientDao->getPatientById($patientId);
                    $firstName = $patient->getFirstName();
                    $lastName = $patient->getLastName();
                    $name = $firstName . " " . $lastName;
                    echo "<td>" . $date . "</td>";
                    echo "<td>" . $status . "</td>";
                    echo "<td>" .$doctorName . "</td>";
                    echo "<td>" . $name . "</td>";
                    echo "<td><a href='updateAppointment.php?id=" . $appointment->getAppointmentId() . "' class='btn btn-warning btn-sm'>Update</a>
                    </td>";

                    echo "</tr>";
                    }
                    catch(Exception $e){
                        echo $e->getMessage();
                    }
                }

            }
            ?>
        </table>
    </div>

</main>
</body>
<!-- js -->
<script src="../../js/Nurse/Patient.js"></script>
</html>
