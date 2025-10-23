<?php
 	include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/ecommerce/connection.php';
	// if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
		
	// 	header('location: login-form.php');
	// 	exit;
	// }
	if(isset($_POST['submit'])) {

		$categoriesName = $_POST['categories-name'];
		$query = mysqli_query($conn,"INSERT INTO categories (name) VALUE ('$categoriesName')");

		if($query){
			// print_r('hello');die();
			header("Location: /ecommerce/ecommerce/pages/categories/categories-listing.php");
		} else {
			echo "<script>alert('Data was not inserted');</script>";
		}

	} else {
		echo "<script>alert('Something Went Wrong. Please try again');</script>";
	}
?>