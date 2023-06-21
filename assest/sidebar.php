<?php
// Check if user level is set
if (isset($_SESSION['user_level'])) {
    $userLevel = $_SESSION['user_level'];
} else {
    $userLevel = ''; // Set default value if user level is not set
}
?>

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
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
<!-- Nav Item - Dashboard -->
<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <?php
    $dashboardLink = '';
    if ($userLevel === 'ผู้ใช้ทั่วไป') {
        $dashboardLink = 'dashboard.php';
    } else if ($userLevel === 'ผู้บริหาร' || $userLevel === 'แอดมิน') {
        $dashboardLink = 'dashboard_m.php';
    }
    ?>
    <a class="nav-link" href="<?php echo $dashboardLink; ?>">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span>
    </a>
</li>



    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block" />

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
