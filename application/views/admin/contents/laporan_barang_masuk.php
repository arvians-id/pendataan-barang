<div class="container-fluid">
	<div class="row page-titles">
		<div class="col-7 col-md-5 align-self-center">
			<h3 class="text-themecolor">Laporan</h3>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Admin</a></li>
				<li class="breadcrumb-item active">Laporan Barang Masuk</li>
			</ol>
		</div>
	</div>
	<!-- row -->
	<div class="card shadow-sm">
		<div class="card-body">
			<h4 class="card-title">Buat Laporan Barang Masuk</h4>
			<hr>
			<?php if ($this->session->flashdata('success')) : ?>
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<?= $this->session->flashdata('success') ?>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			<?php elseif ($this->session->flashdata('error')) : ?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<?= $this->session->flashdata('error') ?>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			<?php endif; ?>
			<div class="row justify-content-center">
				<div class="col-12 col-lg-8">
					<form method="post">
						<input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
						<div class="form-group">
							<label>Dari</label><span class="text-danger"> *</span>
							<input type="date" class="form-control <?= form_error('awal') ? 'is-invalid' : '' ?>" name="awal" value="<?= set_value('awal') ?>">
							<div class="invalid-feedback"><?= form_error('awal') ?></div>
						</div>
						<div class="form-group">
							<label>Sampai</label><span class="text-danger"> *</span>
							<input type="date" class="form-control <?= form_error('akhir') ? 'is-invalid' : '' ?>" name="akhir" value="<?= set_value('akhir') ?>">
							<div class="invalid-feedback"><?= form_error('akhir') ?></div>
						</div>
						<button type="submit" class="btn btn-primary">Buat</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- row -->
</div>
