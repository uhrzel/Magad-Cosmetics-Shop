<?php
error_reporting(0); // Disable error reporting for debugging
include_once('../config.php');

// Get the sender_id from the request, default to 0 if not set
$sender_id = isset($_GET['sender_id']) ? intval($_GET['sender_id']) : 0;

// Prepare the SQL query to fetch messages for the specific sender_id
$sql = "
    SELECT m.*, c.firstname, c.lastname 
    FROM messages m 
    JOIN clients c ON m.sender_id = c.id 
    WHERE m.sender_id = $sender_id
    ORDER BY m.date_sent DESC";

$result = $conn->query($sql);

$messages = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $messages[] = [
            'sender_id' => $row['sender_id'],
            'firstname' => $row['firstname'], // Add first name
            'lastname' => $row['lastname'],   // Add last name
            'message' => $row['message'],
            'date_sent' => date('c', strtotime($row['date_sent'])), // ISO 8601 format
        ];
    }
}

header('Content-Type: application/json'); // Set the content type header
echo json_encode($messages);
$conn->close();
