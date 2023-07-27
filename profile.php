<?php
// Add this at the top of the file
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require_once 'dbconnect.php';

$userId = $_GET['user_id'];

$sql = "SELECT * FROM users WHERE user_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $userId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

$idCardNumber = $row['idCardNumber'];
$nameTitle = $row['nameTitle'];
$fname = $row['fname'];
$lname = $row['lname'];
$position = $row['position'];
$subaffiliation_id = $row['subaffiliation_id'];
$employmentContract = $row['employmentContract'];
$startDate = $row['startDate'];
$salary = $row['salary'];
$otherIncome = $row['otherIncome'];
$maritalStatus = $row['maritalStatus'];
$user_level = $row['user_level'];
$image = $row['image'];
$positionlevel_id = $row['positionlevel_id'];
$academicposition_id = $row['academicposition_id'];
$executiveposition_id = $row['executiveposition_id'];
?>


<!DOCTYPE html>
<html>

<head>
    <title>Profile</title>
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
                <div class="container">
                    <div class="row justify-content-center mt-5">
                        <div class="col-md-2">
                            <div class="card shadow mb-4">
                                <div class="card-header">
                                    <img src="img/<?php echo $image; ?>" alt="User Image" class="small-image">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="card shadow mb-4">
                                <div class="card-header">
                                    <img src="images/settings.png" alt="settings" class="card-logo">
                                    <h4 class="m-0 font-weight-bold text-primary">แก้ไขข้อมูลโปรไฟล์</h4>
                                </div>
                                <div class="card-body">
                                    <form id="editProfileForm" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="userId" value="<?php echo $userId; ?>">
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
                                                <label for="executiveposition" class="form-label">ตำแหน่งบริหาร: </label>
                                                <select class="form-select" id="executiveposition_id" name="executiveposition_id">
                                                    <option value="">กรุณาเลือกตำแหน่งบริหาร</option>
                                                    <?php
                                                    $sql = "SELECT * FROM tbl_executiveposition";
                                                    $result = mysqli_query($conn, $sql);

                                                    while ($executiveposition = mysqli_fetch_assoc($result)) {
                                                        $ep_id = $executiveposition['executiveposition_id'];
                                                        $ep_name = $executiveposition['executiveposition_name'];
                                                        $selected = ($ep_id == $executiveposition_id) ? 'selected' : '';
                                                        echo "<option value=\"$ep_id\" $selected>$ep_name</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col">
                                                <label for="academicposition" class="form-label">ตำแหน่งทางวิชาการ: </label>
                                                <select class="form-select" id="academicposition_id" name="academicposition_id">
                                                    <option value="">กรุณาเลือกตำแหน่งทางวิชาการ</option>
                                                    <?php
                                                    $sql = "SELECT * FROM tbl_academicposition";
                                                    $result = mysqli_query($conn, $sql);

                                                    while ($academicposition = mysqli_fetch_assoc($result)) {
                                                        $ap_id = $academicposition['academicposition_id'];
                                                        $ap_name = $academicposition['academicposition_name'];
                                                        $selected = ($ap_id == $academicposition_id) ? 'selected' : '';
                                                        echo "<option value=\"$ap_id\" $selected>$ap_name</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <label for="positionlevel" class="form-label">วิทยฐานะสายสนับสนุน: </label>
                                                <select class="form-select" id="positionlevel_id" name="positionlevel_id">
                                                    <option value="">กรุณาเลือกระดับตำแหน่ง</option>
                                                    <?php
                                                    $sql = "SELECT * FROM tbl_positionlevel";
                                                    $result = mysqli_query($conn, $sql);

                                                    while ($positionlevel = mysqli_fetch_assoc($result)) {
                                                        $pl_id = $positionlevel['positionlevel_id'];
                                                        $pl_name = $positionlevel['positionlevel_name'];
                                                        $description = $positionlevel['description'];
                                                        $selected = ($pl_id == $positionlevel_id) ? 'selected' : '';
                                                        echo "<option value=\"$pl_id\" $selected>$pl_name, $description</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col">
                                                <label for="affiliation" class="form-label">สังกัด:</label>
                                                <select class="form-select" id="affiliation" name="affiliation" required>
                                                    <option value="">โปรดเลือก</option>
                                                    <?php
                                                    $sql = "SELECT affiliation_id, affiliation_name FROM tbl_affiliation";
                                                    $result = mysqli_query($conn, $sql);

                                                    while ($affiliation = mysqli_fetch_assoc($result)) {
                                                        $affiliation_id = $affiliation['affiliation_id'];
                                                        $affiliation_name = $affiliation['affiliation_name'];
                                                        $selected_subaffiliation_id = $row['subaffiliation_id'];

                                                        $subaffiliation_sql = "SELECT subaffiliation_id, subaffiliation_name FROM tbl_subaffiliation WHERE affiliation_id = $affiliation_id";
                                                        $subaffiliation_result = mysqli_query($conn, $subaffiliation_sql);

                                                        if (mysqli_num_rows($subaffiliation_result) > 0) {
                                                            echo '<optgroup label="' . $affiliation_name . '">';
                                                            while ($subaffiliation = mysqli_fetch_assoc($subaffiliation_result)) {
                                                                $loop_subaffiliation_id = $subaffiliation['subaffiliation_id'];
                                                                $subaffiliation_name = $subaffiliation['subaffiliation_name'];
                                                                $selected = ($loop_subaffiliation_id == $selected_subaffiliation_id) ? 'selected' : '';
                                                                echo "<option value=\"$loop_subaffiliation_id\" $selected>$subaffiliation_name</option>";
                                                            }
                                                            echo '</optgroup>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col">
                                                <label for="employmentContract" class="form-label">สัญญาจ้าง:</label>
                                                <select class="form-select" id="employmentContract" name="employmentContract" required>
                                                    <option value="พนักงานมหาวิทยาลัย" <?php if ($employmentContract === 'พนักงานมหาวิทยาลัย') echo 'selected'; ?>>พนักงานมหาวิทยาลัย</option>
                                                    <option value="พนักงานประจำตามสัญญา" <?php if ($employmentContract === 'พนักงานประจำตามสัญญา') echo 'selected'; ?>>จ้างประจำ</option>
                                                    <option value="พนักงานงานสัญญาจ้างชั่วคราว" <?php if ($employmentContract === 'พนักงานงานสัญญาจ้างชั่วคราว') echo 'selected'; ?>>จ้างชั่วคราว</option>
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
                                            <?php
                                            $startDate = new DateTime($row['startDate']);
                                            $endDate = new DateTime(); // วันปัจจุบัน

                                            $interval = $startDate->diff($endDate);

                                            $years = $interval->y; // จำนวนปี
                                            $months = $interval->m; // จำนวนเดือน
                                            $day = $interval->d; // จำนวนวัน

                                            ?>

                                            <div class="col">
                                                <label for="interval" class="form-label">จำนวนปีที่ทำงาน:</label>
                                                <input type="text" class="form-control" id="workofyears" name="workofyears" value="<?php echo $years . 'ปี ' . $months . 'เดือน ' . $day . 'วัน';  ?>" readonly>
                                            </div>
                                            <div class="col">
                                                <label for="salary" class="form-label">เงินเดือน:</label>
                                                <input type="text" class="form-control" id="salary" name="salary" value="<?php echo $salary; ?>" readonly>
                                            </div>
                                            <div class="col">
                                                <label for="otherIncome" class="form-label">เงินรายได้อื่น:</label>
                                                <input type="text" class="form-control" id="otherIncome" name="otherIncome" value="<?php echo $otherIncome; ?>" readonly>
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
 <!--                                        <div class="col">
                                                <label for="password" class="form-label">รหัสผ่าน:</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" id="password" name="password" value=<?php echo $password; ?>>
                                                    <button type="button" id="togglePassword" class="btn btn-outline-secondary">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label for="confirmPassword" class="form-label">ยืนยันรหัสผ่านใหม่:</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
                                                    <button type="button" id="togglePassword" class="btn btn-outline-secondary" data-target="#confirmPassword">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            </div> -->
                                            <div class="row mb-3">
                                            <div class="col">
                                                <label for="profileImage" class="form-label">รูปภาพใหม่</label>
                                                <input type="file" class="form-control" id="profileImage" name="profileImage" accept="image/*">
                                                <small class="text-danger">*ไฟล์ jpg jpeg png เท่านั้น</small>
                                            </div>
                                            </div>
                                            <div class="col">
                                                <input type="hidden" class="form-control" id="user_level" name="user_level" value="<?php echo $user_level; ?>" readonly>
                                            </div>
                                        
                                        <div class="row">
                                            <div class="col d-flex justify-content-end">
                                                <input type="hidden" name="user_id" value="<?php echo $userId; ?>">
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function() {
        $('#editProfileForm').submit(function(event) {
            event.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: 'process_editUsers.php?user_id=<?php echo $userId; ?>',
                type: 'POST',
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response);
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'สำเร็จ!',
                            text: response.message,
                            confirmButtonText: 'ตกลง'
                        }).then(function() {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด!',
                            text: response.message,
                            confirmButtonText: 'ตกลง'
                        });
                    }
                },
                error: function(xhr, status, error) {
                     console.log(xhr, status, error); 
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
<!-- <script>
    $(document).ready(function() {
        $('#togglePassword, #toggleConfirmPassword').click(function() {
            var targetInput = $(this).attr('data-target');
            var passwordInput = $(targetInput);
            passwordInput.attr('type', passwordInput.attr('type') === 'password' ? 'text' : 'password');
            $(this).find('i').toggleClass('fa-eye fa-eye-slash');
        });
    });
</script> -->