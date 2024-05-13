<?php
session_start();
require_once("auth_session.php");
check_login();
check_patient();

// Include your database connection settings
require_once("settings.php");

// Verify database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch member details from the database based on the session username
$username = $_SESSION['username'];
$sql = "SELECT * FROM patients WHERE Username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();

// Check for errors
if ($stmt->error) {
    die("Query execution error: " . $stmt->error);
}

// Get the result set
$result = $stmt->get_result();

// Check if the result set is not empty
if ($result !== false) {
    // Check if there are rows in the result set
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $firstName = $row['FirstName'];
        $lastName = $row['LastName'];
        $phoneNumber = $row['PhoneNumber'];
        $medicationRequirement = $row['MedicationRequirements'];
        $carePlans = $row['CarePlans'];
        $familyContact = $row['FamilyContacts'];
    } else {
        // Handle the case where member details are not found
        $firstName = "N/A";
        $lastName = "N/A";
        $phoneNumber = "N/A";
        $medicationRequirement = "N/A";
        $carePlans = "N/A";
        $familyContact = "N/A";
    }
} else {
    // Handle the case where the query did not return any results
    die("No results found for the specified username.");
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add New Patient</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="./style/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&family=Workbench&display=swap"
        rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="./style/second.css">
</head>

<body>
    <div class="page-container management">
        <header>
            <div class="header-content-wrapper">
                <div class="website-title-wrapper">
                    <a class="website-title logo" href="./home.html"><img src="./images/Golden_Care_logo_white.png"
                            alt="Golden Care"></a>
                </div>
                <div class="navigation-wrapper">
                    <nav>
                        <div>
                            <a href="./index.php" title="Home">
                                <button href="./index.php">Home</button>
                            </a>
                        </div>
                        <div>
                            <a href="services.php"><button href="./services.php">Services</button></a>
                        </div>
                        <div class="dropdown">
                            <a title="About Us">
                                <button>About Us</button>
                            </a>
                            <div class="dropdown-content about-us">
									<a href="about-us.php" title="About Us » Golden Care">About Us</a>
									<a href="faq.php" title="FAQ » Golden Care">FAQ</a>
									<a class="current-page" href="Staff.php" title="Staff » Golden Care">Staff</a>
								</div>
                        </div>
                        <div >
                            <a href="inventory.php"><button href="./inventory.php">Inventory</button></a>
                        </div>
                        <div class="current-page">
                            <a href="management.php"><button href="./management.php">Management</button></a>
                        </div>
                        <div id="signin">
                            <?php if (!empty($_SESSION['username'])): ?>
                            <div class="user-info-dropdown">
                                <button onclick="toggleDropdown()">Welcome,
                                    <?php echo htmlspecialchars($_SESSION['username']); ?> ▼
                                </button>
                                <ul id="userDropdown" class="dropdown-content" style="display: none;">
                                    <!--<li>Role: <span><?php echo htmlspecialchars(ucfirst($_SESSION['role'])); ?></span></li>-->
                                    <li><a href="logout.php">Logout</a></li>
                                    <?php
									if ($_SESSION['role'] === 'patient') {
                                                echo "<li><a href='memberprofile.php'>Profile</a></li>";
												}; ?>
                                                <?php
                                                if ($_SESSION['role'] === 'patient') {
                                                            echo "<li><a href='memberbooking.php'>Bookings</a></li>";
                                                            }; 
                                                ?>
                                </ul>
                            </div>
                            <?php else: ?>
                            <a href="login.php" class="nav-link"><button>Sign In / Up</button></a>
                            <?php endif; ?>
                        </div>
                    </nav>
                </div>
            </div>
        </header>
        <main>

            <div class="main-content-wrapper">
                <div class="main-column-1">
                    <div class="container mt-5">
                        <h2>Profile</h2>
                        <div>
                            <!-- Display member details -->
                            <p><strong>First Name:</strong> <?php echo $firstName; ?></p>
                            <p><strong>Last Name:</strong> <?php echo $lastName; ?></p>
                            <p><strong>Phone Number:</strong> <?php echo $phoneNumber; ?></p>
                            <p><strong>Medication Requirement:</strong> <?php echo $medicationRequirement; ?></p>
                            <p><strong>Care Plans:</strong> <?php echo $carePlans; ?></p>
                            <p><strong>Family Contact:</strong> <?php echo $familyContact; ?></p>
                        </div>
                        <div>
                            <!-- Link to edit profile -->
                            <a href="editprofile.php" class="btn btn-primary">Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer>
            <div class="footer-content-wrapper">
                <div class="footer-divider">
                </div>
                <div class="footer-bottom-wrapper">
                    <div class="footer-bottom-left-wrapper">
                        <a class="footer-title logo" href="./home.html"><img src="./images/Golden_Care_logo_white.png"
                                alt="Golden Care"></a>
                    </div>
                    <div class="footer-bottom-centre-wrapper">
                        <p>123-456-7890</p>
                        <p>GoldenCare@swinburne.edu</p>
                    </div>
                    <div class="footer-bottom-right-wrapper">
                        <p>Melbourne VIC, Australia</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- Include Bootstrap JS -->
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
	<script src="./js/dropdown.js"></script>
</body>