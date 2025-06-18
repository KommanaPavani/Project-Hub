<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "odb"; // Replace with your database name

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     // For testing purposes
} catch(PDOException $e) {
    echo "" . $e->getMessage();
}

// Pagination logic
if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}
$no_of_records_per_page = 10;
$offset = ($pageno - 1) * $no_of_records_per_page;

// Query to fetch projects with user details
$sql = "SELECT p.ID, p.Title, p.Description, p.Tools, p.contactInfo, u.FullName 
        FROM tblprojects p
        INNER JOIN tbluser u ON p.UserID = u.ID 
        LIMIT $offset, $no_of_records_per_page";
$query = $conn->prepare($sql);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_ASSOC);

// Count total number of projects for pagination
$total_pages_sql = "SELECT COUNT(*) FROM tblprojects";
$total_pages_query = $conn->prepare($total_pages_sql);
$total_pages_query->execute();
$total_rows = $total_pages_query->fetchColumn();
$total_pages = ceil($total_rows / $no_of_records_per_page);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Online Projects Sharing System | Projects</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .category-box {
    width: 300px; /* Set fixed width */
    height: 175px; /* Set fixed height */
    border-radius: 8px; /* Slightly larger border-radius for a smoother edge */
    padding: 15px;
    margin: 20px;
    transition: all 0.3s ease;
    text-align: center; /* Align text in center */
    display: inline-flex; /* Use flexbox for alignment */
    flex-direction: column; /* Arrange children in a column */
    justify-content: center; /* Center children vertically */
    align-items: center; /* Center children horizontally */
    vertical-align: top;
    background: linear-gradient(135deg, #96bcfa, #f0d1e1); /* Gradient background */
    color: #00008B; /* Text color */
    font-weight: bold;
    font-size:25px;
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.3), 0 1px 3px rgba(0, 0, 0, 0.2); /* Add multiple shadows for 3D effect */
    border: 2px solid transparent; /* Add a transparent border */
    background-clip: padding-box; /* Background-clip for gradient border */
}



.category-box:hover {
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.4), 0 3px 6px rgba(0, 0, 0, 0.3); /* Enhance shadow on hover */
    transform: translateY(-5px); /* Slightly move up on hover for a 3D effect */
}


        .category-box a {
            text-decoration: none;
            color: inherit;
            font-size: 1.2em;
        }

        .category-container {
            text-align: center; /* Center the container */
        }
  
        
    </style>
</head>
<body>
    <main>
        <section class="slider-area slider-area2">
            <div class="slider-active"style="height:225px;">
                <div class="single-slider slider-height2">
                    <div class="container" >
                    <div class="row">
                            <div class="col-xl-8 col-lg-11 col-md-12">
                                <div class="hero_caption hero_caption2">
                                    <br>
                                    <br>
                                    <br>
                                    <h1 data-animation="bounceIn" data-delay="0.2s" style="color:white; font-weight:bold;">Projects</h1>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="index.php" style="font-weight:bold;">Home</a></li>
                                            
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="courses-area section-padding40 fix">
            <div class="container">
            <h2 style="text-align: center;font-weight: bold;
    font-size:40px">Domain Selection</h2>

                <!-- <div class="col-xl-7 col-lg-8">
                    <div class="section-tittle text-center mb-55">
                        <h2>Select a Category</h2>
                    </div>
                </div> -->

                <div class="category-container">
                    <a href="ai.php"><div class="category-box">
                        Artificial Intelligence
                    </div></a>
                   <a href="ml.php"> <div class="category-box">
                        Machine Learning
                    </div></a>
                   <a href="ds.php"> <div class="category-box">
                        Data Science
                    </div></a>
                    <a href="wt.php"> <div class="category-box">
                       Web Technologies
                    </div></a>
                  <a href="cs.php">  <div class="category-box">
                        Cyber Security
                    </div></a>
        
                    <a href="others.php"><div class="category-box">
                        Others
                    </div></a>
                </div>
            </div>
        </section>
    </main>

    <?php include_once('includes/footer.php'); ?>
    <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/jquery.slicknav.min.js"></script>
    <script src="./assets/js/owl.carousel.min.js"></script>
    <script src="./assets/js/slick.min.js"></script>
    <script src="./assets/js/wow.min.js"></script>
    <script src="./assets/js/animated.headline.js"></script>
    <script src="./assets/js/jquery.magnific-popup.js"></script>
    <script src="./assets/js/gijgo.min.js"></script>
    <script src="./assets/js/jquery.nice-select.min.js"></script>
    <script src="./assets/js/jquery.sticky.js"></script>
    <script src="./assets/js/jquery.barfiller.js"></script>
    <script src="./assets/js/jquery.counterup.min.js"></script>
    <script src="./assets/js/waypoints.min.js"></script>
    <script src="./assets/js/jquery.countdown.min.js"></script>
    <script src="./assets/js/hover-direction-snake.min.js"></script>
    <script src="./assets/js/contact.js"></script>
    <script src="./assets/js/jquery.form.js"></script>
    <script src="./assets/js/jquery.validate.min.js"></script>
    <script src="./assets/js/mail-script.js"></script>
    <script src="./assets/js/jquery.ajaxchimp.min.js"></script>
    <script src="./assets/js/plugins.js"></script>
    <script src="./assets/js/main.js"></script>
</body>
</html>