<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-light sidebar sidebar-light accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <!-- <i class="fas fa-laugh-wink"></i> -->
        </div>
        <div class="sidebar-brand-text mx-3">Tacha<sup>net</sup></div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="home.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Home</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Dashboard
    </div>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Categories</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <?php
                $categoryQuery = mysqli_query($con, "SELECT * FROM `tblcategory` WHERE Is_Active=1");
                while ($rowcat = mysqli_fetch_array($categoryQuery)) {
                ?>
                    <a class="collapse-item" href="get-category.php?cat=<?php echo $rowcat['id']?>" id="videocategory"><?php echo $rowcat['CategoryName']; ?></a>
                <?php
                }
                ?>
            </div>
        </div>
    </li>
    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Transactions</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="#" data-toggle="modal" data-target="#transactionModal">My Transaction</a>
            </div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->

<!-- My traction Modal-->
<div class="modal fade" id="transactionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">My Transactions or Payments</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- transaction viewing Table -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>email</th>
                                    <th>Amount (RWF</th>
                                    <th>Date</th>
                                    <th>Subscription</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>N0</th>
                                    <th>email</th>
                                    <th>Amount (RWF</th>
                                    <th>Date</th>
                                    <th>Subscription</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $selectTransaction = mysqli_query($con, "SELECT * FROM `tbltransactions` WHERE ClientId='" . $_SESSION['email'] . "'");
                                while ($rowtra = mysqli_fetch_array($selectTransaction)) {
                                    $cnt = 1;
                                ?>
                                    <tr>
                                        <td><?php echo htmlentities($cnt); ?></td>
                                        <td><?php echo htmlentities($rowtra['ClientId']); ?></td>
                                        <td><?php echo htmlentities($rowtra['Amount']); ?></td>
                                        <td><?php echo htmlentities($rowtra['transationDate']); ?></td>
                                        <td>
                                            <?php
                                                if ($rowtra['Amount']==200) {
                                                    echo "2 Days";
                                                }elseif ($rowtra['Amount']==1500) {
                                                    echo "15 Days";
                                                }elseif ($rowtra['Amount']==3000) {
                                                    echo "1 Month";
                                                }elseif ($rowtra['Amount']==6000) {
                                                    echo "6 Months";
                                                }elseif ($rowtra['Amount']==12000) {
                                                    echo "Yearly";
                                                }
                                            ?>
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
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="#">Print</a>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"  crossorigin="anonymous"></script>
        <script>
            $(document).ready(function() {
                $('#videocategory').on('change', function() {
                    var category_id = this.value;
                    $.ajax({
                        url: "get-category.php",
                        type: "POST",
                        data: {
                            category_id: category_id
                        },
                        cache: false,
                        success: function(result) {
                            $("#sub-videocategory").html(result);
                        }
                    });
                });
            });
        </script>