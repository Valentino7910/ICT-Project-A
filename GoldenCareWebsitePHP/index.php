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
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="./style/second.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .content {
            position: relative;
            color: white;
            padding: 40px 0;
            background-image: url('bg.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
			z-index: 500;
			flex-grow: 1;
        }
        .content::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.3);
            z-index: 2;
        }
        .container, .row, .col-md-6 {
            padding: 10px; /* Uniform padding for simplicity */
        }
        video, iframe {
            width: 100%;
            height: auto;
            z-index: 3;
        }
		.dropdown {
			z-index: 1000;  /* High z-index to ensure it appears on top */
		}

		.dropdown-content {
			z-index: 1001;
			color: white;  /* Ensure this is higher than the dropdown toggle */
		}

		header, .page-container {
			position: relative;
			z-index: 600;  /* Lower than the dropdown */
		}
		html, body {
		height: 100%; /* Ensures the minimum height is the full viewport height */
		margin: 0; /* Removes default margin */
		padding: 0; /* Removes default padding */
	}
		.page-container {
		min-height: 100%; /* Ensures it at least covers the viewport */
		display: flex;
		flex-direction: column; /* Stacks children vertically */
	}
	a {
		color: #fff !important;
	}
    </style>
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
							<a href="services.php" title="Services » Golden Care">
								<button href="./services.php">Services</button>
							</a>
						</div>
						<div class="dropdown">
							<a title="About Us">
								<button>About Us</button>
							</a>
							<div class="dropdown-content about-us">
								<a href="./about-us.php" title="About Us » Golden Care">About Us</a>
								<a href="./faq.php" title="FAQ » Golden Care">FAQ</a>
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
		<div class="content">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <iframe src="https://streamable.com/e/nsokfi?autoplay=1&nocontrols=1" frameborder="0" allow="autoplay; fullscreen" style="width:100%; height:300px;"></iframe>
                    </div>
                    <div class="col-md-6">
                        <h1>Golden Care is a leading provider of comprehensive software solutions</h1>
                        <p>Designed specifically for aged care service providers. With a deep understanding of the unique challenges faced by elderly individuals and the caregivers who support them, we are committed to improving the quality of life for seniors while streamlining operations for care providers.</p>
                    </div>
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
	</div>
	<script src="./js/dropdown.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>