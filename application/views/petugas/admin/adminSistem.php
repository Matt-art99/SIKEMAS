<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h4 class="text-gray-800"><strong>Data Admin Sistem</strong></h4>
  <hr>
  <?= $this->session->flashdata('pesan'); ?>
  <div class="row mt-2 mb-5">
    <div class="col-lg">
      <table class="table table-hover" style="width:100%" id="example">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">No Telp.</th>
            <th scope="col">level</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1; ?>
          <?php foreach ($admin as $p) : ?>
            <tr>
              <th scope="row"><?= $i++; ?></th>
              <td class="pt-3"><?= $p['nama_petugas']; ?></td>
              <td class="pt-3"><?= $p['telp']; ?></td>
              <td class="pt-3"><?= $p['level']; ?></td>
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