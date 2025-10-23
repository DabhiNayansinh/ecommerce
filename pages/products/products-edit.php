<?php
include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/ecommerce/connection.php';
// print_r($_GET);exit();
if (!isset($_GET['editId']) || !is_numeric($_GET['editId'])) {
    echo "<h3 style='color:red'>Invalid Product ID</h3>";
    exit;
}

$editId = intval($_GET['editId']);
$query = mysqli_query($conn, "SELECT * FROM products WHERE id = $editId");

if (!$query || mysqli_num_rows($query) == 0) {
    echo "<h3 style='color:red'>Product Not Found</h3>";
    exit;
}

$row = mysqli_fetch_assoc($query);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Product</h2>
    <form action="products-update.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="editId" value="<?php echo $editId; ?>">

        <div class="mb-3">
            <label>Category</label>
            <select name="category_id" class="form-control" required>
                <option value="">Select Category</option>
                <?php
                $result = mysqli_query($conn, "SELECT * FROM categories");
                while ($cat = mysqli_fetch_assoc($result)) {
                    $selected = $cat['id'] == $row['category_id'] ? 'selected' : '';
                    echo "<option value='{$cat['id']}' $selected>{$cat['name']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Product Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($row['name']); ?>">
        </div>

        <div class="mb-3">
            <label>Brand</label>
            <input type="text" name="brand" class="form-control" value="<?php echo htmlspecialchars($row['brand']); ?>">
        </div>

        <div class="mb-3">
            <label>Description</label>
            <input type="text" name="description" class="form-control" value="<?php echo htmlspecialchars($row['description']); ?>">
        </div>

        <div class="mb-3">
            <label>Price</label>
            <input type="text" name="price" class="form-control" value="<?php echo htmlspecialchars($row['price']); ?>">
        </div>

        <div class="mb-3">
            <label>Discount (%)</label>
            <input type="text" name="discount" class="form-control" value="<?php echo htmlspecialchars($row['discount']); ?>">
        </div>

        <div class="mb-3">
            <label>Quantity</label>
            <input type="text" name="stock_quantity" class="form-control" value="<?php echo htmlspecialchars($row['stock_quantity']); ?>">
        </div>

        <div class="mb-3">
            <label>Size</label>
            <input type="text" name="size" class="form-control" value="<?php echo htmlspecialchars($row['size']); ?>">
        </div>

        <div class="mb-3">
            <label>Colors</label>
            <input type="text" name="colors" class="form-control" value="<?php echo htmlspecialchars($row['colors']); ?>">
        </div>

        <div class="mb-3">
            <label>Current Image</label><br>
            <?php if (!empty($row['image'])): ?>
                <img src="/ecommerce/ecommerce/uploads/<?php echo $row['image']; ?>" width="100">
            <?php else: ?>
                No image uploaded.
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label>Change Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" name="submit" class="btn btn-success">Update Product</button>
        <a href="products-listing.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
