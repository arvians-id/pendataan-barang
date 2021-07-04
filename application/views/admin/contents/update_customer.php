<div class="container-fluid">
	<div class="row page-titles">
		<div class="col-7 col-md-5 align-self-center">
			<h3 class="text-themecolor">Data Customer</h3>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Admin</a></li>
				<li class="breadcrumb-item active">Customer</li>
			</ol>
		</div>
	</div>
	<!-- row -->
	<div class="card shadow-sm">
		<div class="card-body">
			<h4 class="card-title">Ubah Customer | <?= $customer['kode_cus'] ?></h4>
			<hr>
			<div class="row justify-content-center">
				<div class="col-12 col-lg-8">
					<form method="post">
						<input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
						<div class="form-group">
							<label>Kode Customer</label>
							<input type="text" class="form-control" name="kode_cus" value="<?= $customer['kode_cus'] ?>" readonly>
						</div>
						<div class="form-group">
							<label>Nama</label><span class="text-danger"> *</span>
							<input type="text" class="form-control <?= form_error('nama') ? 'is-invalid' : '' ?>" name="nama" value="<?= $customer['nama'] ?>">
							<div class="invalid-feedback"><?= form_error('nama') ?></div>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="text" class="form-control <?= form_error('email') ? 'is-invalid' : '' ?>" name="email" value="<?= $customer['email'] ?>">
							<div class="invalid-feedback"><?= form_error('email') ?></div>
						</div>
						<div class="form-group">
							<label>No Handphone</label><span class="text-danger"> *</span>
							<input type="text" class="form-control <?= form_error('no_hp') ? 'is-invalid' : '' ?>" name="no_hp" value="<?= $customer['no_hp'] ?>">
							<div class="invalid-feedback"><?= form_error('no_hp') ?></div>
						</div>
						<div class="form-group">
							<label>Alamat</label>
							<input type="text" class="form-control <?= form_error('alamat') ? 'is-invalid' : '' ?>" name="alamat" value="<?= $customer['alamat'] ?>">
							<div class="invalid-feedback"><?= form_error('alamat') ?></div>
						</div>
						<div class="form-group">
							<label>Keterangan Lainnya</label>
							<input type="text" class="form-control <?= form_error('keterangan') ? 'is-invalid' : '' ?>" name="keterangan" value="<?= $customer['keterangan'] ?>">
							<div class="invalid-feedback"><?= form_error('keterangan') ?></div>
						</div>
						<button type="submit" class="btn btn-primary">Ubah</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- row -->
</div>
