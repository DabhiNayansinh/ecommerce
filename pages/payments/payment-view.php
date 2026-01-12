<?php
include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/ecommerce/connection.php';

$id = intval($_GET['id']);
if(!$id) die("Invalid payment ID");

$sql = "SELECT p.*, o.status AS order_status 
        FROM payments p 
        LEFT JOIN orders o ON p.order_id = o.id
        WHERE p.id = $id AND p.deleted_on IS NULL";
$res = mysqli_query($conn, $sql);
$payment = mysqli_fetch_assoc($res);
if(!$payment) die("Payment not found");
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Payment #<?= $id ?></title>
    <link href="/ecommerce/ecommerce/assets/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-4">
    <h2>Payment #<?= $id ?></h2>
    <p><b>Order ID:</b> <?= $payment['order_id'] ?></p>
    <p><b>Order Status:</b> <?= htmlspecialchars($payment['order_status']) ?></p>
    <p><b>Payment Date:</b> <?= $payment['payment_date'] ?></p>
    <p><b>Amount:</b> <?= number_format($payment['amount'], 2) ?></p>
    <p><b>Method:</b> <?= htmlspecialchars($payment['method']) ?></p>
    <p><b>Active:</b> <?= $payment['is_active'] ? 'Yes' : 'No' ?></p>
    <a href="payments-list.php" class="btn btn-secondary">Back to List</a>
</div>
</body>
</html>
