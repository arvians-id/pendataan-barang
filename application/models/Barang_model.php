<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_model extends CI_Model
{
	public function storeBarang()
	{
		$data = [
			'kode_brg' => $this->input->post('kode_brg'),
			'nama' => $this->input->post('nama'),
			'jenis' => $this->input->post('jenis'),
			'id_satuan' => $this->input->post('id_satuan'),
			'keterangan' => $this->input->post('keterangan'),
			'created_at' => date('Y-m-d h:i:s'),
			'updated_at' => date('Y-m-d h:i:s')
		];
		$this->db->insert('data_barang', $data);
	}
	public function updateBarang($id)
	{
		$data = [
			'nama' => $this->input->post('nama'),
			'jenis' => $this->input->post('jenis'),
			'id_satuan' => $this->input->post('id_satuan'),
			'keterangan' => $this->input->post('keterangan'),
			'updated_at' => date('Y-m-d h:i:s')
		];
		$this->db->where('id_brg', $id);
		$this->db->update('data_barang', $data);
	}
	public function getKode()
	{
		$this->db->select_max('kode_brg');
		return $this->db->get('data_barang')->row_array();
	}
	public function getBarang()
	{
		$this->db->select('*');
		$this->db->from('data_barang');
		$this->db->join('data_satuan', 'data_barang.id_satuan = data_satuan.id_satuan');

		return $this->db->get()->result_array();
	}
}
