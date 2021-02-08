<!DOCTYPE html>
<html lang="en" dir="ltr"><head>
    <meta charset="utf-8">
    <!-- Custom styles for this template-->
    <title>Halaman Export PDF</title>
</head><body>
  <h2 style="text-align: center;">SISTEM INFORMASI KELUHAN MASYARAKAT</h2>
  <p style="text-align: center; margin-top: -100px;">Dusun V Margaria, Kec. Terbanggi Besar, Kabupaten Lampung Tengah, Lampung.</p>
  <p style="text-align: center; padding-top: -15px;">HP. 085366848378</p>
  <p style="text-align: center; padding-top: -15px;">web : www.dusunvmargaria.com</p>
  <hr>
  <h3 style="text-align: center;">DAFTAR PENGADUAN</h3>
    <table width="700px" cellspacing="8">
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Keluhan</th>
          <th>Tanggal</th>
          <th>Status</th>
        </tr>

      <?php $i = 1; ?>
      <?php foreach ($pengaduan as $p): ?>
        <tr>
          <td align="center"><?= $i++; ?></td>
          <td align="center"><?= $p['nama']; ?></td>
          <td align="center"><?= $p['isi_laporan']; ?></td>
          <td align="center"><?= $p['tgl_pengaduan']; ?></td>
          <td align="center">
            <?php if ($p['status'] == 'proses'): ?>
              <?= "Menunggu Verifikasi"; ?>
            <?php elseif($p['status'] == 'selesai') : ?>
              <?= "Sudah Diverifikasi"; ?>
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>

    </table>
</body></html>
