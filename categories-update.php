<?php
    include('connection.php');

    if(isset($_POST['submit'])){

        $editId=$_POST['editId'];
    	$categoriesName = $_POST['categories-name'];
        $query=mysqli_query($conn,"update categories set name='$categoriesName' where id = ' $editId' "); 
    
        if($query){
    		echo "<script>alert('You have successfully updated the data');</script>";
    		echo "<script type='text/javascript'> document.location ='categories-listing.php'; </script>";
    	} else {
    		echo "<script>alert('Data was not inserted');</script>";
    	}

    } else {
    	echo "<script>alert('Something Went Wrong. Please try again');</script>";
    }
?>