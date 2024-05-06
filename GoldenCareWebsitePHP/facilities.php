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
		content="Welcome to a post about My Greatest Achievement! This digital space is a place for me to share things that have happened in my life.">
	<title>Services & Facilities - Facilities</title>
	<link type="text/css" rel="stylesheet" href="./style/style.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="./style/second.css">
</head>

<body>
	<div class="page-container my-greatest-achievement">
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
		<main>
			<div class="main-content-wrapper">
				<div class="main-column-1">
					<article>
						<h1 class="no-margin">My Greatest Achievement</h1>
						<h2>16/03/2024</h2>
						<p>My greatest achievement would absolutely be raising my beautiful cat Pantheon. He is my pride
							and joy, age 1 year old and already larger than most small dogs, he likes naps in warm
							places and yelling at 6am.
						<p>Pantheon the cat can be described as cautious yet curious, his curiosity often leading him to
							dangerous places like behind the couch where he proceeds to get stuck, or to saying hi to
							new people from three metres away with a little ‘mrow?’ but still cautious enough to keep
							his distance.</p>
						<p>If disturbed while napping he will often go to find a new undisturbed slice of peace and
							quiet somewhere, stretching before giving you a ‘why did you bother me during my slumber’
							look and sashaying away, long tail waving behind him.</p>
						<p>Some of Pantheons favourite hobbies include looking out over his land (the back yard) like a
							king watching over his kingdom, bothering his younger brother, Bob, and playing with any
							piece of rubbish that comes as the packaging for a brand new cat toy (which he will proceed
							to ignore until the rubbish is gone). He will sit for hours looking out over the balcony
							ledge, watching the birds and wishing he was a proper outdoor cat, all while being unable to
							catch a fly. His brother Bob however absolutely could be a vicious predator in another life,
							any flies in this house never live more than a day with him around as the designated
							exterminator cat. Bob, belonging to my younger sister, is what you would call a ‘menace’ and
							not to be confused with my beautiful and well behaved Pantheon.</p>
						<p>Bob is the classic younger brother, his favourite toy is Pantheons first toy, and he excels
							at creating mess and destruction wherever he goes. His nicknames include Bobzilla and Bob
							the Destructor.</p>
					</article>
				</div>
				<div class=main-column-2>
					<img id="christmascat" class="images" src="./images/christmascat.jpg"
						alt="Image of a Christmas cat.">
				</div>
			</div>
		</main>
		<aside>
			<div class="aside-content-wrapper">
				<div class="aside-column-1">
					<img id="sleepycat4" class="images" src="./images/sleepycat4.jpg" alt="Image of a sleepy cat.">
					<img id="sleepycat2" class="images" src="./images/sleepycat2.jpg" alt="Image of a sleepy cat.">
					<img id="sleepycat1" class="images" src="./images/sleepycat1.jpg" alt="Image of a sleepy cat.">
				</div>
				<div class="aside-column-2">
					<img id="goofycat" class="images" src="./images/goofycat.jpg"
						alt="Image of a cat licking its nose.">
					<img id="catbrothers" class="images" src="./images/catbrothers.jpg"
						alt="Image of two cats sitting side by side.">
					<img id="bobzilla" class="images" src="./images/bobzilla.jpg"
						alt="Image of a cat lying on its back.">
					<hr>
					<p>I'm so lucky to have Pantheon in my life!
					<p>
				</div>
			</div>
		</aside>
		<footer>
			<div class="footer-content-wrapper">
				<div class="footer-divider">
				</div>
				<div class="footer-bottom-wrapper">
					<div class="footer-bottom-left-wrapper">
						<p>© Lucie Williams 2024</p>
					</div>
					<div class="footer-bottom-centre-wrapper">
						<p>COS10005: Assignment 1</p>
					</div>
					<div class="footer-bottom-right-wrapper">
						<p>103786549</p>
					</div>
				</div>
			</div>
		</footer>
	</div>
	<script src="./js/dropdown.js"></script>
</body>

</html>