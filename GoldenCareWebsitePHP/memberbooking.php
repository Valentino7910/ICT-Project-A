<?php 
    session_start();
    require_once("settings.php");
    require_once("auth_session.php");
    check_login();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="description" content="Welcome to the home page of Golden Care.">
	<title>Golden Care</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link type="text/css" rel="stylesheet" href="./style/style.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link
        
		href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&family=Workbench&display=swap"
		rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="./style/second.css">
</head>

<body>
	<div class="page-container management">
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
							<div class="dropdown-content about-us">
									<a href="about-us.php" title="About Us » Golden Care">About Us</a>
									<a href="faq.php" title="FAQ » Golden Care">FAQ</a>
									<a class="current-page" href="Staff.php" title="Staff » Golden Care">Staff</a>
								</div>
						</div>
						<div  class="current-page">
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
		<main>
			<div class="main-content-wrapper">
				<div class="main-column-1">
                <div class="container mt-5">
                    <h2>Your Bookings</h2>
                        <div class="row">
                            <div class="col">
							<table class="table table-striped table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Service Type</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Establish a connection to the database
                                        
                                        // Check connection
                                        if ($conn->connect_error) {
                                            die("Connection failed: " . $conn->connect_error);
                                        }
                                        $itemsPerPage = 5;
                                        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                        $offset = ($page - 1) * $itemsPerPage;
                                        $username = $_SESSION['username'];




                                        $sql = "SELECT id, name, email, phone, date, time, service_type FROM bookings WHERE username = '$username' LIMIT $itemsPerPage OFFSET $offset";


                                        $countSql = "SELECT COUNT(id) AS total FROM bookings WHERE username = '$username'";

                                        $countResult = $conn->query($countSql);
                                        $countRow = $countResult->fetch_assoc();
                                        $totalItems = $countRow['total'];
                                        $totalPages = ceil($totalItems / $itemsPerPage);
                                    
                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0) {
                                            // output data of each row
                                            while($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
                                                echo "<td>" . $row["email"] . "</td>";
                                                echo "<td>" . $row["phone"] . "</td>";
                                                echo "<td>" . $row["date"] . "</td>";
                                                echo "<td>" . $row["time"] . "</td>";
                                                echo "<td>" . $row["service_type"] . "</td>";
                                                /*
                                                echo "<td><form method='POST' action='deleteitem.php'>";
                                                echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
												if ($_SESSION['role'] === 'admin') {
                                                echo "<button type='submit' class='btn btn-danger'>Delete</button>";
												};
                                                echo "</form></td>";
                                                */
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='6'>No data available</td></tr>";
                                        }
                                        $conn->close();
                                        ?>
                                    </tbody>
                                </table>
                                
                            
                            </div>
                            <div class="row">
                                <div class="col">
                                        <nav>
                                            <ul class="pagination">
                                                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                                    <li class="page-item <?php echo $page === $i ? 'active' : ''; ?>">
                                                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                                    </li>
                                                <?php endfor; ?>
                                            </ul>
                                        </nav>
                                </div>
                                
                            </div>
                        </div>
                    </div>
				</div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
	<script src="./js/dropdown.js"></script>
</body>

</html>