<?php
// Start the session
session_start();

// Destroy all session data
session_unset(); // Unset all of the session variables
session_destroy(); // Destroy the session

// Redirect the user to the login page (or any other page)
header("Location: login.php");
exit();
?>
