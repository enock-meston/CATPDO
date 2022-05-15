<?php
include 'classes/dbh.class.php';
include 'classes/test.class.php';
$msg="";
$error="";
if ($_GET['error']=null || $_GET['message']=null) {
    # code...
}
elseif ($_GET['error']=="stmtfailed") {
    $error ="Query Has Problem";
}elseif($_GET['message']=="stmtok") {
    $msg ="Now you are Added";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Material Design for Bootstrap</title>
    <!-- MDB icon -->
    <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="boostrapmdb/css/mdb.min.css" />
</head>

<body>
    <?php  include 'includes/header.php';?>
    <div class="container">
        <div class="row">

            <!-- login div -->
            <div class="col-md-4">

                <h3>Login</h3>
                <form>
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <input type="email" id="form1Example1" class="form-control" />
                        <label class="form-label" for="form1Example1">Email address</label>
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <input type="password" id="form1Example2" class="form-control" />
                        <label class="form-label" for="form1Example2">Password</label>
                    </div>

                    <!-- 2 column grid layout for inline styling -->
                    <div class="row mb-4">
                        <div class="col d-flex justify-content-center">
                            <!-- Checkbox -->
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
                                <label class="form-check-label" for="form1Example3"> Remember me </label>
                            </div>
                        </div>

                        <div class="col">
                            <!-- Simple link -->
                            <a href="#!">Forgot password?</a>
                        </div>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                </form>
            </div>
            <!-- ends of login div -->


            <div class="col-md-8">

                <h3>New Account</h3>

                <div class="row">
                    <div class="col-sm-6">
                        <!---Success Message--->

                        <?php if($msg){ ?>
                        <div class="alert alert-success" role="alert">
                            <strong>Well done!</strong> <?php echo htmlentities($msg);?>
                        </div>
                        <?php } ?>
                        <!---Error Message--->
                        <?php if($error){ ?>
                        <div class="alert alert-danger" role="alert">
                            <strong>Oh snap!</strong> <?php echo htmlentities($error);?>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <form method="POST" action="includes/AddAction.incl.php">
                    <!-- 2 column grid layout with text inputs for the first and last names -->
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <input type="text" name="fname" id="form3Example1" class="form-control" />
                                <label class="form-label" for="form3Example1">First name</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input type="text" name="lname" id="form3Example2" class="form-control" />
                                <label class="form-label" for="form3Example2">Last name</label>
                            </div>
                        </div>
                    </div>

                    <!-- Email input -->
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <input type="email" name="email" id="form3Example3" class="form-control" />
                                <label class="form-label" for="form3Example3">Email address</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input type="text" name="phone" id="form3Example2" class="form-control" />
                                <label class="form-label" for="form3Example2">Phone Number</label>
                            </div>
                        </div>
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <input type="password" name="password" id="form3Example4" class="form-control" />
                        <label class="form-label" for="form3Example4">Password</label>
                    </div>


                    <!-- Submit button -->
                    <input type="submit" name="savebtn" class="btn btn-primary" value="Sign Up">

                </form>
            </div>
        </div>
    </div>

</body>

</html>