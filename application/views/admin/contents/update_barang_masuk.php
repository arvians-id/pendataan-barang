<div class="container-fluid">
	<div class="row page-titles">
		<div class="col-7 col-md-5 align-self-center">
			<h3 class="text-themecolor">Data Barang</h3>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Admin</a></li>
				<li class="breadcrumb-item active">Ubah Data Barang Masuk</li>
			</ol>
		</div>
	</div>
	<!-- row -->
	<div class="card shadow-sm">
		<div class="card-body">
			<h4 class="card-title">Ubah Barang | <?= $barang_masuk['kode_brg_msk'] ?></h4>
			<hr>
			<div class="row justify-content-center">
				<div class="col-12 col-lg-8">
					<?php if (!$cek24jam) : ?>
						<div class="alert alert-danger" role="alert">
							<h4 class="alert-heading">Perhatian!</h4>
							<p>Data barang masuk ini sudah melebihi 24 jam, maka dari itu data stok tidak akan bisa diubah.</p>
							<hr>
							<p class="mb-0">Namun anda masih dapa melakukan perubahan data di input tanggal masuk atau keterangan.</p>
						</div>
					<?php endif ?>
					<?php if ($this->session->flashdata('success')) : ?>
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<?= $this->session->flashdata('success') ?>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php endif; ?>
					<form method="post">
						<input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
						<div class="form-group">
							<label>Kode Transaksi Barang Masuk</label><span class="text-danger"> *</span>
							<input type="text" class="form-control <?= form_error('kode_brg_msk') ? 'is-invalid' : '' ?>" name="kode_brg_msk" value="<?= $barang_masuk['kode_brg_msk'] ?>" readonly>
							<div class="invalid-feedback"><?= form_error('kode_brg_msk') ?></div>
						</div>
						<div class="form-group">
							<label>Tanggal Masuk</label><span class="text-danger"> *</span>
							<input type="date" class="form-control <?= form_error('tgl_masuk') ? 'is-invalid' : '' ?>" name="tgl_masuk" value="<?= $barang_masuk['tgl_masuk'] ?>">
							<div class="invalid-feedback"><?= form_error('tgl_masuk') ?></div>
						</div>
						<div class="form-group">
							<label>Supplier</label><span class="text-danger"> *</span>
							<input type="text" class="form-control" name="kode_supp" value="<?= $barang_masuk['kode_supp'] . ' &mdash; ' . $barang_masuk['nama_supplier'] ?>" readonly>
						</div>
						<div class="form-group">
							<label>Barang</label><span class="text-danger"> *</span>
							<input type="text" class="form-control" name="kode_brg" value="<?= $barang_masuk['kode_brg'] . ' &mdash; ' . $barang_masuk['nama_barang'] ?>" readonly>
						</div>
						<div class="form-group">
							<label>Stok Awal</label><span class="text-danger"> *</span>
							<input type="number" class="form-control" name="stok_awal" value="<?= $barang['total_stok'] - $barang_masuk['jml_masuk'] ?>" readonly>
						</div>
						<div class="form-group">
							<label>Jumlah Masuk</label><span class="text-danger"> *</span>
							<div class="input-group mb-3">
								<input type="text" class="form-control <?= form_error('jml_masuk') ? 'is-invalid' : '' ?>" name="jml_masuk" value="<?= $barang_masuk['jml_masuk'] ?>" min="0" autocomplete="off" <?= $cek24jam ?: 'readonly' ?>>
								<div class="input-group-append">
									<span class="input-group-text"><?= $barang['satuan'] ?></span>
								</div>
								<div class="invalid-feedback"><?= form_error('jml_masuk') ?></div>
							</div>
						</div>
						<div class="form-group">
							<label>Total Stok Barang</label><span class="text-danger"> *</span>
							<input type="number" class="form-control" name="total_stok" value="<?= $barang['total_stok'] ?>" readonly>
						</div>
						<div class="form-group">
							<label>Keterangan Lainnya</label>
							<input type="text" class="form-control <?= form_error('keterangan') ? 'is-invalid' : '' ?>" name="keterangan" value="<?= set_value('keterangan') ?>">
							<div class="invalid-feedback"><?= form_error('keterangan') ?></div>
						</div>
						<button type="submit" class="btn btn-primary">Ubah</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="<?= base_url() ?>assets/template/adminwrap/assets/node_modules/jquery/jquery.min.js"></script>
<script>
	$(function() {
		$('[name="jml_masuk"]').on('keyup', function() {
			let jmlMasuk = parseInt($(this).val());
			let stokAwal = parseInt($('[name="stok_awal"]').val());
			let totalStok = $('[name="total_stok"]');

			if ($(this).val() == '') {
				totalStok.val(stokAwal);
			} else {
				stokAwal += jmlMasuk;
				totalStok.val(stokAwal);
			}
		})
	})
</script>
