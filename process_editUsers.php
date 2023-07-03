<?php
session_start();

require_once 'dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับค่าที่ส่งมาจากฟอร์ม
    $userId = $_GET['user_id'];
    $idCardNumber = $_POST['idCardNumber'];
    $nameTitle = $_POST['nameTitle'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $position = $_POST['position'];
    $affiliation = $_POST['affiliation'];
    $employmentContract = $_POST['employmentContract'];
    $startDate = $_POST['startDate'];
    $salary = $_POST['salary'];
    $otherIncome = $_POST['otherIncome'];
    $maritalStatus = $_POST['maritalStatus'];
    $user_level = $_POST['user_level'];
    $password = $_POST['password'];

    // แปลงรูปแบบวันที่จาก พ.ศ. เป็น ค.ศ.
    $startDate_english = DateTime::createFromFormat('d-m-Y', $startDate);
    $startDate_english->modify('-543 years');
    $startDate_english = $startDate_english->format('Y-m-d');

    // อัปเดตข้อมูลในฐานข้อมูล
    $sql = "UPDATE users SET idCardNumber = '$idCardNumber', nameTitle = '$nameTitle', fname = '$fname', lname = '$lname', position = '$position', affiliation = '$affiliation', employmentContract = '$employmentContract', startDate = '$startDate_english', salary = '$salary', otherIncome = '$otherIncome', maritalStatus = '$maritalStatus', user_level = '$user_level'";

    // เช็ครหัสผ่าน และเพิ่มในการอัปเดตเฉพาะเมื่อมีการระบุรหัสผ่านใหม่
    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql .= ", password = '$hashedPassword'";
    }

    $sql .= " WHERE user_id = '$userId'";

    if (mysqli_query($conn, $sql)) {
        echo json_encode([
            'status' => 'success',
            'message' => 'อัปเดตข้อมูลสำเร็จ'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'เกิดข้อผิดพลาดในการอัปเดตข้อมูล: ' . mysqli_error($conn)
        ]);
    }
}


?>
