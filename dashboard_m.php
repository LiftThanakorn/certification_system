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


$sql = "SELECT sc.*, u.fname, u.lname, u.affiliation, cc.certificate_type_name, a.fname AS approver_fname, a.lname AS approver_lname 
        FROM requestcertificate sc
        INNER JOIN users u ON sc.user_id = u.user_id
        INNER JOIN certificate_type cc ON sc.certificate_type_id = cc.certificate_type_id
        LEFT JOIN users a ON sc.approver_id = a.user_id
        ORDER BY sc.request_date";


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

                            <div class="card shadow mb-4 ">
                                <div class="card-header py-3">
                                    <h3 class="m-0 font-weight-bold text-primary">ตารางคำร้องขอใบรับรอง</h3>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="dataTable" class="table table-bordered table-hover" width="100%" cellspacing="0" >
                                            <thead>
                                                <tr>
                                                    <th>ลำดับ</th>
                                                    <th>ชื่อ-นามสกุล</th>
                                                    <th>ฝ่าย</th>
                                                    <th>ประเภทหนังสือรับรอง</th>
                                                    <th>สถานะ</th>
                                                    <th>วันที่ส่งคำขอ</th>
                                                    <th>อัปเดต</th>
                                                    <th>ผู้อนุมัติ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $index = mysqli_num_rows($result); // นับจำนวนแถวทั้งหมดในผลลัพธ์
                                                while ($row = mysqli_fetch_assoc($result)) :
                                                ?>
                                                    <tr data-request-id="<?php echo $row['requestcertificate_id']; ?>">
                                                        <td><?php echo $index--; ?></td> <!-- ลดค่า $index ทีละหนึ่งทุกครั้ง -->
                                                        <td><?php echo $row['fname'] . ' ' . $row['lname']; ?></td>
                                                        <td><?php echo $row['affiliation']; ?></td>
                                                        <td style="width: 25%;">
                                                            <?php
                                                            $certificate_type_name = $row['certificate_type_name'];

                                                            if ($certificate_type_name == 'หนังสือรับรองเงินเดือน') {
                                                                echo "<div class='alert alert-dark salary'>" . $certificate_type_name . "</span>";
                                                            } elseif ($certificate_type_name == 'หนังสือรับรองการปฏิบัติงาน') {
                                                                echo "<div class='alert alert-light '>" . $certificate_type_name . "</span>";
                                                            } elseif ($certificate_type_name == 'หนังสือรับรองสถานภาพโสด') {
                                                                echo "<div class='alert alert-secondary '>" . $certificate_type_name . "</div>";
                                                            } elseif ($certificate_type_name == 'หนังสือรับรองอื่นๆ') {
                                                                echo "<div class='alert alert-primary text-center cursor-pointer' onclick='showAdditionalData(\"" . $row['additional_data'] . "\")'>";
                                                                echo $certificate_type_name;
                                                                echo " ";
                                                                echo "<i class='fas fa-eye'></i>";
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
                                                        <td style="text-align: center;">
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
        $('.update-status-btn').click(function() {
            var requestId = $(this).data('request-id');
            var status = $(this).closest('tr').find('.status-badge').text();

            // ตรวจสอบระดับผู้ใช้ว่าเป็น "แอดมิน" หรือไม่
            var userLevel = "<?php echo $userLevel; ?>"; // กำหนดค่าตัวแปรนี้ตามระบบการตรวจสอบระดับผู้ใช้ของคุณ

            if (status === 'ดำเนินการเสร็จเรียบร้อย' && userLevel !== "แอดมิน") {
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