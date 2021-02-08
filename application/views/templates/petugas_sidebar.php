<!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('admin'); ?>">
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-cubes"></i>
      </div>
      <div class="sidebar-brand-text mx-3">SIKEMAS</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
      Administrator
    </div>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php if($aktif == 'dashboard'){echo " active";} ?>">
      <a class="nav-link pb-0" href="<?= base_url('admin'); ?>">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>

    <li class="nav-item <?php if($aktif == 'pengaduan'){echo " active";} ?>">
      <a class="nav-link pb-0" href="<?= base_url('petugas/pengaduan'); ?>">
        <i class="fas fa-fw fa-file-alt"></i>
        <span>Data Keluhan</span></a>
    </li>

    <li class="nav-item <?php if($aktif == 'penduduk'){echo " active";} ?>">
      <a class="nav-link pb-0" href="<?= base_url('petugas/dataPenduduk'); ?>">
        <i class="fas fa-fw fa-user"></i>
        <span>Data Penduduk</span></a>
    </li>

    <li class="nav-item <?php if($aktif == 'admin sistem'){echo " active";} ?>">
      <a class="nav-link pb-0" href="<?= base_url('petugas/adminSistem'); ?>">
        <i class="fas fa-fw fa-user-check"></i>
        <span>Admin Sistem</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
      User
    </div>

    <li class="nav-item  <?php if($aktif == 'profil admin'){echo " active";} ?>">
      <a class="nav-link pb-0" href="<?= base_url('petugas/profil'); ?>">
        <i class="fas fa-fw fa-user-edit"></i>
        <span>Profil</span></a>
    </li>

    <li class="nav-item <?php if($aktif == 'edit password admin'){echo " active";} ?>">
      <a class="nav-link pb-0" href="<?= base_url('petugas/editPassword'); ?>">
        <i class="fas fa-fw fa-user-cog"></i>
        <span>Edit Password</span></a>
    </li>

    <li class="nav-item">
      <a class="nav-link pb-0 logout" href="<?= base_url('auth/admin_logout'); ?>">
        <i class="fas fa-fw fa-sign-out-alt"></i>
        <span>Logout</span></a>
    </li>
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

  </ul>
  <!-- End of Sidebar -->
