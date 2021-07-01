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
			<h4 class="card-title">Buat Supplier</h4>
			<hr>
			<div class="row justify-content-center">
				<div class="col-12">
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
						<div class="row">
							<div class="col-12 col-lg-6">
								<div class="form-group">
									<label>Kode Supplier</label><span class="text-danger"> *</span>
									<input type="text" class="form-control <?= form_error('kode_supp') ? 'is-invalid' : '' ?>" name="kode_supp" value="<?= $kode_supp ?>" readonly>
									<div class="invalid-feedback"><?= form_error('kode_supp') ?></div>
								</div>
								<div class="form-group">
									<label>Nama</label><span class="text-danger"> *</span>
									<input type="text" class="form-control <?= form_error('nama') ? 'is-invalid' : '' ?>" name="nama" value="<?= set_value('nama') ?>">
									<div class="invalid-feedback"><?= form_error('nama') ?></div>
								</div>
								<div class="form-group">
									<label>Email</label>
									<input type="text" class="form-control <?= form_error('email') ? 'is-invalid' : '' ?>" name="email" value="<?= set_value('email') ?>">
									<div class="invalid-feedback"><?= form_error('email') ?></div>
								</div>

							</div>
							<div class="col-12 col-lg-6">
								<div class="form-group">
									<label>No Handphone</label><span class="text-danger"> *</span>
									<input type="text" class="form-control <?= form_error('no_hp') ? 'is-invalid' : '' ?>" name="no_hp" value="<?= set_value('no_hp') ?>">
									<div class="invalid-feedback"><?= form_error('no_hp') ?></div>
								</div>
								<div class="form-group">
									<label>Alamat</label>
									<input type="text" class="form-control <?= form_error('alamat') ? 'is-invalid' : '' ?>" name="alamat" value="<?= set_value('alamat') ?>">
									<div class="invalid-feedback"><?= form_error('alamat') ?></div>
								</div>
								<div class="form-group">
									<label>Keterangan Lainnya</label>
									<input type="text" class="form-control <?= form_error('keterangan') ? 'is-invalid' : '' ?>" name="keterangan" value="<?= set_value('keterangan') ?>">
									<div class="invalid-feedback"><?= form_error('keterangan') ?></div>
								</div>
							</div>
						</div>
						<button type="submit" class="btn btn-primary">Buat</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- row -->
	<!-- table responsive -->
	<div class="card shadow-sm">
		<div class="card-body">
			<h4 class="card-title">Data Supplier</h4>
			<hr>
			<div class="table-responsive">
				<table id="my-table" class="table display table-bordered table-striped no-wrap">
					<thead>
						<tr>
							<th style="width: 50px;">No</th>
							<th>Kode Supplier</th>
							<th>Nama</th>
							<th>Email</th>
							<th>No Handphone</th>
							<th>Alamat</th>
							<th>Keterangan</th>
							<th>Tanggal Dibuat</th>
							<th>Terakhir Diubah</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1;
						foreach ($suppliers as $supplier) : ?>
							<tr>
								<td><?= $no++ ?></td>
								<td><?= $supplier['kode_supp'] ?></td>
								<td><?= $supplier['nama'] ?></td>
								<td><?= $supplier['email'] ?></td>
								<td><?= $supplier['no_hp'] ?></td>
								<td><?= $supplier['alamat'] ?></td>
								<td><?= $supplier['keterangan'] ?></td>
								<td><?= $supplier['created_at'] ?></td>
								<td><?= $supplier['updated_at'] ?></td>
								<td style="text-align: center;">
									<a href="<?= base_url('admin/update_supplier/') . $supplier['id_supp'] ?>" class="btn btn-secondary btn-sm">Ubah</a>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script src="<?= base_url() ?>assets/template/adminwrap/assets/node_modules/jquery/jquery.min.js"></script>
<script>
	$(function() {
		$('#my-table').DataTable({
			"autoWidth": false,
			"columnDefs": [{
				"targets": [-1],
				"className": "text-center",
				"orderable": false,
			}, ],
		})
	})
</script>
