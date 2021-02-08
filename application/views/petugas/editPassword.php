<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h4 class="text-gray-800"><strong>Edit Password <?= $petugas['nama_petugas']; ?></strong></h4>
  <hr>
  <div class="row">
    <div class="col-lg-8 mb-5">

      <div class="card text-dark shadow">
        <div class="card-header">
        </div>

        <div class="card-body">
          <?= $this->session->flashdata('pesan'); ?>
          <form action="<?= base_url('petugas/editPassword'); ?>" method="post">

            <div class="form-group">
              <label for="current_password"><strong>Password Lama</strong></label>
              <input type="password" class="form-control" id="password_lama" name="password_lama">
              <?= form_error('password_lama', '<small class="text-danger">', '</small>'); ?>
            </div>

            <div class="form-group">
              <label for="password_baru1"><strong>Password Baru</strong></label>
              <input type="password" class="form-control" id="password_baru1" name="password_baru1">
              <?= form_error('password_baru1', '<small class="text-danger">', '</small>'); ?>
            </div>

            <div class="form-group">
              <label for="new_password2"><strong>Konfirmasi Password</strong></label>
              <input type="password" class="form-control" id="password_baru2" name="password_baru2">
              <?= form_error('password_baru2', '<small class="text-danger">', '</small>'); ?>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i> Ubah Password</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
