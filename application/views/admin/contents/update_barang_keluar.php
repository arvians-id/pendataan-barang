<div class="container-fluid">
	<div class="row page-titles">
		<div class="col-7 col-md-5 align-self-center">
			<h3 class="text-themecolor">Data Stok Barang</h3>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Admin</a></li>
				<li class="breadcrumb-item active">Ubah Data Barang Keluar</li>
			</ol>
		</div>
	</div>
	<!-- row -->
	<div class="card shadow-sm">
		<div class="card-body">
			<h4 class="card-title">Ubah Barang | <?= $barang_keluar['kode_brg_klr'] ?></h4>
			<hr>
			<div class="row justify-content-center">
				<div class="col-12 col-lg-8">
					<form method="post">
						<input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
						<div class="form-group">
							<label>Kode Transaksi Barang Keluar</label><span class="text-danger"> *</span>
							<input type="text" class="form-control <?= form_error('kode_brg_klr') ? 'is-invalid' : '' ?>" name="kode_brg_klr" value="<?= $barang_keluar['kode_brg_klr'] ?>" readonly>
							<div class="invalid-feedback"><?= form_error('kode_brg_klr') ?></div>
						</div>
						<div class="form-group">
							<label>Tanggal Keluar</label><span class="text-danger"> *</span>
							<input type="date" class="form-control <?= form_error('tgl_keluar') ? 'is-invalid' : '' ?>" name="tgl_keluar" value="<?= $barang_keluar['tgl_keluar'] ?>">
							<div class="invalid-feedback"><?= form_error('tgl_keluar') ?></div>
						</div>
						<div class="form-group">
							<label>Keterangan Lainnya</label>
							<input type="text" class="form-control <?= form_error('keterangan') ? 'is-invalid' : '' ?>" name="keterangan" value="<?= $barang_keluar['keterangan_keluar'] ?>">
							<div class="invalid-feedback"><?= form_error('keterangan') ?></div>
						</div>
						<button type="submit" class="btn btn-primary">Ubah</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
