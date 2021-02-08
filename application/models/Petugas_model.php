<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Petugas_model extends CI_Model
{
  public function getPendudukByNik($nik)
  {
    return $this->db->get_where('masyarakat', ['nik' => $nik])->row_array();
  }

  public function tambahDataPenduduk()
  {
    $data =
    [
      'nik' => htmlspecialchars($this->input->post('nik'), true),
      'nama' => htmlspecialchars($this->input->post('nama'), true),
      'telp' => htmlspecialchars($this->input->post('telp'), true)
    ];

    $this->db->insert('masyarakat', $data);

    $this->session->set_flashdata('pesan',
      '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data penduduk berhasil ditambahkan!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>');
    redirect('petugas/dataPenduduk');
  }

  public function editDataPenduduk($nik)
  {
    $data =
    [
      'nik' => htmlspecialchars($this->input->post('nik'), true),
      'nama' => htmlspecialchars($this->input->post('nama'), true),
      'telp' => htmlspecialchars($this->input->post('telp'), true)
    ];

    $this->db->where('nik', $nik);
    $this->db->update('masyarakat', $data);

    $this->session->set_flashdata('pesan',
      '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data penduduk berhasil diubah!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>');
    redirect('petugas/dataPenduduk');
  }

  public function hapusDataPenduduk($nik)
  {
    $this->db->where('nik', $nik);
    $this->db->delete('masyarakat');

    $this->session->set_flashdata('pesan',
      '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data penduduk berhasil dihapus!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>');
    redirect('petugas/dataPenduduk');
  }

  public function tambahDataAdminSistem()
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
    redirect('petugas/adminSistem');
  }

  public function editDataAdminSistem($id)
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
    redirect('petugas/adminSistem');
  }

  public function hapusDataAdminSistem($id)
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
    redirect('petugas/adminSistem');
  }

  public function editProfilePetugas()
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
    redirect('petugas/profil');
  }

  public function gantiPassword($baru)
  {
    $this->db->set('password', $baru);
    $this->db->where('username', $this->session->userdata('petugas'));
    $this->db->update('petugas');

    $this->session->set_flashdata('pesan',
    '<div class="alert alert-success alert-dismissible fade show" role="alert">
      Password berhasil diubah!
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>');
    redirect('petugas/editpassword');
  }
}
