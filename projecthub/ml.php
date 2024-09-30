<?php
session_start();
include('includes/dbconnection.php'); // Ensure this path is correct and the file exists

// Initialize $results as an empty array
$results = [];
// Check if the connection variable is set and not null

// Fetch projects with the category "Artificial Intelligence"
$sql = "SELECT * FROM tblprojects WHERE Category = 'Machine Learning'";
$query = $dbh->prepare($sql);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ML Projects</title>
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <style>
        .project-box {
            width: 300px; /* Set fixed width */
            height: 175px; /* Set fixed height */
            border-radius: 8px; /* Slightly larger border-radius for a smoother edge */
            padding: 15px;
            margin: 20px;
            transition: all 0.3s ease;
            text-align: center; /* Align text in center */
            display: flex; /* Use flexbox for alignment */
            flex-direction: column; /* Arrange children in a column */
            justify-content: center; /* Center children vertically */
            align-items: center; /* Center children horizontally */
            background: linear-gradient(135deg, #96bcfa, #f0d1e1); /* Gradient background */
            color: #00008B; /* Text color */
            font-weight: bold;
            font-size: 10px;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.3), 0 1px 3px rgba(0, 0, 0, 0.2); /* Add multiple shadows for 3D effect */
            border: 2px solid transparent; /* Add a transparent border */
            background-clip: padding-box; /* Background-clip for gradient border */
        }

        .project-box:hover {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.4), 0 3px 6px rgba(0, 0, 0, 0.3); /* Enhance shadow on hover */
            transform: translateY(-5px); /* Slightly move up on hover for a 3D effect */
        }

        .project-box a {
            text-decoration: none;
            color: inherit;
            font-size: 1.2em;
        }

        .project-container {
            display: flex; /* Use flexbox to align items */
            flex-wrap: wrap; /* Allow wrapping to next line */
            justify-content: center; /* Center the container */
        }
    </style>
</head>
<body>
    <section class="slider-area slider-area2">
        <div class="slider-active" style="height:225px;">
            <div class="single-slider slider-height2">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-8 col-lg-11 col-md-12">
                            <div class="hero_caption hero_caption2">
                                <br>
                                <br>
                                <br>
                                <h1 data-animation="bounceIn" data-delay="0.2s" style="color:white; font-weight:bold;">Machine Learning Projects</h1>
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
    <div class="container-fluid position-relative bg-white d-flex p-0">
        <!-- Content Start -->
        <div class="content">
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="project-container">
                            <?php
                            if (!empty($results) && count($results) > 0) {
                                foreach ($results as $row) { ?>
                                    <a href="project-detail.php?id=<?php echo htmlentities($row->ID); ?>">
                                        <div class="project-box">
                                            <h3 style="font-family: 'Trebuchet MS', sans-serif;font-size: 22px;font-weight:bold;color: #00008B;"><?php echo htmlentities($row->Title); ?></h3>
                                        </div>
                                    </a>
                                <?php }
                            } else { ?>
                                <p>No projects found in this category.</p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content End -->
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>
</html>