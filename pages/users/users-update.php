<?php
include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/ecommerce/connection.php';

if (isset($_POST['submit'])) {
  $id = intval($_POST['id']);
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = $_POST['password'];
  $phoneNumber = $_POST['phone_number'];
  $mobileNumber = $_POST['mobile_number'];
  $cityId = $_POST['city_id'];
  $stateId = $_POST['state_id'];
  $countryId = $_POST['country_id'];
  $pincodeId = $_POST['pincode_id'];
  $addressLine1 = $_POST['address_line1'];
  $addressLine2 = $_POST['address_line2'];

  // Get existing image
  $getImage = mysqli_query($conn, "SELECT image FROM users WHERE id = $id");
  $row = mysqli_fetch_assoc($getImage);
  $image_name = $row['image'];

  // If new image uploaded
  if (!empty($_FILES["image"]["name"])) {
    $upload_dir = $_SERVER['DOCUMENT_ROOT'] . "/ecommerce/ecommerce/uploads/";
    $new_image_name = basename($_FILES["image"]["name"]);
    $target_file = $upload_dir . $new_image_name;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $allowed = ["jpg", "jpeg", "png", "gif"];
    if (in_array($imageFileType, $allowed)) {
      if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $image_name = $new_image_name;
      }
    }
  }
  
  $modifyBy = 1;
  $query = "UPDATE users SET 
        username = '$username',
        email = '$email',
        password = '$password',
        phone_number = '$phoneNumber',
        mobile_number = '$mobileNumber',
        image = '$image_name',
        city_id = '$cityId',
        state_id = '$stateId',
        country_id = '$countryId',
        pincode_id = '$pincodeId',
        address_line1 = '$addressLine1',
        address_line2 = '$addressLine2',
        modify_by = $modifyBy
        WHERE id = $id";

  if (mysqli_query($conn, $query)) {
    header("Location: /ecommerce/ecommerce/pages/users/users-listing.php");
    exit;
  } else {
    echo "<script>alert('Update failed');</script>";
  }
} else {
  echo "Invalid request.";
}
