<?php 
function plugins($status, $message, $header) { ?>
	<link rel="stylesheet" href="../admin/vendors/bootstrap/dist/css/bootstrap.min.css">
	<script src="../admin/vendors/jquery/dist/jquery.min.js"></script>
	<script src="../admin/vendors/sweetalert2/sweetalert2.all.min.js"></script>

	<script>
		$(document).ready(function($) {
			<?php if ($status == 'success') { ?>
				Swal.fire({
					title: 'Berhasil Diproses',
					text: '<?= $message ?>',
					type: 'success',
					onClose: () => {
						location.href = '<?= $header ?>.php';
					}
				});
			<?php } else if ($status == 'error') { ?>
				Swal.fire({
					title: 'Gagal Diproses',
					text: '<?= $message ?>',
					type: 'error',
					onClose: () => {
						location.href = '<?= $header ?>.php';
					}
				});
			<?php } else if ($status == 'warning') { ?>
				Swal.fire({
					title: 'Tidak Bisa Melakukan Reservasi',
					text: '<?= $message ?>',
					type: 'warning',
					onClose: () => {
						location.href = '<?= $header ?>.php';
					}
				});
			<?php } ?>
		});
	</script>
<?php }

require('../config.php');

// ACTION ADD
store($conn);
function store($conn) {
	// TAMBAH USER
	if (isset($_POST['signup'])) {
		$nama = $_POST['nama'];
		$umur = $_POST['umur'];
		$alamat = $_POST['alamat'];
		$jenis_kelamin = $_POST['jenis_kelamin'];
		$telepon = $_POST['telepon'];
		$email = $_POST['email'];
		$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		mysqli_query($conn, "INSERT INTO tb_users VALUES (NULL, '$nama', '$umur', '$alamat', '$jenis_kelamin', '$telepon', 'new', '$email', '$password')");

		if (mysqli_affected_rows($conn) > 0) {
			ini_set( 'display_errors', 1 );   
			error_reporting( E_ALL );

			$id = mysqli_insert_id($conn);
			$headers = "From:admin-pamatata@tryapp.my.id";
			$pesan = '
Pendaftaran anda sedang di proses. Silahkan klik tautan berikut untuk memverifikasi akun anda. Abaikan email ini jika anda merasa tidak pernah melakukan registrasi di SIPD Pamatata.

Link Verifikasi: 
https://pamatata.tryapp.my.id/users/konfirmasi.php?user_id='.$id;
			mail($email, 'Konfirmasi Akun', $pesan, $headers);

			$message = 'Akun anda berhasil dibuat';
			plugins('success', $message, 'login');
		} else {
			$message = 'Terjadi Kesalahan Saat Mendaftar';
			plugins('error', $message, 'signin');
		}
	}

	// RESERVASI
	if (isset($_POST['store_reservasi'])) {
		$user_id = $_POST['user_id'];
		$kd_pendaftaran = $_POST['kd_pendaftaran'];
		$kapal_id = $_POST['kapal_id'];
		$get_kapal = mysqli_query($conn, "SELECT * FROM tb_kapal WHERE id='$kapal_id'");
		$kapal = mysqli_fetch_assoc($get_kapal);
		$tujuan = $kapal['tujuan'];
		$tanggal_daftar = date('Y-m-d H:i:s');

		// Input Penumpang
		$harga = [];
		$harga_kendaraan = 0;
		foreach ($_POST['nomor_tiket'] as $i => $data) {
			$nomor_tiket = $_POST['nomor_tiket'][$i];
			$nama = $_POST['nama'][$i];
			$jenis_kelamin = $_POST['jenis_kelamin'][$i];
			$umur = $_POST['umur'][$i];
			$alamat = $_POST['alamat'][$i];

			$kategori_harga = mysqli_query($conn, "SELECT * FROM tb_harga ORDER BY from_age DESC");
			$kategori = '';
			foreach ($kategori_harga as $ktg) {
				if ($ktg['from_age'] <= $umur && $ktg['to_age'] >= $umur) {
					$kategori = $ktg['kategori'];
					$harga[] = $ktg['harga'];
				}
				$more[] = ['to_age' => $ktg['to_age'], 'kategori' => $ktg['kategori'], 'harga' => $ktg['harga']];
			}

			if ($kategori == '') {
				$mr = max($more);
				$kategori = $mr['kategori'];
				$harga[] = $mr['harga'];
			}

			mysqli_query($conn, "INSERT INTO tb_penumpang VALUES (NULL, '$user_id', '$kapal_id', '$tujuan', '$kd_pendaftaran', '$nomor_tiket', '$nama', '$umur', '$alamat', '$jenis_kelamin', '$kategori', '$tanggal_daftar', 'Panding')");
		}


		// Input Kendaraan
		if ($_POST['golongan_id'] > 0) {
			$no_tiket_kendaraan = $_POST['no_tiket_kendaraan'];
			$golongan_id = $_POST['golongan_id'];
			$nama_sopir = $_POST['nama_sopir'];
			$merek_kendaraan = $_POST['merek_kendaraan'];
			$nomor_kendaraan = $_POST['nomor_kendaraan'];

			$get_golongan = mysqli_query($conn, "SELECT * FROM tb_golongan WHERE id='$golongan_id'");
			$gol = mysqli_fetch_assoc($get_golongan);
			$harga_kendaraan = $gol['harga'];

			mysqli_query($conn, "INSERT INTO tb_kendaraan VALUES (NULL, '$user_id', '$kapal_id', '$golongan_id', '$kd_pendaftaran', '$no_tiket_kendaraan', '$nama_sopir', '$merek_kendaraan', '$nomor_kendaraan')");
		}

		// Input Transaksi
		$total_harga_tiket = array_sum($harga);
		$biaya_kendaraan = $harga_kendaraan;
		$total_harga = $total_harga_tiket + $harga_kendaraan;
		
		mysqli_query($conn, "INSERT INTO tb_transaksi VALUES (NULL, '$kd_pendaftaran', '$user_id', '$total_harga_tiket', '$biaya_kendaraan', '$total_harga', 'Belum Lunas')");

		if (mysqli_affected_rows($conn) > 0) {
			$message = 'Reservasi berhasil. Silahkan lakukan pembayaran di loket dengan menunjukkan Kode Transaksi selambat lambatnya 1x24 jam';
			plugins('success', $message, 'data-reservasi');
		} else {
			$message = 'Terjadi kesalahan saat melakukan reservasi';
			plugins('error', $message, 'reservasi');
		}
	}

	if (isset($_POST['kirim_pesan'])) {
		$nama = $_POST['nama'];
		$email = $_POST['email'];
		$pesan = $_POST['pesan'];
		$waktu = date('Y-m-d H:i:s');
		mysqli_query($conn, "INSERT INTO tb_pesan VALUES (NULL, '$nama', '$email', '$pesan', '$waktu', 'send')");

		if (mysqli_affected_rows($conn) > 0) {
			$message = 'Pesan anda telah terkirim ke Admin';
			plugins('success', $message, '../index');
		} else {
			$message = 'Terjadi Kesalahan Saat Mendaftar';
			plugins('error', $message, '../index');
		}
	}
}

// ACTION EDITE 
update($conn);
function update($conn) {
	if (isset($_GET['batalkan_reservasi'])) {
		$resevasi_id = $_GET['resevasi_id'];
		$transaksi = mysqli_query($conn, "UPDATE tb_transaksi SET status='Batal' WHERE kd_transaksi='$resevasi_id'");
		$penumpang = mysqli_query($conn, "UPDATE tb_penumpang SET status='Batal' WHERE kd_pendaftaran='$resevasi_id'");

		if ($transaksi && $penumpang) {
			$message = 'Reservasi telah berhasil dibatalkan';
			plugins('success', $message, 'data-reservasi');
		} else {
			$message = 'Terjadi Kesalahan Saat Memproses';
			plugins('error', $message, 'data-reservasi');
		}
	}

	if (isset($_POST['update_profile'])) {
		$id = $_POST['id'];
		$nama = $_POST['nama'];
		$old_nama = $_POST['old_nama'];
		$umur = $_POST['umur'];
		$alamat = $_POST['alamat'];
		$jenis_kelamin = $_POST['jenis_kelamin'];
		$telepon = $_POST['telepon'];
		$email = $_POST['email'];
		if ($_POST['password'] != '') {
			$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		} else {
			$password = $_POST['old_password'];
		}

		$update = mysqli_query($conn, "UPDATE tb_users SET nama='$nama', umur='$umur', alamat='$alamat', jenis_kelamin='$jenis_kelamin', telepon='$telepon', email='$email', password='$password' WHERE id='$id'");

		$updt_pnmpg = mysqli_query($conn, "UPDATE tb_penumpang SET nama='$nama' WHERE nama='$old_nama' AND user_id='$id'");

		if ($update) {
			$message = 'Profil berhasil diupdate';
			plugins('success', $message, 'profile');
		} else {
			$message = 'Terjadi kesalahan saat mengapdate';
			plugins('error', $message, 'profile');
		}
	}
}

// ACTION DELETE 
delete($conn);
function delete($conn) {

}

// ACTION CONFIG 
config($conn);
function config($conn) {
	$get_penumpang = mysqli_query($conn, "SELECT * FROM tb_penumpang");
	$total_penumpang = mysqli_num_rows($get_penumpang);

	if (isset($_POST['one_only'])) {
		$id = $_POST['user_id'];
		$get_user = mysqli_query($conn, "SELECT * FROM tb_users WHERE id='$id'");
		$user = mysqli_fetch_assoc($get_user);
		$jenis_kelamin = ['Laki-laki', 'Perempuan'];
		$jns_kel = '';
		foreach ($jenis_kelamin as $jk) {
			if ($jk == $user['jenis_kelamin']) $select = 'selected';
			else $select = '';

			$jns_kel .= '<option value="'.$jk.'" '.$select.'>'.$jk.'</option>';
		}
		$form = '
		<div class="form-group">
		<label class="col-form-label">Nomor Tiket</label>
		<input type="text" class="form-control bg-white" placeholder="Nomor Tiket..." name="nomor_tiket[]" required="" value="'.generet_tiket($_POST['kapal_id'], $id, $total_penumpang + 1).'" readonly="">
		</div>
		<div class="form-group">
		<label class="col-form-label">Nama</label>
		<input type="text" class="form-control" placeholder="Masukkan Nama..." name="nama[]" required="" autocomplete="off" value="'.$user['nama'].'">
		</div>
		<div class="form-group">
		<label class="col-form-label">Jenis Kelamin</label>
		<select class="form-control" name="jenis_kelamin[]" required="">
		<option value="">-- Jenis Kelamin --</option>
		'.$jns_kel.'
		</select>
		</div>
		<div class="form-group">
		<label class="col-form-label">Umur</label>
		<input type="number" class="form-control" placeholder="Masukkan Umur..." name="umur[]" required="" autocomplete="off" value="'.$user['umur'].'">
		</div>
		<div class="form-group">
		<label class="col-form-label">Alamat</label>
		<textarea class="form-control" rows="3" placeholder="Masukkan Alamat..." name="alamat[]" required="">'.$user['alamat'].'</textarea>
		</div>';
		echo $form;
	}

	if (isset($_POST['one_more'])) {
		$jum_pnmpng = $_POST['jum_pnmpng'];
		$item = '';
		$form = '';
		for ($i=1; $i <= $jum_pnmpng; $i++) { 
			if ($i == 1) {
				$id = $_POST['user_id'];
				$get_user = mysqli_query($conn, "SELECT * FROM tb_users WHERE id='$id'");
				$user = mysqli_fetch_assoc($get_user);
				$active = 'active show';
				$nama = $user['nama'];
				$umur = $user['umur'];
				$alamat = $user['alamat'];
				$jenis_kelamin = ['Laki-laki', 'Perempuan'];
				$jns_kel = '';
				foreach ($jenis_kelamin as $jk) {
					if ($jk == $user['jenis_kelamin']) $select = 'selected';
					else $select = '';

					$jns_kel .= '<option value="'.$jk.'" '.$select.'>'.$jk.'</option>';
				}
			}
			else {
				$active = '';
				$nama = '';
				$umur = '';
				$alamat = '';
				$jenis_kelamin = ['Laki-laki', 'Perempuan'];
				$jns_kel = '';
				foreach ($jenis_kelamin as $jk) {
					$jns_kel .= '<option value="'.$jk.'">'.$jk.'</option>';
				}
			}
			$item .= '<li class="nav-item" style="width: 50px;"><a class="nav-link border '.$active.'" href="#penumpang'.$i.'" role="tab" data-toggle="tab" aria-selected="true" style="min-width: 50%;">'.$i.'</a></li>';
			$form .= '
			<div class="tab-pane '.$active.'" id="penumpang'.$i.'">
			<div class="form-group">
			<label class="col-form-label">Nomor Tiket</label>
			<input type="text" class="form-control bg-white" placeholder="Nomor Tiket..." name="nomor_tiket[]" required="" value="'.generet_tiket($_POST['kapal_id'], $id, $total_penumpang + $i).'" readonly="">
			</div>
			<div class="form-group">
			<label class="col-form-label">Nama</label>
			<input type="text" class="form-control" placeholder="Masukkan Nama..." name="nama[]" required="" autocomplete="off" value="'.$nama.'">
			</div>
			<div class="form-group">
			<label class="col-form-label">Jenis Kelamin</label>
			<select class="form-control" name="jenis_kelamin[]" required="">
			<option value="">-- Jenis Kelamin --</option>
			'.$jns_kel.'
			</select>
			</div>
			<div class="form-group">
			<label class="col-form-label">Umur</label>
			<input type="number" class="form-control" placeholder="Masukkan Umur..." name="umur[]" required="" autocomplete="off" value="'.$umur.'">
			</div>
			<div class="form-group">
			<label class="col-form-label">Alamat</label>
			<textarea class="form-control" rows="3" placeholder="Masukkan Alamat..." name="alamat[]" required="">'.$alamat.'</textarea>
			</div>
			</div>';
		}
		$content = '
		<ul class="nav nav-pills nav-pills-icons pl-0" role="tablist">
		'.$item.'
		</ul>
		<div class="tab-content tab-space" style="margin-bottom: -50px">
		'.$form.'
		</div>
		';

		echo $content;
	}

	if (isset($_POST['no_regis'])) {
		$get_transaksi = mysqli_query($conn, "SELECT * FROM tb_transaksi");
		$transaksi = mysqli_num_rows($get_transaksi);
		$no_regis = 'REG-'.sprintf('%03d', $_POST['user_id']).sprintf('%04d', $transaksi + 1);
		echo $no_regis;
	}

	if (isset($_POST['tiket_kendaraan'])) {
		$get_total_kendaraan = mysqli_query($conn, "SELECT * FROM tb_kendaraan");
		$total_kendaraan = mysqli_num_rows($get_total_kendaraan);
		$tiket = sprintf('%02d', $_POST['kapal_id']).sprintf('%02d', $_POST['user_id']).' 532 '.sprintf('%07d', $total_kendaraan + 1);
		echo $tiket;
	}

	if (isset($_GET['reservasi_exits'])) {
		if ($_GET['status'] == 'success') {
			$message = 'Anda baru-baru ini telah menyelesaikan reservasi. Untuk sementara anda belum bisa melakukan reservasi dalam waktu 1x24 Jam.';
		} else {
			$message = 'Anda belum menyelesaikan reservasi sebelummnya. Selesaikan terlebih dahulu untuk melakukan reservasi lain.';
		}
		plugins('warning', $message, 'data-reservasi');
	}

	if (isset($_POST['cek_kps_penumpang'])) {
		$kapal_id = $_POST['kapal_id'];
		$kapal = mysqli_query($conn, "SELECT * FROM tb_kapal WHERE id='$kapal_id'");
		$kpl = mysqli_fetch_assoc($kapal);

		$penumpang = mysqli_query($conn, "SELECT * FROM tb_penumpang WHERE kapal_id='$kapal_id' AND status='Panding'");
		$jum_penumpang = mysqli_num_rows($penumpang);

		if ($jum_penumpang >= $kpl['kapasitas']) {
			echo "full";
		}
	}

	if (isset($_POST['cek_kps_kendaraan'])) {
		$golongan_id = $_POST['golongan_id'];
		$golongan = mysqli_query($conn, "SELECT * FROM tb_golongan WHERE id='$golongan_id'");
		$gol = mysqli_fetch_assoc($golongan);

		$kendaraan = mysqli_query($conn, "SELECT * FROM tb_kendaraan WHERE golongan_id='$golongan_id'");
		$jum_kendaraan = 0;
		foreach ($kendaraan as $kdr) {
			$kd_transaksi = $kdr['kd_pendaftaran'];
			$transaksi = mysqli_query($conn, "SELECT * FROM tb_transaksi WHERE kd_transaksi='$kd_transaksi'");
			$trs = mysqli_fetch_assoc($transaksi);
			if ($trs['status'] == 'Belum Lunas') {
				$jum_kendaraan = $jum_kendaraan + 1;
			}
		}

		if ($jum_kendaraan >= $gol['kapasitas']) {
			echo "full";
		}
	}
}

function generet_tiket($kd_kapal, $kd_user, $total_penumpang) {
	$tiket = sprintf('%02d', $kd_kapal).sprintf('%02d', $kd_user).' 740 '.sprintf('%07d', $total_penumpang);
	return $tiket;
}
?>
