<div class="container-fluid">
	<div class="row page-titles">
		<div class="col-7 col-md-5 align-self-center">
			<h3 class="text-themecolor">Data Satuan Barang</h3>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Admin</a></li>
				<li class="breadcrumb-item active">Satuan</li>
			</ol>
		</div>
	</div>
	<!-- row -->
	<div class="card shadow-sm">
		<div class="card-body">
			<h4 class="card-title">Ubah Satuan Barang</h4>
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
							<label>Nama Satuan</label><span class="text-danger"> *</span>
							<input type="text" class="form-control <?= form_error('satuan') ? 'is-invalid' : '' ?>" name="satuan" value="<?= $satuan['satuan'] ?>">
							<div class="invalid-feedback"><?= form_error('satuan') ?></div>
						</div>
						<button type="submit" class="btn btn-primary">Ubah</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- row -->
</div>
