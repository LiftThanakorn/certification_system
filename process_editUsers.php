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

    // ตรวจสอบว่ามีการส่งไฟล์รูปภาพมาหรือไม่
    if (isset($_FILES['image'])) {
        $file = $_FILES['image'];
        
        // ตรวจสอบว่าไม่มีข้อผิดพลาดในการอัปโหลด
        if ($file['error'] === UPLOAD_ERR_OK) {
            $tempFilePath = $file['tmp_name'];
            $fileName = $file['name'];
            $fileSize = $file['size'];
            
            // ทำการเปลี่ยนชื่อไฟล์เป็นชื่อที่ไม่ซ้ำกัน
            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
            $newFileName = uniqid().'.'.$fileExtension;
            
            // กำหนดตำแหน่งที่เก็บไฟล์
            $uploadDirectory = 'profile_images/';
            $destination = $uploadDirectory . $newFileName;
            
            // ย้ายไฟล์ไปยังตำแหน่งที่กำหนด
            if (move_uploaded_file($tempFilePath, $destination)) {
                // เมื่ออัปโหลดสำเร็จ คุณสามารถเพิ่มโค้ดที่นี่เพื่อจัดเก็บชื่อไฟล์ในฐานข้อมูลหรือทำงานเพิ่มเติมตามต้องการ
                // ตัวอย่างเช่น:
                // $profileImage = $newFileName;
                // $sql .= ", profileImage = '$profileImage'";
                
                // อัปเดตข้อมูลในฐานข้อมูล
                $sql = "UPDATE users SET idCardNumber = '$idCardNumber', nameTitle = '$nameTitle', fname = '$fname', lname = '$lname', position = '$position', affiliation = '$affiliation', employmentContract = '$employmentContract', startDate = '$startDate_english', salary = '$salary', otherIncome = '$otherIncome', maritalStatus = '$maritalStatus', user_level = '$user_level'";
    
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
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'เกิดข้อผิดพลาดในการอัปโหลดรูปโปรไฟล์'
                ];
                echo json_encode($response);
            }
        } else {
            $response = [
                'status' => 'error',
                'message' => 'เกิดข้อผิดพลาดในการอัปโหลดรูปโปรไฟล์: ' . $file['error']
            ];
            echo json_encode($response);
        }
    } else {
        // อัปเดตข้อมูลในฐานข้อมูลโดยไม่มีการอัปโหลดรูปภาพ
        $sql = "UPDATE users SET idCardNumber = '$idCardNumber', nameTitle = '$nameTitle', fname = '$fname', lname = '$lname', position = '$position', affiliation = '$affiliation', employmentContract = '$employmentContract', startDate = '$startDate_english', salary = '$salary', otherIncome = '$otherIncome', maritalStatus = '$maritalStatus', user_level = '$user_level'";
    
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
}
?>