<?php
require_once "../../classes/Patient/patientDaoImpl.php";
require_once "../../classes/Doctor/doctorDaoImpl.php";
require_once "../../classes/Nurse/nurseDaoImpl.php";
require_once "../../classes/Appointment/appointmentDaoImpl.php";


session_start();
if (!isset($_SESSION["userID"]) || $_SESSION["role"] !== "nurse") {
    header("Location: ../../index.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $success = true;
    $doctorerror = false;
    // Retrieve form data
    $appointmentDate = $_POST['appointmentDate'];
    $appointmentStatus = $_POST['appointmentStatus'];
    $doctorCIN = $_POST['doctorId'];
    $patientCIN = $_POST['patientId'];
    $doctorDao = new DoctorDaoImpl();
    $doctor = $doctorDao->getDoctorByCIN($doctorCIN);
    $doctorId = $doctor->getUserId();
    if ($doctor->getAppointmentsPerDay($appointmentDate) > 10){
        $success = false;
        $doctorerror = true;
    }

        $patientDao = new PatientDaoImpl();
        $patient = $patientDao->getPatientByCIN($patientCIN);
        $patientId = $patient->getPatientID();
        $nurseDao = new NurseDaoImpl();
        $nurseId = $_SESSION["userID"];
        $appointmentDao = new AppointmentDaoImpl();
        $newAppointment = new Appointment(null, $appointmentDate, $appointmentStatus, $doctorId, $nurseId, $patientId);
        $success = $appointmentDao->addAppointment($newAppointment);



    if ($success) {
        $_SESSION['success_message'] = "Appointment added successfully.";
        header("Location: ./appointments.php");
        exit();
    } else {
        if($doctorerror){
            $_SESSION['error_message'] = "Doctor has more than 10 appointments per day.";
        }else{
            $_SESSION['error_message'] = "An error occurred while adding the appointment.";
        }
        header("Location: ./appointments.php");
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
                        <li class="nav-item">
                            <a class="nav-link" href="./appointments.php">Appointments</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./patients.php">Patients</a>
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
                                <a href="../../logout.php" class="btn btn-danger btn-block">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <div class="m-4">
            <form action="addAppointment.php" method="post">
                <div class="mb-3">
                    <label for="appointmentDate" class="form-label">Appointment Date:</label>
                    <input type="datetime-local" class="form-control" name="appointmentDate" id="appointmentDate" value="" required>
                </div>

                <div class="mb-3">
                    <label for="appointmentStatus" class="form-label">Appointment Status:</label>
                    <input type="text" class="form-control" name="appointmentStatus" id="appointmentStatus" value="" required>
                </div>

                <div class="mb-3">
                    <label for="doctorId" class="form-label">Doctor CIN:</label>
                    <input type="text" class="form-control" name="doctorId" id="doctorId" value="" required>
                </div>



                <div class="mb-3">
                    <label for="patientId" class="form-label">Patient CIN:</label>
                    <input type="text" class="form-control" name="patientId" id="patientId" value=""required>
                </div>
                <button type="submit" class="btn btn-primary">Add Appointment</button>
            </form>
        
        </div>
    </main>
</body>
</html>