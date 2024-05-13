<?php
session_start();
require_once("settings.php"); // Include your database connection settings

if (!isset($_SESSION['reset_username'])) {
    // If there's no username in session redirect back to login or forgot password page
    header("Location: login.php");
    exit();
}

$errorMessage = "";
$successMessage = "";

if (isset($_POST['submitPassword'])) {
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($newPassword !== $confirmPassword) {
        $errorMessage = "Passwords do not match.";
    } else {
        // Establish a database connection
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Update the user's password
        $stmt = $conn->prepare("UPDATE member_login SET password = ? WHERE username = ?");
        $stmt->bind_param("ss", $newPassword, $_SESSION['reset_username']); // Consider hashing the password

        if ($stmt->execute()) {
            $successMessage = "Password successfully updated.";
            unset($_SESSION['reset_username']); // Clear the session
        
            // Prepare JavaScript for a timed redirect
            $redirectScript = "<script>setTimeout(function() { window.location.href = 'login.php'; }, 5000);</script>";
        } else {
            $errorMessage = "Error updating password: " . $stmt->error;
        }
        

        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<meta name="description" content="Welcome to the home page of Golden Care.">
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />
		<title>Reset Password » Golden Care</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
		<link type="text/css" rel="stylesheet" href="./style/style.css">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="./style/second.css">
		<style>
			.form-group {
				margin-bottom: 15px;  /* Adds space below each form group */
			}

			input[type="text"], input[type="password"] {
				width: 100%;         /* Ensures inputs take up the full width of their container */
				padding: 8px;        /* Adds padding inside the input fields for better readability */
				box-sizing: border-box; /* Ensures padding does not affect the overall width */
			}
		</style>
	</head>
	<body>
		<div class="page-container reset-password">
			<header>
				<div class="header-content-wrapper">
					<div class="website-title-wrapper">
						<a class="website-title logo" href="./home.html"><img src="./images/Golden_Care_logo_white.png" alt="Golden Care"></a>
					</div>
					<div class="navigation-wrapper">
						<nav>
							<div>
								<a href="index.php" title="Home">
									<button>Home</button>
								</a>
							</div>
							<div>
								<a href="services.php" title="Services » Golden Care">
									<button>Services</button>
								</a>
							</div>
							<div class="dropdown">
								<a title="About Us">
									<button>About Us</button>
								</a>
								<div class="dropdown-content about-us">
									<a href="about-us.php" title="About Us » Golden Care">About Us</a>
									<a href="faq.php" title="FAQ » Golden Care">FAQ</a>
									<a href="Staff.php" title="Staff » Golden Care">Staff</a>
								</div>
							</div>
							<div>
								<a href="inventory.php" title="Inventory » Golden Care">
									<button>Inventory</button>
								</a>
							</div>
							<div>
								<a href="management.php" title="Management » Golden Care">
									<button>Management</button>
								</a>
							</div>
							<div id="signin" class="current-page">
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
									<a href="login.php" class="nav-link" title="Sign In / Up » Golden Care"><button>Sign In / Up</button></a>
								<?php endif; ?>
							</div>
						</nav>
					</div>
				</div>
			</header>
			<main>
				<div class="main-content-wrapper">
					<div class="main-column-1">
						<div>
							<h2>Reset Your Password</h2>
							<?php if ($errorMessage) echo "<p style='color:red;'>$errorMessage</p>"; ?>
							<?php if (!empty($successMessage)): ?>
								<p style='color:green;'><?php echo $successMessage; ?></p>
								<?php echo $redirectScript; // This prints the <script> tag for redirection ?>
							<?php endif; ?>
							<form action="reset_password.php" method="post">
								<div class="form-group">
									<label for="newPassword">New Password:</label>
									<input type="password" id="newPassword" name="newPassword" required>
								</div>
								<div class="form-group">
									<label for="confirmPassword">Confirm New Password:</label>
									<input type="password" id="confirmPassword" name="confirmPassword" required>
								</div>
								<div class="form-group">
									<button type="submit" name="submitPassword" class="btn btn-primary">Update Password</button>
								</div>
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
		<script src="./js/dropdown.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	</body>
</html>
