<?php

    include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/ecommerce/connection.php';

   // if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
   // 	header('location: login-form.php');
   // 	exit;
   // }
   $id = $_GET['editId'];

   if(isset($_POST['submit'])) {
       $name = $_POST['name'];
       $brand = $_POST['brand'];
       $description = $_POST['description'];
       $price = $_POST['price'];
       $discount = $_POST['discount'];
       $size = $_POST['size'];
       $colors = $_POST['colors'];
       $stock_quantity = $_POST['stock_quantity'];
       $category_id = $_POST['category_id'];
       $image_name = $_POST['image'];

    // Check if a new image is uploaded
    if (!empty($_FILES["product_image"]["name"])) {
        $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/ecommerce/ecommerce/uploads/";
        $image_name = basename($_FILES["product_image"]["name"]);
        $target_file = $target_dir . $image_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Validate image file type
        $allowed_extensions = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($imageFileType, $allowed_extensions)) {
            die("Only JPG, JPEG, PNG & GIF files are allowed.");
        }

        // Upload new image
        if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
            // Delete old image
            unlink($target_dir . $product['image']);
        } else {
            die("Error uploading image.");
        }
    }
        $query = mysqli_query($conn,"UPATE products SET name='$name',brand='$brand',description='$description',price='$price',discount='$discount',price='$price',size='$size',colors='$colors',stock_quantity='$stock_quantity',category_id='$category_id',image_name='$image_name' WHERE id = $id");

       if($query){
           echo "<script>alert('You have successfully inserted the data');</script>";
           echo "<script type='text/javascript'> document.location ='products-listing.php'; </script>";
       } else {
           echo "<script>alert('Data was not inserted');</script>";
       }

   } else {
       echo "<script>alert('Something Went Wrong. Please try again');</script>";
   }
?>