-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jul 01, 2026 at 02:03 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akreditasi_laminfokom`
--

-- --------------------------------------------------------

--
-- Table structure for table `bukti`
--

CREATE TABLE `bukti` (
  `id_bukti` int(11) NOT NULL,
  `id_penilaian` int(11) NOT NULL,
  `nama_file` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `indikator`
--

CREATE TABLE `indikator` (
  `id_indikator` int(11) NOT NULL,
  `id_kriteria` int(11) DEFAULT NULL,
  `kode_indikator` varchar(20) DEFAULT NULL,
  `kategori` enum('Penetapan','Pelaksanaan','Evaluasi','Pengendalian','Peningkatan') DEFAULT NULL,
  `nama_indikator` text DEFAULT NULL,
  `bobot` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `indikator`
--

INSERT INTO `indikator` (`id_indikator`, `id_kriteria`, `kode_indikator`, `kategori`, `nama_indikator`, `bobot`) VALUES
(1, 1, '1.1.A', 'Penetapan', 'Kebijakan Tata Kelola Internal', 4.00),
(2, 1, '1.1.B', 'Penetapan', 'Kebijakan Fungsi SPMI', 4.00),
(3, 1, '1.2.A', 'Pelaksanaan', 'Pelaksanaan Tata Kelola Internal', 5.00),
(4, 1, '1.2.B', 'Pelaksanaan', 'Pelaksanaan Fungsi SPMI', 5.00),
(5, 1, '1.3.A', 'Evaluasi', 'Evaluasi Tata Kelola Internal', 4.00),
(6, 1, '1.3.B', 'Evaluasi', 'Evaluasi Fungsi SPMI', 4.00),
(7, 1, '1.4.A', 'Pengendalian', 'Pengendalian Tata Kelola Internal', 2.00),
(8, 1, '1.4.B', 'Pengendalian', 'Pengendalian Fungsi SPMI', 2.00),
(9, 1, '1.5.A', 'Peningkatan', 'Peningkatan Tata Kelola Internal', 5.00),
(10, 1, '1.5.B', 'Peningkatan', 'Peningkatan Fungsi SPMI', 5.00),
(11, 2, '2.1.A', 'Penetapan', 'Kebijakan DTPR dan Penerimaan Mahasiswa Baru', 5.00),
(12, 2, '2.1.B', 'Penetapan', 'Kebijakan Kurikulum OBE', 4.00),
(13, 2, '2.1.C', 'Penetapan', 'Fleksibilitas Proses Pembelajaran', 4.00),
(14, 2, '2.1.D', 'Penetapan', 'Kompetensi Lulusan', 4.00),
(15, 2, '2.2.A', 'Pelaksanaan', 'Pelaksanaan DTPR dan Penerimaan Mahasiswa Baru', 9.00),
(16, 2, '2.2.B', 'Pelaksanaan', 'Pelaksanaan Kurikulum OBE', 7.00),
(17, 2, '2.2.C', 'Pelaksanaan', 'Pelaksanaan Fleksibilitas Pembelajaran', 7.00),
(18, 2, '2.2.D', 'Pelaksanaan', 'Pelaksanaan Kompetensi Lulusan', 30.00),
(19, 2, '2.3.A', 'Evaluasi', 'Evaluasi DTPR dan Penerimaan Mahasiswa Baru', 5.00),
(20, 2, '2.3.B', 'Evaluasi', 'Evaluasi Kurikulum OBE', 5.00),
(21, 2, '2.3.C', 'Evaluasi', 'Evaluasi Fleksibilitas Pembelajaran', 4.00),
(22, 2, '2.3.D', 'Evaluasi', 'Evaluasi Kompetensi Lulusan', 4.00),
(23, 2, '2.4.A', 'Pengendalian', 'Efektivitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait DTPR, penerimaan mahasiswa baru, perluasan akses, keragaman asal calon mahasiswa, program afirmasi, dan calon mahasiswa berkebutuhan khusus', 4.00),
(24, 2, '2.4.B', 'Pengendalian', 'Efektivitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait isi pembelajaran dan rancangan kurikulum Outcome-Based Education (OBE) yang mencakup soft competence dan hard competence serta keterlibatan stakeholder', 4.00),
(25, 2, '2.4.C', 'Pengendalian', 'Efektivitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait fleksibilitas proses pembelajaran dan pemenuhan beban belajar seperti micro-credential, RPL, dan pembelajaran di luar program studi', 3.00),
(26, 2, '2.4.D', 'Pengendalian', 'Efektivitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait kompetensi lulusan berdasarkan rekognisi, apresiasi DUDIKA, dan sebaran kerja lulusan', 3.00),
(27, 2, '2.5.A', 'Peningkatan', 'Efektivitas peningkatan atau optimalisasi hasil ketercapaian standar dan indikator terkait DTPR, penerimaan mahasiswa baru, perluasan akses, keragaman asal calon mahasiswa, program afirmasi, dan calon mahasiswa berkebutuhan khusus', 5.00),
(28, 2, '2.5.B', 'Peningkatan', 'Efektivitas peningkatan atau optimalisasi hasil ketercapaian standar dan indikator terkait isi pembelajaran dan rancangan kurikulum Outcome-Based Education (OBE) yang mencakup soft competence dan hard competence serta keterlibatan stakeholder', 5.00),
(29, 2, '2.5.C', 'Peningkatan', 'Efektivitas peningkatan atau optimalisasi hasil ketercapaian standar dan indikator terkait fleksibilitas proses pembelajaran dan pemenuhan beban belajar seperti micro-credential, RPL, dan pembelajaran di luar program studi', 4.00),
(30, 2, '2.5.D', 'Peningkatan', 'Efektivitas peningkatan atau optimalisasi hasil ketercapaian standar dan indikator terkait kompetensi lulusan berdasarkan rekognisi, apresiasi DUDIKA, dan sebaran kerja lulusan', 4.00),
(31, 3, '3.1.A', 'Penetapan', 'Kebijakan, standar dan indikator terkait sarana dan prasarana penelitian, DTPR, pembiayaan penelitian, serta peta jalan penelitian', 4.00),
(32, 3, '3.1.B', 'Penetapan', 'Kebijakan, standar dan indikator terkait implementasi peta jalan penelitian, pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi, UPPS, visi misi keilmuan program studi, dan kebutuhan masyarakat serta DUDIKA', 4.00),
(33, 3, '3.1.C', 'Penetapan', 'Kebijakan, standar dan indikator terkait perolehan hibah penelitian, kerjasama penelitian, publikasi lingkup lokal, nasional dan internasional, perolehan HKI, serta keberlanjutan penelitian', 4.00),
(34, 3, '3.2.A', 'Pelaksanaan', 'Pelaksanaan kegiatan terkait standar dan indikator tentang sarana dan prasarana penelitian, DTPR, pembiayaan penelitian, dan peta jalan penelitian', 8.00),
(35, 3, '3.2.B', 'Pelaksanaan', 'Pelaksanaan kegiatan terkait standar dan indikator tentang implementasi peta jalan penelitian, pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi, UPPS, visi misi keilmuan program studi, kebutuhan masyarakat serta DUDIKA', 6.00),
(36, 3, '3.2.C', 'Pelaksanaan', 'Pelaksanaan kegiatan terkait standar dan indikator tentang perolehan hibah penelitian, kerjasama penelitian, publikasi lokal, nasional dan internasional, perolehan HKI, serta keberlanjutan penelitian', 18.00),
(37, 3, '3.3.A', 'Evaluasi', 'Evaluasi ketercapaian standar dan indikator terkait sarana dan prasarana penelitian, DTPR, pembiayaan penelitian, dan peta jalan penelitian', 3.00),
(38, 3, '3.3.B', 'Evaluasi', 'Evaluasi ketercapaian standar dan indikator terkait implementasi peta jalan penelitian, pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi, UPPS, visi misi keilmuan program studi, kebutuhan masyarakat dan DUDIKA', 3.00),
(39, 3, '3.3.C', 'Evaluasi', 'Evaluasi ketercapaian standar dan indikator terkait perolehan hibah penelitian, kerjasama penelitian, publikasi lokal, nasional dan internasional, perolehan HKI, serta keberlanjutan penelitian', 3.00),
(40, 3, '3.4.A', 'Pengendalian', 'Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait sarana dan prasarana penelitian, DTPR, pembiayaan penelitian, dan peta jalan penelitian', 3.00),
(41, 3, '3.4.B', 'Pengendalian', 'Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait implementasi peta jalan penelitian, pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi, UPPS, visi misi keilmuan program studi, kebutuhan masyarakat serta DUDIKA', 3.00),
(42, 3, '3.4.C', 'Pengendalian', 'Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait perolehan hibah penelitian, kerjasama penelitian, publikasi lokal, nasional dan internasional, perolehan HKI, serta keberlanjutan penelitian', 3.00),
(43, 3, '3.5.A', 'Peningkatan', 'Peningkatan atau optimalisasi hasil ketercapaian standar dan indikator terkait sarana dan prasarana penelitian, DTPR, pembiayaan penelitian, dan peta jalan penelitian', 4.00),
(44, 3, '3.5.B', 'Peningkatan', 'Peningkatan atau optimalisasi hasil ketercapaian standar dan indikator terkait implementasi peta jalan penelitian, pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi, UPPS, visi misi keilmuan program studi, kebutuhan masyarakat serta DUDIKA', 3.00),
(45, 3, '3.5.C', 'Peningkatan', 'Peningkatan atau optimalisasi hasil ketercapaian standar dan indikator terkait perolehan hibah penelitian, kerjasama penelitian, publikasi lokal, nasional dan internasional, perolehan HKI, serta keberlanjutan penelitian', 3.00),
(46, 4, '4.1.A', 'Penetapan', 'Kebijakan, standar dan indikator terkait sarana dan prasarana PkM, DTPR, pembiayaan PkM, dan peta jalan PkM (layanan kepakaran)', 3.00),
(47, 4, '4.1.B', 'Penetapan', 'Kebijakan, standar dan indikator terkait implementasi peta jalan PkM, pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi, UPPS, visi misi keilmuan program studi, kebutuhan masyarakat serta DUDIKA', 2.50),
(48, 4, '4.1.C', 'Penetapan', 'Kebijakan, standar dan indikator terkait perolehan hibah PkM, kerjasama PkM, diseminasi lingkup lokal, nasional dan internasional, perolehan HKI, serta keberlanjutan PkM', 2.00),
(49, 4, '4.2.A', 'Pelaksanaan', 'Efektivitas pelaksanaan kegiatan terkait standar dan indikator tentang sarana dan prasarana PkM, DTPR, pembiayaan PkM, dan peta jalan PkM (layanan kepakaran)', 7.00),
(50, 4, '4.2.B', 'Pelaksanaan', 'Efektivitas pelaksanaan kegiatan terkait implementasi peta jalan PkM, pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi, UPPS, visi misi keilmuan program studi, kebutuhan masyarakat serta DUDIKA', 6.00),
(51, 4, '4.2.C', 'Pelaksanaan', 'Efektivitas pelaksanaan kegiatan terkait standar dan indikator tentang perolehan hibah PkM, kerjasama PkM, diseminasi lingkup lokal, nasional dan internasional, perolehan HKI, serta keberlanjutan PkM', 15.00),
(52, 4, '4.3.A', 'Evaluasi', 'Efektivitas pelaksanaan evaluasi ketercapaian standar dan indikator terkait sarana dan prasarana PkM, DTPR, pembiayaan PkM, dan peta jalan PkM (layanan kepakaran)', 3.00),
(53, 4, '4.3.B', 'Evaluasi', 'Efektivitas pelaksanaan evaluasi ketercapaian standar dan indikator terkait implementasi peta jalan PkM, pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi, UPPS, visi misi keilmuan program studi, kebutuhan masyarakat serta DUDIKA', 3.00),
(54, 4, '4.3.C', 'Evaluasi', 'Efektivitas pelaksanaan evaluasi ketercapaian standar dan indikator terkait perolehan hibah PkM, kerjasama PkM, diseminasi lingkup lokal, nasional dan internasional, perolehan HKI, serta keberlanjutan PkM', 3.00),
(55, 4, '4.4.A', 'Pengendalian', 'Efektivitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian terkait sarana dan prasarana PkM, DTPR, pembiayaan PkM, dan peta jalan PkM (layanan kepakaran)', 3.00),
(56, 4, '4.4.B', 'Pengendalian', 'Efektivitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian terkait implementasi peta jalan PkM, pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi, UPPS, visi misi keilmuan program studi, kebutuhan masyarakat serta DUDIKA', 2.00),
(57, 4, '4.4.C', 'Pengendalian', 'Efektivitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian terkait perolehan hibah PkM, kerjasama PkM, diseminasi lingkup lokal, nasional dan internasional, perolehan HKI, serta keberlanjutan PkM', 2.00),
(58, 4, '4.5.A', 'Peningkatan', 'Efektivitas peningkatan atau optimalisasi hasil ketercapaian standar dan indikator terkait sarana dan prasarana PkM, DTPR, pembiayaan PkM, dan peta jalan PkM (layanan kepakaran)', 3.00),
(59, 4, '4.5.B', 'Peningkatan', 'Efektivitas peningkatan atau optimalisasi hasil ketercapaian standar dan indikator terkait implementasi peta jalan PkM, pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi, UPPS, visi misi keilmuan program studi, kebutuhan masyarakat serta DUDIKA', 2.00),
(60, 4, '4.5.C', 'Peningkatan', 'Efektivitas peningkatan atau optimalisasi hasil ketercapaian standar dan indikator terkait perolehan hibah PkM, kerjasama PkM, diseminasi lingkup lokal, nasional dan internasional, perolehan HKI, serta keberlanjutan PkM', 2.50),
(61, 5, '5.1.A', 'Penetapan', 'Kebijakan, standar dan indikator terkait sistem tata kelola yang otonom secara transparan dan akuntabel yang didukung kapasitas sarana dan prasarana yang memadai serta SDM yang profesional', 3.00),
(62, 5, '5.1.B', 'Penetapan', 'Kebijakan, standar dan indikator terkait audit mutu pemenuhan tupoksi tata kelola dan tata pamong, sarana dan prasarana, serta SDM yang profesional', 2.00),
(63, 5, '5.2.A', 'Pelaksanaan', 'Efektivitas pelaksanaan standar dan indikator terkait sistem tata kelola yang otonom secara transparan dan akuntabel yang didukung kapasitas sarana dan prasarana yang memadai serta SDM yang profesional', 5.00),
(64, 5, '5.2.B', 'Pelaksanaan', 'Efektivitas pelaksanaan standar dan indikator terkait audit mutu pemenuhan tupoksi tata kelola dan tata pamong, sarana dan prasarana, serta SDM yang profesional', 4.00),
(65, 5, '5.3.A', 'Evaluasi', 'Efektivitas pelaksanaan evaluasi ketercapaian standar dan indikator terkait sistem tata kelola yang otonom secara transparan dan akuntabel yang didukung kapasitas sarana dan prasarana yang memadai serta SDM yang profesional', 6.00),
(66, 5, '5.3.B', 'Evaluasi', 'Efektivitas pelaksanaan evaluasi ketercapaian standar dan indikator terkait audit mutu pemenuhan tupoksi tata kelola dan tata pamong, sarana dan prasarana, serta SDM yang profesional', 5.00),
(67, 5, '5.4.A', 'Pengendalian', 'Efektivitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait sistem tata kelola yang otonom secara transparan dan akuntabel yang didukung kapasitas sarana dan prasarana yang memadai serta SDM yang profesional', 3.00),
(68, 5, '5.4.B', 'Pengendalian', 'Efektivitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait audit mutu pemenuhan tupoksi tata kelola dan tata pamong, sarana dan prasarana, serta SDM yang profesional', 2.00),
(69, 5, '5.5.A', 'Peningkatan', 'Efektivitas peningkatan atau optimalisasi hasil ketercapaian standar dan indikator terkait sistem tata kelola yang otonom secara transparan dan akuntabel yang didukung kapasitas sarana dan prasarana yang memadai serta SDM yang profesional', 5.00),
(70, 5, '5.5.B', 'Peningkatan', 'Efektivitas peningkatan atau optimalisasi hasil ketercapaian standar dan indikator terkait audit mutu pemenuhan tupoksi tata kelola dan tata pamong, sarana dan prasarana, serta SDM yang profesional', 5.00),
(71, 2, '2.3.C', 'Evaluasi', 'Efektivitas pelaksanaan evaluasi ketercapaian standar dan indikator terkait fleksibilitas dalam proses pembelajaran (luring, daring, hibrida, CBL, PBL, micro-credential, RPL yang relevan dengan bidang keilmuan PS), penciptaan suasana akademik, penilaian pembelajaran, serta pemenuhan beban belajar', 4.00),
(72, 2, '2.3.D', 'Evaluasi', 'Efektivitas pelaksanaan evaluasi ketercapaian standar dan indikator terkait kompetensi lulusan yang dinilai dari pengakuan (rekognisi) dan apresiasi kompetensi lulusan oleh masyarakat dan DUDIKA, serta sebaran kerja lulusan (lokal, nasional, internasional)', 4.00),
(73, 6, '6.1', 'Penetapan', 'Kebijakan, standar dan indikator terkait tridarma perguruan tinggi yang mencakup VMTS, rencana pengembangan strategis UPPS dan/atau PS yang dapat menggambarkan ciri khas keilmuan PS serta pengakuan/apresiasi oleh masyarakat dan DUDIKA di tingkat lokal, nasional, dan internasional', 5.00),
(74, 6, '6.2', 'Pelaksanaan', 'Efektivitas pelaksanaan standar dan indikator terkait tridarma perguruan tinggi yang mencakup VMTS, rencana pengembangan strategis UPPS dan/atau PS yang dapat menggambarkan ciri khas keilmuan PS serta pengakuan/apresiasi oleh masyarakat dan DUDIKA di tingkat lokal, nasional, dan internasional', 8.00),
(75, 6, '6.3', 'Evaluasi', 'Efektivitas pelaksanaan evaluasi ketercapaian standar dan indikator terkait tridarma perguruan tinggi yang mencakup VMTS, rencana pengembangan strategis UPPS dan/atau PS yang dapat menggambarkan ciri khas keilmuan PS serta pengakuan/apresiasi oleh masyarakat dan DUDIKA di tingkat lokal, nasional, dan internasional', 13.00),
(76, 6, '6.4', 'Pengendalian', 'Efektivitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait tridarma perguruan tinggi yang mencakup VMTS, rencana pengembangan strategis UPPS dan/atau PS yang dapat menggambarkan ciri khas keilmuan PS serta pengakuan/apresiasi oleh masyarakat dan DUDIKA di tingkat lokal, nasional, dan internasional', 6.00),
(77, 6, '6.5', 'Peningkatan', 'Efektivitas peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait tridarma perguruan tinggi yang mencakup VMTS, rencana pengembangan strategis UPPS dan/atau PS yang dapat menggambarkan ciri khas keilmuan PS serta pengakuan/apresiasi oleh masyarakat dan DUDIKA di tingkat lokal, nasional, dan internasional', 10.00),
(78, 7, '7.1', 'Pelaksanaan', 'Mata kuliah inti/khas prodi', 4.00),
(79, 7, '7.2', 'Pelaksanaan', 'Mata kuliah domain spesifik dan lingkungan prodi infokom', 3.00),
(80, 7, '7.3', 'Penetapan', 'Mata kuliah terkait Matematika/metode atau Analisis Kuantitatif yang relevan', 3.00),
(81, 7, '7.4', 'Pelaksanaan', 'Proyek Utama (Capstone project) yang relevan', 5.00),
(82, 7, '7.5', 'Peningkatan', 'Pengembangan bidang infokom yang digunakan di masyarakat', 5.00);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `kode_kriteria` varchar(10) DEFAULT NULL,
  `nama_kriteria` varchar(200) DEFAULT NULL,
  `bobot` decimal(5,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `kode_kriteria`, `nama_kriteria`, `bobot`) VALUES
(1, 'K1', 'Budaya Mutu', 10.00),
(2, 'K2', 'Relevansi Pendidikan', 30.00),
(3, 'K3', 'Relevansi Penelitian', 18.00),
(4, 'K4', 'Relevansi PkM', 15.00),
(5, 'K5', 'Akuntabilitas', 10.00),
(6, 'K6', 'Diferensiasi Misi', 10.00),
(7, 'S1', 'Suplemen Program Studi', 5.00);

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id_penilaian` int(11) NOT NULL,
  `id_indikator` int(11) NOT NULL,
  `status` enum('Sangat Baik','Baik','Cukup','Kurang') NOT NULL,
  `nilai` int(11) NOT NULL,
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `file_bukti` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`id_penilaian`, `id_indikator`, `status`, `nilai`, `catatan`, `created_at`, `file_bukti`) VALUES
(68, 1, 'Sangat Baik', 4, '', '2026-06-28 23:55:07', '1782735606_676881b344fbe988c9cc.png'),
(69, 2, '', 0, '', '2026-06-28 23:55:07', NULL),
(70, 3, 'Kurang', 1, '', '2026-06-28 23:55:07', NULL),
(71, 4, '', 0, '', '2026-06-28 23:55:07', NULL),
(72, 5, 'Sangat Baik', 4, '', '2026-06-28 23:55:07', '1782690907_87f679dc4d960204fecd.pdf'),
(73, 6, 'Kurang', 1, '', '2026-06-28 23:55:07', NULL),
(74, 7, '', 0, '', '2026-06-28 23:55:07', NULL),
(75, 8, 'Sangat Baik', 4, '', '2026-06-28 23:55:07', '1782735606_81f507b36366e7c9a4d6.docx'),
(79, 31, 'Sangat Baik', 4, '', '2026-06-29 06:05:16', '1782713116_c0890a0f273b911b7c5d.png'),
(80, 32, 'Cukup', 2, '', '2026-06-29 06:05:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `role`) VALUES
(3, 'Administrator SIREPO', 'admin', '0192023a7bbd73250516f069df18b500', 'admin'),
(4, 'Dosen Informatika', 'dosen', 'd5bbfb47ac3160c31fa8c247827115aa', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bukti`
--
ALTER TABLE `bukti`
  ADD PRIMARY KEY (`id_bukti`),
  ADD KEY `fk_bukti_penilaian` (`id_penilaian`);

--
-- Indexes for table `indikator`
--
ALTER TABLE `indikator`
  ADD PRIMARY KEY (`id_indikator`),
  ADD KEY `fk_indikator_kriteria` (`id_kriteria`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id_penilaian`),
  ADD KEY `fk_penilaian_indikator` (`id_indikator`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bukti`
--
ALTER TABLE `bukti`
  MODIFY `id_bukti` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `indikator`
--
ALTER TABLE `indikator`
  MODIFY `id_indikator` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bukti`
--
ALTER TABLE `bukti`
  ADD CONSTRAINT `bukti_ibfk_1` FOREIGN KEY (`id_penilaian`) REFERENCES `penilaian` (`id_penilaian`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_bukti_penilaian` FOREIGN KEY (`id_penilaian`) REFERENCES `penilaian` (`id_penilaian`) ON DELETE CASCADE;

--
-- Constraints for table `indikator`
--
ALTER TABLE `indikator`
  ADD CONSTRAINT `fk_indikator_kriteria` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE;

--
-- Constraints for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `fk_penilaian_indikator` FOREIGN KEY (`id_indikator`) REFERENCES `indikator` (`id_indikator`) ON DELETE CASCADE,
  ADD CONSTRAINT `penilaian_ibfk_1` FOREIGN KEY (`id_indikator`) REFERENCES `indikator` (`id_indikator`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
