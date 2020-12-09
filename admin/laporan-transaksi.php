<?php 
require('template/header.php');

if (isset($_POST['view_data'])) {
	if ($_POST['laporan'] == 'harian') {
		$result = get_data('harian', date('dmy', strtotime($_POST['tanggal'])));
		$title = "Laporan Data Transaksi per Tanggal ".date('d/m/Y', strtotime($_POST['tanggal']));
		$_POST['bulan'] = date('Y-m');
	} else if ($_POST['laporan'] == 'bulanan') {
		$result = get_data('bulanan', date('m', strtotime($_POST['bulan'])));
		$title = "Laporan Data Transaksi per Bulan ".date('m/Y', strtotime($_POST['bulan']));
		$_POST['tanggal'] = date('Y-m-d');
	}
} else {
	$result = get_data('harian', date('dmy'));
	$title = "Laporan Data Transaksi per Tanggal ".date('d/m/Y');
}

function get_data($laporan, $waktu) {
	global $conn;
	$result = [];

	$transaksi = mysqli_query($conn, "SELECT * FROM tb_transaksi WHERE status='Lunas' ORDER BY id DESC");
	foreach ($transaksi as $trs) {
		$kd = $trs['kd_transaksi'];
		$jum_pnmpng = 0;
		$penumpang = mysqli_query($conn, "SELECT * FROM tb_penumpang WHERE kd_pendaftaran='$kd'");
		foreach ($penumpang as $png) {
			$jum_pnmpng = $jum_pnmpng + 1;
			$tanggal_daftar = $png['tanggal_daftar'];
		}
		$user_id = $trs['user_id'];
		$get_user = mysqli_query($conn, "SELECT * FROM tb_users WHERE id='$user_id'");
		$user = mysqli_fetch_assoc($get_user);

		if ($laporan == 'harian') {
			$tgl_daftar = date('dmy', strtotime($tanggal_daftar));
		} else if ($laporan == 'bulanan') {
			$tgl_daftar = date('m', strtotime($tanggal_daftar));
		}

		if ($tgl_daftar == $waktu) {
			$trs['penumpang'] = $jum_pnmpng;
			$trs['tanggal_daftar'] = $tanggal_daftar;
			$trs['nama'] = $user['nama'];
			$result[] = $trs;
		}

	}
	return $result;
}
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
							<div class="col-sm-12">
								<div class="card-box table-responsive">
									<form method="POST">
										<div class="row pl-3">
											<div class="col-md-2 border-right pt-4">
												<span><b>Data Berdasarkan:</b></span>
											</div>
											<div class="col-md-2 form-group">
												<label>Laporan</label>
												<select class="form-control" required="" name="laporan" style="font-size: 12px;" id="laporan">
													<option value="harian">Harian</option>
													<option value="bulanan">Bulanan</option>
												</select>
											</div>
											<div hidden="" class="col-md-2 form-group" id="bulan">
												<label>Bulan</label>
												<input type="month" class="form-control" id="bulan-val" name="bulan" style="font-size: 12px;" value="<?= date('Y-m') ?>" autocomplete="off">
											</div>
											<div class="col-md-2 form-group" id="tanggal">
												<label>Tanggal</label>
												<input type="date" class="form-control" id="tanggal-val" name="tanggal" style="font-size: 12px;" value="<?= date('Y-m-d') ?>" autocomplete="off">
											</div>
											<div class="col-md-2 form-group">
												<label>&nbsp;</label>
												<button type="submit" name="view_data" class="btn btn-primary btn-sm btn-block" style="font-size: 12px;"><i class="fa fa-eye"></i> &nbsp;Tampilkan Data</button>
											</div>
										</div>
									</form>
									<hr>
									<div class="pl-3 mb-2 text-center">
										<h2><?= $title ?></b></h2>
									</div>
									<table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%;">
										<thead>
											<tr>
												<th width="10">No</th>
												<th>Tanggal</th>
												<th width="100">KD Transaksi</th>
												<th>Nama</th>
												<th>Penumpang</th>
												<th>Hatga Tiket</th>
												<th>Kendaraan</th>
												<th>Lainnya</th>
												<th>Total</th>
											</tr>
										</thead>
										<tbody>
											<?php $no = 1; foreach ($result as $dta) { ?>
												<tr>
													<td><?= $no; ?></td>
													<td><?= date('d/m/Y', strtotime($dta['tanggal_daftar'])); ?></td>
													<td><?= $dta['kd_transaksi']; ?></td>
													<td><?= $dta['nama']; ?></td>
													<td><?= $dta['penumpang']; ?> Orang</td>
													<td>Rp. <?= $dta['total_harga_tiket']; ?></td>
													<td>Rp. <?= $dta['biaya_kendaraan']; ?></td>
													<td>Rp. <?= $dta['biaya_lainnya']; ?></td>
													<td>Rp. <?= $dta['total_harga']; ?></td>
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
		$('title').html('<?= $title ?>');

		$('.dt-buttons').find('.btn-default').removeClass('.btn-default').addClass('btn-primary');
		$('.dt-buttons').css('margin-bottom', '10px');
		$('.dataTables_length').css('margin-bottom', '-45px');

		$('#laporan').change(function() {
			var lap = $(this).val();
			if (lap == 'harian') {
				$('#bulan').attr('hidden', '');
				$('#tanggal').removeAttr('hidden');
			} else if (lap == 'bulanan') {
				$('#tanggal').attr('hidden', '');
				$('#bulan').removeAttr('hidden');
			}
		});

		$('#laporan').val("<?= $_POST ? $_POST['laporan'] : 'harian' ?>");
		$('#bulan').val("<?= $_POST ? $_POST['bulan'] : date('Y-m') ?>");
		$('#bulan-val').val("<?= $_POST ? $_POST['bulan'] : date('Y-m') ?>");
		$('#tanggal-val').val("<?= $_POST ? $_POST['tanggal'] : date('Y-m-d') ?>");

		<?php if (isset($_POST['laporan']) && $_POST['laporan'] == 'harian') { ?>
			$('#bulan').attr('hidden', '');
			$('#tanggal').removeAttr('hidden');
		<?php } else if (isset($_POST['laporan']) && $_POST['laporan'] == 'bulanan') { ?>
			$('#tanggal').attr('hidden', '');
			$('#bulan').removeAttr('hidden');
		<?php } ?>
	});
</script>
