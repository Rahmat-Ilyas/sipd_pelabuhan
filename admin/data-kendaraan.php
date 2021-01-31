<?php 
require('template/header.php');

$result = [];
$kd_trns = [];
$get_penumpang = mysqli_query($conn, "SELECT * FROM tb_penumpang WHERE status!='Batal' ORDER BY id DESC");
foreach ($get_penumpang as $png) {
	$tgl_daftar = $png['tanggal_daftar'];
	$tgl_sekrng = date('Y-m-d H:i:s');

	if (strtotime($tgl_daftar) + 86400 > strtotime($tgl_sekrng)) {
		$kd_trns[] = $png['kd_pendaftaran'];
	}
}

foreach (array_unique($kd_trns) as $kd) {
	$kendaraan = mysqli_query($conn, "SELECT * FROM tb_kendaraan WHERE kd_pendaftaran='$kd'");
	$res = mysqli_fetch_assoc($kendaraan);
	if ($res) {
		$kpl_id = $res['kapal_id'];
		$kapal = mysqli_query($conn, "SELECT * FROM tb_kapal WHERE id='$kpl_id'");
		$kpl = mysqli_fetch_assoc($kapal);
		$penumpang = mysqli_query($conn, "SELECT * FROM tb_penumpang WHERE kd_pendaftaran='$kd'");
		$pnp = mysqli_fetch_assoc($penumpang);
		$res['nama_kapal'] = $kpl['nama_kapal'];
		$res['tujuan'] = $pnp['tujuan'];
		$res['status'] = $pnp['status'];
		$result[] = $res;
	}
}

?>

<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left" style="width: 100%">
				<h3>Data Kendaraan</small></h3>
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="row">
			<div class="col-md-12 col-sm-12 ">
				<div class="x_panel">
					<div class="x_content">
						<div class="row">
							<div class="col-sm-12">
								<div class="card-box table-responsive">
									<table id="datatable" class="table table-striped table-bordered" style="width:100%; font-size: 12px;">
										<thead>
											<tr>
												<th width="10">No</th>
												<th width="90">Nomor Tiket</th>
												<th width="70">Golongan</th>
												<th>Sopir</th>
												<th>Merek</th>
												<th width="60">Plat</th>
												<th>Kapal</th>
												<th>Tujuan</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
											<?php $no = 1; foreach ($result as $dta) {
												$gol_id = $dta['golongan_id'];
												$golongan =   mysqli_query($conn, "SELECT * FROM tb_golongan WHERE id='$gol_id'");
												$gol = mysqli_fetch_assoc($golongan); ?>
												<tr>
													<td><?= $no; ?></td>
													<td><?= $dta['nomor_tiket']; ?></td>
													<td>
														<?= $gol['golongan']; ?>
														<a href="#" class="text-secondary" data-toggle="modal" data-toggle1="tooltip" data-original-title="Detail Kendaraan" data-target="#detailGolongan<?= $dta['id'] ?>"><i class="fa fa-info-circle" style="font-size: 16px;"></i></a>
													</td>
													<td><?= $dta['nama_sopir']; ?></td>
													<td><?= $dta['merek_kendaraan']; ?></td>
													<td><?= $dta['nomor_kendaraan']; ?></td>
													<td><?= $dta['nama_kapal']; ?></td>
													<td><?= $dta['tujuan']; ?></td>
													<td class="text-center">
														<?php 
														if ($dta['status'] == 'Selesai') $color = 'success'; 
														else if ($dta['status'] == 'Panding') $color = 'warning'; 
														else if ($dta['status'] == 'Batal') $color = 'danger'; 
														?>
														<span class="badge badge-pill badge-<?= $color ?>"><?= $dta['status'] ?></span>
													</td>
												</tr>
												<?php $no = $no + 1; 
											} ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /page content -->

<?php foreach ($result as $dta) {
	$gol_id = $dta['golongan_id'];
	$golongan =   mysqli_query($conn, "SELECT * FROM tb_golongan WHERE id='$gol_id'");
	$gol = mysqli_fetch_assoc($golongan); ?>
	<!-- Modal Detail Golongan -->
	<div class="modal fade" id="detailGolongan<?= $dta['id'] ?>" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Detail Golongan</h5>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<div class="px-5">
						<ul class="list-group list-group-flush">
							<li class="list-group-item row">
								<b class="col-sm-5 p-0">Nomor Golongan: </b>
								<span class="col-sm-7 p-0"><?= $gol['golongan'] ?></span>
							</li>
							<li class="list-group-item row">
								<b class="col-sm-5 p-0">Jenis Kendaraan: </b>
								<span class="col-sm-7 p-0"><?= $gol['jenis_kendaraan'] ?></span>
							</li>
							<li class="list-group-item row">
								<b class="col-sm-5 p-0">Harga: </b>
								<span class="col-sm-7 p-0">Rp. <?= $gol['harga'] ?></span>
							</li>
							<li class="list-group-item row">
								<b class="col-sm-5 p-0">Keterangan: </b>
								<span class="col-sm-7 p-0"><?= $gol['keterangan'] ?></span>
							</li>
						</ul>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<?php 
} ?>

<?php 
require('template/footer.php');
?>

