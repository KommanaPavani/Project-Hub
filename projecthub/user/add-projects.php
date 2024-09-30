<?php
session_start();
include('includes/dbconnection.php');

if (strlen($_SESSION['ocasuid']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $ocasuid = $_SESSION['ocasuid'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $tools = $_POST['tools'];
        $contactInfo = $_POST['contactInfo'];
        $category = $_POST['category'];

        // Inserting data into the database
        $sql = "INSERT INTO tblprojects (UserID, Title, `Description`, Tools, ContactInfo, Category) VALUES (:ocasuid, :title, :description, :tools, :contactInfo, :category)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':ocasuid', $ocasuid, PDO::PARAM_STR);
        $query->bindParam(':title', $title, PDO::PARAM_STR);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->bindParam(':tools', $tools, PDO::PARAM_STR);
        $query->bindParam(':contactInfo', $contactInfo, PDO::PARAM_STR);
        $query->bindParam(':category', $category, PDO::PARAM_STR);
        $query->execute();

        $LastInsertId = $dbh->lastInsertId();
        if ($LastInsertId > 0) {
            echo '<script>alert("Project has been added.")</script>';
            echo "<script>window.location.href ='add-projects.php'</script>";
        } else {
            echo '<script>alert("Something Went Wrong. Please try again")</script>';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>OPSS || Add Projects</title>
  
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
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative bg-white d-flex p-0">
        <?php include_once('includes/sidebar.php');?>

        <!-- Content Start -->
        <div class="content">
            <?php include_once('includes/header.php');?>

            <!-- Form Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Add Project</h6>
                            <form method="post">
                                <div class="mb-3">
                                    <label for="exampleInputEmail2" class="form-label">Project Title:</label>
                                    <input type="text" class="form-control" name="title" required='true'>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail2" class="form-label">Description:</label>
                                    <textarea class="form-control" name="description" required='true' rows="10" cols="50"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="category" class="form-label">Category:</label>
                                    <select class="form-control" name="category" required='true'>
                                        <option value="">Select Category</option>
                                        <option value="Artificial Intelligence">Artificial Intelligence</option>
                                        <option value="Machine Learning">Machine Learning</option>
                                        <option value="Cyber Security">Cyber Security</option>
                                        <option value="Web Technologies">Web Technologies</option>
                                        <option value="Data Science">Data Science</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail2" class="form-label">Tools:</label>
                                    <textarea class="form-control" name="tools" required='true'></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail2" class="form-label">Contact Info (Phno, Email/Linkedin Profile):</label>
                                    <textarea class="form-control" name="contactInfo" required='true'></textarea>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Form End -->
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
<?php }?>
