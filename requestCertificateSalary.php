<?php
// Connect to the database
require_once 'dbconnect.php';

// Start session
session_start();

// Check user status
if (isset($_SESSION['user_level']) && $_SESSION['user_level'] === 'ผู้ใช้ทั่วไป') {
    // Get user_id from session
    $user_id = $_SESSION['user_id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Set category_id to 1 (default value)
        $category_id = 1;

        // Insert the salary certificate request into the database
        $sql = "INSERT INTO requestcertificate (user_id, category_id) VALUES ('$user_id', '$category_id')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $_SESSION['submit_success'] = true;
            header('Location: dashboard.php');
            exit();
        }
    }
}
?>

