<?php
include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/ecommerce/connection.php';

$sql = "SELECT p.*, o.status AS order_status 
        FROM payments p 
        LEFT JOIN orders o ON p.order_id = o.id
        WHERE p.deleted_on IS NULL
        ORDER BY p.payment_date DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payments List</title>
    <link href="/ecommerce/ecommerce/assets/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-4">
    <h2>Payments</h2>
    <a href="payment-add.php" class="btn btn-primary mb-3">Add Payment</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Order ID</th>
                <th>Order Status</th>
                <th>Payment Date</th>
                <th>Amount</th>
                <th>Method</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['order_id'] ?></td>
                <td><?= htmlspecialchars($row['order_status']) ?></td>
                <td><?= $row['payment_date'] ?></td>
                <td><?= number_format($row['amount'], 2) ?></td>
                <td><?= htmlspecialchars($row['method']) ?></td>
                <td><?= $row['is_active'] ? 'Yes' : 'No' ?></td>
                <td>
                    <a href="payment-view.php?id=<?= $row['id'] ?>" class="btn btn-info btn-sm">View</a>
                    <a href="payment-edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="payment-delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this payment?')">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
