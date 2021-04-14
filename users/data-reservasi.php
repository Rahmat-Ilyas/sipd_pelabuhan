<?php 
require('template/header.php');

// CEK STATUS TRANSAKSI MIDTRANS 
$reservasi1 = mysqli_query($conn, "SELECT * FROM tb_transaksi WHERE user_id='$user_id' AND status!='Batal' ORDER BY id DESC");
$get_data1 = mysqli_fetch_assoc($reservasi1);
if (isset($get_data1)) {
  $kd_daftar1 = $get_data1['kd_transaksi'];
  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.sandbox.midtrans.com/v2/".$kd_daftar1."/status",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "Accept: application/json",
      "Content-Type: application/json",
      "Authorization: Basic U0ItTWlkLXNlcnZlci1paEdXdzBkREY0aHV4OVI1akF4N0dlQmQ6"
    ),
  ));

  $response = curl_exec($curl);

  curl_close($curl);
  $response = json_decode($response, true);
  if (isset($response['transaction_status'])) {
    $transaction_status = $response['transaction_status'];
    if ($transaction_status == 'settlement' || $transaction_status == 'capture') {
      // Update Transaksi
      $transaksi = mysqli_query($conn, "UPDATE tb_transaksi SET status='Lunas' WHERE kd_transaksi='$kd_daftar1'");
      // Update Penumpang
      $penumpang = mysqli_query($conn, "UPDATE tb_penumpang SET status='Selesai' WHERE kd_pendaftaran='$kd_daftar1'");
    }
  }
}

$reservasi = mysqli_query($conn, "SELECT * FROM tb_transaksi WHERE user_id='$user_id' AND status!='Batal' ORDER BY id DESC");
$get_data = mysqli_fetch_assoc($reservasi);

$orang = 0;
$kendaraan = 0;
$tanggal = '';
$reserv = [];
if (isset($get_data)) {
  $kd_daftar = $get_data['kd_transaksi'];
  $get_penumpang = mysqli_query($conn, "SELECT * FROM tb_penumpang WHERE kd_pendaftaran='$kd_daftar'");
  $tgl = mysqli_fetch_assoc($get_penumpang);
  $tanggal_daftar = $tgl['tanggal_daftar'];
  $tanggal_sekrng = date('Y-m-d H:i:s');

  if (strtotime($tanggal_daftar) + 3600 > strtotime($tanggal_sekrng)) {
    $reserv = $get_data;
    $penumpang = mysqli_query($conn, "SELECT * FROM tb_penumpang WHERE kd_pendaftaran='$kd_daftar'");
    foreach ($penumpang as $pn) {
      $orang = $orang + 1;
      $tanggal = $pn['tanggal_daftar'];
      $tujuan = $pn['tujuan'];
    }

    $get_kendaraan = mysqli_query($conn, "SELECT * FROM tb_kendaraan WHERE kd_pendaftaran='$kd_daftar'");
    foreach ($get_kendaraan as $kn) {
      $kendaraan = $kendaraan + 1;
    }
  } else {
    $reserv = [];
  }
}
?>

<div class="container bg-white pb-5">
  <div class="p-2">
    <h3>Reservasi</h3>
    <hr>
  </div>
  <div class="row">
    <div class="col-md-12 ml-auto mr-auto mt-0">
      <h4 class="mt-0 text-center">Data Reservasi Anda</h4>
      <table id="datatable" class="table table-bordered" style="font-size: 15px;">
        <thead>
          <tr>
            <th>Kode Transaksi</th>
            <th>Tanggal Daftar</th>
            <th>Penumpang</th>
            <th>Kendaraan</th>
            <th>Tujuan</th>
            <th>Total Harga</th>
            <?php if ($reserv && $reserv['status'] == 'Lunas') { ?>
              <th width="150">Status</th>
              <th width="150">Aksi</th>
            <?php } else if(isset($reserv['foto_transaksi'])) { ?>
              <th width="150">Status</th>
            <?php } else { ?>
              <th width="150">Aksi</th>
            <?php } ?>
          </tr>
        </thead>
        <tbody>
          <?php if ($reserv) { ?>
            <tr>
              <td><?= $reserv['kd_transaksi'] ?></td>
              <td><?= date('d/m/Y H:i', strtotime($tanggal)) ?></td>
              <td>
                <?= $orang ?> Orang 
                <a href="#" class="text-secondary" data-toggle1="tooltip" data-original-title="Detail Penumpang" data-toggle="modal" data-target="#detailPenumpang"><i class="material-icons" style="font-size: 16px;">info_outline</i></a>
              </td>
              <td>
                <?= $kendaraan ?> Unit
                <a href="#" class="text-secondary" data-toggle="modal" data-toggle1="tooltip" data-original-title="Detail Kendaraan" data-target="#detailKendaraan"><i class="material-icons" style="font-size: 16px;">info_outline</i></a>
              </td>
              <td><?= $tujuan ?></td>
              <td>Rp. <?= $reserv['total_harga'] ?></td>
              <?php if ($reserv['status'] == 'Lunas') { ?>
                <td class="text-center">
                  <span class="badge badge-pill badge-success" style="width: 60%;">Selesai</span>
                </td>
                <td>
                  <a href="#" class="btn btn-success btn-sm btn-block print-tiket" data-id="<?= $reserv['id'] ?>" id=""><i class="material-icons">download</i> &nbsp;Download Tiket</a>
                </td>
              <?php } else if (isset($reserv['foto_transaksi'])) { ?>
                <td class="text-center">
                  <span class="badge badge-pill badge-info" style="width: 60%;">Diproses</span>
                </td>
              <?php } else { ?>
                <td>
                  <?php if ($reserv['status'] == 'Lunas') { ?>
                    <a href="#" class="btn btn-success btn-sm btn-block print-tiket" data-id="<?= $reserv['id'] ?>" id=""><i class="material-icons">download</i> &nbsp;Download Tiket</a>
                  <?php } else { ?>
                    <a href="#" class="btn btn-success btn-sm btn-block" id="blm-selesai"><i class="material-icons">credit_card</i> &nbsp;Selesaikan Reservasi</a>
                  <?php }?>
                  <a href="#" class="btn btn-danger btn-sm btn-block" id="batal-reservasi"><i class="material-icons">highlight_remove</i> &nbsp;Batalkan Reservasi</a>
                </td>
              <?php } ?>
            </tr>
          <?php } else { ?>
            <tr class="text-center">
              <td colspan="7">
                <span>Anda belum melakukan Reservasi. <b><a href="reservasi.php">Reservasi sekarang</a></b></span>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
      <?php if ($reserv) { ?>
        <div class="alert alert-info" style="margin-bottom: -30px;">
          <div class="container p-0">
            <div class="alert-icon">
              <i class="material-icons">info_outline</i>
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true"><i class="material-icons">clear</i></span>
            </button>
            <?php if ($reserv['status'] == 'Lunas') { ?>
              <b>Info Alert:</b> Anda baru-baru ini telah menyelesaikan reservasi. Untuk sementara anda belum bisa melakukan reservasi dalam waktu 1 Jam.
            <?php } else if (isset($reserv['foto_transaksi'])) { ?>
              <b>Info Alert:</b> Pembayaran anda sedang diproses, silahkan tunggu beberapa saat. Juka pembayaran anda masih belum diposes dalam beberapa saat, silahkan hubungi staf di loket
            <?php } else { ?>
              <b>Info Alert:</b> Silahkan melakukan pembayaran di loket dengan menunjukkan Kode Transaksi atau lakukan pembayaran online sesuai intruksi. Lakukan pembayaran sebelum <b><?= date('d/m/Y H:i', strtotime($tanggal) + 3600) ?></b> atau reservasi akan di batalkan.
            <?php } ?>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</div>

<!-- Modal Detail Penumpang -->
<div class="modal fade" id="detailPenumpang" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Penumpang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="material-icons">clear</i>
        </button>
      </div>
      <div class="modal-body">
        <table id="datatable" class="table table-striped table-bordered" style="width:100%; font-size: 14px;">
          <thead>
            <tr>
              <th width="150">Nomor Tiket</th>
              <th width="150">Nama</th>
              <th width="90">Umur</th>
              <th>Alamat</th>
              <th>Gender</th>
              <th>Kategori</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($penumpang as $dta) { ?>
              <tr>
                <td><?= $dta['nomor_tiket']; ?></td>
                <td><?= $dta['nama']; ?></td>
                <td><?= $dta['umur']; ?> Tahun</td>
                <td><?= $dta['alamat']; ?></td>
                <td><?= $dta['jenis_kelamin']; ?></td>
                <td><?= $dta['kategori']; ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Detail Kendaraan -->
<div class="modal fade" id="detailKendaraan" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Kendaraan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="material-icons">clear</i>
        </button>
      </div>
      <div class="modal-body">
        <table id="datatable" class="table table-striped table-bordered" style="width:100%; font-size: 14px;">
          <thead>
            <tr>
              <th width="150">Nomor Tiket</th>
              <th width="100">Golongan</th>
              <th width="100">Jenis</th>
              <th>Nama Sopir</th>
              <th>Merek</th>
              <th width="110">Nomor Plat</th>
            </tr>
          </thead>
          <tbody>
            <?php $gol_id = null; foreach ($get_kendaraan as $dta) { 
              $gol_id = $dta['golongan_id'];
              $golongan = mysqli_query($conn, "SELECT * FROM tb_golongan WHERE id='$gol_id'");
              $gol = mysqli_fetch_assoc($golongan);
              ?>
              <tr>
                <td><?= $dta['nomor_tiket']; ?></td>
                <td><?= $gol['golongan']; ?></td>
                <td><?= $gol['jenis_kendaraan']; ?></td>
                <td><?= $dta['nama_sopir']; ?></td>
                <td><?= $dta['merek_kendaraan']; ?></td>
                <td><?= $dta['nomor_kendaraan']; ?></td>
              </tr>
            <?php } if (empty($gol_id)) { ?>
              <tr>
                <td colspan="6" class="text-center">Tidak ada kendaraan</td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div hidden="" class="penumpang-area px-2" style="font-size: 12px;">
  <?php foreach ($penumpang as $dta) { 
    $id = $dta['id'];

    $penumpang = mysqli_query($conn, "SELECT * FROM tb_penumpang WHERE id='$id'");
    $pen = mysqli_fetch_assoc($penumpang);

    $kpl_id = $pen['kapal_id'];
    $kapal = mysqli_query($conn, "SELECT * FROM tb_kapal WHERE id='$kpl_id'");
    $kpl = mysqli_fetch_assoc($kapal);

    $ktgr = $pen['kategori'];
    $kategori = mysqli_query($conn, "SELECT * FROM tb_harga WHERE kategori='$ktgr'");
    $ktg = mysqli_fetch_assoc($kategori);

    $nomor_tiket = $pen['nomor_tiket'];
    $tujuan = $pen['tujuan'];
    $kategori = $pen['kategori'];
    $umur = $pen['umur'];
    $tanggal1 = date('d M Y', strtotime($pen['tanggal_daftar']));
    $kapal = $kpl['nama_kapal'];
    $nama = $pen['nama'];
    $jenis_kelamin = $pen['jenis_kelamin'];
    $harga1 = $ktg['harga'];
    $harga2 = $ktg['harga'];
    $tanggal2 = date('d/m/Y', strtotime($pen['tanggal_daftar']));
    ?>
    <div class="border row mb-3">
      <div class="col-md-8 row justify-content-center mr-2" style="border-right: dashed; width: 60%;">
        <div class="col-sm-12 row">
          <div class="col-md-6" style="width: 50%;">
            <h3><i>Tiket Pamatata</i></h3>
          </div>
          <div class="col-md-6 text-right" style="width: 50%;">
            <h4><?= $nomor_tiket ?></h4>
          </div>
        </div>
        <div class="col-sm-12 text-center mt-2">
          <h4><b>Pelabuhan Pamatata - <span id="tujuan"></span></b></h4>
          <h4><b><span><?= $kategori ?></span> (<span><?= $umur ?></span>)</b></h4>
          <h4><b><span><?= $tanggal1 ?></span> / <span id="kapal"><?= $kapal ?></span></b></h4>
        </div>
        <div class="col-sm-8" style="width: 80%;">
          <h6><span><?= $nama ?></span> (<span><?= $jenis_kelamin ?></span>)</h6>
          <h6>Rp. <span><?= $harga1 ?></span></h6>
          <h6>NET: Rp. <span><?= $harga2 ?></span></h6>
          <h6>Tanggal Pembelian: <span><?= $tanggal2 ?></span></h6>
        </div>
        <div class="col-sm-12 mt-4">
          <span>Pamatata, Kec. Bontomatene, Kab. Selayar, Sul-Sel</span>
          <br><span>pamatata.port@gmail.com</span>
          <br><span>+62821-9131-2813</span>
        </div>
      </div>
      <div class="col-md-4 pt-5" style="width: 40%;">
        <h6><b>Nomor Tiket:</b> <span><?= $nomor_tiket ?></span></h6>
        <h6><b>Nama:</b> <span><?= $nama ?></span> (<span><?= $jenis_kelamin ?></span>)</h6>
        <h6><b>Kategori:</b> <span><?= $kategori ?></span></h6>
        <h6><b>Tanggal:</b> <span><?= $tanggal2 ?></span></h6>
        <h6><b>Tujuan:</b> Pelabuhan Pamatata - <span><?= $tujuan ?></span></h6>
        <h6><b>Harga:</b> Rp. <span><?= $harga1 ?></span></h6>
        <div class="pt-5 mt-5">
          <span>Pamatata, Kec. Bontomatene, Kab. Selayar, Sul-Sel</span>
          <br><span>pamatata.port@gmail.com</span>
          <br><span>+62821-9131-2813</span>
        </div>
      </div>
    </div>
  <?php } 

  if ($kendaraan > 0) {
    foreach ($get_kendaraan as $ken) {
      $gol_id = $ken['golongan_id'];
      $golongan = mysqli_query($conn, "SELECT * FROM tb_golongan WHERE id='$gol_id'");
      $gol = mysqli_fetch_assoc($golongan);
      $kd_dftr = $ken['kd_pendaftaran'];
      $get_penumpang = mysqli_query($conn, "SELECT * FROM tb_penumpang WHERE kd_pendaftaran='$kd_dftr'");
      $pnp = mysqli_fetch_assoc($get_penumpang);
      $get_transaksi = mysqli_query($conn, "SELECT * FROM tb_transaksi WHERE kd_transaksi='$kd_dftr'");
      $trns = mysqli_fetch_assoc($get_transaksi);
      $kpl_id = $ken['kapal_id'];
      $get_kapal = mysqli_query($conn, "SELECT * FROM tb_kapal WHERE id='$kpl_id'");
      $kpl = mysqli_fetch_assoc($get_kapal); ?>
      <div class="border row">
        <div class="col-md-8 row justify-content-center mr-2" style="border-right: dashed; width: 60%;">
          <div class="col-sm-12 row">
            <div class="col-md-6" style="width: 50%;">
              <h3><i>Tiket Pamatata</i></h3>
            </div>
            <div class="col-md-6 text-right" style="width: 50%;">
              <h4><?= $ken['nomor_tiket'] ?></h4>
            </div>
          </div>
          <div class="col-sm-12 text-center mt-2">
            <h4><b>Pelabuhan Pamatata - <?= $pnp['tujuan'] ?></b></h4>
            <h4><b><?= $gol['golongan'] ?> (<?= $gol['jenis_kendaraan'] ?>)</b></h4>
            <h4><b><?= date('d M Y', strtotime($pnp['tanggal_daftar'])) ?> / <?= $kpl['nama_kapal'] ?></b></h4>
          </div>
          <div class="col-sm-8" style="width: 80%;">
            <h6><?= $ken['merek_kendaraan'] ?> (<?= $ken['nama_sopir'] ?>)</h6>
            <h6>Rp. <?= $trns['biaya_kendaraan'] ?></h6>
            <h6>NET: Rp. <?= $trns['biaya_kendaraan'] ?></h6>
            <h6>Tanggal Pembelian: <?= date('d/m/Y', strtotime($pnp['tanggal_daftar'])) ?></h6>
          </div>
          <div class="col-sm-12 mt-4">
            <span>Pamatata, Kec. Bontomatene, Kab. Selayar, Sul-Sel</span>
            <br><span>pamatata.port@gmail.com</span>
            <br><span>+62821-9131-2813</span>
          </div>
        </div>
        <div class="col-md-4 pt-5" style="width: 40%;">
          <h6><b>Nomor Tiket:</b> <?= $ken['nomor_tiket'] ?></h6>
          <h6><b>Merek:</b> <?= $ken['merek_kendaraan'] ?></h6>
          <h6><b>Supir/Pengendara:</b> <?= $ken['nama_sopir'] ?></h6>
          <h6><b>Golongan:</b> <?= $gol['golongan'] ?> (<?= $gol['jenis_kendaraan'] ?>)</h6>
          <h6><b>Tanggal:</b> <?= date('d/m/Y', strtotime($pnp['tanggal_daftar'])) ?></h6>
          <h6><b>Tujuan:</b> Pelabuhan Pamatata - <?= $pnp['tujuan'] ?></h6>
          <h6><b>Harga:</b> Rp. <?= $trns['biaya_kendaraan'] ?></h6>
          <div class="pt-5 mt-5">
            <span>Pamatata, Kec. Bontomatene, Kab. Selayar, Sul-Sel</span>
            <br><span>pamatata.port@gmail.com</span>
            <br><span>+62821-9131-2813</span>
          </div>
        </div>
      </div>
    <?php }
  } ?>
</div>

<?php
require('template/footer.php');
?>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-tst84O1Wc088OdX0"></script>
<script>
  $(document).ready(function() {
    $('#reservasi').addClass('active');

    $(document).on('click', '#pay-button', function(e) {
      e.preventDefault();
      snap.pay("<?= $reserv['payment_token'] ?>", {
        onSuccess: function(result){
          alert_payment();
        },
        onPending: function(result){
          alert_payment();
        },
        onError: function(result){
          alert_payment();
        }
      });
    });

    function alert_payment() {
      swal({
        title: "Muat Ulang Halaman",
        html: "Jika anda telah menyelesaikan pembayaran. Silahkan muat ulang halaman untuk mengupdate status pembayaran",
        type: "info",
        preConfirm: () => {
          location.href = "data-reservasi.php";
        }
      });
    }

    $(document).on('click', '.print-tiket', function(e) {
      e.preventDefault();
      $('.penumpang-area').printArea();
    });

    $('#batal-reservasi').click(function() {
      swal({
        title: "Batalkan Reservasi?",
        html: "Yakin ingin membatalkan reservasi ini!",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: 'Batalan',
        preConfirm: () => {
          location.href = "controller.php?batalkan_reservasi=true&resevasi_id=<?= $reserv ? $reserv['kd_transaksi'] : '' ?>";
        }
      });
    });

    $('#blm-selesai').click(function(event) {
      swal({
        title: "Selesaikan Reservasi",
        html: `
        <h4>Silahkan lakukan pembayaran sesuai intruksi berikut:</h4>
        <ol class="text-left">
        <li>Anda dapat melakukan pembayaran langsung di loket pelabuhan Pamatata dengan menunjukkan kode transaksi Anda.</li>
        <li>Anda juga dapat melakukan pembayara online dengan berbagai metode yang disediakan. Untuk proses lebih lanjut, silahkan klik <a href="#" id="pay-button"><b>Pembayaran Online</b></a></li>
        </ol>
        `,
        type: "info",
      });
    });
  });  
</script>
