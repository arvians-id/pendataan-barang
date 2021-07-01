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
				<li <?= activeMenu(['satuan', 'update_satuan', 'supplier', 'update_supplier', 'barang', 'update_barang', 'pengguna', 'update_pengguna']) ?>> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false"><i class="icon-Big-Data"></i><span class="hide-menu">Master Data</span></a>
					<ul aria-expanded="false" class="collapse">
						<li><a href="<?= base_url('admin/satuan') ?>" <?= activeMenu(['satuan', 'update_satuan']) ?>>Data Satuan</a></li>
						<li><a href="<?= base_url('admin/supplier') ?>" <?= activeMenu(['supplier', 'update_supplier']) ?>>Data Supplier</a></li>
						<li><a href="<?= base_url('admin/barang') ?>" <?= activeMenu(['barang', 'update_barang']) ?>>Data Barang</a></li>
						<li><a href="<?= base_url('admin/pengguna') ?>" <?= activeMenu(['pengguna', 'update_pengguna']) ?>>Data Pengguna</a></li>
					</ul>
				</li>
				<li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false"><i class="icon-Handshake"></i><span class="hide-menu">Transaksi</span></a>
					<ul aria-expanded="false" class="collapse">
						<li><a href="<?= base_url('admin/masuk') ?>">Barang Masuk</a></li>
						<li><a href="<?= base_url('admin/keluar') ?>">Barang Keluar</a></li>
					</ul>
				</li>
				<li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false"><i class="icon-Box-Full"></i><span class="hide-menu">Kelola Laporan</span></a>
					<ul aria-expanded="false" class="collapse">
						<li><a href="<?= base_url('admin/laporan') ?>">Laporan</a></li>
					</ul>
				</li>
				<li class="nav-small-cap">--- LAINNYA</li>
				<li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false"><i class="icon-Settings-Window"></i><span class="hide-menu">Pengaturan</span></a>
					<ul aria-expanded="false" class="collapse">
						<li><a href="<?= base_url('admin/profil') ?>">Profil</a></li>
						<li><a href="<?= base_url('auth/logout') ?>">Keluar</a></li>
					</ul>
				</li>
			</ul>
		</nav>
		<!-- End Sidebar navigation -->
	</div>
	<!-- End Sidebar scroll-->
</aside>
