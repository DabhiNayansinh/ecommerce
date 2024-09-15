<?php
    include('connection.php');
    
    if(isset($_GET['delId'])){

        $delId = $_GET['delId'];
        // $query=mysqli_query($conn,"DELETE FROM categories where id = $delId ");
        $deleted_on = date('Y-m-d H:i:s');
        $deleted_by = 1;
        $is_active = 0;
        $query=mysqli_query($conn,"update categories set is_active='$is_active',deleted_on='$deleted_on',deleted_by='$deleted_by' where id = ' $delId' "); 

        // $query=mysqli_query($con, "update  tblusers set FirstName='$fname',LastName='$lname', MobileNumber='$contno', Email='$email', Address='$add' where ID='$eid'");
        if($query) {
            echo "<script>alert('Successfully deleted the data');</script>";
            echo "<script type='text/javascript'> document.location ='categories-listing.php'; </script>";
        } else {
            echo "<script>alert('Data was not deleted');</script>";
        }

    } else {
        echo "<script>alert('Something Went Wrong. Please try again');</script>";
    }
?>