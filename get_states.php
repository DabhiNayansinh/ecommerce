<?php

 	include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/ecommerce/connection.php';

// if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
//     header('location: login-form');
//     exit;
// }

if (isset($_POST['country_id'])) {
    $countryId = $_POST['country_id'];
    
    $query = "SELECT * FROM states WHERE country_id = $countryId";
    $result = mysqli_query($conn, $query);
    
    echo '<option value="">Select State</option>';
    
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<option value='{$row['id']}'>{$row['name']}</option>";
    }
}
?>