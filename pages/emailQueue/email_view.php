<?php
include $_SERVER['DOCUMENT_ROOT'] . '/ecommerce/ecommerce/connection.php';

$id = intval($_GET['id']);
if(!$id) die("Invalid email ID");

$sql = "SELECT * FROM email_queue WHERE id=$id AND deleted_on IS NULL";
$res = mysqli_query($conn, $sql);
$email = mysqli_fetch_assoc($res);
if(!$email) die("Email not found");
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Email #<?= $id ?></title>
    <link href="/ecommerce/ecommerce/assets/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-4">
    <h2>Email Queue Entry #<?= $id ?></h2>
    <p><b>Recipient Email:</b> <?= htmlspecialchars($email['recipient_email']) ?></p>
    <p><b>Subject:</b> <?= htmlspecialchars($email['SUBJECT']) ?></p>
    <p><b>Body:</b> <pre><?= htmlspecialchars($email['body']) ?></pre></p>
    <p><b>Email Type:</b> <?= htmlspecialchars($email['email_type']) ?></p>
    <p><b>Status:</b> <?= htmlspecialchars($email['STATUS']) ?></p>
    <p><b>Attempts:</b> <?= $email['attempts'] ?></p>
    <p><b>Scheduled At:</b> <?= $email['scheduled_at'] ?></p>
    <p><b>Active:</b> <?= $email['is_active'] ? 'Yes' : 'No' ?></p>
    <a href="email_queue-list.php" class="btn btn-secondary">Back to List</a>
</div>
</body>
</html>
