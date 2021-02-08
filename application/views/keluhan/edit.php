<!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <h4 class="text-gray-800"><strong>Edit Data Keluhan</strong></h4>
    <hr>

    <div class="col-lg-8 mt-4 mb-5">
      <div class="card text-dark shadow">
        <div class="card-header"></div>

        <div class="card-body">
          <?= $this->session->flashdata('pesan'); ?>
            <form class="" action="" method="post" enctype="multipart/form-data">
              <input type="hidden" name="foto_lama" value="<?= $keluhan['foto']; ?>">

              <div class="form-group">
                <img class="mb-4" src="<?= base_url('assets/img/keluhan/').$keluhan['foto']; ?>" width="100%">
                <label for="foto"><strong>Ubah Foto</strong></label>
                <input type="file" class="form-control" id="foto" name="foto">
              </div>

              <div class="form-group">
                <label for="isi_laporan"><strong>Keluhan</strong></label>
                <textarea class="form-control" id="isi_laporan" name="isi_laporan" rows="6"><?= $keluhan['isi_laporan']; ?></textarea>
                <?= form_error('isi_laporan', '<small class="text-danger">', '</small>'); ?>
              </div>

              <a class="btn btn-warning mt-1" href="<?= base_url('keluhan'); ?>"><i class="fas fa-undo"></i> Kembali</a>
              <button class="btn btn-primary float-right mt-1" type="submit"><i class="fas fa-paper-plane"></i> Kirim</button>
              <button class="btn btn-danger float-right mr-2 mt-1" type="reset">Reset</button>
            </form>
        </div>
      </div>

    </div>
  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
