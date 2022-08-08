-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 22 Jul 2019 pada 17.42
-- Versi server: 5.7.27-log
-- Versi PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adeevato_travel`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `custom_destinasi`
--

CREATE TABLE `custom_destinasi` (
  `id` int(11) NOT NULL,
  `nama_custom_destinasi` varchar(126) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `custom_destinasi`
--

INSERT INTO `custom_destinasi` (`id`, `nama_custom_destinasi`) VALUES
(1, 'Trans Studio Mall'),
(2, 'Farm House '),
(3, 'Curug Malela'),
(4, 'Pulau Tidung'),
(5, 'Pulau Bidadari'),
(6, 'Kebun Binatang Ragunan'),
(7, '123'),
(8, '123'),
(9, '123'),
(10, 'Dusun Bambu'),
(11, 'Taman Bunga Begonia'),
(12, 'Floating Market'),
(13, 'Pantai Ancol'),
(14, 'Ocean Dream Samudra'),
(15, 'Dunia Fantasi'),
(16, 'Pantai Sepanjang'),
(17, 'Pantai Goa Cemara'),
(18, 'Pantai Ngobaran'),
(19, 'Kebun Raya Bali'),
(20, 'Museum Bali'),
(21, 'Ubud Palace'),
(22, 'Kuntum Farmfield'),
(23, 'Kebun Durian Warso Farm'),
(24, 'Museum Zoologi '),
(25, 'Pulau Pasir Bintang Laut'),
(26, 'Pantai Chicas'),
(27, 'Pantai Tanjung Pendam'),
(28, 'Danau Segara Anak'),
(29, 'Air Terjun Sendang Gile'),
(30, 'Pantai Tebing');

-- --------------------------------------------------------

--
-- Struktur dari tabel `destinasi`
--

CREATE TABLE `destinasi` (
  `id` int(11) NOT NULL,
  `nama_destinasi` varchar(126) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `destinasi`
--

INSERT INTO `destinasi` (`id`, `nama_destinasi`) VALUES
(1, 'Trans Studio Bandung'),
(2, 'Tangkuban Perahu'),
(3, 'Farm House'),
(4, 'Dunia Fantasi (DUFAN))'),
(5, 'Taman Mini'),
(6, 'Kepulauan Seribu'),
(7, 'Candi Borobudur'),
(8, 'Malioboro'),
(9, 'Pantai Parangtritis'),
(10, 'Bali Safari & Marine Park'),
(11, 'Pantai Pandawa'),
(12, 'Tanah Lot'),
(13, 'Taman Safari'),
(14, 'The Jungleland'),
(15, 'Kebun Raya Bogor'),
(16, 'Danau Biru Kaolin'),
(17, 'Pulau Leebong'),
(18, 'Hutan Mangrove'),
(19, 'Kepulauan Gili'),
(20, 'Pantai Tangsi(Pink Beach)'),
(21, 'Rumah Adat Suku Sasak Sade');

-- --------------------------------------------------------

--
-- Struktur dari tabel `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id` int(11) NOT NULL,
  `nama_fasilitas` varchar(126) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `fasilitas`
--

INSERT INTO `fasilitas` (`id`, `nama_fasilitas`) VALUES
(1, 'Penginapan'),
(2, 'Snack 3x'),
(3, 'Makanan Berat 3x'),
(4, 'Tenda'),
(5, 'P3K di bus'),
(6, 'Transportasi bus AC'),
(7, 'Makan 4x (2x makan pagi, 2x makan siang)'),
(8, 'Hotel'),
(9, 'tiket masuk tempat wisata');

-- --------------------------------------------------------

--
-- Struktur dari tabel `item_custom_destinasi`
--

CREATE TABLE `item_custom_destinasi` (
  `id` int(11) NOT NULL,
  `paket_wisata_id` int(11) DEFAULT NULL,
  `custom_destinasi_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `item_custom_destinasi`
--

INSERT INTO `item_custom_destinasi` (`id`, `paket_wisata_id`, `custom_destinasi_id`) VALUES
(4, 2, 4),
(5, 2, 5),
(6, 2, 6),
(10, 1, 10),
(11, 1, 11),
(12, 1, 12),
(16, 3, 16),
(17, 3, 17),
(18, 3, 18),
(19, 4, 19),
(20, 4, 20),
(21, 4, 21),
(22, 5, 22),
(23, 5, 23),
(24, 5, 24),
(25, 6, 25),
(26, 6, 26),
(27, 6, 27),
(28, 7, 28),
(29, 7, 29),
(30, 7, 30);

-- --------------------------------------------------------

--
-- Struktur dari tabel `item_destinasi`
--

CREATE TABLE `item_destinasi` (
  `id` int(11) NOT NULL,
  `paket_wisata_id` int(11) DEFAULT NULL,
  `destinasi_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `item_destinasi`
--

INSERT INTO `item_destinasi` (`id`, `paket_wisata_id`, `destinasi_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 2, 4),
(5, 2, 5),
(6, 2, 6),
(7, 3, 7),
(8, 3, 8),
(9, 3, 9),
(10, 4, 10),
(11, 4, 11),
(12, 4, 12),
(13, 5, 13),
(14, 5, 14),
(15, 5, 15),
(16, 6, 16),
(17, 6, 17),
(18, 6, 18),
(19, 7, 19),
(20, 7, 20),
(21, 7, 21);

-- --------------------------------------------------------

--
-- Struktur dari tabel `item_fasilitas`
--

CREATE TABLE `item_fasilitas` (
  `id` int(11) NOT NULL,
  `paket_wisata_id` int(11) DEFAULT NULL,
  `fasilitas_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `item_fasilitas`
--

INSERT INTO `item_fasilitas` (`id`, `paket_wisata_id`, `fasilitas_id`) VALUES
(152, 1, 5),
(153, 1, 6),
(154, 1, 7),
(155, 1, 8),
(156, 1, 9),
(157, 2, 2),
(158, 2, 3),
(159, 2, 5),
(160, 2, 6),
(161, 2, 7),
(162, 2, 8),
(163, 2, 9),
(164, 3, 2),
(165, 3, 5),
(166, 3, 6),
(167, 3, 7),
(168, 3, 8),
(169, 3, 9),
(176, 4, 2),
(177, 4, 5),
(178, 4, 6),
(179, 4, 7),
(180, 4, 8),
(181, 4, 9),
(182, 5, 2),
(183, 5, 5),
(184, 5, 6),
(185, 5, 7),
(186, 5, 8),
(187, 5, 9),
(188, 6, 2),
(189, 6, 5),
(190, 6, 6),
(191, 6, 7),
(192, 6, 8),
(193, 6, 9),
(194, 7, 2),
(195, 7, 5),
(196, 7, 6),
(197, 7, 7),
(198, 7, 8),
(199, 7, 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `item_thumbnail`
--

CREATE TABLE `item_thumbnail` (
  `id` int(11) NOT NULL,
  `paket_wisata_id` int(11) DEFAULT NULL,
  `thumbnail_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `item_thumbnail`
--

INSERT INTO `item_thumbnail` (`id`, `paket_wisata_id`, `thumbnail_id`) VALUES
(1, 2, 1),
(2, 2, 2),
(3, 2, 3),
(4, 1, 4),
(5, 1, 6),
(6, 1, 5),
(7, 3, 7),
(8, 3, 8),
(9, 4, 9),
(10, 4, 10),
(11, 4, 11),
(12, 5, 12),
(13, 5, 13),
(14, 5, 14),
(15, 6, 15),
(16, 6, 16),
(17, 6, 17),
(18, 7, 18),
(19, 7, 19),
(20, 7, 20);

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket_wisata`
--

CREATE TABLE `paket_wisata` (
  `id` int(11) NOT NULL,
  `nama_paket` varchar(126) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` int(11) NOT NULL,
  `minimal_orang` int(5) NOT NULL,
  `thumbnail` varchar(126) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `paket_wisata`
--

INSERT INTO `paket_wisata` (`id`, `nama_paket`, `deskripsi`, `harga`, `minimal_orang`, `thumbnail`) VALUES
(1, 'Bandung City Tour / 2D1N', 'Bandung adalah salah satu kota terbesar di Indonesia dan ibu kota Provinsi Jawa Barat. Terletak di dataran tinggi Jawa Barat pada ketinggian 715 m (2.350 kaki) di wilayah yang indah. Bandung juga dikenal sebagai \'Kota Bunga\' atau Kota Kembang dalam Bahasa Indonesia. Kota ini adalah pusat industri utama yang memproduksi tekstil. Jalan Cihampelas adalah salah satu lokasi toko pakaian populer.', 850000, 25, 'fed1e680668db1b0b4f523234b457313.jpg'),
(2, 'Jakarta City Tour  / 2D1N', 'Jakarta memiliki luas sekitar 661,52 km² (lautan: 6.977,5 km²), dengan penduduk berjumlah 10.374.235 jiwa (2017).[3] Wilayah metropolitan Jakarta (Jabodetabek) yang berpenduduk sekitar 28 juta jiwa,[7] merupakan metropolitan terbesar di Asia Tenggara atau urutan kedua di dunia.\r\n\r\nSebagai pusat bisnis, politik, dan kebudayaan, Jakarta merupakan tempat berdirinya kantor-kantor pusat BUMN, perusahaan swasta, dan perusahaan asing. Kota ini juga menjadi tempat kedudukan lembaga-lembaga pemerintahan dan kantor sekretariat ASEAN. Jakarta dilayani oleh dua bandar udara, yakni Bandara Soekarno–Hatta dan Bandara Halim Perdanakusuma, serta tiga pelabuhan laut di Tanjung Priok, Sunda Kelapa, dan Ancol.', 960000, 25, '770eb8fc5b1c96fd4339039d346b48e0.jpg'),
(3, 'Yogyakarta City Tour  / 3D2N', 'Kota Yogyakarta tidak saja terkenal dari budaya dan pariwisatanya namun juga dari segi pendidikan pun patut untuk diacungi jepol. Disana terdapat sekolah dan universitas-universitas unggulan yang tidak diragukan lagi kualitasnya. Sehingga tak heran kalau Jogja ini dipadati oleh para pelajar yang datang dari berbagai daerah diseluruh Indonesia. Pemandangan di pagi hari yang akan kamu dapatkan dijalanan adalah padatnya keramaian lalu lintas jalanan oleh para pelajar, pegawai dan semua orang yang akan melakukan aktifitas mereka masing-masing. Suasana Kota Yogyakarta inilah yang sangat memukau dan sangat indah untuk dinikmati. Seperti itulah gambaran tentang Kota Yogyakarta yang sangat memukau dan dirindukan oleh setiap pengunjung yang pernah datang. Pastikan kamu tertarik dan mengunjunginya dalam waktu dekat atau pada liburan kamu nanti.', 850000, 25, 'a184606f83de81777ca3b1e5f7f0a9d2.jpg'),
(4, 'Bali City Tour / 3D2N', 'Bali adalah primadona pariwisata Indonesia yang sudah terkenal di seluruh dunia. Selain terkenal dengan keindahan alam, terutama pantainya, Bali juga terkenal dengan kesenian dan budayanya yang unik dan menarik. ', 2750000, 25, '799d27f6ad96b285109891688247b50a.jpg'),
(5, 'Bogor City Tour/ 2D1N', 'Ketika seseorang mengatakan mengenai \"Bogor\", secara umum mereka memaksudkannya sebagai \"Kota Bogor\". Dengan curah hujan yang sangat tinggi, Bogor mendapatkan julukan sebagai \"kota hujan\"', 950000, 25, '2aabe5731f9788232cc6224927c84fbc.jpg'),
(6, 'Belitung City Tour / 3D2N', 'Belitung merupakan salah satu destinasi wisata di Indonesia yang harus kamu kunjungi.', 2700000, 25, '0bc14b80e03cdf3f94119b9c48a3eab1.jpg'),
(7, 'Lombok City tour', 'Travel  Destination 26 April 2019\r\n10 Tempat Wisata di Lombok yang Memikat dan Wajib Dikunjungi, Hits!\r\nBener-bener surga dunia nih...\r\n10 Tempat Wisata di Lombok yang Memikat dan Wajib Dikunjungi, Hits! instagram.com/muhajirefendy\r\n Andry Trisandy	\r\n Verified\r\nAndry Trisandy\r\n Share to Facebook  Share to Twitter	\r\nLombok seringkali disebut-sebut sebagai salah satu pulau tropis terbaik di Indonesia. Setelah Bali, Pulau Lombok selalu menjadi tujuan favorit bagi wisatawan', 2450000, 25, 'd32dbc5b3d04a809e14c5362b910c62e.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(126) NOT NULL,
  `foto_ktp` varchar(126) NOT NULL,
  `aktif` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `jenis_kelamin`, `alamat`, `telepon`, `email`, `password`, `foto_ktp`, `aktif`) VALUES
(1, 'Amirullah', 'L', 'Villa Bintaro Indah C.19/4 Ciputat,Tangsel', '081905382988', 'Amirullahwijayanto@gmail.com', '', '', 0),
(2, 'Andre', 'L', 'Sanbe Farma', '081808900006', '', '', '', 0),
(3, 'Angelia', 'L', 'Sanbe Farma', '081809674279', '', '', '', 0),
(4, 'Annisa', 'L', 'Komplek Blok-C Cihanjuang Indah', '089656007841', '', '', '', 0),
(5, 'Audina', 'L', '', '082120273422', '', '', '', 0),
(6, 'Ajat', 'L', 'SMA BINA DARMA', '085860779679', '', '', '', 0),
(7, 'Aziz', 'L', 'DINAS PERTAMANAN TRENGGALEK', '081233008002', '', '', '', 0),
(8, 'Ahmad', 'L', 'SDN PASKAL MANDIRI 1', '085624602914', '', '', '', 0),
(9, 'Andy', 'L', 'TELKOM UNIVERSITY', '081905641907', '', '', '', 0),
(10, 'Apriani M.S ', 'L', 'Jl. Cibogo Atas No. 08 RT. 05/03', '082218008290', '', '', '', 0),
(11, 'Anugrah Dwi J ', 'L', 'JL.CIBOGO GG.KARMA II RT.05/05 KEL.SUKAWARNA', '089665197834', '', '', '', 0),
(12, 'Devi', 'L', 'BLOK-C CIHANJUANG INDAH', '0878-7804-1187', '', '', '', 0),
(13, 'Deny', 'L', 'SANBE FARMA', '0813-1207-0006', '', '', '', 0),
(14, 'DIDIT', 'L', 'BEA CUKAI JAKARTA', '0813-2253-3575', '', '', '', 0),
(17, 'Rifqi Ramdhani', 'L', 'Perum Bukit Berlian C72', '0813-9300-3129', 'rifqiramdhani8@gmail.com', '$2y$10$bTG26tnTXrYWulwrd6qZLugwxiAg4jWVpTWx84JHEKeqSRzsaeI2W', '53c10ffc3726d3bbd0194b7126f2d96b.jpg', 1),
(18, 'User', 'L', 'jl budhi no 37', '081393003129', 'user@gmail.com', '$2y$10$HMHjR5Rik0Xe4xVT5sLgHOF5fKs1q11QlXdnl2dD6gdgMsXZNysBy', '9b27108e9204dbcac680044535c04115.jpg', 1),
(23, 'rifqi ramdhani', 'L', 'Bukit berlian C72', '081393003129', 'ramdhanirifqi8@gmail.com', '$2y$10$PCO7aWVs/jC7x3VzO0f9DukkGgUdOuUvlbJey4FsDvsRRySg9YwmW', '677c23983508531048a968e59b16378b.jpg', 1),
(24, 'Admin', 'L', 'jl budhi no 37', '081393003122', 'admin@gmail.com', '$2y$10$iSFOa/Hsdu160CT7lnhK3ean6G2xOV6L4QObUQyGsz0ohOeSNm2.S', 'c889efb480733cf64b86ec041509775e.jpg', 1),
(25, 'Saeful Apriana', 'L', 'Jl soekarno hatta no 2', '08139232223441', 'saeful.apriana@gmail.com', '$2y$10$Or4XHXguLcwAATo7ZwuuXOIvJVB6gvuFg1ccIvn1z50vJ2u5TW4ly', '24486baf488af3aca9ab8fc2d534d1b7.jpg', 1),
(28, 'Ginaya Hilmatul Farihah', 'P', 'Padalarang', '087827669534', 'ginayahf@gmail.com', '$2y$10$ICNsMLoXkS3odjTmy9l6jeMqs6wy8crx2Y2Mr.DF8SkoVtk4eiJAe', 'f3b29eac10e4fe5fc8f47443b30effc1.jpg', 1),
(30, 'Cimahi Therapy Center', 'L', 'Padalarang, Kabupaten Bandung Barat, Jawa Barat, Indonesia', '08133898890', 'cimahitherapycenter@gmail.com', '$2y$10$acCYmjE1RoVjjbCabsQt0e4ZsYnO0YjG3u7ZtvTHYTHPNXaMYypqO', '5927ca16a4fcd4bb0b8e13d15d9bb685.jpg', 1),
(31, 'Aku Cantik', 'P', 'margaasih', '0987654', 'fidyars@mahasiswa.unikom.ac.id', '$2y$10$vZpTwwZkOraOLXR2KYNdE.yyahCkhIFbpXLXppzKsppdELf/H1eUi', 'dbba75b0e5cc24c0a551676e4afb5d1c.jpg', 1),
(32, 'Fidya', 'P', 'margaasih', '087542', 'fidyarosa30@gmail.com', '$2y$10$5X/XLhSK4P0GtLPnMF0yJek35wh6GXRXrlxbRqOgdykvqB5SjfEga', '23cf3b221957625dad65b5ced08d17b2.jpg', 1),
(34, 'Adam Al Farisi', 'L', 'Jl. Cisitu Baru No.9', '081312767368', 'alfarisiadam137@gmail.com', '$2y$10$MPYQsLhoxW4HrT4k11xR4.RI/WfwpyEJ13.s9OnezJxlW4/v9Ey8G', '2c8e8135f56e338174ec95b251e54fb0.jpg', 1),
(35, 'Sakina Fikry', 'P', '', '', 'sakinaid296@gmail.com', '$2y$10$WYUd4rEys8OXDmP3Ckl0EOIpH/A1npiRNiP.kLaYBnmYekc7KEiHe', '', 1),
(36, 'Lutfi Azhari', 'P', '', '', 'lutfiazharimulyawan@gmail.com', '$2y$10$YQwQ/IYZOPC83Q5Vr1wuXewFm9j9fQfEZRKD2gwa8P5WvQkIZOcEW', '', 0),
(38, 'Muhamad Nur Huda', 'L', 'Taman Kopo Indah No,10', '087654568777', 'hudda.potter@gmail.com', '$2y$10$S6o1OwuWC2rovAGkSbX/CeDxLMXPY5qETreL7HsE1WkkTBnjbSSqW', '910838502a782bb2a88b722325d5ceb8.jpg', 1),
(39, 'Mutia Restu Dewanti', 'P', '', '', 'mutiard13@gmail.com', '$2y$10$Dw.evAwbH13p4ypujjzYpuCcQEq.IAbzLS1Fwah6AoYVV4tHZeKDK', '', 1),
(40, 'Fadil Syah', 'L', '', '', 'mfadhilsyah@yahoo.com', '$2y$10$u.eN7uFwh4Tr7eZ.KCNCOuIU5QpmRaggKHCjaJLkMZIIt2tzrEeNe', '', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id` int(11) NOT NULL,
  `kode_pemesanan` varchar(126) NOT NULL,
  `paket_wisata_id` int(11) NOT NULL,
  `pelanggan_id` int(11) NOT NULL,
  `nama_instansi` varchar(126) NOT NULL,
  `custom_destinasi` varchar(126) NOT NULL,
  `tanggal_keberangkatan` varchar(20) NOT NULL,
  `tanggal_pemesanan` date NOT NULL,
  `tanggal_pembatalan` date NOT NULL,
  `uang_kembali` int(11) NOT NULL,
  `jumlah_harga` int(11) NOT NULL,
  `jumlah_peserta` int(5) NOT NULL,
  `jumlah_bayar` int(11) NOT NULL,
  `sisa_bayar` int(11) NOT NULL,
  `status_pembayaran` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  `status_pemesanan` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pemesanan`
--

INSERT INTO `pemesanan` (`id`, `kode_pemesanan`, `paket_wisata_id`, `pelanggan_id`, `nama_instansi`, `custom_destinasi`, `tanggal_keberangkatan`, `tanggal_pemesanan`, `tanggal_pembatalan`, `uang_kembali`, `jumlah_harga`, `jumlah_peserta`, `jumlah_bayar`, `sisa_bayar`, `status_pembayaran`, `status`, `status_pemesanan`) VALUES
(1, '001/ORD/BOG', 5, 17, 'SMAN 1 CIMAHI', 'Museum Zoologi ', '2019-08-28', '2019-07-22', '0000-00-00', 0, 47500000, 50, 0, 0, 0, 1, 3),
(2, '002/ORD/BEL', 6, 17, 'SMAN 1 CIMAHI', 'Pulau Pasir Bintang Laut', '2019-08-27', '2019-07-22', '0000-00-00', 0, 67500000, 25, 0, 0, 0, 1, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `proses_pembatalan`
--

CREATE TABLE `proses_pembatalan` (
  `id` int(11) NOT NULL,
  `pemesanan_id` int(5) DEFAULT NULL,
  `tanggal_pembatalan` date NOT NULL,
  `status_proses_pembatalan` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `proses_pembayaran`
--

CREATE TABLE `proses_pembayaran` (
  `id` int(11) NOT NULL,
  `cicilan` int(11) NOT NULL,
  `total_cicilan` int(11) NOT NULL,
  `pemesanan_id` int(5) NOT NULL,
  `nomor_rekening` varchar(126) NOT NULL,
  `tanggal_pembayaran` date NOT NULL,
  `bukti_pembayaran` varchar(125) NOT NULL,
  `jumlah_transfer` int(11) NOT NULL,
  `jumlah_bayar` int(11) NOT NULL,
  `status_pembayaran` int(1) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `thumbnail`
--

CREATE TABLE `thumbnail` (
  `id` int(11) NOT NULL,
  `nama_thumbnail` varchar(126) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `thumbnail`
--

INSERT INTO `thumbnail` (`id`, `nama_thumbnail`) VALUES
(1, 'c671050834014b1ced4819f34880fbb3.jpg'),
(2, 'ad612033666d48ca8961b9fd8172da12.jpg'),
(3, 'c561fc1edbf51145c0d00cfdc7e368b8.jpg'),
(4, '7a24d33ae40fd87ad44d49468099bd5f.jpg'),
(5, 'f0554cb237f43c47634925c1afe2cf5c.jpg'),
(6, 'c54e9f5dba85499608b1328c49bae6ef.jpg'),
(7, 'e2f47cf889340f5a89a640b3117463be.jpg'),
(8, '70f5d9b9193f98d99c3163efc586c128.jpg'),
(9, 'a38d386f93ede6b16d1ca1bdd5ca7bfd.jpg'),
(10, '95b94a4ee94e7e6aefa8f89f5a54d4b5.jpg'),
(11, '01c50d7f5ead46f36bcf6fcb2a23c270.jpg'),
(12, '7f8cf5b37449d53ba42f4139e25926e3.jpg'),
(13, 'e0af5054f46b8923d67b217588216749.jpg'),
(14, 'd308c583040f1ac1f5cc9505f29d17f9.jpg'),
(15, '4e363755b03e2da1d0186dab33048a3f.jpg'),
(16, '99dbb08c548601a1feee5f8b9e39ea47.jpg'),
(17, 'c0061064d2cd7837e9c2ba3628b4148a.jpg'),
(18, 'dd4897e7fa7bee347ce3a1d7b21b29f8.jpg'),
(19, '7d6f899f2870704c8066b898741b1f37.jpg'),
(20, 'c8bdda77a39900dcba9fe275e7ab340b.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_akses_menu`
--

CREATE TABLE `user_akses_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_akses_menu`
--

INSERT INTO `user_akses_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 2, 1),
(2, 2, 2),
(3, 2, 3),
(5, 2, 6),
(9, 4, 10),
(10, 4, 11),
(12, 3, 13),
(16, 4, 1),
(17, 1, 1),
(22, 4, 16),
(23, 4, 17),
(24, 4, 18),
(25, 4, 19),
(26, 3, 1),
(27, 2, 20),
(28, 4, 21),
(29, 4, 22),
(31, 2, 23),
(32, 3, 23),
(33, 4, 25),
(34, 4, 26),
(35, 1, 24),
(36, 1, 8),
(37, 1, 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `title` varchar(126) NOT NULL,
  `url` varchar(126) NOT NULL,
  `icon` varchar(126) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `title`, `url`, `icon`) VALUES
(1, 'Home', 'home', 'fas fa-fw fa-home'),
(2, 'Data Pelanggan', 'data-pelanggan', 'fas fa-fw fa-chart-area'),
(3, 'Data Paket Wisata', 'data-paket-wisata', 'fas fa-fw fa-chart-area'),
(4, 'Data Pembatalan', 'data-pembatalan', 'fas fa-fw fa-list'),
(5, 'Data Pelanggan', 'data-pelanggan', 'fas fa-fw fa-chart-area'),
(6, 'Manage Pemesanan', 'manage-pemesanan', 'fas fa-fw fa-list'),
(8, 'Laporan Pembayaran', 'laporan-pembayaran', 'fas fa-fw fa-list'),
(9, 'Laporan Pembatalan', 'laporan-pembatalan', 'fas fa-fw fa-list'),
(10, 'Pemesanan', 'pemesanan', 'fas fa-bus'),
(11, 'Pembayaran', 'pembayaran', 'fas fa-fw fa-money-check'),
(13, 'Manage Pembayaran', 'data-pembayaran', 'fas fa-fw fa-chart-area'),
(14, 'Validasi', 'validasi', ''),
(16, '', 'form-pembayaran', ''),
(17, '', 'list-pembayaran', 'fas fa-fw fa-fw fa-chart-area'),
(18, '', 'detail-paket', ''),
(19, '', 'form-pemesanan', ''),
(20, 'Manage Tour', 'manage-tour', 'fas fa-fw fa-list'),
(21, '', 'my-profile', ''),
(22, '', 'cetak-kwitansi', ''),
(23, 'Manage Pembatalan', 'manage-pembatalan', 'fas fa-fw fa-list'),
(24, 'Laporan Pemesanan', 'laporan-pemesanan', 'fas fa-fw fa-list'),
(25, '', 'list-batal-pesanan', ''),
(26, '', 'pembatalan', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(126) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Direktur'),
(2, 'Manager Tour'),
(3, 'Manager Keuangan'),
(4, 'Pelanggan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(126) NOT NULL,
  `token` varchar(126) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `date_created`) VALUES
(2, 'rifqiramdhani8@gmail.com', 'sEUXBNxWuXm5lBCuoVlxiJda0E1mu6tPxvM3MyyrR58=', 1561391145),
(3, 'ramdhanrifqi8@gmail.com', 'l8im+UlP8mYHWBmKbrlRLhwlbEri3qTbyVgpqDjAAO8=', 1561391595),
(4, 'admin@gmail.com', 'feb4pDbqpesyfxMb0oOANH7HNnm7tSit7cYlnSDGW68=', 1561617859),
(5, 'Kinanti@gmail.com', 'SM5UJrgAeL+WKPWqiZdPBsKC8kCwDDpgEdLUQaoLLPs=', 1563283029),
(6, 'kinantrimutiara@gmail.com', 'NNepFuV7s83hQaw9U+00CNr0BCX5R7lVKGZsSh4PZ/Y=', 1563283111);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `custom_destinasi`
--
ALTER TABLE `custom_destinasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `destinasi`
--
ALTER TABLE `destinasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `item_custom_destinasi`
--
ALTER TABLE `item_custom_destinasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign_paket_wisata_custom` (`paket_wisata_id`),
  ADD KEY `foreign_custom_destinasi` (`custom_destinasi_id`);

--
-- Indeks untuk tabel `item_destinasi`
--
ALTER TABLE `item_destinasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign_destinasi` (`destinasi_id`),
  ADD KEY `foreign_paket_wisata` (`paket_wisata_id`);

--
-- Indeks untuk tabel `item_fasilitas`
--
ALTER TABLE `item_fasilitas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign_fasilitas` (`fasilitas_id`),
  ADD KEY `foreign_paket` (`paket_wisata_id`);

--
-- Indeks untuk tabel `item_thumbnail`
--
ALTER TABLE `item_thumbnail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign_thumbnail` (`thumbnail_id`),
  ADD KEY `foreign_paket_wisata_id` (`paket_wisata_id`);

--
-- Indeks untuk tabel `paket_wisata`
--
ALTER TABLE `paket_wisata`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_pemesanan` (`kode_pemesanan`),
  ADD KEY `foreignkey_paket` (`paket_wisata_id`),
  ADD KEY `foreign_pelanggan` (`pelanggan_id`);

--
-- Indeks untuk tabel `proses_pembatalan`
--
ALTER TABLE `proses_pembatalan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign_pemesanan` (`pemesanan_id`);

--
-- Indeks untuk tabel `proses_pembayaran`
--
ALTER TABLE `proses_pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign_pemesanan_id` (`pemesanan_id`);

--
-- Indeks untuk tabel `thumbnail`
--
ALTER TABLE `thumbnail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_akses_menu`
--
ALTER TABLE `user_akses_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign_role` (`role_id`),
  ADD KEY `foreign_menu` (`menu_id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `custom_destinasi`
--
ALTER TABLE `custom_destinasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `destinasi`
--
ALTER TABLE `destinasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `item_custom_destinasi`
--
ALTER TABLE `item_custom_destinasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `item_destinasi`
--
ALTER TABLE `item_destinasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `item_fasilitas`
--
ALTER TABLE `item_fasilitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT untuk tabel `item_thumbnail`
--
ALTER TABLE `item_thumbnail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `paket_wisata`
--
ALTER TABLE `paket_wisata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `proses_pembatalan`
--
ALTER TABLE `proses_pembatalan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `proses_pembayaran`
--
ALTER TABLE `proses_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `thumbnail`
--
ALTER TABLE `thumbnail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `user_akses_menu`
--
ALTER TABLE `user_akses_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `item_custom_destinasi`
--
ALTER TABLE `item_custom_destinasi`
  ADD CONSTRAINT `foreign_custom_destinasi` FOREIGN KEY (`custom_destinasi_id`) REFERENCES `custom_destinasi` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `foreign_paket_wisata_custom` FOREIGN KEY (`paket_wisata_id`) REFERENCES `paket_wisata` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `item_destinasi`
--
ALTER TABLE `item_destinasi`
  ADD CONSTRAINT `foreign_destinasi` FOREIGN KEY (`destinasi_id`) REFERENCES `destinasi` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `foreign_paket_wisata` FOREIGN KEY (`paket_wisata_id`) REFERENCES `paket_wisata` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `item_fasilitas`
--
ALTER TABLE `item_fasilitas`
  ADD CONSTRAINT `foreign_fasilitas` FOREIGN KEY (`fasilitas_id`) REFERENCES `fasilitas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `foreign_paket` FOREIGN KEY (`paket_wisata_id`) REFERENCES `paket_wisata` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `item_thumbnail`
--
ALTER TABLE `item_thumbnail`
  ADD CONSTRAINT `foreign_paket_wisata_id` FOREIGN KEY (`paket_wisata_id`) REFERENCES `paket_wisata` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `foreign_thumbnail` FOREIGN KEY (`thumbnail_id`) REFERENCES `thumbnail` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `foreign_pelanggan` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `foreignkey_paket` FOREIGN KEY (`paket_wisata_id`) REFERENCES `paket_wisata` (`id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `proses_pembatalan`
--
ALTER TABLE `proses_pembatalan`
  ADD CONSTRAINT `foreign_pemesanan` FOREIGN KEY (`pemesanan_id`) REFERENCES `pemesanan` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `proses_pembayaran`
--
ALTER TABLE `proses_pembayaran`
  ADD CONSTRAINT `foreign_pemesanan_id` FOREIGN KEY (`pemesanan_id`) REFERENCES `pemesanan` (`id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user_akses_menu`
--
ALTER TABLE `user_akses_menu`
  ADD CONSTRAINT `foreign_menu` FOREIGN KEY (`menu_id`) REFERENCES `user_menu` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `foreign_role` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
