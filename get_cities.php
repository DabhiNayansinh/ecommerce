<?php
 	include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/ecommerce/connection.php';

// if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
//     header('location: login-form.php');
//     exit;
// }

if (isset($_POST['state_id']) && isset($_POST['country_id'])) {
    $stateId = $_POST['state_id'];
    
    $query = "SELECT * FROM cities WHERE state_id = $stateId";
    $result = mysqli_query($conn, $query);
    
    echo '<option value="">Select City</option>';
    
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<option value='{$row['id']}'>{$row['name']}</option>";
    }
}
?>