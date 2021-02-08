<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    ceklogin_admin();
    $this->load->model('Admin_model', 'admin');
  }

  // Dashboard Admin
  public function index()
  {
    $data['judul'] = 'Sistem Infomasi Keluhan Masyarakat';
    $data['aktif'] = 'dashboard';
    $data['petugas'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('admin')])->row_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/admin_sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('admin/dashboard');
    $this->load->view('templates/footer');
  }

  // Menampilkan data admin sistem
  public function adminSistem()
  {
    $data['admin'] = $this->db->get('petugas')->result_array();
    $data['aktif'] = 'admin sistem';
    $data['petugas'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('admin')])->row_array();
    $data['judul'] = 'Halaman Data Admin Sistem';

    $this->load->view('templates/header', $data);
    $this->load->view('templates/admin_sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('admin/index', $data);
    $this->load->view('templates/footer');
  }

  public function tambah()
  {
    $data['admin'] = $this->db->get('petugas')->result_array();
    $data['petugas'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('admin')])->row_array();
    $data['level'] = $this->db->get('petugas')->result_array();
    $data['judul'] = 'Halaman Tambah Data Petugas';

    // Validasi form tambah data admin
    $this->form_validation->set_rules('nama_petugas', 'Nama Petugas', 'required|trim',
    [
      'required' => 'Kolom Nama harus diisi!',
    ]);
    $this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[5]|is_unique[petugas.username]',
    [
      'required' => 'Kolom NIK harus diisi!',
      'is_unique' => 'Username sudah terdaftar!',
      'min_length' => 'Username minimal harus terdiri dari 5 huruf!'
    ]);
    $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]|matches[password2]',
    [
      'required' => 'Kolom Password harus diisi!',
      'min_length' => 'Password minimal harus terdiri dari 3 karakter!',
      'matches' => 'Password tidak sama!'
    ]);
    $this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[3]|matches[password]',
    [
      'required' => 'Kolom Password harus diisi!',
      'min_length' => 'Password minimal harus terdiri dari 3 karakter!',
      'matches' => 'Password tidak sama!'
    ]);
    $this->form_validation->set_rules('telp', 'Telp', 'required|trim|max_length[13]',
    [
      'required' => 'Kolom No telp. harus diisi!',
      'max_length' => 'No telepon maksimal 13 karakter!'
    ]);

    if($this->form_validation->run() == false){
      $this->load->view('templates/header', $data);
      $this->load->view('templates/admin_sidebar');
      $this->load->view('templates/topbar', $data);
      $this->load->view('admin/index', $data);
      $this->load->view('templates/footer');
    }else {
      $this->admin->tambahDataAdmin();
    }
  }

  public function edit($id)
  {
    $data['admin'] = $this->db->get_where('petugas',['id_petugas' => $id])->row_array();
    $data['aktif'] = 'admin sistem';
    $data['petugas'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('admin')])->row_array();
    $data['judul'] = 'Halaman Edit Data Petugas';

    // Validasi form edit admin
    $this->form_validation->set_rules('nama_petugas', 'Nama Petugas', 'required|trim',
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
      $this->load->view('admin/edit', $data);
      $this->load->view('templates/footer');
    }else {
      $this->admin->EditDataAdmin($id);
    }
  }

  public function hapus($id)
  {
    $this->admin->hapusDataAdmin($id);
  }

  public function profil()
  {
    $data['judul'] = 'Halaman Profil Saya';
    $data['aktif'] = 'profil admin';
    $data['petugas'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('admin')])->row_array();

    // Validasi form Profil Admin
    $this->form_validation->set_rules('nama_petugas', 'Nama Petugas', 'required|trim',
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
        $this->load->view('admin/profil', $data);
        $this->load->view('templates/footer');
      }else {
        $this->admin->editProfile();
      }
  }

  public function editPassword()
  {
    $data['judul'] = 'Halaman Edit Password';
    $data['aktif'] = 'edit password admin';
    $data['petugas'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('admin')])->row_array();

    // Validasi form Edit Password Admin Admin
    $this->form_validation->set_rules('password_lama', 'Password Lama', 'required|trim',
    [
      'required' => 'Kolom Password Lama harus diisi!'
    ]);
    $this->form_validation->set_rules('password_baru1', 'Password Baru', 'required|trim|min_length[3]|matches[password_baru2]',
    [
      'required' => 'Kolom Password Baru harus diisi!',
      'min_length' => 'Password minimal terdiri dari 3 karakter',
      'matches' => 'Password tidak sama!'
    ]);
    $this->form_validation->set_rules('password_baru2', 'Konfirmasi password', 'required|trim|min_length[3]|matches[password_baru1]',
    [
      'required' => 'Kolom Password Baru harus diisi!',
      'min_length' => 'Password minimal terdiri dari 3 karakter',
      'matches' => 'Password tidak sama!'
    ]);

    if ($this->form_validation->run() == false) {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/admin_sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/edit_password');
        $this->load->view('templates/footer');
    }else {
      $lama = MD5($this->input->post('password_lama'));
      $baru = MD5($this->input->post('password_baru1'));

      // cek apakah passwordnya benar
      if ($lama == $data['petugas']['password']) {
        $this->admin->gantiPassword($baru);
      }else {
        // jika salah tampilkan pesan
        $this->session->set_flashdata('pesan',
          '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Password Salah!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>');
        redirect('admin/editPassword');
      }
    }
  }

  // Export ke Pdf
  public function pdf()
  {
    $this->load->library('dompdf_gen');
    $data['petugas'] = $this->db->get('petugas')->result_array();

    $this->load->view('admin/pdf', $data);

    $paper_size = 'A5';
    $orientation = 'landscape';
    $html = $this->output->get_output();
    $this->dompdf->set_paper($paper_size, $orientation);

    $this->dompdf->load_html($html);
    $this->dompdf->render();
    $this->dompdf->stream("laporan_pengaduan.pdf", array('Attachment' => 0));
  }

  // Export ke Excel
  public function excel()
  {
    $data['petugas'] = $this->db->get('petugas')->result_array();
    require(APPPATH. 'PHPExcel-1.8/Classes/PHPExcel.php');
    require(APPPATH. 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

    $object = new PHPExcel();

    $object->getProperties()->setCreator("Rachmat Ardico Perdana");
    $object->getProperties()->setLastModifiedBy("Rachmat Ardico Perdana");
    $object->getProperties()->setTitle("Daftar Admin Sistem");

    $object->setActiveSheetIndex(0);

    $object->getActiveSheet()->setCellValue('A1', 'No');
    $object->getActiveSheet()->setCellValue('B1', 'Nama');
    $object->getActiveSheet()->setCellValue('C1', 'No. Telepon');
    $object->getActiveSheet()->setCellValue('D1', 'Level');

    $baris = 2;
    $no = 1;

    foreach ($data['petugas'] as $p) {
      $object->getActiveSheet()->setCellValue('A'.$baris, $no++);
      $object->getActiveSheet()->setCellValue('B'.$baris, $p['nama_petugas']);
      $object->getActiveSheet()->setCellValue('C'.$baris, $p['telp']);
      $object->getActiveSheet()->setCellValue('D'.$baris, $p['level']);

      $baris++;
    }

    $filename = "Data_Admin_Sistem".'.xlsx';

    $object->getActiveSheet()->setTitle("DATA ADMIN SISTEM");

    header('Content-Type: application/vnd.openxmplformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');

    $writer=PHPExcel_IOFactory::createwriter($object, 'Excel2007');
    $writer->save('php://output');

    exit;
  }
}
