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
									<label>Kode Barang</label><span class="text-danger"> *</span>
									<input type="text" class="form-control <?= form_error('kode_brg') ? 'is-invalid' : '' ?>" name="kode_brg" value="<?= $kode_brg ?>" readonly>
									<div class="invalid-feedback"><?= form_error('kode_brg') ?></div>
								</div>
								<div class="form-group">
									<label>Nama</label><span class="text-danger"> *</span>
									<input type="text" class="form-control <?= form_error('nama') ? 'is-invalid' : '' ?>" name="nama" value="<?= set_value('nama') ?>">
									<div class="invalid-feedback"><?= form_error('nama') ?></div>
								</div>
								<div class="form-group">
									<label>Jenis</label><span class="text-danger"> *</span>
									<select name="jenis" class="form-control <?= form_error('jenis') ? 'is-invalid' : '' ?>">
										<option value="" disabled selected>Pilih</option>
										<option value="Makanan">Makanan</option>
										<option value="Minuman">Minuman</option>
									</select>
									<div class="invalid-feedback"><?= form_error('jenis') ?></div>
								</div>
							</div>
							<div class="col-12 col-lg-6">
								<div class="form-group">
									<label>Satuan</label>
									<select name="id_satuan" class="form-control <?= form_error('id_satuan') ? 'is-invalid' : '' ?>">
										<option value="" disabled selected>Pilih</option>
										<?php foreach ($satuans as $satuan) : ?>
											<option value="<?= $satuan['id_satuan'] ?>"><?= $satuan['satuan'] ?></option>
										<?php endforeach ?>
									</select>
									<div class="invalid-feedback"><?= form_error('id_satuan') ?></div>
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
	<div class="row">
		<!-- Column -->
		<div class="col-lg-6 col-md-6">
			<div class="card">
				<div class="card-body">
					<div class="d-flex p-10 no-block">
						<div class="align-self-center display-6 m-r-20"><i class="text-success icon-Inbox-Into"></i></div>
						<div class="align-slef-center">
							<h2 class="m-b-0"><?= '4' ?></h2>
							<h6 class="text-muted m-b-0">Barang Masuk</h6>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Column -->
		<!-- Column -->
		<div class="col-lg-6 col-md-6">
			<div class="card">
				<div class="card-body">
					<div class="d-flex p-10 no-block">
						<div class="align-self-center display-6 m-r-20"><i class="text-danger icon-Inbox-Out"></i></div>
						<div class="align-slef-center">
							<h2 class="m-b-0"><?= '4' ?></h2>
							<h6 class="text-muted m-b-0">Barang Keluar</h6>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Column -->
	</div>
	<!-- table responsive -->
	<div class="card shadow-sm">
		<div class="card-body">
			<h4 class="card-title">Data Barang</h4>
			<hr>
			<div class="table-responsive">
				<table id="my-table" class="table display table-bordered table-striped no-wrap">
					<thead>
						<tr>
							<th style="width: 50px;">No</th>
							<th>Kode Barang</th>
							<th>Nama</th>
							<th>Jenis</th>
							<th>Stok</th>
							<th>Satuan</th>
							<th>Keterangan</th>
							<th>Tanggal Dibuat</th>
							<th>Terakhir Diubah</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1;
						foreach ($barangs as $barang) : ?>
							<?php
							$total_stok = $barang['total_stok'];
							if ($barang['total_stok'] < 10) {
								$total_stok = '<div class="btn btn-danger btn-sm">' . $total_stok . '</div>';
							} elseif ($barang['total_stok'] > 10 && $barang['total_stok'] < 20) {
								$total_stok = '<div class="btn btn-warning btn-sm">' . $total_stok . '</div>';
							} elseif ($barang['total_stok'] > 20) {
								$total_stok = '<div class="btn btn-info btn-sm">' . $total_stok . '</div>';
							}
							?>
							<tr>
								<td><?= $no++ ?></td>
								<td><?= $barang['kode_brg'] ?></td>
								<td><?= $barang['nama'] ?></td>
								<td><?= $barang['jenis'] ?></td>
								<td><?= $total_stok ?></td>
								<td><?= $barang['satuan'] ?: '&mdash;' ?></td>
								<td><?= $barang['keterangan'] ?: '&mdash;' ?></td>
								<td><?= $barang['created_at'] ?></td>
								<td><?= $barang['updated_at'] ?></td>
								<td style="text-align: center;">
									<a href="<?= base_url('admin/update_barang/') . $barang['kode_brg'] ?>" class="btn btn-secondary btn-sm">Ubah</a>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
			<div class="mt-2">
				<div class="btn btn-danger"></div> Stok Minim
				<div class="btn btn-warning"></div> Stok Sedang
				<div class="btn btn-info"></div> Stok Banyak
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
