<?php
	include('connection.php');

	if(isset($_POST['submit'])) {

		$categoriesName = $_POST['categories-name'];
		$query = mysqli_query($conn,"INSERT INTO categories(name) VALUE ('$categoriesName')");

		if($query){
			echo "<script>alert('You have successfully inserted the data');</script>";
			echo "<script type='text/javascript'> document.location ='categories-listing.php'; </script>";
		} else {
			echo "<script>alert('Data was not inserted');</script>";
		}

	} else {
		echo "<script>alert('Something Went Wrong. Please try again');</script>";
	}
?>