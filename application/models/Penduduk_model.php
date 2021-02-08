<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penduduk_model extends CI_Model
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
    redirect('penduduk');
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
    redirect('penduduk');
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
    redirect('penduduk');
  }
}
