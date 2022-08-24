<style type="text/css">
    body{
    background-color: #000;
    color: #eee;
}
</style>

<?php

require("connect_db.php");

if(!isset($_SESSION['email']))
    header("location: login.php");

echo "<p>Hello: ".$_SESSION['email']."!</p>";

if(isset($_POST['sub']))
{
    session_unset();
    session_destroy();
    header("location: login.php");
}

?>
<form action="" method="POST">
    <button type="submit" name="sub">LOG OUT</button>
</form>