-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Des 2022 pada 17.20
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apk_java`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `default_password` varchar(40) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `id_role`, `username`, `password`, `default_password`, `level`) VALUES
(1, 1, 'admin', '61646d696e', 'admin', 1),
(5, 1, 'admin2', '313233343536', '123456', 2),
(6, 1, 'admin100', '326137717432', '2a7qt2', 1),
(7, 1, 'admin1000', '7a326a666c35', 'z2jfl5', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kebudayaan`
--

CREATE TABLE `kebudayaan` (
  `id` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `audio` varchar(100) NOT NULL,
  `video` varchar(300) NOT NULL,
  `jenis_kebudayaan` int(10) NOT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kebudayaan`
--

INSERT INTO `kebudayaan` (`id`, `id_admin`, `judul`, `deskripsi`, `gambar`, `audio`, `video`, `jenis_kebudayaan`, `tanggal`) VALUES
(32, 1, 'Batik Blora', 'Kabupaten Blora merupakan salah satu kabupaten yang ada di Jawa Tengah yang memiliki penghasilan minyak bumi terbesar di seluruh pulau Jawa. Namun selain minyak bumi tersebut, ada pula penghasilan lainnya yang tak kalah menarik dari kabupaten Blora tersebut.\r\n\r\nSeperti kabupaten yang lainnya yang ada di kabupaten Jawa Tengah, Blora memiliki salah satu kerajian tradisional yang juga sangat digemari oleh banyak orang. Dan salah satu kerajian tersebut adalah batik. Banyak daerah di Jawa Tengah yang juga memiliki kerajian batik dan tentunya berbeda satu dengan yang lainnya.\r\n\r\nJika batik hasil kerajian dari daerah yang lain memiliki ciri khas tersendiri, maka batik dari Blora tersebut juga memiliki ciri khas tersendiri. Untuk ulasan selengkapnya mengenai contoh budaya nasional yakni ciri khas batik Blora tersebut, yuk sobat langsung saja kita simak ulasan berikut ini dengan seksama. Check It', 'gambar/budaya/20220618_070112.JPG', 'gambar/budaya/audio/20220618_063930.mp3', 'https://www.youtube.com/embed/0TPnG18rlF0', 1, '2022-06-18'),
(34, 1, 'Testing', 'Testing', 'gambar/budaya/20220622_082518.jpg', 'gambar/budaya/audio/20220622_082518.mp3', 'https://www.youtube.com/embed/0TPnG18rlF0', 1, '2022-06-22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentar`
--

CREATE TABLE `komentar` (
  `id` int(11) NOT NULL,
  `id_kebudayaan` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `parent_komentar` int(11) DEFAULT NULL,
  `deskripsi` varchar(200) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `komentar`
--

INSERT INTO `komentar` (`id`, `id_kebudayaan`, `nama`, `parent_komentar`, `deskripsi`, `tanggal`) VALUES
(5, 32, 'sdfsdf', 0, 'hfhfdgd', '2022-06-22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_class` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `role_class`) VALUES
(1, 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tentang_kami`
--

CREATE TABLE `tentang_kami` (
  `id` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `tentang_kami` text NOT NULL,
  `logo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tentang_kami`
--

INSERT INTO `tentang_kami` (`id`, `id_admin`, `tentang_kami`, `logo`) VALUES
(1, 1, '<p>APK-Java merupakan aplikasi sistem informasi berbasis web-based yang bertujuan untuk memperkenalan kebudayaan-kebudayaan yang ada di jawa dan juga bertujuan sebagai sarana pembelajaran kebudayaan-kebudayaan di pulau jawa. APK-Java sendiri menyediakan fitur untuk mempelajari kebudayaan seperti fitur pembelajaran melalui audio, video, dan pembacaan informasi kebudayaan secara mandiri. Testing</p>\r\n', 'gambar/logo/20220622_082603.JPG');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kebudayaan`
--
ALTER TABLE `kebudayaan`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tentang_kami`
--
ALTER TABLE `tentang_kami`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `kebudayaan`
--
ALTER TABLE `kebudayaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tentang_kami`
--
ALTER TABLE `tentang_kami`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
