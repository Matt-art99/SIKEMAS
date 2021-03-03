<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengaduan extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Pengaduan_model', 'pengaduan');
    $this->load->model('Keluhan_model', 'keluhan');
    ceklogin_admin();
  }

  public function index()
  {
    $data['judul'] = 'Halaman Data Keluhan';
    $data['aktif'] = 'pengaduan';
    $data['petugas'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('admin')])->row_array();
    $data['pengaduan'] = $this->pengaduan->getAllDataPengaduan()->result_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/admin_sidebar');
    $this->load->view('templates/topbar', $data);
    $this->load->view('pengaduan/index', $data);
    $this->load->view('templates/footer');
  }

  public function detail($id)
  {
    $data['judul'] = 'Halaman Detail Data Pengaduan';
    $data['aktif'] = 'pengaduan';
    $data['petugas'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('admin')])->row_array();
    $data['keluhan'] = $this->keluhan->getKeluhanById($id);

    $this->load->view('templates/header', $data);
    $this->load->view('templates/admin_sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('pengaduan/detail', $data);
    $this->load->view('templates/footer');
  }

  public function ubah($id)
  {
    $keluhan = $this->keluhan->getKeluhanById($id);
    $proses = 'proses';
    $selesai = 'selesai';

    if ($keluhan['status'] == 'proses') {
      $this->db->set('status', $selesai);
      $this->db->where('id_pengaduan', $id);
      $this->db->update('pengaduan');
      $this->session->set_flashdata(
        'pesan',
        '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Status pengaduan berhasil diubah!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>'
      );
      redirect('pengaduan');
    } else {
      $this->db->set('status', $proses);
      $this->db->where('id_pengaduan', $id);
      $this->db->update('pengaduan');
      $this->session->set_flashdata(
        'pesan',
        '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Status pengaduan berhasil diubah!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>'
      );
      redirect('pengaduan');
    }
  }

  public function pdf()
  {
    $this->load->library('dompdf_gen');
    $data['pengaduan'] = $this->pengaduan->getAllDataPengaduan()->result_array();

    $this->load->view('pengaduan/pdf', $data);

    $paper_size = 'A5';
    $orientation = 'landscape';
    $html = $this->output->get_output();
    $this->dompdf->set_paper($paper_size, $orientation);

    $this->dompdf->load_html($html);
    $this->dompdf->render();
    $this->dompdf->stream("laporan_pengaduan.pdf", array('Attachment' => 0));
  }

  public function excel()
  {
    $data['pengaduan'] = $this->pengaduan->getAllDataPengaduan()->result_array();
    require(APPPATH . 'PHPExcel-1.8/Classes/PHPExcel.php');
    require(APPPATH . 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

    $object = new PHPExcel();

    $object->getProperties()->setCreator("Rachmat Ardico Perdana");
    $object->getProperties()->setLastModifiedBy("Rachmat Ardico Perdana");
    $object->getProperties()->setTitle("Daftar Pengaduan");

    $object->setActiveSheetIndex(0);

    $object->getActiveSheet()->setCellValue('A1', 'No');
    $object->getActiveSheet()->setCellValue('B1', 'Nama');
    $object->getActiveSheet()->setCellValue('C1', 'Keluhan');
    $object->getActiveSheet()->setCellValue('D1', 'Tanggal');
    $object->getActiveSheet()->setCellValue('E1', 'Status');

    $baris = 2;
    $no = 1;

    foreach ($data['pengaduan'] as $p) {
      $object->getActiveSheet()->setCellValue('A' . $baris, $no++);
      $object->getActiveSheet()->setCellValue('B' . $baris, $p['nama']);
      $object->getActiveSheet()->setCellValue('C' . $baris, $p['isi_laporan']);
      $object->getActiveSheet()->setCellValue('D' . $baris, $p['tgl_pengaduan']);
      $object->getActiveSheet()->setCellValue('E' . $baris, $p['status']);

      $baris++;
    }

    $filename = "Data_Pengaduan" . '.xlsx';

    $object->getActiveSheet()->setTitle("DATA PENGADUAN");

    header('Content-Type: application/vnd.openxmplformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    $writer = PHPExcel_IOFactory::createwriter($object, 'Excel2007');
    $writer->save('php://output');

    exit;
  }

  public function petugasKeluhan()
  {
    $data['judul'] = 'Halaman Data Keluhan';
    $data['aktif'] = 'pengaduan';
    $data['petugas'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('admin')])->row_array();
    $data['pengaduan'] = $this->pengaduan->getAllDataPengaduan()->result_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/petugas_sidebar');
    $this->load->view('templates/topbar', $data);
    $this->load->view('pengaduan/petugas_keluhan', $data);
    $this->load->view('templates/footer');
  }

  public function detailPetugas($id)
  {
    $data['judul'] = 'Halaman Detail Data Pengaduan';
    $data['aktif'] = 'pengaduan';
    $data['petugas'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('admin')])->row_array();
    $data['keluhan'] = $this->keluhan->getKeluhanById($id);

    $this->load->view('templates/header', $data);
    $this->load->view('templates/petugas_sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('pengaduan/detailPetugas', $data);
    $this->load->view('templates/footer');
  }
}
