<!DOCTYPE html>
<html>
<head>
    <title>Booking Status</title>
    <style>
        .success-message {
            color: green;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <?php
    session_start();
    include 'settings.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $service_type = $_POST['service_type'];
        $username = $_SESSION['username'];

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO bookings (name, email, phone, date, time, service_type, username) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $name, $email, $phone, $date, $time, $service_type, $username);

        if ($stmt->execute() === TRUE) {
            echo "<div class='success-message'>Booking successful! Redirecting to booking details...</div>";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
    ?>
    <script>
        setTimeout(function() {
            window.location.href = 'memberbooking.php';
        }, 3000); // 3 seconds
    </script>
</body>
</html>

