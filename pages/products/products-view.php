<?php
// Include DB connection
include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/ecommerce/connection.php';

// Get the product ID from the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $product_id = intval($_GET['id']);

    // Fetch product from DB
    $query = "SELECT p.*, c.name AS category_name 
              FROM products p 
              LEFT JOIN categories c ON p.category_id = c.id 
              WHERE p.id = $product_id";
    
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
    } else {
        echo "<h3>Product not found.</h3>";
        exit;
    }
} else {
    echo "<h3>Invalid product ID.</h3>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Product</title>
    <link rel="stylesheet" href="/ecommerce/ecommerce/assets/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 40px;
        }
        .product-image {
            max-width: 300px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Product Details</h2>
    <hr>
    <div class="row">
        <div class="col-md-4">
            <?php if (!empty($product['image'])): ?>
                <img src="/ecommerce/ecommerce/uploads/<?php echo htmlspecialchars($product['image']); ?>" alt="Product Image" class="img-thumbnail product-image">
            <?php else: ?>
                <p>No image available.</p>
            <?php endif; ?>
        </div>
        <div class="col-md-8">
            <table class="table table-bordered">
                <tr>
                    <th>Name</th>
                    <td><?php echo htmlspecialchars($product['name']); ?></td>
                </tr>
                <tr>
                    <th>Brand</th>
                    <td><?php echo htmlspecialchars($product['brand']); ?></td>
                </tr>
                <tr>
                    <th>Category</th>
                    <td><?php echo htmlspecialchars($product['category_name']); ?></td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td><?php echo nl2br(htmlspecialchars($product['description'])); ?></td>
                </tr>
                <tr>
                    <th>Price</th>
                    <td>₹<?php echo number_format($product['price'], 2); ?></td>
                </tr>
                <tr>
                    <th>Discount</th>
                    <td><?php echo htmlspecialchars($product['discount']); ?>%</td>
                </tr>
                <tr>
                    <th>Stock Quantity</th>
                    <td><?php echo htmlspecialchars($product['stock_quantity']); ?></td>
                </tr>
                <tr>
                    <th>Size</th>
                    <td><?php echo htmlspecialchars($product['size']); ?></td>
                </tr>
                <tr>
                    <th>Colors</th>
                    <td><?php echo htmlspecialchars($product['colors']); ?></td>
                </tr>
            </table>
            <a href="/ecommerce/ecommerce/pages/products/products-listing.php" class="btn btn-primary">Back to List</a>
        </div>
    </div>
</div>
</body>
</html>
