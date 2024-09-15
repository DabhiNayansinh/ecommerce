<?php

// Logout
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    echo "Logout successful!";
    // Redirect to the login page or home page
    header('Location: login.php');
    exit();
}

?>