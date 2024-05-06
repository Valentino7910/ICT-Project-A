<?php
// Start a session
session_start();

// Include database configuration
require_once 'settings.php';

$message = ''; // Message to display to the user

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];  // Storing password as plain text (not secure, should use hashing)
    $role = 'patient';  // Capture the role from the form

    // Security questions and answers
    $security_question1 = $_POST['security_question1'];
    $security_answer1 = $_POST['security_answer1'];
    $security_question2 = $_POST['security_question2'];
    $security_answer2 = $_POST['security_answer2'];

    // Establish a database connection

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the username already exists
    $stmt = $conn->prepare("SELECT member_id FROM member_login WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $message = "This username is already taken. Please choose another.";
    } else {
        // Username does not exist, proceed with registration
        $stmt = $conn->prepare("INSERT INTO member_login (username, password, permission, security_question1, security_answer1, security_question2, security_answer2) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $username, $password, $role, $security_question1, $security_answer1, $security_question2, $security_answer2);

        if ($stmt->execute()) {
            $message = "User registered successfully! You will be redirected to the login page in 5 seconds...";
            echo '<script>
                    setTimeout(function() {
                        window.location.href = "login.php";
                    }, 5000);
                </script>';
        } else {
            $message = "Error: " . $stmt->error;
        }
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
	<style>
		.form-label {
    font-weight: bold;
    color: #333;
    display: block;
    margin-bottom: 5px;
}

.form-control, .form-select {
    width: 100%;
    padding: 8px 12px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    display: block;
}

.form-control:focus, .form-select:focus {
    border-color: #80bdff;
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
}

/* Specific styling for security questions /
.security-questions {
    background-color: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.security-questions h2 {
    color: #004085;
}

/ Updated button styles */
.button {
    border: none;
    outline: 0;
    display: inline-block;
    padding: 10px 16px;
    color: white;
    background-color: #007bff;
    text-align: center;
    cursor: pointer;
    width: 100%;
    transition: background-color 0.3s ease;
}

.button:hover {
    background-color: #0056b3;
}
	</style>
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
							<div class="dropdown-content services-and-facilities">
							
								<a href="./faq.php" title="FAQ » Golden Care">FAQ</a>
								<a href="./Staff.php" title="Staff » Golden Care">Staff</a>
							</div>
						</div>
						<div>
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
                        <h2>Sign Up Form</h2>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
							
							<div class="mb-3">
								<label for="security_question1" class="form-label">Security Question 1:</label>
								<select class="form-select" id="security_question1" name="security_question1" required>
									<option value="What city were you born in?">What city were you born in?</option>
								</select>
							</div>
							<div class="mb-3">
								<label for="security_answer1" class="form-label">Answer:</label>
								<input type="text" class="form-control" id="security_answer1" name="security_answer1" required>
								<br>
							</div>

							<div class="mb-3">
								<label for="security_question2" class="form-label">Security Question 2:</label>
								<select class="form-select" id="security_question2" name="security_question2" required>
									<option value="What is the name of your first school?">What is the name of your first school?</option>
								</select>
							</div>
							<div class="mb-3">
								<label for="security_answer2" class="form-label">Answer:</label>
								<input type="text" class="form-control" id="security_answer2" name="security_answer2" required>
							</div>
                            <button type="submit" class="btn btn-primary">Sign Up</button>
                        </form>
                        <?php if ($message): ?>
                        <p class="alert alert-info"><?php echo $message; ?></p>
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
</body>

</html>