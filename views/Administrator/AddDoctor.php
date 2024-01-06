<?php
require_once "../../classes/Doctor/DoctorDAOImpl.php";
require_once "../../classes/Doctor/Doctor.php";

// Check if the user is logged in and is an administrator
session_start();
if (!isset($_SESSION["userID"]) || $_SESSION["role"] != "administrator") {
    header("Location: ../../index.php");
    exit();
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']); // Consider hashing the password
    $email = htmlspecialchars($_POST['email']);
    $phoneNumber = htmlspecialchars($_POST['phoneNumber']);
    $address = htmlspecialchars($_POST['address']);
    $CIN = htmlspecialchars($_POST['CIN']);

    $doctor = new Doctor(null, $username, $password, $email, $address, $phoneNumber, $CIN);
    $doctorDao = new DoctorDAOImpl();

    try {
        $doctorDao->createDoctor($doctor);
        $message = "Doctor added successfully.";
    } catch (Exception $e) {
        $message = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Add Doctor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/Administrator/Doctor.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css"></style>
    <script type="text/javascript" src="http://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
</head>
<body>
    <?php if (!empty($message)): ?>
        <div class='alert alert-info'><?= $message ?></div>
    <?php endif; ?>

    <div class="container">
    <!-- Form for adding doctor -->
    <form action="addDoctor.php" method="post">
        <!-- Input fields for doctor details -->
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" name="username" id="username" required>
        </div>
        
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password" id="password" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" id="email">
        </div>

        <div class="form-group">
            <label for="phoneNumber">Phone Number:</label>
            <input type="text" class="form-control" name="phoneNumber" id="phoneNumber">
        </div>

        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" class="form-control" name="address" id="address">
        </div>

        <div class="form-group">
            <label for="CIN">CIN:</label>
            <input type="text" class="form-control" name="CIN" id="CIN" required>
        </div>

        <button type="submit" class="btn btn-primary">Add Doctor</button>
    </form>
</div>

</body>
</html>
