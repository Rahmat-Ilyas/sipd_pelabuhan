<?php 
require('template/header.php');

$result = mysqli_query($conn, "SELECT * FROM tb_penumpang WHERE status!='Batal' ORDER BY id DESC");
?>

<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left" style="width: 100%">
				<h3>Laporan Data Penumpang</small></h3>
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="row">
			<div class="col-md-12 col-sm-12 ">
				<div class="x_panel">
					<div class="x_content">
						<div class="row">
							<div class="col-sm-12 row">
								<input type="text" class="form-control" name="">
							</div>
							<div class="col-sm-12">
								<div class="card-box table-responsive">
									<table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
										<thead>
											<tr>
												<th width="10">No</th>
												<th>Tanggal</th>
												<th width="100">Nomor Tiket</th>
												<th>Nama</th>
												<th>Kategori</th>
												<th>Kapal</th>
												<th>Tujuan</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
											<?php $no = 1; foreach ($result as $dta) { 
												$kapal_id = $dta['kapal_id'];
												$get_kapal = mysqli_query($conn, "SELECT * FROM tb_kapal WHERE id='$kapal_id'");
												$kpl = mysqli_fetch_assoc($get_kapal); ?>
												<tr>
													<td><?= $no; ?></td>
													<td><?= date('d/m/Y', strtotime($dta['tanggal_daftar'])); ?></td>
													<td><?= $dta['nomor_tiket']; ?></td>
													<td><?= $dta['nama']; ?></td>
													<td><?= $dta['kategori']; ?></td>
													<td><?= $kpl['nama_kapal']; ?></td>
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

<?php 
require('template/footer.php');
?>

<script>
	$(document).ready(function($) {
		$('title').html('Laporan Penumpang Pelabuhan Pamatata');
	});
</script>
