<?php

function storeEmailDetails($recipientEmail, $subject, $body, $emailType, $pdo) {
    // Validate inputs
    if (!filter_var($recipientEmail, FILTER_VALIDATE_EMAIL)) {
        return ['success' => false, 'message' => 'Invalid email address.'];
    }

    if (empty($subject) || empty($body) || empty($emailType)) {
        return ['success' => false, 'message' => 'Subject, body, and email type cannot be empty.'];
    }

    // Prepare SQL statement
    $sql = "INSERT INTO email_queue (recipient_email, subject, body, email_type, status, created_at, updated_at)
            VALUES (:recipient_email, :subject, :body, :email_type, 'pending', NOW(), NOW())";

    try {
        // Prepare the statement
        $stmt = $pdo->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':recipient_email', $recipientEmail);
        $stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':body', $body);
        $stmt->bindParam(':email_type', $emailType);

        // Execute the statement
        $stmt->execute();

        return ['success' => true, 'message' => 'Email details stored successfully.'];
    } catch (PDOException $e) {
        // Handle error
        return ['success' => false, 'message' => 'Database error: ' . $e->getMessage()];
    }
}
?>