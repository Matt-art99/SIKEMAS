<!-- Begin Page Content -->
  <div class="container-fluid mb-5">

    <!-- Page Heading -->
    <h4 class="text-gray-800"><strong>Data Keluhan</strong></h4>
    <hr>
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('pesan'); ?>"></div>
    <table class="table table-responsive-sm table-hover" id="example">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nama</th>
          <th scope="col">Keluhan</th>
          <th scope="col">Tanggal</th>
          <th scope="col">Opsi</th>
        </tr>
      </thead>
      <tbody>
          <?php $i = 1; ?>
          <?php foreach ($keluhan as $row): ?>
            <tr>
              <th scope="row"><?= $i++; ?></th>
              <td class="mt-2"><?= $row['nama']; ?></td>
              <td class="mt-2"><?= $row['isi_laporan']; ?></td>
              <td class="mt-2"><?= $row['tgl_pengaduan']; ?></td>
              <td>
                <a href="<?= base_url('keluhan/detail/').$row['id_pengaduan']; ?>" class="btn btn-success btn-sm mt-2">
                  <i class="fas fa-fw fa-eye"></i>
                </a>
                <a href="<?= base_url('keluhan/edit/').$row['id_pengaduan']; ?>" class="btn btn-primary btn-sm mt-2">
                  <i class="fas fa-fw fa-edit"></i>
                </a>
                <a href="<?= base_url('keluhan/hapus/').$row['id_pengaduan']; ?>" class="btn btn-danger btn-sm mt-2 tombol-hapus">
                  <i class="fas fa-fw fa-trash"></i>
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
