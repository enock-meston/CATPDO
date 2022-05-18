<?php
session_start();
include('../includes/config.php');
error_reporting(0);
if (strlen($_SESSION['username']) == 0) {
    header('location:index.php');
} else {

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
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>

                    </div>

                    <!--  -->
                    <!-- Content Row -->

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
                    <div class="row">

                        <div class="col-lg-12">

                            <!-- visitors -->
                            <div class="row">
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-success shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">

                                                <div class="col mr-5">
                                                    <!-- here is for link -->
                                                    <div
                                                        class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                        Visitors
                                                    </div>
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col-auto">
                                                            <?php 
                                                            $status =1;
                                                            $query = "SELECT * from tblvisitors where status=?";
                                                                $statmentQuery = $dbh->prepare($query);
                                                                $statmentQuery->execute([$status]);

                                                            $countposts = $statmentQuery->rowCount();
                                                    ?>
                                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                                <?php echo htmlentities($countposts); ?></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-auto">
                                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Parks -->
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-success shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">

                                                <div class="col mr-5">
                                                    <!-- here is for link -->
                                                    <a href="action.php">
                                                        <div
                                                            class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                            Parks
                                                        </div>
                                                    </a>
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col-auto">
                                                        <?php 
                                                            $status =0;
                                                            $query = "SELECT * from tblparks where status=?";
                                                                $statmentQuery = $dbh->prepare($query);
                                                                $statmentQuery->execute([$status]);

                                                            $countposts = $statmentQuery->rowCount();
                                                    ?>
                                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                                <?php echo htmlentities($countposts); ?></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-auto">
                                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Reservations -->
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-success shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">

                                                <div class="col mr-5">
                                                    <!-- here is for link -->
                                                    <a href="request.php">
                                                        <div
                                                            class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                            All Reservations
                                                        </div>
                                                    </a>
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col-auto">
                                                        <?php 
                                                        $status = 1;
                                                            $query = "SELECT * from tblreservation WHERE Status=?";
                                                                $statmentQuery = $dbh->prepare($query);
                                                                $statmentQuery->execute([$status]);

                                                            $countposts = $statmentQuery->rowCount();
                                                    ?>
                                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                                <?php echo htmlentities($countposts); ?></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-auto">
                                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- pending Reservations -->
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-success shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">

                                                <div class="col mr-5">
                                                    <!-- here is for link -->
                                                    <a href="request.php">
                                                        <div
                                                            class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                            Pending Reservations
                                                        </div>
                                                    </a>
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col-auto">
                                                        <?php 
                                                            $status =1;
                                                            $query = "SELECT * from tblreservation where Status=?";
                                                                $statmentQuery = $dbh->prepare($query);
                                                                $statmentQuery->execute([$status]);

                                                            $countposts = $statmentQuery->rowCount();
                                                    ?>
                                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                                <?php echo htmlentities($countposts); ?></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-auto">
                                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>

            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->

    <!-- one Video video-->
    <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Close?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">

                </div>


            </div>
        </div>
    </div>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#videoModal').on('show.bs.modal', function(e) {
            var rowid = $(e.relatedTarget).data('id');

            $.ajax({
                type: 'post',
                url: 'viewoneVideo.php', //Here you will fetch records
                data: 'rowid=' + rowid, //Pass $id
                success: function(data) {
                    $('.modal-body').html(data); //Show fetched data from database
                }
            });
        });
    });
    </script>
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
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>





</body>

</html>
<?php 
} 
?>