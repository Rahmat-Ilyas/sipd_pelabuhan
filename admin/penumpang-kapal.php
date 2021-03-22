<?php 
require('template/header.php');

$get_kapal = mysqli_query($conn, "SELECT * FROM tb_kapal");

$kapal = [];
foreach ($get_kapal as $kpl) {
	$kpl_id = $kpl['id'];
	$penumpang = mysqli_query($conn, "SELECT * FROM tb_penumpang WHERE kapal_id='$kpl_id'");
	$jum_penumpang = mysqli_num_rows($penumpang);
	if ($jum_penumpang > 0) {
		$kpl['total_penumpang'] = $jum_penumpang;
		$kapal[] = $kpl;
	}
}
?>

<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left" style="width: 100%">
				<h3>Riwayat Penumpang Berdasarkan Kapal</small></h3>
			</div>
		</div>

		<div class="clearfix"></div>
		<div class="x_panel">
			<div class="x_content">
				<div class="row">
					<div class="col-sm-12">
						<div class="card-box table-responsive">
							<h2><u>Daftar Kapal</u></h2>
							<div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
								<?php foreach ($kapal as $kpl) {
									$kapal_id = $kpl['id']; 
									$result = mysqli_query($conn, "SELECT * FROM tb_penumpang WHERE kapal_id='$kapal_id' ORDER BY id DESC"); ?>
									<div class="panel">
										<a class="panel-heading" role="tab" id="headingp<?= $kpl['id'] ?>" data-toggle="collapse" data-parent="#accordion" href="#collapsep<?= $kpl['id'] ?>" aria-expanded="true" aria-controls="collapsep<?= $kpl['id'] ?>">
											<h4 class="panel-title"><b><?= $kpl['nama_kapal'] ?> (<?= $kpl['total_penumpang'] ?> Penumpang) - <?= $kpl['keterangan'] ?></b></h4>
										</a>
										<div id="collapsep<?= $kpl['id'] ?>" class="panel-collapse collapse in show" role="tabpanel" aria-labelledby="headingp<?= $kpl['id'] ?>">
											<div class="panel-body pt-2">
												<table id="datatable" class="datatables table table-striped table-bordered" style="width:100%; font-size: 12px;">
													<thead>
														<tr>
															<th width="10">No</th>
															<th>Tanggal</th>
															<th width="90">Nomor Tiket</th>
															<th width="100">Nama</th>
															<th>Umur</th>
															<th>Gender</th>
															<th>Kategori</th>
															<th>Tujuan</th>
															<th>Status</th>
														</tr>
													</thead>
													<tbody>
														<?php $no = 1; foreach ($result as $dta) { ?>
															<tr>
																<td><?= $no; ?></td>
																<td><?= date('d/m/Y', strtotime($dta['tanggal_daftar'])); ?></td>
																<td><?= $dta['nomor_tiket']; ?></td>
																<td>
																	<?= $dta['nama']; ?>
																	<a href="#" class="text-secondary" data-toggle="modal" data-toggle1="tooltip" data-original-title="Detail Penumpang" data-target="#detailUser<?= $dta['id'] ?>"><i class="fa fa-info-circle" style="font-size: 16px;"></i></a>
																</td>
																<td><?= $dta['umur']; ?> Thn</td>
																<td><?= $dta['jenis_kelamin']; ?></td>
																<td><?= $dta['kategori']; ?></td>
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
								<?php } ?>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /page content -->

<?php foreach ($result as $dta) { ?>
	<!-- Modal Detail Penumpang -->
	<div class="modal fade" id="detailUser<?= $dta['id'] ?>" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Detail Penumpang</h5>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<div class="px-5">
						<ul class="list-group list-group-flush">
							<li class="list-group-item row">
								<b class="col-sm-4 p-0">Nama: </b>
								<span class="col-sm-8 p-0"><?= $dta['nama'] ?></span>
							</li>
							<li class="list-group-item row">
								<b class="col-sm-4 p-0">Umur: </b>
								<span class="col-sm-8 p-0"><?= $dta['umur'] ?> Tahun</span>
							</li>
							<li class="list-group-item row">
								<b class="col-sm-4 p-0">Jenis Kelamin: </b>
								<span class="col-sm-8 p-0"><?= $dta['jenis_kelamin'] ?></span>
							</li>
							<li class="list-group-item row">
								<b class="col-sm-4 p-0">Kategori: </b>
								<span class="col-sm-8 p-0"><?= $dta['kategori'] ?></span>
							</li>
							<li class="list-group-item row">
								<b class="col-sm-4 p-0">Alamat: </b>
								<span class="col-sm-8 p-0"><?= $dta['alamat'] ?></span>
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
<?php } ?>

<?php 
require('template/footer.php');
?>

