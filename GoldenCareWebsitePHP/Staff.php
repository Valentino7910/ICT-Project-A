<?php 
    session_start();
    require_once("settings.php");

?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title>Staff</title>
		<link type="text/css" rel="stylesheet" href="./style/style.css">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link
			href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&family=Workbench&display=swap"
			rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="./style/second.css">
		<style>


		</style>

	</head>


	<body>
		<div class="page">
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
							<div class="dropdown current-page">
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
			<h1>Meet the Team</h1>


			<div class="Staff">
				<div class="column">
					<div class="ID">
						<img src="images/Animated Nerd.png" alt="Byron Dallas" style="width: 100%">
						<div class="container">
							<h2>Byron Dallas</h2>
							<p class="role">Administrator</p>
							<p><button class="button">Contact</button></p>






						</div>

					</div>
				</div>


				<div class="column">
					<div class="ID">
						<img src="images/Male doctor.png" alt="Rick Jones" style="width:100%">
						<div class="container">
							<h2>Rick Jones</h2>
							<p class="role">Doctor</p>
							<p><button class="button">Contact</button></p>



						</div>

					</div>

				</div>

				<div class="column">
					<div class="ID">
						<img src="images/Receptionist.png" alt="Tess Brown" style="width:100%">
						<div class="container">
							<h2>Tess Brown</h2>
							<p class="role">Front staff</p>
							<p><button class="button">Contact</button></p>


						</div>





					</div>

				</div>

				<div class="column">
					<div class="ID">
						<img src="images/Caretaker.png" alt="Lisa Rose" style="width:100%">
						<div class="container"></div>
						<h2>Lisa Rose</h2>
						<p class="role">Caretaker</p>
						<p><button class="button">Contact</button></p>






					</div>


				</div>


				<div class="column">
					<div class="ID">
						<img src="images/Male caretaker.png" alt="Kevin Nye" style="width:100%">
						<div class="container"></div>
						<h2>Kevin Nye</h2>
						<p class="role">Caretaker</p>
						<p><button class="button">Contact</button></p>








					</div>

				</div>

				<div class="column">
					<div class="ID">
						<img src="images/young male caretaker.png" alt="Alex Young" style="width:100%">
						<div class="container"></div>
						<h2>Alex Young</h2>
						<p class="role">Caretaker</p>
						<p><button class="button">Contact</button></p>




					</div>




				</div>

			</div>
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

			<script src="./js/dropdown.js"></script>
	</body>
</hmtl>