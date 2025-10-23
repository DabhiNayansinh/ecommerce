<?php
include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/ecommerce/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = intval($_POST['product_id']);
    $category_id = intval($_POST['category_id']);
    $is_active = isset($_POST['is_active']) ? 1 : 0;
    $created_by = 1;

    $sql = "INSERT INTO product_categories (product_id, category_id, is_active, created_by)
            VALUES ($product_id, $category_id, $is_active, $created_by)";
    if (mysqli_query($conn, $sql)) {
        header('Location: product-category-list.php');
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

$products = mysqli_query($conn, "SELECT id, name FROM products WHERE is_deleted = 0");
$categories = mysqli_query($conn, "SELECT id, name FROM categories WHERE is_deleted = 0");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Product-Category</title>
    <link rel="stylesheet" href="/ecommerce/ecommerce/assets/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Add Product to Category</h2>
    <form method="post">
        <div class="form-group">
            <label>Product</label>
            <select name="product_id" class="form-control" required>
                <option value="">Select Product</option>
                <?php while($p = mysqli_fetch_assoc($products)): ?>
                    <option value="<?= $p['id'] ?>"><?= $p['name'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Category</label>
            <select name="category_id" class="form-control" required>
                <option value="">Select Category</option>
                <?php while($c = mysqli_fetch_assoc($categories)): ?>
                    <option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group form-check">
            <input type="checkbox" name="is_active" class="form-check-input" checked>
            <label class="form-check-label">Is Active?</label>
        </div>
        <button type="submit" class="btn btn-success">Add Mapping</button>
    </form>
</div>
</body>
</html>
