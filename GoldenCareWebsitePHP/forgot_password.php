<?php
session_start();
require_once("settings.php"); // Include your DB settings

$errorMessage = "";
$userExists = false;
$questionsLoaded = false;

// Database connection

if (isset($_POST['submitUsername'])) {
    // Check if the username exists
    $username = $_POST['username'];
    $stmt = $conn->prepare("SELECT username, security_question1, security_answer1, security_question2, security_answer2 FROM member_login WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $userExists = true;
        $row = $result->fetch_assoc();
        $_SESSION['security_question1'] = $row['security_question1'];
        $_SESSION['security_answer1'] = $row['security_answer1'];  // Store the security answer in session
        $_SESSION['security_question2'] = $row['security_question2'];
        $_SESSION['security_answer2'] = $row['security_answer2'];  // Store the security answer in session
        $_SESSION['reset_username'] = $username; // Store username in session to use in the next step
        $questionsLoaded = true;
    } else {
        $errorMessage = "No account found with that username.";
    }
    $stmt->close();
}

if (isset($_POST['submitAnswers'])) {
    if (isset($_SESSION['security_answer1'], $_SESSION['security_answer2']) && 
        $_POST['answer1'] === $_SESSION['security_answer1'] && 
        $_POST['answer2'] === $_SESSION['security_answer2']) {
        // Redirect to reset password page
        header("Location: reset_password.php");
        exit();
    } else {
        $errorMessage = "Incorrect answers. Please try again.";
    }
}

$conn->close();
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
		<title>Forgot Password » Golden Care</title>
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
		<div class="page-container forgot-password">
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
									<a class=".current-page" href="about-us.php" title="About Us » Golden Care">About Us</a>
									<a href="faq.php" title="FAQ » Golden Care">FAQ</a>
									<a href="Staff.php" title="Staff » Golden Care">Staff</a>
								</div>
							</div>
							<div>
								<a href="inventory.php">
									<button title="Inventory » Golden Care">Inventory</button>
								</a>
							</div>
							<div>
								<a href="management.php">
									<button title="Management » Golden Care">Management</button>
								</a>
							</div>
							<div id="signin" class="current-page">
								<?php if (!empty($_SESSION['username'])): ?>
									<div class="user-info-dropdown">
										<button onclick="toggleDropdown()">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?> ▼</button>
										<ul id="userDropdown" class="dropdown-content" style="display: none;">
											<!--<li>Role: <span><?php echo htmlspecialchars(ucfirst($_SESSION['role'])); ?></span></li>-->
											<li><a href="logout.php">Logout</a></li>
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
							<h1>Forgot Password</h1>
							<?php if ($errorMessage) echo "<p style='color:red;'>$errorMessage</p>"; ?>
							<?php if (!$questionsLoaded): ?>
								<form action="" method="post">
									<div class="form-group">
										<label for="username">Enter your username:</label>
										<input type="text" id="username" name="username" required>
									</div>
									<div class="form-group">
										<button type="submit" name="submitUsername" class="btn btn-primary">Submit</button>
									</div>
								</form>
							<?php else: ?>
								<form action="" method="post">
									<div class="form-group">
										<label><?php echo $_SESSION['security_question1']; ?></label>
										<input type="text" name="answer1" required>
									</div>
									<div class="form-group">
										<label><?php echo $_SESSION['security_question2']; ?></label>
										<input type="text" name="answer2" required>
									</div>
									<div class="form-group">
										<button type="submit" name="submitAnswers" class="btn btn-primary">Submit Answers</button>
									</div>
								</form>
							<?php endif; ?>
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