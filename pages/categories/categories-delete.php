<?php
 	include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/ecommerce/connection.php';
    
    // if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
    //     header('location: login-form.php');
    //     exit;
    // }

    if(isset($_GET['delId'])){

        $delId = $_GET['delId'];
        // $query=mysqli_query($conn,"DELETE FROM categories where id = $delId ");
        $deleted_on = date('Y-m-d H:i:s');
        $deleted_by = 1;
        $is_active = 0;
        $query=mysqli_query($conn,"update categories set is_active='$is_active',deleted_on='$deleted_on',deleted_by='$deleted_by' where id = ' $delId' "); 

        // $query=mysqli_query($con, "update  tblusers set FirstName='$fname',LastName='$lname', MobileNumber='$contno', Email='$email', Address='$add' where ID='$eid'");
        if($query) {
			header("Location: /ecommerce/ecommerce/pages/categories/categories-listing.php");
        } else {
            echo "<script>alert('Data was not deleted');</script>";
        }

    } else {
        echo "<script>alert('Something Went Wrong. Please try again');</script>";
    }
?>