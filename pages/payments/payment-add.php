<?php
include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/ecommerce/connection.php';

$orders = mysqli_query($conn, "SELECT id, status FROM orders WHERE deleted_on IS NULL AND is_active = 1");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = intval($_POST['order_id']);
    $payment_date = mysqli_real_escape_string($conn, $_POST['payment_date']);
    $amount = floatval($_POST['amount']);
    $method = mysqli_real_escape_string($conn, $_POST['method']);
    $is_active = isset($_POST['is_active']) ? 1 : 0;
    $created_by = 1;

    $sql = "INSERT INTO payments (order_id, payment_date, amount, method, is_active, created_by) 
            VALUES ($order_id, '$payment_date', $amount, '$method', $is_active, $created_by)";
    if (mysqli_query($conn, $sql)) {
        header("Location: payments-list.php");
        exit;
    } else {
        $error_msg = mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Payment</title>
    <link href="/ecommerce/ecommerce/assets/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-4">
    <h2>Add Payment</h2>
    <?php if(!empty($error_msg)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error_msg) ?></div>
    <?php endif; ?>
    <form method="POST">
        <div class="mb-3">
            <label>Order</label>
            <select name="order_id" class="form-control" required>
                <option value="">Select Order</option>
                <?php while($o = mysqli_fetch_assoc($orders)): ?>
                    <option value="<?= $o['id'] ?>"><?= "Order #{$o['id']} - {$o['status']}" ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Payment Date</label>
            <input type="datetime-local" name="payment_date" class="form-control" value="<?= date('Y-m-d\TH:i') ?>" required />
        </div>
        <div class="mb-3">
            <label>Amount</label>
            <input type="number" step="0.01" name="amount" class="form-control" required />
        </div>
        <div class="mb-3">
            <label>Method</label>
            <input type="text" name="method" class="form-control" />
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" name="is_active" class="form-check-input" checked />
            <label class="form-check-label">Active</label>
        </div>
        <button type="submit" class="btn btn-primary">Add Payment</button>
        <a href="payments-list.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
