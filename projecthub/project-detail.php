<?php
session_start();
include('includes/dbconnection.php');

if (isset($_GET['id'])) {
    $projectId = intval($_GET['id']);
    
    // Fetching project details from the database
    $sql = "SELECT tblprojects.*, tbluser.FullName 
    FROM tblprojects 
    JOIN tbluser ON tblprojects.UserID = tbluser.ID 
    WHERE tblprojects.ID = :projectId";
    $query = $dbh->prepare($sql);
    $query->bindParam(':projectId', $projectId, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_OBJ);

    if (!$result) {
        echo '<script>alert("Invalid Project ID.")</script>';
        echo '<script>window.location.href = "index.php";</script>';
        exit(); // Ensure script stops executing after redirection
    }
} else {
    echo '<script>alert("Project ID not set.")</script>';
    echo '<script>window.location.href = "index.php";</script>';
    exit(); // Ensure script stops executing after redirection
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>OPSS || Project Details</title>

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <!-- <link href="assets\css\style1.css" rel="stylesheet"> -->
     <style>
        /* style1.css */

        /* Wrapper styling */
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background:white;
        }

        .container-wrapper {
            background-color:linear-gradient(135deg, #96bcfa, #f0d1e1);
            padding: 20px;
            border-radius: 10px;
            width: 800px; /* Increased width */

            margin: 40px auto; /* Add margin to create gap from top and bottom */
            position: relative; /* Use relative positioning */
            font-size: 18px; /* Increase font size */
            font-family: 'Trebuchet MS', sans-serif;
        }
        
        .container-wrapper h6 {
    font-size: 40px; /* Increase font size */
    font-weight: bold; /* Make text bold */
    text-align: center; /* Center align text */
    margin-top: 0; /* Remove space above the heading */
    margin-bottom: 10px; /* Add some space below */
}

        .box {
            border: 1px; /* Light thick border */
            border-radius: 10px; /* Slightly rounded corners */
            padding: 20px; /* Padding inside the box */
            margin-bottom: 15px; /* Space between boxes */
            background:linear-gradient(135deg, #96bcfa, #f0d1e1); /* Light background color */
        }

        .box label {
            font-weight: bold; /* Bold labels */
            color:black; /* Dark blue color for labels */
        }

        .box p {
            margin: 0; /* Remove margin from paragraphs */
        }

        body {
            font-family: 'Trebuchet MS', sans-serif; /* Change font family to Roboto */
            font-weight: normal;
    
            font-size: 16px;
        }
    </style>
</head>

<body>
    <div class="container-wrapper">
        <!-- Project Details Start -->
        <h6 class="mb-4" >Project Details</h6>
        <div class="box">
            <label class="form-label"><strong>Project Title:</strong></label>
            <p><?php echo isset($result->Title) ? htmlentities($result->Title) : 'Not available'; ?></p>
        </div>
        <div class="box">
            <label class="form-label"><strong>Description:</strong></label>
            <p><?php echo isset($result->Description) ? htmlentities($result->Description) : 'Not available'; ?></p>
        </div>
        <div class="box">
            <label class="form-label"><strong>Tools:</strong></label>
            <p><?php echo isset($result->Tools) ? htmlentities($result->Tools) : 'Not available'; ?></p>
        </div>
        <div class="box">
            <label class="form-label"><strong>Contact Info:</strong></label>
            <p><?php echo isset($result->contactInfo) ? htmlentities($result->contactInfo) : 'Not available'; ?></p>
        </div>
        <div class="box">
            <label class="form-label"><strong>Posted By:</strong></label>
            <p><?php echo isset($result->FullName) ? htmlentities($result->FullName) : 'Not available'; ?></p>
        </div>
        <!-- Project Details End -->
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