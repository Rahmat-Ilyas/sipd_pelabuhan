<?php 
require('../config.php');

if (isset($_SESSION['login_user'])) header("location: panel.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/anchor.png">
  <link rel="icon" type="image/png" href="assets/img/anchor.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Sign In - Pamatata Port
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

<body class="login-page sidebar-collapse">
  <div class="page-header header-filter" style="background-image: url('assets/img/bg7.jpg'); background-size: cover; background-position: top center;">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-6 ml-auto mr-auto">
          <div class="card card-login">
            <form class="form" method="POST" action="controller.php">
              <div class="card-header card-header-primary text-center">
                <h4 class="card-title">Sign In</h4>
                <div class="social-line">
                  <a href="../index.php" class="btn btn-link">
                    <span class="border rounded-circle p-2"><i class="material-icons">anchor</i></span>
                    <span>Pamatata Port</span>
                  </a>
                </div>
              </div>
              <p class="description text-center">Sign In New User</p>
              <div class="card-body px-5">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group mb-0">
                      <input type="text" name="nama" class="form-control" required="" placeholder="Nama Lengkap..." autocomplete="off">
                    </div>
                    <div class="form-group mb-0">
                      <textarea class="form-control" required="" name="alamat" rows="4" placeholder="Alamat..." autocomplete="off"></textarea>
                    </div>
                    <div class="form-group mb-0">
                      <input type="number" name="umur" class="form-control" required="" placeholder="Umur..." autocomplete="off">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group mb-0 mt-4">
                      <select  class="form-control" required="" name="jenis_kelamin">
                        <option value="">Jenis Kelamin...</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                      </select>
                    </div>
                    <div class="form-group mb-0">
                      <input type="number" name="telepon" class="form-control" required="" placeholder="Telepon..." autocomplete="off">
                    </div>
                    <div class="form-group mb-0">
                      <input type="email" name="email" class="form-control" required="" placeholder="Email..." autocomplete="off">
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control" required="" placeholder="Password..." autocomplete="off">
                    </div>
                  </div>
                </div>
                <div class="mb-4 mt-2">
                  <div class="text-center">
                    <button type="submit" name="signup" class="btn btn-primary mb-2">Sign In</button>
                  </div>
                  <div class="text-center">
                    <span class="text-dark">Already registered? <a href="login.php">Login</a></span>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
  <script src="assets/js/plugins/moment.min.js"></script>
  <!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
  <script src="assets/js/plugins/bootstrap-datetimepicker.js" type="text/javascript"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
  <!--  Google Maps Plugin    -->
  <!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-kit.js?v=2.0.7" type="text/javascript"></script>
</body>

</html>