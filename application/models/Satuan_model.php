<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Satuan_model extends CI_Model
{
	public function storeSatuan()
	{
		$data = [
			'satuan' => $this->input->post('satuan'),
			'created_at' => date('Y-m-d h:i:s'),
			'updated_at' => date('Y-m-d h:i:s')
		];
		$this->db->insert('data_satuan', $data);
	}
	public function updateSatuan($id)
	{
		$data = [
			'satuan' => $this->input->post('satuan'),
			'updated_at' => date('Y-m-d h:i:s')
		];
		$this->db->where('id_satuan', $id);
		$this->db->update('data_satuan', $data);
	}
}
