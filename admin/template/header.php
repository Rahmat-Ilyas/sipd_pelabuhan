<?php 
require('../config.php');

if (!isset($_SESSION['login_admin'])) {
  header("location: login.php");
}

// Read Pesan
$read = null;
if (isset($_GET['read'])) {
  $id = $_GET['read'];
  mysqli_query($conn, "UPDATE tb_pesan SET status='read' WHERE id='$id'");
  $read_pesan = mysqli_query($conn, "SELECT * FROM tb_pesan WHERE id='$id'");
  $read = mysqli_fetch_assoc($read_pesan);
}

$get_admin = mysqli_query($conn, "SELECT * FROM tb_admin");
$admin = mysqli_fetch_assoc($get_admin);

$get_pesan = mysqli_query($conn, "SELECT * FROM tb_pesan WHERE status='send'");
$jumlah_pesan = mysqli_num_rows($get_pesan);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="images/anchor.png" type="image/ico" />

  <title>Admin SIPDP Pelabuhan Pamatata</title>

  <!-- Bootstrap -->
  <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- iCheck -->
  <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">

  <!-- bootstrap-progressbar -->
  <link href="vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
  <!-- jQuery custom content scroller -->
  <link href="vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>

  <!-- JQVMap -->
  <link href="vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
  <!-- bootstrap-daterangepicker -->
  <link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

  <!-- Datatables -->  
  <link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
  <link href="vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
  <link href="vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
  <link href="vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="build/css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col menu_fixed">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="../index.php" class="site_title"><i class="fa fa-anchor"></i> <span>Pamatata Port</span></a>
          </div>

          <div class="clearfix"></div>
          <br />
          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <ul class="nav side-menu">
                <li><a href="index.php"><i class="fa fa-home"></i> Dashboard</a></li>
                <li>
                  <a href="transaksi.php"><i class="fa fa-calculator"></i> Transaksi Pembayaran</a>
                </li>
                <li>
                  <a href="data-pendaftar.php"><i class="fa fa-wpforms"></i> Data Pendaftar</a>
                </li>
                <li><a><i class="fa fa-users"></i> Data Penumpang<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="penumpang-terdaftar.php">Penumpang Terdaftar</a></li>
                    <li><a href="riwayat-penumpang.php">Riwayat Penumpang</a></li>
                  </ul>
                </li>
                <li><a><i class="fa fa-bus"></i> Data Kendaraan<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="data-kendaraan.php">Kendaraan Terdaftar</a></li>
                    <li><a href="riwayat-kendaraan.php">Riwayat Kendaraan</a></li>
                  </ul>
                </li>
                <li><a><i class="fa fa-database"></i> Kelola Data <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="data-kapal.php">Data Kapal</a></li>
                    <li><a href="golongan-kendaraan.php">Golongan Kendaraan</a></li>
                    <li><a href="kategori-harga.php">Kategori Harga Penumpang</a></li>
                    <li><a href="data-user.php">Data User</a></li>
                  </ul>
                </li>
                <li><a><i class="fa fa-info"></i> Kelola Informasi <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="jadwal-keberangkatan.php">Jadwal Keberangkatan</a></li>
                    <li><a href="pengumuman.php">Pengumuman</a></li>
                  </ul>
                </li>
                <li>
                  <a href="pesan-masuk.php">
                    <i class="fa fa-envelope"></i>
                    <?php if ($jumlah_pesan > 0): ?>
                      <span class="badge bg-danger" style="position: absolute; margin-left: -15px; margin-top: -4px;"><?= $jumlah_pesan ?></span>                      
                    <?php endif ?>
                    <span>Pesan Masuk</span>
                  </a>
                </li>
                <li><a><i class="fa fa-file-text-o"></i>Laporan <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="laporan-penumpang.php">Laporan Data Penumpang</a></li>
                    <li><a href="laporan-kendaraan.php">Laporan Data Kendaraan</a></li>
                    <li><a href="fixed_footer.html">Laporan Transaksi</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
          <!-- /sidebar menu -->
        </div>
      </div>

      <!-- top navigation -->
      <div class="top_nav">
        <div class="nav_menu">
          <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
          </div>
          <nav class="nav navbar-nav">
            <ul class=" navbar-right">
              <li class="nav-item dropdown open" style="padding-left: 15px;">
                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                  <img src="images/admin.png" alt=""><?= $admin['nama'] ?>
                </a>
                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item"  href="javascript:;" data-toggle="modal" data-target="#editProfil"> Profile</a>
                  <a class="dropdown-item"  href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                </div>
              </li>
            </ul>
          </nav>
        </div>
      </div>
      <!-- /top navigation -->
      
      <!-- Modal Edit Profil -->
      <div class="modal fade" id="editProfil" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Update Profil</h5>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form method="POST" action="controller.php">
              <div class="modal-body">
                <div class="container px-5">
                  <div class="form-group">
                    <label class="col-form-label">Nama</label>
                    <input type="hidden" name="id" value="<?= $admin['id'] ?>">
                    <input type="text" class="form-control" required="" placeholder="Nama..." name="nama" autocomplete="off" value="<?= $admin['nama'] ?>">
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Username</label>
                    <input type="username" class="form-control" required="" placeholder="Username..." name="username" autocomplete="off" value="<?= $admin['username'] ?>">
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Password</label>
                    <input type="text" class="form-control" placeholder="Ganti Password..." name="password" autocomplete="off" value="">
                    <input type="hidden" name="old_password" value="<?= $admin['password'] ?>">
                    <span class="text-info" style="font-size: 14px">Note: Masukkan password baru untuk mengganti password</span>
                  </div>
                </div>
              </div>
              <div class="modal-footer pr-5 mr-2">
                <button type="submit" class="btn btn-primary mr-2" name="update_profile">Simpan</button>
                <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
              </div>
            </form>
          </div>
        </div>
      </div>