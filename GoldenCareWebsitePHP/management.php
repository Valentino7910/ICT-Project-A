<?php 
    session_start();
    require_once("settings.php");
    require_once("auth_session.php");
    check_login();
	check_doctor_or_admin();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<meta name="description" content="Welcome to the home page of Golden Care.">
		<title>Management » Golden Care</title>
		<link rel="stylesheet" href="./style/managementstyle.css">
		<link type="text/css" rel="stylesheet" href="./style/style.css">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="./style/second.css">
	</head>
	<body>
		<div class="page-container management">
			<header>
				<div class="header-content-wrapper">
					<div class="website-title-wrapper">
						<a class="website-title logo" href="./index.php"><img src="./images/Golden_Care_logo_white.png" alt="Golden Care"></a>
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
							<div class="current-page">
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
			<div class="management-header">
				<h2>Manage anything you want efficiently on this page</h2>
			</div>
			<main>
				<section>
				<div class="card">
					<img src="images/boxes.jpg" alt="Inventory">
					<h2>Member Management</h2>
                        <a href="membermanagement.php"><button href="inventory.php">Edit</button></a>
				</div>
				<div class="card">
					<img src="images/staff.png" alt="Staff Management">
					<h2>Schedule</h2>
                    <a href="schedule.php"><button href="schedule.php">Edit</button></a>
				</div>
				<div class="card">
					<img src="images/Bookings.png" alt="Services">
					<h2>Services Management</h2>
                        <a href="bookingmanagement.php"><button href="bookingmanagement.php">Edit</button></a>
				</div>
				</section>
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