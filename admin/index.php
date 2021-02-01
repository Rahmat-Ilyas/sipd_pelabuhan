<?php 
require('template/header.php');

$penumpang = mysqli_query($conn, "SELECT * FROM tb_penumpang WHERE status!='Batal'");
$get_jum_kapal = mysqli_query($conn, "SELECT * FROM tb_kapal WHERE status='Sandar'");
$jumlah_kapal = mysqli_num_rows($get_jum_kapal);

$jumlah_penumpang = 0;
$kd_pendaftaran = [];
foreach ($penumpang as $dta) {
	$tggl_now = date('dmy');
	$tggl_dftr = date('dmy', strtotime($dta['tanggal_daftar']));
	if ($tggl_dftr == $tggl_now) {
		$jumlah_penumpang = $jumlah_penumpang + 1;
		$kd_pendaftaran[] = $dta['kd_pendaftaran'];
	}
}
$jumlah_pendaftar = count(array_unique($kd_pendaftaran));
$jumlah_kendaraan = 0;
foreach (array_unique($kd_pendaftaran) as $kd) {
	$get_kendaraan = mysqli_query($conn, "SELECT * FROM tb_kendaraan WHERE kd_pendaftaran='$kd'");
	if (mysqli_fetch_assoc($get_kendaraan)) {
		$jumlah_kendaraan = $jumlah_kendaraan + 1;
	}
}
?>
<!-- page content -->
<div class="right_col" role="main">
	<div class="page-title">
		<div class="title_left">
			<h3>Dashboard</h3>
		</div>
	</div>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-md-12">
			<div class="">
				<div class="x_content">
					<div class="row">
						<div class="col-md-12 text-right mb-2">
							<div class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
								<i class="fa fa-calendar"></i>
								<span><?= date('d F Y') ?></span> <b class="caret"></b>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
							<div class="tile-stats" style="background: #1ABB9C">
								<div class="icon"><i class="fa fa fa-wpforms text-white"></i>
								</div>
								<div class="count text-white"><?= $jumlah_pendaftar ?></div>

								<h3 class="text-white">Jumlah Pendaftaran</h3>
							</div>
						</div>
						<div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
							<div class="tile-stats" style="background: #1ABB9C">
								<div class="icon"><i class="fa fa-users text-white"></i>
								</div>
								<div class="count text-white"><?= $jumlah_penumpang ?></div>

								<h3 class="text-white">Total Jumlah Penumpang</h3>
							</div>
						</div>
						<div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
							<div class="tile-stats" style="background: #1ABB9C">
								<div class="icon"><i class="fa fa-bus text-white"></i>
								</div>
								<div class="count text-white"><?= $jumlah_kendaraan ?></div>

								<h3 class="text-white">Jumlah &nbsp; Kendaraan</h3>
							</div>
						</div>
						<div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
							<div class="tile-stats" style="background: #1ABB9C">
								<div class="icon"><i class="fa fa-anchor text-white"></i>
								</div>
								<div class="count text-white"><?= $jumlah_kapal ?></div>

								<h3 class="text-white">Jumlah Kapal Sandar</h3>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12 col-sm-12 ">
			<div class="bs-example" data-example-id="simple-jumbotron">
				<div class="jumbotron bg-primary text-white">
					<h1>Selamat Datang <?= $admin['nama'] ?></h1>
					<span style="font-size: 16px;">Selamat datang di halaman Admin Pengolahan Data Penumpang Pelabuha Pamatata Selayar. Semoga harimu menyenagkan</span>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /page content -->

<?php 
require('template/footer.php');
?>

