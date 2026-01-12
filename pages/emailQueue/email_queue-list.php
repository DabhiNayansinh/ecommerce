<?php
include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/ecommerce/connection.php';

$sql = "SELECT * FROM email_queue WHERE deleted_on IS NULL ORDER BY scheduled_at DESC";
$res = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Email Queue</title>
    <link href="/ecommerce/ecommerce/assets/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-4">
    <h2>Email Queue</h2>
    <a href="email_add.php" class="btn btn-primary mb-3">Add Email</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Recipient Email</th>
                <th>Subject</th>
                <th>Type</th>
                <th>Status</th>
                <th>Attempts</th>
                <th>Scheduled At</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = mysqli_fetch_assoc($res)): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['recipient_email']) ?></td>
                <td><?= htmlspecialchars($row['SUBJECT']) ?></td>
                <td><?= htmlspecialchars($row['email_type']) ?></td>
                <td><?= htmlspecialchars($row['STATUS']) ?></td>
                <td><?= $row['attempts'] ?></td>
                <td><?= $row['scheduled_at'] ?></td>
                <td><?= $row['is_active'] ? 'Yes' : 'No' ?></td>
                <td>
                    <a href="email_view.php?id=<?= $row['id'] ?>" class="btn btn-info btn-sm">View</a>
                    <a href="email_edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="email_delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this email?')">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
