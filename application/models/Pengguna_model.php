<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna_model extends CI_Model
{
	public function storePengguna()
	{
		$data = [
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('password')),
			'created_at' => date('Y-m-d h:i:s'),
			'updated_at' => date('Y-m-d h:i:s')
		];
		$this->db->insert('pengguna', $data);
	}
}
