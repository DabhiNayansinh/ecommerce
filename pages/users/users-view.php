<?php
include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/ecommerce/connection.php';

if (!isset($_GET['viewId'])) {
    die("Invalid request.");
}
$viewId = intval($_GET['viewId']);

$result = mysqli_query($conn, "SELECT * FROM users WHERE id = $viewId AND is_active = 1");

if (mysqli_num_rows($result) == 0) {
    header("Location: 404.php");
    die("User not found.");
}

$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>User Details</h2>
    <table class="table table-bordered">
        <tr><th>Username</th><td><?= htmlspecialchars($user['username']) ?></td></tr>
        <tr><th>Email</th><td><?= htmlspecialchars($user['email']) ?></td></tr>
        <tr><th>Phone</th><td><?= htmlspecialchars($user['phone_number']) ?></td></tr>
        <tr><th>Mobile</th><td><?= htmlspecialchars($user['mobile_number']) ?></td></tr>
        <tr><th>Country</th><td><?= $user['country_id'] ?></td></tr>
        <tr><th>State</th><td><?= $user['state_id'] ?></td></tr>
        <tr><th>City</th><td><?= $user['city_id'] ?></td></tr>
        <tr><th>Pincode</th><td><?= $user['pincode_id'] ?></td></tr>
        <tr><th>Address Line 1</th><td><?= $user['address_line1'] ?></td></tr>
        <tr><th>Address Line 2</th><td><?= $user['address_line2'] ?></td></tr>
        <tr><th>Image</th>
            <td>
                <?php if (!empty($user['image'])): ?>
                    <img src="/ecommerce/ecommerce/uploads/<?= $user['image'] ?>" width="150">
                <?php else: ?>
                    No Image
                <?php endif; ?>
            </td>
        </tr>
        <tr><th>Created On</th><td><?= $user['created_on'] ?></td></tr>
        <tr><th>Created By</th><td><?= $user['created_by'] ?></td></tr>
        <tr><th>Modify On</th><td><?= $user['modify_on'] ?></td></tr>
        <tr><th>Modify By</th><td><?= $user['modify_by'] ?></td></tr>
    </table>
    <a href="users-listing.php" class="btn btn-secondary">Back</a>
</div>
</body>
</html>
