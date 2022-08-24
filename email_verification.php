<style type="text/css">
    <?php include 'css/main.css'?>
</style>
<?php

require("connect_db.php");

if(!isset($_SESSION['email']))
    header("location: login.php");

if(isset($_POST['sub']))
{
    $email = $_POST['email'];   
    $verification_code = $_POST['verification_code'];

    $sql = "UPDATE users set email_verfied_at
    = NOW() where email = '$email' and 
    verfication_code = '$verification_code'";

    $query = mysqli_query($con, $sql);

    if(mysqli_affected_rows($con) == 0)
        die("Verification code failed!");

    echo "<p>You can login now!</p>";

    exit();
}

?>
<form action="" method="POST">
    <input type="text" name="email" value="<?php echo $_GET['email'] ?>">
    <input type="text" name="verification_code" placeholder="Enter a verification code">
    <button type="submit" name="sub">Verify Email</button>
</form>