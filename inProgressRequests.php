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
    if ($userLevel == 'admin' || $userLevel == 'manager') {
    } elseif ($userLevel == 'user') {
        // ถ้าเป็นuser ให้เปลี่ยนเส้นทางไปยังหน้า dashboard.php หรือหน้าที่คุณต้องการ
        header("Location: dashboard.php");
        exit;
    } else {
        // ถ้าไม่ใช่admin manager หรือuser ให้เปลี่ยนเส้นทางไปยังหน้าที่คุณต้องการ
        header("Location: login.php");
        exit;
    }
}


$sql = "SELECT sc.*, u.fname, u.lname, u.nameTitle, u.salary, u.otherIncome, u.maritalStatus, u.startDate, u.employmentContract, u.position, 
               pl.positionlevel_name AS positionlevel_name,
               cc.certificate_type_name, a.fname AS approver_fname, a.lname AS approver_lname,
               s.subaffiliation_name, aff.affiliation_name,
               sc.additional_data -- เพิ่มตัวแปร additional_data เข้าไปใน SELECT
        FROM requestcertificate sc
        INNER JOIN users u ON sc.user_id = u.user_id
        INNER JOIN certificate_type cc ON sc.certificate_type_id = cc.certificate_type_id
        LEFT JOIN users a ON sc.approver_id = a.user_id
        LEFT JOIN tbl_subaffiliation s ON u.subaffiliation_id = s.subaffiliation_id
        LEFT JOIN tbl_affiliation aff ON s.affiliation_id = aff.affiliation_id
        LEFT JOIN tbl_positionlevel pl ON u.positionlevel_id = pl.positionlevel_id 
        WHERE sc.status = 'กำลังดำเนินการ'
        ORDER BY sc.request_date";



$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>

<head>
    <title>inProgressRequests</title>
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
                                    <h3 class="m-0 font-weight-bold text-primary">ตารางคำร้องขอใบรับรองที่กำลังดำเนินการ</h3>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="dataTable" class="table table-bordered table-hover" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>ลำดับ</th>
                                                    <th>ข้อมูลผู้ร้องขอ</th>
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
                                                    $sql_approver = "SELECT fname, lname FROM users WHERE user_id = '$approver_id'";
                                                    $result_approver = mysqli_query($conn, $sql_approver);
                                                    $approver = mysqli_fetch_assoc($result_approver);

                                                    $certificate_type_name = $row['certificate_type_name'];
                                                    $status = $row['status'];
                                                ?>
                                                    <tr data-request-id="<?php echo $row['requestcertificate_id']; ?>">
                                                        <td><?php echo $index--; ?></td>
                                                        <td id="userData">
                                                            <?php
                                                            $startDate_buddhist = date('d-m-Y', strtotime($row['startDate'] . '+543 years'));

                                                            $months = array(
                                                                '01' => 'มกราคม',
                                                                '02' => 'กุมภาพันธ์',
                                                                '03' => 'มีนาคม',
                                                                '04' => 'เมษายน',
                                                                '05' => 'พฤษภาคม',
                                                                '06' => 'มิถุนายน',
                                                                '07' => 'กรกฎาคม',
                                                                '08' => 'สิงหาคม',
                                                                '09' => 'กันยายน',
                                                                '10' => 'ตุลาคม',
                                                                '11' => 'พฤศจิกายน',
                                                                '12' => 'ธันวาคม'
                                                            );

                                                            list($day, $month, $year) = explode('-', $startDate_buddhist);
                                                            $startDate_buddhist = ltrim($day, '0') . ' ' . $months[$month] . ' ' . $year;


                                                            /* คำนวณปีที่ทำงาน */
                                                            $startDate = new DateTime($row['startDate']);
                                                            $endDate = new DateTime(); // วันปัจจุบัน

                                                            $interval = $startDate->diff($endDate);

                                                            $years = $interval->y; // จำนวนปี
                                                            $months = $interval->m; // จำนวนเดือน
                                                            $day = $interval->d; // จำนวนวัน
                                                            ?>

                                                            <?php
                                                            echo '<b>ชื่อ - นามสกุล : </b>' . $row['nameTitle'] . ' ' . $row['fname'] . ' ' . $row['lname'] . '</br>' .
                                                                '<b>สถานะภาพ : </b>' . $row['maritalStatus'] . '</br>' .
                                                                '<b>ตำแหน่ง : </b>' . $row['position'] . '</br>' .
                                                                '<b>วิทยฐานะสายสนับสนุน: : </b>' . $row['positionlevel_name'] . '</br>' .
                                                                '<b>สังกัด : </b>' . $row['affiliation_name'] . '</br>' .
                                                                '<b>ฝ่ายงาน : </b>' . $row['subaffiliation_name'] . '</br>' .
                                                                '<b>ประเภทสัญญาจ้าง : </b>' . $row['employmentContract'] . '</br>' .
                                                                '<b>เงินเดือน : </b>' . $row['salary'] . '</br>' .
                                                                '<b>เงินรายได้อื่น : </b>' . $row['otherIncome'] . '</br>' .
                                                                '<b>วันที่เริ่มทำงาน : </b>' . $startDate_buddhist . '</br>' .
                                                                '<b>จำนวนปีที่ทำงาน : </b>' . $years . ' ปี ' . $months . ' เดือน ' . $day . ' วัน';
                                                            ?>


                                                            <form action="<?php echo ($certificate_type_name === 'หนังสือรับรองเงินเดือน') ? 'certificate_salary_pdf.php' : (($certificate_type_name === 'หนังสือรับรองสถานภาพโสด') ? 'certificate_single_pdf.php' : (($certificate_type_name === 'หนังสือรับรองการปฏิบัติงาน') ? 'certificate_work_pdf.php' : 'generateMou_pdf.php')); ?>" method="POST">


                                                                <input type="hidden" name="nameTitle" value="<?php echo $row['nameTitle']; ?>">
                                                                <input type="hidden" name="fname" value="<?php echo $row['fname']; ?>">
                                                                <input type="hidden" name="lname" value="<?php echo $row['lname']; ?>">
                                                                <input type="hidden" name="position" value="<?php echo $row['position']; ?>">
                                                                <input type="hidden" name="positionlevel_name" value="<?php echo $row['positionlevel_name']; ?>">
                                                                <input type="hidden" name="affiliation_name" value="<?php echo $row['affiliation_name']; ?>">
                                                                <input type="hidden" name="subaffiliation_name" value="<?php echo $row['subaffiliation_name']; ?>">
                                                                <input type="hidden" name="employmentContract" value="<?php echo $row['employmentContract']; ?>">
                                                                <input type="hidden" name="salary" value="<?php echo $row['salary']; ?>">
                                                                <input type="hidden" name="otherIncome" value="<?php echo $row['otherIncome']; ?>">
                                                                <input type="hidden" name="startDate_buddhist" value="<?php echo $startDate_buddhist; ?>">
                                                                <input type="hidden" name="years" value="<?php echo $years; ?>">
                                                                <input type="hidden" name="months" value="<?php echo $months; ?>">
                                                                <input type="hidden" name="day" value="<?php echo $day; ?>">
                                                                <input type="hidden" name="maritalStatus" value="<?php echo $row['maritalStatus']; ?>">
                                                                <input type="hidden" name="certificate_type_name" value="<?php echo $row['certificate_type_name']; ?>">
                                                                <input type="hidden" name="additional_data" value="<?php echo $row['additional_data']; ?>">
                                                                

                                                                <?php if (
                                                                    $certificate_type_name !== 'หนังสือรับรองเงินเดือน' && $certificate_type_name !== 'หนังสือรับรองสถานภาพโสด' && $certificate_type_name !== 'หนังสือรับรองการปฏิบัติงาน'
                                                                ) { ?>
                                                                    <hr>
                                                                    <!-- ใส่ปุ่มส่งไปที่หน้า generateMou_pdf.php -->
                                                                    <div class="row justify-content-center">
                                                                        <div class="col-10">

                                                                            <button id='certificate-other' class="btn btn-info" type="submit">ไปที่หน้าส่งหนังสือรับรองอื่นๆ </button>

                                                                        </div>
                                                                    </div>
                                                                <?php } else { ?>
                                                                    <!-- ปุ่มส่งคำขอตามปกติ -->
                                                                    <hr>
                                                                    <div class="row justify-content-center">
                                                                        <div class="col-10">
                                                                            <div class="input-group">
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text" id="basic-addon1">เลข อว.</span>
                                                                                </div>
                                                                                <input type="text" class="form-control" name="mhesinumber" aria-label="mhesinumber" aria-describedby="basic-addon1">
                                                                                <button class="btn btn-info" type="submit"><i class="fa-solid fa-file-pdf"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php } ?>
                                                            </form>



                                                        </td>
                                                        <td style="width: 22%; text-align: center;">
                                                            <?php
                                                            if ($certificate_type_name == 'หนังสือรับรองเงินเดือน') {
                                                                echo "<div class='alert alert-dark' id='certificate-salary'>" . $certificate_type_name . "</span>";
                                                                echo " ";
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
                                                                echo "<span class='badge rounded-pill bg-warning status-badge text-light'>" . $status . "</span>";
                                                            } elseif ($status == 'ดำเนินการเสร็จเรียบร้อย') {
                                                                echo "<span class='badge rounded-pill bg-success status-badge text-light'>" . $status . "</span>";
                                                            } else {
                                                                echo "<span class='badge rounded-pill bg-secondary status-badge text-light'>" . $status . "</span>";
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
        $('#dataTable').DataTable({
            "language": {
                "lengthMenu": "แสดง _MENU_ ข้อมูล",
                "zeroRecords": "ไม่มีข้อมูล",
                "info": "แสดงหน้าที่ _PAGE_ ของ _PAGES_",
                "infoEmpty": "ไม่มีข้อมูล",
                "infoFiltered": "(กรองข้อมูลจากทั้งหมด _MAX_ ข้อมูล)",
                "search": "ค้นหา:",
                "paginate": {
                    "first": "First",
                    "last": "Last",
                    "next": "ต่อไป",
                    "previous": "ก่อนหน้า"
                },
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#editTable').on('click', '.update-status-btn', function() {
            var requestId = $(this).data('request-id');
            var status = $(this).closest('tr').find('.status-badge').text();

            // ตรวจสอบระดับผู้ใช้ว่าเป็น "admin" หรือไม่
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

<script>
    const certificateForm = document.getElementById('certificateForm');
    const isCertificateSalary = <?php echo $isCertificateSalary ? 'true' : 'false'; ?>;

    certificateForm.addEventListener('submit', function(event) {
        if (isCertificateSalary) {
            certificateForm.action = 'certificate_salary_pdf.php';
        } else {
            certificateForm.action = 'certificate_work_pdf.php';
        }
    });
</script>