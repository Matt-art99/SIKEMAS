<!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <h4 class="text-gray-800"><strong>Data Penduduk</strong></h4>
    <hr>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">
      <i class="fas fa-plus"></i>
      Tambah Data Penduduk
    </button>

    <div class="btn-group">
      <button type="button" class="btn btn-warning dropdown-toggle mb-2 text-dark" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-fw fa-download"></i>
         Export
      </button>
      <div class="dropdown-menu bg-warning">
        <a class="dropdown-item" href="<?= base_url('penduduk/pdf') ?>" target="_blank">
          <i class="fas fa-fw fa-file-pdf"></i>
          PDF
        </a>
        <a class="dropdown-item" href="<?= base_url('penduduk/excel') ?>" target="_blank">
          <i class="fas fa-fw fa-file-excel"></i>
          EXCEL
        </a>
      </div>
    </div>
    <?= $this->session->flashdata('pesan'); ?>

    <div class="row mt-2 mb-5">
      <div class="col-lg">
        <table class="table table-hover" id="example" style="width:100%">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">NIK</th>
              <th scope="col">Nama</th>
              <th scope="col">No Telp.</th>
              <th scope="col">Opsi</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php foreach ($penduduk as $p): ?>
            <tr>
              <th class="pt-4" scope="row"><?= $i++; ?></th>
              <td class="pt-4"><?= $p['nik']; ?></td>
              <td class="pt-4"><?= $p['nama']; ?></td>
              <td class="pt-4"><?= $p['telp']; ?></td>
              <td>
                <a class="btn btn-primary btn-sm mt-2" href="<?= base_url('penduduk/edit/') . $p['nik']; ?>">
                  <i class="fas fa-fw fa-edit"></i>
                </a>
                <a onclick="return confirm('Yakin?');" class="btn btn-danger btn-sm mt-2" href="<?= base_url('penduduk/hapus/');?><?= $p['nik']; ?>">
                  <i class="fas fa-fw fa-trash"></i>
                </a>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Form Tambah Data Penduduk</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="<?= base_url('penduduk/tambah'); ?>" method="post">
              <div class="form-group">
                <input type="text" class="form-control" id="nik" name="nik" placeholder="Masukan NIK" value="<?= set_value('nik'); ?>">
                <?= form_error('nik', '<small class="text-danger pl-1">', '</small>'); ?>
              </div>

              <div class="form-group">
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="<?= set_value('nama'); ?>">
                <?= form_error('nama', '<small class="text-danger pl-1">', '</small>'); ?>
              </div>

              <div class="form-group">
                <input type="text" class="form-control" id="telp" name="telp" placeholder="Masukan No Telp." value="<?= set_value('telp'); ?>">
                <?= form_error('telp', '<small class="text-danger pl-1">', '</small>'); ?>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
