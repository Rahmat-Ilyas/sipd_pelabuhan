<?php 
require('template/header.php');

$pesan_masuk = mysqli_query($conn, "SELECT * FROM tb_pesan ORDER BY id DESC");
?>

<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>Pesan Masuk</small></h3>
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="row">
			<div class="col-md-12 col-sm-12 ">
				<div class="x_panel">
					<div class="x_content">
						<div class="row justify-content-center">
							<div class="col-md-9">
								<div class="x_panel">
									<div class="x_title">
										<h2>Kotak Masuk</h2>
										<div class="clearfix"></div>
									</div>
									<div class="x_content">
										<div class="row">
											<div class="col-sm-5 mail_list_column">
												<?php foreach ($pesan_masuk as $psn) {
													if (date('dmy') == date('dmy', strtotime($psn['waktu']))) {
														$waktu = date('h:i A', strtotime($psn['waktu']));
													} else {
														$waktu = date('d M y', strtotime($psn['waktu']));
													}
													if ($psn['status'] == 'send') { ?>
														<a href="pesan-masuk.php?read=<?= $psn['id'] ?>">
															<div class="mail_list">
																<div class="right">
																	<h3><?= $psn['nama'] ?><span class="badge bg-danger text-white" style="position: absolute; margin-top: -4px;">New</span>
																		<small><?= $waktu ?></small>
																	</h3>
																	<p><?= $psn['email'] ?></p>
																</div>
															</div>
														</a>
													<?php } else { ?>
														<a href="pesan-masuk.php?read=<?= $psn['id'] ?>">
															<div class="mail_list">
																<div class="right">
																	<h3><?= $psn['nama'] ?> <small><?= $waktu ?></small></h3>
																	<p><?= $psn['email'] ?></p>
																</div>
															</div>
														</a>
													<?php }
												} ?>
											</div>
											<!-- /MAIL LIST -->

											<!-- CONTENT MAIL -->
											<div class="col-sm-7 mail_view">
												<div class="inbox-body">
													<?php if ($read) { ?>
														<div class="mail_heading row">
															<div class="col-md-12 text-right">
																<p class="date"><?= date('i:s A d M Y', strtotime($read['waktu'])) ?></p>
															</div>
															<div class="col-md-12">
																<h4>Dari: <?= $read['nama'] ?> (<?= $read['email'] ?>)</h4>
															</div>
														</div>
														<div class="view-mail">
															<p><?= $read['pesan'] ?></p>
														</div>
													<?php } else { ?>
														<h4 class="mt-3 text-center"><i>Silahkan pilih pesan yang inigin dibaca</i></h4>
													<?php } ?>
												</div>

											</div>
											<!-- /CONTENT MAIL -->
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
</div>
<!-- /page content -->

<?php 
require('template/footer.php');
?>

