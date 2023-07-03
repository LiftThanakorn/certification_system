<?php
require_once 'dbconnect.php';

// ตรวจสอบว่ามีการส่งข้อมูลผ่านเมธอด POST หรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // รับข้อมูลจากฟอร์มลงทะเบียน
  $idCardNumber = $_POST['idCardNumber'];
  $password = $_POST['password'];
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
  $staffType = $_POST['staffType'];

  // ตรวจสอบว่ามีข้อมูลผู้ใช้งานที่มีเลขบัตรประชาชนนี้แล้วหรือไม่
  $query = "SELECT * FROM users WHERE idCardNumber = ?";
  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_bind_param($stmt, "s", $idCardNumber);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if (mysqli_num_rows($result) > 0) {
    // ส่งข้อมูลกลับเป็น JSON ในกรณีที่มีข้อมูลผู้ใช้งานนี้แล้ว
    $response = array(
      'title' => 'ลงทะเบียนไม่สำเร็จ',
      'message' => 'มีผู้ใช้งานที่ใช้เลขบัตรประชาชนนี้แล้ว',
      'icon' => 'error'
    );
    echo json_encode($response);
    exit();
  } else {
    // เข้ารหัสรหัสผ่าน
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // รับไฟล์รูปภาพที่อัปโหลดจากฟอร์ม
    $profileImage = $_FILES['profileImage'];

    // ตรวจสอบว่ามีการอัปโหลดรูปภาพหรือไม่
    if (!empty($profileImage['name'])) {
      // ตรวจสอบว่ามีข้อผิดพลาดในการอัปโหลดไฟล์รูปภาพหรือไม่
      if ($profileImage['error'] === 0) {
        // สร้างชื่อไฟล์รูปภาพที่ไม่ซ้ำกัน
        $filename = uniqid() . '_' . $profileImage['name'];

        // ย้ายไฟล์รูปภาพไปยังโฟลเดอร์ที่ต้องการบันทึก
        move_uploaded_file($profileImage['tmp_name'], 'img/' . $filename);
        
// แปลงวันที่จากพ.ศ. เป็นค.ศ.
$startDate = date_create_from_format('d-m-Y', $startDate);
$startDate->modify('-543 years');
$startDate = $startDate->format('Y-m-d');


        // เพิ่มชื่อไฟล์รูปภาพในฐานข้อมูลและลงทะเบียนผู้ใช้งาน
        $query = "INSERT INTO users (idCardNumber, password, nameTitle, fname, lname, position, affiliation, employmentContract, startDate, salary, otherIncome, maritalStatus, staffType, image)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ssssssssssssss", $idCardNumber, $hashedPassword, $nameTitle, $fname, $lname, $position, $affiliation, $employmentContract, $startDate, $salary, $otherIncome, $maritalStatus, $staffType, $filename);
      } else {
        // ส่งข้อมูลกลับเป็น JSON ในกรณีที่เกิดข้อผิดพลาดในการอัปโหลดรูปภาพ
        $response = array(
          'title' => 'ลงทะเบียนไม่สำเร็จ',
          'message' => 'เกิดข้อผิดพลาดในการอัปโหลดรูปภาพ',
          'icon' => 'error'
        );
        echo json_encode($response);
        exit();
      }
    } else {
      // ไม่มีการอัปโหลดรูปภาพ
      $query = "INSERT INTO users (idCardNumber, password, nameTitle, fname, lname, position, affiliation, employmentContract, startDate, salary, otherIncome, maritalStatus, staffType)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
      $stmt = mysqli_prepare($conn, $query);
      mysqli_stmt_bind_param($stmt, "sssssssssssss", $idCardNumber, $hashedPassword, $nameTitle, $fname, $lname, $position, $affiliation, $employmentContract, $startDate, $salary, $otherIncome, $maritalStatus, $staffType);
    }


    if (mysqli_stmt_execute($stmt)) {
      // ส่งข้อมูลกลับเป็น JSON ในกรณีที่ลงทะเบียนสำเร็จ
      $response = array(
        'title' => 'ลงทะเบียนสำเร็จ',
        'message' => 'ขอบคุณสำหรับการลงทะเบียน',
        'icon' => 'success',
        'redirect' => 'login.php'
      );
      echo json_encode($response);
    } else {
      // ส่งข้อมูลกลับเป็น JSON ในกรณีที่เกิดข้อผิดพลาดในการเพิ่มข้อมูลลงฐานข้อมูล
      $response = array(
        'title' => 'ลงทะเบียนไม่สำเร็จ',
        'message' => 'เกิดข้อผิดพลาดในการลงทะเบียน',
        'icon' => 'error'
      );
      echo json_encode($response);
      exit();
    }
  }
} else {
  // ส่งข้อมูลกลับเป็น JSON ในกรณีที่ไม่มีการส่งข้อมูลผ่านเมธอด POST
  $response = array(
    'title' => 'ข้อผิดพลาด',
    'message' => 'ไม่สามารถเข้าถึงหน้านี้ได้',
    'icon' => 'error'
  );
  echo json_encode($response);
  exit();
}
