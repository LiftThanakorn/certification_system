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
<html>
<head>
    <title>รายชื่อผู้ใช้งาน</title>
</head>
<body>
    <h1>List</h1>

    <table>
        <tr>
            <th>No</th>
            <th>FirstName</th>
            <th>LastName</th>
            <th></th>
        </tr>

        <?php
        // วนลูปแสดงข้อมูลผู้ใช้ทั้งหมด
        $count = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            $userId = $row['user_id'];
            $firstName = $row['fname'];
            $lastName = $row['lname'];
            ?>
            <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $firstName; ?></td>
                <td><?php echo $lastName; ?></td>
                <td><a href="editUser_m.php?user_id=<?php echo $userId; ?>">view profile</a></td>
            </tr>
            <?php
            $count++;
        }
        ?>

    </table>
</body>
</html>
