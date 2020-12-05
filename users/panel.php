<?php 
require('template/header.php');
?>

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
    <a href="reservasi.php" class="btn btn-danger btn-raised btn-lg mt-5 mb-5">
      <i class="material-icons">directions_ferry</i> &nbsp;&nbsp;Reservasi Tiket Sekarang
    </a>
  </div>
</div>

<?php 
require('template/footer.php');
?>

<script>
$(document).ready(function() {
  $('#home').addClass('active');
});  
</script>