<?php 
require('template/header.php');
?>

<div class="container bg-white pb-5">
  <div class="p-2">
    <h3>Riwayat Perjalanan</h3>
    <hr>
  </div>
  <div class="row">
    <div class="col-md-12 ml-auto mr-auto mt-0">
      <h4 class="mt-0 text-center">Riwayat Perjalanan Anda</h4>
      <table id="datatable" class="table table-bordered">
        <thead>
          <tr>
            <th>Tanggal Berangkat</th>
            <th>Penumpang</th>
            <th>Kendaraan</th>
            <th>Tujuan</th>
            <th>Kapal</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Rahmat</td>
            <td>Yess</td>
            <td>Yess</td>
            <td>Oii</td>
            <td>Oii</td>
            <td>Panding</td>
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
    $('#riwayat').addClass('active');
  });  
</script>