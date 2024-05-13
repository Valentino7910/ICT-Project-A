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
		<meta name="description"
			content="Welcome to a post about My Hobbies! This digital space is a place for me to share things that have happened in my life.">
		<title>About Us » Golden Care</title>
		<link type="text/css" rel="stylesheet" href="./style/style.css">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="./style/second.css">
	</head>
	<body>
		<div class="page-container about-us">
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
							<div class="dropdown current-page">
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
						<article>
							<h1>About Us</h1>
							<p>Welcome to Golden Care, a leading provider of innovative aged care software solutions based in Victoria, Australia. Our mission is to empower aged care providers with cutting-edge technology to streamline operations, enhance resident care, and optimize outcomes. With a deep understanding of the unique challenges facing the aged care industry, we have developed a comprehensive suite of software solutions tailored to meet the evolving needs of our clients.</p>
							<p>At Golden Care, we are committed to revolutionizing the way aged care facilities operate by offering intuitive and customizable software that improves efficiency, transparency, and compliance. From electronic health records and medication management to scheduling and resident engagement platforms, our solutions are designed to simplify workflows and elevate the standard of care. With a dedicated team of experts who are passionate about leveraging technology to make a positive impact, Golden Care is proud to be your trusted partner in navigating the complexities of aged care management.</p>
						</article>
					</div>
					<div class="main-column-2">
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