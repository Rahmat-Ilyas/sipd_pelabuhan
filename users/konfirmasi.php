<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/anchor.png">
	<link rel="icon" type="image/png" href="assets/img/anchor.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>
		Panel User - Pelabuhan Pamatata Selayar
	</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<!--     Fonts and icons     -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
	<!-- CSS Files -->
	<link href="assets/css/material-kit.css?v=2.0.7" rel="stylesheet" />
	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link href="assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="landing-page sidebar-collapse">
	<h1 id="error" class="text-center mt-5"></h1>
	<?php 
	require('../config.php');
	require('template/footer.php');
	?>

	<script>
		$(document).ready(function() {
			<?php if (isset($_GET['user_id'])) {
				$id = $_GET['user_id'];
				$user = mysqli_query($conn, "SELECT * FROM tb_users WHERE id='$id'");
				$usr = mysqli_fetch_assoc($user);
				if ($usr['status'] == 'new') { 
					mysqli_query($conn, "UPDATE tb_users SET status='acc' WHERE id='$id'"); ?>
					swal({
						title: "Berhasil Verifikasi?",
						html: "Akun anda berhasil di verifikasi, anda sudah bisa login",
						type: "success",
						confirmButtonText: 'Login',
						onClose: () => {
							location.href = "login.php";
						}
					});
				<?php } else { ?>
					$('#error').text('403 Forbidden');
				<?php }
			} else { ?>
				$('#error').text('403 Forbidden');
			<?php } ?>
			
		});
	</script>