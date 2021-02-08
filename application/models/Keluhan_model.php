<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keluhan_model extends CI_Model
{
  public function tambah($file, $penduduk)
	{
		$nik 		    = $penduduk['nik'];
		$tanggal  	= date("Y-m-d");
		$pengaduan 	= htmlspecialchars($this->input->post('isi_laporan', true));
		$status   	= 'proses';

		$data =
    [
      'tgl_pengaduan' => $tanggal,
      'nik'           => $nik,
      'isi_laporan'   => $pengaduan,
      'foto'          => $file,
      'status'        => 'proses'
    ];
		$this->db->insert('pengaduan', $data);
    $this->session->set_flashdata('pesan', 'Ditambahkan!');
    redirect('keluhan');
	}

  public function get_nik($nik)
	{
		$q = $this->db->query("SELECT * FROM masyarakat, pengaduan
								WHERE masyarakat.nik = pengaduan.nik
								AND masyarakat.nik = '$nik'
								");
		return $q;
	}

  public function getKeluhanById($id)
  {
    $q = $this->db->query("SELECT * FROM pengaduan, masyarakat
								WHERE pengaduan.nik = masyarakat.nik
								AND pengaduan.id_pengaduan = '$id' ");
		return $q->row_array();
  }

  public function hapusDataKeluhan($id)
  {
    $this->db->where('id_pengaduan', $id);
    $this->db->delete('pengaduan');
    $this->session->set_flashdata('pesan', 'Dihapus!');
    redirect('keluhan');
  }

  public function edit_proses($id, $file)
  {
    $data = [
      'isi_laporan' => $this->input->post('isi_laporan'),
      'foto' => $file
    ];

		$this->db->where('id_pengaduan', $id);
		$this->db->update('pengaduan', $data);

    $this->session->set_flashdata('pesan', 'Diubah!');
    redirect('keluhan');
  }
}
