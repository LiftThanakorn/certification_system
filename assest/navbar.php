<?php
// เชื่อมต่อกับฐานข้อมูล
require_once 'dbconnect.php';

if (isset($_SESSION['user_id'])) {
  // ดึงข้อมูลผู้ใช้จากฐานข้อมูล
  $userSql = "SELECT fname FROM users WHERE user_id = '{$_SESSION['user_id']}'";
  $userResult = mysqli_query($conn, $userSql);
  $userRow = mysqli_fetch_assoc($userResult);

  $statusSql = "SELECT COUNT(*) AS pendingCount FROM requestcertificate WHERE status = 'รอดำเนินการ'";
  $statusResult = mysqli_query($conn, $statusSql);
  $statusRow = mysqli_fetch_assoc($statusResult);
  $pendingRequestCount = $statusRow['pendingCount'];

  // ดึงข้อมูลผู้ใช้จากฐานข้อมูล
$userSql = "SELECT fname, image FROM users WHERE user_id = '{$_SESSION['user_id']}'";
$userResult = mysqli_query($conn, $userSql);
$userRow = mysqli_fetch_assoc($userResult);

// เก็บชื่อไฟล์รูปภาพ
$image = $userRow['image'];

}
?>

<style>
  @keyframes shake {
    0% { transform: rotate(0); }
  15% { transform: rotate(10deg); }
  30% { transform: rotate(-10deg); }
  45% { transform: rotate(8deg); }
  60% { transform: rotate(-8deg); }
  75% { transform: rotate(4deg); }
  85% { transform: rotate(-4deg); }
  92% { transform: rotate(2deg); }
  100% { transform: rotate(0); }
}

.shake-badge {
  animation: shake 1.5s infinite;
}
/* .rotate-left {
  transform: rotate(45deg);
} */

</style>
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
  <!-- Topbar Navbar -->
  <ul class="navbar-nav ml-auto">
        <!-- Nav Item - Pending Requests -->
        <?php if ($_SESSION['user_level'] === 'แอดมิน' || $_SESSION['user_level'] === 'ผู้บริหาร') { 
         if (isset($pendingRequestCount)) : ?>
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span style="color: #858796;">คำร้องขอที่ยังไม่ดำเนินการ
          <i class="fas fa-bell fa-fw rotate-left shake-badge"></i></span>
          <!-- Counter - Alerts -->
          <span style="padding: 5px 8px 5px 8px; font-size: 16px;" class="badge badge-danger badge-counter "><?php echo $pendingRequestCount; ?></span>
        </a>
      </li>
      <?php endif; ?>
      <?php } ?>
      
      <div class="topbar-divider d-none d-sm-block"></div>
    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php if (isset($_SESSION['user_id'])) : ?>
          <span class="mr-2 d-none d-lg-inline text-gray-600"><?php echo $userRow['fname']; ?></span>
          <img class="img-profile rounded-circle" src="img/<?php echo $image; ?>" />
        <?php endif; ?>
      </a>
      <!-- Dropdown - User Information -->
      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="profile.php?user_id=<?php echo $_SESSION['user_id']; ?>">
          <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
          Profile
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
          Logout
        </a>
      </div>
    </li>
  </ul>
</nav>