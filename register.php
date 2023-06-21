<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>Register</h1>

        <?php
        // เชื่อมต่อกับฐานข้อมูล
        require_once 'dbconnect.php';

        // ตรวจสอบว่ามีการส่งข้อมูลผ่านฟอร์มหรือไม่
        if (isset($_POST['submit'])) {
            $idCardNumber = $_POST['idCardNumber'];
            $password = $_POST['password'];
            $nameTitle = $_POST['nameTitle'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $position = $_POST['position'];
            $affiliation = $_POST['affiliation'];
            $employmentContract = $_POST['employmentContract'];
            $startDate = $_POST['startDate'];
            $salary = $_POST['salary'];
            $otherIncome = $_POST['otherIncome'];
            $maritalStatus = $_POST['maritalStatus'];

            // เช็คว่ามีเลขบัตรประชาชนซ้ำในฐานข้อมูลหรือไม่
            $checkQuery = "SELECT * FROM users WHERE idCardNumber = ?";
            $checkStmt = mysqli_prepare($conn, $checkQuery);
            mysqli_stmt_bind_param($checkStmt, "s", $idCardNumber);
            mysqli_stmt_execute($checkStmt);
            $result = mysqli_stmt_get_result($checkStmt);

            if (mysqli_num_rows($result) > 0) {
                echo '<div class="alert alert-danger" role="alert">Error: ID Card Number already exists!</div>';
                exit;
            }

            // หากไม่พบเลขบัตรประชาชนที่ซ้ำกัน จะดำเนินการเพิ่มข้อมูลผู้ใช้งานต่อไป


            // เพิ่มข้อมูลผู้ใช้ใหม่ลงในฐานข้อมูล
            $password = $_POST['password'];
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // เพิ่มข้อมูลผู้ใช้ใหม่ลงในฐานข้อมูลโดยใช้ Prepared Statements
            $query = "INSERT INTO users (idCardNumber, password, nameTitle, fname, lname, position, affiliation, employmentContract, startDate, salary, otherIncome, maritalStatus, user_level)
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'ผู้ใช้ทั่วไป')";

            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "ssssssssddss", $idCardNumber, $hashedPassword, $nameTitle, $fname, $lname, $position, $affiliation, $employmentContract, $startDate, $salary, $otherIncome, $maritalStatus);

            if (mysqli_stmt_execute($stmt)) {
                echo '<div class="alert alert-success" role="alert">Registration successful!</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Error: ' . mysqli_error($conn) . '</div>';
            }
        }
        ?>

        <form method="POST">
            <div class="mb-3">
                <label for="idCardNumber" class="form-label">ID Card Number:</label>
                <input type="text" class="form-control" id="idCardNumber" name="idCardNumber" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="nameTitle" class="form-label">Name Title:</label>
                <select class="form-select" id="nameTitle" name="nameTitle" required>
                    <option value="นาย">นาย</option>
                    <option value="นางสาว">นางสาว</option>
                    <option value="นาง">นาง</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="fname" class="form-label">First Name:</label>
                <input type="text" class="form-control" id="fname" name="fname" required>
            </div>
            <div class="mb-3">
                <label for="lname" class="form-label">Last Name:</label>
                <input type="text" class="form-control" id="lname" name="lname" required>
            </div>
            <div class="mb-3">
                <label for="position" class="form-label">Position:</label>
                <input type="text" class="form-control" id="position" name="position" required>
            </div>
            <div class="mb-3">
                <label for="affiliation" class="form-label">Affiliation:</label>
                <input type="text" class="form-control" id="affiliation" name="affiliation" required>
            </div>
            <div class="mb-3">
                <label for="employmentContract" class="form-label">Employment Contract:</label>
                <input type="text" class="form-control" id="employmentContract" name="employmentContract" required>
            </div>
            <div class="mb-3">
                <label for="startDate" class="form-label">Start Date:</label>
                <input type="date" class="form-control" id="startDate" name="startDate" required>
            </div>
            <div class="mb-3">
                <label for="salary" class="form-label">Salary:</label>
                <input type="text" class="form-control" id="salary" name="salary" required>
            </div>
            <div class="mb-3">
                <label for="otherIncome" class="form-label">Other Income:</label>
                <input type="text" class="form-control" id="otherIncome" name="otherIncome" required>
            </div>
            <div class="mb-3">
                <label for="maritalStatus" class="form-label">Marital Status:</label>
                <select class="form-select" id="maritalStatus" name="maritalStatus" required>
                    <option value="โสด">โสด</option>
                    <option value="สมรส">สมรส</option>
                    <option value="หม้าย">หม้าย</option>
                    <option value="หย่า">หย่า</option>
                    <option value="แยกกันอยู่">แยกกันอยู่</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Register</button>
        </form>
    </div>
</body>

</html>