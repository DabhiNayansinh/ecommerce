<?php
 include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/ecommerce/connection.php';

	// if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
	// 	header('location: login-form.php');
	// 	exit;
	// }
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


    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Define the target directory for uploads
        $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/ecommerce/ecommerce/uploads/";
        // Define allowed extensions for each file type (you can modify this list as needed)
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'docx', 'txt']; // Example extensions
        // Call the uploadFile function to upload the document (image, pdf, etc.)
        $uploadedFile = uploadFile($_FILES['image'], $targetDir, $allowedExtensions);
        // If a file was uploaded, $uploadedFile will contain the file name
        // If no file is uploaded, $uploadedFile will be null
        $image_name = $uploadedFile;
    } else {
        $image_name = null;
    }
    
    $image_name = null;
    print_r($image_name);
    print_r($_POST);

    $query = mysqli_query($conn,"INSERT INTO products (`name`,price,`image`,`description`,stock_quantity,category_id,brand,`size`,colors,discount)
        VALUE ('$name','$price','$image_name',$description,'$stock_quantity','$category_id','$brand','$size','$colors','$discount')");

		if($query){
			echo "<script>alert('You have successfully inserted the data');</script>";
			echo "<script type='text/javascript'> document.location ='products-listing.php'; </script>";
		} else {
            $error = mysqli_error($conn); // Get error message from MySQL
            echo $error;
        // echo "<script>alert('Data was not inserted. Error: $error');</script>";
		}

	} else {
		echo "<script>alert('Something Went Wrong. Please try again');</script>";
	}
?>