<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penduduk extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    ceklogin_admin();
    $this->load->model('Penduduk_model', 'penduduk');
  }

// Tampilan data penduduk Admin
  public function index()
  {
    $data['penduduk'] = $this->db->get('masyarakat')->result_array();
    $data['aktif'] = 'penduduk';
    $data['petugas'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('admin')])->row_array();
    $data['judul'] = 'Halaman Data Penduduk';

      $this->load->view('templates/header', $data);
      $this->load->view('templates/admin_sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('penduduk/index', $data);
      $this->load->view('templates/footer');
  }

  public function tambah()
  {
    $data['penduduk'] = $this->db->get('masyarakat')->result_array();
    $data['judul'] = 'Halaman Data Keluhan';

    $this->form_validation->set_rules('nik', 'NIK', 'required|trim|numeric|min_length[16]',
    [
      'required' => 'Kolom NIK harus diisi!',
      'numeric' => 'Kolom NIK harus berupa angka!',
      'min_length' => 'NIK harus terdiri dari 16 angka!'
    ]);
    $this->form_validation->set_rules('nama', 'Nama', 'required|trim',
    [
      'required' => 'Kolom Nama harus diisi!',
    ]);
    $this->form_validation->set_rules('telp', 'Telp', 'required|trim|max_length[13]',
    [
      'required' => 'Kolom No telp. harus diisi!',
      'max_length' => 'No telepon maksimal 13 karakter!'
    ]);

    if($this->form_validation->run() == false){
      $this->load->view('templates/header', $data);
      $this->load->view('templates/admin_sidebar');
      $this->load->view('templates/topbar');
      $this->load->view('penduduk/index', $data);
      $this->load->view('templates/footer');
    }else {
      $this->penduduk->tambahDataPenduduk();
    }
  }

  public function edit($nik)
  {
    $data['masyarakat'] = $this->penduduk->getPendudukByNik($nik);
    $data['aktif'] = 'penduduk';
    $data['petugas'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('admin')])->row_array();
    $data['judul'] = 'Halaman Data Keluhan';

    $this->form_validation->set_rules('nik', 'NIK', 'required|trim|numeric|min_length[16]',
    [
      'required' => 'Kolom NIK harus diisi!',
      'numeric' => 'Kolom NIK harus berupa angka!',
      'min_length' => 'NIK harus terdiri dari 16 angka!'
    ]);
    $this->form_validation->set_rules('nama', 'Nama', 'required|trim',
    [
      'required' => 'Kolom Nama harus diisi!',
    ]);
    $this->form_validation->set_rules('telp', 'Telp', 'required|trim|max_length[13]',
    [
      'required' => 'Kolom No telp. harus diisi!',
      'max_length' => 'No telepon maksimal 13 karakter!'
    ]);

    if($this->form_validation->run() == false){
      $this->load->view('templates/header', $data);
      $this->load->view('templates/admin_sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('penduduk/edit', $data);
      $this->load->view('templates/footer');
    }else {
      $this->penduduk->editDataPenduduk($nik);
    }
  }

  public function hapus($nik)
  {
    $this->penduduk->hapusDataPenduduk($nik);
  }

  public function pdf()
  {
    $this->load->library('dompdf_gen');
    $data['penduduk'] = $this->db->get('masyarakat')->result_array();

    $this->load->view('penduduk/pdf', $data);

    $paper_size = 'A5';
    $orientation = 'landscape';
    $html = $this->output->get_output();
    $this->dompdf->set_paper($paper_size, $orientation);

    $this->dompdf->load_html($html);
    $this->dompdf->render();
    $this->dompdf->stream("laporan_penduduk.pdf", array('Attachment' => 0));
  }

  public function excel()
  {
    $data['penduduk'] = $this->db->get('masyarakat')->result_array();
    require(APPPATH. 'PHPExcel-1.8/Classes/PHPExcel.php');
    require(APPPATH. 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

    $object = new PHPExcel();

    $object->getProperties()->setCreator("Rachmat Ardico Perdana");
    $object->getProperties()->setLastModifiedBy("Rachmat Ardico Perdana");
    $object->getProperties()->setTitle("Daftar Penduduk");

    $object->setActiveSheetIndex(0);

    $object->getActiveSheet()->setCellValue('A1', 'No');
    $object->getActiveSheet()->setCellValue('B1', 'NIK');
    $object->getActiveSheet()->setCellValue('C1', 'Nama');
    $object->getActiveSheet()->setCellValue('D1', 'No. Telepon');

    $baris = 2;
    $no = 1;

    foreach ($data['penduduk'] as $p) {
      $object->getActiveSheet()->setCellValue('A'.$baris, $no++);
      $object->getActiveSheet()->setCellValue('B'.$baris, $p['nik']);
      $object->getActiveSheet()->setCellValue('C'.$baris, $p['nama']);
      $object->getActiveSheet()->setCellValue('D'.$baris, $p['telp']);

      $baris++;
    }

    $filename = "Data_Penduduk".'.xlsx';

    $object->getActiveSheet()->setTitle("DATA PENDUDUK");

    header('Content-Type: application/vnd.openxmplformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');

    $writer=PHPExcel_IOFactory::createwriter($object, 'Excel2007');
    $writer->save('php://output');

    exit;
  }

  public function petugasPenduduk()
  {
    $data['penduduk'] = $this->db->get('masyarakat')->result_array();
    $data['aktif'] = 'penduduk';
    $data['petugas'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('admin')])->row_array();
    $data['judul'] = 'Halaman Data Penduduk';

      $this->load->view('templates/header', $data);
      $this->load->view('templates/petugas_sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('penduduk/petugas_penduduk', $data);
      $this->load->view('templates/footer');
  }
}
