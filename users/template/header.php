<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Panel User - Pelabuhan Pamatata Selayar
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="assets/css/material-kit.css?v=2.0.7" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="landing-page sidebar-collapse">
  <nav class="navbar sticky-top navbar-expand-lg bg-primary container rounded-0 mb-0">
    <div class="container">
      <div class="navbar-translate mr-4">
        <a href="../index.php" class="navbar-brand">
          <span class="border rounded-circle p-2"><i class="material-icons">anchor</i></span>
          <span>Pamatata Port</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="sr-only">Toggle navigation</span>
          <span class="navbar-toggler-icon"></span>
          <span class="navbar-toggler-icon"></span>
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav">
          <li class="dropdown nav-item" id="home">
            <a href="panel.php" class="nav-link">
              <i class="material-icons">home</i> Home
            </a>
          </li>
          <li class="nav-item" id="reservasi">
            <a class="nav-link" href="data-reservasi.php">
              <i class="material-icons">receipt</i> Reservasi
            </a>
          </li>
          <li class="nav-item" id="riwayat">
            <a class="nav-link" href="riwayat-perjalanan.php">
              <i class="material-icons">history</i> Riwayat Perjalanan
            </a>
          </li>
          <li class="nav-item" id="pergisama">
            <a class="nav-link" href="penumpang-lain.php">
              <i class="material-icons">people</i> Pergi Bersama
            </a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="dropdown nav-item">
            <a href="javascript:;" class="dropdown-toggle nav-link" data-toggle="dropdown">
              <i class="material-icons">account_circle</i>
              <span>Rahmat Ilyas</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="javascript:;" class="dropdown-item">Profile</a>
              <a href="javascript:;" class="dropdown-item">Logout</a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>