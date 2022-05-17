<?php
$error = "";
$msg = "";



    // ======

     if (isset($_POST['addnewbtn'])) {
        $username = $_POST['usernametxt'];
        $pass=$_POST['passwordtxt'];
        
        $select_chech = mysqli_query($con, "SELECT * FROM tbladmin WHERE username='".trim($_POST['usernametxt'])."'");
        if (mysqli_num_rows($select_chech) > 0) {
            $error="User is areald used! try again...";
        }else {
            $hashpassword=password_hash($pass, PASSWORD_BCRYPT);
            $status=1;
            $insertadmin = mysqli_query($con,"INSERT INTO `tbladmin`(`username`, `password`, `status`) 
            VALUES ('$username','$hashpassword','$status')");
            if ($insertadmin) {
                $msg ="Successfull Added";
            }else {
                $error ="Something Went Wrong";
            }
        }
    }elseif (isset($_POST['editbtn'])) {
        $user = $_POST['username'];
        $pass1=$_POST['password'];
        $hashpassword=password_hash($pass1, PASSWORD_BCRYPT);
        $status=1;
        $select_chech1 = mysqli_query($con, "SELECT * FROM tbladmin WHERE username='".trim($_POST['username'])."'");
            if (mysqli_num_rows($select_chech1) > 0) {
                $error="User is areald used! try again...";
            }else{
                $updateadmin = mysqli_query($con,"UPDATE `tbladmin` SET `username`='$user',`password`='$hashpassword' WHERE username='".$_SESSION['username']."'");
                if ($updateadmin) {
                    $msg ="Updated";
                }else {
                    $error ="Something Went Wrong For Editting User Info";
                }
            }
    }
    
                
?>
<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    <!-- Topbar Search -->
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="POST"
        action="search.php">
        <div class="input-group">
            <input type="text" name="seatch" class="form-control bg-light border-0 small" placeholder="Search for..."
                aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn" type="submit" name="searchbtn" title="searching">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>
    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                            aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>


        <div class="topbar-divider d-none d-sm-block"></div>
        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['username']; ?></span>
                <img class="img-profile rounded-circle" src="images/profile.png">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#settingModal">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Settings
                </a>

                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#newuserModal">
                    <i class="fas fa-plus fa-sm fa-fw mr-2 text-gray-400"></i>
                    Add New User
                </a>

                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
<!-- End of Topbar -->

<!-- Add setting Modal-->
<div class="modal fade" id="settingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit My Profile</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <hr>
            </div>
            <?php 
                 $selectquery = mysqli_query($con, "SELECT * FROM tbladmin WHERE adid='". $_SESSION['ad_id']."'");
                 while ($row2=mysqli_fetch_array($selectquery)) {
                     ?>

            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" name="username" class="form-control form-control-user" id="exampleInputEmail"
                            aria-describedby="title" value="<?php echo $row2['username'] ;?>">
                    </div>

                    <div class="form-group">
                        <input type="password" name="password" class="form-control form-control-user"
                            id="exampleInputEmail" aria-describedby="location" value="<?php echo $row2['password'] ;?>"
                            placeholder="Enter new password">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="editbtn" class="btn btn-primary" value="Edit">
                    </div>

                </form>
            </div>
            <?php
                 }
            ?>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- end of setting model -->




<!-- Add addnewUser Modal-->
<div class="modal fade" id="newuserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <hr>
            </div>
            <div class="modal-body">

                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" name="usernametxt" class="form-control form-control-user"
                            id="exampleInputEmail" aria-describedby="title" placeholder="Enter Username">
                    </div>

                    <div class="form-group">
                        <input type="password" name="passwordtxt" class="form-control form-control-user"
                            id="exampleInputPassword" aria-describedby="location" placeholder="Enter password">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="addnewbtn" class="btn btn-primary" value="Add New">
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- end of addnewUser model -->

<?php
// if(isset($_POST['editbtn'])) {
//     $user = $_POST['username'];
//     $pass1=$_POST['password'];
//     $hashpassword=password_hash($pass1, PASSWORD_BCRYPT);
//     $status=1;
//     $select_chech1 = mysqli_query($con, "SELECT * FROM tbladmin WHERE username='".trim($_POST['username'])."'");
//         if (mysqli_num_rows($select_chech1) > 0) {
//             $error="User is areald used! try again...";
//         }
//     $updateadmin = mysqli_query($con,"UPDATE `tbladmin` SET `username`='$user',`password`='' WHERE adid='$hashpassword'");
//     if ($updateadmin) {
//         $msg ="Updated";
//     }else {
//         $error ="Something Went Wrong For Editting User Info";
//     }
//     }


    ?>