<?php
error_reporting(0); // Suppress error reporting
include_once('../config.php');

// Get the POST data
$data = json_decode(file_get_contents('php://input'), true);

$sender = $data['sender'];
$message = $data['message'];

// Insert the message into the database
$sql = "INSERT INTO messages (sender_id, message, date_sent) VALUES ('$sender', '$message', NOW())";
$result = $conn->query($sql);

if ($result) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}

$conn->close();
