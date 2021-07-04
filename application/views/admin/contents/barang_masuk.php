<div class="container-fluid">
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-themecolor">Data Barang Masuk</h3>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Admin</a></li>
				<li class="breadcrumb-item active">Barang Masuk</li>
			</ol>
		</div>
		<div class="col-md-7 align-self-center text-right">
			<a href="<?= base_url('admin/add_barang_masuk') ?>" class="btn btn-info"><i class="fa fa-plus-circle"></i> Buat Barang Masuk</a>
		</div>
	</div>
	<!-- table responsive -->
	<div class="card shadow-sm">
		<div class="card-body">
			<h4 class="card-title">Data Barang Masuk</h4>
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
							<th>Supplier</th>
							<th>Jumlah Masuk</th>
							<th>Tanggal Masuk</th>
							<th>Keterangan</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1;
						foreach ($barang_masuks as $barang_masuk) : ?>
							<tr>
								<td><?= $no++ ?></td>
								<td>
									<?= $barang_masuk['kode_brg_msk'] ?>
									<div class="d-block">
										<small><a href="<?= base_url('admin/update_barang_masuk/') . $barang_masuk['kode_brg_msk'] ?>">Ubah</a></small>
										|
										<small><a href="<?= base_url('admin/delete_barang_masuk/') . $barang_masuk['kode_brg_msk'] ?>" class="text-danger" onclick="return confirm('Apakah anda yakin ingin menghapus? Jika anda menghapus data ini, stok barang akan ikut berubah.')">Hapus</a></small>
									</div>
								</td>
								<td><?= $barang_masuk['nama_barang'] ?></td>
								<td><?= $barang_masuk['nama_supplier'] ?></td>
								<td><?= $barang_masuk['jml_masuk'] . ' ' . $barang_masuk['satuan'] ?></td>
								<td><?= date('l, d M Y', strtotime($barang_masuk['tgl_masuk'])) ?></td>
								<td><?= $barang_masuk['keterangan_masuk'] ?: '&mdash;' ?></td>
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
