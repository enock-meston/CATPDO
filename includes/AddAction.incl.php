<?php
include '../classes/dbh.class.php';
include '../classes/user.class.php';

if (isset($_POST['savebtn'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $insertObjet= new USER();
    $insertObjet->newUser($fname,$lname,$phone,$email,$password);
    
}

?>