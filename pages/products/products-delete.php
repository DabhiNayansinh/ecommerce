<?php
include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/ecommerce/connection.php';

if (isset($_GET['delId']) && is_numeric($_GET['delId'])) {
    $delId = intval($_GET['delId']);

        $deleted_on = date('Y-m-d H:i:s');
        $deleted_by = 1;
        $is_active = 0;
        $query=mysqli_query($conn,"update products set is_active='$is_active',deleted_on='$deleted_on',deleted_by='$deleted_by' where id = ' $delId' "); 

    if ($query) {
        header("Location: products-listing.php?msg=deleted");
        exit;
    } else {
        echo "Error deleting product: " . mysqli_error($conn);
    }
} else {
    header("Location: products-listing.php");
    exit;
}
?>
