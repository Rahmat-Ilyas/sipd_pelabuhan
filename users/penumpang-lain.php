<?php 
require('template/header.php');
$nama = $user['nama'];
$penumpang = mysqli_query($conn, "SELECT * FROM tb_penumpang WHERE user_id='$user_id' AND nama!='$nama' AND status!='Batal'");
?>

<div class="container bg-white pb-5">
  <div class="p-2">
    <h3>Pergi Bersama</h3>
    <hr>
  </div>
  <div class="row">
    <div class="col-md-12 ml-auto mr-auto mt-0">
      <h4 class="mt-0 text-center">Orang Yang Pergi Bersama Anda</h4>
      <table id="datatable" class="table table-bordered" style="font-size: 15px;">
        <thead>
          <tr>
            <th width="10">No</th>
            <th>KD Pendaftaran</th>
            <th>Tanggal Berangkat</th>
            <th>Nama</th>
            <th>Umur</th>
            <th>Alamat</th>
            <th>Jenis Kelamin</th>
            <th>Kategori</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; foreach ($penumpang as $dta) { ?>
            <tr>
              <td><?= $no ?></td>
              <td><?= $dta['kd_pendaftaran'] ?></td>
              <td><?= date('d/m/Y H:i', strtotime($dta['tanggal_daftar'])) ?></td>
              <td><?= $dta['nama'] ?></td>
              <td><?= $dta['umur'] ?> Tahun</td>
              <td><?= $dta['alamat'] ?></td>
              <td><?= $dta['jenis_kelamin'] ?></td>
              <td><?= $dta['kategori'] ?></td>
            </tr>
            <?php $no = $no + 1; 
          } 
          if ($no == 1) { ?>
            <tr class="text-center">
              <td colspan="8">
                <span>Belum ada penumpang yang pergi bersama Anda</span>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php 
require('template/footer.php');
?>

<script>
  $(document).ready(function() {
    $('#pergisama').addClass('active');
  });  
</script>