<?php
// Connect to the database
require_once 'dbconnect.php';

// Start session
session_start();

// Check user status
if (isset($_SESSION['user_level'])) {
    $userLevel = $_SESSION['user_level'];

    if ($userLevel === 'ผู้ใช้ทั่วไป') {
        // Only regular users have access to this page

        // Get user_id from session
        $user_id = $_SESSION['user_id'];

        // Get the category_certificate from the request
        $category_certificate = mysqli_real_escape_string($conn, $_POST['category_certificate']);
        // Get the additional_data from the request
        $additional_data = mysqli_real_escape_string($conn, $_POST['additional_data']);

        // Insert the additional data into the database along with the request
        $sql = "INSERT INTO requestcertificate (user_id, category_id, additional_data) VALUES ('$user_id', '$category_certificate', '$additional_data')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            // Request successfully inserted
            echo "success";
        } else {
            // Failed to insert request
            echo "error";
        }
    } else {
        // Redirect to dashboard_m.php for managers or admins
        header('Location: dashboard_m.php');
        exit();
    }
} else {
    // No session or user status, redirect to login.php
    header('Location: login.php');
    exit();
}
