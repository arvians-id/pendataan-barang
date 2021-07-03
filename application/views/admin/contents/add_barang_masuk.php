<div class="container-fluid">
	<div class="row page-titles">
		<div class="col-7 col-md-5 align-self-center">
			<h3 class="text-themecolor">Data Barang</h3>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Admin</a></li>
				<li class="breadcrumb-item active"><?= $this->uri->segment(2) ?></li>
			</ol>
		</div>
	</div>
	<!-- row -->
	<div class="card shadow-sm">
		<div class="card-body">
			<h4 class="card-title">Buat Barang</h4>
			<hr>
			<div class="row justify-content-center">
				<div class="col-12 col-lg-8">
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
							<input type="text" class="form-control <?= form_error('kode_brg_msk') ? 'is-invalid' : '' ?>" name="kode_brg_msk" value="<?= $kode_brg ?>" readonly>
							<div class="invalid-feedback"><?= form_error('kode_brg_msk') ?></div>
						</div>
						<div class="form-group">
							<label>Tanggal Masuk</label><span class="text-danger"> *</span>
							<input type="date" class="form-control <?= form_error('tgl_masuk') ? 'is-invalid' : '' ?>" name="tgl_masuk" value="<?= set_value('tgl_masuk') ?>">
							<div class="invalid-feedback"><?= form_error('tgl_masuk') ?></div>
						</div>
						<div class="form-group">
							<label>Supplier</label><span class="text-danger"> *</span>
							<select class="form-control <?= form_error('kode_supp') ? 'is-invalid' : '' ?>" name="kode_supp">
								<option value="" disabled selected>Pilih</option>
								<?php foreach ($suppliers as $supplier) : ?>
									<option value="<?= $supplier['kode_supp'] ?>" <?= !set_value('kode_supp') ?: 'selected' ?>><?= $supplier['nama'] . ' &mdash; ' . $supplier['kode_supp'] ?></option>
								<?php endforeach ?>
							</select>
							<div class="invalid-feedback"><?= form_error('kode_supp') ?></div>
						</div>
						<div class="form-group">
							<label>Barang</label><span class="text-danger"> *</span>
							<select class="form-control <?= form_error('kode_brg') ? 'is-invalid' : '' ?>" name="kode_brg">
								<option value="" disabled selected>Pilih</option>
								<?php foreach ($barangs as $barang) : ?>
									<option value="<?= $barang['kode_brg'] ?>" data-satuan="<?= $barang['satuan'] ?>" data-stok="<?= $barang['total_stok'] ?>" <?= !set_value('kode_brg') ?: 'selected' ?>><?= $barang['nama'] . ' &mdash; ' . $barang['kode_brg'] ?></option>
								<?php endforeach ?>
							</select>
							<div class="invalid-feedback"><?= form_error('kode_brg') ?></div>
						</div>
						<div class="form-group">
							<label>Stok Awal</label><span class="text-danger"> *</span>
							<input type="number" class="form-control <?= form_error('stok_awal') ? 'is-invalid' : '' ?>" name="stok_awal" value="<?= set_value('stok_awal') ?>" readonly>
							<div class="invalid-feedback"><?= form_error('stok_awal') ?></div>
						</div>
						<div class="form-group">
							<label>Jumlah Masuk</label><span class="text-danger"> *</span>
							<div class="input-group mb-3">
								<input type="text" class="form-control <?= form_error('jml_masuk') ? 'is-invalid' : '' ?>" name="jml_masuk" value="<?= set_value('jml_masuk') ?>" min="0" autocomplete="off" <?= set_value('kode_brg') ?: 'readonly' ?>>
								<div class="input-group-append">
									<span class="input-group-text" id="satuan-barang">Satuan</span>
								</div>
								<div class="invalid-feedback"><?= form_error('jml_masuk') ?></div>
							</div>
						</div>
						<div class="form-group">
							<label>Total Stok Barang</label><span class="text-danger"> *</span>
							<input type="number" class="form-control <?= form_error('total_stok') ? 'is-invalid' : '' ?>" name="total_stok" value="<?= set_value('total_stok') ?>" readonly>
							<div class="invalid-feedback"><?= form_error('total_stok') ?></div>
						</div>
						<div class="form-group">
							<label>Keterangan Lainnya</label>
							<input type="text" class="form-control <?= form_error('keterangan') ? 'is-invalid' : '' ?>" name="keterangan" value="<?= set_value('keterangan') ?>">
							<div class="invalid-feedback"><?= form_error('keterangan') ?></div>
						</div>
						<button type="submit" class="btn btn-primary">Buat</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="<?= base_url() ?>assets/template/adminwrap/assets/node_modules/jquery/jquery.min.js"></script>
<script>
	$(function() {
		$('[name="kode_brg"]').on('change', function() {
			let dataStok = $(this).find(':selected').data('stok');
			let satuan = $(this).find(':selected').data('satuan');
			let jmlMasuk = $('[name="jml_masuk"]');

			if (jmlMasuk.val() == '') {
				$('[name="stok_awal"]').val(dataStok);
				$('[name="total_stok"]').val(dataStok);
			} else {
				$('[name="stok_awal"]').val(dataStok);
				dataStok = dataStok + parseInt(jmlMasuk.val());
				$('[name="total_stok"]').val(dataStok).trigger('change');
			}

			jmlMasuk.removeAttr('readonly')
			$('#satuan-barang').html(satuan);
		})
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
