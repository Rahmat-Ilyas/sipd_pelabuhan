<?php 
require('template/header.php');

$pengumuman = mysqli_query($conn, "SELECT * FROM tb_pengumuman");
$pgmn = mysqli_fetch_assoc($pengumuman);
?>

<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>Kelola Pengumuman</small></h3>
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="row">
			<div class="col-md-12 col-sm-12 ">
				<div class="x_panel">
					<div class="x_content">
						<div class="row justify-content-center">
							<div class="col-md-6">
								<div class="x_panel">
									<div class="x_title">
										<h2>Pengumuman</small></h2>
										<div class="clearfix"></div>
									</div>
									<div class="x_content">
										<form method="POST" action="controller.php">
											<div class="col-md-12">
												<?php if ($pgmn['judul']) { ?>
													<div id="show-pengumuman">
														<h2 class="mb-1"><?= $pgmn['judul'] ?></h2>
														<span style="font-size: 13px;"><i><?= date('d/m/Y H:i', strtotime($pgmn['waktu'])) ?></i></span>
														<p class="mt-2" style="font-size: 15px;"><?= $pgmn['pengumuman'] ?></p>
													</div>
												<?php } else { ?>
													<h4 class="mt-5 mb-5 text-center" id="show-empty"><b><i>Tidak ada pengumuman yang di buat. Silahkan buat pengumuman baru!</i></b></h4>
												<?php } ?>
												<div hidden="" id="form-pengumuman">
													<div class="form-group">
														<label class="col-form-label">Judul Pengumuman</label>
														<input type="text" class="form-control" required="" placeholder="Judul Pengumuman..." name="judul" autocomplete="off" value="<?= $pgmn['judul'] ?>">
													</div>
													<div class="form-group">
														<label class="col-form-label">Isi Pengumuman</label>
														<textarea class="form-control" name="pengumuman" rows="10" placeholder="Isi Pengumuman"><?= $pgmn['pengumuman'] ?></textarea>
													</div>
												</div>
											</div>
											<div class="clearfix"></div>
											<hr>
											<div class="col-md-12 text-center">
												<?php if ($pgmn['judul']) { ?>
													<div id="update-hapus">
														<a href="#" class="btn btn-danger btn-sm"  data-toggle="modal" data-target=".modal-delete"><i class="fa fa-trash"></i> Hapus</a>
														<a href="#" class="btn btn-primary btn-sm" id="update"><i class="fa fa-edit"></i> Update</a>
													</div>
												<?php } else { ?>
													<div id="buat-baru">
														<a href="#" class="btn btn-info btn-sm" id="buat-pengumuman"><i class="fa fa-plus-circle"></i> Buat Pengumuman</a>
													</div>
												<?php } ?>
												<div hidden="" id="save-batal">
													<a href="#" class="btn btn-secondary btn-sm" id="batal"><i class="fa fa-times-circle"></i> Batal</a>
													<button type="submit" name="save_pengumuman" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Simpan</button>
												</div>
											</div>
										</form>
									</div>
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

<!-- MODAL HAPUS -->
<div class="modal modal-delete" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticModalLabel">Hapus Pengumuman</h5>
			</div>
			<div class="modal-body">
				<p>Yakin ingin menghapus pengumuman?</p>
			</div>
			<div class="modal-footer form-inline">
				<a href="controller.php?delete_pengumuman=true" role="button" class="btn btn-danger btn-sm">Hapus</a>
				<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
			</div>
		</div>
	</div>
</div>

<?php 
require('template/footer.php');
?>

<script>
	$(document).ready(function() {
		$('#update').click(function() {
			$('#show-pengumuman').attr('hidden', '');
			$('#update-hapus').attr('hidden', '');
			$('#form-pengumuman').removeAttr('hidden');
			$('#save-batal').removeAttr('hidden');
		});

		$('#batal').click(function() {
			$('#show-pengumuman').removeAttr('hidden');
			$('#update-hapus').removeAttr('hidden');

			$('#show-empty').removeAttr('hidden');
			$('#buat-baru').removeAttr('hidden');

			$('#form-pengumuman').attr('hidden', '');
			$('#save-batal').attr('hidden', '');
		});

		$('#buat-pengumuman').click(function() {
			$('#show-empty').attr('hidden', '');
			$('#buat-baru').attr('hidden', '');
			$('#form-pengumuman').removeAttr('hidden');
			$('#save-batal').removeAttr('hidden');
		});
	});
</script>

