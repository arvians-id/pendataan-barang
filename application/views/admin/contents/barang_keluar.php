<div class="container-fluid">
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-themecolor">Data Barang Keluar</h3>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Admin</a></li>
				<li class="breadcrumb-item active">Barang Keluar</li>
			</ol>
		</div>
		<div class="col-md-7 align-self-center text-right">
			<a href="<?= base_url('admin/add_barang_keluar') ?>" class="btn btn-info"><i class="fa fa-plus-circle"></i> Buat Barang Keluar</a>
		</div>
	</div>
	<!-- table responsive -->
	<div class="card shadow-sm">
		<div class="card-body">
			<h4 class="card-title">Data Barang Keluar</h4>
			<hr>
			<div class="table-responsive">
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
				<table id="my-table" class="table display table-bordered table-striped no-wrap">
					<thead>
						<tr>
							<th style="width: 50px;">No</th>
							<th>Kode Transaksi</th>
							<th>Barang</th>
							<th>Tujuan Customer</th>
							<th>Jumlah Keluar</th>
							<th>Tanggal Keluar</th>
							<th>Keterangan</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1;
						foreach ($barang_keluars as $barang_keluar) : ?>
							<tr>
								<td><?= $no++ ?></td>
								<td>
									<?= $barang_keluar['kode_brg_klr'] ?>
									<div class="d-block">
										<small><a href="<?= base_url('admin/update_barang_keluar/') . $barang_keluar['kode_brg_klr'] ?>">Ubah</a></small>
										|
										<small><a href="<?= base_url('admin/delete_barang_keluar/') . $barang_keluar['kode_brg_klr'] ?>" class="text-danger" onclick="return confirm('Apakah anda yakin ingin menghapus? Jika anda menghapus data ini, stok barang akan ikut berubah.')">Hapus</a></small>
									</div>
								</td>
								<td><?= $barang_keluar['nama_barang'] ?></td>
								<td><?= $barang_keluar['nama_customer'] ?></td>
								<td><?= $barang_keluar['jml_keluar'] . ' ' . $barang_keluar['satuan'] ?></td>
								<td><?= date('l, d M Y', strtotime($barang_keluar['tgl_keluar'])) ?></td>
								<td><?= $barang_keluar['keterangan_keluar'] ?: '&mdash;' ?></td>
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
