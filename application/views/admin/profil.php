<!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <h4 class="text-gray-800"><strong>Profil <?= $petugas['nama_petugas']; ?></strong></h4>
    <hr>
      <div class="row">
        <div class="col-lg-8 mb-5">

          <div class="card text-dark shadow">
            <div class="card-header">
            </div>

            <div class="card-body">
              <?= $this->session->flashdata('pesan'); ?>
              <form class="user" action="" method="post">
                <div class="form-group">
                  <label for="username"><strong>Username</strong></label>
                  <input type="text" class="form-control" id="username" name="username" value="<?= $petugas['username']; ?>" readonly>
                </div>

                <div class="form-group">
                  <label for="nama_petugas"><strong>Nama</strong></label>
                  <input type="text" class="form-control" id="nama_petugas" name="nama_petugas" value="<?= $petugas['nama_petugas']; ?>">
                </div>

                <div class="form-group">
                  <label for="telp"><strong>No Telepon</strong></label>
                  <input type="text" class="form-control" id="telp" name="telp" value="<?= $petugas['telp']; ?>">
                </div>

                <div class="form-group">
                  <label for="level"><strong>Level</strong></label>
                  <input type="text" class="form-control" id="level" name="level" value="<?= $petugas['level']; ?>" readonly>
                </div>

                <button type="submit" class="btn btn-primary float-right"><i class="fas fa-edit"></i> Edit Profil</button>
              </form>
            </div>
          </div>
        </div>
      </div>

  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
