<?php 
    session_start();
    require_once("settings.php");

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
		<link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="./style/second.css">
		<style>
			main {
				background-color: unset;
			}
	
			.cards {
				display: flex;
				flex-wrap: wrap;
				justify-content: center;
				/* Aligns the items in the center */
				padding: 10px;
				gap: 50px;
				/* Controls the gap between the cards */
			}
	
			.card {
				box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
				width: 295px;
				/* Uniform width for all cards */
				margin: 10px;
				text-align: center;
				font-family: 'Arial', sans-serif;
				border-radius: 10px;
				overflow: hidden;
				background-color: #219ebc;
				/* Set the background color */
			}
	
			.card img {
				width: 100%;
				height: auto;
			}
	
			.container {
				padding: 16px;
			}
	
			.container p {
			color: #fff; /* Dark gray color for better readability */
			font-size: 16px; /* Optional: Adjust font size for better readability */
			}
	
			.button {
				border: none;
				outline: 0;
				padding: 12px;
				color: white;
				background-color: #fb8500;
				text-align: center;
				cursor: pointer;
				width: 100%;
				font-size: 18px;
				margin-top: 20px;
			}
	
			.button:hover {
				background-color: #ffb703;
			}
	
			a {
				text-decoration: none;
			}
		</style>
	</head>
	<body>
		<div class="page-container services">
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
							<div class="current-page">
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
						<h1 class="no-margin">Services</h1>
					</div>
					<div class="main-column-2">
						<div class="cards">
							<div class="card">
								<img src="https://static.wixstatic.com/media/7992be_56615374de2a4c7b8e7533409880e7d8~mv2.jpg" alt="Consultation">
								<div class="container">
									<h4><b>Consultation</b></h4>
									<p>30 minutes session with our staff for any mental health need</p>
									
									<button class="button" href="homecare.php"><a href="homecare.php">Book Now</a></button>
								</div>
							</div>
							<div class="card">
								<img src="https://static.wixstatic.com/media/7992be_f036b23331ae4941aa9d99ddbf325e58~mv2.jpg" alt="Home Care">
								<div class="container">
									<h4><b>Home Care</b></h4>
									<p>Home care service provides personalized assistance in individuals' homes, supporting their needs and promoting independence</p>
									<button class="button" href="homecare.php"><a href="homecare.php">Book Now</a></button>
								</div>
							</div>
							<div class="card">
								<img src="https://static.wixstatic.com/media/7992be_02a2ece2b5b74390a54f3dcb4fee0b54~mv2.jpg" alt="Facility">
								<div class="container">
									<h4><b>Facility</b></h4>
									<p>Booking facility services for patient with special needs.</p>
									<button class="button" href="homecare.php"><a href="homecare.php">Book Now</a></button>
								</div>
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
	</body>
</html>