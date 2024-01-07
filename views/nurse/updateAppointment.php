<?php
require_once "../../classes/Appointment/appointmentDaoImpl.php";
require_once "../../classes/Doctor/doctorDaoImpl.php";

require_once "../../classes/Nurse/nurseDaoImpl.php";
require_once "../../classes/Patient/patientDaoImpl.php";


// check if the user is logged in
session_start();
if (!isset($_SESSION["userID"])) {
    header("Location: ../../index.php");
    exit();
}

// check if the user is a nurse
if ($_SESSION["role"] != "nurse") {
    header("Location: ../../index.php");
    exit();
}

$appointmentDao = new AppointmentDaoImpl();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $appointmentId = $_POST['appointmentId'];
    $appointmentDate = $_POST['appointmentDate'];
    $appointmentStatus = $_POST['appointmentStatus'];
    $doctorCIN = $_POST['doctorId'];
    $nurseId = $_SESSION["userID"];
    $patientCIN = $_POST['patientId'];
    $patientDao = new PatientDAOImpl();
    $patientId = $patientDao->getPatientByCIN($patientCIN)->getPatientID();
    $doctorDao = new DoctorDAOImpl();
    $doctorId = $doctorDao->getDoctorByCIN($doctorCIN)->getUserID();

    $updatedAppointment = new Appointment($appointmentId, $appointmentDate, $appointmentStatus, $doctorId, $nurseId, $patientId);

    $success = $appointmentDao->updateAppointment($updatedAppointment);

    if ($success) {
        $_SESSION['success_message_appointment'] = "Appointment updated successfully.";
        header("Location: ./appointments.php");
        exit();
    } else {
        $_SESSION['success_message_appointment'] = "An error occurred while updating the appointment.";
        header("Location: ./appointments.php");
        exit();
    }
}

?>

<!-- HTML form for updating appointments -->
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
        <div class="m-4">
            <?php
            $appointmentDao = new AppointmentDaoImpl();
            $appointmentId = $_GET['id'] ?? null;

            if ($appointmentId) {
                $appointment = $appointmentDao->getAppointmentById($appointmentId);
                if (isset($appointment)) { 
                    $doctorDao = new DoctorDaoImpl();
                    $nurseDao = new NurseDaoImpl();
                    $patientDao = new PatientDaoImpl();
                    $doctorID = $appointment->getDoctorId();
                    $doctor = $doctorDao->getDoctorById($doctorID);
                    $doctorCIN = $doctor->getCIN();
                    $patientId = $appointment->getPatientId();
                    $patient = $patientDao->getPatientById($patientId);
                    $patientCIN = $patient->getCIN();
                    ?>
                    
                    <form action="updateAppointment.php" method="post">
                        <input type="hidden" name="appointmentId" value="<?php echo htmlspecialchars($appointment->getAppointmentId()); ?>">
                        <div class="mb-3">
                            <label for="appointmentDate" class="form-label">Appointment Date:</label>
                            <input type="datetime-local" class="form-control" name="appointmentDate" id="appointmentDate" value="<?php echo htmlspecialchars($appointment->getAppointmentDate()); ?>">
                        </div>

                        <div class="mb-3">
                            <label for="appointmentStatus" class="form-label">Appointment Status:</label>
                            <input type="text" class="form-control" name="appointmentStatus" id="appointmentStatus" value="<?php echo htmlspecialchars($appointment->getAppointmentStatus()); ?>">
                        </div>

                        <div class="mb-3">
                            <label for="doctorId" class="form-label">Doctor CIN:</label>
                            <input type="text" class="form-control" name="doctorId" id="doctorId" value="<?php echo htmlspecialchars($doctorCIN); ?>">
                        </div>



                        <div class="mb-3">
                            <label for="patientId" class="form-label">Patient CIN:</label>
                            <input type="text" class="form-control" name="patientId" id="patientId" value="<?php echo htmlspecialchars($patientCIN); ?>">
                        </div>

                        <button type="submit" class="btn btn-primary">Update Appointment</button>
                    </form>
            <?php
                } else {
                    echo "<p>There is no appointment with ID $appointmentId.</p>";
                }
            }
            ?>
        </div>
    </main>

</body>

</html>