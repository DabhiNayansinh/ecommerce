<?php
include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/ecommerce/connection.php';

$id = intval($_GET['id']);
if(!$id) die("Invalid email ID");

$sql = "SELECT * FROM email_queue WHERE id=$id AND deleted_on IS NULL";
$res = mysqli_query($conn, $sql);
$email = mysqli_fetch_assoc($res);
if(!$email) die("Email not found");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recipient_email = mysqli_real_escape_string($conn, $_POST['recipient_email']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $body = mysqli_real_escape_string($conn, $_POST['body']);
    $email_type = $_POST['email_type'];
    $status = $_POST['status'];
    $attempts = intval($_POST['attempts']);
    $scheduled_at = mysqli_real_escape_string($conn, $_POST['scheduled_at']);
    $is_active = isset($_POST['is_active']) ? 1 : 0;
    $modify_by = 1;

    $sql = "UPDATE email_queue SET 
            recipient_email='$recipient_email', SUBJECT='$subject', body='$body', 
            email_type='$email_type', STATUS='$status', attempts=$attempts, 
            scheduled_at='$scheduled_at', is_active=$is_active, modify_by=$modify_by
            WHERE id=$id";
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
    <title>Edit Email #<?= $id ?></title>
    <link href="/ecommerce/ecommerce/assets/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-4">
    <h2>Edit Email Queue Entry #<?= $id ?></h2>
    <?php if(!empty($error_msg)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error_msg) ?></div>
    <?php endif; ?>
    <form method="POST">
        <div class="mb-3">
            <label>Recipient Email</label>
            <input type="email" name="recipient_email" class="form-control" value="<?= htmlspecialchars($email['recipient_email']) ?>" required />
        </div>
        <div class="mb-3">
            <label>Subject</label>
            <input type="text" name="subject" class="form-control" value="<?= htmlspecialchars($email['SUBJECT']) ?>" required />
        </div>
        <div class="mb-3">
            <label>Body</label>
            <textarea name="body" class="form-control" rows="5" required><?= htmlspecialchars($email['body']) ?></textarea>
        </div>
        <div class="mb-3">
            <label>Email Type</label>
            <select name="email_type" class="form-control" required>
                <option value="order_confirmation" <?= $email['email_type']=='order_confirmation'?'selected':'' ?>>Order Confirmation</option>
                <option value="newsletter" <?= $email['email_type']=='newsletter'?'selected':'' ?>>Newsletter</option>
                <option value="password_reset" <?= $email['email_type']=='password_reset'?'selected':'' ?>>Password Reset</option>
                <option value="promotional" <?= $email['email_type']=='promotional'?'selected':'' ?>>Promotional</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="pending" <?= $email['STATUS']=='pending'?'selected':'' ?>>Pending</option>
                <option value="sent" <?= $email['STATUS']=='sent'?'selected':'' ?>>Sent</option>
                <option value="failed" <?= $email['STATUS']=='failed'?'selected':'' ?>>Failed</option>
                <option value="retry" <?= $email['STATUS']=='retry'?'selected':'' ?>>Retry</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Attempts</label>
            <input type="number" name="attempts" class="form-control" value="<?= $email['attempts'] ?>" min="0" />
        </div>
        <div class="mb-3">
            <label>Scheduled At</label>
            <input type="datetime-local" name="scheduled_at" class="form-control" value="<?= date('Y-m-d\TH:i', strtotime($email['scheduled_at'])) ?>" required />
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" name="is_active" class="form-check-input" <?= $email['is_active'] ? 'checked' : '' ?> />
            <label class="form-check-label">Active</label>
        </div>
        <button type="submit" class="btn btn-primary">Update Email</button>
        <a href="email_queue-list.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
