<?php
session_start();
require_once 'dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // ตรวจสอบการส่งค่า request_id และ status ผ่าน POST
    if (isset($_POST['request_id']) && isset($_POST['status'])) {
        $requestId = $_POST['request_id'];
        $status = $_POST['status'];

        // อัปเดตสถานะในฐานข้อมูลโดยใช้ Prepared Statements
        $stmt = $conn->prepare("UPDATE requestcertificate SET status = ? WHERE requestcertificate_id = ?");
        $stmt->bind_param("si", $status, $requestId);
        $result = $stmt->execute();

        if ($result) {
            // ส่งค่าเพื่อแสดงว่าอัปเดตสถานะสำเร็จ
            $response = array('success' => true);
            echo json_encode($response);
        } else {
            // ส่งค่าเพื่อแสดงว่าเกิดข้อผิดพลาดในการอัปเดตสถานะ
            $response = array('success' => false, 'message' => 'เกิดข้อผิดพลาดในการอัปเดตสถานะ');
            echo json_encode($response);
        }

        $stmt->close();
    } else {
        // ส่งค่าเพื่อแสดงว่าไม่ได้รับค่า request_id หรือ status ที่ส่งมา
        $response = array('success' => false, 'message' => 'ไม่ได้รับค่า request_id หรือ status');
        echo json_encode($response);
    }
} else {
    // ส่งค่าเพื่อแสดงว่าไม่ใช่การเรียกใช้งานผ่านเมธอด POST
    $response = array('success' => false, 'message' => 'ไม่ใช่การเรียกใช้งานผ่านเมธอด POST');
    echo json_encode($response);
}

// ปิดการเชื่อมต่อฐานข้อมูล
mysqli_close($conn);
?>
