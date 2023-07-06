<?php
session_start();

require_once 'dbconnect.php';

if (!isset($_SESSION['user_level']) || $_SESSION['user_level'] !== 'แอดมิน') {
    header("Location: login.php");
    exit;
}

$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <?php require_once 'assest/head.php'; ?>
    <style>
        th.dt-center,
        td.dt-center {
            text-align: center;
        }
    </style>
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
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 d-flex justify-content-center">
                            <div class="card shadow mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="card-title m-0 font-weight-bold text-primary">ข้อมูลผู้ใช้งานในระบบ</h4>
                                    <div id="usersTable_wrapper" class="dataTables_wrapper">
                                        <div class="dataTables_filter">
                                            <!-- ส่วนของปุ่ม Export -->
                                            <div class="btn-group"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <table id="usersTable" class="table table-bordered table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ลำดับที่</th>
                                                <th>ชื่อจริง - นามสกุล</th>
                                                <th>สังกัด</th>
                                                <th>ตำแหน่ง</th>
                                                <th>ระดับผู้ใช้</th>
                                                <th>ประเภทบุคลากร</th>
                                                <th>IMG</th>
                                                <th>ดูข้อมูล</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count = 1;
                                            while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $count; ?></td>
                                                    <td><?php echo $row['fname'] . ' ' . $row['lname']; ?></td>
                                                    <td><?php echo $row['affiliation']; ?></td>
                                                    <td><?php echo $row['position']; ?></td>
                                                    <td><?php echo $row['user_level']; ?></td>
                                                    <td><?php echo $row['staffType']; ?></td>
                                                    <td><img src="img/<?php echo $row['image']; ?>" style="max-width: 100px; max-height: 100px;"></td>
                                                    <td><a href="editUser_m.php?user_id=<?php echo $row['user_id']; ?>" class="btn btn-warning">ดูข้อมูล</a></td>
                                                </tr>
                                            <?php
                                                $count++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End of Main Content -->
                </div>
            </div>
            <?php require_once 'assest/footer.php'; ?>
        </div>
</body>

</html>


<script>
    $(document).ready(function() {
        var table = $('#usersTable').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                extend: 'excel',
                text: 'Export เป็น Excel',
                className: 'btn btn-success',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
                }
            }]
        });

        table.buttons().container()
            .appendTo('#usersTable_wrapper .dataTables_filter .btn-group')
            .addClass('d-inline-flex align-items-center ml-2');
    });
</script>


<!-- JS สำหรับ DataTables Buttons -->
<script src="vendor/datatables/Buttons-2.3.6/js/dataTables.buttons.min.js"></script>
<script src="vendor/datatables/Buttons-2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>