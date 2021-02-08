<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keluhan extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    ceklogin();
    $this->load->model('Keluhan_model', 'keluhan');
  }

  public function index()
  {
    $data['judul'] = 'Halaman Data Keluhan';
    $data['aktif'] = 'data keluhan';
    $data['user'] = $this->db->get_where('masyarakat', ['nik' => $this->session->userdata('nik')])->row_array();
    $data['keluhan'] = $this->keluhan->get_nik($data['user']['nik'])->result_array();

      $this->load->view('templates/header', $data);
      $this->load->view('templates/user_sidebar', $data);
      $this->load->view('templates/topbar_user', $data);
      $this->load->view('keluhan/index', $data);
      $this->load->view('templates/footer_user');
  }

  public function inputKeluhan()
  {
    $data['judul'] = 'Halaman Input Keluhan';
    $data['aktif'] = 'input keluhan';
    $data['user'] = $this->db->get_where('masyarakat', ['nik' => $this->session->userdata('nik')])->row_array();

    $this->form_validation->set_rules('isi_laporan', 'Isi laporan', 'required|trim',
    [
      'required' => 'Kolom keluhan tidak boleh kosong!'
    ]);

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/user_sidebar', $data);
      $this->load->view('templates/topbar_user', $data);
      $this->load->view('keluhan/input_keluhan', $data);
      $this->load->view('templates/footer_user');
    }else {
      $this->tambahAksi();
    }
  }

  public function tambahAksi()
  {
    $config['upload_path']          = './assets/img/keluhan/';
    $config['allowed_types']        = 'gif|jpg|png';
    $config['max_size']             = 2048;
    $config['max_width']            = 1500;
    $config['max_height']           = 728;

    $this->load->library('upload', $config);
    $penduduk = $this->db->get_where('masyarakat', ['nik' => $this->session->userdata('nik')])->row_array();

    if ( !$this->upload->do_upload('foto')){
      $this->session->set_flashdata('pesan',
        '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          Keluhan harus disertai gambar!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>');
      redirect('keluhan/inputKeluhan');
    }else {
      $gambar = $this->upload->data();
      $this->keluhan->tambah($gambar['file_name'], $penduduk);
    }
  }

  public function detail($id)
  {
    $data['judul'] = 'Halaman Detail Data Keluhan';
    $data['aktif'] = 'data keluhan';
    $data['user'] = $this->db->get_where('masyarakat', ['nik' => $this->session->userdata('nik')])->row_array();
    $data['keluhan'] = $this->keluhan->getKeluhanById($id);

      $this->load->view('templates/header', $data);
      $this->load->view('templates/user_sidebar', $data);
      $this->load->view('templates/topbar_user', $data);
      $this->load->view('keluhan/detail', $data);
      $this->load->view('templates/footer_user');
  }

  public function hapus($id)
  {
    $this->keluhan->hapusDataKeluhan($id);
  }

  public function edit($id)
  {
    $data['judul'] = 'Halaman Edit Data Keluhan';
    $data['aktif'] = 'data keluhan';
    $data['user'] = $this->db->get_where('masyarakat', ['nik' => $this->session->userdata('nik')])->row_array();
    $data['keluhan'] = $this->keluhan->getKeluhanById($id);

    $this->form_validation->set_rules('isi_laporan', 'Isi laporan', 'required|trim',
    [
      'required' => 'Kolom keluhan tidak boleh kosong!'
    ]);
    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/user_sidebar', $data);
      $this->load->view('templates/topbar_user', $data);
      $this->load->view('keluhan/edit', $data);
      $this->load->view('templates/footer_user');
    }else {
      if ($_FILES["foto"]["name"] == "") {
                $foto_lama = $this->input->post('foto_lama');
                $this->keluhan->edit_proses($id, $foto_lama);
                $this->session->set_flashdata('pesan',
                  '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data keluhan berhasil diubah!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                  </div>');
                redirect('keluhan');
      } else {
          //setting config untuk library upload
          $config['upload_path']          = './assets/img/keluhan/';
          $config['allowed_types']        = 'gif|jpg|png';
          $config['max_size']             = 2048;
          $config['max_width']            = 1500;
          $config['max_height']           = 728;

          //pemanggilan librabry upload
          $this->load->library('upload', $config);

          //jika upload gagal
          if ( ! $this->upload->do_upload('foto'))
          {
            redirect('keluhan/edit');
              //jika upload berhasil
          }else{
              $foto_lama = $this->input->post('foto_lama');
              $q = $this->db->get_where('pengaduan', ['foto' => $foto_lama])->row_array();
              $f = './assets/img/keluhan/'.$q;
              unlink($f);

              $gambar = $this->upload->data();
              $file   = $gambar['file_name'];
              $this->keluhan->edit_proses($id, $file);
          }
      }
    }
  }
}
