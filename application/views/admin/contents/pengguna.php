<div class="container-fluid">
	<div class="row page-titles">
		<div class="col-7 col-md-5 align-self-center">
			<h3 class="text-themecolor">Data Pengguna/Admin</h3>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Admin</a></li>
				<li class="breadcrumb-item active"><?= $this->uri->segment(2) ?></li>
			</ol>
		</div>
	</div>
	<!-- row -->
	<div class="card shadow-sm">
		<div class="card-body">
			<h4 class="card-title">Buat Pengguna/Admin</h4>
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
									<label>Nama</label>
									<input type="text" class="form-control <?= form_error('nama') ? 'is-invalid' : '' ?>" name="nama" value="<?= set_value('nama') ?>">
									<div class="invalid-feedback"><?= form_error('nama') ?></div>
								</div>
								<div class="form-group">
									<label>Username</label><span class="text-danger"> *</span>
									<input type="text" class="form-control <?= form_error('username') ? 'is-invalid' : '' ?>" name="username" value="<?= set_value('username') ?>">
									<div class="invalid-feedback"><?= form_error('username') ?></div>
								</div>
								<div class="form-group">
									<label>Password</label><span class="text-danger"> *</span>
									<input type="password" class="form-control <?= form_error('password') ? 'is-invalid' : '' ?>" name="password" value="<?= set_value('password') ?>">
									<div class="invalid-feedback"><?= form_error('password') ?></div>
								</div>
							</div>
							<div class="col-12 col-lg-6">
								<div class="form-group">
									<label>Email</label>
									<input type="text" class="form-control <?= form_error('email') ? 'is-invalid' : '' ?>" name="email" value="<?= set_value('email') ?>">
									<div class="invalid-feedback"><?= form_error('email') ?></div>
								</div>
								<div class="form-group">
									<label>No Handphone</label>
									<input type="text" class="form-control <?= form_error('no_hp') ? 'is-invalid' : '' ?>" name="no_hp" value="<?= set_value('no_hp') ?>">
									<div class="invalid-feedback"><?= form_error('no_hp') ?></div>
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
			<h4 class="card-title">Data Pengguna/Admin</h4>
			<hr>
			<div class="table-responsive">
				<table id="my-table" class="table display table-bordered table-striped no-wrap">
					<thead>
						<tr>
							<th style="width: 50px;">No</th>
							<th>Nama</th>
							<th>Username</th>
							<th>Email</th>
							<th>No Handphone</th>
							<th>Tanggal Dibuat</th>
							<th>Terakhir Diubah</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1;
						foreach ($penggunas as $pengguna) : ?>
							<tr>
								<td><?= $no++ ?></td>
								<td><?= $pengguna['nama'] ?: '&mdash;' ?></td>
								<td><?= $pengguna['username'] ?></td>
								<td><?= $pengguna['email'] ?: '&mdash;' ?></td>
								<td><?= $pengguna['no_hp'] ?: '&mdash;' ?></td>
								<td><?= $pengguna['created_at'] ?></td>
								<td><?= $pengguna['updated_at'] ?></td>
								<td style="text-align: center;">
									<?php if ($this->session->userdata('id') == $pengguna['id']) : ?>
										<a href="<?= base_url('admin/update_satuan/') . $pengguna['id'] ?>" class="btn btn-secondary btn-sm">Ubah</a>
									<?php endif ?>
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
			"responsive": true,
			"columnDefs": [{
				"targets": [-1],
				"className": "text-center",
				"orderable": false,
			}, ],
		})
	})
</script>
