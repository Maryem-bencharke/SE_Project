<?php
require_once "../../classes/Nurse/NurseDAOImpl.php";

session_start();
if (!isset($_SESSION["userID"]) || $_SESSION["role"] != "administrator") {
    header("Location: ../../index.php");
    exit();
}

$message = "";

if (isset($_GET['nurseID'])) {
    $nurseID = $_GET['nurseID'];
    $nurseDao = new NurseDAOImpl();

    try {
        $nurseDao->deleteNurse($nurseID);
        $message = "Nurse deleted successfully.";
    } catch (Exception $e) {
        $message = $e->getMessage();
    }
} else {
    $message = "Nurse ID not provided.";
}

header("Location: ./nurses.php?message=" . urlencode($message));
exit();
?>
