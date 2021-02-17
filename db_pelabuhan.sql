-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 18 Feb 2021 pada 01.43
-- Versi server: 8.0.23-0ubuntu0.20.04.1
-- Versi PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
  `id` int NOT NULL,
  `nama` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `username` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `password` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL
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
  `id` int NOT NULL,
  `golongan` varchar(20) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `jenis_kendaraan` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `harga` int NOT NULL,
  `kapasitas` int NOT NULL,
  `keterangan` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Dumping data untuk tabel `tb_golongan`
--

INSERT INTO `tb_golongan` (`id`, `golongan`, `jenis_kendaraan`, `harga`, `kapasitas`, `keterangan`) VALUES
(1, 'Golongan 3', 'Motor', 50000, 1, 'Kendaraan roda 2'),
(2, 'Golongan 4', 'Mobil Pribadi', 200000, 2, 'Kendaraan roda 4'),
(4, 'Golongan 5', 'Truk kecil', 300000, 15, 'Truk kecil rod 4'),
(5, 'Golongan 6', 'Bus', 600000, 10, 'Truk beasr atau Bis (Roda 6)'),
(6, 'Golongan 7', 'Truk Besar', 600000, 5, 'Truk besar 10 roda'),
(8, 'Golongan 8', 'kontainer', 1500000, 3, 'mobil 16 roda');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_harga`
--

CREATE TABLE `tb_harga` (
  `id` int NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `from_age` int NOT NULL,
  `to_age` int NOT NULL,
  `harga` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `tb_harga`
--

INSERT INTO `tb_harga` (`id`, `kategori`, `from_age`, `to_age`, `harga`) VALUES
(1, 'Balita', 0, 11, 0),
(2, 'Anak-anak', 12, 16, 12500),
(3, 'Dewasa', 17, 100, 25000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kapal`
--

CREATE TABLE `tb_kapal` (
  `id` int NOT NULL,
  `nama_kapal` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `harga` double NOT NULL,
  `kapasitas` int NOT NULL,
  `keterangan` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `tujuan` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin DEFAULT NULL,
  `waktu_berangkat` datetime DEFAULT NULL,
  `status` varchar(20) CHARACTER SET armscii8 COLLATE armscii8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Dumping data untuk tabel `tb_kapal`
--

INSERT INTO `tb_kapal` (`id`, `nama_kapal`, `harga`, `kapasitas`, `keterangan`, `tujuan`, `waktu_berangkat`, `status`) VALUES
(11, 'Kormomolin', 25000, 20, 'tujuan bulukumba', 'bira', '2021-02-03 13:34:00', 'Sandar'),
(12, 'Balibo', 25000, 20, 'tujuan bulukumba', 'bira', '2021-02-08 07:48:00', 'Berangkat'),
(13, 'Bontoharu', 25000, 20, 'tujuan bulukumba', 'Bulukumba', '2021-02-17 04:00:00', 'Sandar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kendaraan`
--

CREATE TABLE `tb_kendaraan` (
  `id` int NOT NULL,
  `user_id` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `kapal_id` int NOT NULL,
  `golongan_id` int NOT NULL,
  `kd_pendaftaran` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `nomor_tiket` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `nama_sopir` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `merek_kendaraan` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `nomor_kendaraan` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL
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
(9, '5', 7, 2, 'REG-0050013', '0705 532 0000009', 'Andi Nur Hidayah', 'Avansa', 'DD 9980 HI'),
(10, '1', 6, 1, 'REG-0010014', '0601 532 0000010', 'Rahmat Ilyas', 'Yamaha Jupiter Z1', 'DD 5851 HU'),
(11, '7', 11, 2, 'REG-0070016', '1107 532 0000011', 'asnah', 'avanza', 'DD5678E'),
(12, '5', 11, 2, 'REG-0050017', '1105 532 0000012', 'Andi Nur Hidayah', 'Avanza', 'DD 5523 HI'),
(13, '4', 11, 2, 'REG-0040018', '1104 532 0000013', 'Muhammad Ilham', 'Toyota', 'DD 5565 BB'),
(14, '8', 11, 1, 'REG-0080019', '1108 532 0000014', 'sisi', 'hodajaz', 'DD678Y'),
(15, '10', 11, 2, 'REG-0100020', '1110 532 0000015', 'mia', 'avanza', 'DD1223EF'),
(16, '11', 11, 5, 'REG-0110021', '1111 532 0000016', 'sulfinti', 'putra jaya', 'DD3456FF'),
(17, '12', 11, 1, 'REG-0120022', '1112 532 0000017', 'islamiah', 'yamaha', 'dd123ff'),
(18, '13', 11, 1, 'REG-0130023', '1113 532 0000018', 'mia', 'honda', 'dd345uh'),
(19, '2', 13, 1, 'REG-0020025', '1302 532 0000019', 'Nur Islamia', 'Jupiter Z', 'DD 4545 SI'),
(20, '4', 11, 2, 'REG-0040026', '1104 532 0000020', 'Muhammad Ilham', 'Avanza', 'DD 5566 SI'),
(21, '3', 11, 2, 'REG-0030027', '1103 532 0000021', 'Wahyuddin Annur', 'Toyota', 'DS 1234 ABS');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengumuman`
--

CREATE TABLE `tb_pengumuman` (
  `id` int NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `pengumuman` text,
  `waktu` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `tb_pengumuman`
--

INSERT INTO `tb_pengumuman` (`id`, `judul`, `pengumuman`, `waktu`) VALUES
(1, 'Perubahan Jadwal Keberangkatan', 'Diharapkan bagi semua calon penumpang agar tetap berhati-hati, karena di prediksikan akan ada angin topan yang melanda kabupaten kepulauan selayar', '2021-02-08 08:49:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_penumpang`
--

CREATE TABLE `tb_penumpang` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `kapal_id` int NOT NULL,
  `tujuan` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `kd_pendaftaran` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `nomor_tiket` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `nama` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `umur` int NOT NULL,
  `alamat` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `jenis_kelamin` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `kategori` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `tanggal_daftar` datetime NOT NULL,
  `status` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL
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
(15, 2, 7, 'Tarakang', 'REG-0020010', '0702 740 0000015', 'Nur Islamia', 22, 'Selayar Barat, Kabupaten Selayar', 'Perempuan', 'Dewasa', '2020-12-09 13:37:32', 'Batal'),
(16, 3, 7, 'Tarakang', 'REG-0030011', '0703 740 0000016', 'Wahyuddin Annur', 23, 'Jl Bunga Harapan, Tanete', 'Laki-laki', 'Dewasa', '2020-12-09 15:48:36', 'Selesai'),
(17, 1, 7, 'Tarakang', 'REG-0010012', '0701 740 0000017', 'Rahmat Ilyas', 22, 'Jl. Poros Summbarrang, Patallassang, Kab. Gowa', 'Laki-laki', 'Dewasa', '2020-12-09 22:59:53', 'Batal'),
(18, 5, 7, 'Tarakang', 'REG-0050013', '0705 740 0000018', 'Andi Nur Hidayah', 26, 'Jl. Printis Kemerdekaan', 'Perempuan', 'Dewasa', '2020-12-10 12:04:22', 'Selesai'),
(19, 5, 7, 'Tarakang', 'REG-0050013', '0705 740 0000019', 'Maya Ayu Lestari', 25, 'Jl. Antang Raya', 'Perempuan', 'Dewasa', '2020-12-10 12:04:26', 'Selesai'),
(20, 1, 6, 'Bulukumba', 'REG-0010014', '0601 740 0000020', 'Rahmat Ilyas', 22, 'Jl. Poros Summbarrang, Patallassang, Kab. Gowa', 'Laki-laki', 'Dewasa', '2021-01-31 23:11:10', 'Selesai'),
(21, 1, 6, 'Bulukumba', 'REG-0010014', '0601 740 0000021', 'Radial Al Adawiya', 23, 'Karangpuang', 'Perempuan', 'Dewasa', '2021-01-31 23:11:10', 'Selesai'),
(24, 6, 11, 'bira', 'REG-0060015', '1106 740 0000022', 'isla', 22, 'samata', 'Perempuan', 'Dewasa', '2021-02-01 13:42:49', 'Batal'),
(25, 6, 11, 'bira', 'REG-0060015', '1106 740 0000023', 'jb', 39, 'gowa', 'Laki-laki', 'Dewasa', '2021-02-01 13:42:49', 'Batal'),
(26, 6, 11, 'bira', 'REG-0060015', '1106 740 0000024', 'dam', 22, 'samata', 'Laki-laki', 'Dewasa', '2021-02-01 13:42:49', 'Batal'),
(27, 7, 11, 'bira', 'REG-0070016', '1107 740 0000025', 'asnah', 50, 'selayar', 'Perempuan', 'Dewasa', '2021-02-01 13:53:09', 'Selesai'),
(28, 5, 11, 'bira', 'REG-0050017', '1105 740 0000026', 'Andi Nur Hidayah', 26, 'Jl. Printis Kemerdekaan', 'Perempuan', 'Dewasa', '2021-02-01 14:09:41', 'Batal'),
(29, 4, 11, 'bira', 'REG-0040018', '1104 740 0000027', 'Muhammad Ilham', 23, 'Patallassang City', 'Laki-laki', 'Dewasa', '2021-02-01 14:31:50', 'Batal'),
(30, 8, 11, 'bira', 'REG-0080019', '1108 740 0000028', 'sisi', 27, 'gowa', 'Perempuan', 'Dewasa', '2021-02-01 15:19:52', 'Selesai'),
(31, 8, 11, 'bira', 'REG-0080019', '1108 740 0000029', 'pia', 23, 'gowa', 'Perempuan', 'Dewasa', '2021-02-01 15:19:52', 'Selesai'),
(32, 10, 11, 'bira', 'REG-0100020', '1110 740 0000030', 'mia', 22, 'selayar', 'Perempuan', 'Dewasa', '2021-02-08 08:42:12', 'Batal'),
(33, 10, 11, 'bira', 'REG-0100020', '1110 740 0000031', 'nur', 23, 'samata', 'Perempuan', 'Dewasa', '2021-02-08 08:42:12', 'Batal'),
(34, 10, 11, 'bira', 'REG-0100020', '1110 740 0000032', 'titin', 24, 'bone', 'Perempuan', 'Dewasa', '2021-02-08 08:42:12', 'Batal'),
(35, 11, 11, 'bira', 'REG-0110021', '1111 740 0000033', 'sulfinti', 23, 'samata', 'Perempuan', 'Dewasa', '2021-02-08 08:45:27', 'Selesai'),
(36, 11, 11, 'bira', 'REG-0110021', '1111 740 0000034', 'ahmad', 56, 'gowa', 'Laki-laki', 'Dewasa', '2021-02-08 08:45:27', 'Selesai'),
(37, 12, 11, 'bira', 'REG-0120022', '1112 740 0000035', 'islamiah', 22, 'samata22', 'Perempuan', 'Dewasa', '2021-02-08 09:18:15', 'Selesai'),
(38, 12, 11, 'bira', 'REG-0120022', '1112 740 0000036', 'titu', 22, 'samata', 'Perempuan', 'Dewasa', '2021-02-08 09:18:15', 'Selesai'),
(39, 13, 11, 'bira', 'REG-0130023', '1113 740 0000037', 'mia', 22, 'gowa', 'Perempuan', 'Dewasa', '2021-02-12 19:06:59', 'Selesai'),
(40, 13, 11, 'bira', 'REG-0130023', '1113 740 0000038', 'isna', 33, 'slyr', 'Perempuan', 'Dewasa', '2021-02-12 19:06:59', 'Selesai'),
(41, 1, 13, 'Bulukumba', 'REG-0010024', '1301 740 0000039', 'Rahmat Ilyas', 22, 'Jl. Poros Summbarrang, Patallassang, Kab. Gowa', 'Laki-laki', 'Dewasa', '2021-02-18 00:13:12', 'Panding'),
(42, 2, 13, 'Bulukumba', 'REG-0020025', '1302 740 0000040', 'Nur Islamia', 22, 'Selayar Barat, Kabupaten Selayar', 'Perempuan', 'Dewasa', '2021-02-18 00:52:38', 'Panding'),
(43, 4, 11, 'bira', 'REG-0040026', '1104 740 0000041', 'Muhammad Ilham', 23, 'Patallassang City', 'Laki-laki', 'Dewasa', '2021-02-18 01:34:53', 'Panding'),
(44, 3, 11, 'bira', 'REG-0030027', '1103 740 0000042', 'Wahyuddin Annur', 23, 'Jl Bunga Harapan, Tanete', 'Laki-laki', 'Dewasa', '2021-02-18 01:38:41', 'Panding');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pesan`
--

CREATE TABLE `tb_pesan` (
  `id` int NOT NULL,
  `nama` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `email` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `pesan` text CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `waktu` datetime NOT NULL,
  `status` varchar(20) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL
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
(6, 'Nur Islamia', 'nurislamia@gmail.com', 'Ku tes lagi dii', '2020-12-08 23:13:54', 'read'),
(7, 'Rahmat Ilyas', 'rahmat.ilyas142@gmail.com', 'Tesss', '2021-02-01 13:54:40', 'read');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id` int NOT NULL,
  `kd_transaksi` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `user_id` int NOT NULL,
  `total_harga_tiket` double NOT NULL,
  `biaya_kendaraan` double NOT NULL,
  `total_harga` double NOT NULL,
  `status` varchar(20) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL
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
(10, 'REG-0020010', 2, 25000, 0, 25000, 'Batal'),
(11, 'REG-0030011', 3, 25000, 25000, 50000, 'Lunas'),
(12, 'REG-0010012', 1, 25000, 25000, 50000, 'Batal'),
(13, 'REG-0050013', 5, 50000, 25000, 75000, 'Lunas'),
(14, 'REG-0010014', 1, 50000, 20000, 70000, 'Lunas'),
(17, 'REG-0060015', 6, 75000, 0, 75000, 'Batal'),
(18, 'REG-0070016', 7, 25000, 25000, 50000, 'Lunas'),
(19, 'REG-0050017', 5, 25000, 25000, 50000, 'Batal'),
(20, 'REG-0040018', 4, 25000, 200000, 225000, 'Batal'),
(21, 'REG-0080019', 8, 50000, 50000, 100000, 'Lunas'),
(22, 'REG-0100020', 10, 75000, 200000, 275000, 'Batal'),
(23, 'REG-0110021', 11, 50000, 600000, 650000, 'Lunas'),
(24, 'REG-0120022', 12, 50000, 50000, 100000, 'Lunas'),
(25, 'REG-0130023', 13, 50000, 50000, 100000, 'Lunas'),
(26, 'REG-0010024', 1, 25000, 0, 25000, 'Belum Lunas'),
(27, 'REG-0020025', 2, 25000, 50000, 75000, 'Belum Lunas'),
(28, 'REG-0040026', 4, 25000, 200000, 225000, 'Belum Lunas'),
(29, 'REG-0030027', 3, 25000, 200000, 225000, 'Belum Lunas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_users`
--

CREATE TABLE `tb_users` (
  `id` int NOT NULL,
  `nama` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `umur` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `alamat` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `jenis_kelamin` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `telepon` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `email` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL,
  `password` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Dumping data untuk tabel `tb_users`
--

INSERT INTO `tb_users` (`id`, `nama`, `umur`, `alamat`, `jenis_kelamin`, `telepon`, `email`, `password`) VALUES
(1, 'Rahmat Ilyas', '22', 'Jl. Poros Summbarrang, Patallassang, Kab. Gowa', 'Laki-laki', '085333341194', 'rahmat.ilyas142@gmail.com', '$2y$10$QgpXDnoMd9.HjTZs5xZEQeD/EIrKJzf9GX.0DRUwbVInmWcNPbuKe'),
(2, 'Nur Islamia', '22', 'Selayar Barat, Kabupaten Selayar', 'Perempuan', '085246335887', 'nurislamia@gmail.com', '$2y$10$QgpXDnoMd9.HjTZs5xZEQeD/EIrKJzf9GX.0DRUwbVInmWcNPbuKe'),
(3, 'Wahyuddin Annur', '23', 'Jl Bunga Harapan, Tanete', 'Laki-laki', '085233678335', 'wahyudin@gmail.com', '$2y$10$LOH7TfJasSU2yVmhGTpOAOpgXgzriMQVPKPiVuHFg5tvgykCT.ksa'),
(4, 'Muhammad Ilham', '23', 'Patallassang City', 'Laki-laki', '085299868554', 'ile@gmail.com', '$2y$10$UFbXXYY9dh706bj34AbzPOrEr0ZRAjNxRXvqNES4Ebh/W0RqZkgUa'),
(5, 'Andi Nur Hidayah', '26', 'Jl. Printis Kemerdekaan', 'Perempuan', '085563228961', 'nurhidaya@gmail.com', '$2y$10$mbC143HZIAaHKlKYfuUh..lTbKGdgXyQvBMKlB8eRX3cHo3uWvkzq'),
(6, 'Nur', '22', 'samata', 'Perempuan', '0824257653537', 'nurislamiah@765gmail.com', '$2y$10$OufSl8NTfYQdKi4wUpda4.8W/e9jlZPMrXUXO9vB79sbWusGRjIWK'),
(7, 'asnah', '50', 'selayar', 'Perempuan', '073465646', 'asnah234@gmail.com', '$2y$10$PzyOIALvn6DTdyAYKEl.fexMn4peaRARk8GieKzQBTF8d2mzC/L2u'),
(8, 'sisi', '27', 'gowa', 'Perempuan', '082978534', 'sisiasih98@gmail.com', '$2y$10$UnbVhoxXPkPd1blgkJX8hOa4vOqX4hKSRcyX4JuWyCUH3pGSuqe5.'),
(9, 'zulf', '22', 'samat', 'Perempuan', '76457889', 'zulf@gmail.com', '$2y$10$q03TGXzurnu16xXocXEXkecnFyxXVmudslsWKtut1MPQItbs/2VaC'),
(10, 'mia', '22', 'selayar', 'Perempuan', '09846546734', 'islamiah234@gmail.com', '$2y$10$B3N8PA7qJgF7Uuk6iXUV3OjJz/uSqfwUR2EchIO.5uPpSp3O5ki4q'),
(11, 'sulfinti', '23', 'samata', 'Perempuan', '072765343438', 'sulfianti333@gmail.com', '$2y$10$R4McOwDO0H6h8Is6k6iUjuhLS7ZkUXceStRkIMwtbnr2DX5lCAPW6'),
(12, 'islamiah', '22', 'samata22', 'Perempuan', '934787354474', 'islamiah23@gmail.com', '$2y$10$8ON2iCfltbdlo9csKkGWMul5INGg8uj7adoztVPnbEMObIFxKRzMa'),
(13, 'mia', '22', 'gowa', 'Perempuan', '5478393', 'mia123@gmail.com', '$2y$10$IqpPMKGcYGNXAqoea063E.ycp6nOEAQaRNrU4I1Xqjarb9vJd7/JO');

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_golongan`
--
ALTER TABLE `tb_golongan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_harga`
--
ALTER TABLE `tb_harga`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_kapal`
--
ALTER TABLE `tb_kapal`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tb_kendaraan`
--
ALTER TABLE `tb_kendaraan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `tb_pengumuman`
--
ALTER TABLE `tb_pengumuman`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_penumpang`
--
ALTER TABLE `tb_penumpang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT untuk tabel `tb_pesan`
--
ALTER TABLE `tb_pesan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
