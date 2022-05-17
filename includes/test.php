<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once ('../vendor/autoload.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
$mail = new PHPMailer(true);
try {
   $content='Hello there';
    //Server settings
    $mail->SMTPDebug = true;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.hostinger.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
       $mail->Username   = 'pro@nigoote.com';                        //SMTP username
 $mail->Password   = 'Enock@123';                                //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    $mail->setFrom('pro@nigoote.com');
    //Recipients
    $mail->addAddress('pro@nigoote.com');    
        $mail->addReplyTo('pro@nigoote.com');
    //$mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
    $mail->addAddress('ndagijimanaenock11@gmail.com');               //Name is optional
    $mail->addReplyTo('pro@nigoote.com', 'NIgoote Testing Email...');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');
    //Content
 
  
    // strip backslashes
 
    // mail settings below including these:
    $mail->MsgHTML("hello");
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Test';

  
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Done!';
} catch (Exception $e) {
  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>