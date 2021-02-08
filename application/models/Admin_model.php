<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model
{
  public function tambahDataAdmin()
  {
    $data =
    [
      'nama_petugas' => htmlspecialchars($this->input->post('nama_petugas', true)),
      'username' => htmlspecialchars($this->input->post('username', true)),
      'password' => MD5($this->input->post('password', true)),
      'telp' => htmlspecialchars($this->input->post('telp', true)),
      'level' => $this->input->post('level', true)
    ];

    $this->db->insert('petugas', $data);
    
    $this->session->set_flashdata('pesan',
      '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data Admin berhasil ditambahkan!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>');
    redirect('admin/adminSistem');
  }

  public function EditDataAdmin($id)
  {
    $data =
    [
      'username' => htmlspecialchars($this->input->post('username', true)),
      'nama_petugas' => htmlspecialchars($this->input->post('nama_petugas', true)),
      'telp' => htmlspecialchars($this->input->post('telp', true))
    ];


    $this->db->where('id_petugas', $id);
    $this->db->update('petugas', $data);

    $this->session->set_flashdata('pesan',
      '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data Admin berhasil diubah!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>');
    redirect('admin/adminSistem');
  }

  public function hapusDataAdmin($id)
  {
    $this->db->where('id_petugas', $id);
    $this->db->delete('petugas');

    $this->session->set_flashdata('pesan',
      '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data Admin berhasil dihapus!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>');
    redirect('admin/adminSistem');
  }

  public function editProfile()
  {
    $username = htmlspecialchars($this->input->post('username', true));
    $nama = htmlspecialchars($this->input->post('nama_petugas', true));
    $telp = htmlspecialchars($this->input->post('telp', true));

    $this->db->set('nama_petugas', $nama);
    $this->db->set('telp', $telp);
    $this->db->where('username', $username);
    $this->db->update('petugas', $data);

    $this->session->set_flashdata('pesan',
      '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Profil anda berhasil diubah!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>');
    redirect('admin/profil');
  }

  public function gantiPassword($baru)
  {
    $this->db->set('password', $baru);
    $this->db->where('username', $this->session->userdata('username'));
    $this->db->update('petugas');

    $this->session->set_flashdata('pesan',
    '<div class="alert alert-success alert-dismissible fade show" role="alert">
      Password berhasil diubah!
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>');
    redirect('admin/editpassword');
  }
}
