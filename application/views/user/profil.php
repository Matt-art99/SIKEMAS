<!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <h4 class="text-gray-800"><strong>Profil <?= $user['nama']; ?></strong></h4>
    <hr>
      <div class="row">
        <div class="col-lg-8 mb-5">

          <div class="card text-dark shadow">
            <div class="card-header"></div>

            <div class="card-body">
              <div class="flash-data" data-flashdata="<?= $this->session->flashdata('pesan'); ?>"></div>
              <form class="user" action="" method="post">
                <div class="form-group">
                  <label for="nik"><strong>NIK</strong></label>
                  <input type="text" class="form-control" id="nik" name="nik" placeholder="Username" value="<?= $user['nik']; ?>" readonly>
                </div>

                <div class="form-group">
                  <label for="username"><strong>Username</strong></label>
                  <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?= $user['username']; ?>" readonly>
                </div>

                <div class="form-group">
                  <label for="nama"><strong>Nama</strong></label>
                  <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="<?= $user['nama']; ?>">
                </div>

                <div class="form-group">
                  <label for="telp"><strong>No Telepon</strong></label>
                  <input type="text" class="form-control" id="telp" name="telp" placeholder="No Telp." value="<?= $user['telp']; ?>">
                </div>

                <button type="submit" class="btn btn-primary float-right"><i class="fas fa-edit"></i> Edit Data</button>
              </form>
            </div>
          </div>
        </div>
      </div>

  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
