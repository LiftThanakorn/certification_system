<<<<<<< HEAD
<?php
// เชื่อมต่อกับฐานข้อมูล
require_once 'dbconnect.php';

// เริ่มต้นเซสชัน
session_start();

// ตรวจสอบว่ามีการส่งข้อมูลแบบ POST มาหรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับค่าที่ส่งมาจากฟอร์ม
    $idCardNumber = $_POST['idCardNumber'];
    $password = $_POST['password'];

    // ค้นหาผู้ใช้ในฐานข้อมูล
    $sql = "SELECT * FROM users WHERE idCardNumber = '$idCardNumber'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        // พบผู้ใช้ในฐานข้อมูล
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['password'];

        if (password_verify($password, $hashedPassword)) {
            // รหัสผ่านถูกต้อง

            // กำหนดค่าในเซสชัน
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['user_level'] = $row['user_level'];

            // ตรวจสอบระดับผู้ใช้
            if ($_SESSION['user_level'] === 'ผู้ใช้ทั่วไป') {
                // เปลี่ยนเส้นทางไปยังหน้า dashboard.php
                header('Location: dashboard.php');
                exit;
            } elseif ($_SESSION['user_level'] === 'แอดมิน' || $_SESSION['user_level'] === 'ผู้บริหาร') {
                // เปลี่ยนเส้นทางไปยังหน้า dashboard_m.php
                header('Location: dashboard_m.php');
                exit;
            }
        } else {
            // รหัสผ่านไม่ถูกต้อง
            $msg = 'รหัสผ่านไม่ถูกต้อง';
        }
    } else {
        // ไม่พบผู้ใช้ในฐานข้อมูล
        $msg = 'ไม่พบผู้ใช้ในระบบ';
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <title>CertificationSystem</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        a {
            text-decoration: none;
        }

        .login-page {
            width: 100%;
            height: 100vh;
            display: inline-block;
            display: flex;
            align-items: center;
        }

        .form-right i {
            font-size: 100px;
        }
    </style>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Prompt:wght@500&display=swap');

        body {
            font-family: 'Prompt', sans-serif;
        }
    </style>

</head>

<body>

    <div class="login-page bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <!-- <h3 class="mb-3">ระบบขอใบรับรอง</h3> -->
                    <?php if (isset($msg)) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $msg; ?>
                        </div>
                    <?php endif; ?>
                    <div class="bg-white shadow rounded">
                        <div class="row">
                            <div class="col-md-7 pe-0">
                                <div class="form-left h-100 py-5 px-5">
                                    <form method="POST" action="" class="row g-4">
                                        <div class="col-12">
                                            <label for="idCardNumber" class="form-label">ID Card Number<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
                                                <input type="text" class="form-control" id="idCardNumber" name="idCardNumber" placeholder="idCardNumber">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label>Password<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="bi bi-lock-fill"></i></div>
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <a href="register.php" class="btn btn-primary px-4 mt-4 me-2">ลงทะเบียนข้อมูล</a>
                                                <button type="submit" class="btn btn-primary px-4 mt-4">เข้าสู่ระบบ</button>
                                            </div>
                                        </div>

                                    </form>

                                </div>
                            </div>
                            <div class="col-md-5 ps-0 d-none d-md-block">
                                <div class="form-right h-100 bg-primary text-white text-center pt-5">
                                    <img src="images/stamp.png" alt="Italian Trulli" width="150px">
                                    <h2 class="fs-1">ระบบขอใบรับรอง</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="text-end text-secondary mt-3">ฝ่ายการเจ้าหน้าที่ กองกลาง สำนักงานอธิการบดี</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->

</body>

=======
<?php
// เชื่อมต่อกับฐานข้อมูล
require_once 'dbconnect.php';

// เริ่มต้นเซสชัน
session_start();

// ตรวจสอบว่ามีการส่งข้อมูลแบบ POST มาหรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับค่าที่ส่งมาจากฟอร์ม
    $idCardNumber = $_POST['idCardNumber'];
    $password = $_POST['password'];

    // ค้นหาผู้ใช้ในฐานข้อมูล
    $sql = "SELECT * FROM users WHERE idCardNumber = '$idCardNumber'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        // พบผู้ใช้ในฐานข้อมูล
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['password'];

        if (password_verify($password, $hashedPassword)) {
            // รหัสผ่านถูกต้อง

            // กำหนดค่าในเซสชัน
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['user_level'] = $row['user_level'];

            // ตรวจสอบระดับผู้ใช้
            if ($_SESSION['user_level'] === 'ผู้ใช้ทั่วไป') {
                // เปลี่ยนเส้นทางไปยังหน้า dashboard.php
                header('Location: dashboard.php');
                exit;
            } elseif ($_SESSION['user_level'] === 'แอดมิน' || $_SESSION['user_level'] === 'ผู้บริหาร') {
                // เปลี่ยนเส้นทางไปยังหน้า dashboard_m.php
                header('Location: dashboard_m.php');
                exit;
            }
        } else {
            // รหัสผ่านไม่ถูกต้อง
            $msg = 'รหัสผ่านไม่ถูกต้อง';
        }
    } else {
        // ไม่พบผู้ใช้ในฐานข้อมูล
        $msg = 'ไม่พบผู้ใช้ในระบบ';
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <title>CertificationSystem</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">   
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <style>
        a {
    text-decoration: none;
}
.login-page {
    width: 100%;
    height: 100vh;
    display: inline-block;
    display: flex;
    align-items: center;
}
.form-right i {
    font-size: 100px;
}
     </style>
 
</head>
<body>

    <div class="login-page bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                  <!-- <h3 class="mb-3">ระบบขอใบรับรอง</h3> -->
                  <?php if (isset($msg)) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $msg; ?>
            </div>
        <?php endif; ?>
                    <div class="bg-white shadow rounded">
                        <div class="row">
                            <div class="col-md-7 pe-0">
                                <div class="form-left h-100 py-5 px-5">
                                    <form method="POST" action="" class="row g-4">
                                            <div class="col-12">
                                            <label for="idCardNumber" class="form-label">ID Card Number<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
                                                    <input type="text" class="form-control" id="idCardNumber" name="idCardNumber" placeholder="idCardNumber">
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label>Password<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="bi bi-lock-fill"></i></div>
                                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary px-4 float-end mt-4">เข้าสู่ระบบ</button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-5 ps-0 d-none d-md-block">
                                <div class="form-right h-100 bg-primary text-white text-center pt-5">
                                <img src="images/stamp.png" alt="Italian Trulli" width="150px">
                                    <h2 class="fs-1">ระบบขอใบรับรอง</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="text-end text-secondary mt-3">ฝ่ายการเจ้าหน้าที่ กองกลาง สำนักงานอธิการบดี</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
     
</body>
>>>>>>> b353122d0de52891d8d361ae6125960e22323f67
</html>