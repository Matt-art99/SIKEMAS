<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model
{
  public function cek_user($username, $password)
	{
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		return $this->db->get('masyarakat');
	}

  public function cek_admin($username, $password)
	{
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		return $this->db->get('petugas');
	}

  public function cek_nik($nik)
  {
    $this->db->where('nik', $nik);
    return $this->db->get('masyarakat');
  }

  public function register($nik)
  {
    $data =
    [
      'username' => htmlspecialchars($this->input->post('username', true)),
      'password' => MD5($this->input->post('password1'))
    ];

		$this->db->where('nik', $nik);
		$this->db->update('masyarakat', $data);

    $this->session->set_flashdata('pesan',
      '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Akun anda telah dibuat, silahkan Login!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>');
    redirect('auth');
  }
}
