<?php 
require('../config.php');

if (!isset($_SESSION['login_admin'])) {
  header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="images/favicon.ico" type="image/ico" />

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
            <a href="index.html" class="site_title"><i class="fa fa-anchor"></i> <span>Pamatata Port</span></a>
          </div>

          <div class="clearfix"></div>
          <br />
          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <ul class="nav side-menu">
                <li><a href="index.php"><i class="fa fa-home"></i> Dashboard</a></li>
                <li><a><i class="fa fa-calculator"></i> Transaksi Pembayaran</span></a></li>
                <li><a><i class="fa fa-users"></i> Data Penumpang<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="general_elements.html">Data Pendaftar</a></li>
                    <li><a href="media_gallery.html">Data Penumpang</a></li>
                  </ul>
                </li>
                <li><a><i class="fa fa-database"></i> Kelola Data <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="data-kapal.php">Data Kapal</a></li>
                    <li><a href="golongan-kendaraan.php">Golongan Kendaraan</a></li>
                    <li><a href="data-user.php">Data User</a></li>
                  </ul>
                </li>
                <li><a><i class="fa fa-info"></i> Kelola Informasi <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="chartjs2.html">Jadwal Keberangkatan</a></li>
                    <li><a href="chartjs.html">Pengumuman</a></li>
                  </ul>
                </li>
                <li><a><i class="fa fa-file-text-o"></i>Laaporan <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="fixed_sidebar.html">Laporan Data Penumpang</a></li>
                    <li><a href="fixed_footer.html">Laporan Transaksi</a></li>
                    <li><a href="fixed_footer.html">Riwayat Perjalanan Kapal</a></li>
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
                  <img src="images/img.jpg" alt="">John Doe
                </a>
                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item"  href="javascript:;"> Profile</a>
                  <a class="dropdown-item"  href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                </div>
              </li>
            </ul>
          </nav>
        </div>
      </div>
        <!-- /top navigation -->