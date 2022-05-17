<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

try {
    $username= "root";
    $password ="";
    $dbh = new PDO('mysql:host=localhost;dbname=musanze',$username,$password); // this is the db hanlder
    return $dbh;
} catch (PDOException $e) {
    print "EnockEroo! :". $e->getMessage(). "<br>";
    die();
}



// sending email function

function send_mail($subject,$content,$to){
    global $con; 
    $countfiles='';
    $date=date("Y-m-d H:i:s");
    $send_status=0;
        // connect db
    
//////////////////////////////////////////////////////// SEND Mail
//Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);
    try {
//Server settings
//$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
$mail->isSMTP();                                            //Send using SMTP
$mail->Host       = 'smtp.hostinger.com';                     //Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
$mail->Username   = 'pro@nigoote.com';                     //SMTP username
$mail->Password   = 'Enock@123';                               //SMTP password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
$mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

//Recipients
$mail->setFrom('pro@nigoote.com');
$mail->addAddress($to);                  //Name is optional
$mail->addReplyTo('pro@nigoote.com');


//$body = mysqli_real_escape_string($con, $content);

$mail->MsgHTML($content);
$mail->isHTML(true);                                  //Set email format to HTML
$mail->Subject = $subject;


//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

$mail->send();
return 1;

} catch (Exception $e) {
return  0;
}
}
?>