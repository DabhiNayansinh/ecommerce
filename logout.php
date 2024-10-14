<?php
    // Logout
    include('connection.php');
    $_SESSION = [];
    session_destroy();
    echo "Logout successful!";
    header('Location: login-form.php');
    exit();
?>