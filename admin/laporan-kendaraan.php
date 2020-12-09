<?php 
require('template/header.php');

if (isset($_POST['view_data'])) {
	if ($_POST['laporan'] == 'harian') {
		$result = get_data($_POST['status'], 'harian', date('dmy', strtotime($_POST['tanggal'])));
		$title = "Laporan Data Kendaraan per Tanggal ".date('d/m/Y', strtotime($_POST['tanggal']));
		$_POST['bulan'] = date('Y-m');
	} else if ($_POST['laporan'] == 'bulanan') {
		$result = get_data($_POST['status'], 'bulanan', date('m', strtotime($_POST['bulan'])));
		$title = "Laporan Data Kendaraan per Bulan ".date('m/Y', strtotime($_POST['bulan']));
		$_POST['tanggal'] = date('Y-m-d');
	}
} else {
	$result = get_data('semua', 'harian', date('dmy'));
	$title = "Laporan Data Kendaraan per Tanggal ".date('d/m/Y');
}

function get_data($status, $laporan, $waktu) {
	global $conn;
	$result = [];
	$kd_trns = [];
	if ($status == 'semua') $status = "status!='Batal'";
	else if ($status == 'panding') $status = "status='Panding'";
	else if ($status == 'selesai') $status = "status='Selesai'";

	$penumpang = mysqli_query($conn, "SELECT * FROM tb_penumpang WHERE ".$status." ORDER BY id DESC");
	foreach ($penumpang as $png) {
		if ($laporan == 'harian') {
			$tgl_daftar = date('dmy', strtotime($png['tanggal_daftar']));
		} else if ($laporan == 'bulanan') {
			$tgl_daftar = date('m', strtotime($png['tanggal_daftar']));
		}

		if ($tgl_daftar == $waktu) {
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
			$res['tanggal_daftar'] = $pnp['tanggal_daftar'];
			$res['tujuan'] = $pnp['tujuan'];
			$res['status'] = $pnp['status'];
			$result[] = $res;
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
												<label>Status</label>
												<select class="form-control" required="" name="status" style="font-size: 12px;" id="status">
													<option value="semua">Semua Data</option>
													<option value="panding">Panding</option>
													<option value="selesai">Selesai</option>
												</select>
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
												<th width="110">Nomor Tiket</th>
												<th width="60">Golongan</th>
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
													<td><?= date('d/m/Y', strtotime($dta['tanggal_daftar'])); ?></td>
													<td><?= $dta['nomor_tiket']; ?></td>
													<td><?= $gol['golongan']; ?></td>
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

		$('#status').val("<?= $_POST ? $_POST['status'] : 'semua' ?>");
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
