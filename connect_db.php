<?php

    $con = mysqli_connect("localhost", "root", "", "emails");

    if(mysqli_connect_errno())
        echo mysqli_connect_error();

    session_start();

    echo "brak";

?>  