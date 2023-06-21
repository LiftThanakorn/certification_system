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
<style>
  .navbarlogo{
    width: 35px;
    margin-right: 10px;
  }
</style>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
  <a class="navbar-brand" href="#"><img src="images/stamp.png" alt="Italian Trulli" class="navbarlogo" >ระบบขอใบรับรอง</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="dashboard.php">Dashboard</a>
        </li>
        <?php if (isset($_SESSION['user_id'])): ?>
          <?php if ($_SESSION['user_level'] === 'ผู้ใช้ทั่วไป'): ?>
            <li class="nav-item">
              <a class="nav-link" href="#">Welcome, <?php echo $userRow['fname']; ?></a>
            </li>
          <?php elseif ($_SESSION['user_level'] === 'ผู้บริหาร' || $_SESSION['user_level'] === 'แอดมิน'): ?>
            <li class="nav-item">
              <a class="nav-link" href="dashboard_m.php">Dashboard (Admin/Manager)</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Welcome, <?php echo $userRow['fname']; ?></a>
            </li>
          <?php endif; ?>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register.php">Register</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>


<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                <img class="img-profile rounded-circle" src="img/undraw_profile.svg" />
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
        แก้ไข navbar.php ให้ใช้กับ โค้ดนี้