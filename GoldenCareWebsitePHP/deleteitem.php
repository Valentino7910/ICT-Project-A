<?php
session_start();
require_once("settings.php"); // assuming your DB connection settings are here

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['id'])) {
    $itemId = intval($_POST['id']);

    // Create connection
   
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL to delete a record
    $sql = "DELETE FROM inventory WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $itemId);

    if ($stmt->execute()) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    header("Location: inventory.php"); // Redirect back to the inventory page
    exit();
} else {
    // Redirect them to your inventory page or display an error message if the ID isn't set
    header("Location: inventory.php");
    exit();
}
?>