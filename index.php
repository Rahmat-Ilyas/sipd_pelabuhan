<?php 
require('config.php');
$kapal = mysqli_query($conn, "SELECT * FROM tb_kapal");
$informasi = mysqli_query($conn, "SELECT * FROM tb_pengumuman");
$info = mysqli_fetch_assoc($informasi);
$user = null;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="users/assets/img/anchor.png">
  <link rel="icon" type="image/png" href="users/assets/img/anchor.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Pelabuhan Pamatata Selayar
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="users/assets/css/material-kit.css?v=2.0.7" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="users/assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="landing-page sidebar-collapse section-beranda">
  <nav class="navbar navbar-transparent navbar-color-on-scroll fixed-top navbar-expand-lg" color-on-scroll="100" id="sectionsNav">
    <div class="container">
      <div class="navbar-translate">
        <a href="index.php" class="navbar-brand">
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
        <ul class="navbar-nav ml-auto">
          <li class="dropdown nav-item">
            <a href="#" class="nav-link" data-target=".section-beranda">
              <i class="material-icons">home</i> Beranda
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-target=".section-informasi" href="#">
              <i class="material-icons">info</i> Informasi
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-target=".section-tentang" href="#">
              <i class="material-icons">lightbulb</i> Tentang
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-target=".section-kontak" href="#">
              <i class="material-icons">phone</i> Hubungi Kami
            </a>
          </li>
          <?php if (isset($_SESSION['login_user'])) {
            $user_id = $_SESSION['user_id'];
            $get_user = mysqli_query($conn, "SELECT * FROM tb_users WHERE id=$user_id");
            $user = mysqli_fetch_assoc($get_user);
            ?>
            <li class="dropdown nav-item">
              <a href="" class="btn btn-primary btn-sm dropdown-toggle pt-2" data-toggle="dropdown">
                <i class="material-icons">account_circle</i>
                <span><?= $user['nama'] ?></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                <a href="users/profile.php" class="dropdown-item">Profile</a>
                <a href="users/logout.php" class="dropdown-item">Logout</a>
              </div>
            </li>
          <?php } else { ?>
            <li class="nav-item">
              <a class="btn btn-primary btn-sm pt-2" href="users/login.php">
                <i class="material-icons">account_circle</i> Login
              </a>
            </li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </nav>
  <div class="page-header header-filter" data-parallax="true" style="background-image: url('users/assets/img/pamatata1.jpg')">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1 class="title">Pelabuhan Pamatata Kabupaten Selayar</h1>
          <h4>Pelabuhan penyebrangan Pamatata adalah pelabuhan yang terletak di Desa Pamatata, Kec. Bontomatene, Kab. Selayar, Sulawesi Selatan.</h4>
          <br>
          <a href="users/reservasi.php?from_home=true" class="btn btn-danger btn-raised btn-lg">
            <i class="material-icons">directions_ferry</i> &nbsp;&nbsp;Reservasi Tiket Kapal Anda
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="main main-raised">
    <div class="container">
      <div class="section text-center section-informasi">
        <div class="row">
          <div class="col-md-8 ml-auto mr-auto">
            <h2 class="title">Informasi Pelabuhan Pamatata</h2>
          </div>
        </div>
        <div class="features">
          <div class="row">
            <div class="col-sm-7">
              <div class="card bg-warning pt-3">
                <h4 class="card-title">Jadwal Keberangkatan Kapal</h4>
                <div class="card-body text-left">
                  <table class="table">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col">Kapal</th>
                        <th scope="col">Tujuan</th>
                        <th scope="col">Waktu Berangkat</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($kapal as $dta) { ?>
                        <tr>
                          <td><b><?= $dta['nama_kapal'] ?></b></td>
                          <td><?= $dta['tujuan'] ? $dta['tujuan'] : '-' ?></td>
                          <td><?= $dta['waktu_berangkat'] ? date('d/m/Y H:i', strtotime($dta['waktu_berangkat'])) : '-' ?></td>
                          <td><?= $dta['status'] ? $dta['status'] : '-' ?></td>
                        </tr>
                        <?php 
                      } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="col-sm-5">
              <div class="card bg-info pt-3">
                <h4 class="card-title">Pengumuman</h4>
                <div class="px-3">
                  <hr style="border-color: #fff;">
                </div>
                <div class="card-body text-justify">
                  <?php if ($info['judul']) { ?>
                    <h5 style="margin-top: -15px; margin-bottom: -5px;"><b><?= $info['judul'] ?></b></h5>
                    <small class="text-white"><i><?= date('d/m/Y H:i', strtotime($info['waktu'])) ?></i></small>
                    <p class="mt-2"><?= $info['pengumuman'] ?></p>
                    <?php 
                  } else { ?>
                    <h5 class="mt-4 mb-5 text-center"><b><i>Tidak ada pengumuman untuk saat ini</i></b></h5>
                    <?php 
                  } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="section text-center section-tentang">
      <h2 class="title">Tentang Pelabuhan Pamatata</h2>
      <div class="team">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="team-player">
              <div class="card card-plain">
                <div class="card-body text-justify">
                  <p class="card-description">
                    <b>Pelabuhan penyeberangan Pamatata</b> adalah pelabuhan yang terletak di desa Pamatata, kecamatan Bontomatene, Kabupaten Kepulauan Selayar. Pelabuhan ini merupakan pintu gerbang utama memasuki daratan Kabupaten Kepulauan Selayar, Sulawesi Selatan jika melalui jalur laut dengan fasilitas penyeberangan berupa kapal feri. Menurut rencana pelabuhan ini akan disinggahi kapal yang berlayar dari arah wilayah timur menuju wilayah barat Indonesia, demikian juga sebaliknya. Perencanaan Kepulauan Selayar menjadi arus Timur-Barat Indonesia via laut, mengingatkan kita pada peta arus perdagangan kawasan kepulauan Nusantara beberapa abad yang lalu. Saat itu, Pulau Selayar menjadi pusat transit kapal-kapal saudagar dari berbagai penjuru. Hal itu ditandai dengan banyaknya situs barang antik di dasar laut di sekitar Kepulauan Selayar. Dan secara logika posisi Kepulauan Selayar memang sangat strategis menghubungkan timur dan barat, demikian juga wilayah utara dan selatan.
                  </p>
                  <p class="card-description">
                    <b>Pelabuhan penyeberangan Pamatata</b> saat ini berfungsi sebagai pelabuhan transit kapal feri dengan rute pelayaran pelabuhan Bira - Pamatata - Pelabuhan penyeberangan Pattumbukang - Takabonerate - Pasimasunggu Timur - Pasilambena - NTT (Reog, Sikka). Untuk sementara, pelayaran itu direncanakan akan menggunakan kapal KMP. BELLIDA dan KMP. BONTOHARU. Sementara jadwal pelayaran direncanakan 1 kali dalam seminggu, berangkat setiap hari Kamis. Mengingat kondisi perairan Selayar yang tergolong ganas, maka pelayaran akan ditunda jika cuaca tidak memungkinkan.
                    Menurut rencana, Dari Bira juga akan diadakan rute pelayaran tambahan yaitu Bira - Bau-Bau, Bira - Rawa Saban, Bira - Tuban, Bira - Karimunjawa, Bira - Pluan Laut, Bira - Ketapang - Dumai dengan kapal KMP. SANGKE PALLANGA. Jadwal keberangkatan dari Bira direncanakan 1 kali seminggu, setiap hari Selasa. Jadwal ini konon akan sering berubah sesuai kondisi serta keadaan penumpang yang akan berlayar ke tujuan tersebut.

                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="section section-kontak">
      <div class="row">
        <div class="col-md-8 ml-auto mr-auto">
          <h2 class="text-center title">Hubungi Kami</h2>
          <div class="row">
            <div class="col-md-5 text-center">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Kontak</h4>
                </div>
                <div class="card-body pl-2">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                      <i class="material-icons">phone</i> +62821-9131-2813
                    </li>
                    <li class="list-group-item">
                      <i class="material-icons">mail</i> pamatata.port@gmail.com
                    </li>
                    <li class="list-group-item text-left">
                      <i class="material-icons">location_on</i> Pamatata, Kec. Bontomatene,<br><br>Kab. Selayar, Sul-Sel
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-md-7">
              <form class="contact-form" method="POST" action="users/controller.php">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">Name Lengkap</label>
                      <input type="text" class="form-control" name="nama" value="<?= $user ? $user['nama'] : ''; ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">Email</label>
                      <input type="email" class="form-control" name="email" value="<?= $user ? $user['email'] : ''; ?>">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleMessage" class="bmd-label-floating">Tulis Pesan</label>
                  <textarea type="text" class="form-control" rows="4" id="exampleMessage" name="pesan"></textarea>
                </div>
                <div class="row">
                  <div class="col-md-4 ml-auto mr-auto text-center">
                    <button type="submit" name="kirim_pesan" class="btn btn-primary btn-raised">
                      Kirim Pesan
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<footer class="footer footer-default">
  <div class="container">
    <div class="copyright float-right">
      ©<?= date('Y') ?> All Rights Reserved - Pelabuhan Pamatata
    </div>
  </div>
</footer>
<!--   Core JS Files   -->
<script src="users/assets/js/core/jquery.min.js" type="text/javascript"></script>
<script src="users/assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="users/assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
<script src="users/assets/js/plugins/moment.min.js"></script>
<!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
<script src="users/assets/js/plugins/bootstrap-datetimepicker.js" type="text/javascript"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="users/assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
<!--  Google Maps Plugin    -->
<!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
<script src="users/assets/js/material-kit.js?v=2.0.7" type="text/javascript"></script>

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