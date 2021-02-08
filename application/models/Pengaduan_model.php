<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaduan_model extends CI_Model
{
  public function getAllDataPengaduan()
  {
    $q = $this->db->query("SELECT * FROM masyarakat, pengaduan
								WHERE masyarakat.nik = pengaduan.nik
								");
		return $q;
  }
}
