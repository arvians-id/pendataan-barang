<div class="container-fluid">
	<div class="row page-titles">
		<div class="col-7 col-md-5 align-self-center">
			<h3 class="text-themecolor">Data Barang</h3>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Admin</a></li>
				<li class="breadcrumb-item active">Barang</li>
			</ol>
		</div>
	</div>
	<!-- row -->
	<div class="card shadow-sm">
		<div class="card-body">
			<h4 class="card-title">Ubah Barang | <?= $barang['kode_brg'] ?></h4>
			<hr>
			<div class="row justify-content-center">
				<div class="col-12 col-lg-8">
					<form method="post" enctype="multipart/form-data">
						<input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
						<div class="form-group">
							<label>Kode Barang</label>
							<input type="text" class="form-control" value="<?= $barang['kode_brg'] ?>" readonly>
						</div>
						<div class="form-group">
							<label>Nama</label><span class="text-danger"> *</span>
							<input type="text" class="form-control <?= form_error('nama') ? 'is-invalid' : '' ?>" name="nama" value="<?= $barang['nama'] ?>">
							<div class="invalid-feedback"><?= form_error('nama') ?></div>
						</div>
						<div class="form-group">
							<label>Jenis</label><span class="text-danger"> *</span>
							<select name="jenis" class="form-control <?= form_error('nama') ? 'is-invalid' : '' ?>">
								<option value="" disabled selected>Pilih</option>
								<option value="makanan" <?= $barang['jenis'] == 'Makanan' ? 'selected' : null ?>>Makanan</option>
								<option value="minuman" <?= $barang['jenis'] == 'Minuman' ? 'selected' : null ?>>Minuman</option>
							</select>
							<div class="invalid-feedback"><?= form_error('jenis') ?></div>
						</div>
						<div class="form-group">
							<label>Satuan</label>
							<select name="id_satuan" class="form-control <?= form_error('id_satuan') ? 'is-invalid' : '' ?>">
								<option value="" disabled selected>Pilih</option>
								<?php foreach ($satuans as $satuan) : ?>
									<option value="<?= $satuan['id_satuan'] ?>" <?= $satuan['id_satuan'] != $barang['id_satuan'] ?: 'selected' ?>><?= $satuan['satuan'] ?></option>
								<?php endforeach ?>
							</select>
							<div class="invalid-feedback"><?= form_error('id_satuan') ?></div>
						</div>
						<div class="form-group">
							<label>Keterangan Lainnya</label>
							<input type="text" class="form-control <?= form_error('keterangan') ? 'is-invalid' : '' ?>" name="keterangan" value="<?= $barang['keterangan'] ?>">
							<div class="invalid-feedback"><?= form_error('keterangan') ?></div>
						</div>
						<div class="form-group">
							<label>Photo</label><small class="text-info"> *Abaikan jika tidak ingin diubah</small>
							<input type="file" class="form-control" name="photo">
						</div>
						<button type="submit" class="btn btn-primary">Ubah</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- row -->
</div>
