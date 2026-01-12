<?php
include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/ecommerce/connection.php';

if ($id <= 0) {
    die("Invalid product ID.");
}

if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $brand = trim($_POST['brand']);
    $description = trim($_POST['description']);
    $size = trim($_POST['size']);
    $colors = trim($_POST['colors']);
    $category_id = intval($_POST['category_id']);
    $price = is_numeric($_POST['price']) ? $_POST['price'] : 0;
    $discount = is_numeric($_POST['discount']) ? $_POST['discount'] : 0;
    $stock_quantity = is_numeric($_POST['stock_quantity']) ? $_POST['stock_quantity'] : 0;
    $modify_by = 1; // Replace with session user ID if applicable

    // Fetch existing image
    $result = mysqli_query($conn, "SELECT image FROM products WHERE id = $id");
    $existing = mysqli_fetch_assoc($result);
    $image_name = $existing['image'] ?? '';

    // If new image is uploaded
    if (!empty($_FILES["image"]["name"])) {
        $upload_dir = $_SERVER['DOCUMENT_ROOT'] . "/ecommerce/ecommerce/uploads/";
        $new_image = basename($_FILES["image"]["name"]);
        $target_file = $upload_dir . $new_image;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];

        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check && in_array($imageFileType, $allowed)) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image_name = $new_image;
            } else {
                echo "<script>alert('Image upload failed');</script>";
            }
        } else {
            echo "<script>alert('Invalid image format');</script>";
        }
    }

    // Update query
    $update = mysqli_query($conn, "UPDATE products SET 
        name = '$name',
        brand = '$brand',
        description = '$description',
        price = $price,
        discount = $discount,
        size = '$size',
        colors = '$colors',
        stock_quantity = $stock_quantity,
        category_id = $category_id,
        image = '$image_name',
        modify_by = $modify_by
        WHERE id = $id
    ");

    if ($update) {
        header("Location: /ecommerce/ecommerce/pages/products/products-listing.php");
        exit;
    } else {
        echo "<script>alert('Failed to update product');</script>";
        // echo mysqli_error($conn); // Optional: For debugging
    }
} else {
    echo "<script>alert('Invalid request');</script>";
}
?>
