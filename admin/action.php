<?php
session_start();
include('includes/config.php');
error_reporting(0);
$error = "";
$msg = "";
if (strlen($_SESSION['username']) == 0) {
    header('location:../index.php');
} else {
    if (isset($_POST['save'])) {
        $title =$_POST['title'];
        $descriptions=$_POST['descriptions'];
        $parklocation =$_POST['location'];

        // images
	$img_name = $_FILES['my_image']['name'];
	$img_size = $_FILES['my_image']['size'];
	$tmp_name = $_FILES['my_image']['tmp_name'];
	$error = $_FILES['my_image']['error'];
    $select_chech = "SELECT * FROM tblparks WHERE name=?";
    $statment11 = $dbh->prepare($select_chech);
    $statment11->execute([$title]);
    // uplading Thumbnail
	if ($img_size > 2250000) {
        $error = "Sorry, your file is too large.";
    }elseif ($statment11->rowCount() > 0) {
        $error = 'Park is Aready In...';
    }else {
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);

        $allowed_exs = array("jpg", "jpeg", "png"); 

        if (in_array($img_ex_lc, $allowed_exs)) {
            $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
            $img_upload_path = 'thumbnail/'.$new_img_name;
            move_uploaded_file($tmp_name, $img_upload_path);

            $imageSize = getimagesize("$img_upload_path");
            if ($imageSize[0]!=1400 AND $imageSize[1] != 700) {
                $error = "Image Must Have Width of 1400 pixel AND Heigth of 700 pixel";
            }else {
                
            // Insert into Database
            $status =1;
            $query1="INSERT INTO `tblparks`(`name`, `location`,`imagepark`, `descriptions`, `Status`) VALUES (?,?,?,?,?)";
                $queryStat = $dbh->prepare($query1);
                
                if($queryStat->execute([$title,$parklocation,$new_img_name,$descriptions,$status]))
                {
                $msg="Prossess successfully ";
                }
                else{
                $error="Something went wrong . Please try again.";
                }
            }
        }else {
            $error = "You can't upload files of this type";
        }
    }
    // end of uplading Thumbanail

    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>home</title>
    <!-- Custom fonts for this template-->
    <link href="plugins/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="plugins/css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.4/datatables.min.css" />
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.4/datatables.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
    </script>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- sideBar -->
        <?php include('includes/sidebar.php'); ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">

                <!-- top bar -->
                <?php include('includes/topbar.php'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Action</h1>

                    </div>

                    <!--  -->
                    <!-- Content Row -->


                    <div class="row">

                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-sm-12">
                                    <!---Success Message--->
                                    <?php if ($msg) { ?>
                                    <div class="alert alert-success" role="alert">
                                        <strong>Well done!</strong> <?php echo htmlentities($msg); ?>
                                    </div>
                                    <?php } ?>

                                    <!---Error Message--->
                                    <?php if ($error) { ?>
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>

                            <a href="#" data-toggle="modal" data-target="#parkModal" class="btn btn-success">Add PArk <i
                                    class="fas fa-fw fa-plus"></i></i></a>

                            <hr>
                            <h6>List Of Parks</h6>
                            <!-- table -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Location</th>
                                                <th>Description</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Location</th>
                                                <th>Description</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            $st=1;
                                                $select ="SELECT * FROM `tblparks` Where Status=?";
                                                $st11= $dbh->prepare($select);
                                                $st11->execute([$st]);

                                                while ($row = $st11->fetch(PDO::FETCH_OBJ)) {
                                                   
                                            ?>
                                            <tr>
                                                <td><?php echo $row->name;?></td>
                                                <td><?php echo $row->location;?></td>
                                                <td><?php echo $row->descriptions;?></td>
                                            </tr>
                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- end of table -->
                        </div>

                    </div>
                </div>


            </div>

        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->



    <!-- Footer -->
    <?php include('includes/footer.php'); ?>
    <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <!-- Add Park Modal-->
    <div class="modal fade" id="parkModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new Park</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <hr>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" name="title" class="form-control form-control-user"
                                id="exampleInputEmail" aria-describedby="title" placeholder="Enter Park Name">
                        </div>

                        <div class="form-group">
                            <input type="file" name="my_image" class="form-control form-control-user"
                                id="exampleInputEmail">
                        </div>

                        <div class="form-group">
                            <input type="text" name="descriptions" class="form-control form-control-user"
                                id="exampleInputEmail" aria-describedby="descriptions"
                                placeholder="Enter Park descriptions">
                        </div>

                        <div class="form-group">
                            <input type="text" name="location" class="form-control form-control-user"
                                id="exampleInputEmail" aria-describedby="location" placeholder="Enter Park location">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="save" class="btn btn-primary" value="SAVE">
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end of park model -->

     
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>





    <!-- Bootstrap core JavaScript-->
    <script src="plugins/vendor/jquery/jquery.min.js"></script>
    <script src="plugins/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="plugins/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="plugins/js/sb-admin-2.min.js"></script>
    <!-- Page level plugins -->
    <script src="plugins/vendor/chart.js/Chart.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="plugins/js/demo/chart-area-demo.js"></script>
    <script src="plugins/js/demo/chart-pie-demo.js"></script>
    <!-- Page level plugins -->


    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>





</body>

</html>
<?php 
 } 
?>