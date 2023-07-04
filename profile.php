<?php
// Add this at the top of the file
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require_once 'dbconnect.php';

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
$image = $row['image'];

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
                                    <form id="editProfileForm" enctype="multipart/form-data">
                                    <input type="hidden" name="user_id" value="<?php echo $userId; ?>">
                                        <div class="row">
                                            <div class="col">
                                                <label for="image" class="form-label">รูปภาพ:</label>
                                                <img src="img/<?php echo $image; ?>" alt="User Image" class="small-image">
                                            </div>
                                        </div>
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
                                                <select class="form-select" id="affiliation" name="affiliation" required>
                                                    <option value="">โปรดเลือก</option>
                                                    <optgroup label="กองกลาง">
                                                        <option value="ฝ่ายธุรการ" <?php if ($affiliation == 'ฝ่ายธุรการ') echo 'selected'; ?>>ฝ่ายธุรการ</option>
                                                        <option value="ฝ่ายการเจ้าหน้าที่" <?php if ($affiliation == 'ฝ่ายการเจ้าหน้าที่') echo 'selected'; ?>>ฝ่ายการเจ้าหน้าที่</option>
                                                        <option value="ฝ่ายนิติการ" <?php if ($affiliation == 'ฝ่ายนิติการ') echo 'selected'; ?>>ฝ่ายนิติการ</option>
                                                        <option value="ฝ่ายเลขานุการ" <?php if ($affiliation == 'ฝ่ายเลขานุการ') echo 'selected'; ?>>ฝ่ายเลขานุการ</option>
                                                        <option value="ฝ่ายการเงิน" <?php if ($affiliation == 'ฝ่ายการเงิน') echo 'selected'; ?>>ฝ่ายการเงิน</option>
                                                        <option value="ฝ่ายประกันคุณภาพ" <?php if ($affiliation == 'ฝ่ายประกันคุณภาพ') echo 'selected'; ?>>ฝ่ายประกันคุณภาพ</option>
                                                        <option value="ฝ่ายกิจการพิเศษ" <?php if ($affiliation == 'ฝ่ายกิจการพิเศษ') echo 'selected'; ?>>ฝ่ายกิจการพิเศษ</option>
                                                        <option value="ฝ่ายประชาสัมพันธ์" <?php if ($affiliation == 'ฝ่ายประชาสัมพันธ์') echo 'selected'; ?>>ฝ่ายประชาสัมพันธ์</option>
                                                        <option value="ฝ่ายวิเทศสัมพันธ์และการศึกษานานาชาติ" <?php if ($affiliation == 'ฝ่ายวิเทศสัมพันธ์และการศึกษานานาชาติ') echo 'selected'; ?>>ฝ่ายวิเทศสัมพันธ์และการศึกษานานาชาติ</option>
                                                        <option value="ศูนย์นวัตกรรมและสื่อ" <?php if ($affiliation == 'ศูนย์นวัตกรรมและสื่อ') echo 'selected'; ?>>ศูนย์นวัตกรรมและสื่อ</option>
                                                        <option value="ศูนย์วิทยบริการ" <?php if ($affiliation == 'ศูนย์วิทยบริการ') echo 'selected'; ?>>ศูนย์วิทยบริการ</option>
                                                        <option value="ศูนย์คอมพิวเตอร์" <?php if ($affiliation == 'ศูนย์คอมพิวเตอร์') echo 'selected'; ?>>ศูนย์คอมพิวเตอร์</option>
                                                        <option value="สำนักงานเลขานุการสภามหาวิทยาลัย" <?php if ($affiliation == 'สำนักงานเลขานุการสภามหาวิทยาลัย') echo 'selected'; ?>>สำนักงานเลขานุการสภามหาวิทยาลัย</option>
                                                    </optgroup>
                                                    <optgroup label="กองนโยบายและแผน">
                                                        <option value="ฝ่ายแผนงานและนโยบาย" <?php if ($affiliation == 'ฝ่ายแผนงานและนโยบาย') echo 'selected'; ?>>ฝ่ายแผนงานและนโยบาย</option>
                                                        <option value="ฝ่ายพัสดุ" <?php if ($affiliation == 'ฝ่ายพัสดุ') echo 'selected'; ?>>ฝ่ายพัสดุ</option>
                                                        <option value="ฝ่ายสวัสดิการ" <?php if ($affiliation == 'ฝ่ายสวัสดิการ') echo 'selected'; ?>>ฝ่ายสวัสดิการ</option>
                                                        <option value="ฝ่ายยานพาหนะ" <?php if ($affiliation == 'ฝ่ายยานพาหนะ') echo 'selected'; ?>>ฝ่ายยานพาหนะ</option>
                                                        <option value="ฝ่ายอาคารและสถานที่" <?php if ($affiliation == 'ฝ่ายอาคารและสถานที่') echo 'selected'; ?>>ฝ่ายอาคารและสถานที่</option>
                                                        <option value="ฝ่ายก่อสร้างและภูมิทัศน์" <?php if ($affiliation == 'ฝ่ายก่อสร้างและภูมิทัศน์') echo 'selected'; ?>>ฝ่ายก่อสร้างและภูมิทัศน์</option>
                                                    </optgroup>
                                                    <optgroup label="คณะ">
                                                        <option value="คณะศิลปศาสตร์และวิทยาศาสตร์" <?php if ($affiliation == 'คณะศิลปศาสตร์และวิทยาศาสตร์') echo 'selected'; ?>>คณะศิลปศาสตร์และวิทยาศาสตร์</option>
                                                        <option value="คณะครุศาสตร์" <?php if ($affiliation == 'คณะครุศาสตร์') echo 'selected'; ?>>คณะครุศาสตร์</option>
                                                        <option value="คณะบริหารธุรกิจและการบัญชี" <?php if ($affiliation == 'คณะบริหารธุรกิจและการบัญชี') echo 'selected'; ?>>คณะบริหารธุรกิจและการบัญชี</option>
                                                        <option value="คณะนิติรัฐศาสตร์" <?php if ($affiliation == 'คณะนิติรัฐศาสตร์') echo 'selected'; ?>>คณะนิติรัฐศาสตร์</option>
                                                        <option value="คณะเทคโนโลยีสารสนเทศ" <?php if ($affiliation == 'คณะเทคโนโลยีสารสนเทศ') echo 'selected'; ?>>คณะเทคโนโลยีสารสนเทศ</option>
                                                        <option value="คณะพยาบาลศาสตร์" <?php if ($affiliation == 'คณะพยาบาลศาสตร์') echo 'selected'; ?>>คณะพยาบาลศาสตร์</option>
                                                    </optgroup>
                                                    <optgroup label="หน่วยงานอื่นๆ">
                                                        <option value="โครงการจัดตั้งคณะแพทยศาสตร์" <?php if ($affiliation == 'โครงการจัดตั้งคณะแพทยศาสตร์') echo 'selected'; ?>>โครงการจัดตั้งคณะแพทยศาสตร์</option>
                                                        <option value="บัณฑิตวิทยาลัย" <?php if ($affiliation == 'บัณฑิตวิทยาลัย') echo 'selected'; ?>>บัณฑิตวิทยาลัย</option>
                                                        <option value="สำนักวิชาการและประมวลผล" <?php if ($affiliation == 'สำนักวิชาการและประมวลผล') echo 'selected'; ?>>สำนักวิชาการและประมวลผล</option>
                                                        <option value="สำนักกิจการนักศึกษา" <?php if ($affiliation == 'สำนักกิจการนักศึกษา') echo 'selected'; ?>>สำนักกิจการนักศึกษา</option>
                                                        <option value="สถาบันวิจัยและพัฒนา" <?php if ($affiliation == 'สถาบันวิจัยและพัฒนา') echo 'selected'; ?>>สถาบันวิจัยและพัฒนา</option>
                                                        <option value="หน่วยตรวจสอบภายใน" <?php if ($affiliation == 'หน่วยตรวจสอบภายใน') echo 'selected'; ?>>หน่วยตรวจสอบภายใน</option>
                                                    </optgroup>
                                                </select>
                                            </div>

                                            <div class="col">
                                                <label for="employmentContract" class="form-label">สัญญาจ้าง:</label>
                                                <select class="form-select" id="employmentContract" name="employmentContract" required>
                                                    <option value="พนักงานมหาวิทยาลัย" <?php if ($employmentContract === 'พนักงานมหาวิทยาลัย') echo 'selected'; ?>>พนักงานมหาวิทยาลัย</option>
                                                    <option value="จ้างประจำ" <?php if ($employmentContract === 'จ้างประจำ') echo 'selected'; ?>>จ้างประจำ</option>
                                                    <option value="จ้างชั่วคราว" <?php if ($employmentContract === 'จ้างชั่วคราว') echo 'selected'; ?>>จ้างชั่วคราว</option>
                                                    <option value="ข้าราชการ" <?php if ($employmentContract === 'ข้าราชการ') echo 'selected'; ?>>ข้าราชการ</option>
                                                    <option value="พนักงานราชการ" <?php if ($employmentContract === 'พนักงานราชการ') echo 'selected'; ?>>พนักงานราชการ</option>
                                                    <option value="พนักงานรัฐวิสาหกิจ" <?php if ($employmentContract === 'พนักงานรัฐวิสาหกิจ') echo 'selected'; ?>>พนักงานรัฐวิสาหกิจ</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <label for="startDate" class="form-label">วันเริ่มงาน:(พ.ศ.)</label>
                                                <?php
                                                $startDate_buddhist = date('d-m-Y', strtotime($startDate . '+543 years'));
                                                ?>
                                                <input type="text" class="form-control" id="startDate" pattern="\d{2}-\d{2}-\d{4}" name="startDate" value="<?php echo $startDate_buddhist; ?>" required>
                                                <small>รูปแบบ: 01-01-2566</small>
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
                                                <input type="text" class="form-control" id="user_level" name="user_level" value="<?php echo $user_level; ?>" readonly>
                                            </div>
                                            <div class="col">
                                                <label for="image" class="form-label">รูปภาพ:</label>
                                                <?php if (!empty($image)) { ?>
                                                    <img src="img/<?php echo $image; ?>" alt="User Image" class="small-image">
                                                <?php } else { ?>
                                                    <img src="img/default-image.jpg" alt="Default Image" class="small-image">
                                                <?php } ?>
                                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
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
                dataType: 'json'
            }).done(function(response) {
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
            }).fail(function(xhr, status, error) {
                // แสดง SweetAlert2 แสดงข้อความเกิดข้อผิดพลาดในการส่ง AJAX request
                Swal.fire({
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด!',
                    text: 'เกิดข้อผิดพลาดในการส่งข้อมูล: ' + error,
                    confirmButtonText: 'ตกลง'
                });
            });
        });
    });
</script>

<!-- สคริปแสดงรหัสผ่าน -->
<script>
    $(document).ready(function() {
        $('#togglePassword').click(function() {
            var passwordInput = $('#password');
            passwordInput.attr('type', passwordInput.attr('type') === 'password' ? 'text' : 'password');
            $(this).find('i').toggleClass('fa-eye fa-eye-slash');
        });
    });
</script>