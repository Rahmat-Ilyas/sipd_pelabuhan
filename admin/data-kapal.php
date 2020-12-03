<?php 
require('template/header.php');

$result = mysqli_query($conn, "SELECT * FROM tb_kapal");
?>

<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>Kelola Data Kapal</small></h3>
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="row">
			<div class="col-md-12 col-sm-12 ">
				<div class="x_panel">
					<div class="x_content">
						<button class="btn btn-primary btn-sm ml-3 mb-3" data-toggle="modal" data-target=".modal-add"><i class="fa fa-plus"></i> Tambah Data Kapal</button>
						<div class="row">
							<div class="col-sm-12">
								<div class="card-box table-responsive">
									<table id="datatable" class="table table-striped table-bordered" style="width:100%">
										<thead>
											<tr>
												<th style="width: 20px;">No</th>
												<th>Nama Kapal</th>
												<th>Harga</th>
												<th>Keterangan</th>
												<th width="150">Aksi</th>
											</tr>
										</thead>
										<tbody>
											<?php $no = 1; foreach ($result as $dta) { ?>
												<tr>
													<td><?= $no; ?></td>
													<td><?= $dta['nama_kapal']; ?></td>
													<td>Rp. <?= $dta['harga']; ?></td>
													<td><?= $dta['keterangan']; ?></td>
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
				<h4 class="modal-title" id="myLargeModalLabel">Tambah Data Kapal</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" method="POST" action="controller.php">
					<div class="item form-group">
						<label class="col-form-label col-md-3 col-sm-3 label-align">Nama Kapal</label>
						<div class="col-md-7">
							<input type="text" name="nama_kapal" required="required" class="form-control" placeholder="Nama Kapal" autocomplete="off">
						</div>
					</div>
					<div class="item form-group">
						<label class="col-form-label col-md-3 col-sm-3 label-align">Harga</label>
						<div class="col-md-7 form-group has-feedback">
							<input type="number" name="harga" class="form-control has-feedback-left" required="required" placeholder="Harga" autocomplete="off">
							<span class="form-control-feedback left" aria-hidden="true">Rp.</span>
						</div>
					</div>
					<div class="item form-group">
						<label class="col-form-label col-md-3 col-sm-3 label-align">Keterangan</label>
						<div class="col-md-7">
							<textarea class="form-control" name="keterangan" required="" placeholder="Keterangan"></textarea>
						</div>
					</div>
					<div class="ln_solid"></div>
					<div class="item form-group">
						<div class="col-md-6 col-sm-6 offset-md-3">
							<button type="submit" name="tambah_kapal" class="btn btn-success">Simpan</button>
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
					<h4 class="modal-title" id="myLargeModalLabel">Edit Data Kapal</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" method="POST" action="controller.php">
						<div class="item form-group">
							<label class="col-form-label col-md-3 col-sm-3 label-align">Nama Kapal</label>
							<div class="col-md-7">
								<input type="hidden" name="id" value="<?= $dta['id'] ?>">
								<input type="text" name="nama_kapal" required="required" class="form-control" placeholder="Nama Kapal" autocomplete="off" value="<?= $dta['nama_kapal'] ?>">
							</div>
						</div>
						<div class="item form-group">
							<label class="col-form-label col-md-3 col-sm-3 label-align">Harga</label>
							<div class="col-md-7 form-group has-feedback">
								<input type="number" name="harga" class="form-control has-feedback-left" required="required" placeholder="Harga" autocomplete="off" value="<?= $dta['harga'] ?>">
								<span class="form-control-feedback left" aria-hidden="true">Rp.</span>
							</div>
						</div>
						<div class="item form-group">
							<label class="col-form-label col-md-3 col-sm-3 label-align">Keterangan</label>
							<div class="col-md-7">
								<textarea class="form-control" name="keterangan" required="" placeholder="Keterangan"><?= $dta['keterangan'] ?></textarea>
							</div>
						</div>
						<div class="ln_solid"></div>
						<div class="item form-group">
							<div class="col-md-6 col-sm-6 offset-md-3">
								<button type="submit" name="edit_kapal" class="btn btn-success">Simpan</button>
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
                <a href="controller.php?delete_kapal=true&id=<?= $dta['id'] ?>" role="button" class="btn btn-danger">Hapus</a>
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

