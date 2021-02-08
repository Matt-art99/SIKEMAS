<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Auth_model', 'auth');
  }

  // Login User
  public function index()
  {

    if ($this->session->userdata('admin')) {
      redirect('admin');
    }elseif ($this->session->userdata('nik')) {
      redirect('user');
    }elseif ($this->session->userdata('petugas')) {
      redirect('petugas');
    }

    // Validasi form login user
    $this->form_validation->set_rules('username', 'Username', 'required|trim',
    [
      'required' => 'Kolom Username harus diisi!'
    ]);
    $this->form_validation->set_rules('password', 'Password', 'required|trim',
    [
      'required' => 'Kolom password harus diisi!',
    ]);

    if ($this->form_validation->run() == false) {
      $data['judul'] =  'Halaman Login';
      $this->load->view('templates/Auth_header', $data);
      $this->load->view('auth/login');
      $this->load->view('templates/Auth_footer');
    }else {

      $username =  $this->input->post('username');
      $password =  MD5($this->input->post('password'));

      // Cek apakah user ada
      $cek      =  $this->auth->cek_user($username, $password);
      $user     =  $this->db->get_where('masyarakat', ['username' => $username])->row_array();

      // jika ada
      if ($cek->num_rows() > 0) {
        // siapkan data di dalam session cukup nik dan username saja
        $data =
        [
          'nik' => $user['nik'],
          'username' => $user['username']
        ];
        $this->session->set_userdata($data);
        redirect('user');
      // Jika tidak ada user nya tampilkan pesan
      }else {
        $this->session->set_flashdata('pesan',
          '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Username / Password tidak sesuai!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>');
      redirect('auth');
      }


    }

  }


  public function registrasi()
  {
    if ($this->session->userdata('admin')) {
      redirect('admin');
    }elseif ($this->session->userdata('nik')) {
      redirect('user');
    }elseif ($this->session->userdata('petugas')) {
      redirect('petugas');
    }

    // validasi form registrasi
    $this->form_validation->set_rules('nik', 'NIK', 'required|trim|numeric|min_length[16]',
    [
      'required' => 'Kolom NIK harus diisi!',
      'numeric' => 'NIK hanya terdiri dari angka!',
      'min_length' => 'NIK Minimal 16 angka!'
    ]);
    $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[masyarakat.username]',
    [
      'required' => 'Kolom Username harus diisi!',
      'is_unique' => 'Username telah terdaftar!'
    ]);
    $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]',
    [
      'required' => 'Kolom password harus diisi!',
      'matches' => 'Password tidak sama!',
      'min_length' => 'Password terlalu pendek!'
    ]);
    $this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[3]|matches[password1]',
    [
      'required' => 'Kolom password harus diisi!',
      'matches' => 'Password tidak sama!',
      'min_length' => 'Password terlalu pendek!'
    ]);

    if ($this->form_validation->run() == false) {
      $data['judul'] = 'Halaman Registrasi';
      $this->load->view('templates/auth_header', $data);
      $this->load->view('auth/registrasi');
      $this->load->view('templates/auth_footer');
    }else {
      $nik = $this->input->post('nik');
      // cek apakah nik sudah terdaftar
      $cek_nik = $this->auth->cek_nik($nik)->num_rows();

      if ($cek_nik < 1) {
        $this->session->set_flashdata('pesan',
          '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            NIK tidak valid!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>');
        redirect('auth/registrasi');
      }else {
        $this->auth->register($nik);
      }

    }
  }

  // login admin
  public function admin()
  {
    if ($this->session->userdata('admin')) {
      redirect('admin');
    }elseif ($this->session->userdata('nik')) {
      redirect('user');
    }elseif ($this->session->userdata('petugas')) {
      redirect('petugas');
    }

    // Validasi form login admin
    $this->form_validation->set_rules('username', 'Username', 'required|trim',
    [
      'required' => 'Kolom Username harus diisi!'
    ]);
    $this->form_validation->set_rules('password', 'Password', 'required|trim',
    [
      'required' => 'Kolom password harus diisi!',
    ]);

    if ($this->form_validation->run() == false) {
      $data['judul'] =  'Halaman Login Admin';
      $this->load->view('templates/Auth_header', $data);
      $this->load->view('auth/admin_login');
      $this->load->view('templates/Auth_footer');
    }else {
      $username = $this->input->post('username');
      $password = MD5($this->input->post('password'));

      // cek apakah usernya ada
      $cek      =  $this->auth->cek_admin($username, $password);
      $petugas  =  $this->db->get_where('petugas', ['username' => $username])->row_array();

        // jika ada
        if ($cek->num_rows() > 0) {
          if ($petugas['level'] == 'Admin') {
            // siapkan data didalam session cukup username dan levelnya saja
            $data =
            [
              'admin' => $petugas['username']
            ];
            $this->session->set_userdata($data);
              redirect('admin');
          }elseif ($petugas['level'] == 'Petugas'){
            $data =
            [
              'petugas' => $petugas['username']
            ];
            $this->session->set_userdata($data);
              redirect('petugas');
          }
        }else {
          // jika tidak ada tampilkan pesan
          $this->session->set_flashdata('pesan',
            '<div class="alert alert-danger alert-dismissible fade show" role="alert">
              Username / Password tidak sesuai!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
            </div>');
        redirect('auth/admin');
        }
    }
  }

  public function admin_logout()
  {
    $this->session->unset_userdata('petugas');
    $this->session->unset_userdata('admin');

    $this->session->set_flashdata('pesan', 'Logout!');
    redirect('auth');
  }

  public function logout()
  {
    $this->session->unset_userdata('nik');
    $this->session->unset_userdata('username');

    $this->session->set_flashdata('pesan', 'Logout!');
    redirect('auth');
  }
}
