<?php 
require('template/header.php');

$get_kapal = mysqli_query($conn, "SELECT * FROM tb_kapal");
?>

<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>Kelola Jadwal Keberangkatan</small></h3>
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="row justify-content-center">
			<div class="col-md-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Jadwal Keberangkatan</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<?php foreach ($get_kapal as $kpl) {
							$option = '';
							$status = ['Sandar', 'Berangkat', 'Tidak Beroprasi'];
							foreach ($status as $sts) {
								if ($sts == $kpl['status']) $option .= '<option value="'.$sts.'" selected>'.$sts.'</option>';
								else $option .= '<option value="'.$sts.'">'.$sts.'</option>';
							} ?>
							<form method="POST" action="controller.php">
								<div class="x_panel">
									<div class="x_content">
										<div class="row">
											<div class="col-md-2 border-right pt-4">
												<span><b><?= $kpl['nama_kapal'] ?></b></span>
												<input type="hidden" name="kapal_id" value="<?= $kpl['id'] ?>">
											</div>
											<div class="col-md-10 row">
												<div class="col-md-2 form-group">
													<label>Status</label>
													<select class="form-control" required="" name="status" style="font-size: 12px;">
														<?= $option ?>
													</select>
												</div>
												<div class="col-md-3 form-group">
													<label>Tujuan</label>
													<input type="text" class="form-control" name="tujuan" style="font-size: 12px;" value="<?= $kpl['tujuan'] ?>" placeholder="Tujuan..." autocomplete="off">
												</div>
												<div class="col-md-3 form-group">
													<label>Tanggal Berangkat</label>
													<input type="date" class="form-control" name="tanggal" style="font-size: 12px;" value="<?= $kpl['waktu_berangkat'] ? date('Y-m-d', strtotime($kpl['waktu_berangkat'])) : '' ?>" placeholder="Tujuan...">
												</div>
												<div class="col-md-2 form-group">
													<label>Jam</label>
													<input type="time" class="form-control" name="jam" style="font-size: 12px;" value="<?= $kpl['waktu_berangkat'] ? date('H:i', strtotime($kpl['waktu_berangkat'])) : '' ?>" placeholder="Tujuan...">
												</div>
												<div class="col-md-2 form-group">
													<label>&nbsp;</label>
													<button type="submit" name="update_jadwal" class="btn btn-primary btn-sm btn-block" style="font-size: 12px;"><i class="fa fa-refresh"></i> Update Jawal</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</form>
						<?php } ?>
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
	$(document).ready(function() {

	});
</script>

