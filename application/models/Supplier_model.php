<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplier_model extends CI_Model
{
	public function storeSupplier()
	{
		$data = [
			'kode_supp' => $this->input->post('kode_supp'),
			'nama' => ucwords($this->input->post('nama')),
			'email' => $this->input->post('email'),
			'no_hp' => $this->input->post('no_hp'),
			'alamat' => $this->input->post('alamat'),
			'keterangan' => $this->input->post('keterangan'),
			'created_at' => date('Y-m-d h:i:s'),
			'updated_at' => date('Y-m-d h:i:s')
		];
		$this->db->insert('data_supplier', $data);
	}
	public function updateSupplier($kode_supp)
	{
		$data = [
			'nama' => ucwords($this->input->post('nama')),
			'email' => $this->input->post('email'),
			'no_hp' => $this->input->post('no_hp'),
			'alamat' => $this->input->post('alamat'),
			'keterangan' => $this->input->post('keterangan'),
			'updated_at' => date('Y-m-d h:i:s')
		];
		$this->db->where('kode_supp', $kode_supp);
		$this->db->update('data_supplier', $data);
	}
	public function getKode()
	{
		$this->db->select_max('kode_supp');
		return $this->db->get('data_supplier')->row_array();
	}
}
