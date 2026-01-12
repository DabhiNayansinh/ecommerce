<?php
include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/ecommerce/connection.php';

$order_id = intval($_GET['id']);
if(!$order_id) {
    die("Invalid order ID");
}

// Get order info + user
$order_q = mysqli_query($conn, "
    SELECT o.*, u.username 
    FROM orders o
    LEFT JOIN users u ON o.user_id = u.id
    WHERE o.id = $order_id AND o.deleted_on IS NULL
");
$order = mysqli_fetch_assoc($order_q);
if(!$order) die("Order not found");

// Get order items + product info
$items_q = mysqli_query($conn, "
    SELECT oi.*, p.name AS product_name 
    FROM order_items oi 
    LEFT JOIN products p ON oi.product_id = p.id
    WHERE oi.order_id = $order_id AND oi.deleted_on IS NULL
");

?>

<!DOCTYPE html>
<html>
<head>
    <title>View Order #<?= $order_id ?></title>
    <link href="/ecommerce/ecommerce/assets/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Order #<?= $order_id ?></h2>
    <p><b>User:</b> <?= htmlspecialchars($order['username']) ?></p>
    <p><b>Status:</b> <?= htmlspecialchars($order['status']) ?></p>
    <p><b>Order Date:</b> <?= $order['order_date'] ?></p>
    <p><b>Total:</b> <?= number_format($order['total'], 2) ?></p>

    <h4>Items</h4>
    <table class="table table-bordered">
        <thead>
            <tr><th>Product</th><th>Quantity</th><th>Price</th><th>Subtotal</th></tr>
        </thead>
        <tbody>
        <?php while($item = mysqli_fetch_assoc($items_q)): ?>
            <tr>
                <td><?= htmlspecialchars($item['product_name']) ?></td>
                <td><?= $item['quantity'] ?></td>
                <td><?= number_format($item['price'], 2) ?></td>
                <td><?= number_format($item['quantity'] * $item['price'], 2) ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
    <a href="orders-list.php" class="btn btn-secondary">Back to List</a>
</div>
</body>
</html>
