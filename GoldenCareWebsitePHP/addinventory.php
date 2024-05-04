<?php
session_start();
require_once("auth_session.php");
check_login();
check_admin();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection settings
    require_once("settings.php");

    $name = trim($_POST['itemName']);
    $isAvailable = $_POST['isAvailable'];
    $maxStock = $_POST['maxStock'];

    $errors = [];

    // Validate name
    if (empty($name)) {
        $errors[] = "Name is required.";
    } elseif (!preg_match("/^[a-zA-Z0-9\s]+$/", $name)) {
        $errors[] = "Name must be alphanumeric and spaces only.";
    }

    // Validate availability
    if (empty($isAvailable)) {
        $errors[] = "Availability is required.";
    } elseif (!in_array($isAvailable, ['Yes', 'No'])) {
        $errors[] = "Invalid availability value.";
    }

    // Validate max stock
    if ($maxStock === '') {
        $errors[] = "Max stock is required.";
    } elseif (!is_numeric($maxStock) || (int)$maxStock < 0) {
        $errors[] = "Max stock must be a non-negative number.";
    }

    // If no errors, proceed with database insertion
    if (empty($errors)) {

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO inventory (name, is_available, max_stock) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $name, $isAvailable, $maxStock);

        // Set parameters and execute
        if ($stmt->execute()) {
            echo "New record created successfully";
            header("Location: inventory.php"); // Redirect to the inventory page after successful insertion
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
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
							<div class="dropdown-content services-and-facilities">
								
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
										<li>Role: <span><?php echo htmlspecialchars(ucfirst($_SESSION['role'])); ?></span></li>
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
                        <h2>Add New Inventory Item</h2>
                        <form action="addinventory.php" method="post">
                            <div class="mb-3">
                                <label for="itemName" class="form-label">Name:</label>
                                <input type="text" class="form-control" id="itemName" name="itemName" required>
                            </div>
                            <div class="mb-3">
                                <label for="isAvailable" class="form-label">Is Available (Yes/No):</label>
                                <select class="form-control" id="isAvailable" name="isAvailable" required>
                                    <option value="">Select an option</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="maxStock" class="form-label">Max Stock:</label>
                                <input type="number" class="form-control" id="maxStock" name="maxStock" required min="0">
                            </div>
                            <button type="submit" class="btn btn-primary">Add Item</button>
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