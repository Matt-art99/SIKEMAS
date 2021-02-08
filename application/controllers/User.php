<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    ceklogin();
    $this->load->model('User_model', 'user');
  }

  public function index()
  {
    $data['judul'] = 'Sistem Informasi Keluhan Masyarakat';
    $data['aktif'] = 'dashboard';
    $data['user'] = $this->db->get_where('masyarakat', ['nik' => $this->session->userdata('nik')])->row_array();

      $this->load->view('templates/header', $data);
      $this->load->view('templates/user_sidebar', $data);
      $this->load->view('templates/topbar_user', $data);
      $this->load->view('user/dashboard');
      $this->load->view('templates/footer_user');
  }

  public function profil()
  {
    $data['judul'] = 'Halaman Profil Saya';
    $data['aktif'] = 'profil user';
    $data['user'] = $this->db->get_where('masyarakat', ['username' => $this->session->userdata('username')])->row_array();

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
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/topbar_user', $data);
        $this->load->view('user/profil', $data);
        $this->load->view('templates/footer_user');
      }else {
        $this->user->editProfile();
      }
  }

  public function editPassword()
  {
    $data['judul'] = 'Halaman Edit Password';
    $data['aktif'] = 'edit password user';
    $data['user'] = $this->db->get_where('masyarakat', ['username' => $this->session->userdata('username')])->row_array();

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
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/topbar_user', $data);
        $this->load->view('user/edit_password');
        $this->load->view('templates/footer_user');
    }else {
      $lama = MD5($this->input->post('password_lama'));
      $baru = MD5($this->input->post('password_baru1'));

      if ($lama == $data['user']['password']) {
        $this->user->gantiPassword($baru);
      }else {
        $this->session->set_flashdata('pesan',
          '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Password Salah!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>');
        redirect('user/editPassword');
      }
    }
  }
}
