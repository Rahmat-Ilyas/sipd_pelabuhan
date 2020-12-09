<?php 
require('template/header.php');

$reservasi = mysqli_query($conn, "SELECT * FROM tb_transaksi WHERE user_id='$user_id'");
?>

<div class="container bg-white pb-5">
  <div class="p-2">
    <h3>Riwayat Perjalanan</h3>
    <hr>
  </div>
  <div class="row">
    <div class="col-md-12 ml-auto mr-auto mt-0">
      <h4 class="mt-0 text-center">Riwayat Perjalanan Anda</h4>
      <table id="datatable" class="table table-bordered" style="font-size: 15px;">
        <thead>
          <tr>
            <th width="10">No</th>
            <th>Tanggal Berangkat</th>
            <th>Penumpang</th>
            <th>Kendaraan</th>
            <th>Kapal</th>
            <th>Tujuan</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; foreach ($reservasi as $dta) { 
            $kd_daftar = $dta['kd_transaksi'];
            $orang = 0;
            $kendaraan = 0;
            $penumpang = mysqli_query($conn, "SELECT * FROM tb_penumpang WHERE kd_pendaftaran='$kd_daftar'");
            foreach ($penumpang as $pn) {
              $orang = $orang + 1;
              $tanggal = $pn['tanggal_daftar'];
              $tujuan = $pn['tujuan'];
              $kapal_id = $pn['kapal_id'];
              $status = $pn['status'];
            }

            $get_kendaraan = mysqli_query($conn, "SELECT * FROM tb_kendaraan WHERE kd_pendaftaran='$kd_daftar'");
            foreach ($get_kendaraan as $kn) {
              $kendaraan = $kendaraan + 1;
            }

            $get_kapal = mysqli_query($conn, "SELECT * FROM tb_kapal WHERE id='$kapal_id'");
            $kapal = mysqli_fetch_assoc($get_kapal);
            ?>
            <tr>
              <td><?= $no ?></td>
              <td><?= date('d/m/Y H:i', strtotime($tanggal)) ?></td>
              <td>
                <?= $orang ?> Orang
                <a href="#" class="text-secondary" data-toggle="modal" data-toggle1="tooltip" data-original-title="Detail Penumpang" data-target="#detailPenumpang<?= $dta['id'] ?>"><i class="material-icons" style="font-size: 16px;">info_outline</i></a>
              </td>
              <td>
                <?= $kendaraan ?> Unit
                <a href="#" class="text-secondary" data-toggle="modal" data-toggle1="tooltip" data-original-title="Detail Kendaraan" data-target="#detailKendaraan<?= $dta['id'] ?>"><i class="material-icons" style="font-size: 16px;">info_outline</i></a>
              </td>
              <td><?= $kapal['nama_kapal'] ?></td>
              <td><?= $tujuan ?></td>
              <td class="text-center">
                <?php 
                if ($status == 'Selesai') $color = 'success'; 
                else if ($status == 'Panding') $color = 'warning'; 
                else if ($status == 'Batal') $color = 'danger'; 
                ?>
                <span class="badge badge-pill badge-<?= $color ?>" style="width: 60%;"><?= $status ?></span>
              </td>
            </tr>
            <?php $no = $no + 1; } if ($no == 1) { ?>
              <tr class="text-center">
                <td colspan="7">
                  <span>Belum ada data Riwayat Perjalanan</span>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <?php foreach ($reservasi as $dta) { 
    $kd_daftar = $dta['kd_transaksi'];
    $orang = 0;
    $kendaraan = 0;
    $penumpang = mysqli_query($conn, "SELECT * FROM tb_penumpang WHERE kd_pendaftaran='$kd_daftar'");
    foreach ($penumpang as $pn) {
      $orang = $orang + 1;
      $tanggal = $pn['tanggal_daftar'];
      $tujuan = $pn['tujuan'];
      $kapal_id = $pn['kapal_id'];
      $status = $pn['status'];
    }

    $get_kendaraan = mysqli_query($conn, "SELECT * FROM tb_kendaraan WHERE kd_pendaftaran='$kd_daftar'");
    foreach ($get_kendaraan as $kn) {
      $kendaraan = $kendaraan + 1;
    }

    $get_kapal = mysqli_query($conn, "SELECT * FROM tb_kapal WHERE id='$kapal_id'");
    $kapal = mysqli_fetch_assoc($get_kapal);
    ?>
    <!-- Modal Detail Penumpang -->
    <div class="modal fade" id="detailPenumpang<?= $dta['id'] ?>" tabindex="-1" role="dialog">
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
                <?php foreach ($penumpang as $pnpng) { ?>
                  <tr>
                    <td><?= $pnpng['nomor_tiket']; ?></td>
                    <td><?= $pnpng['nama']; ?></td>
                    <td><?= $pnpng['umur']; ?> Tahun</td>
                    <td><?= $pnpng['alamat']; ?></td>
                    <td><?= $pnpng['jenis_kelamin']; ?></td>
                    <td><?= $pnpng['kategori']; ?></td>
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
    <div class="modal fade" id="detailKendaraan<?= $dta['id'] ?>" tabindex="-1" role="dialog">
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
                <?php $gol_id = null; foreach ($get_kendaraan as $kend) { 
                  $gol_id = $kend['golongan_id'];
                  $golongan = mysqli_query($conn, "SELECT * FROM tb_golongan WHERE id='$gol_id'");
                  $gol = mysqli_fetch_assoc($golongan);
                  ?>
                  <tr>
                    <td><?= $kend['nomor_tiket']; ?></td>
                    <td><?= $gol['golongan']; ?></td>
                    <td><?= $gol['jenis_kendaraan']; ?></td>
                    <td><?= $kend['nama_sopir']; ?></td>
                    <td><?= $kend['merek_kendaraan']; ?></td>
                    <td><?= $kend['nomor_kendaraan']; ?></td>
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
  <?php } ?>

  <?php 
  require('template/footer.php');
  ?>

  <script>
    $(document).ready(function() {
      $('#riwayat').addClass('active');
    });  
  </script>