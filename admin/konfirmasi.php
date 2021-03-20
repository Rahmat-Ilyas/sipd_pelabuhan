<?php 
require('template/header.php');

$result = [];
$transaksi = mysqli_query($conn, "SELECT * FROM tb_transaksi WHERE status='Belum Lunas'");
foreach ($transaksi as $dta) {
	if ($dta['foto_transaksi'] != NULL) {
		$result[] = $dta;
	}
}

?>

<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left" style="width: 100%">
				<h3>Konfirmasi Pembayaran (Via Transfer)</small></h3>
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
												<th style="min-width: 120px;">Nama</th>
												<th>KD Pendaftaran</th>
												<th>Penumpang</th>
												<th>Kendaraan</th>
												<th>Kapal</th>
												<th>Tujuan</th>
												<th>Transaksi</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											<?php $no = 1; foreach ($result as $dta) { 
												$kd_daftar = $dta['kd_transaksi'];
												$orang = 0;
												$kendaraan = 0;
												$penumpang = mysqli_query($conn, "SELECT * FROM tb_penumpang WHERE kd_pendaftaran='$kd_daftar'");
												foreach ($penumpang as $pn) {
													$orang = $orang + 1;
													$user_id = $pn['user_id'];
													$tanggal = $pn['tanggal_daftar'];
													$tujuan = $pn['tujuan'];
													$kapal_id = $pn['kapal_id'];
													$status = $pn['status'];
												} 
												$user = mysqli_query($conn, "SELECT * FROM tb_users WHERE id='$user_id'");
												$usr = mysqli_fetch_assoc($user);

												$get_kendaraan = mysqli_query($conn, "SELECT * FROM tb_kendaraan WHERE kd_pendaftaran='$kd_daftar'");
												foreach ($get_kendaraan as $kn) {
													$kendaraan = $kendaraan + 1;
												}

												$get_kapal = mysqli_query($conn, "SELECT * FROM tb_kapal WHERE id='$kapal_id'");
												$kapal = mysqli_fetch_assoc($get_kapal); ?>
												<tr>
													<td><?= $no; ?></td>
													<td>
														<?= $usr['nama']; ?>
														<a href="#" class="text-secondary" data-toggle="modal" data-toggle1="tooltip" data-original-title="Detail User" data-target="#detailUser<?= $dta['id'] ?>"><i class="fa fa-info-circle" style="font-size: 16px;"></i></a>
													</td>
													<td><?= $dta['kd_transaksi']; ?></td>
													<td>
														<?= $orang ?> Orang
														<a href="#" class="text-secondary" data-toggle="modal" data-toggle1="tooltip" data-original-title="Detail Penumpang" data-target="#detailPenumpang<?= $dta['id'] ?>"><i class="fa fa-info-circle" style="font-size: 16px;"></i></a>
													</td>
													<td>
														<?= $kendaraan ?> Unit
														<a href="#" class="text-secondary" data-toggle="modal" data-toggle1="tooltip" data-original-title="Detail Kendaraan" data-target="#detailKendaraan<?= $dta['id'] ?>"><i class="fa fa-info-circle" style="font-size: 16px;"></i></a>
													</td>
													<td>
														<?php 
														if (isset($kapal['nama_kapal'])) echo $kapal['nama_kapal'];
														else echo '<i>-Data kapal tidak ada-</i>';
														?>
													</td>
													<td><?= $tujuan ?></td>
													<td>Rp. <?= $dta['total_harga']; ?></td>
													<td>
														<a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#konfirPembayaran<?= $dta['id'] ?>" data-toggle1="tooltip" data-original-title="Proses Pembayaran" style="font-size: 11px;"><i class="fa fa-hourglass-2"></i> Proses Pembayaran</a>
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
	$kd_daftar = $dta['kd_transaksi'];
	$orang = 0;
	$kendaraan = 0;
	$penumpang = mysqli_query($conn, "SELECT * FROM tb_penumpang WHERE kd_pendaftaran='$kd_daftar'");
	foreach ($penumpang as $pn) {
		$orang = $orang + 1;
		$user_id = $pn['user_id'];
		$tanggal = $pn['tanggal_daftar'];
		$tujuan = $pn['tujuan'];
		$kapal_id = $pn['kapal_id'];
		$status = $pn['status'];
	}

	$user = mysqli_query($conn, "SELECT * FROM tb_users WHERE id='$user_id'");
	$usr = mysqli_fetch_assoc($user);

	$get_kendaraan = mysqli_query($conn, "SELECT * FROM tb_kendaraan WHERE kd_pendaftaran='$kd_daftar'");
	foreach ($get_kendaraan as $kn) {
		$kendaraan = $kendaraan + 1;
	}

	$get_kapal = mysqli_query($conn, "SELECT * FROM tb_kapal WHERE id='$kapal_id'");
	$kapal = mysqli_fetch_assoc($get_kapal);
	?>
	<!-- Modal Konfirmasi -->
	<div class="modal fade" id="konfirPembayaran<?= $dta['id'] ?>" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Konfirmasi Pembayaran</h5>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<ul class="list-group list-group-flush mb-3">
						<li class="list-group-item row">
							<b class="col-sm-4 p-0">Kode Pendaftaran: </b>
							<span class="col-sm-8 p-0"><?= $dta['kd_transaksi'] ?></span>
						</li>
						<li class="list-group-item row">
							<b class="col-sm-4 p-0">Nama: </b>
							<span class="col-sm-8 p-0"><?= $usr['nama'] ?></span>
						</li>
					</ul>
					<h5 class="text-center"><u>Foto Bukti Pembayaran</u></h5>
					<img src="images/transaksi/transaksi.png" style="width: 95%; height: 350px;">
					<div class="px-5">
						<hr>
						<div class="text-center">
							<a href="controller.php?proses_pembayaran=accept&id=<?= $dta['id'] ?>" role="button" class="btn btn-sm btn-success"><i class="fa fa-check-circle"></i> Konfirmasi Pembayaran</a>
							<a href="controller.php?proses_pembayaran=refuse&id=<?= $dta['id'] ?>" role="button" class="btn btn-sm btn-danger"><i class="fa fa-times-circle"></i> Tolak Pembayaran</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Modal Detail User -->
	<div class="modal fade" id="detailUser<?= $dta['id'] ?>" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Detail User</h5>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<div class="px-5">
						<ul class="list-group list-group-flush">
							<li class="list-group-item row">
								<b class="col-sm-4 p-0">Nama: </b>
								<span class="col-sm-8 p-0"><?= $usr['nama'] ?></span>
							</li>
							<li class="list-group-item row">
								<b class="col-sm-4 p-0">Jenis Kelamin: </b>
								<span class="col-sm-8 p-0"><?= $usr['jenis_kelamin'] ?></span>
							</li>
							<li class="list-group-item row">
								<b class="col-sm-4 p-0">Umur: </b>
								<span class="col-sm-8 p-0"><?= $usr['umur'] ?> Tahun</span>
							</li>
							<li class="list-group-item row">
								<b class="col-sm-4 p-0">Alamat: </b>
								<span class="col-sm-8 p-0"><?= $usr['alamat'] ?></span>
							</li>
							<li class="list-group-item row">
								<b class="col-sm-4 p-0">Telepon: </b>
								<span class="col-sm-8 p-0"><?= $usr['telepon'] ?></span>
							</li>
							<li class="list-group-item row">
								<b class="col-sm-4 p-0">Email: </b>
								<span class="col-sm-8 p-0"><?= $usr['email'] ?></span>
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

	<!-- Modal Detail Penumpang -->
	<div class="modal fade" id="detailPenumpang<?= $dta['id'] ?>" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Detail Penumpang</h5>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<table id="datatable" class="table table-striped table-bordered" style="width:100%; font-size: 14px;">
						<thead>
							<tr>
								<th width="150">Nomor Tiket</th>
								<th width="150">Nama</th>
								<th width="90">Umur</th>
								<th>Alamat</th>
								<th>Gender</th>
								<th>Kategori</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($penumpang as $pnpng) { ?>
								<tr>
									<td><?= $pnpng['nomor_tiket']; ?></td>
									<td><?= $pnpng['nama']; ?></td>
									<td><?= $pnpng['umur']; ?> Tahun</td>
									<td><?= $pnpng['alamat']; ?></td>
									<td><?= $pnpng['jenis_kelamin']; ?></td>
									<td><?= $pnpng['kategori']; ?></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal Detail Kendaraan -->
	<div class="modal fade" id="detailKendaraan<?= $dta['id'] ?>" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Detail Kendaraan</h5>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<table id="datatable" class="table table-striped table-bordered" style="width:100%; font-size: 14px;">
						<thead>
							<tr>
								<th width="150">Nomor Tiket</th>
								<th width="100">Golongan</th>
								<th width="100">Jenis</th>
								<th>Nama Sopir</th>
								<th>Merek</th>
								<th width="110">Nomor Plat</th>
							</tr>
						</thead>
						<tbody>
							<?php $gol_id = null; foreach ($get_kendaraan as $kend) { 
								$gol_id = $kend['golongan_id'];
								$golongan = mysqli_query($conn, "SELECT * FROM tb_golongan WHERE id='$gol_id'");
								$gol = mysqli_fetch_assoc($golongan);
								?>
								<tr>
									<td><?= $kend['nomor_tiket']; ?></td>
									<td><?= $gol['golongan']; ?></td>
									<td><?= $gol['jenis_kendaraan']; ?></td>
									<td><?= $kend['nama_sopir']; ?></td>
									<td><?= $kend['merek_kendaraan']; ?></td>
									<td><?= $kend['nomor_kendaraan']; ?></td>
								</tr>
							<?php } if (empty($gol_id)) { ?>
								<tr>
									<td colspan="6" class="text-center">Tidak ada kendaraan</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
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

<script>
	$(document).ready(function($) {
		<?php if (isset($_GET['find_code'])) { ?>
			$('#konfirPembayaran<?= $_GET['find_code'] ?>').modal('show');
		<?php } ?>
	});
</script>