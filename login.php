<?php 
// Login
include('connection.php');

// if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
//     header('location: login-form.php');
//     exit;
// }

if (isset($_POST['submit'])) {
    $email =  $_POST['email'];
    $password = $_POST['password'];
    
    $query = mysqli_query($conn,"SELECT * FROM users WHERE email = '$email' && password = '$password' && is_active = 1 ");
    $result = mysqli_fetch_array($query);
    if($result>0)
    {
        $_SESSION['username'] = $result['username'];
        $_SESSION['loggedin'] = true;
        header("location:Dashboard.php");
        exit();
    } else {
        echo "Invalid username or password";
        header("location:login-form.php");
        exit();
    }
} else {
    echo 'Somthig wants to wrong';
}
?>