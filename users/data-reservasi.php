<?php 
require('template/header.php');
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
          <tr>
            <td>Rahmat</td>
            <td>Loli Yui</td>
            <td>Yess</td>
            <td>Oii</td>
            <td>Oii</td>
          </tr>
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