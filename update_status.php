<?php 
session_start();
require_once 'dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // ตรวจสอบการส่งค่า request_id และ status ผ่าน POST
    if (isset($_POST['request_id']) && isset($_POST['status'])) {
        $requestId = $_POST['request_id'];
        $status = $_POST['status'];

        // ตรวจสอบว่ามีการส่งค่าผู้อัปเดตผ่าน SESSION
        if (isset($_SESSION['user_id'])) {
            $approverId = $_SESSION['user_id'];

            // อัปเดตฟิลด์ approver_id ในตาราง requestcertificate
            $stmt_update_approver = $conn->prepare("UPDATE requestcertificate SET approver_id = ? WHERE requestcertificate_id = ?");
            $stmt_update_approver->bind_param("ii", $approverId, $requestId);
            $result_update_approver = $stmt_update_approver->execute();

            if ($result_update_approver) {
                // อัปเดตสถานะในฐานข้อมูลโดยใช้ Prepared Statements
                $stmt_update_status = $conn->prepare("UPDATE requestcertificate SET status = ? WHERE requestcertificate_id = ?");
                $stmt_update_status->bind_param("si", $status, $requestId);
                $result_update_status = $stmt_update_status->execute();

                if ($result_update_status) {
                    // ส่งค่าเพื่อแสดงว่าอัปเดตสถานะสำเร็จ
                    $response = array('success' => true);
                    echo json_encode($response);
                } else {
                    // ส่งค่าเพื่อแสดงว่าเกิดข้อผิดพลาดในการอัปเดตสถานะ
                    $response = array('success' => false, 'message' => 'เกิดข้อผิดพลาดในการอัปเดตสถานะ');
                    echo json_encode($response);
                }

                $stmt_update_status->close();
            } else {
                // ส่งค่าเพื่อแสดงว่าเกิดข้อผิดพลาดในการอัปเดต approver_id
                $response = array('success' => false, 'message' => 'เกิดข้อผิดพลาดในการอัปเดต approver_id');
                echo json_encode($response);
            }

            $stmt_update_approver->close();
        } else {
            // ส่งค่าเพื่อแสดงว่าไม่ได้รับค่าผู้อัปเดตผ่าน SESSION
            $response = array('success' => false, 'message' => 'ไม่ได้รับค่าผู้อัปเดตผ่าน SESSION');
            echo json_encode($response);
        }
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