<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer_model extends CI_Model
{
	public function storeCustomer()
	{
		$data = [
			'kode_cus' => $this->input->post('kode_cus'),
			'nama' => ucwords($this->input->post('nama')),
			'email' => $this->input->post('email'),
			'no_hp' => $this->input->post('no_hp'),
			'alamat' => $this->input->post('alamat'),
			'keterangan' => $this->input->post('keterangan'),
			'created_at' => date('Y-m-d h:i:s'),
			'updated_at' => date('Y-m-d h:i:s')
		];
		$this->db->insert('data_customer', $data);
	}
	public function updateCustomer($kode_cus)
	{
		$data = [
			'nama' => ucwords($this->input->post('nama')),
			'email' => $this->input->post('email'),
			'no_hp' => $this->input->post('no_hp'),
			'alamat' => $this->input->post('alamat'),
			'keterangan' => $this->input->post('keterangan'),
			'updated_at' => date('Y-m-d h:i:s')
		];
		$this->db->where('kode_cus', $kode_cus);
		$this->db->update('data_customer', $data);
	}
	public function getKode()
	{
		$this->db->select_max('kode_cus');
		return $this->db->get('data_customer')->row_array();
	}
}
