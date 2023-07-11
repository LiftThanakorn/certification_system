<?php
require_once 'dbconnect.php';
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_level'])) {
    header('Location: dashboard.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idCardNumber = $_POST['idCardNumber'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE idCardNumber = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $idCardNumber);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['password'];

        if (password_verify($password, $hashedPassword)) {
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['user_level'] = $row['user_level'];

            header('Location: dashboard.php');
            exit;
        } else {
            $msg = 'รหัสผ่านไม่ถูกต้อง';
        }
    } else {
        $msg = 'ไม่พบผู้ใช้ในระบบ';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>CertificationSystem</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        a {
            text-decoration: none;
        }

        .login-page {
            width: 100%;
            height: 100vh;
            display: inline-block;
            display: flex;
            align-items: center;
        }

        .form-right i {
            font-size: 100px;
        }

        /* ปรับขนาดส่วน modal-body ให้มีความสูงสามารถแสดงแถบเลื่อนได้ */
        .modal-body {
            max-height: 550px;
            overflow-y: auto;
        }
    </style>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Prompt:wght@500&display=swap');

        body {
            font-family: 'Prompt', sans-serif;
        }
    </style>
</head>

<body>
    <div class="login-page bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <!-- <h3 class="mb-3">ระบบขอใบรับรอง</h3> -->
                    <?php if (isset($msg)) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $msg; ?>
                        </div>
                    <?php endif; ?>
                    <div class="bg-white shadow rounded">
                        <div class="row">
                            <div class="col-md-7 pe-0">
                                <div class="form-left h-100 py-5 px-5">
                                    <form method="POST" action="" class="row g-4">
                                        <div class="col-12">
                                            <label for="idCardNumber" class="form-label">เลขบัตรประชาชน<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
                                                <input type="text" class="form-control" id="idCardNumber" name="idCardNumber">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label>รหัสผ่าน<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="bi bi-lock-fill"></i></div>
                                                <input type="password" class="form-control" id="password" name="password" title="กรุณากรอกรหัสผ่าน">
                                                <button type="button" id="togglePassword" class="btn btn-outline-secondary" title="seepassword">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <a href="register.php" class="btn btn-primary px-4 mt-4 me-2">ลงทะเบียนเข้าใช้งานระบบ</a>
                                                <button type="submit" class="btn btn-primary px-4 mt-4">เข้าสู่ระบบ</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-5 ps-0 d-none d-md-block">
                                <div class="form-right h-100 bg-primary text-white text-center pt-5">
                                    <img src="images/stamp.png" alt="stamp" width="150px">
                                    <h2 class="fs-1">ระบบขอใบรับรอง</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="text-end text-secondary mt-3">ฝ่ายการเจ้าหน้าที่ กองกลาง สำนักงานอธิการบดี</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">PDPA RERU</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="overflow-y: scroll;">
                    <p><label for="privacyPolicy" class="form-label">นโยบายการคุ้มครองข้อมูลส่วนบุคคลของอาจารย์และบุคลากร มหาวิทยาลัยราชภัฏร้อยเอ็ด โดยฝ่ายการเจ้าหน้าที่
                            และศูนย์คอมพิวเตอร์ สำนักงานอธิการบดี เข้าใจและเคารพต่อความสำคัญของความเป็นส่วนตัวหรือข้อมูลส่วนบุคคลของท่าน
                            โปรดอ่านและทำความเข้าใจนโยบายคุ้มครองข้อมูลส่วนบุคคล (“นโยบาย”) นี้ก่อนที่ท่านจะลงทะเบียนเข้าสู่ระบบการกรอกข้อมูลบุคลากร
                            ของมหาวิทยาลัยราชภัฏร้อยเอ็ด<br />

                            1. วัตถุประสงค์ การรวบรวมข้อมูลบุคลากรนี้เป็นการเตรียมการจัดส่งข้อมูลอุดมศึกษา ของกระทรวงการ
                            อุดมศึกษา วิทยาศาสตร์ วิจัยและนวัตกรรม ซึ่งโครงการดังกล่าวมีวัตถุประสงค์เพื่อบูรณาการข้อมูลร่วมกันระหว่างสถานศึกษา และหน่วยงานอื่นๆ
                            ภายใต้กระทรวงอุดมศึกษาฯ เพื่อให้มีระบบคลังข้อมูลขนาดใหญ่ (Big data) ที่สามารถใช้วิเคราะห์สารสนเทศอุดมศึกษาฯ
                            และเพื่อให้มีระบบนำเสนอรายงานสารสนเทศเชิงยุทธศาสตร์และระบบรายงานสำหรับผู้บริหาร (BI and Executive Information System)
                            เพื่อบริการแก่สถาบันอุดมศึกษาที่เข้าร่วมโครงการ และหน่วยงานภายนอก.<br />

                            2. การเก็บรวบรวมข้อมูลส่วนบุคคล ข้อมูลส่วนบุคคล หมายความถึง ข้อมูลใดๆ ที่เกี่ยวกับบุคคลธรรมดา ซึ่งทำให้สามารถระบุตัวตนบุคคลนั้นได้
                            ไม่ว่าทางตรงหรือทางอ้อม รวมถึงสิ่งอื่นใดที่ปรากฎเป็นชื่อรหัส หรือสิ่งบอกลักษณะอื่นที่ทำให้รู้ตัวผู้นั้นได้ เช่น ชื่อ นามสกุล รูปถ่าย เป็นต้น<br />

                            3. สำนักงานอธิการบดี จะเก็บรักษาข้อมูลส่วนบุคคลของท่านนานเท่าไร ข้อมูลส่วนบุคคลของท่านที่
                            ถูกเก็บรวบรวม ใช้หรือเปิดเผยเพื่อวัตถุประสงค์ภายใต้นโยบายฉบับนี้ และจะถูกจัดเก็บไว้เพียงเท่าที่เป็นการจำเป็นตลอดระยะเวลาเพื่อให้บรรลุวัตถุประสงค์ที่กำหนดไว้ในนโยบายนี้
                            เว้นแต่จะได้กำหนดไว้เป็นประการอื่นใดตามกฎหมายหรือบทบัญญัติอื่นที่มีผลบังคับใช้ สำนักงานอธิการบดี จะใช้มาตรการด้านความมั่นคงความปลอดภัย
                            หรือใช้มาตรการป้องกันภายในองค์กรของข้อมูลส่วนบุคคลอย่างเหมาะสมเพื่อให้มั่นใจว่า ข้อมูลที่จัดเก็บนั้น มีความสมบูรณ์ ถูกต้องเป็นปัจจุบันและเพื่อป้องกันการสูญหาย การเข้าถึง ทำลาย ใช้ แก้ไขหรือเปิดเผยข้อมูลโดยมิชอบ.<br />

                            4. แบ่งปันข้อมูลส่วนบุคคลของท่านอย่างไร สำนักงานอธิการบดี โดยฝ่ายการเจ้าหน้าที่ และศูนย์คอมพิวเตอร์ จะไม่เปิดเผย แสดง
                            หรือทำให้ปรากฏในลักษณะอื่นใดซึ่งข้อมูลส่วนบุคคลกับหน่วยงานหรือบุคคลอื่น สำนักงานอธิการบดีจำเป็นต้องส่งข้อมูลส่วนบุคคล
                            ของเจ้าของข้อมูลส่วนบุคคลให้แก่ กระทรวงกระทรวงการอุดมศึกษา วิทยาศาสตร์ วิจัยและนวัตกรรม เพื่อให้บรรลุวัตถุประสงค์ของเก็บข้อมูลขนาดใหญ่ (Big data)
                            ซึ่งสำนักงานอธิการบดีจะดำเนินการตามขั้นตอนที่เหมาะสมเพื่อให้มั่นใจว่า กระทรวงฯ จะดูแลข้อมูลส่วนบุคคลของเจ้าของข้อมูลไม่ให้เกิดการเข้าถึงโดยไม่ได้รับอนุญาตหรือการใช้ที่ไม่ถูกต้อง
                            ตามวัตถุประสงค์ที่กำหนดไว้ในนโยบายนี้ สำนักงานอธิการบดี อาจเปิดเผยหรือแสดงข้อมูลส่วนบุคคลในกรณีที่มีกฎหมายกำหนดให้กระทำได้เพื่อปฏิบัติตามหน้าที่ทางกฎหมาย
                            เพื่อสนับสนุนหรือให้ความช่วยเหลือหน่วยงานของรัฐตามกฎหมายที่เกี่ยวข้องรวมถึงการดำเนินงานในกระบวนการยุติธรรมทางแพ่ง ทางอาญา และ/หรือทางปกครอง.<br />

                            5. สิทธิของเจ้าของข้อมูลส่วนบุคคล ภายใต้บังคับตามพระราชบัญญัติคุ้มครองข้อมูลส่วนบุคคล พ.ศ. 2562 ท่านมีสิทธิในการเข้าถึงและได้มาซึ่งสำเนาข้อมูลส่วนบุคคล,
                            ขอรับข้อมูลส่วนบุคคล ถอนความยินยอม เปลี่ยนแปลง ลบ ทำลาย หรือทำให้ข้อมูลส่วนบุคคลเป็นข้อมูลที่ไม่สามารถระบุตัวตนได้ ระงับการใช้ข้อมูลส่วนบุคคล
                            ยื่นคำคัดค้านการประมวลผลข้อมูลส่วนบุคคล กรุณาติดต่อฝ่ายการเจ้าหน้าที่ และศูนย์คอมพิวเตอร์ สำนักงานอธิการบดี ในส่วนท้ายสุดของนโยบายนี้.</label></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
<script>
    // เปิด modal โดยอัตโนมัติเมื่อหน้าเว็บโหลดเสร็จสมบูรณ์
    window.onload = function() {
        var myModal = new bootstrap.Modal(document.getElementById('myModal'));
        myModal.show();
    };
</script>

<script src="vendor/jquery/jquery.min.js"></script>
<!-- สคริปแสดงรหัสผ่าน -->
<script>
    $(document).ready(function() {
        $('#togglePassword').click(function() {
            var passwordInput = $('#password');
            passwordInput.attr('type', passwordInput.attr('type') === 'password' ? 'text' : 'password');
            $(this).find('i').toggleClass('fa-eye fa-eye-slash');
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>