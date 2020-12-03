<?php 
require('../config.php');

if (isset($_SESSION['login_admin'])) header("location: index.php");

$password = null;
$username = null;
$err_user = false;
$err_pass = false;

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $result = mysqli_query($conn, "SELECT * FROM tb_admin WHERE username = '$username'");
  $get = mysqli_fetch_assoc($result);

  if ($get) {
    $get_password = $get['password'];
    if (password_verify($password, $get_password)) {
      $_SESSION['login_admin'] = $get_password;
      header("location: index.php");
      exit();
    } else $err_pass = true;
  } else $err_user = true;
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

  <title>Login Admin</title>

  <!-- Bootstrap -->
  <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- Animate.css -->
  <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="build/css/custom.min.css" rel="stylesheet">
</head>

<body class="login" style="background-color: #2A3F54">
  <div>
    <div class="login_wrapper">
      <div class="animate form login_form">
        <section class="login_content">
          <form method="POST">
            <h1 class="text-white">Login Admin</h1>
            <div>
              <input type="text" class="form-control" placeholder="Username" required="" name="username" />
            </div>
            <?php if ($err_user == true) { ?>
              <div class="text-danger" style="margin: -15px 0px 10px -190px;">
                Username tidak ditemukan
              </div>
            <?php } ?>
            <div>
              <input type="password" class="form-control" placeholder="Password" required="" name="password" />
            </div>
            <?php if ($err_pass == true) { ?>
              <div class="text-danger" style="margin: -15px 0px 10px -215px;">
                Password tidak sesuai
              </div>
            <?php } ?>
            <div>
              <button type="submit" name="login" class="btn btn-light btn-block">Login</button>
            </div>

            <div class="clearfix"></div>

            <div class="separator">
              <div>
                <h1 class="site_title mb-0"><i class="fa fa-anchor"></i> Pamatata Port</h1>
                <p class="text-white">©<?= date('Y') ?> All Rights Reserved - Pelabuhan Pamatata</p>
              </div>
            </div>
          </form>
        </section>
      </div>
    </div>
  </div>
</body>
</html>
