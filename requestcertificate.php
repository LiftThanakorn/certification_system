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

        // Get category_certificate from request
        $category_certificate = $_POST['category_certificate'];

        // Insert the certificate request into the database
        $sql = "INSERT INTO requestcertificate (user_id, category_id, status, request_date, update_date) VALUES ('$user_id', '$category_certificate', 'รอดำเนินการ', NOW(), NOW())";
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
?>
