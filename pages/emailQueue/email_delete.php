<?php
include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/ecommerce/connection.php';

$id = intval($_GET['id']);
if(!$id) die("Invalid email ID");

$deleted_by = 1;

$sql = "UPDATE email_queue SET deleted_on=NOW(), deleted_by=$deleted_by WHERE id=$id AND deleted_on IS NULL";
if (mysqli_query($conn, $sql)) {
    header("Location: email_queue-list.php");
    exit;
} else {
    echo "Delete failed: " . mysqli_error($conn);
}
