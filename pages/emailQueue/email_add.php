<?php
include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/ecommerce/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recipient_email = mysqli_real_escape_string($conn, $_POST['recipient_email']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $body = mysqli_real_escape_string($conn, $_POST['body']);
    $email_type = $_POST['email_type'];
    $status = 'pending';
    $attempts = 0;
    $scheduled_at = mysqli_real_escape_string($conn, $_POST['scheduled_at']);
    $is_active = isset($_POST['is_active']) ? 1 : 0;
    $created_by = 1;

    $sql = "INSERT INTO email_queue 
            (recipient_email, SUBJECT, body, email_type, STATUS, attempts, scheduled_at, is_active, created_by) 
            VALUES 
            ('$recipient_email', '$subject', '$body', '$email_type', '$status', $attempts, '$scheduled_at', $is_active, $created_by)";
    if (mysqli_query($conn, $sql)) {
        header("Location: email_queue-list.php");
        exit;
    } else {
        $error_msg = mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Email to Queue</title>
    <link href="/ecommerce/ecommerce/assets/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-4">
    <h2>Add Email to Queue</h2>
    <?php if(!empty($error_msg)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error_msg) ?></div>
    <?php endif; ?>
    <form method="POST">
        <div class="mb-3">
            <label>Recipient Email</label>
            <input type="email" name="recipient_email" class="form-control" required />
        </div>
        <div class="mb-3">
            <label>Subject</label>
            <input type="text" name="subject" class="form-control" required />
        </div>
        <div class="mb-3">
            <label>Body</label>
            <textarea name="body" class="form-control" rows="5" required></textarea>
        </div>
        <div class="mb-3">
            <label>Email Type</label>
            <select name="email_type" class="form-control" required>
                <option value="order_confirmation">Order Confirmation</option>
                <option value="newsletter">Newsletter</option>
                <option value="password_reset">Password Reset</option>
                <option value="promotional">Promotional</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Scheduled At</label>
            <input type="datetime-local" name="scheduled_at" class="form-control" value="<?= date('Y-m-d\TH:i') ?>" required />
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" name="is_active" class="form-check-input" checked />
            <label class="form-check-label">Active</label>
        </div>
        <button type="submit" class="btn btn-primary">Add Email</button>
        <a href="email_queue-list.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
