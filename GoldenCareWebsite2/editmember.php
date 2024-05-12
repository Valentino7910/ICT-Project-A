<?php
session_start();
require_once("auth_session.php");
check_login();
check_admin();

// Include your database connection settings
require_once("settings.php");

// Initialize variables for form inputs
$firstName = $lastName = $phoneNumber = $medicationRequirement = $carePlans = $familyContact = "";

// Fetch patient's data from the database if form is not submitted
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    $username = $_GET['username']; // Get the username from the URL parameter
    $sql = "SELECT * FROM patients WHERE Username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $firstName = $row['FirstName'];
        $lastName = $row['LastName'];
        $phoneNumber = $row['PhoneNumber'];
        $medicationRequirement = $row['MedicationRequirements'];
        $carePlans = $row['CarePlans'];
        $familyContact = $row['FamilyContacts'];
    }

    $stmt->close();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $phoneNumber = $_POST['phoneNumber'];
    $medicationRequirement = $_POST['medicationRequirement'];
    $carePlans = $_POST['carePlans'];
    $familyContact = $_POST['familyContact'];

    // Update the profile details in the database
    $username = $_GET['username']; // Get the username from the URL parameter
    $sql = "UPDATE patients SET FirstName=?, LastName=?, PhoneNumber=?, MedicationRequirements=?, CarePlans=?, FamilyContacts=? WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $firstName, $lastName, $phoneNumber, $medicationRequirement, $carePlans, $familyContact, $username);

    if ($stmt->execute()) {
        // Redirect to profile page after successful update
        header("Location: membermanagement.php"); // Pass the username as a URL parameter
        exit();
    } else {
        // Handle error
        $errorMsg = "Error updating profile: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="description" content="Welcome to the home page of Golden Care.">
	<title>Golden Care</title>
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
						<div class="current-page">
                             <a href="inventory.php"><button href="./inventory.php">Inventory</button></a>
						</div>
						<div>
							<a href="management.php"><button href="./management.php">Management</button></a>
						</div>
						<div id="signin">
							<?php if (!empty($_SESSION['username'])): ?>
								<div class="user-info-dropdown">
									<button onclick="toggleDropdown()">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?> ▼</button>
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
                        <h2>Edit Profile</h2>
                        <!-- Display error message if there is one -->
                        <?php if (isset($errorMsg)) : ?>
                            <div class="alert alert-danger"><?php echo $errorMsg; ?></div>
                        <?php endif; ?>
                        <!-- Profile edit form -->
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?username=<?php echo $_GET['username']; ?>" method="post">

                            <div class="mb-3">
                                <label for="firstName" class="form-label">First Name:</label>
                                <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $firstName; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="lastName" class="form-label">Last Name:</label>
                                <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $lastName; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="phoneNumber" class="form-label">Phone Number:</label>
                                <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="<?php echo $phoneNumber; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="medicationRequirement" class="form-label">Medication Requirement:</label>
                                <input type="text" class="form-control" id="medicationRequirement" name="medicationRequirement" value="<?php echo $medicationRequirement; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="carePlans" class="form-label">Care Plans:</label>
                                <select class="form-control" id="carePlans" name="carePlans" required>
                                    <option value="Basic" <?php echo ($carePlans == 'Basic') ? 'selected' : ''; ?>>Basic</option>
                                    <option value="Regular" <?php echo ($carePlans == 'Regular') ? 'selected' : ''; ?>>Regular</option>
                                    <option value="Premium" <?php echo ($carePlans == 'Premium') ? 'selected' : ''; ?>>Premium</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="familyContact" class="form-label">Family Contact:</label>
                                <input type="text" class="form-control" id="familyContact" name="familyContact" value="<?php echo $familyContact; ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
	<script src="./js/dropdown.js"></script>
</body>

</html>