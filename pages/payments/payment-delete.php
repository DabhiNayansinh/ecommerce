<?php
include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/ecommerce/connection.php';

$id = intval($_GET['id']);
if(!$id) die("Invalid payment ID");

$deleted_by = 1;

$sql = "UPDATE payments SET deleted_on=NOW(), deleted_by=$deleted_by WHERE id=$id AND deleted_on IS NULL";
if (mysqli_query($conn, $sql)) {
    header("Location: payments-list.php");
    exit;
} else {
    echo "Delete failed: " . mysqli_error($conn);
}
