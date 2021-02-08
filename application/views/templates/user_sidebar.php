<!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('user'); ?>">
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-cube"></i>
      </div>
      <div class="sidebar-brand-text mx-3">SIKEMAS</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
      Penduduk
    </div>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php if($aktif == 'dashboard'){echo " active";} ?>">
      <a class="nav-link pb-0" href="<?= base_url('user'); ?>">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>

    <li class="nav-item <?php if($aktif == 'input keluhan'){echo " active";} ?>">
      <a class="nav-link pb-0" href="<?= base_url('keluhan/inputKeluhan'); ?>">
        <i class="fas fa-fw fa-file-alt"></i>
        <span>Input Keluhan</span></a>
    </li>

    <li class="nav-item <?php if($aktif == 'data keluhan'){echo " active";} ?>">
      <a class="nav-link pb-0" href="<?= base_url('keluhan'); ?> ">
        <i class="fas fa-fw fa-user"></i>
        <span>Data Keluhan</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
      User
    </div>

    <li class="nav-item <?php if($aktif == 'profil user'){echo " active";} ?>">
      <a class="nav-link pb-0" href="<?= base_url('user/profil'); ?>">
        <i class="fas fa-fw fa-user-edit"></i>
        <span>Profil</span></a>
    </li>

    <li class="nav-item <?php if($aktif == 'edit password user'){echo " active";} ?>">
      <a class="nav-link pb-0" href="<?= base_url('user/editPassword'); ?>">
        <i class="fas fa-fw fa-user-cog"></i>
        <span>Edit Password</span></a>
    </li>

    <li class="nav-item">
      <a class="nav-link pb-0 tombol-logout" href="<?= base_url('auth/logout'); ?>">
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
