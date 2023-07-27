<?php
// Add this at the top of the file
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// รับข้อมูลที่ถูกส่งมา
$nameTitle = $_POST['nameTitle'] ?? '';
$mhesinumber1 = $_POST['mhesinumber1'] ?? '';
$mhesinumber2 = $_POST['mhesinumber2'] ?? '';
$fname = $_POST['fname'] ?? '';
$lname = $_POST['lname'] ?? '';
$maritalStatus = $_POST['maritalStatus'] ?? '';
$position = $_POST['position'] ?? '';
$positionlevel_name = ($_POST['positionlevel_name'] ?? '') !== 'ไม่มีรหัสวิทยฐานะ' ? $_POST['positionlevel_name'] ?? '' : '';
$affiliation_name = $_POST['affiliation_name'] ?? '';
$subaffiliation_name = $_POST['subaffiliation_name'] ?? '';
$employmentContract = $_POST['employmentContract'] ?? '';
$otherIncome = $_POST['otherIncome'] ?? '';
$startDate_buddhist = $_POST['startDate_buddhist'] ?? '';
$years = $_POST['years'] ?? '';
$months = $_POST['months'] ?? '';
$day = $_POST['day'] ?? '';
$certificate_type_name = $_POST['certificate_type_name'];
$additional_data = $_POST['additional_data'];

$salary = isset($_POST['salary']) ? number_format((float)$_POST['salary'], 0, '.', ',') : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <?php require_once 'assest/head.php'; ?>
    <style>
        /* เพิ่มส่วน CSS สำหรับปุ่มสีชมพู */
        .btn-pink {
            background-color: pink;
            color: white;
            border-color: pink;
        }

        .btn-pink:hover {
            background-color: #ff69b4; /* สีเมื่อ hover ปุ่ม */
            border-color: #ff69b4;
        }
                /* สีของ icon เมื่อ hover */
        .btn-pink:hover .fas {
            color: white;
        }
    </style>
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
                    <div class="row justify-content-center">
                    <h1 style="color:#131313" class="cursor-pointer">
    ผู้ที่ขอใบรับรองอื่นๆ: <?php echo $fname . ' ' . $certificate_type_name . ' ' . $additional_data; ?>
</h1>

                        <div class="col-lg-3">
                            
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h3 class="m-0 font-weight-bold text-primary">MOU กรุงไทย </h3>
                                </div>
                                <div class="card-body">
                                    <form action="certificate_Krungthai_pdf.php" method="POST">
                                        <input type="hidden" name="nameTitle" value="<?php echo htmlspecialchars($nameTitle); ?>">
                                        <input type="hidden" name="fname" value="<?php echo htmlspecialchars($fname); ?>">
                                        <input type="hidden" name="lname" value="<?php echo htmlspecialchars($lname); ?>">
                                        <input type="hidden" name="position" value="<?php echo htmlspecialchars($position); ?>">
                                        <input type="hidden" name="positionlevel_name" value="<?php echo htmlspecialchars($positionlevel_name); ?>">
                                        <input type="hidden" name="affiliation_name" value="<?php echo htmlspecialchars($affiliation_name); ?>">
                                        <input type="hidden" name="subaffiliation_name" value="<?php echo htmlspecialchars($subaffiliation_name); ?>">
                                        <input type="hidden" name="employmentContract" value="<?php echo htmlspecialchars($employmentContract); ?>">
                                        <input type="hidden" name="salary" value="<?php echo htmlspecialchars($salary); ?>">
                                        <input type="hidden" name="otherIncome" value="<?php echo htmlspecialchars($otherIncome); ?>">
                                        <input type="hidden" name="startDate_buddhist" value="<?php echo htmlspecialchars($startDate_buddhist); ?>">
                                        <input type="hidden" name="years" value="<?php echo htmlspecialchars($years); ?>">
                                        <input type="hidden" name="months" value="<?php echo htmlspecialchars($months); ?>">
                                        <input type="hidden" name="day" value="<?php echo htmlspecialchars($day); ?>">
                                        <input type="hidden" name="maritalStatus" value="<?php echo htmlspecialchars($maritalStatus); ?>">

                                       
                                        <div class="row justify-content-center">
                                     
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">เลข อว. 1</span>
                                                    </div>
                                                    <input type="text" class="form-control" name="mhesinumber1" aria-label="mhesinumber1" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">เลข อว. 2</span>
                                                    </div>
                                                    <input type="text" class="form-control" name="mhesinumber2" aria-label="mhesinumber2" aria-describedby="basic-addon2">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col"> 
                                                <button class="btn btn-primary btn-block" type="submit"> 
                                                    <i class="fas fa-file-pdf"></i>
                                                </button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- กรุงไทย end -->

                        <!-- MOU ธอส -->
                        <div class="col-lg-3">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h3 class="m-0 font-weight-bold" style="color:orange;">MOU ธอส</h3>
                                </div>
                                <div class="card-body">
                                    <form action="certificate_Krungthai_pdf.php" method="POST">
                                        <input type="hidden" name="nameTitle" value="<?php echo htmlspecialchars($nameTitle); ?>">
                                        <input type="hidden" name="fname" value="<?php echo htmlspecialchars($fname); ?>">
                                        <input type="hidden" name="lname" value="<?php echo htmlspecialchars($lname); ?>">
                                        <input type="hidden" name="position" value="<?php echo htmlspecialchars($position); ?>">
                                        <input type="hidden" name="positionlevel_name" value="<?php echo htmlspecialchars($positionlevel_name); ?>">
                                        <input type="hidden" name="affiliation_name" value="<?php echo htmlspecialchars($affiliation_name); ?>">
                                        <input type="hidden" name="subaffiliation_name" value="<?php echo htmlspecialchars($subaffiliation_name); ?>">
                                        <input type="hidden" name="employmentContract" value="<?php echo htmlspecialchars($employmentContract); ?>">
                                        <input type="hidden" name="salary" value="<?php echo htmlspecialchars($salary); ?>">
                                        <input type="hidden" name="otherIncome" value="<?php echo htmlspecialchars($otherIncome); ?>">
                                        <input type="hidden" name="startDate_buddhist" value="<?php echo htmlspecialchars($startDate_buddhist); ?>">
                                        <input type="hidden" name="years" value="<?php echo htmlspecialchars($years); ?>">
                                        <input type="hidden" name="months" value="<?php echo htmlspecialchars($months); ?>">
                                        <input type="hidden" name="day" value="<?php echo htmlspecialchars($day); ?>">
                                        <input type="hidden" name="maritalStatus" value="<?php echo htmlspecialchars($maritalStatus); ?>">

                                       
                                        <div class="row justify-content-center">
                                     
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">เลข อว. 1</span>
                                                    </div>
                                                    <input type="text" class="form-control" name="mhesinumber1" aria-label="mhesinumber1" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">เลข อว. 2</span>
                                                    </div>
                                                    <input type="text" class="form-control" name="mhesinumber2" aria-label="mhesinumber2" aria-describedby="basic-addon2">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col"> 
                                                <button class="btn btn-warning  btn-block" type="submit" > 
                                                    <i class="fas fa-file-pdf"></i>
                                                </button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- ธอส END -->

                        <!-- MOU ออมสิน -->
                        <div class="col-lg-3">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h3 class="m-0 font-weight-bold" style="color:#ff69b4">MOU ออมสิน</h3>
                                </div>
                                <div class="card-body">
                                    <form action="certificate_Krungthai_pdf.php" method="POST">
                                        <input type="hidden" name="nameTitle" value="<?php echo htmlspecialchars($nameTitle); ?>">
                                        <input type="hidden" name="fname" value="<?php echo htmlspecialchars($fname); ?>">
                                        <input type="hidden" name="lname" value="<?php echo htmlspecialchars($lname); ?>">
                                        <input type="hidden" name="position" value="<?php echo htmlspecialchars($position); ?>">
                                        <input type="hidden" name="positionlevel_name" value="<?php echo htmlspecialchars($positionlevel_name); ?>">
                                        <input type="hidden" name="affiliation_name" value="<?php echo htmlspecialchars($affiliation_name); ?>">
                                        <input type="hidden" name="subaffiliation_name" value="<?php echo htmlspecialchars($subaffiliation_name); ?>">
                                        <input type="hidden" name="employmentContract" value="<?php echo htmlspecialchars($employmentContract); ?>">
                                        <input type="hidden" name="salary" value="<?php echo htmlspecialchars($salary); ?>">
                                        <input type="hidden" name="otherIncome" value="<?php echo htmlspecialchars($otherIncome); ?>">
                                        <input type="hidden" name="startDate_buddhist" value="<?php echo htmlspecialchars($startDate_buddhist); ?>">
                                        <input type="hidden" name="years" value="<?php echo htmlspecialchars($years); ?>">
                                        <input type="hidden" name="months" value="<?php echo htmlspecialchars($months); ?>">
                                        <input type="hidden" name="day" value="<?php echo htmlspecialchars($day); ?>">
                                        <input type="hidden" name="maritalStatus" value="<?php echo htmlspecialchars($maritalStatus); ?>">

                                       
                                        <div class="row justify-content-center">
                                     
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">เลข อว. 1</span>
                                                    </div>
                                                    <input type="text" class="form-control" name="mhesinumber1" aria-label="mhesinumber1" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">เลข อว. 2</span>
                                                    </div>
                                                    <input type="text" class="form-control" name="mhesinumber2" aria-label="mhesinumber2" aria-describedby="basic-addon2">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col"> 
                                                <button class="btn btn-pink btn-block" type="submit"> 
                                                    <i class="fas fa-file-pdf"></i>
                                                </button>
                                            </div>
                                        </div>

                                    </form>
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