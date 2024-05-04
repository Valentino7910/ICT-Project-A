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
	<title>Golden Care</title>
	
    <link rel="stylesheet" href="./style/managementstyle.css">
    <link type="text/css" rel="stylesheet" href="./style/style.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link
		href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&family=Workbench&display=swap"
		rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="./style/second.css">
    
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
						<div class="current-page">
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
		
			
        <div class="management-header">
                    <h2>Manage anything you want efficiently on this page</h2>
                    </div>
                <main>
                    
                    <section>
                    <div class="card">
                        <img src="https://static.wixstatic.com/media/7992be_a24e13154b554573832878cd22c09500~mv2.jpg/v1/crop/x_44,y_0,w_935,h_1024/fill/w_590,h_646,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/Inventory.jpg" alt="Inventory">
                        <h2>Inventory</h2>
                        <a href="inventory.php"><button href="inventory.php">Edit</button></a>
                    </div>
                    <div class="card">
                        <img src="https://static.wixstatic.com/media/7992be_eadf02d2b17d4872a81df90b9df21d8f~mv2.jpg/v1/crop/x_44,y_0,w_935,h_1024/fill/w_590,h_646,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/Staff%20management.jpg" alt="Staff Management">
                        <h2>Staff Management</h2>
                        <a href="Staff.php"><button href="Staff.php">Edit</button></a>
                    </div>
                    <div class="card">
                        <img src="https://static.wixstatic.com/media/7992be_0c32e56a3dfe44e1a0a89b6acd39c743~mv2.jpg/v1/crop/x_44,y_0,w_935,h_1024/fill/w_590,h_646,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/Bookings.jpg" alt="Services">
                        <h2>Services</h2>
                        <button>Edit</button>
                    </div>
                    </section>
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
	<script src="./js/dropdown.js"></script>
</body>

</html>