<?php 
require('template/header.php');

$result = mysqli_query($conn, "SELECT * FROM tb_penumpang WHERE status!='Batal' ORDER BY id DESC");
?>

<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left" style="width: 100%">
				<h3>Data Penumpang Yang Terdaftar di Sistem</small></h3>
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
									<table id="datatable" class="table table-striped table-bordered" style="width:100%; font-size: 13px;">
										<thead>
											<tr>
												<th width="10">No</th>
												<th width="100">Nomor Tiket</th>
												<th>Nama</th>
												<th>Umur</th>
												<th>Gender</th>
												<th>Kategori</th>
												<th>Kapal</th>
												<th>Tujuan</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
											<?php $no = 1; foreach ($result as $dta) { 
												$tgl_daftar = $dta['tanggal_daftar'];
												$tgl_sekrng = date('Y-m-d H:i:s');

												if (strtotime($tgl_daftar) + 86400 > strtotime($tgl_sekrng)) {
													$kapal_id = $dta['kapal_id'];
													$get_kapal = mysqli_query($conn, "SELECT * FROM tb_kapal WHERE id='$kapal_id'");
													$kpl = mysqli_fetch_assoc($get_kapal); ?>
													<tr>
														<td><?= $no; ?></td>
														<td><?= $dta['nomor_tiket']; ?></td>
														<td>
															<?= $dta['nama']; ?>
															<a href="#" class="text-secondary" data-toggle="modal" data-toggle1="tooltip" data-original-title="Detail Penumpang" data-target="#detailUser<?= $dta['id'] ?>"><i class="fa fa-info-circle" style="font-size: 16px;"></i></a>
														</td>
														<td><?= $dta['umur']; ?> Thn</td>
														<td><?= $dta['jenis_kelamin']; ?></td>
														<td><?= $dta['kategori']; ?></td>
														<td>
															<?php 
															if (isset($kpl['nama_kapal'])) echo $kpl['nama_kapal'];
															else echo '<i>-Data kapal tidak ada-</i>';
															?>
														</td>
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
												}
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
	$tgl_daftar = $dta['tanggal_daftar'];
	$tgl_sekrng = date('Y-m-d H:i:s');

	if (strtotime($tgl_daftar) + 86400 > strtotime($tgl_sekrng)) { ?>
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
	<?php }
} ?>

<?php 
require('template/footer.php');
?>

