<?php 
    include('connection.php');
    echo $_POST['submit'];
if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $phoneNumber = $_POST['phone_number'];
    $mobileNumber = $_POST['mobile_number'];
    $image = $_POST['image'];
    $cityId = $_POST['city_id'];
    $stateId = $_POST['state_id'];
    $countryId = $_POST['country_id'];
    $pincodeId = $_POST['pincode_id'];
    $addressLine1 = $_POST['address_line1'];
    $addressLine2 = $_POST['address_line2'];
    

    // $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

    // $sql = "INSERT INTO `users` (`id`, `username`, `email`, `password`, `phone_number`, `mobile_number`, `image`, `city_id`, `state_id`, `country_id`, `pincode_id`, `address_line1`, `address_line2`, `is_active`, `created_on`, `created_by`, `modify_on`, `modify_by`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES (NULL, 'admin', 'admin@gmail.com', '123456', '1234567890', '1234567890', NULL, '', '', '', '', 'home', 'home', '1', current_timestamp(), NULL, NULL, NULL, NULL, current_timestamp(), NULL)";
    
    $query = mysqli_query($conn,"INSERT INTO `users` (`username`, `email`, `password`, `phone_number`, `mobile_number`, `image`, `city_id`, `state_id`, `country_id`, `pincode_id`, `address_line1`, `address_line2`) VALUES ('$username', '$email', '$password', '$phoneNumber', '$mobileNumber', '$image', '$cityId', '$stateId', '$countryId', '$pincodeId', '$addressLine1', '$addressLine2')");

    if($query){
        echo "Registration successful!";
        header('Location: login.html');
        // echo "<script>alert('You have successfully inserted the data');</script>";
        // echo "<script type='text/javascript'> document.location ='categories-listing.php'; </script>";
    } else {
        echo "<script>alert('Data was not inserted');</script>";
    }
}

?>