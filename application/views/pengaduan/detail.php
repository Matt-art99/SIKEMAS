<!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <h4 class="text-gray-800"><strong>Detail Pengaduan</strong></h4>
    <hr>

    <div class="col-lg-8 mt-4 mb-5">
      <div class="card text-dark shadow">
        <div class="card-header">
        </div>

        <div class="card-body">
            <form>
              <div class="form-group">
                <label><strong>Foto</strong></label>
                <img id="foto" src="<?= base_url('assets/img/keluhan/').$keluhan['foto']; ?>" width="100%">
              </div>

              <div class="form-group">
                <label><strong>Keluhan</strong></label>
                <textarea class="form-control"rows="6" readonly><?= $keluhan['isi_laporan']; ?></textarea>
              </div>

              <div class="form-group">
                <label><strong>Nama</strong></label>
                <input class="form-control"rows="6" readonly value="<?= $keluhan['nama']; ?>"></input>
              </div>

              <div class="form-group">
                <label><strong>Tanggal</strong></label>
                <input class="form-control"rows="6" readonly value="<?= $keluhan['tgl_pengaduan']; ?>"></input>
              </div>

              <div class="form-group">
                <label><strong>Status</strong></label>
                <input class="form-control"rows="6" readonly value="
                  <?php if ($keluhan['status'] == 'proses'): ?>
                    <?= "Menunggu Verifikasi"; ?>
                  <?php elseif($keluhan['status'] == 'selesai') : ?>
                    <?= "Sudah Diverifikasi"; ?>
                  <?php endif; ?>">
                </input>
              </div>

              <a class="btn btn-warning float-right" href="<?= base_url('pengaduan'); ?>"><i class=" fas fa-undo"></i> Kembali</a>
            </form>
        </div>
      </div>

    </div>
  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
