<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['ocasuid']) == 0) {
    header('location:logout.php');
} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>OPSS || Dashboard</title>
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


                <!-- Recent Sales Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="bg-light text-center rounded p-4">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <?php
                            $uid = $_SESSION['ocasuid'];
                            $sql = "SELECT * from  tbluser where ID=:uid";
                            $query = $dbh->prepare($sql);
                            $query->bindParam(':uid', $uid, PDO::PARAM_STR);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            $cnt = 1;
                            if ($query->rowCount() > 0) {
                                foreach ($results as $row) {
                                    ?>
                                    <h1><span>  Welcome </span><?php echo $row->FullName;?> </h1>
                                    <?php $cnt = $cnt + 1;
                                }
                            }
                            ?>
                        </div>
                        
                    </div>
                </div>
                <!-- Recent Sales End -->


                <div class="container-fluid pt-4 px-4">
                    <div class="row g-8">
                        <div class="col-sm-6 col-xl-4">
                            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                                <i class="fa fa-user fa-6x text-primary"></i>
                                <div class="ms-3">
                                    <p class="mb-2">Total Uploaded Projects</p>
                                    <?php
                                    $uid = $_SESSION['ocasuid'];
                                    $sql1 = "SELECT * from  tblprojects where UserID=:uid";
                                    $query1 = $dbh->prepare($sql1);
                                    $query1->bindParam(':uid', $uid, PDO::PARAM_STR);
                                    $query1->execute();
                                    $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                                    $totnotes = $query1->rowCount();
                                    ?>
                                    <h4 style="color: blue"><?php echo htmlentities($totnotes);?></h4>
                                    <a href="manage-projects.php"><h5>View Detail</h5></a>
                                </div>
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

        <!-- Template Javascript -->
        <script src="js/main.js"></script>
    </body>

    </html>
    <?php
}
?>