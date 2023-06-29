<?php 

/*   require_once 'dbconnect.php';
  
  if (isset($_SESSION['user_id'])) {
      // คำสั่ง SQL เพื่อดึงจำนวนสถานะที่ยังไม่ได้ดำเนินการ
      $statusSql = "SELECT COUNT(*) AS pendingCount FROM requestcertificate WHERE status = 'รอดำเนินการ'";
      $statusResult = mysqli_query($conn, $statusSql);
      $statusRow = mysqli_fetch_assoc($statusResult);
      $pendingRequestCount = $statusRow['pendingCount'];
  }
 
  

 */
?>

<body class="sidebar-toggled">
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
            <div class="sidebar-brand-icon rotate-n-15">
                <img src="images/stamp.png" alt="logo" height="45px">
            </div>
            <div class="sidebar-brand-text mx-3">Certification System <sup>V1</sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0" />

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="dashboard.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span style="font-size: 16px;">หน้าแรก</span>
            </a>
        </li>
        <?php if ($_SESSION['user_level'] === 'แอดมิน' || $_SESSION['user_level'] === 'ผู้บริหาร') { ?>
    <li class="nav-item">
        <a class="nav-link" href="dashboard_m.php">
            <i class="fas fa-fw fa-table"></i>
            <span style="font-size: 16px;">คำร้องขอใบรับรอง</span>
        </a>
    </li>

    <!-- <li class="nav-item">
    <a class="nav-link" href="dashboard_m.php">
        <i class="fas fa-fw fa-exclamation-triangle"></i>
        <span style="font-size: 14px;">คำร้องขอที่ยังไม่ดำเนินการ <p style="padding: 5px 5px;" class="badge badge-danger" ><?php echo $pendingRequestCount; ?></p></span>
        
    </a>
</li> -->


<?php } ?>
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block" />
        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0 btn btn-link" id="sidebarToggle"></button>

        </div>
    </ul>

    <!-- Rest of the page content -->
</body>

