<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Petugas extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Pengaduan_model', 'pengaduan');
    $this->load->model('Keluhan_model', 'keluhan');
    $this->load->model('Petugas_model', 'petugas');
    ceklogin_petugas();
  }

  public function index()
  {
    $data['judul'] = 'Sistem Infomasi Keluhan Masyarakat';
    $data['aktif'] = 'dashboard';
    $data['petugas'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('petugas')])->row_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/petugas_sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('petugas/dashboard');
    $this->load->view('templates/footer');
  }

  public function pengaduan()
  {
    $data['judul'] = 'Halaman Data Keluhan';
    $data['aktif'] = 'pengaduan';
    $data['petugas'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('petugas')])->row_array();
    $data['pengaduan'] = $this->pengaduan->getAllDataPengaduan()->result_array();

      $this->load->view('templates/header', $data);
      $this->load->view('templates/petugas_sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('petugas/pengaduan/pengaduan', $data);
      $this->load->view('templates/footer');
  }

  public function detailPengaduan($id)
  {
    $data['judul'] = 'Halaman Detail Data Pengaduan';
    $data['aktif'] = 'pengaduan';
    $data['petugas'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('petugas')])->row_array();
    $data['keluhan'] = $this->keluhan->getKeluhanById($id);

      $this->load->view('templates/header', $data);
      $this->load->view('templates/petugas_sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('petugas/pengaduan/detailPengaduan', $data);
      $this->load->view('templates/footer');
  }

  public function ubahPengaduan($id)
  {
    $keluhan = $this->keluhan->getKeluhanById($id);
    $proses = 'proses';
    $selesai = 'selesai';

      if ($keluhan['status'] == 'proses') {
        $this->db->set('status', $selesai);
        $this->db->where('id_pengaduan', $id);
        $this->db->update('pengaduan');
        redirect('petugas/pengaduan/pengaduan');
      }else {
        $this->db->set('status', $proses);
        $this->db->where('id_pengaduan', $id);
        $this->db->update('pengaduan');
        redirect('petugas/pengaduan/pengaduan');
      }
  }

  public function dataPenduduk()
  {
    $data['penduduk'] = $this->db->get('masyarakat')->result_array();
    $data['aktif'] = 'penduduk';
    $data['petugas'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('petugas')])->row_array();
    $data['judul'] = 'Halaman Data Penduduk';

      $this->load->view('templates/header', $data);
      $this->load->view('templates/petugas_sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('petugas/penduduk/dataPenduduk', $data);
      $this->load->view('templates/footer');
  }

  public function tambahDataPenduduk()
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
      $this->load->view('templates/petugas_sidebar');
      $this->load->view('templates/topbar');
      $this->load->view('petugas/penduduk/dataPenduduk', $data);
      $this->load->view('templates/footer');
    }else {
      $this->petugas->tambahDataPenduduk();
    }
  }

  public function editDataPenduduk($nik)
  {
    $data['masyarakat'] = $this->petugas->getPendudukByNik($nik);
    $data['aktif'] = 'penduduk';
    $data['petugas'] = $this->db->get_where('petugas', ['level' => $this->session->userdata('admin')])->row_array();
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
      $this->load->view('templates/petugas_sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('petugas/penduduk/editDataPenduduk', $data);
      $this->load->view('templates/footer');
    }else {
      $this->petugas->editDataPenduduk($nik);
    }
  }

  public function hapusDataPenduduk($nik)
  {
    $this->petugas->hapusDataPenduduk($nik);
  }

  public function adminSistem()
  {
    $data['admin'] = $this->db->get('petugas')->result_array();
    $data['aktif'] = 'admin sistem';
    $data['petugas'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('petugas')])->row_array();
    $data['judul'] = 'Halaman Data Admin Sistem';

    $this->load->view('templates/header', $data);
    $this->load->view('templates/petugas_sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('petugas/admin/adminSistem', $data);
    $this->load->view('templates/footer');;
  }

  public function tambahDataAdmin()
  {
    $data['admin'] = $this->db->get('petugas')->result_array();
    $data['petugas'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('petugas')])->row_array();
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
      $this->load->view('templates/petugas_sidebar');
      $this->load->view('templates/topbar', $data);
      $this->load->view('petugas/admin/adminSistem', $data);
      $this->load->view('templates/footer');
    }else {
      $this->petugas->tambahDataAdminSistem();
    }
  }

  public function editDataAdmin($id)
  {
    $data['admin'] = $this->db->get_where('petugas',['id_petugas' => $id])->row_array();
    $data['aktif'] = 'admin sistem';
    $data['petugas'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('petugas')])->row_array();
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
      $this->load->view('templates/petugas_sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('petugas/admin/EditDataAdmin', $data);
      $this->load->view('templates/footer');
    }else {
      $this->petugas->editDataAdminSistem($id);
    }
  }

  public function hapusDataAdmin($id)
  {
    $this->petugas->hapusDataAdminSistem($id);
  }

  public function profil()
  {
    $data['judul'] = 'Halaman Profil Saya';
    $data['aktif'] = 'profil admin';
    $data['petugas'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('petugas')])->row_array();

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
        $this->load->view('templates/petugas_sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('petugas/profil', $data);
        $this->load->view('templates/footer');
      }else {
        $this->petugas->editProfilePetugas();
      }
  }

  public function editPassword()
  {
    $data['judul'] = 'Halaman Edit Password';
    $data['aktif'] = 'edit password admin';
    $data['petugas'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('petugas')])->row_array();

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
        $this->load->view('templates/petugas_sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('petugas/editPassword');
        $this->load->view('templates/footer');
    }else {
      $lama = MD5($this->input->post('password_lama'));
      $baru = MD5($this->input->post('password_baru1'));

      // cek apakah passwordnya benar
      if ($lama == $data['petugas']['password']) {
        $this->petugas->gantiPassword($baru);
      }else {
        // jika salah tampilkan pesan
        $this->session->set_flashdata('pesan',
          '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Password Salah!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>');
        redirect('petugas/editPassword');
      }
    }
  }
}
