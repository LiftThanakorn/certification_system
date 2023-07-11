<?php
// Connect to the database
require_once 'dbconnect.php';

// Start session
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Get the user ID from the session
    $user_id = $_SESSION['user_id'];

    // Check if the form data is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if the certificate_type is set and not empty
        if (isset($_POST['certificate_type']) && !empty($_POST['certificate_type'])) {
            // Get the certificate_type from the request
            $certificate_type = $_POST['certificate_type'];
            $additional_data = $_POST['additional_data'];

            // Prepare the statement
            $stmt = mysqli_prepare($conn, "INSERT INTO requestcertificate (user_id, certificate_type_id, status, request_date, update_date, additional_data) VALUES (?, ?, 'รอดำเนินการ', NOW(), NOW(), ?)");

            // Bind the parameters
            mysqli_stmt_bind_param($stmt, "iss", $user_id, $certificate_type, $additional_data);

            // Execute the statement
            $result = mysqli_stmt_execute($stmt);

            if ($result) {
                // Request successfully inserted
                echo "success";
            } else {
                // Failed to insert request
                echo "error";
            }
        } else {
            // certificate_type is not set or empty
            echo "error";
        }
    }
} else {
    // User is not logged in, redirect to login.php
    header('Location: login.php');
    exit();
}

?>
