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

        div.dt-buttons {
            margin-bottom: 10px;
        }
    </style>

    <!-- CSS สำหรับ DataTables Buttons -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">


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
                                    <h4 class="card-title">ข้อมูล</h4>
                                    <div id="usersTable_wrapper" class="dataTables_wrapper">
                                        <div class="dataTables_filter">
                                            <!-- ส่วนของปุ่ม Export -->
                                            <div class="btn-group"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <table id="usersTable" class="table table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ลำดับที่</th>
                                                <th>ชื่อจริง - นามสกุล</th>
                                                <th>สังกัด</th>
                                                <th>ตำแหน่ง</th>
                                                <th>ระดับผู้ใช้</th>
                                                <th>ประเภทบุคลากร</th>
                                                <th>ดูข้อมูล</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count = 1;
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo '<tr>';
                                                echo '<td>' . $count . '</td>';
                                                echo '<td>' . $row['fname'] . ' ' . $row['lname'] . '</td>';
                                                echo '<td>' . $row['affiliation'] . '</td>';
                                                echo '<td>' . $row['position'] . '</td>';
                                                echo '<td>' . $row['user_level'] . '</td>';
                                                echo '<td>' . $row['staffType'] . '</td>';
                                                echo '<td><a href="editUser_m.php?user_id=' . $row['user_id'] . '" class="btn btn-warning">ดูข้อมูล</a></td>';
                                                echo '</tr>';
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
        $('#usersTable').DataTable();
    });
</script>
<script>
    $(document).ready(function() {
        var table = $('#usersTable').DataTable();

        // เพิ่มปุ่มสำหรับ Export เป็น Excel
        new $.fn.dataTable.Buttons(table, {
            buttons: [{
                extend: 'excel',
                text: 'Export เป็น Excel',
                className: 'btn btn-success',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6]
                }
            }]
        });

        table.buttons().container()
            .appendTo('#usersTable_wrapper .dataTables_filter .btn-group')
            .addClass('d-inline-flex align-items-center ml-2'); // เพิ่มระยะห่างระหว่างปุ่มกับช่องค้นหา
    });
</script>


<!-- JS สำหรับ DataTables Buttons -->
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>