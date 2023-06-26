<?php
session_start();
require_once 'dbconnect.php';

// เช็คว่ามีการเข้าสู่ระบบหรือไม่
if (!isset($_SESSION['user_id'])) {
    // ถ้าไม่มีการเข้าสู่ระบบ ให้เปลี่ยนเส้นทางไปยังหน้า login หรือหน้าอื่นที่คุณต้องการ
    header("Location: login.php");
    exit;
}

if (isset($_SESSION['user_level'])) {
    $userLevel = $_SESSION['user_level'];
    if ($userLevel == 'แอดมิน' || $userLevel == 'ผู้บริหาร') {
    } elseif ($userLevel == 'ผู้ใช้ทั่วไป') {
        // ถ้าเป็นผู้ใช้ทั่วไป ให้เปลี่ยนเส้นทางไปยังหน้า dashboard.php หรือหน้าที่คุณต้องการ
        header("Location: dashboard.php");
        exit;
    } else {
        // ถ้าไม่ใช่แอดมิน ผู้บริหาร หรือผู้ใช้ทั่วไป ให้เปลี่ยนเส้นทางไปยังหน้าที่คุณต้องการ
        header("Location: login.php");
        exit;
    }
}


$sql = "SELECT sc.*, u.fname, u.lname, u.affiliation, cc.category_name, a.fname AS approver_fname, a.lname AS approver_lname 
FROM requestcertificate sc
INNER JOIN users u ON sc.user_id = u.user_id
INNER JOIN certificate_categories cc ON sc.category_id = cc.category_id
LEFT JOIN users a ON sc.approver_id = a.user_id";

$result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html>

<head>
    <title>Dashboard (Admin/Manager)</title>
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
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h3 class="m-0 font-weight-bold text-primary">ตารางข้อมูลผู้ขอใบรับรอง</h3>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="dataTable" class="table table-bordered" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ลำดับ</th>
                                                    <th scope="col">ชื่อ-นามสกุล</th>
                                                    <th scope="col">ฝ่าย</th>
                                                    <th scope="col">หมวดหมู่</th>
                                                    <th scope="col">สถานะ</th>
                                                    <th scope="col">วันที่ส่งคำขอ</th>
                                                    <th scope="col">Update</th>
                                                    <th>ผู้อนุมัติ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $index = 1;
                                                while ($row = mysqli_fetch_assoc($result)) :
                                                ?>
                                                    <tr data-request-id="<?php echo $row['requestcertificate_id']; ?>">
                                                        <td><?php echo $index++; ?></td>
                                                        <td><?php echo $row['fname'] . ' ' . $row['lname']; ?></td>
                                                        <td><?php echo $row['affiliation']; ?></td>
                                                        <td>
                                                            <?php
                                                            $category_name = $row['category_name'];

                                                            if ($category_name == 'หนังสือรับรองเงินเดือน') {
                                                                echo "<span class='badge rounded-pill bg-primary text-light'>" . $category_name . "</span>";
                                                            } elseif ($category_name == 'หนังสือรับรองการปฏิบัติงาน') {
                                                                echo "<span id='coe' class='badge rounded-pill bg-success text-light'>" . $category_name . "</span>";
                                                            } elseif ($category_name == 'หนังสือรับรองสถานภาพโสด') {
                                                                echo "<span id='Single' class='badge rounded-pill bg-info text-light '>" . $category_name . "</span>";
                                                            } elseif ($category_name == 'หนังสือรับรองอื่นๆ') {
                                                                echo "<span id='othercer' class='badge rounded-pill bg-secondary text-light cursor-pointer' onclick='showAdditionalData(\"" . $row['additional_data'] . "\")'>" . $category_name . " <i class='fas fa-eye'></i></span>";
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            $status = $row['status'];

                                                            if ($status == 'รอดำเนินการ') {
                                                                echo "<span class='badge rounded-pill bg-info status-badge'>" . $status . "</span>";
                                                            } elseif ($status == 'กำลังดำเนินการ') {
                                                                echo "<span class='badge rounded-pill bg-warning text-dark status-badge'>" . $status . "</span>";
                                                            } elseif ($status == 'ดำเนินการเสร็จเรียบร้อย') {
                                                                echo "<span class='badge rounded-pill bg-success status-badge'>" . $status . "</span>";
                                                            } else {
                                                                echo "<span class='badge rounded-pill bg-secondary status-badge'>" . $status . "</span>";
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><?php echo $row['request_date']; ?></td>
                                                        <td>
                                                            <button class='btn btn-warning update-status-btn' data-request-id="<?php echo $row['requestcertificate_id']; ?>">
                                                                <i class='fas fa-pen'></i>
                                                            </button>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            // ดึงข้อมูลผู้อนุมัติจากตาราง users
                                                            $approver_id = $row['approver_id'];
                                                            $sql_approver = "SELECT fname, lname FROM users WHERE user_id = '$approver_id'";
                                                            $result_approver = mysqli_query($conn, $sql_approver);
                                                            $approver = mysqli_fetch_assoc($result_approver);

                                                            if (mysqli_num_rows($result_approver) > 0) {
                                                                echo $approver['fname'] . ' ' . $approver['lname'];
                                                            } else {
                                                                echo ''; // แสดงค่าว่างเมื่อยังไม่มีผู้อัปเดตสถานะ
                                                            }
                                                            ?>
                                                        </td>

                                                    </tr>
                                                <?php endwhile; ?>
                                            </tbody>
                                        </table>
                                    </div>
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

</html>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>



<script>
    $(document).ready(function() {
        // รับค่า request_id เมื่อคลิกที่ปุ่มอัปเดตสถานะ
        $('.update-status-btn').click(function() {
            var requestId = $(this).data('request-id');
            var status = $('tr[data-request-id="' + requestId + '"] .status-badge').text();
            var user_Level = "ผู้บริหาร"; // ค่าระดับผู้ใช้งานของแอดมิน

            // Check if the status is "ดำเนินการเสร็จเรียบร้อย" and userLevel is "ผู้บริหาร"
            if (status === 'ดำเนินการเสร็จเรียบร้อย' && user_Level === 'ผู้บริหาร') {
                Swal.fire({
                    title: 'ไม่สามารถแก้ไขได้',
                    text: 'เมื่อสถานะเป็น "ดำเนินการเสร็จเรียบร้อย" คุณไม่สามารถแก้ไขได้',
                    icon: 'warning'
                });
                return; // Stop the function execution
            }

            // แสดง SweetAlert2 สำหรับอัปเดตสถานะ
            Swal.fire({
                title: 'เลือกสถานะใหม่',
                input: 'select',
                inputOptions: {
                    'รอดำเนินการ': 'รอดำเนินการ',
                    'กำลังดำเนินการ': 'กำลังดำเนินการ',
                    'ดำเนินการเสร็จเรียบร้อย': 'ดำเนินการเสร็จเรียบร้อย'
                },
                showCancelButton: true,
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก',
                inputValidator: (value) => {
                    if (!value) {
                        return 'กรุณาเลือกสถานะ';
                    }
                },
                preConfirm: (status) => {
                    // ส่งค่าสถานะที่เลือกไปยังไฟล์ update_status.php เพื่ออัปเดตในฐานข้อมูล
                    return $.ajax({
                        url: 'update_status.php',
                        type: 'POST',
                        data: {
                            request_id: requestId,
                            status: status
                        },
                        dataType: 'json'
                    });
                }
            }).then((result) => {
                if (result.value && result.value.success) {
                    // อัปเดตสถานะเรียบร้อยแล้ว
                    Swal.fire({
                        icon: 'success',
                        title: 'อัปเดตสถานะเรียบร้อยแล้ว',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        // โหลดหน้าใหม่เพื่อแสดงสถานะที่อัปเดตแล้ว
                        location.reload();
                    });
                }
            });
        });
    });
</script>


<script>
    function showAdditionalData(additionalData) {
        Swal.fire({
            title: 'ข้อมูลเพิ่มเติม',
            html: '<p style="font-size: 24px;">' + additionalData + '</p>',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง',
            customClass: {
                content: 'custom-swal-content'
            }
        });
    }
</script>