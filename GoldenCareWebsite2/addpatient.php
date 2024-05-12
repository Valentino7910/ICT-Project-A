<?php
session_start();
require_once("auth_session.php");
check_login();
check_admin();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection settings
    require_once("settings.php");

    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $phoneNumber = trim($_POST['phoneNumber']);
    $carePlans = trim($_POST['carePlans']);
    $medicationRequirements = trim($_POST['medicationRequirements']);
    $familyContacts = trim($_POST['familyContacts']);
    $username = trim($_POST['username']);
    $password = '123'; // Default password

    $errors = [];

    // Validate first name
    if (empty($firstName)) {
        $errors[] = "First name is required.";
    }

    // Validate last name
    if (empty($lastName)) {
        $errors[] = "Last name is required.";
    }

    // Validate phone number (basic validation for demonstration)
    if (empty($phoneNumber)) {
        $errors[] = "Phone number is required.";
    } elseif (!preg_match("/^\d{10}$/", $phoneNumber)) {
        $errors[] = "Invalid phone number format.";
    }

    // Check if username already exists
    $stmt_check_username = $conn->prepare("SELECT * FROM member_login WHERE username = ?");
    $stmt_check_username->bind_param("s", $username);
    $stmt_check_username->execute();
    $result_check_username = $stmt_check_username->get_result();

    if ($result_check_username->num_rows > 0) {
        $errors[] = "Username already exists.";
    }

    // If no errors, proceed with database insertion
    if (empty($errors)) {

        // Prepare and bind the insertion query for Patients table
        $stmt1 = $conn->prepare("INSERT INTO Patients (FirstName, LastName, PhoneNumber, CarePlans, MedicationRequirements, FamilyContacts, Username) 
                                VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt1->bind_param("sssssss", $firstName, $lastName, $phoneNumber, $carePlans, $medicationRequirements, $familyContacts, $username);

        // Execute the Patients table insertion query
        if ($stmt1->execute()) {

            // Prepare and bind the insertion query for member_login table
            $stmt2 = $conn->prepare("INSERT INTO member_login (username, password, permission, security_question1, security_answer1, security_question2, security_answer2) 
                                    VALUES (?, ?, 'patient', 'What city were you born in?', '123', 'What is the name of your first school?', '123')");
            $stmt2->bind_param("ss", $username, $password);

            // Execute the member_login table insertion query
            if ($stmt2->execute()) {
                echo "New record created successfully";
                header("Location: membermanagement.php"); // Redirect to the patients page after successful insertion
                exit();
            } else {
                echo "Error inserting into member_login table: " . $stmt2->error;
            }
        } else {
            echo "Error inserting into Patients table: " . $stmt1->error;
        }

        $stmt1->close();
        $stmt2->close();
        $conn->close();
    } else {
        foreach ($errors as $error) {
            echo "<p>Error: $error</p>";
        }
    }
}
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
    <div class="page-container home">
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

                                <a href="./faq.php" title="FAQ » Golden Care">FAQ</a>
                                <a href="./Staff.php" title="Staff » Golden Care">Staff</a>
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
														}; 
										?>
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
                        <h2>Add New Patient</h2>
                        <form action="addpatient.php" method="post">
                            <div class="mb-3">
                                <label for="firstName" class="form-label">First Name:</label>
                                <input type="text" class="form-control" id="firstName" name="firstName" required>
                            </div>
                            <div class="mb-3">
                                <label for="lastName" class="form-label">Last Name:</label>
                                <input type="text" class="form-control" id="lastName" name="lastName" required>
                            </div>
                            <div class="mb-3">
                                <label for="phoneNumber" class="form-label">Phone Number:</label>
                                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" required>
                            </div>
                            <div class="mb-3">
                                <label for="carePlans" class="form-label">Care Plans:</label>
                                <select class="form-control" id="carePlans" name="carePlans">
                                    <option value="basic">Basic</option>
                                    <option value="regular">Regular</option>
                                    <option value="premium">Premium</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="medicationRequirements" class="form-label">Medication Requirements:</label>
                                <input type="text" class="form-control" id="medicationRequirements"
                                    name="medicationRequirements">
                            </div>
                            <div class="mb-3">
                                <label for="familyContacts" class="form-label">Family Contacts:</label>
                                <input type="text" class="form-control" id="familyContacts" name="familyContacts">
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Patient</button>
                        </form>

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