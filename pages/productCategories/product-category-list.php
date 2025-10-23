<?php
include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/ecommerce/connection.php';

$query = "SELECT pc.*, p.name AS product_name, c.name AS category_name 
          FROM product_categories pc
          JOIN products p ON p.id = pc.product_id
          JOIN categories c ON c.id = pc.category_id
          WHERE pc.deleted_on IS NULL";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Product-Category Mapping</title>
    <link rel="stylesheet" href="/ecommerce/ecommerce/assets/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Product-Category Mapping</h2>
    <a href="add-mapping.php" class="btn btn-primary mb-2">+ Add Mapping</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product</th>
                <th>Category</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $row['product_name'] ?></td>
                <td><?= $row['category_name'] ?></td>
                <td><?= $row['is_active'] ? 'Yes' : 'No' ?></td>
                <td>
                    <a href="edit-mapping.php?product_id=<?= $row['product_id'] ?>&category_id=<?= $row['category_id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="delete-mapping.php?product_id=<?= $row['product_id'] ?>&category_id=<?= $row['category_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete?')">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
