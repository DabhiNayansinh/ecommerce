<?php
include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/ecommerce/connection.php';

$query = "
    SELECT o.*, u.username 
    FROM orders o
    LEFT JOIN users u ON o.user_id = u.id
    WHERE o.deleted_on IS NULL
    ORDER BY o.order_date DESC
";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Orders List</title>
    <link href="/ecommerce/ecommerce/assets/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Orders List</h2>
    <a href="order-add.php" class="btn btn-primary mb-3">Create New Order</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Total</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while($order = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $order['id'] ?></td>
                <td><?= htmlspecialchars($order['username']) ?></td>
                <td><?= $order['order_date'] ?></td>
                <td><?= htmlspecialchars($order['status']) ?></td>
                <td><?= number_format($order['total'], 2) ?></td>
                <td><?= $order['is_active'] ? 'Yes' : 'No' ?></td>
                <td>
                    <a href="order-view.php?id=<?= $order['id'] ?>" class="btn btn-info btn-sm">View</a>
                    <a href="order-edit.php?id=<?= $order['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="order-delete.php?id=<?= $order['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this order?')">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
