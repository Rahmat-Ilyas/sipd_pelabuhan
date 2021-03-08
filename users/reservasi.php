<?php 
require('template/header.php');
$reservasi = mysqli_query($conn, "SELECT * FROM tb_transaksi WHERE user_id='$user_id' AND status!='Batal' ORDER BY id DESC");
$reserv = mysqli_fetch_assoc($reservasi);
if (isset($reserv)) {
  $kd_daftar = $reserv['kd_transaksi'];
  $get_penumpang = mysqli_query($conn, "SELECT * FROM tb_penumpang WHERE kd_pendaftaran='$kd_daftar'");
  $tgl = mysqli_fetch_assoc($get_penumpang);
  $tanggal_daftar = $tgl['tanggal_daftar'];
  $tanggal_sekrng = date('Y-m-d H:i:s');

  if (strtotime($tanggal_daftar) + 86400 > strtotime($tanggal_sekrng)) {
    if ($reserv['status'] == 'Lunas') $status = 'success';
    else $status = 'panding';
    header("Location: controller.php?reservasi_exits=true&status=".$status);
  }
}

$kapal = mysqli_query($conn, "SELECT * FROM tb_kapal");
$golongan = mysqli_query($conn, "SELECT * FROM tb_golongan ORDER BY golongan ASC");

$option = ''; 
foreach ($kapal as $dta) { 
  if ($dta['status'] == 'Tidak Beroprasi') {
    $option .= '<option value="'.$dta['id'].'" disabled>'.$dta['nama_kapal'].' ('.$dta['status'].')</option>';
  } else if ($dta['status'] != 'Sandar') {
    $option .= '<option value="'.$dta['id'].'" disabled>'.$dta['nama_kapal'].' Tujuan '.$dta['tujuan'].' ('.$dta['status'].')</option>';
  } else {
    $option .= '<option value="'.$dta['id'].'">'.$dta['nama_kapal'].' Tujuan '.$dta['tujuan'].' ('.$dta['status'].')</option>';
  }
}
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
              <form method="POST" action="controller.php" id="form-reservasi">
                <div class="tab-content">
                  <div class="tab-pane active show" id="penumpang">
                    <div class="container">
                      <div class="row">
                        <h4 class="col-md-6"><u>Input Data Penumpang</u></h4>
                        <b class="col-md-6 text-right mt-3">No. Regis: <span id="no-regis"></span></b>
                      </div>
                      <div class="form-group">
                        <label class="col-form-label">Pilih Kapal</label>
                        <input type="hidden" name="kd_pendaftaran" id="val-regis">
                        <input type="hidden" name="user_id" value="<?= $user_id ?>">
                        <select class="form-control" name="kapal_id" required="" id="kapal_id">
                          <option value="">-- Pilih Kapal --</option>
                          <?= $option ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label class="col-form-label">Jumlah Penumpang</label>
                        <input type="number" class="form-control" value="1" id="jmlh_penumpang" data-toggle="popover" data-placement="top" data-content="Jumlah penumpang tidak boleh melebihi 5 orang" data-container="body" placeholder="Jumlah Penumpang..." required="">
                      </div>
                      <div class="" id="this-form">

                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="kendaraan">
                    <div class="container">
                      <div class="row">
                        <h4 class="col-md-6"><u>Input Data Kendaraan</u></h4>
                        <b class="col-md-6 text-right mt-3">No. Regis: <span id="no-regis1"></span></b>
                      </div>
                      <div class="form-group">
                        <label class="col-form-label">Nomor Tiket Kendaraan</label>
                        <input type="text" class="form-control bg-white" placeholder="Nomor Tiket Kendaraan..." name="no_tiket_kendaraan" id="tiket-kendaraan" readonly="">
                      </div>
                      <div class="form-group">
                        <label class="col-form-label">Golongan Kendaraan 
                          <a href="#" class="text-secondary" data-toggle="modal" data-target="#infoGolongan"><i class="material-icons mb-3" style="font-size: 16px;">info</i></a>
                        </label>
                        <select class="form-control" name="golongan_id" id="golongan">
                          <option value="">-- Pilih Golongan --</option>
                          <?php foreach ($golongan as $gol) { ?>
                            <option value="<?= $gol['id'] ?>"><?= $gol['golongan'].' ('.$gol['jenis_kendaraan'].')' ?></option>
                            <?php 
                          } ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label class="col-form-label">Nama Sopir/Pengendara</label>
                        <input type="text" class="form-control" placeholder="Masukkan Nama..." name="nama_sopir" autocomplete="off" id="nama_sopir" value="<?= $user['nama'] ?>">
                      </div>
                      <div class="form-group">
                        <label class="col-form-label">Merek Kendaraan</label>
                        <input type="text" class="form-control" placeholder="Masukkan Merek..." name="merek_kendaraan" autocomplete="off" id="merek_kendaraan">
                      </div>
                      <div class="form-group">
                        <label class="col-form-label">Nomor Kendaraan</label>
                        <input type="text" class="form-control" placeholder="Masukkan Nomor..." name="nomor_kendaraan" autocomplete="off" id="nomor_kendaraan">
                      </div>
                    </div>
                  </div>
                  <button type="submit" name="store_reservasi" class="btn btn-primary ml-2" id="submit-form"><i class="material-icons">input</i> &nbsp;&nbsp;Lanjutkan Reservasi</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<!-- Modal Info Golongan -->
<div class="modal fade" id="infoGolongan" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Golongan Kendaraan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="material-icons">clear</i>
        </button>
      </div>
      <div class="modal-body">
        <table id="datatable" class="table table-striped table-bordered" style="width:100%; font-size: 14px;">
          <thead>
            <tr>
              <th style="width: 20px;">No</th>
              <th>Nomor Golongan</th>
              <th>Jenis Kendaraan</th>
              <th>Harga</th>
              <th>Keterangan</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; foreach ($golongan as $dta) { ?>
              <tr>
                <td><?= $no; ?></td>
                <td><?= $dta['golongan']; ?></td>
                <td><?= $dta['jenis_kendaraan']; ?></td>
                <td>Rp. <?= $dta['harga']; ?></td>
                <td><?= $dta['keterangan']; ?></td>
              </tr>
              <?php $no = $no + 1; 
            } ?>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Close</button>
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

    var form_content = $('#form-content').html();
    var one_more_content = $('#one-more').html();
    one_only();

    $(document).on('keyup click', '#jmlh_penumpang', function(e) {
      value = $(this).val();
      kapal_id = $('#kapal_id').val();

      $.ajax({
        url     : 'controller.php',
        method  : "POST",
        data    : { 
          cek_kps_penumpang1: true,
          kapal_id: kapal_id,
          jumlah: value
        },
        success : function(data) {
          if (data=='full') {
            Swal.fire({
              title: 'Kapal Penuh',
              text: 'Mohon maaf, Jumlah penumpang yang anda masukkan telah melebihi kapasitas kapal.',
              type: 'info'
            });
            one_only();
            $('#jmlh_penumpang').val('1');
          }
        }
      });

      if (!kapal_id) {
        $('#kapal_id').focus();
        Swal.fire({
          text: 'Pilih kapal terlebih dahulu',
          type: 'warning',
          timer: 2000,
        });
        one_only();
        $('#jmlh_penumpang').val('1');
      }

      if (value <= 0 && value != '') {
        $(this).val('1');
        $(this).popover('hide');
        one_only();
      } else if (value > 5) {
        $(this).val('5');
        $(this).popover('show');
        one_more(5);
      } else {
        $(this).popover('hide');
        if (value == 1 || value == '') {
          one_only();
        } else {
          one_more(value);
        }
      }
    });

    $('#kapal_id').change(function() {
      $.ajax({
        url     : 'controller.php',
        method  : "POST",
        data    : { 
          cek_kps_penumpang: true,
          kapal_id: $(this).val()
        },
        success : function(data) {
          if (data=='full') {
            $('#kapal_id').val('');
            Swal.fire({
              title: 'Kapal Telah Penuh',
              text: 'Mohon maaf, pendaftar kapal telah memenuhi kapasitas.',
              type: 'info'
            });
          } else {
            one_only();
            tiket_kendaraan();
          }
        }
      });
      $('#jmlh_penumpang').val('1');
    });

    $('#golongan').change(function() {
      value = $(this).val();
      if (value == '') {
        $('#nama_sopir').removeAttr('required');
        $('#merek_kendaraan').removeAttr('required');
        $('#nomor_kendaraan').removeAttr('required');
      }
      else {
        $.ajax({
          url     : 'controller.php',
          method  : "POST",
          data    : { 
            cek_kps_kendaraan: true,
            golongan_id: value
          },
          success : function(data) {
            if (data=='full') {
              $('#golongan').val('');
              Swal.fire({
                title: 'Kapal Telah Penuh',
                text: 'Mohon maaf, golongan kendaraan yang anda pilih telah memenuhi kapasitas.',
                type: 'info'
              });
            } else {
              $('#nama_sopir').attr('required', '');
              $('#merek_kendaraan').attr('required', '');
              $('#nomor_kendaraan').attr('required', '');
            }
          }
        });
      }
    });

    $('#submit-form').click(function(event) {
      setTimeout(function() {
        Swal.fire({
          title: 'Lengkapi Data',
          text: 'Pastikan semua form telah di lengkapi',
          type: 'warning',
          timer: 2000,
        });
      }, 2000);
    });

    // Function Area
    function one_only() {
      var kapal_id = $('#kapal_id').val();
      $.ajax({
        url     : 'controller.php',
        method  : "POST",
        data    : { 
          one_only: true,
          user_id: <?= $user_id ?>, 
          kapal_id: kapal_id 
        },
        success : function(data) {
          $('#this-form').html(data);
        }
      });
    }

    function one_more(jum) {
      var kapal_id = $('#kapal_id').val();
      $.ajax({
        url     : 'controller.php',
        method  : "POST",
        data    : { 
          one_more: true, 
          user_id: <?= $user_id ?>, 
          kapal_id: kapal_id,
          jum_pnmpng: jum
        },
        success : function(data) {
          $('#this-form').html(data);
        }
      });
    }

    no_regis();
    function no_regis() {
      $.ajax({
        url     : 'controller.php',
        method  : "POST",
        data    : { 
          no_regis: true, 
          user_id: <?= $user_id ?>
        },
        success : function(data) {
          $('#no-regis').html(data);
          $('#no-regis1').html(data);
          $('#val-regis').val(data);
        }
      });
    }

    tiket_kendaraan();
    function tiket_kendaraan() {
      var kapal_id = $('#kapal_id').val();
      $.ajax({
        url     : 'controller.php',
        method  : "POST",
        data    : { 
          tiket_kendaraan: true, 
          user_id: <?= $user_id ?>,
          kapal_id: kapal_id
        },
        success : function(data) {
          $('#tiket-kendaraan').val(data);
        }
      });
    }
  });  
</script>
