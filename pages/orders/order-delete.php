<?php
include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/ecommerce/connection.php';

$order_id = intval($_GET['id']);
if(!$order_id) die("Invalid Order ID");

$deleted_by = 1;

mysqli_begin_transaction($conn);

try {
    $del_order = "UPDATE orders SET deleted_on=NOW(), deleted_by=$deleted_by WHERE id=$order_id AND deleted_on IS NULL";
    if(!mysqli_query($conn, $del_order)) throw new Exception(mysqli_error($conn));

    $del_items = "UPDATE order_items SET deleted_on=NOW(), deleted_by=$deleted_by WHERE order_id=$order_id AND deleted_on IS NULL";
    if(!mysqli_query($conn, $del_items)) throw new Exception(mysqli_error($conn));

    mysqli_commit($conn);

    header("Location: orders-list.php");
    exit;
} catch(Exception $e) {
    mysqli_rollback($conn);
    echo "Delete failed: " . $e->getMessage();
}
