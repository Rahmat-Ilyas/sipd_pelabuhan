<?php 
require('../config.php');

if (isset($_SESSION['login_user'])) header("location: panel.php");

$password = null;
$email = null;
$err_email = false;
$err_pass = false;

if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $result = mysqli_query($conn, "SELECT * FROM tb_users WHERE email = '$email'");
  $get = mysqli_fetch_assoc($result);

  if ($get) {
    $get_password = $get['password'];
    if (password_verify($password, $get_password)) {
      $_SESSION['login_user'] = $get_password;
      $_SESSION['user_id'] = $get['id'];
      if (isset($_GET['from_home'])) {
        header("location: reservasi.php");
      } else {
        header("location: panel.php");
      }
      exit();
    } else $err_pass = true;
  } else $err_email = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/anchor.png">
  <link rel="icon" type="image/png" href="assets/img/anchor.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Login to Panel User
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
  <?php if (isset($_GET['from_home'])) { ?>
    <div class="alert alert-info" style="z-index: 99; position: fixed; width: 100%;">
      <div class="container p-0">
        <div class="alert-icon">
          <i class="material-icons">info_outline</i>
        </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true"><i class="material-icons">clear</i></span>
        </button>
        <b>Info Alert:</b> Anda harus login terlebih untuk masuk ke halaman Panel dan melakukan Reservasi...
      </div>
    </div>
    <?php 
  } ?>

  <div class="page-header header-filter" style="background-image: url('assets/img/bg7.jpg'); background-size: cover; background-position: top center;">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6 ml-auto mr-auto">
          <div class="card card-login">
            <form class="form" method="POST" action="">
              <div class="card-header card-header-primary text-center">
                <h4 class="card-title">Login</h4>
                <div class="social-line">
                  <a href="../index.php" class="btn btn-link">
                    <span class="border rounded-circle p-2"><i class="material-icons">anchor</i></span>
                    <span>Pamatata Port</span>
                  </a>
                </div>
              </div>
              <p class="description text-center">Login to Panel User</p>
              <div class="card-body mt-4">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">mail</i>
                    </span>
                  </div>
                  <input type="email" name="email" class="form-control" placeholder="Email..." autocomplete="off">
                </div>
                <?php if ($err_email == true) { ?>
                  <span class="text-danger ml-5 pl-2 mb-0">Email tidak ditemukan</span>
                <?php } ?>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">lock_outline</i>
                    </span>
                  </div>
                  <input type="password" name="password" class="form-control" placeholder="Password..." autocomplete="off">
                </div>
                <?php if ($err_pass == true) { ?>
                  <span class="text-danger ml-5 pl-2 mb-0">Password tidak sesuai</span>
                <?php } ?>
              </div>
              <div class="footer text-center mb-4">
                <div>
                  <button type="submit" name="login" class="btn btn-primary mb-2">Login</button>
                </div>
                <span class="text-dark">Don't have an account? <a href="signin.php">Sign In</a></span>
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