<?php
require_once "../../classes/Appointment/AppointmentDaoImpl.php";

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
$appointmentDAO = new AppointmentDAOImpl();
$doctorId = $_SESSION['userID']; 
$date = date('Y-m-d');

$appointments = $appointmentDAO->getAppointmentsPerDay($doctorId, $date);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/Doctor/Appointment.css">
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
            <h2>Appointments for <?php echo htmlspecialchars($date); ?></h2>
            <?php if (!empty($appointments)): ?>
                <table>
                    <tr>
                        <th>Appointment ID</th>
                        <th>Patient ID</th>
                        <th>Appointment Date</th>
                        <th>Status</th>
                    </tr>
                    <?php foreach ($appointments as $appointment): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($appointment['AppointmentID']); ?></td>
                            <td><?php echo htmlspecialchars($appointment['PatientID']); ?></td>
                            <td><?php echo htmlspecialchars($appointment['AppointmentDate']); ?></td>
                            <td><?php echo htmlspecialchars($appointment['Status']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <p>No appointments found for this date.</p>
            <?php endif; ?>
        </div>
    </main>
</body>
<!-- js -->
<script src="../../js/Doctor/Appointment.js"></script>
</html>
