<?php 
require('template/header.php');
?>

<div class="container bg-white pb-5">
  <div class="p-2">
    <h3>Pergi Bersama</h3>
    <hr>
  </div>
  <div class="row">
    <div class="col-md-12 ml-auto mr-auto mt-0">
      <h4 class="mt-0 text-center">Orang Yang Pergi Bersama Anda</h4>
      <table id="datatable" class="table table-bordered">
        <thead>
          <tr>
            <th>Tanggal Berangkat</th>
            <th>Nama</th>
            <th>Umur</th>
            <th>Alamat</th>
            <th>Jenis Kelamin</th>
            <th>Kategori</th>
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
    $('#pergisama').addClass('active');
  });  
</script>