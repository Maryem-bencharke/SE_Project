<?php
require_once 'AdministratorDAOImpl.php';
require_once 'Administrator.php';

// Create a new Administrator
$admin = new Administrator(1, "AdminUser", "adminPass123", "admin@example.com", "123 Admin St", "123-456-7890", "ADMINCIN123");
$adminDAO = new AdministratorDAOImpl();

try {
    $adminDAO->createAdministrator($admin);
    echo "Administrator created successfully!\n";
} catch (Exception $e) {
    echo "Error creating administrator: " . $e->getMessage() . "\n";
}

// Update Administrator
$admin->setEmail("newadminemail@example.com");
try {
    $adminDAO->updateAdministrator($admin);
    echo "Administrator updated successfully!\n";
} catch (Exception $e) {
    echo "Error updating administrator: " . $e->getMessage() . "\n";
}


// Delete Administrator
try {
    $adminDAO->deleteAdministrator($admin);
    echo "Administrator deleted successfully!\n";
} catch (Exception $e) {
    echo "Error deleting administrator: " . $e->getMessage() . "\n";
}

?>