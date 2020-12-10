<?php 
require('template/header.php');

$jum_penumpang = 0;
$jum_kendaraan = 0;
$trs = null;
if (isset($_GET['find_code'])) {
	$kd = $_GET['find_code'];

	if (isset($_GET['cetak'])) {
		$query_pn = "SELECT * FROM tb_penumpang WHERE kd_pendaftaran='$kd' AND status='Selesai'";
		$query_tr = "SELECT * FROM tb_transaksi WHERE kd_transaksi='$kd' AND status='Lunas'";
	} else {
		$query_pn = "SELECT * FROM tb_penumpang WHERE kd_pendaftaran='$kd' AND status='Panding'";
		$query_tr = "SELECT * FROM tb_transaksi WHERE kd_transaksi='$kd' AND status='Belum Lunas'";

	}

	$penumpang = mysqli_query($conn, $query_pn);
	foreach ($penumpang as $pn) {
		$jum_penumpang = $jum_penumpang + 1;
		$tanggal = $pn['tanggal_daftar'];
	}


	$transaksi = mysqli_query($conn, $query_tr);
	$trs = mysqli_fetch_assoc($transaksi);

	if ($trs) {
		$kendaraan = mysqli_query($conn, "SELECT * FROM tb_kendaraan WHERE kd_pendaftaran='$kd'");
		foreach ($kendaraan as $kn) {
			$jum_kendaraan = $jum_kendaraan + 1;
		}
		$user_id = $trs['user_id'];
		$get_user = mysqli_query($conn, "SELECT * FROM tb_users WHERE id='$user_id'");
		$user = mysqli_fetch_assoc($get_user);
		$trs['nama'] = $user['nama'];
		$trs['penumpang'] = $jum_penumpang;
		$trs['kendaraan'] = $jum_kendaraan;
		$trs['tanggal'] = date('d/m/Y', strtotime($tanggal));
	}
}

?>

<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>Halaman Transaksi Pembayaran</small></h3>
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="row justify-content-center">
			<div class="col-md-6">
				<div class="x_panel">
					<div class="x_title">
						<h2>Transaksi</small></h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<form method="GET">
							<div class=" row px-2">
								<div class="col-md-9 form-group">
									<label>Kode Pendaftaran</label>
									<input type="text" class="form-control" name="find_code" style="font-size: 12px;" value="<?= $_GET ? $_GET['find_code'] : 'REG-' ?>">
									<?php if (isset($_GET['find_code']) && !$trs): ?>
										<span class="text-danger"><i>Kode Pendaftaran tidak berlaku</i></span>
									<?php endif ?>
								</div>
								<div class="col-md-3 form-group">
									<label>&nbsp;</label>
									<button type="submit" class="btn btn-primary btn-sm btn-block" style="font-size: 12px;"><i class="fa fa-search"></i> &nbsp;Temukan</button>
								</div>
							</div>
						</form>
						<span class="px-2">Tanggal: <?= date('d/m/Y') ?></span>
						<hr>
						<div class="px-5" style="margin-top: -10px;">
							<ul class="list-group list-group-flush">
								<li class="list-group-item row">
									<b class="col-sm-5 p-0">Nama </b>
									<span class="col-sm-7 p-0">
										: <?= $trs ? $trs['nama'] : '--' ?>
									</span>
								</li>
								<li class="list-group-item row">
									<b class="col-sm-5 p-0">Jumlah Penumpang </b>
									<span class="col-sm-7 p-0">
										: <?= $trs ? $trs['penumpang'].' Orang' : '--' ?>
									</span>
								</li>
								<li class="list-group-item row">
									<b class="col-sm-5 p-0">Jumlah Kendaraan </b>
									<span class="col-sm-7 p-0">
										: <?= $trs ? $trs['kendaraan'].' Unit' : '--' ?>
									</span>
								</li>
								<li class="list-group-item row">
									<b class="col-sm-5 p-0">Total Harga Tiket </b>
									<span class="col-sm-7 p-0">
										: <?= $trs ? 'Rp. '.$trs['total_harga_tiket'] : '--' ?>
									</span>
								</li>
								<li class="list-group-item row">
									<b class="col-sm-5 p-0">Harga Kendaraan </b>
									<span class="col-sm-7 p-0">
										: <?= $trs ? 'Rp. '.$trs['biaya_kendaraan'] : '--' ?>
									</span>
								</li>
								<li class="list-group-item row">
									<b class="col-sm-5 p-0">Total Bayar </b>
									<span class="col-sm-7 p-0">
										: <?= $trs ? 'Rp. '.$trs['total_harga'] : '--' ?>
									</span>
								</li>
							</ul>
						</div>
						<hr>
						<div class="text-center">
							<?php if ($trs) { ?>
								<button type="button" class="btn btn-info btn-sm" id="cetak-transaksi"><i class="fa fa-print"></i> Cetak Detai Transaksi</button>
								<?php if (!isset($_GET['cetak'])) { ?>
									<button type="button" class="btn btn-success btn-sm" id="selesai-transaksi"><i class="fa fa-check"></i> Selesaikan Reservasi</button>
								<?php } ?>
							<?php } else { ?>
								<button type="button" class="btn btn-info btn-sm" disabled=""><i class="fa fa-print"></i> Cetak Detai Transaksi</button>
								<button type="button" class="btn btn-success btn-sm" disabled=""><i class="fa fa-check"></i> Selesaikan Reservasi</button>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="x_panel">
					<div class="x_title">
						<h2>Data Tiket Penumpang</small></h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<?php if ($jum_penumpang > 0) {
							foreach ($penumpang as $pen) { ?>
								<div class="row border mb-2">
									<div class="col-sm-4 border-right pt-2 mr-3">
										<span>Nomor Tiket:</span>
										<h4><b><?= $pen['nomor_tiket'] ?></b></h4>
									</div>
									<div class="col-sm-8 row invoice-col pt-2 pr-0">
										<address>
											<strong><?= $pen['nama'] ?> (<?= $pen['jenis_kelamin'] ?>)</strong>
											<br><strong><?= $pen['kategori'] ?> (<?= $pen['umur'] ?>)</strong>
											<br><?= $pen['alamat'] ?>
										</address>
										<div class="col-sm-12 text-right">
											<button type="button" class="btn btn-info btn-sm tiket-penumpang" data-id="<?= $pen['id'] ?>"><i class="fa fa-print"></i> Cetak Tiket</button>
										</div>
									</div>
								</div>
							<?php }
						} else { ?>
							<div class="row border mb-2">
								<div class="col-sm-4 border-right pt-2 mr-3">
									<span>Nomor Tiket:</span>
									<h4><b>---- --- -------</b></h4>
								</div>
								<div class="col-sm-8 row">
									<div class="col-sm-12 text-center pt-4 pb-4">
										<h2 class="text-center"><i>Tidak ada data penumpang</i></h2>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
				<div class="x_panel">
					<div class="x_title">
						<h2>Data Tiket Kendaraan</small></h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<?php if ($jum_kendaraan > 0) {
							foreach ($kendaraan as $ken) {
								$gol_id = $ken['golongan_id'];
								$golongan = mysqli_query($conn, "SELECT * FROM tb_golongan WHERE id='$gol_id'");
								$gol = mysqli_fetch_assoc($golongan); ?>
								<div class="row border mb-2">
									<div class="col-sm-4 border-right pt-2 mr-3">
										<span>Nomor Tiket:</span>
										<h4><b><?= $ken['nomor_tiket'] ?></b></h4>
									</div>
									<div class="col-sm-8 row invoice-col pt-2 pr-0">
										<address>
											<strong><?= $gol['golongan'] ?> (<?= $gol['jenis_kendaraan'] ?>)</strong>
											<br><strong><?= $ken['merek_kendaraan'] ?> (<?= $ken['nomor_kendaraan'] ?>)</strong>
											<br>Supir/Pengendara: <?= $ken['nama_sopir'] ?>
										</address>
										<div class="col-sm-12 text-right">
											<button type="button" class="btn btn-info btn-sm tiket-kendaraan"><i class="fa fa-print"></i> Cetak Tiket</button>
										</div>
									</div>
								</div>

							<?php }
						} else { ?>
							<div class="row border mb-2">
								<div class="col-sm-4 border-right pt-2 mr-3">
									<span>Nomor Tiket:</span>
									<h4><b>---- --- -------</b></h4>
								</div>
								<div class="col-sm-8 row">
									<div class="col-sm-12 text-center pt-4 pb-4">
										<h2 class="text-center"><i>Tidak ada data kendaraan</i></h2>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
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

		<?php if ($jum_kendaraan > 0) {
			foreach ($kendaraan as $ken) {
				$gol_id = $ken['golongan_id'];
				$golongan = mysqli_query($conn, "SELECT * FROM tb_golongan WHERE id='$gol_id'");
				$gol = mysqli_fetch_assoc($golongan);
				$kd_dftr = $ken['kd_pendaftaran'];
				$get_penumpang = mysqli_query($conn, "SELECT * FROM tb_penumpang WHERE kd_pendaftaran='$kd_dftr'");
				$pnp = mysqli_fetch_assoc($get_penumpang);
				$get_transaksi = mysqli_query($conn, "SELECT * FROM tb_transaksi WHERE kd_transaksi='$kd_dftr'");
				$trns = mysqli_fetch_assoc($get_transaksi);
				$kpl_id = $ken['kapal_id'];
				$get_kapal = mysqli_query($conn, "SELECT * FROM tb_kapal WHERE id='$kpl_id'");
				$kpl = mysqli_fetch_assoc($get_kapal); ?>
				<div hidden="" class="kendaraan-area px-2">
					<div class="border row">
						<div class="col-md-8 row justify-content-center mr-2" style="border-right: dashed; width: 60%;">
							<div class="col-sm-12 row">
								<div class="col-md-6" style="width: 50%;">
									<h3><i>Tiket Pamatata</i></h3>
								</div>
								<div class="col-md-6 text-right" style="width: 50%;">
									<h2><?= $ken['nomor_tiket'] ?></h2>
								</div>
							</div>
							<div class="col-sm-12 text-center mt-2">
								<h2><b>Pelabuhan Pamatata - <?= $pnp['tujuan'] ?></b></h2>
								<h2><b><?= $gol['golongan'] ?> (<?= $gol['jenis_kendaraan'] ?>)</b></h2>
								<h2><b><?= date('d M Y', strtotime($pnp['tanggal_daftar'])) ?> / <?= $kpl['nama_kapal'] ?></b></h2>
							</div>
							<div class="col-sm-8" style="width: 80%;">
								<h6><?= $ken['merek_kendaraan'] ?> (<?= $ken['nama_sopir'] ?>)</h6>
								<h6>Rp. <?= $trns['biaya_kendaraan'] ?></h6>
								<h6>NET: Rp. <?= $trns['biaya_kendaraan'] ?></h6>
								<h6>Tanggal Pembelian: <?= date('d/m/Y', strtotime($pnp['tanggal_daftar'])) ?></h6>
							</div>
							<div class="col-sm-12 mt-4">
								<span>Pamatata, Kec. Bontomatene, Kab. Selayar, Sul-Sel</span>
								<br><span>pamatata.port@gmail.com</span>
								<br><span>+62821-9131-2813</span>
							</div>
						</div>
						<div class="col-md-4 pt-5" style="width: 40%;">
							<h6><b>Nomor Tiket:</b> <?= $ken['nomor_tiket'] ?></h6>
							<h6><b>Merek:</b> <?= $ken['merek_kendaraan'] ?></h6>
							<h6><b>Supir/Pengendara:</b> <?= $ken['nama_sopir'] ?></h6>
							<h6><b>Golongan:</b> <?= $gol['golongan'] ?> (<?= $gol['jenis_kendaraan'] ?>)</h6>
							<h6><b>Tanggal:</b> <?= date('d/m/Y', strtotime($pnp['tanggal_daftar'])) ?></h6>
							<h6><b>Tujuan:</b> Pelabuhan Pamatata - <?= $pnp['tujuan'] ?></h6>
							<h6><b>Harga:</b> Rp. <?= $trns['biaya_kendaraan'] ?></h6>
							<div class="pt-5 mt-5">
								<span>Pamatata, Kec. Bontomatene, Kab. Selayar, Sul-Sel</span>
								<br><span>pamatata.port@gmail.com</span>
								<br><span>+62821-9131-2813</span>
							</div>
						</div>
					</div>
				</div>
			<?php }
		} ?>

		<div hidden="" class="transaksi-area px-5">
			<div class="border row justify-content-center" style="width: 60%; font-size: 20px;">
				<div class="col-md-12 text-center" style="border-bottom: 2px dashed;">
					<h2>Pelabuhan Pamatata Selayar</h2>
					<h2>Pamatata, Kec. Bontomatene, Kab. Selayar, Sul-Sel</h2>
					<h2>pamatata.port@gmail.com (Telp: +62821-9131-2813)</h2>
				</div>
				<div class="col-sm-8 mt-4 pb-3" style="width: 80%; border-bottom: 2px dashed;">
					<h6 class="row">
						<b class="col-sm-4" style="width: 40%;">Tanggal</b> 
						<span class="col-sm-8" style="width: 60%;">: <?= $trs ? $trs['tanggal'] : '--' ?></span>
					</h6>
					<h6 class="row">
						<b class="col-sm-4" style="width: 40%;">No Faktur</b> 
						<span class="col-sm-8" style="width: 60%;">: <?= $trs ? $trs['kd_transaksi'] : '--' ?></span>
					</h6>
					<h6 class="row">
						<b class="col-sm-4" style="width: 40%;">Jumlah Penumpang</b> 
						<span class="col-sm-8" style="width: 60%;">: <?= $trs ? $trs['penumpang'].' Orang' : '--' ?></span>
					</h6>
					<h6 class="row">
						<b class="col-sm-4" style="width: 40%;">Jumlah Kendaraan:</b> 
						<span class="col-sm-8" style="width: 60%;">: <?= $trs ? $trs['kendaraan'].' Unit' : '--' ?></span>
					</h6>
				</div>
				<div class="col-sm-8 mt-4 pb-3" style="width: 80%; border-bottom: 2px dashed;">
					<h6 class="row">
						<b class="col-sm-4" style="width: 40%;">Total Harga Tiket</b> 
						<span class="col-sm-8" style="width: 60%;">: <?= $trs ? 'Rp. '.$trs['total_harga_tiket'] : '--' ?></span>
					</h6>
					<h6 class="row">
						<b class="col-sm-4" style="width: 40%;">Harga Kendaraan</b> 
						<span class="col-sm-8" style="width: 60%;">: <?= $trs ? 'Rp. '.$trs['biaya_kendaraan'] : '--' ?></span>
					</h6>
					<h6 class="row">
						<b class="col-sm-4" style="width: 40%;">Total Bayar</b> 
						<span class="col-sm-8" style="width: 60%;">: <?= $trs ? 'Rp. '.$trs['total_harga'] : '--' ?></span>
					</h6>
				</div>
				<div class="col-sm-8 mt-2 text-center" style="width: 80%;">
					<h6>Terimakasih, semoga selamat sampai tujuan</h6>
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
	$(document).ready(function() {
		$(document).on('click', '#cetak-transaksi', function(e) {
			e.preventDefault();
			$('.transaksi-area').printArea();
		});

		$(document).on('click', '.tiket-kendaraan', function(e) {
			e.preventDefault();
			$('.kendaraan-area').printArea();
		});

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

		$('#selesai-transaksi').click(function() {
			swal({
				title: "Selesaikan Transaksi?",
				html: "Yakin ingin menyelesaikan transaksi ini!",
				type: "warning",
				showCancelButton: true,
				confirmButtonText: 'Selesaikan',
				preConfirm: () => {
					location.href = "controller.php?transaksi_selesai=true&kd_transaksi=<?= $trs ? $trs['kd_transaksi'] : '' ?>";
				}
			});
		});
	});
</script>

