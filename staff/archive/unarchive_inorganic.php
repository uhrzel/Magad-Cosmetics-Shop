<?php
require_once('../../config.php');

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Prepare the query to prevent SQL injection
    $qry = $conn->prepare("UPDATE inorganic_fertilizers SET delete_flag = 0 WHERE id = ?");
    $qry->bind_param("i", $id); // Bind the ID to the query

    if ($qry->execute()) {
        echo 1; // Success response
    } else {
        // Output the MySQL error for debugging
        echo "Error: " . $conn->error;
    }
}
