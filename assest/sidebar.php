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
                <span>หน้าแรก</span>
            </a>
        </li>
        <?php if ($_SESSION['user_level'] === 'แอดมิน' || $_SESSION['user_level'] === 'ผู้บริหาร') { ?>
    <li class="nav-item active">
        <a class="nav-link" href="dashboard_m.php">
            <i class="fas fa-fw fa-table"></i>
            <span>สำหรับผู้บริหารเท่านั้น</span>
        </a>
    </li>
<?php } ?>
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block" />

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>

    <!-- Rest of the page content -->
</body>