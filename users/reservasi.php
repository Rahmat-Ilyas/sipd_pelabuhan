<?php 
require('template/header.php');

$kapal = mysqli_query($conn, "SELECT * FROM tb_kapal");
?>

<div class="container bg-white pb-5">
  <div class="p-2">
    <h3>Reservasi</h3>
    <hr>
  </div>
  <div class="row">
    <div class="col-md-8 ml-auto mr-auto mt-0">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Reservasi Tiket Kapal</h4>
          <p class="category">Masukkan data yang dimita dibawah ini</p>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-3 border-right p-0">
              <ul class="nav nav-pills nav-pills-icons flex-column" role="tablist">
                <li class="nav-item border">
                  <a class="nav-link active show" href="#penumpang" role="tab" data-toggle="tab" aria-selected="false">
                    <i class="material-icons">people</i> Penumpang
                  </a>
                </li>
                <li class="nav-item border">
                  <a class="nav-link" href="#kendaraan" role="tab" data-toggle="tab" aria-selected="true">
                    <i class="material-icons">directions_bus</i> Kendaraan
                  </a>
                </li>
              </ul>
            </div>
            <div class="col-md-9">
              <div class="tab-content">
                <div class="tab-pane active show" id="penumpang">
                  <div class="container">
                    <div class="row">
                      <h4 class="col-md-6"><u>Input Data Penumpang</u></h4>
                      <b class="col-md-6 text-right mt-3">No. Regis: REG-099686443</b>                      
                    </div>
                    <div class="form-group">
                      <label class="col-form-label">Nomor Tiket</label>
                      <input type="text" class="form-control bg-white" placeholder="Nomor Tiket..." value="233362123" readonly="">
                    </div>
                    <div class="form-group">
                      <label class="col-form-label">Pilih Kapal</label>
                      <select class="form-control selectpicker" data-style="btn btn-link" id="exampleFormControlSelect1">
                        <?php
                        $option = ''; 
                        foreach ($kapal as $dta) { 
                          if ($dta['status'] == 'Tidak Beroprasi') {
                            $option .= '<option value="'.$dta['id'].'" disabled>'.$dta['nama_kapal'].' ('.$dta['status'].')</option>';
                          } else if ($dta['status'] != 'Sandar') {
                            $option .= '<option value="'.$dta['id'].'" disabled>'.$dta['nama_kapal'].' Tujuan '.$dta['tujuan'].' ('.$dta['status'].')</option>';
                          } else {
                            $option .= '<option value="'.$dta['id'].'">'.$dta['nama_kapal'].' Tujuan '.$dta['tujuan'].' ('.$dta['status'].')</option>';
                          }
                        } ?>
                        <!-- $tujuan = $dta['tujuan'] ? $dta['tujuan'] : '<i>Tidak Beroprasi</i>'; ?> -->
                        <option>-- Pilih Kapal --</option>
                        <?= $option ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label class="col-form-label">Nama</label>
                      <input type="text" class="form-control" placeholder="Masukkan Nama...">
                    </div>
                    <div class="form-group">
                      <label class="col-form-label">Jenis Kelamin</label>
                      <select class="form-control selectpicker" data-style="btn btn-link" id="exampleFormControlSelect1">
                        <option>-- Jenis Kelami --</option>
                        <option>Laki-laki</option>
                        <option>Perempuan</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label class="col-form-label">Umur</label>
                      <input type="number" class="form-control" placeholder="Masukkan Umur...">
                    </div>
                    <div class="form-group">
                      <label class="col-form-label">Alamat</label>
                      <textarea class="form-control" rows="3" placeholder="Masukkan Alamat..."></textarea>
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="kendaraan">
                  Efficiently unleash cross-media information without cross-media value. Quickly maximize timely deliverables for real-time schemas.
                  <br><br>Dramatically maintain clicks-and-mortar solutions without functional solutions.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
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