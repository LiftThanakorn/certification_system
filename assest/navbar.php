<?php
// เชื่อมต่อกับฐานข้อมูล
require_once 'dbconnect.php';

if (isset($_SESSION['user_id'])) {
    // ดึงข้อมูลผู้ใช้จากฐานข้อมูล
    $userSql = "SELECT fname FROM users WHERE user_id = '{$_SESSION['user_id']}'";
    $userResult = mysqli_query($conn, $userSql);
    $userRow = mysqli_fetch_assoc($userResult);
}
?>
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
  <!-- Topbar Navbar -->
  <ul class="navbar-nav ml-auto">
    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <?php if (isset($_SESSION['user_id'])): ?>
          <span class="mr-2 d-none d-lg-inline text-gray-600"><?php echo $userRow['fname']; ?></span>
          <img class="img-profile rounded-circle" src="img/undraw_profile.svg" />
        <?php endif; ?>
      </a>
      <!-- Dropdown - User Information -->
      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="#">
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
