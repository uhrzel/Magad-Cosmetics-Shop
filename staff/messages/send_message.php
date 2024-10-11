<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once('../../config.php');

// Check if the necessary data is provided
if (isset($_POST['sender_id']) && isset($_POST['reply_message'])  && !empty($_POST['reply_message'])) {
    $sender_id = intval($_POST['sender_id']); // Ensure the sender_id is an integer
    $reply_message = $_POST['reply_message'];
    // Ensure the message_id is an integer

    // Function to send a reply
    function send_reply($conn, $sender_id, $reply_message)
    {
        // Prepare the SQL query to insert into replies table
        $query = "INSERT INTO replies (sender_id, reply_message, date_sent) VALUES ( ?, ?, NOW())";

        $stmt = $conn->prepare($query);
        if (!$stmt) {
            return ['error' => 'SQL preparation failed: ' . $conn->error];
        }

        $stmt->bind_param("is", $sender_id, $reply_message);
        if ($stmt->execute()) {
            return ['success' => 'Reply sent successfully.'];
        } else {
            return ['error' => 'Error sending reply: ' . $stmt->error];
        }
    }

    // Send the reply
    $result = send_reply($conn, $sender_id, $reply_message);

    // Return a JSON response
    header('Content-Type: application/json');
    echo json_encode($result);
} else {
    // Return an error if the necessary data is not provided
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Sender ID, message ID, or reply message not provided.']);
}
