        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('/'); ?>">
            <div class="sidebar-brand-icon">
                <img src="<?= base_url('img/Lambang_Kota_Kendari.png'); ?>" alt="Logo Kota" style="width: 50px; height: 50px;">
                </div>
            <div class="sidebar-brand-text mx-3 text-white">Sistem Informasi Buku Tamu</div>
        </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('/dashboard-admin'); ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menu
            </div>

            <!-- Nav Item - kelola petugas -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('/kelola-petugas'); ?>">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Kelola Petugas</span></a>
            </li>

            <!-- Nav Item - riwayat tamu -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('/riwayat-tamu'); ?>">
                    <i class="fas fa-fw fa-clock"></i>
                    <span>Riwayat Tamu</span></a>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('/statistik'); ?>">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Statistik</span></a>
            </li>
            
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Pengaturan</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Pilih Peraturan:</h6>
                        <!-- <a class="collapse-item" href="buttons.html">Profile</a> -->
                        <a class="collapse-item" href="<?= base_url('/log-aktivitas'); ?>">Log Aktivitas</a>
                        <a class="collapse-item" href="<?= base_url('/ganti-password-admin'); ?>">Ganti Password</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>