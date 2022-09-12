-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Agu 2022 pada 15.35
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_maut_php`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alternatif`
--

CREATE TABLE `alternatif` (
  `id_alternatif` int(11) NOT NULL,
  `nama_alternatif` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `nama_alternatif`) VALUES
(1, 'Pa supriadi'),
(3, 'Pa Haris'),
(4, 'Bu Eli'),
(2, 'Pa Jajang'),
(5, 'Bu Vani');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(100) DEFAULT NULL,
  `bobot_kriteria` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`, `bobot_kriteria`) VALUES
(4, 'Jangka Waktu Berakhir', 0.2),
(3, 'lama pinjaman', 0.15),
(2, 'jumlah pinjaman', 0.4),
(1, 'kelengkapan dokumen', 0.25);

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`username`, `password`) VALUES
('admin', '123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_alternatif` int(11) DEFAULT NULL,
  `id_kriteria` int(11) DEFAULT NULL,
  `id_SubKriteria` int(11) DEFAULT NULL,
  `nilai` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `id_alternatif`, `id_kriteria`, `id_SubKriteria`, `nilai`) VALUES
(1, 1, 1, 2, 4),
(9, 3, 1, 2, 4),
(10, 3, 2, 10, 1),
(11, 3, 3, 15, 1),
(12, 3, 4, 16, 5),
(13, 4, 1, 1, 5),
(14, 4, 2, 9, 2),
(15, 4, 3, 13, 3),
(17, 5, 1, 3, 3),
(18, 5, 2, 6, 5),
(16, 4, 4, 17, 4),
(19, 5, 3, 11, 5),
(20, 5, 4, 18, 3),
(2, 1, 2, 9, 2),
(3, 1, 3, 12, 4),
(4, 1, 4, 16, 5),
(5, 2, 1, 4, 2),
(6, 2, 2, 7, 4),
(7, 2, 3, 11, 5),
(8, 2, 4, 18, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pilihan_kriteria`
--

CREATE TABLE `pilihan_kriteria` (
  `id_SubKriteria` int(11) NOT NULL,
  `id_kriteria` int(11) DEFAULT NULL,
  `nama_SubKriteria` varchar(50) DEFAULT NULL,
  `nilai_SubKriteria` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pilihan_kriteria`
--

INSERT INTO `pilihan_kriteria` (`id_SubKriteria`, `id_kriteria`, `nama_SubKriteria`, `nilai_SubKriteria`) VALUES
(12, 3, '24 bulan â€“ 36 bulan x Angsuran (1,2%)', 4),
(13, 3, '46 bulan â€“ 48 bulan x Angsuran (1,2%)', 3),
(14, 3, '48 bulan â€“ 60 bulan x Angsuran (1,2%)', 2),
(15, 3, '> 60 bulan x Angsuran (1,2%)', 1),
(16, 4, 'Tidak ada', 5),
(17, 4, '< 12 Bulan', 4),
(18, 4, 'Bulan â€“ 24 Bulan', 3),
(6, 2, '< Rp.5.000.000', 5),
(7, 2, 'Rp.5.000.000 â€“ Rp.10.000.000', 4),
(8, 2, 'Rp.10.000.000 - Rp. 25.000.000', 3),
(9, 2, 'Rp.25.000.000 - Rp.50.000.000', 2),
(10, 2, '> Rp.50.000.000', 1),
(11, 3, '12 bulan â€“ 24 bulan x Angsuran (1,2%)', 5),
(5, 1, 'Foto copy KTP Suami/Istri, Slip gaji', 1),
(4, 1, 'Karyawan & Pensiunan, Slip gaji', 2),
(1, 1, 'lengkap', 5),
(2, 1, 'Foto copy No.rekening, Foto copy KTP Suami/Istri, ', 4),
(3, 1, 'Foto copy KTP Suami/Istri, Karyawan & Pensiunan, S', 3),
(19, 4, '24 Bulan â€“ 36 Bulan', 2),
(20, 4, '> 36 Bulan', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`username`);

--
-- Indeks untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indeks untuk tabel `pilihan_kriteria`
--
ALTER TABLE `pilihan_kriteria`
  ADD PRIMARY KEY (`id_SubKriteria`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT untuk tabel `pilihan_kriteria`
--
ALTER TABLE `pilihan_kriteria`
  MODIFY `id_SubKriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
