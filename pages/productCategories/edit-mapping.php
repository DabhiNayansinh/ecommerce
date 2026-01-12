<?php
include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/ecommerce/connection.php';

$product_id = intval($_GET['product_id']);
$category_id = intval($_GET['category_id']);

$query = mysqli_query($conn, "SELECT * FROM product_categories WHERE product_id=$product_id AND category_id=$category_id LIMIT 1");
$data = mysqli_fetch_assoc($query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $is_active = isset($_POST['is_active']) ? 1 : 0;
    $modify_by = 1;

    $update = mysqli_query($conn, "UPDATE product_categories 
                                   SET is_active = $is_active, modify_by = $modify_by 
                                   WHERE product_id=$product_id AND category_id=$category_id");
    header("Location: product-category-list.php");
}
?>
<!-- Form -->
<form method="post" class="container mt-4">
    <h2>Edit Mapping</h2>
    <div class="form-check">
        <input type="checkbox" name="is_active" class="form-check-input" <?= $data['is_active'] ? 'checked' : '' ?>>
        <label class="form-check-label">Is Active?</label>
    </div>
    <button class="btn btn-primary mt-3">Update</button>
</form>
