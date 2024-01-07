<?php
require_once "../../classes/Doctor/DoctorDAOImpl.php";

// check if the user is logged in
session_start();
if (!isset($_SESSION["userID"])) {
    header("Location: ../../index.php");
    exit();
}
// check if the user is an administrator
if ($_SESSION["role"] != "administrator") {
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
    <link rel="stylesheet" href="../../css/Administrator/Doctor.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css"></style>
    <script type="text/javascript" src="http://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
    <title>Administrator - Manage Doctors</title>
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
    <main class="container">
        <h3>Manage Doctors</h3>
        <div class="actions mb-3">
        <a href="addDoctor.php" class="btn btn-primary">Add New Doctor</a>

        </div>
        <table id="doctors" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>CIN</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $doctorDao = new DoctorDAOImpl();
                    $doctors = $doctorDao->getAllDoctors(); 
                    foreach ($doctors as $doctor) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($doctor->getCIN()) . "</td>";
                        echo "<td>" . htmlspecialchars($doctor->getName()) . "</td>";
                        echo "<td>" . htmlspecialchars($doctor->getEmail()) . "</td>";
                        echo "<td>" . htmlspecialchars($doctor->getAddress()) . "</td>";
                        echo "<td>" . htmlspecialchars($doctor->getPhoneNumber()) . "</td>";
                        // Edit link
                        echo "<td><a href='updateDoctor.php?doctorID=" . $doctor->getUserID() . "' class='btn btn-primary btn-sm'>Edit</a>";                      
                         echo "<a href='deleteDoctor.php?doctorID=" . $doctor->getUserID() . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this doctor?\");'>Delete</a></td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </main>
    <!-- JavaScript for handling actions -->
    <script src="../../js/Administrator/Doctor.js"></script>
</body>
</html>
