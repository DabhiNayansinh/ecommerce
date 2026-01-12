<?php
 	include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/ecommerce/connection.php';

    // if(!isset($_SESSION['logggedin']) || $_SESSION['loggedin'] !== true){
    //     header('location: login-form.php');
    //     exit;
    // }

    if(isset($_POST['submit'])){

        $editId=$_POST['editId'];
    	$categoriesName = $_POST['categories-name'];
        $modifyBy = 1;
        $query = mysqli_query($conn, "UPDATE categories SET name='$categoriesName', modify_by='$modifyBy' WHERE id='$editId'");

        if($query){
			header("Location: /ecommerce/ecommerce/pages/categories/categories-listing.php");
    		echo "<script type='text/javascript'> document.location ='categories-listing.php'; </script>";
    	} else {
    		echo "<script>alert('Data was not inserted');</script>";
    	}

    } else {
    	echo "<script>alert('Something Went Wrong. Please try again');</script>";
    }
?>