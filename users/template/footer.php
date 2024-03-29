 <footer class="footer footer-default" id="set-footer">
    <div class="container">
      <hr>
      <div class="copyright float-right">
        ©<?= date('Y') ?> All Rights Reserved - Pelabuhan Pamatata
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
  <script src="assets/js/jquery.uploadPreview.min.js" type="text/javascript"></script>
  <script src="../admin/vendors/sweetalert2/sweetalert2.all.min.js"></script>
  <script src="../admin/build/js/jquery.PrintArea.js"></script>

  <script>
  $(document).ready(function() {
    $(document).tooltip({ selector: '[data-toggle1="tooltip"]' });
    var footer = $('#set-footer').offset().top;
    if (footer < 500) {
      $('#set-footer').addClass('fixed-bottom');
    }
  });
</script>
</body>
</html>