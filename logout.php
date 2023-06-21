<?php
session_start();

// ล้างข้อมูลเซสชัน
session_unset();
session_destroy();

// เปลี่ยนเส้นทางไปยังหน้า login.php
header("Location: login.php");
exit();
?>
