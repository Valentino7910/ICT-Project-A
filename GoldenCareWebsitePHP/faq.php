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
		<title>FAQ » Golden Care</title>
		<link type="text/css" rel="stylesheet" href="./style/style.css">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="./style/second.css">
	</head>
	<body>
		<div class="page-container faq">
			<header>
				<div class="header-content-wrapper">
					<div class="website-title-wrapper">
						<a class="website-title logo" href="./home.html"><img src="./images/Golden_Care_logo_white.png" alt="Golden Care"></a>
					</div>
					<div class="navigation-wrapper">
						<nav>
							<div>
								<a href="index.php" title="Home">
									<button href="./index.php">Home</button>
								</a>
							</div>
							<div>
								<a href="services.php">
									<button href="./services.php">Services</button>
								</a>
							</div>
							<div class="dropdown current-page">
								<a title="About Us">
									<button>About Us</button>
								</a>
								<div class="dropdown-content about-us">
									<a href="./about-us.php" title="About Us » Golden Care">About Us</a>
									<a class="current-page" href="./faq.php" title="FAQ » Golden Care">FAQ</a>
									<a href="./Staff.php" title="Staff » Golden Care">Staff</a>
								</div>
							</div>
							<div>
								<a href="inventory.php">
									<button href="./inventory.php">Inventory</button>
								</a>
							</div>
							<div>
								<a href="management.php">
									<button href="./management.php">Management</button>
								</a>
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
			<aside>
				<div class="aside-content-wrapper">
					<div class="aside-column-1">
						<section>
							<h1>Why should I use Golden Care?</h1>
							<p>Here at Golden Care we are dedicated to providing the smoothest seamless customer service. By using industry leading developers, we have created a service that anyone can use. We at Golden Care understand that aged care is complicated and nuanced, with different needs for each person, so we have taken the complexity out of the equation and simplified the care process, so that you can focus on the Care.</p>
						</section>
					</div>
					<div class="aside-column-2">
						<section>
							<h1>How can I get started?</h1>
							<p>To start providing a Golden standard of Care, simply email us with an inquiry at GoldenCare@swinburne.edu or give us a call on 123-456-7890 the process is simple and efficient!</p>
						</section>
					</div>
					<div class="aside-column-3">
						<section>
							<h1>Are there any medications this software is unsuited to support?</h1>
							<p>Any medications that rely on a physical blood test reading or similar, must be handled carefully given that the software operates on a timed and preset schedule. Medications that are regularly scheduled are suitable for use.</p>
						</section>
					</div>
					<div class="aside-column-4">
						<section>
							<h1>Where can I get training?</h1>
							<p>Upon subscription to our services you will be provided with a training video demonstarating the various features and facilities our software offers. This will also be backed up by 1 on 1 support at any of our contacts if you need further explanations.</p>
						</section>
					</div>
					<div class="aside-column-5">
						<section>
							<h1>Where can I get technical support with a website issue?</h1>
							<p>If you discover any issues or bugs please reach out to us at GoldenCare@swinburne.edu or give us a call on 123-456-7890</p>
						</section>
					</div>
				</div>
			</aside>
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