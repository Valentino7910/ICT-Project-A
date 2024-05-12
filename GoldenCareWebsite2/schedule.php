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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="./style/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&family=Workbench&display=swap"
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
                                <button>Home</button>
                            </a>
                        </div>
                        <div>
                            <a href="services.php"><button>Services</button></a>
                        </div>
                        <div class="dropdown">
                            <a title="About Us">
                                <button>About Us</button>
                            </a>
                            <div class="dropdown-content about-us">
                                <a href="./faq.php" title="FAQ » Golden Care">FAQ</a>
                                <a href="./Staff.php" title="Staff » Golden Care">Staff</a>
                            </div>
                        </div>
                        <div >
                            <a href="inventory.php"><button>Inventory</button></a>
                        </div>
                        <div  class="current-page">
                            <a href="management.php"><button>Management</button></a>
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
                    <div class="container mt-9">
                        <div class="row">
                            <div class="col">
                                <h2>Schedule</h2>
                                <table class="table table-striped table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Position</th>
                                            <th>Monday</th>
                                            <th>Tuesday</th>
                                            <th>Wednesday</th>
                                            <th>Thrusday</th>
                                            <th>Friday</th>
                                            <th>Saturday</th>
                                            <th>Sunday</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Establish a connection to the database
                                        // Check connection
                                        if ($conn->connect_error) {
                                            die("Connection failed: " . $conn->connect_error);
                                        }
                                        // Calculate total number of items
                                        $sqlCount = "SELECT COUNT(*) AS total FROM schedule";
                                        $resultCount = $conn->query($sqlCount);
                                        $rowCount = $resultCount->fetch_assoc();
                                        $totalItems = $rowCount['total'];

                                        // Calculate total number of pages
                                        $itemsPerPage = 5;
                                        $totalPages = ceil($totalItems / $itemsPerPage);

                                        // Get current page number
                                        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;

                                        // Calculate offset
                                        $offset = ($page - 1) * $itemsPerPage;

                                        $sql = "SELECT Position, Monday, Tuesday, Wednesday, Thursday, Friday, Saturday, Sunday FROM schedule LIMIT $offset, $itemsPerPage";
                                        $result = $conn->query($sql);
                                        

                                            // Get current page number
                                            


                                        if ($result->num_rows > 0) {
                                            // output data of each row
                                            while($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>" . htmlspecialchars($row["Position"]) . "</td>";
                                                echo "<td>" . htmlspecialchars($row["Monday"]) . "</td>";
                                                echo "<td>" . htmlspecialchars($row["Tuesday"]) . "</td>";
                                                echo "<td>" . htmlspecialchars($row["Wednesday"]) . "</td>";
                                                echo "<td>" . htmlspecialchars($row["Thursday"]) . "</td>";
                                                echo "<td>" . htmlspecialchars($row["Friday"]) . "</td>";
                                                echo "<td>" . htmlspecialchars($row["Saturday"]) . "</td>";
                                                echo "<td>" . htmlspecialchars($row["Sunday"]) . "</td>";
                                                echo "<td>";
                                                if ($_SESSION['role'] === 'admin') {
                                                    echo "<a href='editschedule.php?position=" . htmlspecialchars($row["Position"]) . "' class='btn btn-primary'>Edit</a>";
                                                    }; 
                                                
                                                echo "</td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='5'>No data available</td></tr>";
                                        }
                                        $conn->close();
                                        ?>
                                    </tbody>
                                </table>
                                <ul class="pagination">
                                    <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                                        <li class="page-item <?php echo ($page === $i) ? 'active' : ''; ?>">
                                            <a class="page-link" href="membermanagement.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                        </li>
                                    <?php endfor; ?>
                                </ul>
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
