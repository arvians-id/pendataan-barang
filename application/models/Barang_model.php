<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_model extends CI_Model
{
	public function storeBarang()
	{
		$upload_img = $_FILES['photo']['name']; // Ambil photo dengan nama input photo
		if ($upload_img) { // Jika ada photonya
			$config['upload_path']          = './assets/img-barang';
			$config['allowed_types']        = 'jpg|png|jpeg';

			$this->load->library('upload', $config);
			if ($this->upload->do_upload('photo')) {
				$photo_baru = $this->upload->data('file_name', 'photo'); // Insert photo ke database
			}
		} else { // Jika tida ada photonya
			$photo_baru =  'default.png'; // Maka gunakan saja photo default
		}
		$data = [
			'kode_brg' => $this->input->post('kode_brg'),
			'nama' => ucwords($this->input->post('nama')),
			'jenis' => ucwords($this->input->post('jenis')),
			'id_satuan' => $this->input->post('id_satuan'),
			'keterangan' => $this->input->post('keterangan'),
			'photo' => $photo_baru,
			'created_at' => date('Y-m-d h:i:s'),
			'updated_at' => date('Y-m-d h:i:s')
		];
		$this->db->insert('data_barang', $data);
	}
	public function updateBarang($kode_brg)
	{
		$barang = $this->db->get_where('data_barang', ['kode_brg' => $kode_brg])->row_array();
		$upload_img = $_FILES['photo']['name']; // Ambil photo dengan nama input photo
		if ($upload_img) { // Jika ada photonya
			$config['upload_path']          = './assets/img-barang';
			$config['allowed_types']        = 'jpg|png|jpeg';

			$this->load->library('upload', $config);
			if ($this->upload->do_upload('photo')) {
				$foto_lama = $barang['photo']; // Ambil nama file mobil yang ada di database
				$path = './assets/img-barang/' . $foto_lama;
				if ($foto_lama != 'default.png' && file_exists($path)) { // Jika nama file di didatabase bukan default .png
					unlink($path); // Maka Hapus photonya
				}
				$photo_baru = $this->upload->data('file_name', 'photo'); // Insert photo ke database
			}
		} else { // Jika tida ada photonya
			$photo_baru =  $barang['photo']; // Maka gunakan saja photo default
		}
		$data = [
			'nama' => ucwords($this->input->post('nama')),
			'jenis' => ucwords($this->input->post('jenis')),
			'id_satuan' => $this->input->post('id_satuan'),
			'keterangan' => $this->input->post('keterangan'),
			'photo' => $photo_baru,
			'updated_at' => date('Y-m-d h:i:s')
		];
		$this->db->where('kode_brg', $kode_brg);
		$this->db->update('data_barang', $data);
	}
	public function getKode()
	{
		$this->db->select_max('kode_brg');
		return $this->db->get('data_barang')->row_array();
	}
	public function getKodeBarangMasuk()
	{
		$this->db->select_max('kode_brg_msk');
		return $this->db->get('data_barang_masuk')->row_array();
	}
	public function getKodeBarangKeluar()
	{
		$this->db->select_max('kode_brg_klr');
		return $this->db->get('data_barang_keluar')->row_array();
	}
	public function getBarang($kode_brg = null)
	{
		$this->db->select('*');
		$this->db->from('data_barang');
		$this->db->join('data_satuan', 'data_barang.id_satuan = data_satuan.id_satuan');
		if ($kode_brg != null) {
			$this->db->where('kode_brg', $kode_brg);
		}
		return $this->db->get();
	}
	public function getBarangMasuk($kode_brg_msk = null)
	{
		$this->db->select('*, d.nama as nama_supplier, b.nama as nama_barang, a.created_at as tgl_dbm, a.keterangan as keterangan_masuk');
		$this->db->from('data_barang_masuk a');
		$this->db->join('data_barang b', 'a.kode_brg = b.kode_brg');
		$this->db->join('data_satuan c', 'b.id_satuan = c.id_satuan');
		$this->db->join('data_supplier d', 'a.kode_supp = d.kode_supp');
		if ($kode_brg_msk != null) {
			$this->db->where('kode_brg_msk', $kode_brg_msk);
		}
		$this->db->order_by('a.created_at', 'desc');
		return $this->db->get();
	}
	public function getBarangKeluar($kode_brg_klr = null)
	{
		$this->db->select('*, d.nama as nama_customer, b.nama as nama_barang, a.created_at as tgl_dbk, a.keterangan as keterangan_keluar');
		$this->db->from('data_barang_keluar a');
		$this->db->join('data_barang b', 'a.kode_brg = b.kode_brg');
		$this->db->join('data_satuan c', 'b.id_satuan = c.id_satuan');
		$this->db->join('data_customer d', 'a.kode_cus = d.kode_cus');
		if ($kode_brg_klr != null) {
			$this->db->where('kode_brg_klr', $kode_brg_klr);
		}
		$this->db->order_by('a.created_at', 'desc');
		return $this->db->get();
	}
	public function storeBarangMasuk()
	{
		// Insert transaksi
		$kode_brg = $this->input->post('kode_brg');
		$data_barangMasuk = [
			'kode_brg_msk' => $this->input->post('kode_brg_msk'),
			'kode_brg' => $kode_brg,
			'kode_supp' => $this->input->post('kode_supp'),
			'jml_masuk' => $this->input->post('jml_masuk'),
			'tgl_masuk' => $this->input->post('tgl_masuk'),
			'keterangan' => $this->input->post('keterangan'),
			'created_at' => date('Y-m-d h:i:s'),
			'updated_at' => date('Y-m-d h:i:s')
		];
		$this->db->insert('data_barang_masuk', $data_barangMasuk);

		// Update stok barang
		$data_barang = [
			'total_stok' => $this->input->post('total_stok'),
		];
		$this->db->where('kode_brg', $kode_brg);
		$this->db->update('data_barang', $data_barang);
	}
	public function storeBarangKeluar()
	{
		// Insert transaksi
		$kode_brg = $this->input->post('kode_brg');
		$data_barangMasuk = [
			'kode_brg_klr' => $this->input->post('kode_brg_klr'),
			'kode_brg' => $kode_brg,
			'kode_cus' => $this->input->post('kode_cus'),
			'jml_keluar' => $this->input->post('jml_keluar'),
			'tgl_keluar' => $this->input->post('tgl_keluar'),
			'keterangan' => $this->input->post('keterangan'),
			'created_at' => date('Y-m-d h:i:s'),
			'updated_at' => date('Y-m-d h:i:s')
		];
		$this->db->insert('data_barang_keluar', $data_barangMasuk);

		// Update stok barang
		$data_barang = [
			'total_stok' => $this->input->post('total_stok'),
		];
		$this->db->where('kode_brg', $kode_brg);
		$this->db->update('data_barang', $data_barang);
	}
	public function updateBarangMasuk()
	{
		// Update transaksi
		$kode_brg_msk = $this->input->post('kode_brg_msk');
		$data_barangMasuk = [
			'tgl_masuk' => $this->input->post('tgl_masuk'),
			'keterangan' => $this->input->post('keterangan'),
			'updated_at' => date('Y-m-d h:i:s')
		];
		$this->db->where('kode_brg_msk', $kode_brg_msk);
		$this->db->update('data_barang_masuk', $data_barangMasuk);
	}
	public function updateBarangKeluar()
	{
		// Update transaksi
		$kode_brg_klr = $this->input->post('kode_brg_klr');
		$data_barangKeluar = [
			'tgl_keluar' => $this->input->post('tgl_keluar'),
			'keterangan' => $this->input->post('keterangan'),
			'updated_at' => date('Y-m-d h:i:s')
		];
		$this->db->where('kode_brg_klr', $kode_brg_klr);
		$this->db->update('data_barang_keluar', $data_barangKeluar);
	}
	public function deleteBarangMasuk($kode_brg_msk)
	{
		$barang_masuk = $this->db->get_where('data_barang_masuk', ['kode_brg_msk' => $kode_brg_msk])->row_array();
		// Update stok barang
		$this->db->set('total_stok', 'total_stok-' . $barang_masuk['jml_masuk'], false);
		$this->db->where('kode_brg', $barang_masuk['kode_brg']);
		$this->db->update('data_barang');

		// Delete barang masuk
		$this->db->where('kode_brg_msk', $kode_brg_msk);
		$this->db->delete('data_barang_masuk');
	}
	public function deleteBarangKeluar($kode_brg_klr)
	{
		$barang_masuk = $this->db->get_where('data_barang_keluar', ['kode_brg_klr' => $kode_brg_klr])->row_array();
		// Update stok barang
		$this->db->set('total_stok', 'total_stok+' . $barang_masuk['jml_keluar'], false);
		$this->db->where('kode_brg', $barang_masuk['kode_brg']);
		$this->db->update('data_barang');

		// Delete barang masuk
		$this->db->where('kode_brg_klr', $kode_brg_klr);
		$this->db->delete('data_barang_keluar');
	}
	public function laporanBarangMasuk($awal, $akhir)
	{
		$this->db->select('*, d.nama as nama_supplier, b.nama as nama_barang, a.created_at as tgl_dbm, a.keterangan as keterangan_masuk');
		$this->db->from('data_barang_masuk a');
		$this->db->join('data_barang b', 'a.kode_brg = b.kode_brg');
		$this->db->join('data_satuan c', 'b.id_satuan = c.id_satuan');
		$this->db->join('data_supplier d', 'a.kode_supp = d.kode_supp');
		$this->db->where("DATE(a.created_at) >=", $awal); // Beri kondisi dimana tanggal transaksi lebih dari tanggal di parameter $awal
		$this->db->where("DATE(a.created_at) <=", $akhir); // Beri kondisi dimana tanggal transaksi kurang dari tanggal di parameter $akhir
		return $this->db->get()->result_array(); // tampilkan semua data
	}
	public function laporanBarangKeluar($awal, $akhir)
	{
		$this->db->select('*, d.nama as nama_customer, b.nama as nama_barang, a.created_at as tgl_dbk, a.keterangan as keterangan_keluar');
		$this->db->from('data_barang_keluar a');
		$this->db->join('data_barang b', 'a.kode_brg = b.kode_brg');
		$this->db->join('data_satuan c', 'b.id_satuan = c.id_satuan');
		$this->db->join('data_customer d', 'a.kode_cus = d.kode_cus');
		$this->db->where("DATE(a.created_at) >=", $awal); // Beri kondisi dimana tanggal transaksi lebih dari tanggal di parameter $awal
		$this->db->where("DATE(a.created_at) <=", $akhir); // Beri kondisi dimana tanggal transaksi kurang dari tanggal di parameter $akhir
		return $this->db->get()->result_array(); // tampilkan semua data
	}
}
