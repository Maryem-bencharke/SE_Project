<?php
require_once "../../classes/Nurse/NurseDAOImpl.php";
require_once "../../classes/Nurse/Nurse.php";

session_start();
if (!isset($_SESSION["userID"]) || $_SESSION["role"] != "administrator") {
    header("Location: ../../index.php");
    exit();
}

$nurseDAO = new NurseDAOImpl();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nurseID = $_POST['nurseID'];
    $username = $_POST['username'];
    $password = $_POST['password']?? ''; // Consider hashing the password
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $address = $_POST['address'];
    $CIN = $_POST['CIN'];

    try {
        $updateNurse = new Nurse($nurseID, $username, $password, $email, $phoneNumber, $address, $CIN);

        $success = $nurseDAO->updateNurse($updateNurse);

        if ($success) {
            $_SESSION['success_message'] = "Nurse updated successfully.";
            header("Location: ./nurses.php");
        } else {
            $_SESSION['error_message'] = "An error occurred while updating the nurse.";
            header("Location: ./nurses.php");
        }
    } catch (Exception $e) {
        $_SESSION['error_message'] = $e->getMessage();
        header("Location: ./UpdateNurse.php?nurseID=" . $nurseID); // Redirect back with error message
    }
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/Administrator/Administrator.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css"></style>
    <script type="text/javascript" src="http://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
    <title>Nurse - Manage Nurse</title>
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
                            <button type="button" class="btn btn-danger">Logout</button>
                            <a href="../../logout.php" class="btn btn-danger btn-block">Logout</a>
                        </div>
                        </div>
                    </div>
                </div>
               
            </div>
        </nav>
    </header>

    <main class="container">
    <div class ="m-4">
        <?php
        require_once "../../classes/Nurse/NurseDAOImpl.php";

        $nurseDAO = new NurseDAOImpl();
        $nurseID = $_GET['nurseID'] ?? null;

        if ($nurseID) {
            $nurse = $nurseDAO->getNurseById($nurseID);
            if ($nurse) {?> 
                <form action="UpdateNurse.php" method="post">
                <input type="hidden" name="nurseID" value="<?php echo htmlspecialchars($nurse->getUserID()); ?>">

                <div class="mb-3">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" class="form-control" name="username" id="username" value="<?php echo htmlspecialchars($nurse->getName()); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" name="email" id="email" value="<?php echo htmlspecialchars($nurse->getEmail()); ?>">
                </div>

                <div class="mb-3">
                    <label for="phoneNumber" class="form-label">Phone Number:</label>
                    <input type="text" class="form-control" name="phoneNumber" id="phoneNumber" value="<?php echo htmlspecialchars($nurse->getPhoneNumber()); ?>">
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address:</label>
                    <input type="text" class="form-control" name="address" id="address" value="<?php echo htmlspecialchars($nurse->getAddress()); ?>">
                </div>

                <div class="mb-3">
                    <label for="cin" class="form-label">CIN:</label>
                    <input type="text" class="form-control" name="cin" id="cin" value="<?php echo htmlspecialchars($nurse->getCIN()); ?>" required>
                </div>

                <button type="submit" class="btn btn-primary">Update Nurse</button>
            </form>
            <?php  
            } else {
                echo "<p>Nurse not found.</p>";
            }
        }
        ?>
    </div>
</main>

<script src="../../js/Administrator/Nurse.js"></script>
</html>
