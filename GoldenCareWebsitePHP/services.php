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
	<link
		href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&family=Workbench&display=swap"
		rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="./style/second.css">
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
						<div class="current-page">
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
					<article>
						<h1 class="no-margin">My Uni-life</h1>
						<h2>05/03/2024</h2>
						<p>My uni life has been somewhat unconventional, with a change in degree from biology to IT, and
							a global pandemic rudely interrupting things midway. I have been fortunate enough to really
							enjoy my studies! Learning new things and how computer processes work has been fascinating.
							I especially enjoy the group assignments as shown in the image, some of the team building
							exercises have been incredibly challenging but entertaining, and its great to hear from my
							group members on what their different perspectives are.</p>
					</article>
				</div>
			</div>
		</main>
		<aside>
			<div class="aside-content-wrapper">
				<div class="aside-column-1">
					<img id="unilife" class="images" src="./images/unilife.jpg"
						alt="Image of a tower of spaghetti with people in the background.">
				</div>
				<div class="aside-column-2">
					<section>
						<h3>My semester 1 timetable</h3>
						<table id="uni-timetable">
							<tr>
								<th>Day</th>
								<th>Time</th>
								<th>Subject</th>
							</tr>
							<tr>
								<td>Mon</td>
								<td>8:30AM - 9:30AM</td>
								<td>ICT30017 - Lecture</td>
							</tr>
							<tr>
								<td>Mon</td>
								<td>9:30AM - 10:30AM</td>
								<td>COS10005 - Lecture</td>
							</tr>
							<tr>
								<td>Mon</td>
								<td>4:30PM - 6:30PM</td>
								<td>ICT30017 - Tute</td>
							</tr>
							<tr>
								<td>Wed</td>
								<td>8:30AM - 10:30AM</td>
								<td>COS10005 - Tute</td>
							</tr>
							<tr>
								<td>Wed</td>
								<td>12:30PM - 2:30PM</td>
								<td>COS10004 - Tute</td>
							</tr>
							<tr>
								<td>Fri</td>
								<td>4:30PM - 6:30PM</td>
								<td>COS10004 - Lecture</td>
							</tr>
						</table>
						<hr>
						<p>Sometimes you get unlucky with your timetable. I try to make do with what I've got. Below is
							a step-by-step of what my Wednesday morning usually looks like.</p>
						<ol>
							<li>7:30AM wake up</li>
							<li>7:40AM shower and get dressed</li>
							<li>7:50AM have breakfast</li>
							<li>8:00AM leave for uni</li>
							<li>8:30AM first uni class</li>
							<li>10:30AM go home and finish uni lab work</li>
							<li>12:00PM leave for uni</li>
							<li>12:30PM second uni class</li>
							<li>2:30PM go home for lunch</li>
						</ol>
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