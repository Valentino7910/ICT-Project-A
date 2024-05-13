<?php
session_start();
require_once("settings.php"); // Assuming your DB connection settings are here

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['username'])) {
    $username = $_POST['username'];

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL to delete a record from Patients table
    $sql_patients = "DELETE FROM Patients WHERE username = ?";
    $stmt_patients = $conn->prepare($sql_patients);
    $stmt_patients->bind_param("s", $username);

    // SQL to delete a record from member_login table
    $sql_member_login = "DELETE FROM member_login WHERE username = ?";
    $stmt_member_login = $conn->prepare($sql_member_login);
    $stmt_member_login->bind_param("s", $username);

    // Execute deletion queries
    if ($stmt_patients->execute() && $stmt_member_login->execute()) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $stmt_patients->error . " and " . $stmt_member_login->error;
    }

    $stmt_patients->close();
    $stmt_member_login->close();
    $conn->close();
    header("Location: membermanagement.php"); // Redirect back to the patients page
    exit();
} else {
    // Redirect them to your patients page or display an error message if the username isn't set
    header("Location: membermanagement.php");
    exit();
}
?>

