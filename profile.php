<?php
// เชื่อมต่อกับฐานข้อมูล
require_once 'dbconnect.php';

// เริ่มเซสชัน
session_start();

// Check if user_id exists
if (isset($_SESSION['user_id'])) {
    // Get user_id from session
    $user_id = $_SESSION['user_id'];

    // Retrieve user data from the database based on user_id
    $sql = "SELECT * FROM users WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($result) {
        // Fetch the user data
        $row = mysqli_fetch_assoc($result);

        // Extract the data
        $idCardNumber = $row['idCardNumber'];
        $nameTitle = $row['nameTitle'];
        $fname = $row['fname'];
        $lname = $row['lname'];
        $position = $row['position'];
        $affiliation = $row['affiliation'];
        $employmentContract = $row['employmentContract'];
        $startDate = $row['startDate'];
        $salary = $row['salary'];
        $otherIncome = $row['otherIncome'];
        $maritalStatus = $row['maritalStatus'];
        $password = $row['password'];
        $user_level = $row['user_level'];
    } else {
        // Handle the error
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Profile</title>
    <style>
        .fade-in-down {
        animation: fadeInDownAnimation 0.8s ease-in;
        animation-fill-mode: forwards;
        opacity: 0;
        transform: translateY(-50px);
    }

    @keyframes fadeInDownAnimation {
        0% {
            opacity: 0;
            transform: translateY(-50px);
        }

        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
        .card {
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.8);
        }

        .card-header {
            display: flex;
            justify-content: center;
            /* เพิ่ม CSS นี้เพื่อจัดให้โลโก้และข้อความตรงกลาง */
            align-items: center;
            background-color: #f8f9fa;
            border-bottom: none;
            padding: 10px;
        }

        .card-logo {
            width: 50px;
            /* ปรับขนาดโลโก้ตามต้องการ */
            height: 50px;
            /* ปรับขนาดโลโก้ตามต้องการ */
            margin-right: 10px;
        }

        .card-title {
            margin-bottom: 0;
        }


        .card-body {
            padding-bottom: 20px;
        }

        .card-footer {
            margin-top: 20px;
            padding: 10px;
        }
    </style>
    <?php require_once 'assest/head.php'; ?>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <?php require_once 'assest/sidebar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <?php require_once 'assest/navbar.php'; ?>
                <!-- Begin Page Content -->
                <div class="container" style="color: black">
                    <div class="row justify-content-center mt-5">
                        <div class="col-md-12">
                            <div class="card fade-in-down">
                                <div class="card-header">
                                    <img src="images/stamp.png" alt="Logo" class="card-logo">
                                    <h4 class="card-title">แก้ไขข้อมูลโปรไฟล์</h4>
                                </div>
                                <div class="card-body">
                                    <form action="update_profile.php" method="POST">
                                        <div class="row mb-3">
                                            <div class="col">
                                                <label for="idCardNumber" class="form-label">เลขบัตรประชาชน:</label>
                                                <input type="text" class="form-control" id="idCardNumber" name="idCardNumber" value="<?php echo $idCardNumber; ?>" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <label for="nameTitle" class="form-label">คำนำหน้าชื่อ:</label>
                                                <select class="form-select" id="nameTitle" name="nameTitle" required>
                                                    <option value="">กรุณาเลือกคำนำหน้าชื่อ</option>
                                                    <option value="นาย" <?php if ($nameTitle == 'นาย') echo 'selected'; ?>>นาย</option>
                                                    <option value="นาง" <?php if ($nameTitle == 'นาง') echo 'selected'; ?>>นาง</option>
                                                    <option value="นางสาว" <?php if ($nameTitle == 'นางสาว') echo 'selected'; ?>>นางสาว</option>
                                                </select>
                                            </div>
                                            <div class="col">
                                                <label for="fname" class="form-label">ชื่อ:</label>
                                                <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $fname; ?>" required>
                                            </div>
                                            <div class="col">
                                                <label for="lname" class="form-label">นามสกุล:</label>
                                                <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $lname; ?>" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <label for="position" class="form-label">ตำแหน่ง:</label>
                                                <input type="text" class="form-control" id="position" name="position" value="<?php echo $position; ?>" required>
                                            </div>
                                            <div class="col">
                                                <label for="affiliation" class="form-label">สังกัด:</label>
                                                <input type="text" class="form-control" id="affiliation" name="affiliation" value="<?php echo $affiliation; ?>" required>
                                            </div>
                                            <div class="col">
                                                <label for="employmentContract" class="form-label">สัญญาจ้าง:</label>
                                                <input type="text" class="form-control" id="employmentContract" name="employmentContract" value="<?php echo $employmentContract; ?>" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <label for="startDate" class="form-label">วันเริ่มงาน:</label>
                                                <input type="date" class="form-control" id="startDate" name="startDate" value="<?php echo $startDate; ?>" required>
                                            </div>
                                            <div class="col">
                                                <label for="salary" class="form-label">เงินเดือน:</label>
                                                <input type="text" class="form-control" id="salary" name="salary" value="<?php echo $salary; ?>" required>
                                            </div>
                                            <div class="col">
                                                <label for="otherIncome" class="form-label">เงินรายได้อื่น:</label>
                                                <input type="text" class="form-control" id="otherIncome" name="otherIncome" value="<?php echo $otherIncome; ?>" required>
                                            </div>
                                            <div class="col">
                                                <label for="maritalStatus" class="form-label">สถานะภาพ:</label>
                                                <select class="form-select" id="maritalStatus" name="maritalStatus" required>
                                                    <option value="">กรุณาเลือกสถานะภาพ</option>
                                                    <option value="โสด" <?php if ($maritalStatus == 'โสด') echo 'selected'; ?>>โสด</option>
                                                    <option value="สมรส" <?php if ($maritalStatus == 'สมรส') echo 'selected'; ?>>สมรส</option>
                                                    <option value="หย่าร้าง" <?php if ($maritalStatus == 'หย่าร้าง') echo 'selected'; ?>>หย่าร้าง</option>
                                                    <option value="แยกกันอยู่" <?php if ($maritalStatus == 'แยกกันอยู่') echo 'selected'; ?>>แยกกันอยู่</option>
                                                </select>
                                            </div>
                                        </div>
                                        <?php if (isset($user_level) && $user_level === 'แอดมิน') : ?>
                                            <!-- โค้ดฟอร์มที่ต้องการแสดงเฉพาะแอดมิน -->
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <label for="password" class="form-label">รหัสผ่าน:</label>
                                                    <input type="password" class="form-control" id="password" name="password" required>
                                                </div>
                                                <div class="col">
                                                    <label for="user_level" class="form-label">ระดับผู้ใช้:</label>
                                                    <select class="form-select" id="user_level" name="user_level" required>
                                                        <option value="">กรุณาเลือกระดับผู้ใช้</option>
                                                        <option value="ผู้ใช้งานทั่วไป" <?php if ($user_level == 'ผู้ใช้งานทั่วไป') echo 'selected'; ?>>ผู้ใช้งานทั่วไป</option>
                                                        <option value="ผู้บริหาร" <?php if ($user_level == 'ผู้บริหาร') echo 'selected'; ?>>ผู้บริหาร</option>
                                                        <option value="แอดมิน" <?php if ($user_level == 'แอดมิน') echo 'selected'; ?>>แอดมิน</option>
                                                    </select>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <div class="row">
                                            <div class="col">
                                                <button type="submit" class="btn btn-primary">บันทึกการเปลี่ยนแปลง</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- /.container-fluid -->
            </div>
            <?php require_once 'assest/footer.php'; ?>
            <!-- End of Main Content -->
        </div>
    </div>
</body>