<!-- Outer Row -->
<div class="row justify-content-center pt-5">

  <div class="col-lg-5">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg">
            <div class="p-5">
              <div class="text-center">
                <i class="fas fa-cube fa-4x mb-2 text-primary"></i>
                <h1 class="h4 text-primary text-center mb-4">Selamat Datang di Sistem Informasi Keluhan Masyarakat</h1>
                <div class="logout" data-logout="<?= $this->session->flashdata('pesan'); ?>"></div>
              </div>
              <form method="post" action="<?= base_url('auth'); ?>">
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username">
                  <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                  <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                </div>

                <button type="submit" class="btn btn-primary btn-user btn-block">
                  Login
                </button>
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="<?= base_url('auth/registrasi'); ?>">Belum punya akun? Daftar!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

</div>

</div>
