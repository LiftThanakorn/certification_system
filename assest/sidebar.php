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
        <li class="nav-item">
            <a class="nav-link" href="dashboard.php">
                <i class="fa-solid fa-house fa-2xl"></i>
                <span style="font-size: 16px;">หน้าแรก</span>
            </a>
        </li>
        <?php if ($_SESSION['user_level'] === 'admin' || $_SESSION['user_level'] === 'manager') { ?>
            <li class="nav-item">
                <a class="nav-link" href="dashboard_m.php">
                    <i class="fa-solid fa-circle-exclamation fa-beat"></i>
                    <span style="font-size: 16px;">คำร้องขอใบรับรองทั้งหมด</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="inProgressRequests.php">
                    <i class="fa-solid fa-circle-exclamation fa-beat"></i>
                    <span style="font-size: 14px;">คำร้องขอใบรับรองที่กำลังดำเนินการ</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pendingRequests.php">
                    <i class="fa-solid fa-circle-exclamation fa-beat"></i>
                    <span style="font-size: 14px;">คำร้องขอใบรับรองที่ยังไม่ได้ดำเนินการ</span>
                </a>
            </li>
        <?php } ?>
        <?php if ($_SESSION['user_level'] === 'admin') { ?>
            <li class="nav-item">
                <a href="usersprofile.php" class="nav-link active">
                    <i class="fa-solid fa-users"></i>
                    <span>USERS</span>
                </a>
            </li>
        <?php } ?>
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block" />
        <!-- Sidebar Toggler (Sidebar) -->
    </ul>

</body>