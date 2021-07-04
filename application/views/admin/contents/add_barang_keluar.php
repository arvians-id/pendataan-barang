<div class="container-fluid">
	<div class="row page-titles">
		<div class="col-7 col-md-5 align-self-center">
			<h3 class="text-themecolor">Buat Stok Barang</h3>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Admin</a></li>
				<li class="breadcrumb-item active">Buat Stok Barang Keluar</li>
			</ol>
		</div>
	</div>
	<!-- row -->
	<div class="card shadow-sm">
		<div class="card-body">
			<h4 class="card-title">Buat Stok Barang</h4>
			<hr>
			<div class="row justify-content-center">
				<div class="col-12 col-lg-8">
					<form method="post">
						<input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
						<div class="form-group">
							<label>Kode Transaksi Barang Keluar</label><span class="text-danger"> *</span>
							<input type="text" class="form-control <?= form_error('kode_brg_klr') ? 'is-invalid' : '' ?>" name="kode_brg_klr" value="<?= $kode_brg ?>" readonly>
							<div class="invalid-feedback"><?= form_error('kode_brg_klr') ?></div>
						</div>
						<div class="form-group">
							<label>Tanggal Keluar</label><span class="text-danger"> *</span>
							<input type="date" class="form-control <?= form_error('tgl_keluar') ? 'is-invalid' : '' ?>" name="tgl_keluar" value="<?= set_value('tgl_keluar') ?>">
							<div class="invalid-feedback"><?= form_error('tgl_keluar') ?></div>
						</div>
						<div class="form-group">
							<label>Customer</label><span class="text-danger"> *</span>
							<select class="form-control <?= form_error('kode_cus') ? 'is-invalid' : '' ?>" name="kode_cus">
								<option value="" disabled selected>Pilih</option>
								<?php foreach ($customers as $customer) : ?>
									<option value="<?= $customer['kode_cus'] ?>" <?= !set_value('kode_cus') ?: 'selected' ?>><?= $customer['nama'] . ' &mdash; ' . $customer['kode_cus'] ?></option>
								<?php endforeach ?>
							</select>
							<div class="invalid-feedback"><?= form_error('kode_cus') ?></div>
						</div>
						<div class="form-group">
							<label>Barang</label><span class="text-danger"> *</span>
							<select class="form-control <?= form_error('kode_brg') ? 'is-invalid' : '' ?>" name="kode_brg">
								<option value="" disabled selected>Pilih</option>
								<?php foreach ($barangs as $barang) : ?>
									<option value="<?= $barang['kode_brg'] ?>" data-satuan="<?= $barang['satuan'] ?>" data-stok="<?= $barang['total_stok'] ?>" <?= set_value('kode_brg') != $barang['kode_brg'] ?: 'selected' ?> <?= $barang['total_stok'] < 1 ? 'disabled' : '' ?>><?= $barang['nama'] . ' &mdash; ' . $barang['kode_brg'] ?> <?= $barang['total_stok'] < 1 ? ' &mdash; Stok Habis' : ''  ?></option>
								<?php endforeach ?>
							</select>
							<div class="invalid-feedback"><?= form_error('kode_brg') ?></div>
						</div>
						<div class="form-group">
							<label>Stok Awal</label><span class="text-danger"> *</span>
							<input type="number" class="form-control" name="stok_awal" value="<?= set_value('stok_awal') ?>" readonly>
						</div>
						<div class="form-group">
							<label>Jumlah Keluar</label><span class="text-danger"> *</span>
							<div class="input-group mb-3">
								<input type="text" class="form-control <?= form_error('jml_keluar') ? 'is-invalid' : '' ?>" name="jml_keluar" value="<?= set_value('jml_keluar') ?>" min="0" autocomplete="off" <?= set_value('kode_brg') ?: 'readonly' ?>>
								<div class="input-group-append">
									<span class="input-group-text" id="satuan-barang">Satuan</span>
								</div>
								<div class="invalid-feedback"><?= form_error('jml_keluar') ?></div>
							</div>
						</div>
						<div class="form-group">
							<label>Total Stok Barang</label><span class="text-danger"> *</span>
							<input type="number" class="form-control <?= form_error('total_stok') ? 'is-invalid' : '' ?>" name="total_stok" value="<?= set_value('total_stok') ?>" readonly>
							<small class="text-danger" style="display: none;" id="show-alert">Total stok tidak bisa kurang dari 0</small>
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
			let jmlKeluar = $('[name="jml_keluar"]');

			if (jmlKeluar.val() == '') {
				$('[name="stok_awal"]').val(dataStok);
				$('[name="total_stok"]').val(dataStok);
			} else {
				$('[name="stok_awal"]').val(dataStok);
				dataStok -= parseInt(jmlKeluar.val());
				$('[name="total_stok"]').val(dataStok).trigger('change');
				dataStok >= 0 ? $('#show-alert').hide() : $('#show-alert').show();
			}

			jmlKeluar.removeAttr('readonly')
			$('#satuan-barang').html(satuan);
		})
		$('[name="jml_keluar"]').on('keyup', function() {
			let jmlKeluar = parseInt($(this).val());
			let stokAwal = parseInt($('[name="stok_awal"]').val());

			if ($(this).val() == '') {
				$('[name="total_stok"]').val(stokAwal);
			} else {
				stokAwal -= jmlKeluar;
				$('[name="total_stok"]').val(stokAwal);
				stokAwal >= 0 ? $('#show-alert').hide() : $('#show-alert').show();
			}
		})
	})
</script>
