<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	const JAM = (60 * 60 * 24);
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Satuan_model', 'satuan_m');
		$this->load->model('Supplier_model', 'supplier_m');
		$this->load->model('Barang_model', 'barang_m');
		$this->load->model('Pengguna_model', 'pengguna_m');
		is_logged_not_in(); // Jika sudah login, lalu mengakses halaman login maka tidak akan bisa dan akan d alihkan ke halaman admin
	}
	public function index()
	{
		$data = [
			'judul' => 'Admin | Home',
			'viewUtama' => 'admin/contents/index',
			'cekUser' => $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array(), // cek user yang login berdasarkan session username,
			'countSatuan' => $this->db->get('data_satuan')->num_rows(),
			'countSupplier' => $this->db->get('data_supplier')->num_rows(),
			'countBarang' => $this->db->get('data_barang')->num_rows(),
			'countPengguna' => $this->db->get('pengguna')->num_rows(),
		];
		$this->load->view('admin/layouts/wrapperIndex', $data);
	}
	public function satuan()
	{
		// Parameter pertama untuk name input, Parameter kedua bebas, Parameter ketiga aturan input
		$this->form_validation->set_rules('satuan', 'Satuan', 'required|trim|max_length[50]|is_unique[data_satuan.satuan]');

		// Jika validasi gagal, akan muncul error di input dan kembali ke halaman satuan
		if ($this->form_validation->run() == FALSE) {
			$data = [
				'judul' => 'Admin',
				'viewUtama' => 'admin/contents/satuan',
				'cekUser' => $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array(),
				'satuans' => $this->db->get('data_satuan')->result_array() // mengTampilkan semua data di table satuan
			];
			$this->load->view('admin/layouts/wrapperForm', $data);
			// Jika validasi tidak gagal
		} else {
			$this->satuan_m->storeSatuan(); // Insert data satuan
			$this->session->set_flashdata('success', 'Data berhasil dibuat.'); // Membuat pesan notif jika insert data berhasil
			redirect('admin/satuan'); // redirect ke halaman satuan
		}
	}
	public function update_satuan($id)
	{
		// Parameter pertama untuk name input, Parameter kedua bebas, Parameter ketiga aturan input
		$this->form_validation->set_rules('satuan', 'Satuan', 'required|trim|max_length[50]|is_unique[data_satuan.satuan]');

		// Jika validasi gagal, akan muncul error di input dan kembali ke halaman satuan
		if ($this->form_validation->run() == FALSE) {
			$data = [
				'judul' => 'Admin',
				'viewUtama' => 'admin/contents/update_satuan',
				'cekUser' => $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array(),
				'satuan' => $this->db->get_where('data_satuan', ['id_satuan' => $id])->row_array() // mengTampilkan semua data di table satuan
			];
			$this->load->view('admin/layouts/wrapperForm', $data);
			// Jika validasi tidak gagal
		} else {
			$this->satuan_m->updateSatuan($id); // Update data satuan
			$this->session->set_flashdata('success', 'Data berhasil diubah.'); // Membuat pesan notif jika update data berhasil
			redirect('admin/satuan'); // redirect ke halaman satuan
		}
	}
	public function supplier()
	{
		// Parameter pertama untuk name input, Parameter kedua bebas, Parameter ketiga aturan input
		$this->form_validation->set_rules('kode_supp', 'Kode Supplier', 'required|trim|is_unique[data_supplier.kode_supp]');
		$this->form_validation->set_rules('nama', 'Nama', 'required|max_length[50]');
		$this->form_validation->set_rules('email', 'Email', 'valid_email|max_length[50]');
		$this->form_validation->set_rules('no_hp', 'No Handphone', 'required|numeric|min_length[7]|max_length[13]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'max_length[50]');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'max_length[100]');

		// Jika validasi gagal, akan muncul error di input dan kembali ke halaman supplier
		if ($this->form_validation->run() == FALSE) {
			// Ambil kode paling terakhir
			$kode = $this->supplier_m->getKode();
			// Ambil tiga digit dari belakang kode
			$getKode = (int) substr($kode['kode_supp'], -3);
			// Tambahkan terus setiap insert data
			$getKode++;

			// Format kode
			$kode_supp = 'SUPP-' . date('Ymd') . sprintf('%03s', $getKode);
			$data = [
				'judul' => 'Admin',
				'viewUtama' => 'admin/contents/supplier',
				'cekUser' => $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array(),
				'suppliers' => $this->db->get('data_supplier')->result_array(), // mengTampilkan semua data di table supplier
				'kode_supp' => $kode_supp
			];
			$this->load->view('admin/layouts/wrapperForm', $data);
			// Jika validasi tidak gagal
		} else {
			$this->supplier_m->storeSupplier(); // Insert data supplier
			$this->session->set_flashdata('success', 'Data berhasil dibuat.'); // Membuat pesan notif jika insert data berhasil
			redirect('admin/supplier'); // redirect ke halaman supplier
		}
	}
	public function update_supplier($kode_supp)
	{
		// Parameter pertama untuk name input, Parameter kedua bebas, Parameter ketiga aturan input
		$this->form_validation->set_rules('nama', 'Nama', 'required|max_length[50]');
		$this->form_validation->set_rules('email', 'Email', 'valid_email|max_length[50]');
		$this->form_validation->set_rules('no_hp', 'No Handphone', 'required|numeric|min_length[7]|max_length[13]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'max_length[50]');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'max_length[100]');

		// Jika validasi gagal, akan muncul error di input dan kembali ke halaman supplier
		if ($this->form_validation->run() == FALSE) {
			$data = [
				'judul' => 'Admin',
				'viewUtama' => 'admin/contents/update_supplier',
				'cekUser' => $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array(),
				'supplier' => $this->db->get_where('data_supplier', ['kode_supp' => $kode_supp])->row_array() // mengTampilkan semua data di table supplier
			];
			$this->load->view('admin/layouts/wrapperForm', $data);
			// Jika validasi tidak gagal
		} else {
			$this->supplier_m->updateSupplier($kode_supp); // Update data supplier
			$this->session->set_flashdata('success', 'Data berhasil diubah.'); // Membuat pesan notif jika update data berhasil
			redirect('admin/supplier'); // redirect ke halaman supplier
		}
	}
	public function barang()
	{
		// Parameter pertama untuk name input, Parameter kedua bebas, Parameter ketiga aturan input
		$this->form_validation->set_rules('kode_brg', 'Kode Barang', 'required|trim|is_unique[data_barang.kode_brg]');
		$this->form_validation->set_rules('nama', 'Nama', 'required|max_length[50]');
		$this->form_validation->set_rules('jenis', 'Jenis', 'required');
		$this->form_validation->set_rules('id_satuan', 'Satuan Barang', 'required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'max_length[100]');

		// Jika validasi gagal, akan muncul error di input dan kembali ke halaman barang
		if ($this->form_validation->run() == FALSE) {
			// Ambil kode paling terakhir
			$kode = $this->barang_m->getKode();
			// Ambil tiga digit dari belakang kode
			$getKode = (int) substr($kode['kode_brg'], -3);
			// Tambahkan terus setiap insert data
			$getKode++;

			// Format kode
			$kode_brg = 'BRG-' . date('Ymd') . sprintf('%03s', $getKode);
			$data = [
				'judul' => 'Admin',
				'viewUtama' => 'admin/contents/barang',
				'cekUser' => $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array(),
				'barangs' => $this->barang_m->getBarang()->result_array(), // mengTampilkan semua data di table barang
				'satuans' => $this->db->get('data_satuan')->result_array(), // mengTampilkan semua data di table satuan
				'kode_brg' => $kode_brg
			];
			$this->load->view('admin/layouts/wrapperForm', $data);
			// Jika validasi tidak gagal
		} else {
			$this->barang_m->storeBarang(); // Insert data barang
			$this->session->set_flashdata('success', 'Data berhasil dibuat.'); // Membuat pesan notif jika insert data berhasil
			redirect('admin/barang'); // redirect ke halaman barang
		}
	}
	public function update_barang($kode_brg)
	{
		// Parameter pertama untuk name input, Parameter kedua bebas, Parameter ketiga aturan input
		$this->form_validation->set_rules('nama', 'Nama', 'required|max_length[50]');
		$this->form_validation->set_rules('jenis', 'Jenis', 'required');
		$this->form_validation->set_rules('id_satuan', 'Satuan Barang', 'required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'max_length[100]');

		// Jika validasi gagal, akan muncul error di input dan kembali ke halaman barang
		if ($this->form_validation->run() == FALSE) {
			$data = [
				'judul' => 'Admin',
				'viewUtama' => 'admin/contents/update_barang',
				'cekUser' => $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array(),
				'barang' => $this->db->get_where('data_barang', ['kode_brg' => $kode_brg])->row_array(), // mengTampilkan semua data di table barang
				'satuans' => $this->db->get('data_satuan')->result_array(), // mengTampilkan semua data di table satuan
			];
			$this->load->view('admin/layouts/wrapperForm', $data);
			// Jika validasi tidak gagal
		} else {
			$this->barang_m->updateBarang($kode_brg); // Update data barang
			$this->session->set_flashdata('success', 'Data berhasil diubah.'); // Membuat pesan notif jika update data berhasil
			redirect('admin/barang'); // redirect ke halaman barang
		}
	}
	public function pengguna()
	{
		// Parameter pertama untuk name input, Parameter kedua bebas, Parameter ketiga aturan input
		$this->form_validation->set_rules('nama', 'Satuan', 'trim|max_length[50]');
		$this->form_validation->set_rules('username', 'Satuan', 'required|trim|max_length[20]|min_length[5]|is_unique[pengguna.username]');
		$this->form_validation->set_rules('password', 'Satuan', 'required|trim|min_length[6]');
		$this->form_validation->set_rules('email', 'Email', 'valid_email|max_length[50]|is_unique[pengguna.email]');
		$this->form_validation->set_rules('no_hp', 'No Handphone', 'numeric|min_length[7]|max_length[13]');

		// Jika validasi gagal, akan muncul error di input dan kembali ke halaman pengguna
		if ($this->form_validation->run() == FALSE) {
			$data = [
				'judul' => 'Admin',
				'viewUtama' => 'admin/contents/pengguna',
				'cekUser' => $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array(),
				'penggunas' => $this->db->get('pengguna')->result_array() // mengTampilkan semua data di table pengguna
			];
			$this->load->view('admin/layouts/wrapperForm', $data);
			// Jika validasi tidak gagal
		} else {
			$this->pengguna_m->storePengguna(); // Insert data pengguna
			$this->session->set_flashdata('success', 'Data berhasil dibuat.'); // Membuat pesan notif jika insert data berhasil
			redirect('admin/pengguna'); // redirect ke halaman pengguna
		}
	}
	public function barang_masuk()
	{
		$data = [
			'judul' => 'Admin',
			'viewUtama' => 'admin/contents/barang_masuk',
			'cekUser' => $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array(),
			'barang_masuks' => $this->barang_m->getBarangMasuk()->result_array() // mengTampilkan semua data di table masuk
		];
		$this->load->view('admin/layouts/wrapperForm', $data);
	}
	public function add_barang_masuk()
	{
		// Parameter pertama untuk name input, Parameter kedua bebas, Parameter ketiga aturan input
		$this->form_validation->set_rules('kode_brg_msk', 'Kode Transaksi', 'required|trim|is_unique[data_barang_masuk.kode_brg_msk]');
		$this->form_validation->set_rules('kode_brg', 'Barang', 'required');
		$this->form_validation->set_rules('kode_supp', 'Supplier', 'required');
		$this->form_validation->set_rules('jml_masuk', 'Jumlah Masuk', 'required|numeric');
		$this->form_validation->set_rules('tgl_masuk', 'Tanggal Masuk', 'required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'max_length[100]');

		// Jika validasi gagal, akan muncul error di input dan kembali ke halaman barang masuk
		if ($this->form_validation->run() == FALSE) {
			// Ambil kode paling terakhir
			$kode = $this->barang_m->getKodeBarangMasuk();
			// Ambil tiga digit dari belakang kode
			$getKode = (int) substr($kode['kode_brg_msk'], -3);
			// Tambahkan terus setiap insert data
			$getKode++;

			// Format kode
			$kode_brg = 'TRBM-' . date('Ymd') . sprintf('%03s', $getKode);
			$data = [
				'judul' => 'Admin',
				'viewUtama' => 'admin/contents/add_barang_masuk',
				'cekUser' => $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array(),
				'barangs' => $this->barang_m->getBarang()->result_array(), // mengTampilkan semua data di table barang
				'suppliers' => $this->db->get('data_supplier')->result_array(), // mengTampilkan semua data di table supplier
				'kode_brg' => $kode_brg
			];
			$this->load->view('admin/layouts/wrapperForm', $data);
			// Jika validasi tidak gagal
		} else {
			$this->barang_m->storeBarangMasuk(); // Insert data barang masuk
			$this->session->set_flashdata('success', 'Data berhasil dibuat.'); // Membuat pesan notif jika insert data berhasil
			redirect('admin/barang_masuk'); // redirect ke halaman barang masuk
		}
	}
	public function update_barang_masuk($kode_brg_msk)
	{
		// Parameter pertama untuk name input, Parameter kedua bebas, Parameter ketiga aturan input
		$this->form_validation->set_rules('jml_masuk', 'Jumlah Masuk', 'required|numeric');
		$this->form_validation->set_rules('tgl_masuk', 'Tanggal Masuk', 'required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'max_length[100]');

		// Jika validasi gagal, akan muncul error di input dan kembali ke halaman barang masuk
		if ($this->form_validation->run() == FALSE) {
			$barang_masuk = $this->barang_m->getBarangMasuk($kode_brg_msk)->row_array();
			$cek24jam = time() - strtotime($barang_masuk['tgl_dbm']) < self::JAM;
			$data = [
				'judul' => 'Admin',
				'viewUtama' => 'admin/contents/update_barang_masuk',
				'cekUser' => $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array(),
				'barang_masuk' => $barang_masuk, // mengTampilkan data di table barang masuk
				'barang' => $this->barang_m->getBarang($barang_masuk['kode_brg'])->row_array(), // mengTampilkan semua data di table barang
				'cek24jam' => $cek24jam
			];
			$this->load->view('admin/layouts/wrapperForm', $data);
			// Jika validasi tidak gagal
		} else {
			$this->barang_m->updateBarangMasuk(); // Update data barang masuk
			$this->session->set_flashdata('success', 'Data berhasil diubah.'); // Membuat pesan notif jika insert data berhasil
			redirect('admin/barang_masuk'); // redirect ke halaman barang masuk
		}
	}
	public function delete_barang_masuk($kode_brg_msk)
	{
		$this->barang_m->deleteBarangMasuk($kode_brg_msk); // Update data barang masuk
		$this->session->set_flashdata('success', 'Data berhasil dihapus, stok barang berubah.'); // Membuat pesan notif jika insert data berhasil
		redirect('admin/barang_masuk'); // redirect ke halaman barang masuk
	}
	public function barang_keluar()
	{
		$data = [
			'judul' => 'Admin',
			'viewUtama' => 'admin/contents/barang_keluar',
			'cekUser' => $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array(),
			'barang_keluars' => $this->db->get('data_barang_keluar')->result_array() // mengTampilkan semua data di table keluar
		];
		$this->load->view('admin/layouts/wrapperForm', $data);
	}
}
