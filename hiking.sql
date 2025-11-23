-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Nov 2025 pada 00.36
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hiking`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `ID_Admin` int(11) NOT NULL,
  `Nama` varchar(30) NOT NULL,
  `Pass` varchar(30) NOT NULL,
  `No_HP` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`ID_Admin`, `Nama`, `Pass`, `No_HP`) VALUES
(1, 'Fahmi Firdaus', 'Fhmfrds7', '089666526082'),
(2, 'Zamsteks', 'ZamsteksX6310', '081227717814');

-- --------------------------------------------------------

--
-- Struktur dari tabel `galeri`
--

CREATE TABLE `galeri` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `tanggal_upload` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `galeri`
--

INSERT INTO `galeri` (`id`, `judul`, `deskripsi`, `foto`, `tanggal_upload`) VALUES
(1, 'Sindoro1', 'Sindoro Sunset Camp', 'Sindoro1.jpg', '2025-11-23 09:23:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gunung`
--

CREATE TABLE `gunung` (
  `ID_Gunung` int(11) NOT NULL,
  `Nama_Gunung` varchar(30) NOT NULL,
  `Lokasi` varchar(100) NOT NULL,
  `Ketinggian` varchar(30) NOT NULL,
  `Basecamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `gunung`
--

INSERT INTO `gunung` (`ID_Gunung`, `Nama_Gunung`, `Lokasi`, `Ketinggian`, `Basecamp`) VALUES
(1, 'Slamet', 'Kabupaten Banyumas, Purbalingga, Pemalang, Tegal, dan Brebes — Jawa Tengah', '3.428 mdpl', 7),
(2, 'Merapi', 'Kabupaten Magelang, Boyolali dan Klaten dan Daerah Istimewa Yogyakarta (Kabupaten Sleman)', '2.968 mdpl', 3),
(3, 'Sindoro', 'Kabupaten Temanggung dan Kabupaten Wonosobo, Jawa Tengah', '3.153', 7),
(4, 'Sumbing', 'Kabupaten Magelang, Kabupaten Temanggung, dan Kabupaten Wonosobo', '3.371', 5),
(5, 'Prau', 'Kabupaten Batang, Kendal, Temanggung, dan Wonosobo', '2.590', 9),
(6, 'Merbabu', 'Kabupaten Magelang, Kabupaten Boyolali, Kabupaten Semarang, dan Kabupaten Klaten.', '3.142', 4),
(7, 'Lawu', 'Kabupaten Karanganyar Jawa Tengah, Ngawi, dan Magetan di Jawa Timur.', '3.265', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `ID_Pemesanan` int(11) NOT NULL,
  `Nama_Pengunjung` varchar(30) NOT NULL,
  `Nama_Gunung` varchar(30) NOT NULL,
  `Via_Basecamp` varchar(100) NOT NULL,
  `Jadwal` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pemesanan`
--

INSERT INTO `pemesanan` (`ID_Pemesanan`, `Nama_Pengunjung`, `Nama_Gunung`, `Via_Basecamp`, `Jadwal`) VALUES
(154, 'zqsqdqd', 'Sindoro', 'Sigedang', '2025-11-30'),
(155, 'abcde', 'Slamet', 'Bambangan', '2025-11-28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengunjung`
--

CREATE TABLE `pengunjung` (
  `ID_Pengunjung` int(11) NOT NULL,
  `Nama_Pengunjung` varchar(30) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `No_HP` varchar(15) NOT NULL,
  `Password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengunjung`
--

INSERT INTO `pengunjung` (`ID_Pengunjung`, `Nama_Pengunjung`, `Email`, `No_HP`, `Password`) VALUES
(1, 'Fahmi Firdaus', 'fhmfrds7@gmail.com', '089663911367', '12345'),
(2, 'qwerty', 'qwerty@gmail.com', '123456789', 'qwerty');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID_Admin`);

--
-- Indeks untuk tabel `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `gunung`
--
ALTER TABLE `gunung`
  ADD PRIMARY KEY (`ID_Gunung`);

--
-- Indeks untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`ID_Pemesanan`);

--
-- Indeks untuk tabel `pengunjung`
--
ALTER TABLE `pengunjung`
  ADD PRIMARY KEY (`ID_Pengunjung`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `ID_Admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `ID_Pemesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT untuk tabel `pengunjung`
--
ALTER TABLE `pengunjung`
  MODIFY `ID_Pengunjung` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
