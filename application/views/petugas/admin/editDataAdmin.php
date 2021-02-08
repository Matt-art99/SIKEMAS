<!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <h4 class="mb-4 text-gray-800"><strong>Edit Data Petugas</strong></h4>
    <hr>
      <div class="row">
        <div class="col-lg-8">

          <div class="card text-dark shadow">
            <div class="card-header">
            </div>

            <div class="card-body">
              <form class="user" action="" method="post">
                <div class="form-group">
                  <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?= $admin['username']; ?>" readonly>
                </div>

                <div class="form-group">
                  <input type="text" class="form-control" id="nama_petugas" name="nama_petugas" placeholder="Nama Admin" value="<?= $admin['nama_petugas']; ?>">
                </div>

                <div class="form-group">
                  <input type="text" class="form-control" id="telp" name="telp" placeholder="No Telp." value="<?= $admin['telp']; ?>">
                </div>

                <button type="submit" class="btn btn-primary float-right"><i class="fas fa-edit"></i> Edit Data</button>
                <a href="<?= base_url('petugas/adminSistem'); ?>" class="btn btn-warning mr-2 float-right"><i class="fas fa-undo"></i> Kembali</a>
              </form>
            </div>
          </div>
        </div>
      </div>

  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
