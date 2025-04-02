<?php 
    include('connection.php');
    echo $_POST['submit'];
if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $phoneNumber = $_POST['phone_number'];
    $mobileNumber = $_POST['mobile_number'];
    // $image = $_POST['image'];
    $cityId = $_POST['city_id'];
    $stateId = $_POST['state_id'];
    $countryId = $_POST['country_id'];
    $pincodeId = $_POST['pincode_id'];
    $addressLine1 = $_POST['address_line1'];
    $addressLine2 = $_POST['address_line2'];
    

    // Image upload handling
    $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/ecommerce/ecommerce/uploads/";
    $image_name = basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $image_name;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    // ✅ Check if file is an actual image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        die("File is not an image.");
    }
    
    // ✅ Allow only certain file formats
    $allowed_extensions = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($imageFileType, $allowed_extensions)) {
        die("Only JPG, JPEG, PNG & GIF files are allowed.");
    }

    // ✅ Move uploaded file to `uploads/` directory
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "Image uploaded successfully: " . $image_name;
    } else {
        echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
    }
    // $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

    // $sql = "INSERT INTO `users` (`id`, `username`, `email`, `password`, `phone_number`, `mobile_number`, `image`, `city_id`, `state_id`, `country_id`, `pincode_id`, `address_line1`, `address_line2`, `is_active`, `created_on`, `created_by`, `modify_on`, `modify_by`, `is_deleted`, `deleted_on`, `deleted_by`) VALUES (NULL, 'admin', 'admin@gmail.com', '123456', '1234567890', '1234567890', NULL, '', '', '', '', 'home', 'home', '1', current_timestamp(), NULL, NULL, NULL, NULL, current_timestamp(), NULL)";
    
    $query = mysqli_query($conn,"INSERT INTO `users` (`username`, `email`, `password`, `phone_number`, `mobile_number`, `image`, `city_id`, `state_id`, `country_id`, `pincode_id`, `address_line1`, `address_line2`) VALUES ('$username', '$email', '$password', '$phoneNumber', '$mobileNumber', '$image_name', '$cityId', '$stateId', '$countryId', '$pincodeId', '$addressLine1', '$addressLine2')");

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