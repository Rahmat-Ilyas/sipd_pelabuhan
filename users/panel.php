<!--
=========================================================
Material Kit - v2.0.7
=========================================================

Product Page: https://www.creative-tim.com/product/material-kit
Copyright 2020 Creative Tim (https://www.creative-tim.com/)

Coded by Creative Tim

=========================================================

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
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
          <li class="dropdown nav-item active">
            <a href="panel.php" class="nav-link">
              <i class="material-icons">home</i> Home
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="material-icons">event_note</i> Reservasi
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="material-icons">history</i> Riwayat Perjalanan
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
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
  <div class="container bg-white">
    <div class="p-2">
      <h3>Home</h3>
      <hr>
    </div>
    <div class="text-center">
      <div class="row">
        <div class="col-md-8 ml-auto mr-auto mt-0">
          <h2 class="title">Selamat Datang di Panel User Pelabuhan Pamatata Selayar</h2>
          <h5 class="description">This is the paragraph where you can write more details about your product. Keep you user engaged by providing meaningful information. Remember that by this time, the user is curious, otherwise he wouldn&apos;t scroll to get here. Add a button if you want the user to see more.</h5>
        </div>
      </div>
      <a href="#" class="btn btn-danger btn-raised btn-lg mt-5 mb-5">
        <i class="material-icons">directions_ferry</i> &nbsp;&nbsp;Reservasi Tiket Sekarang
      </a>
    </div>
  </div>
  <footer class="footer footer-default">
    <div class="container">
      <div class="copyright float-right">
        &copy;
        <script>
          document.write(new Date().getFullYear())
        </script>, Pamatata Port Selayar
      </div>
    </div>
  </footer>
  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
  <script src="assets/js/plugins/moment.min.js"></script>
  <!--  Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
  <script src="assets/js/plugins/bootstrap-datetimepicker.js" type="text/javascript"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
  <!--  Google Maps Plugin    -->
  <!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-kit.js?v=2.0.7" type="text/javascript"></script>

  <script>
    $(document).ready(function() {
      $('.nav-link').click(function(e) {
        e.preventDefault();
        var section = $(this).attr('data-target');

        if ($(section).length != 0) {
          $("html, body").animate({
            scrollTop: $(section).offset().top
          }, 1000);
        }            
      });
    });
  </script>
</body>

</html>