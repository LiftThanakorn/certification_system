<<<<<<< HEAD
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
        header("Location: login.php.php");
        exit;
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard (Admin/Manager)</title>
    <?php require_once 'assest/head.php'; ?>
</head>
<style>
    .badge {
            font-size: 16px;
            padding: 10px 15px;
        }
</style>

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
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ลำดับ</th>
                                                    <th scope="col">ชื่อ - นามสกุล</th>
                                                    <th scope="col">สังกัด</th>
                                                    <th scope="col">รหัสคำขอ</th>
                                                    <th scope="col">หมวดหมู่</th>
                                                    <th scope="col">สถานะ</th>
                                                    <th scope="col">วันที่ขอ</th>
                                                    <th scope="col">อัพเดตสถานะ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // ดึงข้อมูลคำขอใบรับรองเงินเดือนจากฐานข้อมูล
                                                $sql = "SELECT sc.*, u.fname, u.lname, u.affiliation, cc.category_name 
            FROM requestcertificate sc
            INNER JOIN users u ON sc.user_id = u.user_id
            INNER JOIN certificate_categories cc ON sc.category_id = cc.category_id"; // เพิ่มการเชื่อมตาราง certificate_categories
                                                $result = mysqli_query($conn, $sql);

                                                // ตรวจสอบและแสดงข้อมูลในตาราง
                                                if (mysqli_num_rows($result) > 0) {
                                                    $count = 1;
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        echo "<tr>";
                                                        echo "<th scope='row'>" . $count . "</th>";
                                                        echo "<td>" . $row['fname'] . " " . $row['lname'] . "</td>";
                                                        echo "<td>" . $row['affiliation'] . "</td>";
                                                        echo "<td>" . $row['requestcertificate_id'] . "</td>";
                                                        echo "<td>" . $row['category_name'] . "</td>"; // เพิ่มหมวดหมู่
                                                        echo "<td>";

                                                        // แสดงสถานะของคำขอเป็น Pill badges
                                                        $status = $row['status'];
                                                        if ($status == 'รอดำเนินการ') {
                                                            echo "<span class='badge rounded-pill bg-info '>" . $status . "</span>";
                                                        } elseif ($status == 'กำลังดำเนินการ') {
                                                            echo "<span class='badge rounded-pill bg-warning text-dark'>" . $status . "</span>";
                                                        } elseif ($status == 'ดำเนินการเสร็จเรียบร้อย') {
                                                            echo "<span class='badge rounded-pill bg-success'>" . $status . "</span>";
                                                        }

                                                        echo "</td>";

                                                        echo "<td>" . $row['request_date'] . "</td>";
                                                        echo "<td>";

                                                        // เช็คสถานะของผู้ใช้
                                                        if (isset($_SESSION['user_level'])) {
                                                            $userLevel = $_SESSION['user_level'];
                                                            if ($userLevel == 'แอดมิน' || $userLevel == 'ผู้บริหาร') {
                                                                // สร้างปุ่มอัพเดตสถานะ
                                                                echo "<button class='btn btn-warning update-status-btn' data-request-id='" . $row['requestcertificate_id'] . "'><i class='fas fa-pen'></i></button>";
                                                            } else {
                                                                // แสดงข้อความว่าไม่มีสิทธิ์อัพเดตสถานะ
                                                                echo "ไม่มีสิทธิ์";
                                                            }
                                                        }

                                                        echo "</td>";
                                                        echo "</tr>";
                                                        $count++;
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='9'>ไม่มีข้อมูล</td></tr>";
                                                }

                                                // ปิดการเชื่อมต่อฐานข้อมูล
                                                mysqli_close($conn);
                                                ?>
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
    // รับค่า request_id เมื่อคลิกที่ปุ่มอัพเดตสถานะ
    $('.update-status-btn').click(function() {
        var requestId = $(this).data('request-id');

        // แสดง SweetAlert2 สำหรับอัพเดตสถานะ
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
                // ส่งค่าสถานะที่เลือกไปยังไฟล์ update_status.php เพื่ออัพเดตในฐานข้อมูล
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
                // อัพเดตสถานะสำเร็จ
                Swal.fire({
                    icon: 'success',
                    title: 'อัพเดตสถานะสำเร็จ',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    // เปลี่ยนเส้นทางไปยังหน้า Dashboard
                    window.location.href = 'dashboard_m.php';
                });
            }
        });
    });
});

=======
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
        header("Location: login.php.php");
        exit;
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard (Admin/Manager)</title>
    <?php require_once 'assest/head.php'; ?>
</head>
<style>
    .badge {
        font-size: .90em;
    }
</style>

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
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ลำดับ</th>
                                                    <th scope="col">ชื่อ</th>
                                                    <th scope="col">นามสกุล</th>
                                                    <th scope="col">สังกัด</th>
                                                    <th scope="col">รหัสคำขอ</th>
                                                    <th scope="col">สถานะ</th>
                                                    <th scope="col">วันที่ขอ</th>
                                                    <th scope="col">หมวดหมู่</th> <!-- เพิ่มหมวดหมู่ -->
                                                    <th scope="col">อัพเดตสถานะ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // ดึงข้อมูลคำขอใบรับรองเงินเดือนจากฐานข้อมูล
                                                $sql = "SELECT sc.*, u.fname, u.lname, u.affiliation, cc.category_name 
            FROM requestcertificate sc
            INNER JOIN users u ON sc.user_id = u.user_id
            INNER JOIN certificate_categories cc ON sc.category_id = cc.category_id"; // เพิ่มการเชื่อมตาราง certificate_categories
                                                $result = mysqli_query($conn, $sql);

                                                // ตรวจสอบและแสดงข้อมูลในตาราง
                                                if (mysqli_num_rows($result) > 0) {
                                                    $count = 1;
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        echo "<tr>";
                                                        echo "<th scope='row'>" . $count . "</th>";
                                                        echo "<td>" . $row['fname'] . "</td>";
                                                        echo "<td>" . $row['lname'] . "</td>";
                                                        echo "<td>" . $row['affiliation'] . "</td>";
                                                        echo "<td>" . $row['requestcertificate_id'] . "</td>";
                                                        echo "<td>";

                                                        // แสดงสถานะของคำขอเป็น Pill badges
                                                        $status = $row['status'];
                                                        if ($status == 'รอดำเนินการ') {
                                                            echo "<span class='badge rounded-pill bg-info '>" . $status . "</span>";
                                                        } elseif ($status == 'กำลังดำเนินการ') {
                                                            echo "<span class='badge rounded-pill bg-warning text-dark'>" . $status . "</span>";
                                                        } elseif ($status == 'ดำเนินการเสร็จเรียบร้อย') {
                                                            echo "<span class='badge rounded-pill bg-success'>" . $status . "</span>";
                                                        }

                                                        echo "</td>";

                                                        echo "<td>" . $row['request_date'] . "</td>";
                                                        echo "<td>" . $row['category_name'] . "</td>"; // เพิ่มหมวดหมู่
                                                        echo "<td>";

                                                        // เช็คสถานะของผู้ใช้
                                                        if (isset($_SESSION['user_level'])) {
                                                            $userLevel = $_SESSION['user_level'];
                                                            if ($userLevel == 'แอดมิน' || $userLevel == 'ผู้บริหาร') {
                                                                // สร้างปุ่มอัพเดตสถานะ
                                                                echo "<button class='btn btn-warning update-status-btn' data-request-id='" . $row['requestcertificate_id'] . "'><i class='fas fa-pen'></i></button>";
                                                            } else {
                                                                // แสดงข้อความว่าไม่มีสิทธิ์อัพเดตสถานะ
                                                                echo "ไม่มีสิทธิ์";
                                                            }
                                                        }

                                                        echo "</td>";
                                                        echo "</tr>";
                                                        $count++;
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='9'>ไม่มีข้อมูล</td></tr>";
                                                }

                                                // ปิดการเชื่อมต่อฐานข้อมูล
                                                mysqli_close($conn);
                                                ?>
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
    // รับค่า request_id เมื่อคลิกที่ปุ่มอัพเดตสถานะ
    $('.update-status-btn').click(function() {
        var requestId = $(this).data('request-id');

        // แสดง SweetAlert2 สำหรับอัพเดตสถานะ
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
                // ส่งค่าสถานะที่เลือกไปยังไฟล์ update_status.php เพื่ออัพเดตในฐานข้อมูล
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
                // อัพเดตสถานะสำเร็จ
                Swal.fire({
                    icon: 'success',
                    title: 'อัพเดตสถานะสำเร็จ',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    // เปลี่ยนเส้นทางไปยังหน้า Dashboard
                    window.location.href = 'dashboard_m.php';
                });
            }
        });
    });
});

>>>>>>> b353122d0de52891d8d361ae6125960e22323f67
</script>