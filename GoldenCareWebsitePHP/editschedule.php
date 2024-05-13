<?php
session_start();
require_once("settings.php");
require_once("auth_session.php");
check_login();
check_doctor_or_admin();

// Check if ID is provided
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $position = $_POST["position"];
    $monday = $_POST["monday"];
    $tuesday = $_POST["tuesday"];
    $wednesday = $_POST["wednesday"];
    $thursday = $_POST["thursday"];
    $friday = $_POST["friday"];
    $saturday = $_POST["saturday"];
    $sunday = $_POST["sunday"];

    // Update the schedule entry in the database
    $sql = "UPDATE schedule SET Monday='$monday', Tuesday='$tuesday', Wednesday='$wednesday', Thursday='$thursday', Friday='$friday', Saturday='$saturday', Sunday='$sunday' WHERE Position='$position'";
    if ($conn->query($sql) === TRUE) {
        // Redirect back to the schedule management page
        header("Location: schedule.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Retrieve position from query parameters
// Retrieve position from query parameters
if (isset($_GET['position'])) {
    $position = $_GET['position'];

    // Fetch schedule data from the database
    $sql = "SELECT * FROM schedule WHERE Position='$position'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $monday = $row["Monday"];
        $tuesday = $row["Tuesday"];
        $wednesday = $row["Wednesday"];
        $thursday = $row["Thursday"];
        $friday = $row["Friday"];
        $saturday = $row["Saturday"];
        $sunday = $row["Sunday"];
    } else {
        echo "No schedule found for the given position.";
        exit();
    }
} else {
    echo "Position parameter not provided.";
    exit();
}

// Fetch schedule data
$schedule = $result->fetch_assoc();

// Close the prepared statement

$conn->close();
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
                    <div class="container">
                        <h2>Edit Schedule</h2>
                        <form method="POST" action="editschedule.php">
                            <input type="hidden" name="position" value="<?php echo $position; ?>">
                            <div class="mb-3">
                                <label for="position" class="form-label">Position:</label>
                                <input type="text" class="form-control" id="position" name="position" value="<?php echo htmlspecialchars($position); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="monday" class="form-label">Monday:</label>
                                <input type="text" class="form-control" id="monday" name="monday" value="<?php echo htmlspecialchars($monday); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="tuesday" class="form-label">Tuesday:</label>
                                <input type="text" class="form-control" id="tuesday" name="tuesday" value="<?php echo htmlspecialchars($tuesday); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="wednesday" class="form-label">Wednesday:</label>
                                <input type="text" class="form-control" id="wednesday" name="wednesday" value="<?php echo htmlspecialchars($wednesday); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="thursday" class="form-label">Thursday:</label>
                                <input type="text" class="form-control" id="thursday" name="thursday" value="<?php echo htmlspecialchars($thursday); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="friday" class="form-label">Friday:</label>
                                <input type="text" class="form-control" id="friday" name="friday" value="<?php echo htmlspecialchars($friday); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="saturday" class="form-label">Saturday:</label>
                                <input type="text" class="form-control" id="saturday" name="saturday" value="<?php echo htmlspecialchars($saturday); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="sunday" class="form-label">Sunday:</label>
                                <input type="text" class="form-control" id="sunday" name="sunday" value="<?php echo htmlspecialchars($sunday); ?>" required>
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