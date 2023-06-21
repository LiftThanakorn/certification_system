<?php
// ข้อมูลการเชื่อมต่อฐานข้อมูล
$host = "localhost";
$username = "root";
$password = "";
$database = "certification_system";

// สร้างการเชื่อมต่อฐานข้อมูล
$conn = new mysqli($host, $username, $password, $database);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error);
}
?>
