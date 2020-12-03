<?php 
require('template/header.php');
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
							<div class="tile-stats">
								<div class="icon"><i class="fa fa fa-wpforms"></i>
								</div>
								<div class="count">179</div>

								<h3>Jumlah Pendaftaran</h3>
							</div>
						</div>
						<div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
							<div class="tile-stats">
								<div class="icon"><i class="fa fa-users"></i>
								</div>
								<div class="count">179</div>

								<h3>Total Jumlah Penumpang</h3>
							</div>
						</div>
						<div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
							<div class="tile-stats">
								<div class="icon"><i class="fa fa-bus"></i>
								</div>
								<div class="count">179</div>

								<h3>Jumlah Kendaraan</h3>
							</div>
						</div>
						<div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
							<div class="tile-stats">
								<div class="icon"><i class="fa fa-anchor"></i>
								</div>
								<div class="count">179</div>

								<h3>Jumlah Kapal Sandar</h3>
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
					<h1>Selamat Datang Administrator</h1>
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

