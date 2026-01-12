<?php
 include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/ecommerce/connection.php';

	// if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
	// 	header('location: login-form.php');
	// 	exit;
	// }
	if(isset($_POST['submit'])) {
		$name = trim($_POST['name']);
		$brand = trim($_POST['brand']);
		$description = trim($_POST['description']);
		$size = trim($_POST['size']);
		$colors = trim($_POST['colors']);
		$category_id = intval($_POST['category_id']);
		$price = is_numeric($_POST['price']) ? $_POST['price'] : 0;
		$discount = is_numeric($_POST['discount']) ? $_POST['discount'] : 0;
		$stock_quantity = is_numeric($_POST['stock_quantity']) ? $_POST['stock_quantity'] : 0;



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

		$query = mysqli_query($conn, "INSERT INTO products (`name`, price, `image`, `description`, stock_quantity, category_id, brand, `size`, colors, discount)
							VALUES ('$name', $price, '$image_name', '$description', $stock_quantity, $category_id, '$brand', '$size', '$colors', $discount)");


		if($query){
			header("Location: /ecommerce/ecommerce/pages/products/products-listing.php");
		} else {
            $error = mysqli_error($conn); // Get error message from MySQL
            echo $error;
        // echo "<script>alert('Data was not inserted. Error: $error');</script>";
		}

	} else {
		echo "<script>alert('Something Went Wrong. Please try again');</script>";
	}
?>