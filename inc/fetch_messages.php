<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include '../config.php'; // Ensure to include your database connection file

$client_id = $_settings->userdata('id');

$query = "SELECT m.message, m.date_sent, u.firstname FROM messages m 
          JOIN users u ON m.sender_id = u.id 
          WHERE m.client_id = ? 
          ORDER BY m.date_sent ASC";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $client_id);
$stmt->execute();
$result = $stmt->get_result();

$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = [
        'message' => $row['message'],
        'date_sent' => $row['date_sent'],
        'sender' => $row['firstname']
    ];
}

header('Content-Type: application/json'); // Set header to JSON
echo json_encode($messages); // Output JSON data
