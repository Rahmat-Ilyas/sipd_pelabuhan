<?php
// Midtrans
// namespace Midtrans;

// require('vendor/midtrans/midtrans-php/Midtrans.php');

//Set Your server key
// Config::$serverKey = "SB-Mid-server-ihGWw0dDF4hux9R5jAx7GeBd";

// Uncomment for production environment
// Config::$isProduction = true;

// Enable sanitization
// Config::$isSanitized = true;

// Enable 3D-Secure
// Config::$is3ds = true;

// Uncomment for append and override notification URL
// Config::$appendNotifUrl = "https://example.com";
// Config::$overrideNotifUrl = "https://example.com";


date_default_timezone_set("Asia/Makassar");
session_start();
$conn = mysqli_connect("localhost","rahmat_ryu","","db_pelabuhan");

// Batalkan Reservasi
$reservasi = mysqli_query($conn, "SELECT * FROM tb_transaksi WHERE status='Belum Lunas'");
foreach ($reservasi as $dta) {
	if (!$dta['foto_transaksi']) {
		$kd_daftar = $dta['kd_transaksi'];
		$penumpang = mysqli_query($conn, "SELECT * FROM tb_penumpang WHERE kd_pendaftaran='$kd_daftar'");
		$tgl = mysqli_fetch_assoc($penumpang);
		$tanggal_daftar = $tgl['tanggal_daftar'];
		$tanggal_sekrng = date('Y-m-d H:i:s');

		if (strtotime($tanggal_daftar) + 3600 < strtotime($tanggal_sekrng)) {
			// Update Transaksi
			mysqli_query($conn, "UPDATE tb_transaksi SET status='Batal' WHERE kd_transaksi='$kd_daftar'");
			// Update Penumpang
			mysqli_query($conn, "UPDATE tb_penumpang SET status='Batal' WHERE kd_pendaftaran='$kd_daftar'");
		}
	}
}
?>