<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function index()
	{ // Jika user belum login
		is_logged_in();

		// Validasi form
		$this->form_validation->set_rules('username', 'username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		// Jika Form validasi nya salah
		if ($this->form_validation->run() == FALSE) {
			$data = [
				'judul' => 'Login'
			];
			$this->load->view('auth/login', $data);

			// Tapi jika sudah memenuhi aturan required
		} else {
			// Ambil inputan
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			// Jika usernya ada, cek ke database
			$cekUser = $this->db->get_where('pengguna', ['username' => $username, 'password' => md5($password)])->row_array();
			if ($cekUser) {
				// Lalu Bikin data untuk di masukkan ke session
				$setSession = [
					'id' => $cekUser['id'],
					'email' => $cekUser['email'],
					'username' => $cekUser['username'],
				];
				// Set ke session data di atas
				$this->session->set_userdata($setSession);
				redirect('admin');
			}
			$this->session->set_flashdata('error', 'Username atau password salah!');
			redirect('auth');
		}
	}
	public function logout()
	{
		$data = ['id', 'email', 'username']; // data yang akan di masukkan ke userdata
		// Unset userdata/session
		$this->session->unset_userdata($data);
		// Kembalikan ke halaman login lagi setelah session dihapus
		$this->session->set_flashdata('success', 'Anda berhasil keluar.');
		redirect('auth');
	}
}
