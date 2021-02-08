<!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <h4 class="text-gray-800"><strong>Data Keluhan</strong></h4>
    <hr>

    <?= $this->session->flashdata('pesan'); ?>

    <div class="row mt-2 mb-5">
      <div class="col-lg">
        <table class="table table-hover" id="example" style="width:100%">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nama</th>
              <th scope="col">Keluhan</th>
              <th scope="col">Tanggal</th>
              <th scope="col">Status</th>
              <th scope="col">Opsi</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php foreach ($pengaduan as $p): ?>
            <tr>
              <th class="pt-4" scope="row"><?= $i++; ?></th>
              <td class="pt-4"><?= $p['nama']; ?></td>
              <td class="pt-4"><?= $p['isi_laporan']; ?></td>
              <td class="pt-4"><?= $p['tgl_pengaduan']; ?></td>
              <td class="pt-4">
                <?php if ($p['status'] == 'proses'): ?>
                  <?= "Menunggu Verifikasi"; ?>
                <?php elseif($p['status'] == 'selesai') : ?>
                  <?= "Sudah Diverifikasi"; ?>
                <?php endif; ?>
              </td>
              <td>
                <a class="btn btn-info btn-sm mt-2" href="<?= base_url('petugas/detailPengaduan/') . $p['id_pengaduan']; ?>">
                  <i class="fas fa-fw fa-eye"></i>
                </a>
                <a onclick="return confirm('Apakah anda yakin ingin mengubah status?');" class="btn btn-success btn-sm mt-2" href="<?= base_url('petugas/ubahPengaduan/');?><?= $p['id_pengaduan']; ?>">
                  <i class="fas fa-fw fa-user-check"></i>
                </a>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>


  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
