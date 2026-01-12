<?php
include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/ecommerce/connection.php';

if (!isset($_GET['editId'])) {
    die("Invalid request.");
}
$editId = intval($_GET['editId']);
$query = mysqli_query($conn, "SELECT * FROM users WHERE id = $editId");
if (mysqli_num_rows($query) == 0) {
    die("User not found.");
}
$user = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5" style="max-width: 700px;">
    <h2>Edit User</h2>
    <form action="users-update.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
        
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($user['username']); ?>" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="text" name="password" class="form-control" value="<?php echo htmlspecialchars($user['password']); ?>">
        </div>
        <div class="mb-3">
            <label>Phone Number</label>
            <input type="text" name="phone_number" class="form-control" value="<?php echo htmlspecialchars($user['phone_number']); ?>">
        </div>
        <div class="mb-3">
            <label>Mobile Number</label>
            <input type="text" name="mobile_number" class="form-control" value="<?php echo htmlspecialchars($user['mobile_number']); ?>">
        </div>
        <div class="mb-3">
            <label>City ID</label>
            <input type="text" name="city_id" class="form-control" value="<?php echo htmlspecialchars($user['city_id']); ?>">
        </div>
        <div class="mb-3">
            <label>State ID</label>
            <input type="text" name="state_id" class="form-control" value="<?php echo htmlspecialchars($user['state_id']); ?>">
        </div>
        <div class="mb-3">
            <label>Country ID</label>
            <input type="text" name="country_id" class="form-control" value="<?php echo htmlspecialchars($user['country_id']); ?>">
        </div>
        <div class="mb-3">
            <label>Pincode ID</label>
            <input type="text" name="pincode_id" class="form-control" value="<?php echo htmlspecialchars($user['pincode_id']); ?>">
        </div>
        <div class="mb-3">
            <label>Address Line 1</label>
            <input type="text" name="address_line1" class="form-control" value="<?php echo htmlspecialchars($user['address_line1']); ?>">
        </div>
        <div class="mb-3">
            <label>Address Line 2</label>
            <input type="text" name="address_line2" class="form-control" value="<?php echo htmlspecialchars($user['address_line2']); ?>">
        </div>

        <div class="mb-3">
            <label>Current Image</label><br>
            <?php if (!empty($user['image'])): ?>
                <img src="/ecommerce/ecommerce/uploads/<?php echo $user['image']; ?>" width="120">
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label>Upload New Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Update</button>
        <a href="users-listing.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
