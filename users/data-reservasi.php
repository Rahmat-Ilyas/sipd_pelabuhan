<?php 
require('template/header.php');

$reservasi = mysqli_query($conn, "SELECT * FROM tb_transaksi WHERE user_id='$user_id' AND status!='Batal'");
$get_data = mysqli_fetch_assoc($reservasi);
$kd_daftar = $get_data['kd_transaksi'];
$get_penumpang = mysqli_query($conn, "SELECT * FROM tb_penumpang WHERE kd_pendaftaran='$kd_daftar'");
$tgl = mysqli_fetch_assoc($get_penumpang);
$tanggal_daftar = $tgl['tanggal_daftar'];
$tanggal_sekrng = date('Y-m-d H:i:s');

if (strtotime($tanggal_daftar) + 86400 > strtotime($tanggal_sekrng)) {
  $reserv = $get_data;
  $orang = 0;
  $kendaraan = 0;
  $tanggal = '';
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
                <a href="#" class="text-secondary" data-toggle="modal" data-toggle1="tooltip" data-original-title="Detail Penumpang" data-target="#detailPenumpang"><i class="material-icons" style="font-size: 16px;">info_outline</i></a>
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
              <?php } else { ?>
                <td>
                  <a href="#" class="btn btn-danger btn-sm" id="batal-reservasi"><i class="material-icons">highlight_remove</i> &nbsp;Batalkan Reservasi</a>
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
              <b>Info Alert:</b> Anda baru-baru ini telah menyelesaikan reservasi. Untuk sementara anda belum bisa melakukan reservasi dalam waktu 1x24 Jam.
            <?php } else { ?>
              <b>Info Alert:</b> Silahkan melakukan pembayaran di loket dengan menunjukkan Kode Transaksi. Lakukan pembayaran sebelum <b><?= date('d/m/Y H:i', strtotime($tanggal) + 86400) ?></b> atau reservasi akan di batalkan.
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

<?php 
require('template/footer.php');
?>

<script>
  $(document).ready(function() {
    $('#reservasi').addClass('active');

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
  });  
</script>