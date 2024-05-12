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
		<div class="page-container">
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
								<div class="dropdown-content about-us">
								
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
			<h1>Meet the Team</h1>


			<div class="Staff">
				<div class="column">
					<div class="ID">
						<img src="images/Animated Nerd.png" alt="Byron Dallas" style="width: 100%">
						<div class="container">
						<h2>Byron Dallas</h2>
						<p class="role">Administrator</p>
						<p>Equipped from Swinburne University and taken the role of overseeing and evaluating the website of Golden Care, Byron Dallas has been enthusiatic in the Administrator role 
							and presented many ideas that could benefit to the GoldenCare website </p>
						<p>Email:BDallas@Goldencare.com</p>
						<a href="mailto:BDallas@Goldencare.com" button class="button">Contact Us</a>







						</div>

					</div>
				</div>


				<div class="column">
					<div class="ID">
						<img src="images/Male doctor.png" alt="Rick Jones" style="width:100%">
						<div class="container">
						<h2>Rick Jones</h2>
						<p class="role">Doctor</p>
						<p>Coming from a family background of doctors and completed a Doctor of Medicine degree at the University of Melbourne, Rick Jones has employed his skills and knowledge to Golden Care for 10 years 
						and has assisted us to the best. </p>
						<p>Email:Rjones@GoldenCare.com</p>
						<a href="mailto:Rjone@GoldenCare.com" button class="button">Contact Us</a>


						</div>

					</div>

				</div>

				<div class="column">
					<div class="ID">
						<img src="images/Receptionist.png" alt="Tess Brown" style="width:100%">
						<div class="container">
						<h2>Tess Brown</h2>
						<p class="role">Front staff</p>
						<p>An mature and kind member of GoldenCare's staff, her professional skills in scheduling appointments and assisting patient flow has been crucial to maintaining a schedule 
						</p>
						<br>
						<p>Email:TBrown@GoldenCare.com</p>
						<a href="mailto:TBrown@GoldenCare.com" button class="button">Contact us<a>


						</div>





					</div>

				</div>

				<div class="column">
					<div class="ID">
						<img src="images/Caretaker.png" alt="Lisa Rose" style="width:100%">
						<div class="container"></div>
						<h2>Lisa Rose</h2>
						<p class="role">Caretaker</p>
						<p>Lisa Rose has been a caretaker for GoldenCare for 15 years, her kindness and cheerfulness has highly influenced many clients alongside inspiring our fellow staff members to work even harder, 
						she acts as a sort of team leader and role model when it comes to taking care of patients.
						</p>
						<p>Email:LRose@GoldenCare.com</p>
						<a href="mailto:LRose@GoldenCare.com" button class="button">Contact us</a>






					</div>


				</div>


				<div class="column">
					<div class="ID">
						<img src="images/Male caretaker.png" alt="Kevin Nye" style="width:100%">
						<div class="container"></div>
						<h2>Kevin Nye</h2>
						<p class="role">Caretaker</p>
						<p>An kind and enthusiatic person who has work with Golden Care for 5 years, he willingness to assist the elderly have been crucial to ensuring customer satisfaction as well ensuring they have a good time, 
						a patient and understanding person, willing to listen to others and assist 
						</p>
						<p>Email:KNye@GoldenCare.com</p>
						<a href="mailto:KNye@GoldenCare.com" button class="button">Contact us</a>








					</div>

				</div>

				<div class="column">
					<div class="ID">
						<img src="images/young male caretaker.png" alt="Alex Young" style="width:100%">
						<div class="container"></div>
						<h2>Alex Young</h2>
						<p class="role">Caretaker</p>
						<p>A young and influential worker, despite his disability, it has not lower Alex's drive to help the elderly, his kind hearted nature and goal to prove himself has touched the hearts of many clients and staff, 
						he is known to have a positive outlook in everything and willingly makes the best of everything</p>
						<p>Email:AYoung@GoldenCare.com</p>
						<a href="mailto:AYoung@GoldenCare.com" button class="button">Contact us</a>




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