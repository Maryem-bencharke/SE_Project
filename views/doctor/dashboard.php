<?php
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
    <link rel="stylesheet" href="css/style.css">
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
                            <h5 class="modal-title" id="logoutLabel">logout</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <i class="fa fa-question-circle"></i> Are you sure you want to log-off?
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
    <main  class="container mt-5">

        <div class="mb-3">
            <h3> Welcome <?php echo $_SESSION["USER_NAME"]; ?></h3>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Patients</h4>
                        <!-- Button to show all the patients -->
                        <a href="patients.php" class="btn btn-primary" >View patient record management</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Appointments</h4>
                        <a href="appointments.php" class="btn btn-primary" >Get appointment</a>
                    </div>
                </div>
            </div>

        </div>
    </main>
</body>
</html>
