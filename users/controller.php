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
			<?php } else { ?>
				Swal.fire({
					title: 'Gagal Diproses',
					text: '<?= $message ?>',
					type: 'error',
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
		mysqli_query($conn, "INSERT INTO tb_users VALUES (NULL, '$nama', '$umur', '$alamat', '$jenis_kelamin', '$telepon', '$email', '$password')");

		if (mysqli_affected_rows($conn) > 0) {
			$_SESSION['login_user'] = $password;
			$_SESSION['user_id'] = mysqli_insert_id($conn);

			$message = 'Akun anda berhasil dibuat';
			plugins('success', $message, 'panel');
		} else {
			$message = 'Terjadi Kesalahan Saat Mendaftar';
			plugins('error', $message, 'signin');
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
}
?>
