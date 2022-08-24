<style type="text/css">
    body{
    background-color: #000;
    color: #eee;
}
</style>

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
require("connect_db.php");


if(isset($_POST['sub'])){
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $query = mysqli_query($con, "SELECT * FROM `users` where email = '$email'");
    if(mysqli_num_rows($query) == 0)
        die("Email address not found!, <a href='registration.php'>create account</a>");

    $user = mysqli_fetch_object($query);

    $query = mysqli_query($con, "SELECT password FROM `users` WHERE email LIKE '$email'");
    while($rec = mysqli_fetch_array($query))
        $pass_hash = $rec[0];

    if(hash("sha512", $pass) != $pass_hash)
        die("Password is not correct!");
    
    if($user-> email_verfied_at == null)
    {
        $_SESSION['email'] = $email;
        die("Please verify your email address: <a href='email_verification.php?email=".$email."'>from here</a>");
    }

    if($user-> email_verfied_at != null)
    {
        $_SESSION['email'] = $email;
        header("location: after_verification.php");
    }

    exit();
}

?>

<form action="" method="POST">
    <p><input type="email" name="email" id="email" placeholder="Enter email" required></p>
    <p><input type="password" name="pass" id="pass" placeholder="Enter password" required></p>
    <p><button type="submit" name="sub">Log In</button></p>
</form>
