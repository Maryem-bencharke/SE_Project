<?php
require_once "../../classes/Doctor/DoctorDAOImpl.php";

session_start();
if (!isset($_SESSION["userID"]) || $_SESSION["role"] != "administrator") {
    header("Location: ../../index.php");
    exit();
}

$message = "";

if (isset($_GET['doctorID'])) {
    $doctorID = $_GET['doctorID'];
    $doctorDao = new DoctorDAOImpl();

    try {
        $doctorDao->deleteDoctor($doctorID);
        $message = "Doctor deleted successfully.";
    } catch (Exception $e) {
        $message = $e->getMessage();
    }
} else {
    $message = "Doctor ID not provided.";
}

header("Location: ./doctors.php?message=" . urlencode($message));
exit();
?>
