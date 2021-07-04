<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	const JAM = (60 * 60 * 24);
	public function __construct()
	{
		parent::__construct();
		// Load Model
		// Parameter pertama load file model, Parameter kedua adalah nama alias dari model parameter pertama
		$this->load->model('Satuan_model', 'satuan_m');
		$this->load->model('Supplier_model', 'supplier_m');
		$this->load->model('Customer_model', 'customer_m');
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
			$kode_supp = 'SUPP-' . date('Y') . sprintf('%03s', $getKode);
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
	public function customer()
	{
		// Parameter pertama untuk name input, Parameter kedua bebas, Parameter ketiga aturan input
		$this->form_validation->set_rules('kode_cus', 'Kode Customer', 'required|trim|is_unique[data_customer.kode_cus]');
		$this->form_validation->set_rules('nama', 'Nama', 'required|max_length[50]');
		$this->form_validation->set_rules('email', 'Email', 'valid_email|max_length[50]');
		$this->form_validation->set_rules('no_hp', 'No Handphone', 'required|numeric|min_length[7]|max_length[13]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'max_length[50]');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'max_length[100]');

		// Jika validasi gagal, akan muncul error di input dan kembali ke halaman customer
		if ($this->form_validation->run() == FALSE) {
			// Ambil kode paling terakhir
			$kode = $this->customer_m->getKode();
			// Ambil tiga digit dari belakang kode
			$getKode = (int) substr($kode['kode_cus'], -3);
			// Tambahkan terus setiap insert data
			$getKode++;

			// Format kode
			$kode_cus = 'CUS-' . date('Y') . sprintf('%03s', $getKode);
			$data = [
				'judul' => 'Admin',
				'viewUtama' => 'admin/contents/customer',
				'cekUser' => $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array(),
				'customers' => $this->db->get('data_customer')->result_array(), // mengTampilkan semua data di table customer
				'kode_cus' => $kode_cus
			];
			$this->load->view('admin/layouts/wrapperForm', $data);
			// Jika validasi tidak gagal
		} else {
			$this->customer_m->storeCustomer(); // Insert data customer
			$this->session->set_flashdata('success', 'Data berhasil dibuat.'); // Membuat pesan notif jika insert data berhasil
			redirect('admin/customer'); // redirect ke halaman customer
		}
	}
	public function update_customer($kode_cus)
	{
		// Parameter pertama untuk name input, Parameter kedua bebas, Parameter ketiga aturan input
		$this->form_validation->set_rules('nama', 'Nama', 'required|max_length[50]');
		$this->form_validation->set_rules('email', 'Email', 'valid_email|max_length[50]');
		$this->form_validation->set_rules('no_hp', 'No Handphone', 'required|numeric|min_length[7]|max_length[13]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'max_length[50]');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'max_length[100]');

		// Jika validasi gagal, akan muncul error di input dan kembali ke halaman customer
		if ($this->form_validation->run() == FALSE) {
			$data = [
				'judul' => 'Admin',
				'viewUtama' => 'admin/contents/update_customer',
				'cekUser' => $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array(),
				'customer' => $this->db->get_where('data_customer', ['kode_cus' => $kode_cus])->row_array() // mengTampilkan semua data di table customer
			];
			$this->load->view('admin/layouts/wrapperForm', $data);
			// Jika validasi tidak gagal
		} else {
			$this->customer_m->updateCustomer($kode_cus); // Update data customer
			$this->session->set_flashdata('success', 'Data berhasil diubah.'); // Membuat pesan notif jika update data berhasil
			redirect('admin/customer'); // redirect ke halaman customer
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
			$kode_brg = 'BRG-' . date('Y') . sprintf('%03s', $getKode);
			$data = [
				'judul' => 'Admin',
				'viewUtama' => 'admin/contents/barang',
				'cekUser' => $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array(),
				'barangs' => $this->barang_m->getBarang()->result_array(), // mengTampilkan semua data di table barang
				'satuans' => $this->db->get('data_satuan')->result_array(), // mengTampilkan semua data di table satuan
				'barang_masuk' => $this->db->get('data_barang_masuk')->num_rows(),
				'barang_keluar' => $this->db->get('data_barang_keluar')->num_rows(),
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
		$this->form_validation->set_rules('username', 'Satuan', 'required|trim|max_length[20]|min_length[5]|is_unique[pengguna.username]');
		$this->form_validation->set_rules('password', 'Satuan', 'required|trim|min_length[6]');

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
			$kode_brg = 'TRBM-' . date('Y') . sprintf('%03s', $getKode);
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
		$this->form_validation->set_rules('tgl_masuk', 'Tanggal Masuk', 'required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'max_length[100]');

		// Jika validasi gagal, akan muncul error di input dan kembali ke halaman barang masuk
		if ($this->form_validation->run() == FALSE) {
			$barang_masuk = $this->barang_m->getBarangMasuk($kode_brg_msk)->row_array();
			$data = [
				'judul' => 'Admin',
				'viewUtama' => 'admin/contents/update_barang_masuk',
				'cekUser' => $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array(),
				'barang_masuk' => $barang_masuk, // mengTampilkan data di table barang masuk
				'barang' => $this->barang_m->getBarang($barang_masuk['kode_brg'])->row_array(), // mengTampilkan semua data di table barang
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
		$barang_masuk = $this->db->get_where('data_barang_masuk', ['kode_brg_msk' => $kode_brg_msk])->row_array();
		$barang = $this->db->get_where('data_barang', ['kode_brg' => $barang_masuk['kode_brg']])->row_array();
		if (($barang['total_stok'] - $barang_masuk['jml_masuk']) < 0) {
			$this->session->set_flashdata('error', 'Data gagal dihapus dikarenakan stok habis'); // Membuat pesan notif error jika stok kurang dari 0
			redirect('admin/barang_masuk'); // redirect ke halaman barang masuk
		} else {
			$this->barang_m->deleteBarangMasuk($kode_brg_msk); // Update data barang masuk
			$this->session->set_flashdata('success', 'Data berhasil dihapus, stok barang berubah.'); // Membuat pesan notif jika insert data berhasil
			redirect('admin/barang_masuk'); // redirect ke halaman barang masuk
		}
	}
	public function barang_keluar()
	{
		$data = [
			'judul' => 'Admin',
			'viewUtama' => 'admin/contents/barang_keluar',
			'cekUser' => $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array(),
			'barang_keluars' => $this->barang_m->getBarangKeluar()->result_array() // mengTampilkan semua data di table keluar
		];
		$this->load->view('admin/layouts/wrapperForm', $data);
	}
	public function add_barang_keluar()
	{
		// Parameter pertama untuk name input, Parameter kedua bebas, Parameter ketiga aturan input
		$this->form_validation->set_rules('kode_brg_klr', 'Kode Transaksi', 'required|trim|is_unique[data_barang_keluar.kode_brg_klr]');
		$this->form_validation->set_rules('kode_brg', 'Barang', 'required');
		$this->form_validation->set_rules('kode_cus', 'Customer', 'required');
		$this->form_validation->set_rules('jml_keluar', 'Jumlah Keluar', 'required|numeric');
		$this->form_validation->set_rules('tgl_keluar', 'Tanggal Keluar', 'required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'max_length[100]');
		$this->form_validation->set_rules('total_stok', 'Total Stok', 'numeric|greater_than[-1]', ['greater_than' => 'Stok harus harus melebihi 0']);

		// Jika validasi gagal, akan muncul error di input dan kembali ke halaman barang keluar
		if ($this->form_validation->run() == FALSE) {
			// Ambil kode paling terakhir
			$kode = $this->barang_m->getKodeBarangKeluar();
			// Ambil tiga digit dari belakang kode
			$getKode = (int) substr($kode['kode_brg_klr'], -3);
			// Tambahkan terus setiap insert data
			$getKode++;

			// Format kode
			$kode_brg = 'TRBK-' . date('Y') . sprintf('%03s', $getKode);
			$data = [
				'judul' => 'Admin',
				'viewUtama' => 'admin/contents/add_barang_keluar',
				'cekUser' => $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array(),
				'barangs' => $this->barang_m->getBarang()->result_array(), // mengTampilkan semua data di table barang
				'customers' => $this->db->get('data_customer')->result_array(), // mengTampilkan semua data di table customer
				'kode_brg' => $kode_brg
			];
			$this->load->view('admin/layouts/wrapperForm', $data);
			// Jika validasi tidak gagal
		} else {
			$this->barang_m->storeBarangKeluar(); // Insert data barang keluar
			$this->session->set_flashdata('success', 'Data berhasil dibuat.'); // Membuat pesan notif jika insert data berhasil
			redirect('admin/barang_keluar'); // redirect ke halaman barang keluar
		}
	}
	public function update_barang_keluar($kode_brg_klr)
	{
		// Parameter pertama untuk name input, Parameter kedua bebas, Parameter ketiga aturan input
		$this->form_validation->set_rules('tgl_keluar', 'Tanggal Keluar', 'required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'max_length[100]');

		// Jika validasi gagal, akan muncul error di input dan kembali ke halaman barang keluar
		if ($this->form_validation->run() == FALSE) {
			$barang_keluar = $this->barang_m->getBarangKeluar($kode_brg_klr)->row_array();
			$data = [
				'judul' => 'Admin',
				'viewUtama' => 'admin/contents/update_barang_keluar',
				'cekUser' => $this->db->get_where('pengguna', ['username' => $this->session->userdata('username')])->row_array(),
				'barang_keluar' => $barang_keluar, // mengTampilkan data di table barang keluar
				'barang' => $this->barang_m->getBarang($barang_keluar['kode_brg'])->row_array(), // mengTampilkan semua data di table barang
			];
			$this->load->view('admin/layouts/wrapperForm', $data);
			// Jika validasi tidak gagal
		} else {
			$this->barang_m->updateBarangKeluar(); // Update data barang keluar
			$this->session->set_flashdata('success', 'Data berhasil diubah.'); // Membuat pesan notif jika insert data berhasil
			redirect('admin/barang_keluar'); // redirect ke halaman barang keluar
		}
	}
	public function delete_barang_keluar($kode_brg_klr)
	{
		$this->barang_m->deleteBarangKeluar($kode_brg_klr); // Update data barang keluar
		$this->session->set_flashdata('success', 'Data berhasil dihapus, stok barang berubah.'); // Membuat pesan notif jika insert data berhasil
		redirect('admin/barang_keluar'); // redirect ke halaman barang keluar
	}
}
