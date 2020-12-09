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
            <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editProfil"><i class="material-icons">person</i> &nbsp;Edit Profil</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit Profil -->
<div class="modal fade" id="editProfil" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Profil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="material-icons">clear</i>
        </button>
      </div>
      <form method="POST" action="controller.php">
        <div class="modal-body">
          <div class="container">
            <div class="form-group">
              <label class="col-form-label">Nama</label>
              <input type="hidden" name="id" value="<?= $user['id'] ?>">
              <input type="hidden" name="old_nama" value="<?= $user['nama'] ?>">
              <input type="text" class="form-control" required="" placeholder="Nama..." name="nama" autocomplete="off" value="<?= $user['nama'] ?>">
            </div>
            <div class="form-group">
              <label class="col-form-label">Jenis Kelamin</label>
              <select class="form-control" required="" name="jenis_kelamin" id="jenis_kelamin">
                <option value="">Jenis Kelamin...</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
            </div>
            <div class="form-group">
              <label class="col-form-label">Umur</label>
              <input type="number" class="form-control" required="" placeholder="Umur..." name="umur" autocomplete="off" value="<?= $user['umur'] ?>">
            </div>
            <div class="form-group">
              <label class="col-form-label">Alamat</label>
              <textarea class="form-control" required="" placeholder="Alamat..." name="alamat" rows="3"><?= $user['alamat'] ?></textarea>
            </div>
            <div class="form-group">
              <label class="col-form-label">Telepon</label>
              <input type="number" class="form-control" required="" placeholder="Telepon..." name="telepon" autocomplete="off" value="<?= $user['telepon'] ?>">
            </div>
            <div class="form-group">
              <label class="col-form-label">Email</label>
              <input type="email" class="form-control" required="" placeholder="Email..." name="email" autocomplete="off" value="<?= $user['email'] ?>">
            </div>
            <div class="form-group">
              <label class="col-form-label">Password</label>
              <input type="text" class="form-control" placeholder="Ganti Password..." name="password" autocomplete="off" value="">
              <input type="hidden" name="old_password" value="<?= $user['password'] ?>">
              <span class="text-info" style="font-size: 14px">Note: Masukkan password baru untuk mengganti password</span>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary mr-2" name="update_profile">Simpan</button>
          <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php 
require('template/footer.php');
?>

<script>
  $(document).ready(function() {
    $('#jenis_kelamin').val("<?= $user['jenis_kelamin'] ?>");
  });  
</script>