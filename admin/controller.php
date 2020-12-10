<?php 
function plugins($status, $proses, $header) { ?>
	<link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
	<script src="vendors/jquery/dist/jquery.min.js"></script>
	<script src="vendors/sweetalert2/sweetalert2.all.min.js"></script>

	<script>
		$(document).ready(function($) {
			<?php if ($status == 'success') { ?>
				Swal.fire({
					title: 'Berhasil Diproses',
					text: 'Data berhasil di<?= $proses ?>',
					type: 'success',
					onClose: () => {
						location.href = '<?= $header ?>.php';
					}
				});
			<?php } else if ($status == 'error') { ?>
				Swal.fire({
					title: 'Gagal Diproses',
					text: 'Data gagal di<?= $proses ?>',
					type: 'error',
					onClose: () => {
						location.href = '<?= $header ?>.php';
					}
				});
			<?php } else if ($status == 'warning') { ?>
				Swal.fire({
					title: 'Lengkapi Data',
					text: 'Lengkapi semua data yang di minta',
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
	// TAMBAH KALAP
	if (isset($_POST['tambah_kapal'])) {
		$nama_kapal = $_POST['nama_kapal'];
		$harga = $_POST['harga'];
		$keterangan = $_POST['keterangan'];
		mysqli_query($conn, "INSERT INTO tb_kapal VALUES (NULL, '$nama_kapal', '$harga', '$keterangan', NULL, NULL, 'Tidak Beroprasi')");

		if (mysqli_affected_rows($conn) > 0) {
			plugins('success', 'tambah', 'data-kapal');
		} else {
			plugins('error', 'tambah', 'data-kapal');
		}
	}

	// TAMBAH GOLONGAN
	if (isset($_POST['tambah_golongan'])) {
		$golongan = $_POST['golongan'];
		$jenis_kendaraan = $_POST['jenis_kendaraan'];
		$harga = $_POST['harga'];
		$keterangan = $_POST['keterangan'];
		mysqli_query($conn, "INSERT INTO tb_golongan VALUES (NULL, '$golongan', '$jenis_kendaraan', '$harga', '$keterangan')");

		if (mysqli_affected_rows($conn) > 0) {
			plugins('success', 'tambah', 'golongan-kendaraan');
		} else {
			plugins('error', 'tambah', 'golongan-kendaraan');
		}
	}

	// TAMBAH KATEGORI PENUMPANG
	if (isset($_POST['add_kategori_pnmpng'])) {
		$kategori = $_POST['kategori'];
		$from_age = $_POST['from_age'];
		$to_age = $_POST['to_age'];
		$harga = $_POST['harga'];
		mysqli_query($conn, "INSERT INTO tb_harga VALUES (NULL, '$kategori', '$from_age', '$to_age', '$harga')");

		if (mysqli_affected_rows($conn) > 0) {
			plugins('success', 'tambah', 'kategori-harga');
		} else {
			plugins('error', 'tambah', 'kategori-harga');
		}
	}
}

// ACTION EDITE 
update($conn);
function update($conn) {
	// EDITE KAPAL
	if (isset($_POST['edit_kapal'])) {
		$id = $_POST['id'];
		$nama_kapal = $_POST['nama_kapal'];
		$harga = $_POST['harga'];
		$keterangan = $_POST['keterangan'];
		$update = mysqli_query($conn, "UPDATE tb_kapal SET nama_kapal='$nama_kapal', harga='$harga', keterangan='$keterangan' WHERE id=$id");

		if ($update) {
			plugins('success', 'edit', 'data-kapal');
		} else {
			plugins('error', 'edit', 'data-kapal');
		}
	}

	// EDITE GOLONGAN
	if (isset($_POST['edit_golongan'])) {
		$id = $_POST['id'];
		$golongan = $_POST['golongan'];
		$jenis_kendaraan = $_POST['jenis_kendaraan'];
		$harga = $_POST['harga'];
		$keterangan = $_POST['keterangan'];
		$update = mysqli_query($conn, "UPDATE tb_golongan SET golongan='$golongan', jenis_kendaraan='$jenis_kendaraan', harga='$harga', keterangan='$keterangan' WHERE id=$id");

		if ($update) {
			plugins('success', 'edit', 'golongan-kendaraan');
		} else {
			plugins('error', 'edit', 'golongan-kendaraan');
		}
	}

	// EDITE KATEGORI PENUMPANG
	if (isset($_POST['edt_kategori_pnmpng'])) {
		$id = $_POST['id'];
		$kategori = $_POST['kategori'];
		$from_age = $_POST['from_age'];
		$to_age = $_POST['to_age'];
		$harga = $_POST['harga'];
		$update = mysqli_query($conn, "UPDATE tb_harga SET kategori='$kategori', from_age='$from_age', to_age='$to_age', harga='$harga' WHERE id=$id");

		if ($update) {
			plugins('success', 'edit', 'kategori-harga');
		} else {
			plugins('error', 'edit', 'kategori-harga');
		}
	}

	// UPDATE PROFIL ADMIN
	if (isset($_POST['update_profile'])) {
		$id = $_POST['id'];
		$nama = $_POST['nama'];
		$username = $_POST['username'];
		if ($_POST['password'] != '') {
			$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		} else {
			$password = $_POST['old_password'];
		}

		$update = mysqli_query($conn, "UPDATE tb_admin SET nama='$nama', username='$username', password='$password' WHERE id='$id'");

		if ($update) {
			plugins('success', 'update', 'index');
		} else {
			plugins('error', 'update', 'index');
		}
	}

	// UDATE PENGUMUMAN
	if (isset($_POST['save_pengumuman'])) {
		$judul = $_POST['judul'];
		$pengumuman = $_POST['pengumuman'];
		$waktu = date('Y-m-d H:i:s');

		$update = mysqli_query($conn, "UPDATE tb_pengumuman SET judul='$judul', pengumuman='$pengumuman', waktu='$waktu'");

		if ($update) {
			plugins('success', 'update', 'pengumuman');
		} else {
			plugins('error', 'update', 'pengumuman');
		}
	}

	if (isset($_GET['delete_pengumuman'])) {
		$update = mysqli_query($conn, "UPDATE tb_pengumuman SET judul=NULL, pengumuman=NULL, waktu=NULL");

		if ($update) {
			plugins('success', 'hapus', 'pengumuman');
		} else {
			plugins('error', 'hapus', 'pengumuman');
		}
	}

	// UPDATE JADWAL KAPAL
	if (isset($_POST['update_jadwal'])) {
		$id = $_POST['kapal_id'];
		$status = $_POST['status'];
		$tujuan = $_POST['tujuan'];
		$tanggal = $_POST['tanggal'];
		$jam = $_POST['jam'];

		if ($status == 'Tidak Beroprasi') {
			$query = "UPDATE tb_kapal SET tujuan=NULL, waktu_berangkat=NULL, status='$status' WHERE id='$id'";
		} else {
			if ($tujuan == '' || $tanggal == '' || $jam == '') {
				plugins('warning', 'update', 'jadwal-keberangkatan');
				exit();
			}

			$waktu_berangkat = $tanggal.' '.$jam;
			$query = "UPDATE tb_kapal SET tujuan='$tujuan', waktu_berangkat='$waktu_berangkat', status='$status' WHERE id='$id'";
		}
		$update = mysqli_query($conn, $query);

		if ($update) {
			plugins('success', 'update', 'jadwal-keberangkatan');
		} else {
			plugins('error', 'update', 'jadwal-keberangkatan');
		}
	}

	// SELESAI TRANSAKSI
	if (isset($_GET['transaksi_selesai'])) {
		$kd = $_GET['kd_transaksi'];

		// Update Transaksi
		$transaksi = mysqli_query($conn, "UPDATE tb_transaksi SET status='Lunas' WHERE kd_transaksi='$kd'");
		// Update Penumpang
		$penumpang = mysqli_query($conn, "UPDATE tb_penumpang SET status='Selesai' WHERE kd_pendaftaran='$kd'");

		if ($transaksi && $penumpang) {
			plugins('success', 'update. Transaksi selesai', 'transaksi');
		} else {
			plugins('error', 'update. Transaksi gagal', 'transaksi');
		}
	}
}

// ACTION DELETE 
delete($conn);
function delete($conn) {
	// DELETE KAPAL
	if (isset($_GET['delete_kapal'])) {
		$id = $_GET['id'];
		mysqli_query($conn, "DELETE FROM tb_kapal WHERE id=$id");

		if (mysqli_affected_rows($conn) > 0) {
			plugins('success', 'hapus', 'data-kapal');
		} else {
			plugins('error', 'hapus', 'data-kapal');
		}
	}

	// DELETE GOLONGAN
	if (isset($_GET['delete_golongan'])) {
		$id = $_GET['id'];
		mysqli_query($conn, "DELETE FROM tb_golongan WHERE id=$id");

		if (mysqli_affected_rows($conn) > 0) {
			plugins('success', 'hapus', 'golongan-kendaraan');
		} else {
			plugins('error', 'hapus', 'golongan-kendaraan');
		}
	}

	// DELETE KATEGORI PENUMPANG
	if (isset($_GET['del_kategori_pnmpng'])) {
		$id = $_GET['id'];
		mysqli_query($conn, "DELETE FROM tb_harga WHERE id=$id");

		if (mysqli_affected_rows($conn) > 0) {
			plugins('success', 'hapus', 'kategori-harga');
		} else {
			plugins('error', 'hapus', 'kategori-harga');
		}
	}
}

// ACTION CONFIG
config($conn);
function config($conn) {
	if (isset($_POST['set_print'])) {
		$id = $_POST['id'];

		$penumpang = mysqli_query($conn, "SELECT * FROM tb_penumpang WHERE id='$id'");
		$pen = mysqli_fetch_assoc($penumpang);

		$kpl_id = $pen['kapal_id'];
		$kapal = mysqli_query($conn, "SELECT * FROM tb_kapal WHERE id='$kpl_id'");
		$kpl = mysqli_fetch_assoc($kapal);

		$ktgr = $pen['kategori'];
		$kategori = mysqli_query($conn, "SELECT * FROM tb_harga WHERE kategori='$ktgr'");
		$ktg = mysqli_fetch_assoc($kategori);

		$data = [];
		$data['nomor_tiket'] = $pen['nomor_tiket'];
		$data['tujuan'] = $pen['tujuan'];
		$data['kategori'] = $pen['kategori'];
		$data['umur'] = $pen['umur'];
		$data['tanggal1'] = date('d M Y', strtotime($pen['tanggal_daftar']));
		$data['kapal'] = $kpl['nama_kapal'];
		$data['nama'] = $pen['nama'];
		$data['jenis_kelamin'] = $pen['jenis_kelamin'];
		$data['harga1'] = $ktg['harga'];
		$data['harga2'] = $ktg['harga'];
		$data['tanggal2'] = date('d/m/Y', strtotime($pen['tanggal_daftar']));

		header('Content-type: application/json');
		echo json_encode($data);
	}
}
?>