<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h4 class="text-gray-800"><strong>Data Petugas</strong></h4>
  <hr>
  <!-- Button trigger modal -->
  <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">
    <i class="fas fa-plus"></i>
    Tambah Data Petugas
  </button>
  <div class="btn-group">
    <button type="button" class="btn btn-warning dropdown-toggle mb-2 text-dark" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-fw fa-download"></i>
      Export
    </button>
    <div class="dropdown-menu bg-warning">
      <a class="dropdown-item" href="<?= base_url('admin/pdf') ?>" target="_blank">
        <i class="fas fa-fw fa-file-pdf"></i>
        PDF
      </a>
      <a class="dropdown-item" href="<?= base_url('admin/excel') ?>" target="_blank">
        <i class="fas fa-fw fa-file-excel"></i>
        EXCEL
      </a>
    </div>
  </div>
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
            <th scope="col">Opsi</th>
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
              <td>
                <a class="btn btn-primary btn-sm mt-2" href="<?= base_url('admin/edit/') . $p['id_petugas']; ?>">
                  <i class="fas fa-fw fa-edit"></i>
                </a>
                <a onclick="return confirm('Yakin?');" class="btn btn-danger btn-sm mt-2" href="<?= base_url('admin/hapus/'); ?><?= $p['id_petugas']; ?>">
                  <i class="fas fa-fw fa-trash-alt"></i>
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
          <h5 class="modal-title" id="exampleModalLabel">Form Tambah Petugas</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?= base_url('admin/tambah'); ?>" method="post">
            <div class="form-group">
              <input type="text" class="form-control" id="nama_petugas" name="nama_petugas" placeholder="Nama" value="<?= set_value('nama_petugas'); ?>">
              <?= form_error('nama_petugas', '<small class="text-danger pl-1">', '</small>'); ?>
            </div>

            <div class="form-group">
              <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?= set_value('username'); ?>">
              <?= form_error('username', '<small class="text-danger pl-1">', '</small>'); ?>
            </div>

            <div class="form-group">
              <input type="password" class="form-control" id="password" name="password" placeholder="Password">
              <?= form_error('password', '<small class="text-danger pl-1">', '</small>'); ?>
            </div>

            <div class="form-group">
              <input type="password" class="form-control" id="password2" name="password2" placeholder="Konfirmasi password">
              <?= form_error('password2', '<small class="text-danger pl-1">', '</small>'); ?>
            </div>

            <div class="form-group">
              <input type="text" class="form-control" id="telp" name="telp" placeholder="No Telp." value="<?= set_value('telp'); ?>">
              <?= form_error('telp', '<small class="text-danger pl-1">', '</small>'); ?>
            </div>

            <div class="form-group">
              <select name="level" id="level" class="form-control">
                <option>Pilih Level</option>
                <option>Petugas</option>
              </select>
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