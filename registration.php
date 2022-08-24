<style type="text/css">
    <?php include 'css/main.css'?>
</style>
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
require("connect_db.php");

if(isset($_POST['sub']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $mail = new PHPMailer(true); 

    try{
        $mail->SMTPDebug = 0; // SMTP::DEBUG_SERVER;
        $mail->isSMTP(); // send using smtp
        $mail->Host = 'smtp.gmail.com';// set stmp server
        $mail->SMTPAuth = true; // enable SMTP authentication
        $mail->Username = 'maciakpatryk32@gmail.com';
        $mail-> Password = 'xvezuwilzdcpexll';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;//TLS encryption
        $mail->Port = 587;
        $mail->setFrom('maciakpatryk32@gmail.com', 'https://github.com/Patryksg05');
        $mail->addAddress($email, $name);
        $mail->isHTML(true);
        $verification_code = substr(number_format(time()*rand(), 0, '', ''),0,6);
        $mail->Subject = 'Email verification';
        $mail->Body = '<p>Your verification code: <span style="font-size:30px; font-weight:bold">'.$verification_code.'</span></p>';
        $mail-> send();

        $pass = hash("sha512", $_POST['pass']);
        $con = mysqli_connect("localhost", "root", "", "emails");
        mysqli_query($con, "INSERT INTO `users` (`id`, `name`, `email`, `password`, `verfication_code`, `email_verfied_at`) 
        VALUES (NULL, '$name', '$email', '$pass', '$verification_code', NULL)");
        //header("location: email_verification.php?email=".$email);
        header("location: login.php");
    }
    catch(Exception $e){
        echo "message could not be sent. Mailer info: {$mail->ErrorInfo}";
    }
}


?>

<form action="" method="POST">
    <h1 style="font-style: italic;">Registration</h1>
    <p><input type="text" name="name" id="name" placeholder="Enter a name" required></p>
    <p><input type="email" name="email" id="email" placeholder="Enter a email" required></p>
    <p><input type="password" name="pass" id="pass" placeholder="Enter a password" required></p>
    <p><button type="submit" name="sub">Register</button></p>
</form>