<?php 
    session_start();
    require_once("settings.php");
	require_once("auth_session.php");
	check_login();
	check_patient();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="description" content="Welcome to the services of Golden Care.">
	<title>Services » Golden Care</title>
	<link type="text/css" rel="stylesheet" href="./style/style.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link
		href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&family=Workbench&display=swap"
		rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="./style/second.css">
	<style>
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        main {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            /* Aligns the items in the center */
            align-items: center;
            height: 100%;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            width: 300px;
            padding: 20px;
            background-color: #f2f2f2;
            border-radius: 5px;
            
        }

        label {
            margin-top: 10px;
            font-weight: bold;
            justify-content: center;
        }

        input[type="text"], input[type="email"], input[type="tel"], input[type="date"], input[type="time"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button[type="submit"] {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        #calendar {
            margin-top: 20px;
            width: 100%;
            height: 400px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .container {
            padding: 16px;
        }

        .button {
            border: none;
            outline: 0;
            padding: 12px;
            color: white;
            background-color: #000;
            text-align: center;
            cursor: pointer;
            width: 100%;
            font-size: 18px;
        }

        .button:hover {
            background-color: #555;
        }
    </style>
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
						<div class="current-page">
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
		<form action="booking.php" method="post">
            <label for="name">Name:</label>
            <input type="text" name="name" required>
            <br>
            <label for="email">Email:</label>
            <input type="email" name="email" required>
            <br>
            <label for="phone">Phone Number:</label>
            <input type="tel" name="phone" required>
            <br>
            <label for="date">Date:</label>
            <input type="date" name="date" required>
            <br>
            <label for="time">Time:</label>
            <input type="time" name="time" required>
            <br>
            <label for="service_type">Service Type:</label>
            <select name="service_type" required>
            <option value="Consultation" selected>Consultation</option>
            <option value="homecare" selected>Home Care</option>
            <option value="facility" selected>Facility </option>
            </select>
            <button type="submit">Book Now</button>
        </form>

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