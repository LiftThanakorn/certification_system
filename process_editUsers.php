<?php
require_once 'dbconnect.php';

session_start();

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

    // อัปโหลดรูปภาพใหม่ (ถ้ามีการเลือกรูป)
    $profileImage = $_FILES['profileImage'];
    if ($profileImage['size'] > 0) {
        $targetDirectory = 'img/';
        $fileExtension = strtolower(pathinfo($profileImage['name'], PATHINFO_EXTENSION));
        $uniqueFileName = uniqid() . '.' . $fileExtension;
        $targetFile = $targetDirectory . $uniqueFileName;

        // เช็คว่าไฟล์ที่อัปโหลดเป็นรูปภาพหรือไม่
        $allowedExtensions = array('jpg', 'jpeg', 'png');
        if (in_array($fileExtension, $allowedExtensions)) {
            // อัปโหลดไฟล์
            if (move_uploaded_file($profileImage['tmp_name'], $targetFile)) {
                // อัปเดตข้อมูลในฐานข้อมูลรวมถึงชื่อรูปภาพใหม่
                $sql = "UPDATE users SET idCardNumber = '$idCardNumber', nameTitle = '$nameTitle', fname = '$fname', lname = '$lname', position = '$position', affiliation = '$affiliation', employmentContract = '$employmentContract', startDate = '$startDate_english', salary = '$salary', otherIncome = '$otherIncome', maritalStatus = '$maritalStatus', user_level = '$user_level', image = '$uniqueFileName'";
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'เกิดข้อผิดพลาดในการอัปโหลดรูปภาพ'
                ];
                echo json_encode($response);
                exit;
            }
        } else {
            $response = [
                'status' => 'error',
                'message' => 'ไฟล์ที่อัปโหลดไม่ใช่รูปภาพ'
            ];
            echo json_encode($response);
            exit;
        }
    } else {
        // ไม่มีการเลือกรูปภาพใหม่ อัปเดตข้อมูลในฐานข้อมูลโดยไม่รวมฟิลด์รูปภาพ
        $sql = "UPDATE users SET idCardNumber = '$idCardNumber', nameTitle = '$nameTitle', fname = '$fname', lname = '$lname', position = '$position', affiliation = '$affiliation', employmentContract = '$employmentContract', startDate = '$startDate_english', salary = '$salary', otherIncome = '$otherIncome', maritalStatus = '$maritalStatus', user_level = '$user_level'";
    }

    // เช็ครหัสผ่าน และเพิ่มในการอัปเดตเฉพาะเมื่อมีการระบุรหัสผ่านใหม่
    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql .= ", password = '$hashedPassword'";
    }

    $sql .= " WHERE user_id = '$userId'";

    if (mysqli_query($conn, $sql)) {
        $response = [
            'status' => 'success',
            'message' => 'อัปเดตข้อมูลสำเร็จ'
        ];
    } else {
        $response = [
            'status' => 'error',
            'message' => 'เกิดข้อผิดพลาดในการอัปเดตข้อมูล: ' . mysqli_error($conn)
        ];
    }

    // ส่งข้อมูลกลับในรูปแบบ JSON
    echo json_encode($response);
}
?>
