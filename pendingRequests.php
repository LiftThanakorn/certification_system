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
    if (!in_array($userLevel, ['admin', 'manager'])) {
        // ถ้าไม่ใช่ admin หรือ manager ให้เปลี่ยนเส้นทางไปยังหน้าที่คุณต้องการ
        header("Location: login.php");
        exit;
    }
}

$sql = "SELECT sc.*, u.fname, u.lname, u.affiliation, cc.certificate_type_name, a.fname AS approver_fname, a.lname AS approver_lname 
        FROM requestcertificate sc
        INNER JOIN users u ON sc.user_id = u.user_id
        INNER JOIN certificate_type cc ON sc.certificate_type_id = cc.certificate_type_id
        LEFT JOIN users a ON sc.approver_id = a.user_id
        WHERE sc.status = 'รอดำเนินการ'
        ORDER BY sc.request_date";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Pending Requests</title>
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
                                    <h3 class="m-0 font-weight-bold text-primary">ตารางคำร้องขอใบรับรองที่ยังไม่ดำเนินการ</h3>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="dataTable" class="table table-bordered table-hover" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>ลำดับ</th>
                                                    <th>ชื่อ-นามสกุล</th>
                                                    <th>สังกัด</th>
                                                    <th>ประเภทหนังสือรับรอง</th>
                                                    <th>สถานะ</th>
                                                    <th>วันที่ส่งคำขอ</th>
                                                    <th>อัปเดต</th>
                                                    <th>ผู้อนุมัติ</th>
                                                </tr>
                                            </thead>
                                            <tbody id="editTable">
                                                <?php
                                                $index = mysqli_num_rows($result); // นับจำนวนแถวทั้งหมดในผลลัพธ์
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $approver_id = $row['approver_id'];

                                                    $stmt_approver = mysqli_prepare($conn, "SELECT fname, lname FROM users WHERE user_id = ?");
                                                    mysqli_stmt_bind_param($stmt_approver, "i", $approver_id);
                                                    mysqli_stmt_execute($stmt_approver);
                                                    $result_approver = mysqli_stmt_get_result($stmt_approver);
                                                    $approver = mysqli_fetch_assoc($result_approver);
                                        
                                                    $certificate_type_name = $row['certificate_type_name'];
                                                    $status = $row['status'];
                                                ?>
                                                    <tr data-request-id="<?php echo $row['requestcertificate_id']; ?>">
                                                        <td><?php echo $index--; ?></td>
                                                        <td><?php echo $row['fname'] . ' ' . $row['lname']; ?></td>
                                                        <td><?php echo $row['affiliation']; ?></td>
                                                        <td style="width: 22%; text-align: center;">
                                                            <?php
                                                            if ($certificate_type_name == 'หนังสือรับรองเงินเดือน') {
                                                                echo "<div class='alert alert-dark salary' id='certificate-salary'>" . $certificate_type_name . "</span>";
                                                            } elseif ($certificate_type_name == 'หนังสือรับรองการปฏิบัติงาน') {
                                                                echo "<div class='alert alert-dark' id='certificate-work'>" . $certificate_type_name . "</span>";
                                                            } elseif ($certificate_type_name == 'หนังสือรับรองสถานภาพโสด') {
                                                                echo "<div class='alert alert-dark' id='certificate-status'>" . $certificate_type_name . "</div>";
                                                            } elseif ($certificate_type_name == 'หนังสือรับรองอื่นๆ') {
                                                                echo "<div class='alert alert-dark cursor-pointer' onclick='showAdditionalData(\"" . $row['additional_data'] . "\")' id='certificate-other'>";
                                                                echo $certificate_type_name;
                                                                echo " ";
                                                                echo "<i class='fas fa-eye'></i>";
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($status == 'รอดำเนินการ') {
                                                                echo "<span class='badge rounded-pill bg-info status-badge text-light'>" . $status . "</span>";
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
                                                        <td style="text-align: center;">
                                                            <button class='btn btn-warning update-status-btn' data-request-id="<?php echo $row['requestcertificate_id']; ?>">
                                                                <i class='fas fa-pen'></i>
                                                            </button>
                                                        </td>
                                                        <td><?php echo !empty($approver) ? $approver['fname'] . ' ' . $approver['lname'] : ''; ?></td>
                                                    </tr>
                                                <?php } ?>
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
        $('#editTable').on('click', '.update-status-btn', function() {
            var requestId = $(this).data('request-id');
            var status = $(this).closest('tr').find('.status-badge').text();

            // ตรวจสอบระดับผู้ใช้ว่าเป็น "admi" หรือไม่
            var userLevel = "<?php echo $userLevel; ?>"; // กำหนดค่าตัวแปรนี้ตามระบบการตรวจสอบระดับผู้ใช้ของคุณ

            if (status === 'ดำเนินการเสร็จเรียบร้อย' && userLevel !== "admin") {
                Swal.fire({
                    title: 'ไม่สามารถอัปเดตสถานะได้',
                    text: 'คำขอที่เสร็จเรียบร้อยแล้วไม่สามารถอัปเดตสถานะได้',
                    icon: 'error'
                });
                return;
            }

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