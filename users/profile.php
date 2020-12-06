<?php 
require('template/header.php');
?>

<div class="container bg-white pb-5">
  <div class="p-2">
    <h3>Profile</h3>
    <hr>
  </div>
  <div class="row">
    <div class="col-md-6 ml-auto mr-auto mt-0">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Profile User</h4>
          <p class="category">Anda bisa mengedit data profil di sini</p>
        </div>
        <div class="card-body">
          <ul class="list-group list-group-flush">
            <li class="list-group-item row">
              <b class="col-sm-3 p-0">Nama: </b>
              <span class="col-sm-8 p-0"><?= $user['nama'] ?></span>
            </li>
            <li class="list-group-item row">
              <b class="col-sm-3 p-0">Jenis Kelamin: </b>
              <span class="col-sm-8 p-0"><?= $user['jenis_kelamin'] ?></span>
            </li>
            <li class="list-group-item row">
              <b class="col-sm-3 p-0">Umur: </b>
              <span class="col-sm-8 p-0"><?= $user['umur'] ?> Tahun</span>
            </li>
            <li class="list-group-item row">
              <b class="col-sm-3 p-0">Alamat: </b>
              <span class="col-sm-8 p-0"><?= $user['alamat'] ?></span>
            </li>
            <li class="list-group-item row">
              <b class="col-sm-3 p-0">Telepon: </b>
              <span class="col-sm-8 p-0"><?= $user['telepon'] ?></span>
            </li>
            <li class="list-group-item row">
              <b class="col-sm-3 p-0">Email: </b>
              <span class="col-sm-8 p-0"><?= $user['email'] ?></span>
            </li>
          </ul>
          <div class="text-center">
            <a href="#" class="btn btn-primary btn-sm"><i class="material-icons">person</i> &nbsp;Edit Profil</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php 
require('template/footer.php');
?>