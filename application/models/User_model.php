<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
  public function editProfile()
  {
    $nik = htmlspecialchars($this->input->post('nik', true));
    $username = htmlspecialchars($this->input->post('username', true));
    $nama = htmlspecialchars($this->input->post('nama', true));
    $telp = htmlspecialchars($this->input->post('telp', true));

    $this->db->set('nik', $nik);
    $this->db->set('nama', $nama);
    $this->db->set('telp', $telp);
    $this->db->where('username', $username);
    $this->db->update('masyarakat', $data);

    $this->session->set_flashdata('pesan', 'Diubah!');
    redirect('user/profil');
  }

  public function gantiPassword($baru)
  {
    $this->db->set('password', $baru);
    $this->db->where('username', $this->session->userdata('username'));
    $this->db->update('masyarakat');

    $this->session->set_flashdata('pesan',
    '<div class="alert alert-success alert-dismissible fade show" role="alert">
      Password berhasil diubah!
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>');
    redirect('user/editpassword');
  }
}
