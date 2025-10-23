<?php
include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/ecommerce/connection.php';

$product_id = intval($_GET['product_id']);
$category_id = intval($_GET['category_id']);
$deleted_by = 1;

$update = mysqli_query($conn, "UPDATE product_categories 
                               SET deleted_on = NOW(), deleted_by = $deleted_by 
                               WHERE product_id=$product_id AND category_id=$category_id");
header("Location: product-category-list.php");
?>
