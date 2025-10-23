<?php
// error_reporting(E_ALL);
include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/ecommerce/connection.php';

if (!isset($_GET['delId'])) {
    die("Invalid Request");
}

$delId = intval($_GET['delId']);
$deleted_on = date('Y-m-d H:i:s');
$deleted_by = 1;
// session_start();
// $deleted_by = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
$is_active = 0;
$is_deleted = 1;

$query = mysqli_query($conn, "
    UPDATE users 
    SET 
        is_active = $is_active,
        is_deleted = $is_deleted,
        deleted_on = '$deleted_on', 
        deleted_by = $deleted_by 
    WHERE id = $delId
");

if ($query) {
    header("Location: /ecommerce/ecommerce/pages/users/users-listing.php");
    exit;
} else {
    // echo "MySQL Error: " . mysqli_error($conn);
        echo "<script>alert('Failed to delete user'); window.location.href='users-listing.php';</script>";

}
?>
