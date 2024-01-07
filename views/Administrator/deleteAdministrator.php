<?php
require_once "../../classes/Administrator/AdministratorDAOImpl.php";

// Start the session and check user's role
session_start();
if (!isset($_SESSION["userID"]) || $_SESSION["role"] != "administrator") {
    header("Location: ../../index.php");
    exit();
}

// Initialize message variable
$message = "";

// Check if adminID is set in the query string
if (isset($_GET['adminID'])) {
    $adminID = $_GET['adminID'];
    $adminDao = new AdministratorDAOImpl();

    try {
        // Attempt to delete the administrator
        $adminDao->deleteAdministrator($adminID);
        $message = "Administrator deleted successfully.";
    } catch (Exception $e) {
        // Handle exceptions, such as administrator not found or database errors
        $message = $e->getMessage();
    }
} else {
    // If adminID isn't set in the query string, set an error message
    $message = "Administrator ID not provided.";
}


// Redirect back to the administrator management page with a message
header("Location: ./administrators.php?message=" . urlencode($message));
exit();
?>
