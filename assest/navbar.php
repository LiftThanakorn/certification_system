<?php
require_once 'dbconnect.php';

$userRow = $loggedInUserRow = [];

if (isset($_SESSION['user_id'])) {
  $loggedInUserId = $_SESSION['user_id'];
  $loggedInUserSql = "SELECT fname, image FROM users WHERE user_id = '$loggedInUserId'";
  $loggedInUserResult = mysqli_query($conn, $loggedInUserSql);
  $loggedInUserRow = mysqli_fetch_assoc($loggedInUserResult);
}

$statusSql = "SELECT COUNT(*) AS pendingCount FROM requestcertificate WHERE status = 'รอดำเนินการ'";
$statusResult = mysqli_query($conn, $statusSql);
$statusRow = mysqli_fetch_assoc($statusResult);
$pendingRequestCount = $statusRow['pendingCount'];

$inProgressSql = "SELECT COUNT(*) AS inProgressCount FROM requestcertificate WHERE status = 'กำลังดำเนินการ'";
$inProgressResult = mysqli_query($conn, $inProgressSql);
$inProgressRow = mysqli_fetch_assoc($inProgressResult);
$inProgressRequestCount = $inProgressRow['inProgressCount'];

$loggedInUserName = $loggedInUserRow['fname'] ?? '';
$loggedInUserImage = $loggedInUserRow['image'] ?? '';

?>


<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
  <ul class="navbar-nav ml-auto">
    <?php if ($_SESSION['user_level'] === 'admin' || $_SESSION['user_level'] === 'manager') : ?>
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="inProgressRequests.php" id="alertsDropdown" role="button" aria-haspopup="true" aria-expanded="false">
          <span style="color: #858796;">คำร้องขอที่กำลังดำเนินการ
            <i class="fa-solid fa-bell <?= ($inProgressRequestCount > 0) ? 'fa-shake' : ''; ?> fa-lg"></i>
          </span>
          <?php if ($inProgressRequestCount > 0) : ?>
            <span style="padding: 5px 8px 5px 8px; font-size: 16px;" class="badge badge-danger badge-counter"><?= $inProgressRequestCount ?></span>
          <?php endif; ?>
        </a>
      </li>
    <?php endif; ?>

    <div class="topbar-divider d-none d-sm-block"></div>

    <?php if ($_SESSION['user_level'] === 'admin' || $_SESSION['user_level'] === 'manager') : ?>
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="pendingRequests.php" id="alertsDropdown1" role="button" aria-haspopup="true" aria-expanded="false">
          <span style="color: #858796;">คำร้องขอที่ยังไม่ดำเนินการ
            <i class="fa-solid fa-bell <?= ($pendingRequestCount > 0) ? 'fa-shake' : ''; ?> fa-lg"></i>
          </span>
          <?php if ($pendingRequestCount > 0) : ?>
            <span style="padding: 5px 8px 5px 8px; font-size: 16px;" class="badge badge-danger badge-counter"><?= $pendingRequestCount ?></span>
          <?php endif; ?>
        </a>
      </li>
    <?php endif; ?>

    <div class="topbar-divider d-none d-sm-block"></div>

    <?php if (isset($_SESSION['user_id'])) : ?>
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="mr-2 d-none d-lg-inline text-gray-600"><?= $loggedInUserName ?></span>
          <img class="img-profile rounded-circle" src="img/<?= $loggedInUserImage ?>" alt="userProfile" />
        </a>
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown1">
          <a class="dropdown-item" href="profile.php?user_id=<?= $_SESSION['user_id'] ?>">
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
    <?php endif; ?>
  </ul>
</nav>
