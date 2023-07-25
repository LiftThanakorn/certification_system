<?php
require_once 'dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['userId'];
    $idCardNumber = $_POST['idCardNumber'];
    $nameTitle = $_POST['nameTitle'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $position = $_POST['position'];
    $subaffiliation_id = $_POST['affiliation']; // Changed 'subaffiliation_id' to 'affiliation'
    $academicposition_id = $_POST['academicposition_id'];
    $executiveposition_id = $_POST['executiveposition_id'];
    $positionlevel_id = $_POST['positionlevel_id'];
    $employmentContract = $_POST['employmentContract'];
    $startDate = $_POST['startDate'];
    $salary = $_POST['salary'];
    $otherIncome = $_POST['otherIncome'];
    $maritalStatus = $_POST['maritalStatus'];
    $user_level = $_POST['user_level'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword']; // Added confirmPassword field

    // Validate password and confirmPassword match
    if (!empty($password) && $password !== $confirmPassword) {
        $response = [
            'status' => 'error',
            'message' => 'รหัสผ่านและยืนยันรหัสผ่านใหม่ไม่ตรงกัน'
        ];
        echo json_encode($response);
        exit;
    }

      // Hash the password
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

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
                $sql = "UPDATE users SET 
                idCardNumber = '$idCardNumber', 
                nameTitle = '$nameTitle', 
                fname = '$fname', 
                lname = '$lname', 
                position = '$position', 
                subaffiliation_id = '$subaffiliation_id', 
                academicposition_id = '$academicposition_id', 
                executiveposition_id = '$executiveposition_id', 
                positionlevel_id = '$positionlevel_id', 
                employmentContract = '$employmentContract', 
                startDate = '$startDate_english', 
                salary = '$salary', 
                otherIncome = '$otherIncome', 
                maritalStatus = '$maritalStatus', 
                user_level = '$user_level', 
                image = '$uniqueFileName',
                password = '$hashedPassword' 
                WHERE user_id = '$userId'";
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
        // ไม่มีการเลือกรูปภาพใหม่ อัปเดตข้อมูลอย่างอื่นที่ไม่เกี่ยวข้องกับรูปภาพ
        $sql = "UPDATE users SET 
                        idCardNumber = '$idCardNumber', 
                        nameTitle = '$nameTitle', 
                        fname = '$fname', 
                        lname = '$lname', 
                        position = '$position', 
                        subaffiliation_id = '$subaffiliation_id', 
                        academicposition_id = '$academicposition_id', 
                        executiveposition_id = '$executiveposition_id', 
                        positionlevel_id = '$positionlevel_id', 
                        employmentContract = '$employmentContract', 
                        startDate = '$startDate_english', 
                        salary = '$salary', 
                        otherIncome = '$otherIncome', 
                        maritalStatus = '$maritalStatus', 
                        user_level = '$user_level',
                        password = '$hashedPassword'
                        WHERE user_id = '$userId'";
    }

    // ทำการอัปเดตข้อมูลในฐานข้อมูล
    if (mysqli_query($conn, $sql)) {
        $response = [
            'status' => 'success',
            'message' => 'อัปเดตข้อมูลสำเร็จ'
        ];
        echo json_encode($response);
    } else {
        $response = [
            'status' => 'error',
            'message' => 'เกิดข้อผิดพลาดในการอัปเดตข้อมูล: ' . mysqli_error($conn)
        ];
        echo json_encode($response);
    }
} else {
    $response = [
        'status' => 'error',
        'message' => 'ไม่สามารถเรียกใช้งานเมื่อไม่มีการส่งคำขอแบบ POST'
    ];
    echo json_encode($response);
}
?>
