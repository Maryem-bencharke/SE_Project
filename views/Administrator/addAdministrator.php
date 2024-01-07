<?php
require_once "../../classes/Administrator/AdministratorDAOImpl.php";
require_once "../../classes/Administrator/Administrator.php";

// Check if the user is logged in and is an administrator
session_start();
if (!isset($_SESSION["userID"]) || $_SESSION["role"] != "administrator") {
    header("Location: ../../index.php");
    exit();
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize input data
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']); // Consider hashing the password
    $email = htmlspecialchars($_POST['email']);
    $phoneNumber = htmlspecialchars($_POST['phoneNumber']);
    $address = htmlspecialchars($_POST['address']);
    $CIN = htmlspecialchars($_POST['CIN']);

    // Create an Administrator object and use DAO to insert it into the database
    $administrator = new Administrator(null, $username, $password, $email, $address, $phoneNumber, $CIN);
    $adminDao = new AdministratorDAOImpl();

    try {
        $adminDao->createAdministrator($administrator);
        $message = "Administrator added successfully.";
    } catch (Exception $e) {
        $message = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Add Administrator</title>
    <meta charset="UTF-8">
    <title>Add Doctor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/Administrator/Administartor.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css"></style>
    <script type="text/javascript" src="http://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
</head>
<body>
    <?php
    // Display success or error message
    if (!empty($message)) {
        echo "<div class='alert alert-info'>";
        echo htmlspecialchars($message);
        echo "</div>";
    }
    ?>

    <div class="container">
        <form action="addAdministrator.php" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="email" name="email" placeholder="Email">
            <input type="text" name="phoneNumber" placeholder="Phone Number">
            <input type="text" name="address" placeholder="Address">
            <input type="text" name="CIN" placeholder="CIN" required>
            <button type="submit" class="btn btn-primary">Add Administrator</button>
            <!-- Back to Dashboard Button -->
            <a href="./dashboard.php" class="btn btn-secondary mt-3">Back to Dashboard</a>
        </form>
    </div>
</body>
</html>
