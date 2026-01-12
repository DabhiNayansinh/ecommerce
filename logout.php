<?php
    // Logout
include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/ecommerce/connection.php';
    $_SESSION = [];
    session_destroy();
    echo "Logout successful!";
    header('Location: login-form.php');
    exit();
?>