<?php
// Connect to the database
require_once 'dbconnect.php';

// Start session
session_start();

// Check user status
if (isset($_SESSION['user_level'])) {
    $userLevel = $_SESSION['user_level'];

    if ($userLevel === 'ผู้ใช้ทั่วไป') {
        // Only regular users have access to this page

        // Get user_id from session
        $user_id = $_SESSION['user_id'];

        // Search for salary certificate requests for the user based on user_id
        $sql = "SELECT users.fname, requestcertificate.*, certificate_categories.category_name FROM requestcertificate INNER JOIN users ON requestcertificate.user_id = users.user_id LEFT JOIN certificate_categories ON requestcertificate.category_id = certificate_categories.category_id WHERE users.user_id = '$user_id'";
        $result = mysqli_query($conn, $sql);
    } else {
        // Redirect to dashboard_m.php for managers or admins
        header('Location: dashboard_m.php');
        exit();
    }
} else {
    // No session or user status, redirect to login.php
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <?php require_once 'assest/head.php'; ?>
    <style>
        .badge {
            font-size: 16px;
            padding: 10px 15px;
        }

        a#request {
            text-align: right;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <a href="#" class="d-none d-sm-inline-block btn btn-lg btn-primary shadow-sm mr-2" onclick="requestCertificate()">ส่งคำขอใบรับรองเงินเดือน</a>
                            <a href="#" class="d-none d-sm-inline-block btn btn-lg btn-secondary shadow-sm" onclick="requestCertificateWork()">ส่งคำขอหนังสือรับรองการปฏิบัติงาน</a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="requestTable" class="table table-bordered" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ลำดับ</th>
                                                    <th>รหัสคำขอ</th>
                                                    <th>สถานะ</th>
                                                    <th>หมวดหมู่</th>
                                                    <th>วันที่ส่งคำขอ</th>
                                                    <th>วันที่อัปเดต</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $index = 1;
                                                while ($row = mysqli_fetch_assoc($result)) :
                                                ?>
                                                    <tr data-request-id="<?php echo $row['requestcertificate_id']; ?>">
                                                        <td><?php echo $index++; ?></td>
                                                        <td><?php echo $row['requestcertificate_id']; ?></td>
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
                                                        <td>
                                                            <?php
                                                            $category_name = $row['category_name'];

                                                            if ($category_name == 'หนังสือรับรองเงินเดือน') {
                                                                echo "<span class='badge rounded-pill bg-primary text-light'>" . $category_name . "</span>";
                                                            } elseif ($category_name == 'หนังสือรับรองการปฏิบัติงาน') {
                                                                echo "<span class='badge rounded-pill bg-secondary text-light'>" . $category_name . "</span>";
                                                            } elseif ($category_name == 'หนังสือรับรองสถานภาพโสด') {
                                                                echo "<span class='badge rounded-pill bg-dark text-light'>" . $category_name . "</span>";
                                                            } else {
                                                                echo "<span class='badge rounded-pill bg-info text-light'>" . $category_name . "</span>";
                                                            }
                                                            ?>
                                                        </td>

                                                        <td><?php echo $row['request_date']; ?></td>
                                                        <td><?php echo $row['update_date']; ?></td>
                                                    </tr>
                                                <?php endwhile; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.container-fluid -->

                </div>

                <!-- End of Main Content -->
            </div>
            <?php require_once 'assest/footer.php'; ?>
        </div>
</body>

</html>
<script>
    $(document).ready(function() {
        $('#requestTable').DataTable();
    });
</script>
<script>
    function deleteRequest(requestId) {
        Swal.fire({
            title: 'ยืนยันการลบคำขอ',
            text: 'คุณต้องการลบคำขอนี้หรือไม่?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'ลบ',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                // Perform the delete request
                $.ajax({
                    url: 'deleteRequest.php', // Replace with your delete request endpoint
                    type: 'POST',
                    data: {
                        requestId: requestId
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'ลบคำขอเรียบร้อยแล้ว',
                            text: 'คำขอถูกลบเรียบร้อยแล้ว',
                            icon: 'success'
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function() {
                        Swal.fire({
                            title: 'เกิดข้อผิดพลาด',
                            text: 'เกิดข้อผิดพลาดในการลบคำขอ',
                            icon: 'error'
                        });
                    }
                });
            }
        });
    }
</script>

<script>
    function requestCertificate() {
        Swal.fire({
            title: 'ยืนยันการส่งคำขอ',
            text: 'คุณต้องการส่งคำขอใบรับรองเงินเดือนหรือไม่?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ส่ง',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                // Perform the request using Ajax
                $.ajax({
                    url: 'requestcertificate.php',
                    type: 'POST',
                    data: {
                        category_certificate: '1'
                    },
                    success: function(response) {
                        // Handle the response from requestcertificate.php
                        Swal.fire({
                            title: 'ส่งคำขอเรียบร้อยแล้ว',
                            text: 'คำขอใบรับรองเงินเดือนถูกส่งเรียบร้อยแล้ว',
                            icon: 'success'
                        }).then(() => {
                            // Reload the page or perform any other necessary action
                            location.reload();
                        });
                    },
                    error: function() {
                        Swal.fire({
                            title: 'เกิดข้อผิดพลาด',
                            text: 'เกิดข้อผิดพลาดในการส่งคำขอ',
                            icon: 'error'
                        });
                    }
                });


            }
        });
    }
</script>

<script>
    function requestCertificateWork() {
        Swal.fire({
            title: 'ยืนยันการส่งคำขอ',
            text: 'คุณต้องการส่งคำขอหนังสือรับรองการปฏิบัติงานหรือไม่?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ส่ง',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                // Perform the request using Ajax
                $.ajax({
                    url: 'requestcertificate.php',
                    type: 'POST',
                    data: {
                        category_certificate: '1'
                    },
                    success: function(response) {
                        // Handle the response from requestcertificate.php
                        Swal.fire({
                            title: 'ส่งคำขอเรียบร้อยแล้ว',
                            text: 'คำขอหนังสือรับรองการปฏิบัติงานถูกส่งเรียบร้อยแล้ว',
                            icon: 'success'
                        }).then(() => {
                            // Reload the page or perform any other necessary action
                            location.reload();
                        });
                    },
                    error: function() {
                        Swal.fire({
                            title: 'เกิดข้อผิดพลาด',
                            text: 'เกิดข้อผิดพลาดในการส่งคำขอ',
                            icon: 'error'
                        });
                    }
                });

            }
        });
    }
</script>