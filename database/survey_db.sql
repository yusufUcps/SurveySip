-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Jul 2023 pada 14.36
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `survey_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `answers`
--

CREATE TABLE `answers` (
  `id` int(30) NOT NULL,
  `survey_id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `answer` text NOT NULL,
  `question_id` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `answers`
--

INSERT INTO `answers` (`id`, `survey_id`, `user_id`, `answer`, `question_id`, `date_created`) VALUES
(7, 6, 5, 'yusuf', 5, '2023-06-12 14:30:35'),
(8, 6, 5, 'qFGsX', 6, '2023-06-12 14:30:35'),
(11, 7, 5, '44', 8, '2023-06-18 17:26:58'),
(12, 7, 5, 'sdasdassd', 7, '2023-06-18 17:26:58'),
(13, 9, 5, '[1]', 10, '2023-06-19 19:08:09'),
(14, 9, 5, 'wowowowo', 11, '2023-06-19 19:08:09'),
(15, 9, 5, 'hdeh', 12, '2023-06-19 19:08:09'),
(16, 7, 6, '3', 8, '2023-06-19 19:13:46'),
(17, 7, 6, 'adsasdsad', 7, '2023-06-19 19:13:46'),
(18, 9, 6, '[1]', 10, '2023-06-19 19:15:02'),
(19, 9, 6, 'dasdasd', 11, '2023-06-19 19:15:02'),
(20, 9, 6, 'adas', 12, '2023-06-19 19:15:02'),
(21, 11, 5, '[4],[3]', 13, '2023-06-19 19:20:52'),
(22, 9, 7, '[1],[2]', 10, '2023-06-19 19:47:53'),
(24, 9, 7, 'adas', 12, '2023-06-19 19:47:53'),
(26, 11, 6, '[4]', 13, '2023-06-21 20:17:37'),
(28, 7, 8, '3', 8, '2023-06-23 17:11:42'),
(29, 7, 8, 'bisa', 7, '2023-06-23 17:11:42'),
(30, 11, 8, '[4]', 13, '2023-06-23 17:36:58'),
(31, 9, 8, '[2]', 10, '2023-06-23 20:32:14'),
(32, 9, 8, 'dsadasd', 11, '2023-06-23 20:32:14'),
(33, 9, 8, 'adas', 12, '2023-06-23 20:32:14'),
(50, 13, 9, 'akuppp', 17, '2023-06-26 20:05:36'),
(51, 3, 9, 'sayaaaaaaaaaaaaaaaaaaaaaaaaaa', 18, '2023-06-30 09:19:22'),
(52, 16, 9, 'Ya', 28, '2023-07-01 17:34:41'),
(53, 16, 9, 'Terjangkau', 29, '2023-07-01 17:34:41'),
(54, 16, 9, '[Nasi Padang],[Gado-gado]', 30, '2023-07-01 17:34:41'),
(55, 16, 9, 'Setuju', 31, '2023-07-01 17:34:41'),
(56, 16, 9, 'Lebih dari 5 Kali', 32, '2023-07-01 17:34:41'),
(87, 21, 9, 'Ya', 93, '2023-07-09 12:16:53'),
(88, 21, 9, 'karena sering terjadi banjir', 94, '2023-07-09 12:16:53'),
(89, 21, 9, '[Tidak]', 95, '2023-07-09 12:16:53'),
(90, 21, 9, 'kerusakan lingkungan', 96, '2023-07-09 12:16:53'),
(91, 21, 9, 'harus selalu memperhatikan limbah', 97, '2023-07-09 12:16:53'),
(92, 21, 9, 'Sering', 98, '2023-07-09 12:16:53'),
(93, 21, 9, 'Tidak', 99, '2023-07-09 12:16:53'),
(94, 21, 9, 'sangat bagus', 100, '2023-07-09 12:16:53'),
(95, 21, 9, 'Ya', 101, '2023-07-09 12:16:53'),
(96, 21, 9, 'karena alam sudah semakin rusak', 102, '2023-07-09 12:16:53'),
(97, 22, 9, '[Ayam Cabai Rendang],[Cumi Cabai Merah]', 103, '2023-07-09 12:27:10'),
(98, 22, 9, 'Indonesia', 104, '2023-07-09 12:27:10'),
(99, 22, 9, 'Kurang dari 2 tahun', 105, '2023-07-09 12:27:10'),
(100, 22, 9, 'Enak', 106, '2023-07-09 12:27:10'),
(101, 22, 9, 'Tidak', 107, '2023-07-09 12:27:10'),
(102, 22, 9, 'Setiap Hari', 108, '2023-07-09 12:27:10'),
(103, 22, 9, 'Ya', 109, '2023-07-09 12:27:10'),
(104, 22, 9, '[Kesehatan]', 110, '2023-07-09 12:27:10'),
(105, 22, 9, 'Kurang Pedas', 111, '2023-07-09 12:27:10'),
(106, 22, 9, '[Cabe Besar],[Bumbu Instan]', 112, '2023-07-09 12:27:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar_blokir`
--

CREATE TABLE `daftar_blokir` (
  `id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `survey_id` int(30) NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `daftar_blokir`
--

INSERT INTO `daftar_blokir` (`id`, `user_id`, `survey_id`, `tanggal`) VALUES
(11, 7, 13, '2023-06-25 16:26:30'),
(19, 7, 3, '2023-06-30 09:42:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kuis_s`
--

CREATE TABLE `kuis_s` (
  `id` int(30) NOT NULL,
  `survey_id` int(30) NOT NULL,
  `pertanyaan` text NOT NULL,
  `jawaban` text NOT NULL,
  `frm_option` text NOT NULL,
  `order_by` int(11) NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kuis_s`
--

INSERT INTO `kuis_s` (`id`, `survey_id`, `pertanyaan`, `jawaban`, `frm_option`, `order_by`, `tanggal`) VALUES
(5, 13, 'umur and', '17-30', '{\"cIGNE\":\"17-30\",\"oXwjb\":\"8-15\"}', 0, '2023-06-21 00:00:00'),
(6, 8, 'angka 8?', '8', '{\"GQpYv\":\"8\",\"DiaLH\":\"5\"}', 3, '2023-06-22 00:00:00'),
(7, 8, 'angka 9?', '9', '{\"drqYz\":\"10\",\"wSDkJ\":\"9\"}', 1, '2023-06-22 00:00:00'),
(8, 8, 'angka 9', '9', '{\"QtnYm\":\"9\",\"AjCUE\":\"10\"}', 2, '2023-06-25 14:05:30'),
(9, 3, 'angka 99?', '99', '{\"jkWbX\":\"99\",\"LQhrF\":\"10\"}', 0, '2023-06-25 19:22:25'),
(10, 3, 'angka 99?', '99', '{\"OXHAn\":\"99\",\"rdpfg\":\"10\"}', 0, '2023-06-25 19:58:20'),
(11, 4, 'anka 10?', '10', '{\"xMaQA\":\"10\",\"dTwxS\":\"99\"}', 0, '2023-06-28 13:31:43'),
(12, 22, 'apakah anda pernah makan makanan pedas?', 'ya', '{\"HbKoB\":\"ya\",\"TzqwM\":\"tidak\"}', 0, '2023-07-09 12:25:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `questions`
--

CREATE TABLE `questions` (
  `id` int(30) NOT NULL,
  `question` text NOT NULL,
  `frm_option` text NOT NULL,
  `type` varchar(50) NOT NULL,
  `order_by` int(11) NOT NULL,
  `survey_id` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `questions`
--

INSERT INTO `questions` (`id`, `question`, `frm_option`, `type`, `order_by`, `survey_id`, `date_created`) VALUES
(5, 'nama', '', 'textfield_s', 0, 6, '2023-06-12 14:27:30'),
(6, 'kelas', '{\"flyiz\":\"3\",\"qFGsX\":\"2\",\"xNEni\":\"1\",\"tMpWC\":\"4\"}', 'radio_opt', 3, 6, '2023-06-12 14:28:24'),
(7, 'sekolah', '', 'textfield_s', 1, 7, '2023-06-18 14:33:41'),
(8, 'umur', '{\"fQCrP\":\"3\",\"SDIEo\":\"44\"}', 'radio_opt', 2, 7, '2023-06-18 14:34:09'),
(10, 'asdad', '{\"qUPbi\":\"1\",\"idhGW\":\"2\"}', 'check_opt', 0, 9, '2023-06-19 19:05:20'),
(11, 'afczxxvzv', '', 'textfield_s', 0, 9, '2023-06-19 19:05:28'),
(12, 'asdsadas', '{\"qpefT\":\"hdeh\",\"LRbPD\":\"adas\"}', 'radio_opt', 0, 9, '2023-06-19 19:06:32'),
(16, 'asdsad', '[\"777\",\"44\"]', 'radio_opt', 0, 12, '2023-06-19 19:42:11'),
(17, 'nama anda?', '', 'textfield_s', 0, 13, '2023-06-21 19:35:00'),
(18, 'sama anda?', '', 'textfield_s', 0, 3, '2023-06-25 20:46:46'),
(19, 'Berapa Umur Anda?', '{\"fQCrP\":\"3\",\"SDIEo\":\"44\"}', 'radio_opt', 0, 9, '2023-07-01 16:26:49'),
(20, 'Siapa Nama Anda?', '', 'textfield_s', 0, 9, '2023-07-01 16:26:49'),
(21, 'Berapa umur Anda?', '{\"Nxi2R\":\"3\",\"Uqzcm\":\"44\"}', 'radio_opt', 0, 10, '2023-07-01 16:30:12'),
(22, 'Seberapa Pedas Makanan yang biasanya Anda Pesan?', '{\"GeNaT\": \"Tidak Pedas\", \"uvy6M\":\"Pedas Sedang\", \"FycP3\": \"Pedas Cukup\", \"tHtkD\": \"Sangat Pedas\"}', 'radio_opt', 0, 10, '2023-07-01 16:30:12'),
(23, 'Berapa Umur Anda?', '{\"T5Dml\":\"3\",\"QVhKN\":\"44\"}', 'radio_opt', 0, 8, '2023-07-01 16:46:31'),
(24, 'Siapa Nama Anda?', '', 'textfield_s', 0, 8, '2023-07-01 16:46:31'),
(25, 'Apa Jenis Makanan Manis Favorit Anda?', '{\"T2K4h\":\"Cupcakes\",\"S1bV3\":\"Donat\"}', 'radio_opt', 0, 8, '2023-07-01 16:46:31'),
(26, 'Yang Mana Di Bawah Ini Jenis Makanan Manis Yang Pernah Anda Cicipi?', '{\"fP6ko\":\"Kue Brownies\",\"R5q2x\":\"Kue Donat\"}', 'check_opt', 0, 8, '2023-07-01 16:46:31'),
(27, 'Bagaimana Pendapat Anda Tentang Makanan Manis?', '{\"o1kn8\":\"Enak\",\"yew4l\":\"Tidak Enak\"}', 'radio_opt', 0, 8, '2023-07-01 16:46:31'),
(28, 'Apakah anda merasa puas dengan variasi makanan prasmanan di Indonesia?', '{\"fQC4P\":\"Ya\",\"S3DEo\":\"Tidak\"}', 'radio_opt', 0, 16, '2023-07-01 17:29:18'),
(29, 'Bagaimana pendapat anda tentang harga makanan prasmanan di Indonesia?', '{\"fQCd6\":\"Terjangkau\",\"Sq8fE\":\"Mahal\"}', 'radio_opt', 0, 16, '2023-07-01 17:29:18'),
(30, 'Apa jenis makanan prasmanan yang paling anda suka?', '{\"fQCy6\":\"Nasi Padang\",\"Sg3mE\":\"Gado-gado\"}', 'check_opt', 0, 16, '2023-07-01 17:29:18'),
(31, 'Apakah anda setuju dengan penambahan bahan-bahan lokal dalam makanan prasmanan di Indonesia?', '{\"fQCIU\":\"Setuju\",\"S5IEo\":\"Tidak Setuju\"}', 'radio_opt', 0, 16, '2023-07-01 17:29:18'),
(32, 'Berapa kali anda melakukan pembelian makanan prasmanan di Indonesia dalam kurun waktu 1 bulan?', '{\"fQCeP\":\"1-5 Kali\",\"Sa9Eo\":\"Lebih dari 5 Kali\"}', 'radio_opt', 0, 16, '2023-07-01 17:29:18'),
(33, 'Dimana anda beli makanan manis tersebut?', '{\"AiPeC\":\"Toko\",\"rPT2v\":\"Online\"}', 'radio_opt', 0, 15, '2023-07-01 18:20:31'),
(34, 'Apakah anda suka dengan cita rasa makanan manis tersebut?', '{\"X6y7j\":\"Ya\",\"Q3Jtk\":\"Tidak\"}', 'radio_opt', 0, 15, '2023-07-01 18:20:31'),
(35, 'Berapa harga rata-rata makanan manis tersebut?', '{\"DzfYU\":\"5.000 - 10.000\",\"8GQiW\":\"10.000 - 15.000\"}', 'radio_opt', 0, 15, '2023-07-01 18:20:31'),
(36, 'Ada berapa jenis makanan manis yang sering anda beli?', '{\"fQC1P\":\"1\",\"Si3Eo\":\"2\",\"w8yF6\":\"3\",\"NhgB0\":\"Lebih dari 3\"}', 'check_opt', 0, 15, '2023-07-01 18:20:31'),
(37, 'Apa saja jenis makanan manis yang anda sukai?', '', 'textfield_m', 0, 15, '2023-07-01 18:20:31'),
(38, 'Apa alasan anda membeli makanan manis tersebut?', '{\"MlVs2\":\"Karena Murah\",\"OmJI7\":\"Karena Enak\"}', 'check_opt', 0, 15, '2023-07-01 18:20:31'),
(39, 'Dari mana anda mendapatkan informasi tentang makanan manis tersebut?', '{\"HSkMA\":\"Hiburan\",\"jZ9Kw\":\"Iklan\"}', 'radio_opt', 0, 15, '2023-07-01 18:20:31'),
(40, 'Seberapa sering anda membeli makanan manis tersebut?', '{\"h5rXI\":\"Sering\",\"nabUJ\":\"Tidak Sering\"}', 'radio_opt', 0, 15, '2023-07-01 18:20:31'),
(41, 'Apakah anda pernah memberikan ulasan tentang makanan manis tersebut?', '{\"vV6d3\":\"Ya\",\"R1tNG\":\"Tidak\"}', 'radio_opt', 0, 15, '2023-07-01 18:20:31'),
(42, 'Apakah anda mengetahui info tentang komponen dalam makanan manis tersebut?', '{\"puf4Q\":\"Ya\",\"41bcT\":\"Tidak\"}', 'radio_opt', 0, 15, '2023-07-01 18:20:31'),
(43, 'Apakah anda pernah makan makanan Indonesia sebelumnya?', '{\"fNYFx\":\"Ya\",\"TOBjb\":\"Tidak\"}', 'radio_opt', 1, 17, '2023-07-03 12:43:45'),
(44, 'Seberapa sering anda makan makanan Indonesia?', '{\"ANBoR\":\"Setiap Hari\",\"Hqyty\":\"Sekali dalam Sebulan\"}', 'radio_opt', 4, 17, '2023-07-03 12:43:45'),
(45, 'Apa yang menjadi masakan favorit anda dari makanan Indonesia?', '', 'textfield_s', 2, 17, '2023-07-03 12:43:45'),
(46, 'Apa jenis masakan atau olahan makanan Indonesia yang paling anda sukai?', '{\"hNBx6\":\"Gado Gado\",\"WJfgC\":\"Rendang\"}', 'check_opt', 3, 17, '2023-07-03 12:43:45'),
(47, 'bagaimana pendapat anda tentang kemudahan menemukan makanan Indonesia di wilayah anda?', '{\"DikpU\":\"Sangat mudah\",\"kydvY\":\"Kurang mudah\"}', 'radio_opt', 5, 17, '2023-07-03 12:43:45'),
(48, 'Berapakah jumlah biaya yang biasanya anda keluarkan untuk membeli makanan Indonesia?', '{\"HzPDe\":\"Di bawah Rp50.000\",\"zvnms\":\"Rp50.000 - Rp100.000\"}', 'radio_opt', 6, 17, '2023-07-03 12:43:45'),
(49, 'Berapakah variasi menu yang biasanya tersedia di tempat makanan Indonesia?', '{\"nwStK\":\"Terbatas\",\"svmSP\":\"Lebih dari 10 jenis\"}', 'radio_opt', 7, 17, '2023-07-03 12:43:45'),
(50, 'Apa yang menjadi alasan utama anda untuk memesan makanan Indonesia di tempat makan?', '{\"FYjGq\":\"Harganya murah\",\"StcMe\":\"Rasa enak\"}', 'check_opt', 8, 17, '2023-07-03 12:43:45'),
(51, 'Apakah anda puas dengan pelayanan di tempat makanan Indonesia?', '{\"WfcRf\":\"Ya\",\"TRsfB\":\"Tidak\"}', 'radio_opt', 9, 17, '2023-07-03 12:43:45'),
(52, 'Apakah anda akan merekomendasikan makanan Indonesia kepada orang lain?', '{\"mqMnd\":\"Ya\",\"qKjEu\":\"Tidak\"}', 'radio_opt', 10, 17, '2023-07-03 12:43:45'),
(53, 'Apa jenis tanaman hias yang anda sukai?', '{\"fQCrP\":\"Pot Bunga\",\"SDIEo\":\"Pohon Bonsai\"}', 'radio_opt', 0, 1, '2023-07-04 22:27:06'),
(54, 'Bagaimana frekuensi anda berkebun?', '{\"fQC1P\":\"Setiap Hari\",\"Si3Eo\":\"Seminggu Sekali\",\"Dd9Ie\":\"Bulanan\"}', 'check_opt', 0, 1, '2023-07-04 22:27:06'),
(55, 'Apakah anda tahu bahwa tanaman hias bisa digunakan untuk dekorasi?', '{\"fQCrP\":\"Ya\",\"SDIEo\":\"Tidak\"}', 'radio_opt', 0, 1, '2023-07-04 22:27:06'),
(56, 'Berapa lama waktu anda untuk merawat tanaman hias?', '{\"fQC1P\":\"Kurang Dari 1 Jam\",\"Si3Eo\":\"1-2 Jam\",\"Dd9Ie\":\"Lebih Dari 2 Jam\"}', 'check_opt', 0, 1, '2023-07-04 22:27:06'),
(57, 'Bagaimana cara anda mendapatkan informasi tentang tanaman hias?', '{\"fQCrP\":\"Internet\",\"SDIEo\":\"Buku\",\"V4D5g\":\"Orang Lain\"}', 'check_opt', 0, 1, '2023-07-04 22:27:06'),
(58, 'Apakah anda mengetahui bahaya kimia yang biasa digunakan untuk menyiram tanaman hias?', '{\"fQCrP\":\"Ya\",\"SDIEo\":\"Tidak\"}', 'radio_opt', 0, 1, '2023-07-04 22:27:06'),
(59, 'Menurut anda, apakah tanaman hias dapat menyehatkan udara?', '{\"fQCrP\":\"Ya\",\"SDIEo\":\"Tidak\"}', 'radio_opt', 0, 1, '2023-07-04 22:27:06'),
(60, 'Berapa banyak tanaman hias yang anda miliki?', '{\"fQC1P\":\"0\",\"Si3Eo\":\"1-2\",\"Dd9Ie\":\"Lebih Dari 2\"}', 'check_opt', 0, 1, '2023-07-04 22:27:06'),
(61, 'Di mana anda membeli tanaman hias?', '{\"fQCrP\":\"Toko Bunga\",\"SDIEo\":\"Toko Online\",\"V4D5g\":\"Taman Kota\"}', 'check_opt', 0, 1, '2023-07-04 22:27:06'),
(62, 'Apakah anda familiar dengan jenis-jenis tanaman hias?', '{\"fQCrP\":\"Ya\",\"SDIEo\":\"Tidak\"}', 'radio_opt', 0, 1, '2023-07-04 22:27:06'),
(73, 'Berapa jam anda tidur per malam?', '{\"fQCrP\":\"Kurang dari 5 jam\",\"SDIEo\":\"Antara 6-7 jam\",\"CuE3K\":\"Lebih dari 8 jam\"}', 'radio_opt', 0, 19, '2023-07-06 19:57:29'),
(74, 'Apakah anda kebingungan dalam pikiran saat beristirahat?', '{\"ZilcF\":\"ya\",\"KDMIw\":\"tidak\"}', 'radio_opt', 0, 19, '2023-07-06 19:57:29'),
(75, 'Apakah anda mengalami jerawat akibat tidur?', '{\"G5gYb\":\"Ya\",\"js6Jh\":\"Tidak\"}', 'radio_opt', 0, 19, '2023-07-06 19:57:29'),
(76, 'Apakah anda merasa nyaman saat tidur?', '{\"G2vTb\":\"Ya\",\"j93Hh\":\"Tidak\"}', 'radio_opt', 0, 19, '2023-07-06 19:57:29'),
(77, 'Apakah anda kesulitan untuk tidur?', '{\"B5gUb\":\"Ya\",\"n62Fh\":\"Tidak\"}', 'radio_opt', 0, 19, '2023-07-06 19:57:29'),
(78, 'Apakah anda merasa sering lelah setelah bangun tidur?', '{\"B8vCh\":\"Ya\",\"n09Th\":\"Tidak\"}', 'radio_opt', 0, 19, '2023-07-06 19:57:29'),
(79, 'Apakah anda menggunakan gadget saat menjelang tidur?', '{\"K9sMd\":\"Ya\",\"qO7Rt\":\"Tidak\"}', 'radio_opt', 0, 19, '2023-07-06 19:57:29'),
(80, 'Apakah anda rutin mengkonsumsi obat-obatan terlarang?', '{\"Ks2Dd\":\"Ya\",\"qF8It\":\"Tidak\"}', 'radio_opt', 0, 19, '2023-07-06 19:57:29'),
(81, 'Apakah anda merasakan sakit kepala setiap pagi?', '{\"K22Fd\":\"Ya\",\"q0F8t\":\"Tidak\"}', 'radio_opt', 0, 19, '2023-07-06 19:57:29'),
(82, 'Apakah anda sering memiliki mimpi buruk dan menjadi takut beristirahat?', '{\"B5AHb\":\"Ya\",\"n9eOh\":\"Tidak\"}', 'radio_opt', 0, 19, '2023-07-06 19:57:29'),
(93, 'Adakah anda peduli terhadap lingkungan di sekitar anda?', '{\"fQCrP\":\"Ya\",\"SDIEo\":\"Tidak\"}', 'radio_opt', 0, 21, '2023-07-09 12:14:24'),
(94, 'Mengapa anda peduli terhadap lingkungan?', '{}', 'textfield_s', 0, 21, '2023-07-09 12:14:24'),
(95, 'Apakah anda menggunakan produk yang ramah lingkungan?', '{\"fQC1P\":\"Ya\",\"Si3Eo\":\"Tidak\"}', 'check_opt', 0, 21, '2023-07-09 12:14:24'),
(96, 'Apa dampak negatif yang telah anda lihat dari pencemaran lingkungan?', '{}', 'textfield_s', 0, 21, '2023-07-09 12:14:24'),
(97, 'Apa yang anda pikirkan tentang perusahaan yang melakukan pencemaran lingkungan?', '{}', 'textfield_s', 0, 21, '2023-07-09 12:14:24'),
(98, 'Seberapa sering anda menggunakan transportasi umum?', '{\"fQC9P\":\"Sering\",\"SDIE2\":\"Jarang\"}', 'radio_opt', 0, 21, '2023-07-09 12:14:24'),
(99, 'Apakah anda mengulurkan bantuan untuk lingkungan?', '{\"fQC4P\":\"Ya\",\"SDIEu\":\"Tidak\"}', 'radio_opt', 0, 21, '2023-07-09 12:14:24'),
(100, 'Apa yang anda pikirkan tentang aksi demonstrasi yang dilakukan untuk pelestarian lingkungan?', '{}', 'textfield_s', 0, 21, '2023-07-09 12:14:24'),
(101, 'Apakah anda berpartisipasi dalam kegiatan yang berkaitan dengan pemulihan lingkungan?', '{\"fQC5P\":\"Ya\",\"SDIEx\":\"Tidak\"}', 'radio_opt', 0, 21, '2023-07-09 12:14:24'),
(102, 'Apa alasan anda untuk berpartisipasi?', '{}', 'textfield_s', 0, 21, '2023-07-09 12:14:24'),
(103, 'Sebutkan 3 makanan pedas yang anda sukai?', '{\"ZT27P\":\"Ayam Cabai Rendang\",\"VJ9CP\":\"Cumi Cabai Merah\",\"ENQ4P\":\"Rica-Rica Ayam\"}', 'check_opt', 0, 22, '2023-07-09 12:22:34'),
(104, 'Apa negara asal makanan pedas yang anda sukai?', '{\"r059P\":\"Indonesia\",\"Ypl4P\":\"India\",\"fvA5P\":\"Thailand\"}', 'radio_opt', 0, 22, '2023-07-09 12:22:34'),
(105, 'Berapa lama pengalaman anda mencicipi makanan pedas?', '{\"QKbqP\":\"Kurang dari 2 tahun\",\"W6ZfP\":\"2 - 5 tahun\",\"mN1cP\":\"6 - 10 tahun\",\"Ot7GP\":\"Lebih dari 10 tahun\"}', 'radio_opt', 0, 22, '2023-07-09 12:22:34'),
(106, 'Bagaimana anda menilai rasa makanan pedas?', '{\"S5YwP\":\"Enak\",\"HqXIP\":\"Agak Pedas\",\"dasVP\":\"Pedas Sekali\"}', 'radio_opt', 0, 22, '2023-07-09 12:22:34'),
(107, 'Apakah anda memakan makanan pedas harian?', '{\"pF8TP\":\"Ya\",\"oyhDP\":\"Tidak\"}', 'radio_opt', 0, 22, '2023-07-09 12:22:34'),
(108, 'Berapa kerap anda memakan makanan pedas?', '{\"cs1WP\":\"Setiap Hari\",\"R3BHP\":\"Sebulan Sekali\",\"ssfiP\":\"Setiap Bulan\",\"zUQXP\":\"Jarang Sekali\"}', 'radio_opt', 0, 22, '2023-07-09 12:22:34'),
(109, 'Apakah anda mencoba untuk mengurangi konsumsi makanan pedas?', '{\"SvEPP\":\"Ya\",\"wpVqP\":\"Tidak\"}', 'radio_opt', 0, 22, '2023-07-09 12:22:34'),
(110, 'Apa alasan anda mengurangi konsumsi makanan pedas?', '{\"hAZBP\":\"Kesehatan\",\"SJKUP\":\"Budaya\",\"nPpCP\":\"Rasa\"}', 'check_opt', 0, 22, '2023-07-09 12:22:34'),
(111, 'Berapa tingkat preferasi makanan pedas yang anda sukai?', '{\"B0NCP\":\"Kurang Pedas\",\"A9EGP\":\"Sedang\",\"i3FDP\":\"Pedas\"}', 'radio_opt', 0, 22, '2023-07-09 12:22:34'),
(112, 'Apa ciri makanan pedas yang telah anda coba?', '{\"XUQGP\":\"Tidak Cabe Keriting\",\"kDrjP\":\"Cabe Besar\",\"PNgnP\":\"Cabe Merah\",\"GarmP\":\"Bumbu Instan\"}', 'check_opt', 0, 22, '2023-07-09 12:22:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat`
--

CREATE TABLE `riwayat` (
  `id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `survey_id` int(30) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `poin_tambah` int(30) NOT NULL,
  `poin_kurang` int(30) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `riwayat`
--

INSERT INTO `riwayat` (`id`, `user_id`, `survey_id`, `judul`, `poin_tambah`, `poin_kurang`, `keterangan`, `tanggal`) VALUES
(1, 7, 13, 'Survey 2', 10, 0, 'Menjawab Survey', '2023-06-25 09:11:08'),
(3, 9, 13, 'percobaan kuis', 10, 0, 'Menjawab Survey', '2023-06-25 12:07:08'),
(12, 9, 13, 'percobaan kuis', 10, 0, 'Menjawab Survey', '2023-06-26 13:05:36'),
(13, 1, 13, 'percobaan kuis', 300, 400, 'Mengisi poin survey', '2023-06-26 13:23:19'),
(14, 1, 7, 'av', 0, 10, 'Mengisi poin survey', '2023-06-27 16:25:40'),
(15, 1, 3, 'Survey 2', 2, 100, 'Mengisi poin survey', '2023-06-30 01:44:46'),
(16, 1, 3, 'Survey 2', 100, 80, 'Mengisi poin survey', '2023-06-30 01:47:34'),
(17, 9, 3, 'Survey 2', 2, 0, 'Menjawab Survey', '2023-06-30 02:19:22'),
(40, 9, 13, 'percobaan kuis', 0, 0, 'Mengambil report survey', '2023-07-01 03:51:14'),
(41, 1, 13, 'percobaan kuis', 0, 0, 'Menerima poin survey report', '2023-07-01 03:51:14'),
(42, 9, 3, 'Survey 2', 0, 20, 'Mengambil report survey', '2023-07-01 05:27:29'),
(43, 1, 3, 'Survey 2', 20, 0, 'Menerima poin survey report', '2023-07-01 05:27:29'),
(44, 9, 16, 'makanan pedas', 0, 0, 'Menjawab Survey', '2023-07-01 10:34:41'),
(45, 7, 17, 'makanan indonesia', 0, 0, 'Menjawab Survey', '2023-07-03 11:37:11'),
(46, 9, 17, 'makanan indonesia', 0, 0, 'Menjawab Survey', '2023-07-03 11:37:45'),
(47, 1, 2, 'Survey 1', 0, 0, 'Poin sisa menghapus survey', '2023-07-06 11:55:30'),
(48, 1, 18, 'kesehatan tidur', 0, 0, 'Poin sisa menghapus survey', '2023-07-06 12:56:33'),
(49, 9, 19, 'kesehatan tidur', 0, 0, 'Menjawab Survey', '2023-07-06 12:59:34'),
(50, 9, 20, 'Tidur sehat', 0, 100, 'Mengisi poin survey', '2023-07-09 05:01:23'),
(51, 9, 20, 'Tidur sehat', 100, 0, 'Poin sisa menghapus survey', '2023-07-09 05:12:41'),
(52, 9, 21, 'Kesadaran Lingkungan', 0, 100, 'Mengisi poin survey', '2023-07-09 05:14:47'),
(53, 9, 21, 'Kesadaran Lingkungan', 2, 0, 'Menjawab Survey', '2023-07-09 05:16:53'),
(54, 9, 22, 'makanan pedas Indonesia', 0, 0, 'Menjawab Survey', '2023-07-09 05:27:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `survey_set`
--

CREATE TABLE `survey_set` (
  `id` int(30) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `user_id` int(30) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `skor` int(11) NOT NULL,
  `poin_survey` int(30) NOT NULL,
  `stok_poin` int(30) NOT NULL,
  `poin_r` int(30) NOT NULL,
  `status_r` varchar(50) NOT NULL,
  `status_s` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `survey_set`
--

INSERT INTO `survey_set` (`id`, `title`, `description`, `user_id`, `start_date`, `end_date`, `date_created`, `skor`, `poin_survey`, `stok_poin`, `poin_r`, `status_r`, `status_s`) VALUES
(1, 'Sample Survey', 'Sample Only', 1, '2023-07-04', '2023-07-12', '2020-11-10 09:57:47', 0, 0, 0, 0, 'pribadi', ''),
(3, 'Survey 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec in tempus turpis, sed fermentum risus. Praesent vitae velit rutrum, dictum massa nec, pharetra felis. ', 1, '2023-07-04', '2023-07-14', '2020-11-10 14:12:33', 2, 2, 78, 20, 'berhenti berbagi', 'tutup'),
(4, 'Survey 23', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec in tempus turpis, sed fermentum risus. Praesent vitae velit rutrum, dictum massa nec, pharetra felis. ', 1, '0000-00-00', '0000-00-00', '2020-11-10 14:14:03', 1, 0, 0, 0, 'pribadi', ''),
(6, 'xzczx', 'fasfadsad', 1, '0000-00-00', '0000-00-00', '2023-06-12 14:27:01', 0, 0, 0, 0, 'pribadi', 'tutup'),
(7, 'av', 'vvaaq', 1, '0000-00-00', '0000-00-00', '2023-06-12 15:20:18', 0, 3, 10, 0, 'pribadi', ''),
(8, 'gsdgsdfs', 'adasfsdgcvsafadassadasd', 1, '0000-00-00', '0000-00-00', '2023-06-18 10:44:02', 3, 10, 300, 0, 'pribadi', ''),
(9, 'asdaghccxv', 'DFczcvzxcvzxc', 1, '0000-00-00', '0000-00-00', '2023-06-18 14:05:23', 0, 0, 0, 0, 'pribadi', ''),
(10, 'dasdad', 'xvcxvaweqasdad', 1, '0000-00-00', '0000-00-00', '2023-06-18 17:23:01', 0, 0, 0, 0, 'pribadi', ''),
(11, 'asdsadffff', 'asdasdsadasd', 1, '0000-00-00', '0000-00-00', '2023-06-19 19:19:36', 0, 0, 0, 0, 'pribadi', ''),
(12, 'xcvcxvxcv', 'agvcvxzvzcxa', 1, '0000-00-00', '0000-00-00', '2023-06-19 19:23:54', 0, 0, 0, 0, 'pribadi', ''),
(13, 'percobaan kuis', 'semoga bisa', 1, '0000-00-00', '0000-00-00', '2023-06-21 19:34:02', 1, 10, 400, 20, 'pribadi', ''),
(14, 'safad', 'aafasdasd', 0, '0000-00-00', '0000-00-00', '2023-07-01 17:15:13', 0, 0, 0, 0, 'pribadi', ''),
(15, 'asdsadsadsad', 'sfdsfdsvcxvxvcxv', 0, '0000-00-00', '0000-00-00', '2023-07-01 17:19:14', 0, 0, 0, 0, 'pribadi', ''),
(16, 'makanan pedas', 'survey tentang makanan prdas di indonesia', 1, '0000-00-00', '0000-00-00', '2023-07-01 17:28:58', 0, 0, 0, 0, 'pribadi', ''),
(17, 'makanan indonesia', 'survey tentang makanan Indonesia', 1, '2023-07-04', '2023-07-13', '2023-07-03 12:43:17', 0, 0, 0, 0, 'sedang berbagi', 'mulai'),
(19, 'kesehatan tidur', 'survey tentang kesehatan tidur', 1, '2023-07-06', '2023-07-14', '2023-07-06 19:57:06', 0, 0, 0, 0, 'pribadi', ''),
(21, 'Kesadaran Lingkungan', 'survey yang mencari tingkat kepedulian masyarakat terhadap lingkungan', 9, '2023-07-09', '2023-07-13', '2023-07-09 12:14:02', 0, 2, 98, 0, 'pribadi', 'mulai'),
(22, 'makanan pedas Indonesia', 'survey tentang makanan pedas yang ada di Indonesia', 9, '2023-07-10', '2023-07-12', '2023-07-09 12:22:09', 1, 0, 0, 0, 'pribadi', 'mulai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 3 COMMENT '1=Admin,2 = Staff, 3= Subscriber',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `poin_user` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `type`, `date_created`, `poin_user`) VALUES
(1, 'Admin', 'Admin', 'admin@admin.com', '0192023a7bbd73250516f069df18b500', 1, '2020-11-10 08:43:06', 1020),
(2, 'John', 'Smith', 'jsmith@sample.com', '1254737c076cf867dc53d60a0364f38e', 3, '2020-11-10 09:16:53', 1000),
(3, 'Claire', 'Blake', 'cblake@sample.com', '4744ddea876b11dcb1d169fadf494418', 3, '2020-11-10 15:59:11', 1000),
(4, 'Mike', 'Williams', 'mwilliams@sample.com', '3cc93e9a6741d8b40460457139cf8ced', 3, '2020-11-10 16:21:02', 1000),
(5, 'yusuf', 'yanto', 'digimonbbbvc@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 3, '2023-06-12 14:29:40', 1000),
(6, 'daaa', 'ddd', 'fitriyanto_yusuf@yahoo.co.id', '78cabc5aba4deefb445ff2c627c5fd30', 3, '2023-06-19 19:13:26', 1000),
(7, 'adxcz', 'asda', 'digimoncxz1@gmail.com', '78cabc5aba4deefb445ff2c627c5fd30', 3, '2023-06-19 19:39:02', 1010),
(8, 'dasd', 'ff', 'yusuffy123@gmail.com', '78cabc5aba4deefb445ff2c627c5fd30', 3, '2023-06-23 17:11:20', 1000),
(9, 'asdasd', 'as', 'coba@gmail.com', 'c3ec0f7b054e729c5a716c8125839829', 3, '2023-06-25 15:44:30', 909),
(10, 'yusuf', 'yanto', 'yusuf@gmail.com', '78cabc5aba4deefb445ff2c627c5fd30', 3, '2023-07-07 19:32:41', 1000),
(11, 'yusuf', 'yanto', 'aku@gmail.com', 'c20ad4d76fe97759aa27a0c99bff6710', 3, '2023-07-09 19:21:00', 1000),
(12, 'aku', 'g', 'gg@gmail.com', '78cabc5aba4deefb445ff2c627c5fd30', 3, '2023-07-09 19:23:11', 1000);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `daftar_blokir`
--
ALTER TABLE `daftar_blokir`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kuis_s`
--
ALTER TABLE `kuis_s`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `riwayat`
--
ALTER TABLE `riwayat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `survey_set`
--
ALTER TABLE `survey_set`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT untuk tabel `daftar_blokir`
--
ALTER TABLE `daftar_blokir`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `kuis_s`
--
ALTER TABLE `kuis_s`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT untuk tabel `riwayat`
--
ALTER TABLE `riwayat`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT untuk tabel `survey_set`
--
ALTER TABLE `survey_set`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
