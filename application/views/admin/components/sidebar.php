<aside class="left-sidebar">
	<!-- Sidebar scroll-->
	<div class="scroll-sidebar">
		<!-- Sidebar navigation-->
		<nav class="sidebar-nav">
			<ul id="sidebarnav">
				<li class="nav-small-cap">--- MAIN MENU</li>
				<li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false"><i class="icon-Home-2"></i><span class="hide-menu">Dashboard</span></a>
					<ul aria-expanded="false" class="collapse">
						<li><a href="<?= base_url('admin') ?>">Home</a></li>
					</ul>
				</li>
				<li <?= activeMenu(['satuan', 'update_satuan', 'supplier', 'update_supplier', 'barang', 'update_barang', 'pengguna', 'update_pengguna', 'customer', 'update_customer']) ?>> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false"><i class="icon-Big-Data"></i><span class="hide-menu">Master Data</span></a>
					<ul aria-expanded="false" class="collapse">
						<li><a href="<?= base_url('admin/satuan') ?>" <?= activeMenu(['satuan', 'update_satuan']) ?>>Data Satuan</a></li>
						<li><a href="<?= base_url('admin/supplier') ?>" <?= activeMenu(['supplier', 'update_supplier']) ?>>Data Supplier</a></li>
						<li><a href="<?= base_url('admin/customer') ?>" <?= activeMenu(['customer', 'update_customer']) ?>>Data Customer</a></li>
						<li><a href="<?= base_url('admin/barang') ?>" <?= activeMenu(['barang', 'update_barang']) ?>>Data Barang</a></li>
						<li><a href="<?= base_url('admin/pengguna') ?>" <?= activeMenu(['pengguna', 'update_pengguna']) ?>>Data Pengguna</a></li>
					</ul>
				</li>
				<li <?= activeMenu(['barang_masuk', 'add_barang_masuk', 'update_barang_masuk', 'barang_keluar', 'add_barang_keluar', 'update_barang_keluar']) ?>> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false"><i class="icon-Handshake"></i><span class="hide-menu">Transaksi</span></a>
					<ul aria-expanded="false" class="collapse">
						<li><a href="<?= base_url('admin/barang_masuk') ?>" <?= activeMenu(['barang_masuk', 'add_barang_masuk', 'update_barang_masuk']) ?>>Barang Masuk</a></li>
						<li><a href="<?= base_url('admin/barang_keluar') ?>" <?= activeMenu(['barang_keluar', 'add_barang_keluar', 'update_barang_keluar']) ?>>Barang Keluar</a></li>
					</ul>
				</li>
				<li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false"><i class="icon-Box-Full"></i><span class="hide-menu">Kelola Laporan</span></a>
					<ul aria-expanded="false" class="collapse">
						<li><a href="<?= base_url('admin/laporan_barang_masuk') ?>">Barang Masuk</a></li>
						<li><a href="<?= base_url('admin/laporan_barang_keluar') ?>">Barang Keluar</a></li>
					</ul>
				</li>
				<li class="nav-small-cap">--- LAINNYA</li>
				<li>
					<a class="waves-effect waves-dark" href="<?= base_url('auth/logout') ?>" aria-expanded="false">
						<i class="icon-Power-3"></i>
						<span class="hide-menu">Logout</span>
					</a>
				</li>
			</ul>
		</nav>
		<!-- End Sidebar navigation -->
	</div>
	<!-- End Sidebar scroll-->
</aside>
