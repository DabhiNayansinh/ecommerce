<?php
include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/ecommerce/connection.php';

$users = mysqli_query($conn, "SELECT id, username FROM users WHERE is_active = 1 AND is_deleted IS NULL");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = intval($_POST['user_id']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $is_active = isset($_POST['is_active']) ? 1 : 0;
    $created_by = 1;

    // Items: arrays from form inputs
    $product_ids = $_POST['product_id'] ?? [];
    $quantities = $_POST['quantity'] ?? [];
    $prices = $_POST['price'] ?? [];

    // Calculate total
    $total = 0;
    foreach ($product_ids as $i => $pid) {
        $total += floatval($prices[$i]) * intval($quantities[$i]);
    }

    mysqli_begin_transaction($conn);

    try {
        $sql = "INSERT INTO orders (user_id, status, total, is_active, created_by) 
                VALUES ($user_id, '$status', $total, $is_active, $created_by)";
        if(!mysqli_query($conn, $sql)) throw new Exception(mysqli_error($conn));
        $order_id = mysqli_insert_id($conn);

        // Insert items
        foreach ($product_ids as $i => $pid) {
            $pid = intval($pid);
            $qty = intval($quantities[$i]);
            $price = floatval($prices[$i]);
            $sql_item = "INSERT INTO order_items (order_id, product_id, quantity, price, is_active, created_by) 
                         VALUES ($order_id, $pid, $qty, $price, 1, $created_by)";
            if(!mysqli_query($conn, $sql_item)) throw new Exception(mysqli_error($conn));
        }

        mysqli_commit($conn);
        header("Location: orders-list.php");
        exit;
    } catch (Exception $e) {
        mysqli_rollback($conn);
        $error_msg = $e->getMessage();
    }
}
$products = mysqli_query($conn, "SELECT id, name, price FROM products WHERE is_active=1 AND is_deleted IS NULL");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Order</title>
    <link href="/ecommerce/ecommerce/assets/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container mt-4">
    <h2>Create New Order</h2>
    <?php if(!empty($error_msg)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error_msg) ?></div>
    <?php endif; ?>
    <form method="POST" id="orderForm">
        <div class="mb-3">
            <label>User</label>
            <select name="user_id" class="form-control" required>
                <option value="">Select User</option>
                <?php while($u = mysqli_fetch_assoc($users)): ?>
                    <option value="<?= $u['id'] ?>"><?= htmlspecialchars($u['username']) ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Status</label>
            <input type="text" name="status" class="form-control" value="pending" required>
        </div>
        <div class="mb-3">
            <label>Active</label>
            <input type="checkbox" name="is_active" checked>
        </div>

        <h4>Order Items</h4>
        <table class="table" id="itemsTable">
            <thead>
                <tr>
                    <th>Product</th><th>Quantity</th><th>Price</th><th><button type="button" id="addItem" class="btn btn-success btn-sm">Add Item</button></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select name="product_id[]" class="form-control product-select" required>
                            <option value="">Select Product</option>
                            <?php
                            mysqli_data_seek($products, 0);
                            while($p = mysqli_fetch_assoc($products)): ?>
                                <option value="<?= $p['id'] ?>" data-price="<?= $p['price'] ?>"><?= htmlspecialchars($p['name']) ?></option>
                            <?php endwhile; ?>
                        </select>
                    </td>
                    <td><input type="number" name="quantity[]" class="form-control" min="1" value="1" required></td>
                    <td><input type="text" name="price[]" class="form-control price-field" readonly></td>
                    <td><button type="button" class="btn btn-danger btn-sm removeItem">Remove</button></td>
                </tr>
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Create Order</button>
        <a href="orders-list.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script>
$(document).ready(function(){
    function updatePrice(row) {
        var selectedOption = row.find('select.product-select option:selected');
        var price = selectedOption.data('price') || 0;
        row.find('input.price-field').val(price);
    }

    $('#itemsTable').on('change', 'select.product-select', function(){
        updatePrice($(this).closest('tr'));
    });

    $('#addItem').click(function(){
        var newRow = $('#itemsTable tbody tr:first').clone();
        newRow.find('select').val('');
        newRow.find('input.quantity').val(1);
        newRow.find('input.price-field').val('');
        $('#itemsTable tbody').append(newRow);
    });

    $('#itemsTable').on('click', '.removeItem', function(){
        if($('#itemsTable tbody tr').length > 1) {
            $(this).closest('tr').remove();
        }
    });

    // Trigger price fill on page load for first row
    updatePrice($('#itemsTable tbody tr:first'));
});
</script>

</body>
</html>
