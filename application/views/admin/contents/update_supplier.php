<div class="container-fluid">
	<div class="row page-titles">
		<div class="col-7 col-md-5 align-self-center">
			<h3 class="text-themecolor">Data Supplier</h3>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Admin</a></li>
				<li class="breadcrumb-item active"><?= $this->uri->segment(2) ?></li>
			</ol>
		</div>
	</div>
	<!-- row -->
	<div class="card shadow-sm">
		<div class="card-body">
			<h4 class="card-title">Ubah Supplier | <?= $supplier['kode_supp'] ?></h4>
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
							<label>Kode Supplier</label>
							<input type="text" class="form-control" name="kode_supp" value="<?= $supplier['kode_supp'] ?>" readonly>
						</div>
						<div class="form-group">
							<label>Nama</label><span class="text-danger"> *</span>
							<input type="text" class="form-control <?= form_error('nama') ? 'is-invalid' : '' ?>" name="nama" value="<?= $supplier['nama'] ?>">
							<div class="invalid-feedback"><?= form_error('nama') ?></div>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="text" class="form-control <?= form_error('email') ? 'is-invalid' : '' ?>" name="email" value="<?= $supplier['email'] ?>">
							<div class="invalid-feedback"><?= form_error('email') ?></div>
						</div>
						<div class="form-group">
							<label>No Handphone</label><span class="text-danger"> *</span>
							<input type="text" class="form-control <?= form_error('no_hp') ? 'is-invalid' : '' ?>" name="no_hp" value="<?= $supplier['no_hp'] ?>">
							<div class="invalid-feedback"><?= form_error('no_hp') ?></div>
						</div>
						<div class="form-group">
							<label>Alamat</label>
							<input type="text" class="form-control <?= form_error('alamat') ? 'is-invalid' : '' ?>" name="alamat" value="<?= $supplier['alamat'] ?>">
							<div class="invalid-feedback"><?= form_error('alamat') ?></div>
						</div>
						<div class="form-group">
							<label>Keterangan Lainnya</label>
							<input type="text" class="form-control <?= form_error('keterangan') ? 'is-invalid' : '' ?>" name="keterangan" value="<?= $supplier['keterangan'] ?>">
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
