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
					text: 'Data baru berhasil di<?= $proses ?>',
					type: 'success',
					onClose: () => {
						location.href = '<?= $header ?>.php';
					}
				});
			<?php } else { ?>
				Swal.fire({
					title: 'Gagal Diproses',
					text: 'Data gagal di<?= $proses ?>',
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
	// TAMBAH KALAP
	if (isset($_POST['tambah_kapal'])) {
		$nama_kapal = $_POST['nama_kapal'];
		$harga = $_POST['harga'];
		$keterangan = $_POST['keterangan'];
		mysqli_query($conn, "INSERT INTO tb_kapal VALUES (NULL, '$nama_kapal', '$harga', '$keterangan')");

		if (mysqli_affected_rows($conn) > 0) {
			plugins('success', 'tambah', 'data-kapal');
		} else {
			plugins('error', 'tambah', 'data-kapal');
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