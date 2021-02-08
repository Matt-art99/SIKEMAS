<!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <h4 class="text-gray-800"><strong>Input Keluhan</strong></h4>
    <hr>

    <div class="col-lg-8 mt-4 mb-5">
      <div class="card text-dark shadow">
        <div class="card-header"></div>

        <div class="card-body">
          <?= $this->session->flashdata('pesan'); ?>
            <form class="" action="<?= base_url('keluhan/inputKeluhan'); ?>" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label for="foto"><strong>Foto</strong></label>
                <input type="file" class="form-control" id="foto" name="foto">
              </div>

              <div class="form-group">
                <label for="isi_laporan"><strong>Keluhan</strong></label>
                <textarea class="form-control" id="isi_laporan" name="isi_laporan" rows="6"></textarea>
                <?= form_error('isi_laporan', '<small class="text-danger">', '</small>'); ?>
              </div>

              <button class="btn btn-primary float-right" type="submit"><i class="fas fa-paper-plane"></i> Kirim</button>
              <button class="btn btn-danger float-right mr-2" type="reset">Reset</button>
            </form>
        </div>
      </div>

    </div>
  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
