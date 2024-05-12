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
		<title>Inventory » Golden Care</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
		<link type="text/css" rel="stylesheet" href="./style/style.css">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="./style/second.css">
	</head>
	<body>
		<div class="page-container inventory">
			<header>
				<div class="header-content-wrapper">
					<div class="website-title-wrapper">
						<a class="website-title logo" href="./index.php"><img src="./images/Golden_Care_logo_white.png"
								alt="Golden Care"></a>
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
							<div class="dropdown">
								<a title="About Us">
									<button>About Us</button>
								</a>
								<div class="dropdown-content about-us">
									<a href="about-us.php" title="About Us » Golden Care">About Us</a>
									<a href="faq.php" title="FAQ » Golden Care">FAQ</a>
									<a href="Staff.php" title="Staff » Golden Care">Staff</a>
								</div>
							</div>
							<div class="current-page">
								<a href="inventory.php" title="Inventory » Golden Care">
									<button>Inventory</button>
								</a>
							</div>
							<div>
								<a href="management.php" title="Management » Golden Care">
									<button>Management</button>
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
					<div class="container mt-5">
						<div class="row">
							<div class="col">
								<table class="table">
									<thead class="thead-light">
										<tr>
											<th>Name</th>
											<th>Available</th>
											<th>Max Stock</th>
											<th></th>
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




										$sql = "SELECT id, name, is_available, max_stock FROM inventory LIMIT $itemsPerPage OFFSET $offset";

										$countSql = "SELECT COUNT(id) AS total FROM inventory";
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
												echo "<td>" . $row["is_available"] . "</td>";
												echo "<td>" . ($row["max_stock"] !== null ? $row["max_stock"] : '-') . "</td>";
												echo "<td><form method='POST' action='deleteitem.php'>";
												echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
												if ($_SESSION['role'] === 'admin') {
												echo "<button type='submit' class='btn btn-danger'>Delete</button>";
												};
												echo "</form></td>";
												echo "</tr>";
											}
										} else {
											echo "<tr><td colspan='3'>No data available</td></tr>";
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
							<div>
								<?php
									if ($_SESSION['role'] === 'admin') {
										echo "<a href='addinventory.php' class='btn btn-primary'>Add Item</a>";
									};
								?>
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
							<a class="footer-title logo" href="./index.php">
								<img src="./images/Golden_Care_logo_white.png" alt="Golden Care">
							</a>
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
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	</body>
</html>