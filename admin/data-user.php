<?php 
require('template/header.php');

$result = mysqli_query($conn, "SELECT * FROM tb_users");
?>

<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>Data User Pelabuhan Pamatata</small></h3>
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
									<table id="datatable" class="table table-striped table-bordered" style="width:100%">
										<thead>
											<tr>
												<th style="width: 20px;">No</th>
												<th style="min-width: 120px;">Nama</th>
												<th>Umur</th>
												<th>Alamat</th>
												<th>Jenis Kelamin</th>
												<th>Telepon</th>
												<th>Email</th>
											</tr>
										</thead>
										<tbody>
											<?php $no = 1; foreach ($result as $dta) { ?>
												<tr>
													<td><?= $no; ?></td>
													<td><?= $dta['nama']; ?></td>
													<td><?= $dta['umur']; ?></td>
													<td><?= $dta['alamat']; ?></td>
													<td><?= $dta['jenis_kelamin']; ?></td>
													<td><?= $dta['telepon']; ?></td>
													<td><?= $dta['email']; ?></td>
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

