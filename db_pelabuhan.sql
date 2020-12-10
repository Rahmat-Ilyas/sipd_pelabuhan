-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Des 2020 pada 05.53
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pelabuhan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) COLLATE armscii8_bin NOT NULL,
  `username` varchar(255) COLLATE armscii8_bin NOT NULL,
  `password` varchar(255) COLLATE armscii8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id`, `nama`, `username`, `password`) VALUES
(1, 'Administrator', 'admin', '$2y$10$QgpXDnoMd9.HjTZs5xZEQeD/EIrKJzf9GX.0DRUwbVInmWcNPbuKe');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_golongan`
--

CREATE TABLE `tb_golongan` (
  `id` int(11) NOT NULL,
  `golongan` varchar(20) COLLATE armscii8_bin NOT NULL,
  `jenis_kendaraan` varchar(255) COLLATE armscii8_bin NOT NULL,
  `harga` int(11) NOT NULL,
  `keterangan` varchar(255) COLLATE armscii8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Dumping data untuk tabel `tb_golongan`
--

INSERT INTO `tb_golongan` (`id`, `golongan`, `jenis_kendaraan`, `harga`, `keterangan`) VALUES
(1, 'Golongan 3', 'Motor', 20000, 'Kendaraan roda 2'),
(2, 'Golongan 4', 'Mobil Pribadi', 25000, 'Kendaraan roda 4'),
(4, 'Golongan 5', 'Truk kecil', 40000, 'Truk kecil rod 4'),
(5, 'Golongan 6', 'Truk Besar/Bis', 50000, 'Truk beasr atau Bis (Roda 6)'),
(6, 'Golongan 7', 'Truk Besar', 55000, 'Truk besar 10 roda'),
(7, 'Golongan 8', 'Mobil Kontainer', 65000, 'Mobil kontainer besar 16 roda');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_harga`
--

CREATE TABLE `tb_harga` (
  `id` int(11) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `from_age` int(11) NOT NULL,
  `to_age` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_harga`
--

INSERT INTO `tb_harga` (`id`, `kategori`, `from_age`, `to_age`, `harga`) VALUES
(1, 'Balita', 0, 11, 5000),
(2, 'Anak-anak', 12, 16, 20000),
(3, 'Dewasa', 17, 100, 25000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kapal`
--

CREATE TABLE `tb_kapal` (
  `id` int(11) NOT NULL,
  `nama_kapal` varchar(255) COLLATE armscii8_bin NOT NULL,
  `harga` double NOT NULL,
  `keterangan` varchar(255) COLLATE armscii8_bin NOT NULL,
  `tujuan` varchar(255) COLLATE armscii8_bin DEFAULT NULL,
  `waktu_berangkat` datetime DEFAULT NULL,
  `status` varchar(20) COLLATE armscii8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Dumping data untuk tabel `tb_kapal`
--

INSERT INTO `tb_kapal` (`id`, `nama_kapal`, `harga`, `keterangan`, `tujuan`, `waktu_berangkat`, `status`) VALUES
(6, 'Kapal Veri', 20000, 'Baik digunakan', 'Bulukumba', '2020-12-08 20:45:00', 'Sandar'),
(7, 'Kapal Layar', 25000, 'Buruk sekali 2', 'Tarakang', '2020-12-09 06:30:00', 'Sandar'),
(8, 'Kapal B Aja Ji', 10000, 'Ya B aja lah pokoknya', NULL, NULL, 'Tidak Beroprasi'),
(10, 'Kapal Titanic', 20000, 'Kapal Besar', 'Balikpapan', '2020-12-08 21:00:00', 'Sandar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kendaraan`
--

CREATE TABLE `tb_kendaraan` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) COLLATE armscii8_bin NOT NULL,
  `kapal_id` int(11) NOT NULL,
  `golongan_id` int(11) NOT NULL,
  `kd_pendaftaran` varchar(255) COLLATE armscii8_bin NOT NULL,
  `nomor_tiket` varchar(255) COLLATE armscii8_bin NOT NULL,
  `nama_sopir` varchar(255) COLLATE armscii8_bin NOT NULL,
  `merek_kendaraan` varchar(255) COLLATE armscii8_bin NOT NULL,
  `nomor_kendaraan` varchar(255) COLLATE armscii8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Dumping data untuk tabel `tb_kendaraan`
--

INSERT INTO `tb_kendaraan` (`id`, `user_id`, `kapal_id`, `golongan_id`, `kd_pendaftaran`, `nomor_tiket`, `nama_sopir`, `merek_kendaraan`, `nomor_kendaraan`) VALUES
(1, '2', 6, 2, 'REG-0020001', '0602 532 0000001', 'Nur Islamia', 'Avansa', 'DD 2020 HR'),
(2, '1', 6, 1, 'REG-0010003', '0601 532 0000002', 'Rahmat Ilyas', 'Yahmah Jupiter Z1', 'DD 5851 HU'),
(3, '3', 10, 2, 'REG-0030004', '1003 532 0000003', 'Wahyuddin Annur', 'Kijang', 'DD 3322 HK'),
(4, '4', 6, 5, 'REG-0040006', '0604 532 0000004', 'Muhammad Ilham', 'Bus Tayo', 'DK 5562 SB'),
(5, '4', 6, 4, 'REG-0040007', '0604 532 0000005', 'Muhammad Ilham', 'Truk Mitsuha', 'DD 5532 SA'),
(6, '4', 10, 1, 'REG-0040009', '1004 532 0000006', 'Muhammad Ilham', 'Yamaha Jupiter Z1', 'DW 4398 DD'),
(7, '3', 7, 2, 'REG-0030011', '0703 532 0000007', 'Wahyuddin Annur', 'Toyota', 'DD 5542 HS'),
(8, '1', 7, 2, 'REG-0010012', '0701 532 0000008', 'Rahmat Ilyas', 'Honda', 'DD 4432 HS'),
(9, '5', 7, 2, 'REG-0050013', '0705 532 0000009', 'Andi Nur Hidayah', 'Avansa', 'DD 9980 HI');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengumuman`
--

CREATE TABLE `tb_pengumuman` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `pengumuman` text DEFAULT NULL,
  `waktu` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pengumuman`
--

INSERT INTO `tb_pengumuman` (`id`, `judul`, `pengumuman`, `waktu`) VALUES
(1, 'Perubahan Jadwal Keberangkatan', 'I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus. I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at.', '2020-12-08 16:20:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_penumpang`
--

CREATE TABLE `tb_penumpang` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `kapal_id` int(11) NOT NULL,
  `tujuan` varchar(255) COLLATE armscii8_bin NOT NULL,
  `kd_pendaftaran` varchar(255) COLLATE armscii8_bin NOT NULL,
  `nomor_tiket` varchar(255) COLLATE armscii8_bin NOT NULL,
  `nama` varchar(255) COLLATE armscii8_bin NOT NULL,
  `umur` int(11) NOT NULL,
  `alamat` varchar(255) COLLATE armscii8_bin NOT NULL,
  `jenis_kelamin` varchar(255) COLLATE armscii8_bin NOT NULL,
  `kategori` varchar(255) COLLATE armscii8_bin NOT NULL,
  `tanggal_daftar` datetime NOT NULL,
  `status` varchar(255) COLLATE armscii8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Dumping data untuk tabel `tb_penumpang`
--

INSERT INTO `tb_penumpang` (`id`, `user_id`, `kapal_id`, `tujuan`, `kd_pendaftaran`, `nomor_tiket`, `nama`, `umur`, `alamat`, `jenis_kelamin`, `kategori`, `tanggal_daftar`, `status`) VALUES
(1, 2, 6, 'Bulukumba', 'REG-0020001', '0602 740 0000001', 'Nur Islamia', 22, 'Selayar Barat', 'Perempuan', 'Dewasa', '2020-12-07 14:00:05', 'Batal'),
(2, 2, 6, 'Bulukumba', 'REG-0020001', '0602 740 0000002', 'Taliatul Kurani', 7, 'Palattae', 'Perempuan', 'Balita', '2020-12-07 14:00:05', 'Batal'),
(3, 2, 6, 'Bulukumba', 'REG-0020001', '0602 740 0000003', 'Algifari', 13, 'Karangpuang', 'Laki-laki', 'Anak-anak', '2020-12-07 14:00:05', 'Batal'),
(4, 1, 6, 'Bulukumba', 'REG-0010002', '0601 740 0000004', 'Rahmat Ilyas', 22, 'Jl. Poros Summbarrang, Patallassang, Kab. Gowa', 'Laki-laki', 'Dewasa', '2020-12-07 13:44:34', 'Selesai'),
(5, 1, 6, 'Bulukumba', 'REG-0010003', '0601 740 0000005', 'Rahmat Ilyas', 22, 'Jl. Poros Summbarrang, Patallassang, Kab. Gowa', 'Laki-laki', 'Dewasa', '2020-12-07 19:26:41', 'Batal'),
(6, 1, 6, 'Bulukumba', 'REG-0010003', '0601 740 0000006', 'Ayu Anitha', 21, 'Jl. Jenral Sudirman Bulukumba', 'Perempuan', 'Dewasa', '2020-12-07 19:26:41', 'Batal'),
(7, 3, 10, 'Malaisya', 'REG-0030004', '1003 740 0000007', 'Wahyuddin Annur', 23, 'Jl Bunga Harapan, Tanete', 'Laki-laki', 'Dewasa', '2020-12-08 02:20:13', 'Selesai'),
(8, 2, 10, 'Malaisya', 'REG-0020005', '1002 740 0000008', 'Nur Islamia', 22, 'Selayar Barat, Kabupaten Selayar', 'Perempuan', 'Dewasa', '2020-12-08 02:00:17', 'Batal'),
(9, 2, 10, 'Malaisya', 'REG-0020005', '1002 740 0000009', 'Jumiati Burhan', 21, 'Jl. Antang Raya', 'Perempuan', 'Dewasa', '2020-12-08 02:00:17', 'Batal'),
(10, 4, 6, 'Bulukumba', 'REG-0040006', '0604 740 0000010', 'Muhammad Ilham', 23, 'Patallassang City', 'Laki-laki', 'Dewasa', '2020-12-08 13:20:29', 'Batal'),
(11, 4, 6, 'Bulukumba', 'REG-0040007', '0604 740 0000011', 'Muhammad Ilham', 23, 'Patallassang City', 'Laki-laki', 'Dewasa', '2020-12-08 13:22:21', 'Batal'),
(12, 4, 7, 'Tarakang', 'REG-0040008', '0704 740 0000012', 'Muhammad Ilham', 23, 'Patallassang City', 'Laki-laki', 'Dewasa', '2020-12-08 21:40:24', 'Batal'),
(13, 4, 10, 'Balikpapan', 'REG-0040009', '1004 740 0000013', 'Muhammad Ilham', 23, 'Patallassang City', 'Laki-laki', 'Dewasa', '2020-12-08 22:56:05', 'Selesai'),
(14, 4, 10, 'Balikpapan', 'REG-0040009', '1004 740 0000014', 'Malika Putri', 17, 'Patallassang, Kab. Gowa', 'Perempuan', 'Dewasa', '2020-12-08 22:56:05', 'Selesai'),
(15, 2, 7, 'Tarakang', 'REG-0020010', '0702 740 0000015', 'Nur Islamia', 22, 'Selayar Barat, Kabupaten Selayar', 'Perempuan', 'Dewasa', '2020-12-09 13:37:32', 'Panding'),
(16, 3, 7, 'Tarakang', 'REG-0030011', '0703 740 0000016', 'Wahyuddin Annur', 23, 'Jl Bunga Harapan, Tanete', 'Laki-laki', 'Dewasa', '2020-12-09 15:48:36', 'Selesai'),
(17, 1, 7, 'Tarakang', 'REG-0010012', '0701 740 0000017', 'Rahmat Ilyas', 22, 'Jl. Poros Summbarrang, Patallassang, Kab. Gowa', 'Laki-laki', 'Dewasa', '2020-12-09 22:59:53', 'Panding'),
(18, 5, 7, 'Tarakang', 'REG-0050013', '0705 740 0000018', 'Andi Nur Hidayah', 26, 'Jl. Printis Kemerdekaan', 'Perempuan', 'Dewasa', '2020-12-10 12:04:22', 'Selesai'),
(19, 5, 7, 'Tarakang', 'REG-0050013', '0705 740 0000019', 'Maya Ayu Lestari', 25, 'Jl. Antang Raya', 'Perempuan', 'Dewasa', '2020-12-10 12:04:26', 'Selesai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pesan`
--

CREATE TABLE `tb_pesan` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) COLLATE armscii8_bin NOT NULL,
  `email` varchar(255) COLLATE armscii8_bin NOT NULL,
  `pesan` text COLLATE armscii8_bin NOT NULL,
  `waktu` datetime NOT NULL,
  `status` varchar(20) COLLATE armscii8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Dumping data untuk tabel `tb_pesan`
--

INSERT INTO `tb_pesan` (`id`, `nama`, `email`, `pesan`, `waktu`, `status`) VALUES
(1, 'Rahmat Ilyas', 'rahmat.ilyas142@gmail.com', 'Bagaimana Cara Hidup???', '2020-12-07 22:02:57', 'read'),
(2, 'Rahmat Ilyas', 'rahmat.ilyas142@gmail.com', 'Tes Lgi Deh', '2020-12-07 22:03:33', 'read'),
(3, 'Muhammad Ilham', 'ile@gmail.com', 'Hai saya tes ya', '2020-12-08 18:21:17', 'read'),
(4, 'Wahyuddin Annur', 'wahyudin@gmail.com', 'Bagaimana Saya menyelesaikan pendaftaran ini', '2020-12-08 23:04:28', 'read'),
(5, 'Nur Islamia', 'nurislamia@gmail.com', 'Halo Admin ku', '2020-12-08 23:08:00', 'read'),
(6, 'Nur Islamia', 'nurislamia@gmail.com', 'Ku tes lagi dii', '2020-12-08 23:13:54', 'read');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id` int(11) NOT NULL,
  `kd_transaksi` varchar(255) COLLATE armscii8_bin NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_harga_tiket` double NOT NULL,
  `biaya_kendaraan` double NOT NULL,
  `total_harga` double NOT NULL,
  `status` varchar(20) COLLATE armscii8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id`, `kd_transaksi`, `user_id`, `total_harga_tiket`, `biaya_kendaraan`, `total_harga`, `status`) VALUES
(1, 'REG-0020001', 2, 50000, 20000, 70000, 'Batal'),
(2, 'REG-0010002', 1, 25000, 0, 25000, 'Lunas'),
(3, 'REG-0010003', 1, 50000, 20000, 70000, 'Batal'),
(4, 'REG-0030004', 3, 25000, 20000, 45000, 'Lunas'),
(5, 'REG-0020005', 2, 50000, 0, 50000, 'Batal'),
(6, 'REG-0040006', 4, 25000, 20000, 45000, 'Batal'),
(7, 'REG-0040007', 4, 25000, 20000, 45000, 'Batal'),
(8, 'REG-0040008', 4, 25000, 0, 25000, 'Batal'),
(9, 'REG-0040009', 4, 50000, 20000, 70000, 'Lunas'),
(10, 'REG-0020010', 2, 25000, 0, 25000, 'Belum Lunas'),
(11, 'REG-0030011', 3, 25000, 25000, 50000, 'Lunas'),
(12, 'REG-0010012', 1, 25000, 25000, 50000, 'Belum Lunas'),
(13, 'REG-0050013', 5, 50000, 25000, 75000, 'Lunas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_users`
--

CREATE TABLE `tb_users` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) COLLATE armscii8_bin NOT NULL,
  `umur` varchar(255) COLLATE armscii8_bin NOT NULL,
  `alamat` varchar(255) COLLATE armscii8_bin NOT NULL,
  `jenis_kelamin` varchar(255) COLLATE armscii8_bin NOT NULL,
  `telepon` varchar(255) COLLATE armscii8_bin NOT NULL,
  `email` varchar(255) COLLATE armscii8_bin NOT NULL,
  `password` varchar(255) COLLATE armscii8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Dumping data untuk tabel `tb_users`
--

INSERT INTO `tb_users` (`id`, `nama`, `umur`, `alamat`, `jenis_kelamin`, `telepon`, `email`, `password`) VALUES
(1, 'Rahmat Ilyas', '22', 'Jl. Poros Summbarrang, Patallassang, Kab. Gowa', 'Laki-laki', '085333341194', 'rahmat.ilyas142@gmail.com', '$2y$10$QgpXDnoMd9.HjTZs5xZEQeD/EIrKJzf9GX.0DRUwbVInmWcNPbuKe'),
(2, 'Nur Islamia', '22', 'Selayar Barat, Kabupaten Selayar', 'Perempuan', '085246335887', 'nurislamia@gmail.com', '$2y$10$QgpXDnoMd9.HjTZs5xZEQeD/EIrKJzf9GX.0DRUwbVInmWcNPbuKe'),
(3, 'Wahyuddin Annur', '23', 'Jl Bunga Harapan, Tanete', 'Laki-laki', '085233678335', 'wahyudin@gmail.com', '$2y$10$LOH7TfJasSU2yVmhGTpOAOpgXgzriMQVPKPiVuHFg5tvgykCT.ksa'),
(4, 'Muhammad Ilham', '23', 'Patallassang City', 'Laki-laki', '085299868554', 'ile@gmail.com', '$2y$10$UFbXXYY9dh706bj34AbzPOrEr0ZRAjNxRXvqNES4Ebh/W0RqZkgUa'),
(5, 'Andi Nur Hidayah', '26', 'Jl. Printis Kemerdekaan', 'Perempuan', '085563228961', 'nurhidaya@gmail.com', '$2y$10$mbC143HZIAaHKlKYfuUh..lTbKGdgXyQvBMKlB8eRX3cHo3uWvkzq');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_golongan`
--
ALTER TABLE `tb_golongan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_harga`
--
ALTER TABLE `tb_harga`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_kapal`
--
ALTER TABLE `tb_kapal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_kendaraan`
--
ALTER TABLE `tb_kendaraan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_pengumuman`
--
ALTER TABLE `tb_pengumuman`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_penumpang`
--
ALTER TABLE `tb_penumpang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_pesan`
--
ALTER TABLE `tb_pesan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_golongan`
--
ALTER TABLE `tb_golongan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_harga`
--
ALTER TABLE `tb_harga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_kapal`
--
ALTER TABLE `tb_kapal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tb_kendaraan`
--
ALTER TABLE `tb_kendaraan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_pengumuman`
--
ALTER TABLE `tb_pengumuman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_penumpang`
--
ALTER TABLE `tb_penumpang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `tb_pesan`
--
ALTER TABLE `tb_pesan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
