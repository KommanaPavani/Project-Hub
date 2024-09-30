<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['ocasuid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {


 $title=$_POST['title'];
 $description=$_POST['description'];
 $tools=$_POST['tools'];
  $eid=$_GET['editid'];
$sql="update tblprojects set Title=:title,Description=:description,Tools=:tools where ID=:eid";
$query=$dbh->prepare($sql);

$query->bindParam(':title',$title,PDO::PARAM_STR);
$query->bindParam(':description',$description,PDO::PARAM_STR);
$query->bindParam(':tools',$tools,PDO::PARAM_STR);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
 $query->execute();
         echo '<script>alert("Project has been updated")</script>';
         echo "<script>window.location.href ='manage-projects.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>OPSS || Update projects</title>
  
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

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
                            <h6 class="mb-4">Update Projects</h6>
                            <form method="post">
                                <?php
                                $eid=$_GET['editid'];
$sql="SELECT * from tblprojects where tblprojects.ID=:eid";
$query = $dbh -> prepare($sql);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                                

                                <br />
                                <div class="mb-3">
                                    <label for="exampleInputEmail2" class="form-label">Title</label>
                                   
                                    <input type="text" class="form-control"  name="title" value="<?php  echo htmlentities($row->Title);?>" required='true'>
                                </div>
                                <div class="mb-3">
    <label for="exampleInputEmail2" class="form-label">Description</label>
    <textarea class="form-control" name="description" required="true" rows="10" cols="50"><?php echo htmlentities($row->Description); ?></textarea>
</div>
<div class="mb-3">
    <label for="exampleInputEmail2" class="form-label">Tools</label>
    <textarea class="form-control" name="tools" required="true"><?php echo htmlentities($row->Tools); ?></textarea>
</div>

<?php } ?>
                                <?php $cnt=$cnt+1;} ?>
                                <button type="submit" name="submit" class="btn btn-primary">Update</button>
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
</html><?php }  ?>