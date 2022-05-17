<?php
include 'includes/config.php';
$error = "";
$msg = "";
$subject="Checkout Tourism.com Account Creation";

if (isset($_POST['savebtn'])) {
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $phone=$_POST['phone'];
    $email =$_POST['email'];
    $password =$_POST['pass'];
    $cpass =$_POST['cpass'];
    // generate verify key
    $vkey = md5(time().$phone);   

    $select_chech = "SELECT * FROM tblvisitors WHERE email= ? OR phonenumber= ?";
    $stmt =$dbh->prepare($select_chech);
    $stmt->execute([$email,$phone]);

    if ($stmt->rowCount() > 0) {
         $error = "email or Phone Number is alread taken";
    } else {
        $hashpassword=password_hash($password, PASSWORD_BCRYPT);
        $status=1;
        $verified=0;
        $reference=rand(1000,9999); // token reference
        $insert="INSERT INTO `tblvisitors`(`reference`, `firstname`, `lastnmae`, `phonenumber`, `email`, `password`, 
        `status`, `vkey`, `verified`) VALUES 
        (?,?,?,?,?,?,?,?,?)";
        $insetStatment = $dbh->prepare($insert);
     
        if ($insetStatment->execute([$reference,$fname,$lname,$phone,$email,$hashpassword,$status,$vkey,$verified])) {
            $message="Dear ".$fname." ".$lname." has email : '".$email."'
        <br><br> Your account was created successfully!<br> Regards,<br><br> Checkout Tourism.com <br>
        so Click Here to Verify Your Email 
        <a class='btn btn-primary' href='http://localhost:8080/cat1/verify.php?vkey=$vkey'>Verify now</a>";
        send_mail($subject,$message,$email);
        $msg ="Now you are account was Created, so Check your Email: ".$email;
        }else {
            $error="There is Something Went Wrong";
        }
        
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

    <title>VN-Park - new Account</title>

    <!-- Custom fonts for this template-->
    <link href="account/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="account/css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="" style="background-image: url(img/rwanda.jpg);">

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
                                        <h1 class="h4 text-gray-900 mb-4">New Account to Kibihekane tvet tour company</h1>
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
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" name="fname" class="form-control form-control-user"
                                                    id="exampleFirstName" placeholder="First Name" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" name="lname" class="form-control form-control-user"
                                                    id="exampleLastName" placeholder="Last Name" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="number" name="phone" class="form-control form-control-user"
                                                id="exampleInputEmail" placeholder="Phone number" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user"
                                                id="exampleInputEmail" placeholder="Email Address" required> 
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="password" name="pass"
                                                    class="form-control form-control-user" id="exampleInputPassword"
                                                    placeholder="Password" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="password" name="cpass"
                                                    class="form-control form-control-user" id="exampleRepeatPassword"
                                                    placeholder="Repeat Password" required>
                                            </div>
                                        </div>
                                        <input type="submit" name="savebtn" value="Register Account"
                                            class="btn btn-success btn-user btn-block">

                                    </form>
                                    <hr>
                                    <a href="index.php" class="btn btn-success btn-user btn-block">
                                        Login
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="account/vendor/jquery/jquery.min.js"></script>
    <script src="account/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="account/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="account/js/sb-admin-2.min.js"></script>

</body>

</html>