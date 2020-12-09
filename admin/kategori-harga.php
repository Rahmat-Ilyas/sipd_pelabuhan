<?php 
require('template/header.php');

$result = mysqli_query($conn, "SELECT * FROM tb_harga");
?>

<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>Kategori Harga Penumpang</small></h3>
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="row">
			<div class="col-md-12 col-sm-12 ">
				<div class="x_panel">
					<div class="x_content">
						<button class="btn btn-primary btn-sm ml-3 mb-3" data-toggle="modal" data-target=".modal-add"><i class="fa fa-plus"></i> Tambah Kategori</button>
						<div class="row">
							<div class="col-sm-12">
								<div class="card-box table-responsive">
									<table id="datatable" class="table table-striped table-bordered" style="width:100%">
										<thead>
											<tr>
												<th style="width: 20px;">No</th>
												<th>Kategori</th>
												<th>Rentang Umur</th>
												<th>Harga</th>
												<th width="150">Aksi</th>
											</tr>
										</thead>
										<tbody>
											<?php $no = 1; foreach ($result as $dta) { ?>
												<tr>
													<td><?= $no; ?></td>
													<td><?= $dta['kategori']; ?></td>
													<td><?= $dta['from_age'].' - '.$dta['to_age']; ?> Tahun</td>
													<td>Rp. <?= $dta['harga']; ?></td>
													<td class="text-center">
														<button class="btn btn-success btn-sm m-0" data-toggle="modal" data-target=".modal-edit<?= $dta['id'] ?>"><i class="fa fa-edit"></i> Edit</button>
														<button class="btn btn-danger btn-sm m-0" data-toggle="modal" data-target=".modal-delete<?= $dta['id'] ?>"><i class="fa fa-trash"></i> Hapus</button>
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

<!-- MODAL TAMBAH -->
<div class="modal modal-add" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myLargeModalLabel">Tambah Kategori Harga</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" method="POST" action="controller.php">
					<div class="item form-group">
						<label class="col-form-label col-md-3 col-sm-3 label-align">Kategori Penumpang</label>
						<div class="col-md-7">
							<input type="text" name="kategori" required="required" class="form-control" placeholder="Kategori Penumpang" autocomplete="off">
						</div>
					</div>
					<div class="item form-group">
						<label class="col-form-label col-md-3 col-sm-3 label-align">Rentang Umur</label>
						<div class="col-md-7 row pr-0">
							<div class="col-md-6">
								<input type="number" name="from_age" required="required" class="form-control" placeholder="Dari Umur" autocomplete="off">
								<span class="form-control-feedback right" aria-hidden="true">Thn</span>
							</div>
							<div class="col-md-6">
								<input type="number" name="to_age" required="required" class="form-control" placeholder="Sampai Umur" autocomplete="off">
								<span class="form-control-feedback right" aria-hidden="true">Thn</span>
							</div>
						</div>
					</div>
					<div class="item form-group">
						<label class="col-form-label col-md-3 col-sm-3 label-align">Harga</label>
						<div class="col-md-7 form-group has-feedback">
							<input type="number" name="harga" class="form-control has-feedback-left" required="required" placeholder="Harga" autocomplete="off">
							<span class="form-control-feedback left" aria-hidden="true">Rp.</span>
						</div>
					</div>
					<div class="ln_solid"></div>
					<div class="item form-group">
						<div class="col-md-6 col-sm-6 offset-md-3">
							<button type="submit" name="add_kategori_pnmpng" class="btn btn-success">Simpan</button>
							<button class="btn btn-primary" type="button" data-dismiss="modal" aria-hidden="true">Batal</button>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>

<?php foreach ($result as $dta) { ?>
	<!-- MODAL EDIT -->
	<div class="modal modal-edit<?= $dta['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myLargeModalLabel">Edit Kategori Harga</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" method="POST" action="controller.php">
						<div class="item form-group">
							<label class="col-form-label col-md-3 col-sm-3 label-align">Kategori Penumpang</label>
							<div class="col-md-7">
								<input type="hidden" name="id" value="<?= $dta['id'] ?>">
								<input type="text" name="kategori" required="required" class="form-control" placeholder="Kategori Penumpang" autocomplete="off" value="<?= $dta['kategori'] ?>">
							</div>
						</div>
						<div class="item form-group">
							<label class="col-form-label col-md-3 col-sm-3 label-align">Rentang Umur</label>
							<div class="col-md-7 row pr-0">
								<div class="col-md-6">
									<input type="number" name="from_age" required="required" class="form-control" placeholder="Dari Umur" autocomplete="off" value="<?= $dta['from_age'] ?>">
									<span class="form-control-feedback right" aria-hidden="true">Thn</span>
								</div>
								<div class="col-md-6">
									<input type="number" name="to_age" required="required" class="form-control" placeholder="Sampai Umur" autocomplete="off" value="<?= $dta['to_age'] ?>">
									<span class="form-control-feedback right" aria-hidden="true">Thn</span>
								</div>
							</div>
						</div>
						<div class="item form-group">
							<label class="col-form-label col-md-3 col-sm-3 label-align">Harga</label>
							<div class="col-md-7 form-group has-feedback">
								<input type="number" name="harga" class="form-control has-feedback-left" required="required" placeholder="Harga" autocomplete="off" value="<?= $dta['harga'] ?>">
								<span class="form-control-feedback left" aria-hidden="true">Rp.</span>
							</div>
						</div>
						<div class="ln_solid"></div>
						<div class="item form-group">
							<div class="col-md-6 col-sm-6 offset-md-3">
								<button type="submit" name="edt_kategori_pnmpng" class="btn btn-success">Simpan</button>
								<button class="btn btn-primary" type="button" data-dismiss="modal" aria-hidden="true">Batal</button>
							</div>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- MODAL HAPUS -->
	<div class="modal modal-delete<?= $dta['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="staticModalLabel">Hapus Data</h5>
				</div>
				<div class="modal-body">
					<p>Yakin ingin menghapus data ini?</p>
				</div>
				<div class="modal-footer form-inline">
					<a href="controller.php?del_kategori_pnmpng=true&id=<?= $dta['id'] ?>" role="button" class="btn btn-danger">Hapus</a>
					<button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
				</div>
			</div>
		</div>
	</div>
<?php }
?>
<?php 
require('template/footer.php');
?>

