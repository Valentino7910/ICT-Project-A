<?php
session_start();
// Unset username session variable
unset($_SESSION['username']);
// Optionally destroy the entire session if not used elsewhere
session_destroy();
header("Location: index.php"); // Redirect to the homepage after logout
exit();
?>