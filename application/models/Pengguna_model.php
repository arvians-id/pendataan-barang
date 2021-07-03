<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna_model extends CI_Model
{
	public function storePengguna()
	{
		$data = [
			'nama' => ucwords($this->input->post('nama')),
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('password')),
			'email' => $this->input->post('email'),
			'no_hp' => $this->input->post('no_hp'),
			'created_at' => date('Y-m-d h:i:s'),
			'updated_at' => date('Y-m-d h:i:s')
		];
		$this->db->insert('pengguna', $data);
	}
}
