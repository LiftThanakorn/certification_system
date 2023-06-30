<?php
session_start();

require_once 'dbconnect.php';

if (!isset($_SESSION['user_level']) || $_SESSION['user_level'] !== 'แอดมิน') {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['user_id'])) {
    // The user_id is not sent
    header("Location: usersprofile.php");
    exit;
}

$userId = $_GET['user_id'];

$sql = "SELECT * FROM users WHERE user_id = '$userId'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

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
$user_level = $row['user_level'];
$password = $row['password'];

?>


<!DOCTYPE html>
<html>

<head>
    <title>Profile</title>
    <?php require_once 'assest/head.php'; ?>
</head>

<body id="page-top" class="fade-in-down">
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
                <div class="container">
                    <div class="row justify-content-center mt-5">
                        <div class="col-md-12">
                            <div class="card shadow mb-4">
                                <div class="card-header">
                                    <img src="images/stamp.png" alt="Logo" class="card-logo">
                                    <h4 class="card-title">แก้ไขข้อมูลโปรไฟล์</h4>
                                </div>
                                <div class="card-body">
                                    <form id="editProfileForm" method="POST">
                                        <div class="row mb-3">
                                            <div class="col">
                                                <label for="idCardNumber" class="form-label">เลขบัตรประชาชน:</label>
                                                <input type="text" class="form-control" id="idCardNumber" name="idCardNumber" value="<?php echo $idCardNumber; ?>" required>
                                            </div>
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
                                                <label for="startDate" class="form-label">วันเริ่มงาน:(พ.ศ.)</label>
                                                <?php
                                                $startDate_buddhist = date('d/m/', strtotime($startDate)) . (date('Y', strtotime($startDate)) + 543);
                                                ?>
                                                <input type="text" class="form-control" id="" name="" value="<?php echo $startDate_buddhist; ?>" readonly>
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
                                        <div class="row mb-3">
                                            <div class="col">
                                                <label for="password" class="form-label">รหัสผ่าน:</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" id="password" name="password">
                                                    <button type="button" id="togglePassword" class="btn btn-outline-secondary">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label for="user_level" class="form-label">ระดับผู้ใช้:</label>
                                                <select class="form-select" id="user_level" name="user_level" required>
                                                    <option value="">กรุณาเลือกระดับผู้ใช้</option>
                                                    <option value="ผู้ใช้ทั่วไป" <?php if ($user_level == 'ผู้ใช้ทั่วไป') echo 'selected'; ?>>ผู้ใช้ทั่วไป</option>
                                                    <option value="ผู้บริหาร" <?php if ($user_level == 'ผู้บริหาร') echo 'selected'; ?>>ผู้บริหาร</option>
                                                    <option value="แอดมิน" <?php if ($user_level == 'แอดมิน') echo 'selected'; ?>>แอดมิน</option>
                                                </select>
                                            </div>
                                        </div>
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


<script>
    $(document).ready(function() {
        // ดักจับการส่งฟอร์มแก้ไขโปรไฟล์ผู้ใช้
        $('#editProfileForm').submit(function(event) {
            event.preventDefault(); // ไม่ให้ฟอร์มทำการ submit โดยปกติ

            // รับค่าที่กรอกในฟอร์ม
            var formData = $(this).serialize();

            // ส่ง AJAX request
            $.ajax({
                url: 'process_editUsers.php?user_id=<?php echo $userId; ?>',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        // แสดง SweetAlert2 แสดงข้อความสำเร็จ
                        Swal.fire({
                            icon: 'success',
                            title: 'สำเร็จ!',
                            text: response.message,
                            confirmButtonText: 'ตกลง'
                        }).then(function() {
                            // รีโหลดหน้าเพื่อแสดงข้อมูลที่อัปเดตแล้ว
                            location.reload();
                        });
                    } else {
                        // แสดง SweetAlert2 แสดงข้อความเกิดข้อผิดพลาด
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด!',
                            text: response.message,
                            confirmButtonText: 'ตกลง'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    // แสดง SweetAlert2 แสดงข้อความเกิดข้อผิดพลาดในการส่ง AJAX request
                    Swal.fire({
                        icon: 'error',
                        title: 'เกิดข้อผิดพลาด!',
                        text: 'เกิดข้อผิดพลาดในการส่งข้อมูล: ' + error,
                        confirmButtonText: 'ตกลง'
                    });
                }
            });
        });
    });
</script>
<!-- สคริปแสดงรหัสผ่าน -->
<script>
    $(document).ready(function() {
        $('#togglePassword').click(function() {
            var passwordInput = $('#password');
            var passwordFieldType = passwordInput.attr('type');

            if (passwordFieldType === 'password') {
                passwordInput.attr('type', 'text');
                $(this).find('i').removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                passwordInput.attr('type', 'password');
                $(this).find('i').removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
    });
</script>
