<div class="container">
  <div class="row justify-content-center pt-5">
    <div class="col-lg-5">

      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
          <!-- Nested Row within Card Body -->
          <div class="row">
            <div class="col-lg">
              <div class="p-5">
                <div class="text-center">
                  <i class="fas fa-cube fa-4x mb-2 text-primary"></i>
                  <h1 class="h4 text-primary">Buat akun <strong>SIKEMAS!</strong></h1>
                  <?= $this->session->flashdata('pesan'); ?>
                </div>

                <form method="post" action="<?= base_url('auth/registrasi'); ?>">
                  <div class="form-group">
                    <h6 class="text-secondary text-center"><i><strong class="text-danger">NIK harus sudah terdaftar.</strong></i></h6>
                    <input type="text" class="form-control form-control-user" id="nik" name="nik" placeholder="Masukan NIK" value="<?= set_value('nik'); ?>">
                  <?= form_error('nik', '<small class="text-danger">', '</small>'); ?>
                  </div>

                  <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username" value="<?= set_value('username'); ?>">
                    <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                      <?= form_error('password1', '<small class="text-danger">', '</small>'); ?>
                    </div>

                    <div class="col-sm-6">
                      <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Konfirmasi Password">
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary btn-user btn-block">
                    Daftar
                  </button>
                </form>
                <hr>
                <div class="text-center">
                  <a class="small" href="<?= base_url('auth'); ?>">Sudah punya akun? Login!</a>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
  </div>
</div>
