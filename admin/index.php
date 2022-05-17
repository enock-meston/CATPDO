<?php
session_start();
$error = "";
$msg = "";
include('includes/config.php');
if (isset($_POST['loginbtn'])) {
    $emailtxt = $_POST['email'];
    $passtxt = $_POST['password'];
    $hashespas = password_hash($passtxt, PASSWORD_BCRYPT);
    $select = mysqli_query($con, "SELECT * FROM tbladmin WHERE username='" . trim($emailtxt) . "'") or die(mysqli_error($con));


    if (mysqli_num_rows($select) == 1) {
        $row = mysqli_fetch_array($select);
        $db_password = $row['password'];
        $username = $row['username'];
        if (password_verify(mysqli_real_escape_string($con, trim($_POST['password'])), $db_password)) {
            // lest set the sessions here!!!
            $_SESSION['ad_id'] = $row['adid'];
            $_SESSION['username'] = $row['username'];
            header("location: dashboard.php");
            } 
            else {
            // password does not match
            $error = "Password does not match with any of account , Please try again later!!";
        }
    } else {
        // password does not match
        $error = "Invalid user credintials , Please try again later!!";
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

    <title>Checkout Tourism - Login</title>

    <!-- Custom fonts for this template-->
    <link href="../account/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../account/css/sb-admin-2.css" rel="stylesheet">

</head>

<body style="background-image: url(../img/rwanda.jpg);"
>

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Admin of Kibihekane tvet tour company!</h1>
                                    </div>

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
                                    <form class="user" method="POST">
                                        <div class="form-group">
                                            <input type="text" name="email" class="form-control form-control-user"
                                                id="exampleInputEmail" required aria-describedby="emailHelp"
                                                placeholder="Enter UserName...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password"
                                                class="form-control form-control-user" id="exampleInputPassword"
                                                required placeholder="Password">
                                        </div>

                                        <input type="submit" name="loginbtn" value="Login"
                                            class="btn btn-success btn-user btn-block">

                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../account/vendor/jquery/jquery.min.js"></script>
    <script src="../account/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../account/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../account/js/sb-admin-2.min.js"></script>

</body>

</html>