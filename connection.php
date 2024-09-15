<?php
    // session_start();
    $conn=mysqli_connect("localhost", "root", "", "ecommrce");
    if(mysqli_connect_errno()) {
        echo "Connection Faield".mysqli_connect_error();
    }
?>