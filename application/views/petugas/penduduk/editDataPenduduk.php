<!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <h4 class="mb-4 text-gray-800"><strong>Edit Data Penduduk</strong></h4>
    <hr>
      <div class="row">
        <div class="col-lg-8">

          <div class="card text-dark shadow">
            <div class="card-header">
            </div>

            <div class="card-body">
              <form class="user" action="" method="post">
                <div class="form-group">
                  <input type="text" class="form-control" id="nik" name="nik" placeholder="Masukan NIK" value="<?= $masyarakat['nik']; ?>" readonly>
                </div>

                <div class="form-group">
                  <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="<?= $masyarakat['nama']; ?>">
                </div>

                <div class="form-group">
                  <input type="text" class="form-control" id="telp" name="telp" placeholder="No Telp." value="<?= $masyarakat['telp']; ?>">
                </div>

                <button type="submit" class="btn btn-primary float-right"><i class="fas fa-edit"></i> Edit Data</button>
                <a href="<?= base_url('petugas/dataPenduduk'); ?>" class="btn btn-warning mr-2 float-right"><i class="fas fa-undo"></i> Kembali</a>
              </form>
            </div>
          </div>
        </div>
      </div>

  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
