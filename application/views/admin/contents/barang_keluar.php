<div class="container-fluid">
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-themecolor">Data Barang Keluar</h3>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Admin</a></li>
				<li class="breadcrumb-item active">Barang <?= $this->uri->segment(2) ?></li>
			</ol>
		</div>
		<div class="col-md-7 align-self-center text-right">
			<button type="button" class="btn btn-info"><i class="fa fa-plus-circle"></i> Buat Barang Keluar</button>
		</div>
	</div>
	<!-- table responsive -->
	<div class="card shadow-sm">
		<div class="card-body">
			<h4 class="card-title">Data Barang Keluar</h4>
			<hr>
			<div class="table-responsive">
				<table id="my-table" class="table display table-bordered table-striped no-wrap">
					<thead>
						<tr>
							<th style="width: 50px;">No</th>
							<th>Kode Transaksi</th>
							<th>Barang</th>
							<th>Jumlah Keluar</th>
							<th>Tanggal Keluar</th>
							<th>Keterangan</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1;
						foreach ($barang_keluars as $barang_keluar) : ?>
							<tr>
								<td><?= $no++ ?></td>
								<td><?= $barang_keluar['kode_brg_msk'] ?></td>
								<td><?= $barang_keluar['kode_brg'] ?></td>
								<td><?= $barang_keluar['jumlah_keluar'] ?></td>
								<td><?= $barang_keluar['tanggal_keluar'] ?></td>
								<td><?= $barang_keluar['keterangan'] ?></td>
								<td style="text-align: center;">
									<?php if ($this->session->userdata('id') == $barang_keluar['id_brg_msk']) : ?>
										<a href="<?= base_url('admin/update_satuan/') . $barang_keluar['id_brg_msk'] ?>" class="btn btn-secondary btn-sm">Ubah</a>
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
