<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-light sidebar sidebar-light accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <!-- <i class="fas fa-laugh-wink"></i> -->
        </div>
        <div class="sidebar-brand-text mx-3">Rwanda Tourism  <sup>Company</sup></div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.php">
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
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>More</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">

                <a class="collapse-item" href="#" data-toggle="modal" data-target="#MyRequestModal">My Request</a>

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
<div class="modal fade" id="MyRequestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">My RequestModal</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- transaction viewing Table -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Visitor's Name</th>
                                    <th>Visitor's Phone No</th>
                                    <th>Park Reserved</th>
                                    <th>Date</th>
                                    <th>Message</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Visitor's Name</th>
                                    <th>Visitor's Phone No</th>
                                    <th>Park Reserved</th>
                                    <th>Date</th>
                                    <th>Message</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $uid= $_SESSION['user_id'];
                                                $select = "SELECT tblreservation.rid as rid,tblreservation.parkid as parkid,
                                                tblreservation.visitor as visitor, tblreservation.date as date,tblreservation.Status as status,
                                                tblvisitors.vid as vid,tblvisitors.firstname as firstname,tblvisitors.lastnmae as lastname,
                                                tblvisitors.phonenumber as phonenumber, tblvisitors.email as email,tblparks.id as pid,
                                                tblparks.name as pname from tblreservation LEFT JOIN tblvisitors on tblreservation.visitor =tblvisitors.vid 
                                                LEFT JOIN tblparks ON tblreservation.parkid = tblparks.id WHERE tblvisitors.vid = ?";
                                                $QuerySt = $dbh->prepare($select);
                                                $QuerySt->execute(array($uid."%"));
                                                while ($row1 = $QuerySt->fetch(PDO::FETCH_OBJ)) {
                                                   
                                            ?>
                                <tr>
                                    <td><?php echo $row1->firstname." ".$row1->lastname;?></td>
                                    <td><?php echo $row1->phonenumber;?></td>
                                    <td><?php echo $row1->pname;?></td>
                                    <td><?php echo $row1->date;?></td>
                                    <td>
                                        <?php
                                        $st = $row1->status;
                                            if ($st == 1) {
                                        ?>
                                        <a class="btn btn-dark">Pending</a>
                                        <?php
                                            }else {
                                                ?>
                                                <a class="btn btn-info"> Aprooved</a>
                                                <?php
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

<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>