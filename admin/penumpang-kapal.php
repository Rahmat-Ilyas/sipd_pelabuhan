<?php 
require('template/header.php');

$results = mysqli_query($conn, "SELECT * FROM tb_penumpang");
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
															<th>Aksi</th>
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
																<td>
																	<?php if ($dta['status'] == 'Selesai') { ?>
																		<a href="" class="btn btn-primary btn-sm tiket-penumpang" data-id="<?= $dta['id'] ?>"><i class="fa fa-print"></i> Cetak Tiket</a>
																	<?php } else { ?>
																		<a href="#" class="btn btn-primary btn-sm dont-proses"><i class="fa fa-print"></i> Cetak Tiket</a>
																	<?php } ?>
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

<?php foreach ($results as $dta) { ?>
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

<div hidden="" class="penumpang-area px-2">
	<div class="border row">
		<div class="col-md-8 row justify-content-center mr-2" style="border-right: dashed; width: 60%;">
			<div class="col-sm-12 row">
				<div class="col-md-6" style="width: 50%;">
					<h3><i>Tiket Pamatata</i></h3>
				</div>
				<div class="col-md-6 text-right" style="width: 50%;">
					<h2 id="nomor_tiket"></h2>
				</div>
			</div>
			<div class="col-sm-12 text-center mt-2">
				<h2><b>Pelabuhan Pamatata - <span id="tujuan"></span></b></h2>
				<h2><b><span id="kategori"></span> (<span id="umur"></span>)</b></h2>
				<h2><b><span id="tanggal1"></span> / <span id="kapal"></span></b></h2>
			</div>
			<div class="col-sm-8" style="width: 80%;">
				<h6><span id="nama"></span> (<span id="jenis_kelamin"></span>)</h6>
				<h6>Rp. <span id="harga1"></span></h6>
				<h6>NET: Rp. <span id="harga2"></span></h6>
				<h6>Tanggal Pembelian: <span id="tanggal2"></span></h6>
			</div>
			<div class="col-sm-12 mt-4">
				<span>Pamatata, Kec. Bontomatene, Kab. Selayar, Sul-Sel</span>
				<br><span>pamatata.port@gmail.com</span>
				<br><span>+62821-9131-2813</span>
			</div>
		</div>
		<div class="col-md-4 pt-5" style="width: 40%;">
			<h6><b>Nomor Tiket:</b> <span id="re_nomor_tiket"></span></h6>
			<h6><b>Nama:</b> <span id="re_nama"></span> (<span id="re_jenis_kelamin"></span>)</h6>
			<h6><b>Kategori:</b> <span id="re_kategori"></span></h6>
			<h6><b>Tanggal:</b> <span id="re_tanggal2"></span></h6>
			<h6><b>Tujuan:</b> Pelabuhan Pamatata - <span id="re_tujuan"></span></h6>
			<h6><b>Harga:</b> Rp. <span id="re_harga1"></span></h6>
			<div class="pt-5 mt-5">
				<span>Pamatata, Kec. Bontomatene, Kab. Selayar, Sul-Sel</span>
				<br><span>pamatata.port@gmail.com</span>
				<br><span>+62821-9131-2813</span>
			</div>
		</div>
	</div>
</div>

<?php 
require('template/footer.php');
?>

<script>
	$(document).ready(function() {
		$(document).on('click', '.tiket-penumpang', function(e) {
			e.preventDefault();
			var id = $(this).attr('data-id');

			$.ajax({
				url     : 'controller.php',
				method  : "POST",
				data    : { set_print: true, id: id },
				success : function(data) {
					$.each(data, function(key, val) {
						$('#'+key).text(val);
						$('#re_'+key).text(val);
					});

					$('.penumpang-area').printArea();
				}
			});
		});

		$('.dont-proses').click(function(e){
			e.preventDefault();
			swal({
				title: "Tidak Dapat Diproses",
				html: "Tiket tidakdapat dicetak, penumpang tidak/belum menyelesaikan transaksi",
				type: "warning",
			});
		});
	});
</script>

