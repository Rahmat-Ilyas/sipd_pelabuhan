<?php 
require('template/header.php');

$reservasi = mysqli_query($conn, "SELECT * FROM tb_transaksi WHERE user_id='$user_id' AND status='Belum Lunas'");
$reserv = mysqli_fetch_assoc($reservasi);
?>

<div class="container bg-white pb-5">
  <div class="p-2">
    <h3>Reservasi</h3>
    <hr>
  </div>
  <div class="row">
    <div class="col-md-12 ml-auto mr-auto mt-0">
      <h4 class="mt-0 text-center">Data Reservasi Anda</h4>
      <table id="datatable" class="table table-bordered">
        <thead>
          <tr>
            <th>Kode Transaksi</th>
            <th>Tanggal Daftar</th>
            <th>Penumpang</th>
            <th>Kendaraan</th>
            <th>Total Harga</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($reserv) { ?>
            <tr>
              <td>Rahmat</td>
              <td>Loli Yui</td>
              <td>Yess</td>
              <td>Oii</td>
              <td>Oii</td>
            </tr>
          <?php } else { ?>
            <tr class="text-center">
              <td colspan="5">
                <span>Anda belum melakukan Reservasi. <b><a href="reservasi.php">Reservasi sekarang</a></b></span>
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
    $('#reservasi').addClass('active');
  });  
</script>