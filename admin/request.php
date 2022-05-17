<?php
session_start();
include('../includes/config.php');
error_reporting(0);
$error = "";
$msg = "";
if (strlen($_SESSION['username']) == 0) {
    header('location:index.php');
} else {
    
    if (isset($_GET['req'])) {
        $reqid = $_GET['req'];
        $update = mysqli_query($con,"UPDATE `tblreservation` SET `Status`=2 WHERE rid ='$reqid'");
        if ($update) {
            $selectEmail = mysqli_query($con,"SELECT tblreservation.rid as rid,tblreservation.parkid as parkid,
            tblreservation.visitor as visitor, tblreservation.date as date,tblreservation.Status as Status,
            tblvisitors.vid as vid,tblvisitors.firstname as firstname,tblvisitors.lastnmae as lastname,
            tblvisitors.phonenumber as phonenumber, tblvisitors.email as email,tblparks.id as pid,
            tblparks.name as pname from tblreservation LEFT JOIN tblvisitors on tblreservation.visitor =tblvisitors.vid 
            LEFT JOIN tblparks ON tblreservation.parkid = tblparks.id WHERE tblreservation.rid = '$reqid'");
            $emrow = mysqli_fetch_array($selectEmail);
            $email=$emrow['email'];
            send_mail("request Message","Dear <br> now you request was Approved by ".$_SSESION['username']."<br> 
            so Thank you for working with us.",$email);
            $msg ="Successful Approved";
        }else{
            $error = "Sothing Went Wrong!";
        }
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
    <title>Request</title>
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
    <script>
    $(document).ready(function() {
        $('#example1').DataTable();
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

                            <hr>
                            <div class="row">
                                <div class="col-sm-9 col-md-6">
                                    <h6>Requests</h6>
                                    <!-- table -->
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="example" width="100%"
                                                cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>Visitor's Name</th>
                                                        <th>Visitor's Phone No</th>
                                                        <th>Park Reserved</th>
                                                        <th>Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>Visitor's Name</th>
                                                        <th>Visitor's Phone No</th>
                                                        <th>Park Reserved</th>
                                                        <th>Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                    <?php
                                                $select = mysqli_query($con,"SELECT tblreservation.rid as rid,tblreservation.parkid as parkid,
                                                tblreservation.visitor as visitor, tblreservation.date as date,tblreservation.Status as Status,
                                                tblvisitors.vid as vid,tblvisitors.firstname as firstname,tblvisitors.lastnmae as lastname,
                                                tblvisitors.phonenumber as phonenumber, tblvisitors.email as email,tblparks.id as pid,
                                                tblparks.name as pname from tblreservation LEFT JOIN tblvisitors on tblreservation.visitor =tblvisitors.vid 
                                                LEFT JOIN tblparks ON tblreservation.parkid = tblparks.id WHERE tblreservation.Status =1");
                                                while ($row = mysqli_fetch_array($select)) {
                                                   
                                            ?>
                                                    <tr>
                                                        <td><?php echo $row['firstname'] ." ".$row['lastname'];?></td>
                                                        <td><?php echo $row['phonenumber'];?></td>
                                                        <td><?php echo $row['pname'];?></td>
                                                        <td><?php echo $row['date'];?></td>
                                                        <td>
                                                            <a href="request.php?req=<?php echo $row['rid'];?>" class="btn btn-success">Aproove</a>
                                                        </td>
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







                                <!-- other side -->

                                <div class="col-sm-9 col-md-6">
                                    <h6>Approoved</h6>
                                    <!-- table -->
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered bg-dark" id="example1" width="100%"
                                                cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>Visitor's Name</th>
                                                        <th>Visitor's Phone No</th>
                                                        <th>Park Reserved</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>Visitor's Name</th>
                                                        <th>Visitor's Phone No</th>
                                                        <th>Park Reserved</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                    <?php
                                                $select = mysqli_query($con,"SELECT tblreservation.rid as rid,tblreservation.parkid as parkid,
                                                tblreservation.visitor as visitor, tblreservation.date as date,tblreservation.Status as Status,
                                                tblvisitors.vid as vid,tblvisitors.firstname as firstname,tblvisitors.lastnmae as lastname,
                                                tblvisitors.phonenumber as phonenumber, tblvisitors.email as email,tblparks.id as pid,
                                                tblparks.name as pname from tblreservation LEFT JOIN tblvisitors on tblreservation.visitor =tblvisitors.vid 
                                                LEFT JOIN tblparks ON tblreservation.parkid = tblparks.id WHERE tblreservation.Status =2");
                                                while ($row = mysqli_fetch_array($select)) {
                                                   
                                            ?>
                                                    <tr>
                                                        <td><?php echo $row['firstname'] ." ".$row['lastname'];?></td>
                                                        <td><?php echo $row['phonenumber'];?></td>
                                                        <td><?php echo $row['pname'];?></td>
                                                        <td><?php echo $row['date'];?></td>
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