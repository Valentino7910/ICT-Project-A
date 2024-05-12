<?php
session_start();
require_once("settings.php"); // Include your database connection settings

$errormsg = [];

if (isset($_POST["submit"])) {
    // Validate the user input
    if (empty($_POST["username"])) {
        $errormsg[] = "Username cannot be empty <br>";
    }

    if (empty($_POST["password"])) {
        $errormsg[] = "Password cannot be empty <br>";
    }

    if (empty($errormsg)) {
        // Sanitize input
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        // Establish a database connection
        // $conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName); // Uncomment and set parameters accordingly

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if the username exists in the database
        $query = "SELECT * FROM member_login WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $dbPassword = $row["password"];
            $dbRole = $row["permission"]; // Fetching the role
            
            // Verify password
            if ($password === $dbPassword) {
                // Set session variables
                $_SESSION["username"] = $username;
                $_SESSION["role"] = $dbRole; // Setting the role in session
                $_SESSION["loginstatus"] = "logout";
                
                // Redirect to another page (e.g., dashboard.php)
                header("Location: index.php");
                exit();
            } else {
                $errormsg[] = "Incorrect password <br>";
            }
        } else {
            $errormsg[] = "Username not found <br>";
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
		<title>Login » Golden Care</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
		<link type="text/css" rel="stylesheet" href="./style/style.css">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="./style/second.css">
	</head>
	<body>
		<div class="page-container login">
			<header>
				<div class="header-content-wrapper">
					<div class="website-title-wrapper">
						<a class="website-title logo" href="./index.php"><img src="./images/Golden_Care_logo_white.png"
								alt="Golden Care"></a>
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
						<div class="container center">
							<h1>Sign In</h1>
							<form method="post" action="login.php" class="mt-4">
								<div class="form-group">
									<label for="username">Username</label>
									<input type="text" class="form-control" id="username" name="username"
										value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
								</div>
								<div class="form-group">
									<label for="password">Password</label>
									<input type="password" class="form-control" id="password" name="password">
								</div>
								<button type="submit" class="btn btn-primary" name="submit">Login</button>
								<button type="reset" class="btn btn-secondary">Clear</button>
								<a href="forgot_password.php" class="btn btn-link">Forgot Password?</a>
							</form>
							<?php
								// Show error messages
								if (!empty($errormsg)) {
									echo "<div class='alert alert-danger mt-4' role='alert'>";
									echo "<h4 class='alert-heading'>Please correct the following errors:</h4>";
									echo "<ul>";
									foreach ($errormsg as $message) {
										echo "<li>$message</li>";
									}
									echo "</ul>";
									echo "</div>";
								}
								?>
							<div class="mt-4 text-center">
								<a href="index.php" class="btn btn-primary ml-2">Home</a>
						
								<a href="signup.php" class="btn btn-primary">Sign Up</a>
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
							<a class="footer-title logo" href="./index.php"><img src="./images/Golden_Care_logo_white.png"
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