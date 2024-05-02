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
	<meta name="description" content="Welcome to the home page of Golden Care.">
	<title>Golden Care</title>
	<link type="text/css" rel="stylesheet" href="./style/style.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link
		href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&family=Workbench&display=swap"
		rel="stylesheet">
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
						<div class="current-page">
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
								<a href="./about-us.php" title="About Us » Golden Care">About Us</a>
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
						<div>
							<a title="Sign In » Golden Care">
								<?php if (!empty($_SESSION['username'])): ?>
								<a href="logout.php" class="nav-link"><button href="./logout.php">Logout</button></a>
								<?php else: ?>
								<a href="login.php" class="nav-link"><button href="./login.php">SignIn</button></a>
								<?php endif; ?>
							</a>
						</div>
					</nav>
				</div>
			</div>
		</header>
		<main>
			<div class="main-content-wrapper">
				<div class="main-column-1">
					<p>
						Golden Care is a leading provider of comprehensive software solutions designed specifically for
						aged care service providers. With a deep understanding of the unique challenges faced by elderly
						individuals and the caregivers who support them, we are committed to improving the quality of
						life for seniors while streamlining operations for care providers.</p>
					<p>
						<a href="https://jigsaw.w3.org/css-validator/validator?lang=en&profile=css3&uri=https%3A%2F%2Ffiledn.eu%2FlbqCW257GRj043bNgoWd8QS%2Fhome.html"
							target="_blank" rel="noopener noreferrer">
							<img style="border:0;width:88px;height:31px"
								src="http://jigsaw.w3.org/css-validator/images/vcss-blue" alt="Valid CSS!">
						</a>
					</p>
				</div>
				<div class="main-column-2">
					<img id="sleepycat3" class="images" src="./images/sleepycat3.jpg" alt="Image of a sleeping cat.">
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
</body>

</html>