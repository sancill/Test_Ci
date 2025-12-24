-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 23, 2025 at 10:29 PM
-- Server version: 8.0.42
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `isb_marketplace`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `foto_profil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `alamat_user`
--

CREATE TABLE `alamat_user` (
  `id_alamat` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `nama_penerima` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `alamat_lengkap` text,
  `kecamatan` varchar(50) DEFAULT NULL,
  `kabupaten` varchar(50) DEFAULT NULL,
  `provinsi` varchar(50) DEFAULT NULL,
  `kode_pos` varchar(10) DEFAULT NULL,
  `catatan` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `alamat_user`
--

INSERT INTO `alamat_user` (`id_alamat`, `id_user`, `nama_penerima`, `no_hp`, `alamat_lengkap`, `kecamatan`, `kabupaten`, `provinsi`, `kode_pos`, `catatan`) VALUES
(1, 1, 'Sandi', '085758020943', 'Jl. Raya Sudirman No. 45, RT 05/RW 02', 'Kebon Jeruk', 'Jakarta Barat', 'DKI Jakarta', '11530', 'Tolong di depan rumah ya'),
(2, 2, 'Budi Santoso', '081234567890', 'Jl. Gatot Subroto No. 88, Gedung Plaza', 'Kuningan', 'Jakarta Selatan', 'DKI Jakarta', '12950', 'Ambil di lobby gedung');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `id_detail` int NOT NULL,
  `id_pesan` int DEFAULT NULL,
  `id_produk` int DEFAULT NULL,
  `jumlah` int DEFAULT NULL,
  `harga` int DEFAULT NULL,
  `subtotal` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`id_detail`, `id_pesan`, `id_produk`, `jumlah`, `harga`, `subtotal`, `created_at`) VALUES
(1, 1, 20, 2, 4750, 9500, '2025-12-21 10:30:00'),
(2, 2, 20, 4, 4750, 19000, '2025-12-21 14:15:00'),
(3, 5, 23, 1, 10500000, 10500000, '2025-12-23 14:44:02'),
(4, 6, 23, 1, 10500000, 10500000, '2025-12-23 14:59:56');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int NOT NULL,
  `nama_kategori` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi_kategori` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `icon_kategori` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` enum('aktif','tidak_aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'aktif',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `deskripsi_kategori`, `icon_kategori`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Makanan', 'Kategori Makanan menyediakan berbagai pilihan kuliner yang praktis, lezat, dan sesuai dengan kebutuhan mahasiswa maupun masyarakat kampus. Produk dalam kategori ini mencakup makanan siap saji, camilan, hingga minuman yang mendukung aktivitas sehari-hari.\r\n🔹 Isi Kategori\r\n- Makanan Siap Saji: nasi kotak, mie instan, roti, dan lauk praktis.\r\n- Camilan & Snack: keripik, biskuit, cokelat, permen, dan jajanan ringan.\r\n- Minuman: kopi, teh, susu, minuman energi, dan minuman kemasan.\r\n- Makanan Tradisional: jajanan khas daerah yang bisa dinikmati di lingkungan kampus.\r\n🔹 Tujuan Kategori\r\n- Memudahkan pelanggan menemukan kebutuhan makanan sehari-hari dengan cepat.\r\n- Menyediakan pilihan kuliner yang sesuai dengan gaya hidup mahasiswa yang aktif.\r\n- Mendukung suasana kampus dengan makanan yang terjangkau, praktis, dan bervariasi.\r\n', 'uploads/kategori/1765997697_fa71df06a7eda8e9574c.jpg', 'aktif', '2025-12-17 05:44:58', '2025-12-17 18:54:57'),
(2, 'Elektronik', 'Kategori Elektronik berisi berbagai produk teknologi modern yang mendukung aktivitas sehari-hari, belajar, bekerja, maupun hiburan. Di dalamnya tersedia perangkat dengan kualitas terbaik dan fitur terbaru untuk memenuhi kebutuhan mahasiswa, dosen, maupun masyarakat kampus.\r\n🔹 Isi Kategori\r\n- Laptop & Komputer: perangkat untuk produktivitas, desain, coding, dan gaming.\r\n- Smartphone & Tablet: komunikasi, akses informasi, dan aplikasi mobile.\r\n- Aksesoris Elektronik: headphone, smartwatch, charger, dan perangkat pendukung lainnya.\r\n- Perangkat Hiburan: speaker, konsol game, dan gadget multimedia.\r\n🔹 Tujuan Kategori\r\n- Menyediakan produk elektronik yang relevan dengan kebutuhan kampus.\r\n- Memudahkan pelanggan menemukan perangkat teknologi dalam satu kategori khusus.\r\n- Mendukung gaya hidup digital yang praktis, efisien, dan terhubung\r\n', 'uploads/kategori/1765997521_12224437cc7c6e28d481.jpg', 'aktif', '2025-12-17 10:06:45', '2025-12-17 18:52:01');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `id_produk` int DEFAULT NULL,
  `jumlah` int DEFAULT NULL,
  `harga_saat_itu` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int NOT NULL,
  `id_kategori` int NOT NULL,
  `nama_menu` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi_menu` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `status` enum('aktif','tidak_aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'aktif',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `id_kategori`, `nama_menu`, `deskripsi_menu`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Makanan Saji', 'Makanan Siap Saji: nasi kotak, mie instan, roti, dan lauk praktis.\r\n', 'aktif', '2025-12-17 05:46:07', '2025-12-17 18:56:58'),
(3, 2, 'Smartphone', 'komunikasi, akses informasi, dan aplikasi mobile.', 'aktif', '2025-12-17 10:07:23', '2025-12-17 18:56:02');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_payment` int NOT NULL,
  `id_pesan` int DEFAULT NULL,
  `metode` varchar(50) DEFAULT NULL,
  `total_bayar` int DEFAULT NULL,
  `bukti_transfer` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penjual`
--

CREATE TABLE `penjual` (
  `id_penjual` int NOT NULL,
  `nama_toko` varchar(100) DEFAULT NULL,
  `deskripsi` text,
  `foto_toko` varchar(255) DEFAULT NULL,
  `rekening_bank` varchar(50) DEFAULT NULL,
  `id_user` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesan` int NOT NULL,
  `no_pesanan` varchar(50) DEFAULT NULL COMMENT 'Nomor pesanan unik (ORD-001)',
  `id_user` int DEFAULT NULL,
  `id_alamat` int DEFAULT NULL,
  `tanggal_pesan` datetime DEFAULT NULL,
  `tanggal_kirim` datetime DEFAULT NULL COMMENT 'Tanggal pengiriman',
  `tanggal_selesai` datetime DEFAULT NULL COMMENT 'Tanggal selesai',
  `metode_pengiriman` varchar(50) DEFAULT NULL,
  `no_resi` varchar(100) DEFAULT NULL COMMENT 'Nomor resi pengiriman',
  `ongkir` int DEFAULT NULL,
  `total_harga` int DEFAULT NULL,
  `total_bayar` int DEFAULT NULL,
  `id_voucher` int DEFAULT NULL,
  `status_pesanan` enum('Diproses','Dikirim','Selesai','Dibatalkan') DEFAULT 'Diproses',
  `catatan_admin` text COMMENT 'Catatan admin untuk pesanan',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesan`, `no_pesanan`, `id_user`, `id_alamat`, `tanggal_pesan`, `tanggal_kirim`, `tanggal_selesai`, `metode_pengiriman`, `no_resi`, `ongkir`, `total_harga`, `total_bayar`, `id_voucher`, `status_pesanan`, `catatan_admin`, `created_at`, `updated_at`) VALUES
(1, 'ORD-20251221-001', 1, 1, '2025-12-21 10:30:00', NULL, NULL, 'Kurir Kampus', NULL, 15000, 9500, 24500, NULL, 'Diproses', 'Pesanan baru, segera proses', '2025-12-21 10:30:00', '2025-12-21 10:30:00'),
(2, 'ORD-20251221-002', 2, 2, '2025-12-21 14:15:00', '2025-12-21 15:00:00', NULL, 'Kurir Kampus', 'KRS-20251221-001', 20000, 19000, 39000, NULL, 'Diproses', 'Pesanan sudah dikirim hari ini', '2025-12-21 14:15:00', '2025-12-21 16:48:15'),
(5, 'ORD-20251223-1811', 1, 1, '2025-12-23 07:44:02', NULL, NULL, 'Antar Sekarang', NULL, 15000, 10500000, 10516000, NULL, 'Diproses', NULL, '2025-12-23 07:44:02', '2025-12-23 07:44:02'),
(6, 'ORD-20251223-2555', 1, 1, '2025-12-23 07:59:56', NULL, NULL, 'Antar Sekarang', NULL, 15000, 10500000, 10516000, NULL, 'Diproses', NULL, '2025-12-23 07:59:56', '2025-12-23 07:59:56');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_status_log`
--

CREATE TABLE `pesanan_status_log` (
  `id_log` int NOT NULL,
  `id_pesan` int NOT NULL,
  `status_sebelumnya` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status_baru` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `dibuat_oleh` int DEFAULT NULL COMMENT 'ID admin yang mengubah status',
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Keterangan perubahan status',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int NOT NULL,
  `id_toko` int DEFAULT NULL,
  `nama_produk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi_produk` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `gambar_produk` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'JSON array of image paths: ["path1.jpg", "path2.jpg"]',
  `id_kategori` int DEFAULT NULL,
  `id_menu` int DEFAULT NULL,
  `merek` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `harga_awal` decimal(15,2) NOT NULL DEFAULT '0.00',
  `harga_diskon` decimal(15,2) DEFAULT '0.00',
  `tipe_diskon` enum('persentase','nominal') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'persentase',
  `id_promo` int DEFAULT NULL,
  `harga_setelah_diskon` decimal(15,2) DEFAULT '0.00',
  `stok` int NOT NULL DEFAULT '0',
  `sku` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `berat` int DEFAULT '0' COMMENT 'Berat dalam gram',
  `status_produk` enum('aktif','tidak_aktif','draft') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'draft',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_toko`, `nama_produk`, `deskripsi_produk`, `gambar_produk`, `id_kategori`, `id_menu`, `merek`, `harga_awal`, `harga_diskon`, `tipe_diskon`, `id_promo`, `harga_setelah_diskon`, `stok`, `sku`, `berat`, `status_produk`, `created_at`, `updated_at`) VALUES
(20, 1, 'Indomie pack', 'selerakuu', '[\"uploads\\/produk\\/1765969793_788a7469deb3da6ee246.jpg\"]', 1, 1, 'Indofood', '5000.00', '5.00', 'persentase', NULL, '4750.00', 10, 'SKU-001', 5, 'aktif', '2025-12-17 11:09:53', '2025-12-21 15:17:09'),
(21, 1, 'Xiaomi 15 Pro', '📱 Xiaomi 15 Pro\r\nDeskripsi Produk: Xiaomi 15 Pro hadir dengan desain premium dan performa kelas flagship. Dilengkapi layar AMOLED beresolusi tinggi dengan refresh rate 120Hz, memberikan pengalaman visual yang jernih dan mulus. Didukung prosesor terbaru Snapdragon, RAM besar, serta kapasitas penyimpanan luas, membuat multitasking dan gaming berjalan tanpa hambatan. Kamera AI canggih dengan sensor utama resolusi tinggi menghasilkan foto tajam dan detail, bahkan dalam kondisi minim cahaya. Baterai tahan lama dengan fast charging memastikan aktivitas harian tetap lancar. Cocok untuk mahasiswa, profesional, maupun pecinta teknologi yang menginginkan smartphone modern dengan fitur lengkap\r\n', 'uploads/produk/1765998169_dd18dc014ecfef42e5c1.jpg', 2, 3, 'Xiaomi', '12999000.00', '30.00', 'persentase', 1, '9099300.00', 10, 'Hp-001', 300, 'aktif', '2025-12-17 19:02:49', '2025-12-17 19:02:49'),
(23, 1, 'ASUS ZENBOOK 14 OLED', 'ASUS Zenbook 14 OLED\r\nThe Lightest 14” AI OLED Laptop with All-Day Battery Life\r\nTingkatkan pengalaman Anda dengan Zenbook 14 OLED ultraportable yang tipis dan canggih. Desainnya yang tipis dan ringan menampung kekuatan prosesor AMD Ryzen™ 8040 Series terbaru berkemampuan AI, yang membuat peralatan AI terbang, bersama dengan grafis AMD Radeon™. Baterai yang tahan lama memastikan daya sepanjang hari, dan terdapat port I/O lengkap untuk konektivitas yang ditingkatkan. Engsel 180°-nya memungkinkan berbagi dengan mudah, dan Anda dapat menyelami dunia kenikmatan indra dengan layar ASUS Lumina OLED1 yang dinamis dan speaker super-linear mutakhir, sekaligus menggunakan desain ramah lingkungan yang memancarkan keanggunan ramah lingkungan.', '[\"uploads\\/produk\\/1766327165_71cc38dadb952d449188.svg\",\"uploads\\/produk\\/1766327165_3c7c8ed3b21c652038d8.svg\",\"uploads\\/produk\\/1766327165_4093463d676ea47ce882.svg\",\"uploads\\/produk\\/1766327165_2fa1d57138e07a57db07.svg\"]', 2, 3, 'ASUS', '15000000.00', '30.00', 'persentase', 1, '10500000.00', 3, 'LP-001', 600, 'aktif', '2025-12-21 14:26:05', '2025-12-23 07:59:56'),
(24, 1, 'ddw', 'wqdwd', '[\"uploads\\/produk\\/1766451865_028d9f2282dc5ed0b4cc.webp\",\"uploads\\/produk\\/1766451865_e15212aae960a276ea67.webp\",\"uploads\\/produk\\/1766451865_6973f864325531435f10.jpg\"]', 2, 3, 'Xiaomi', '10000.00', '30.00', 'persentase', 1, '7000.00', 20, 'SKU-004', 20, 'aktif', '2025-12-23 01:04:25', '2025-12-23 01:04:25');

-- --------------------------------------------------------

--
-- Table structure for table `produk_varian`
--

CREATE TABLE `produk_varian` (
  `id_varian` int NOT NULL,
  `id_produk` int NOT NULL,
  `nama_varian` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Nama varian (contoh: Warna, Ukuran)',
  `nilai_varian` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Nilai varian (contoh: Merah, XL)',
  `harga_tambahan` decimal(15,2) DEFAULT '0.00' COMMENT 'Harga tambahan untuk varian ini',
  `stok_varian` int DEFAULT '0' COMMENT 'Stok untuk varian ini',
  `sku_varian` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'SKU khusus untuk varian',
  `gambar_varian` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'JSON array of image paths for this variant: ["path1.jpg", "path2.jpg"]',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk_varian`
--

INSERT INTO `produk_varian` (`id_varian`, `id_produk`, `nama_varian`, `nilai_varian`, `harga_tambahan`, `stok_varian`, `sku_varian`, `gambar_varian`, `created_at`, `updated_at`) VALUES
(3, 23, '16 GB RAM / 512 GB SSD', 'Hitam', '100000.00', 5, NULL, '[\"uploads\\/produk\\/1766327165_229c3e276e011c0aad9a.png\"]', '2025-12-21 14:26:05', '2025-12-21 14:26:05'),
(4, 23, '32 GB RAM / 1 TB SSD', 'Putih', '120000.00', 5, NULL, '[\"uploads\\/produk\\/1766327165_4cf353a0dca31b7a751a.jpg\"]', '2025-12-21 14:26:05', '2025-12-21 14:26:05'),
(5, 20, 'Mie Rasa Dendeng Balado', '1 Bungkus', '5000.00', 10, NULL, '[\"uploads\\/produk\\/1766330229_08a512fc7a29414a7fa4.webp\"]', '2025-12-21 15:17:09', '2025-12-21 15:17:09'),
(6, 20, 'Mie Rasa Soto Lamongan', '1 Bungkus', '5000.00', 10, NULL, '[\"uploads\\/produk\\/1766330229_2b8ee4fd41ac87787bd7.webp\"]', '2025-12-21 15:17:09', '2025-12-21 15:17:09');

-- --------------------------------------------------------

--
-- Table structure for table `promo`
--

CREATE TABLE `promo` (
  `id_promo` int NOT NULL,
  `id_toko` int DEFAULT NULL,
  `nama_promo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tipe_promo` enum('flash_sale','diskon_bundling','voucher') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'flash_sale',
  `tipe_diskon` enum('persentase','nominal') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'persentase',
  `target_tipe` enum('produk','kategori','menu') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'produk' COMMENT 'Tipe target promo',
  `target_kategori` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'JSON array of kategori IDs',
  `target_menu` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'JSON array of menu IDs',
  `nilai_diskon` decimal(10,2) NOT NULL,
  `tanggal_mulai` datetime NOT NULL,
  `tanggal_berakhir` datetime NOT NULL,
  `target_produk` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'JSON array of product IDs',
  `deskripsi_promo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Deskripsi dan syarat ketentuan promo',
  `limit_stok` int DEFAULT NULL COMMENT 'Limitasi stok promo (NULL = tidak ada limit)',
  `stok_terpakai` int DEFAULT '0' COMMENT 'Stok promo yang sudah terpakai',
  `total_penjualan` decimal(15,2) DEFAULT '0.00' COMMENT 'Total penjualan dari promo',
  `total_pesanan` int DEFAULT '0' COMMENT 'Total pesanan dari promo',
  `kode_voucher` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Kode voucher untuk tipe voucher',
  `status` enum('aktif','tidak_aktif','selesai') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'aktif',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `promo`
--

INSERT INTO `promo` (`id_promo`, `id_toko`, `nama_promo`, `tipe_promo`, `tipe_diskon`, `target_tipe`, `target_kategori`, `target_menu`, `nilai_diskon`, `tanggal_mulai`, `tanggal_berakhir`, `target_produk`, `deskripsi_promo`, `limit_stok`, `stok_terpakai`, `total_penjualan`, `total_pesanan`, `kode_voucher`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '12.12 Sale', 'flash_sale', 'persentase', 'menu', NULL, '[\"3\",\"1\"]', '30.00', '2025-12-12 00:00:00', '2025-12-31 01:00:00', NULL, 'shb gxgwd vydgy', NULL, 0, '0.00', 0, NULL, 'aktif', '2025-12-17 18:45:50', '2025-12-17 18:45:50');

-- --------------------------------------------------------

--
-- Table structure for table `promo_riwayat`
--

CREATE TABLE `promo_riwayat` (
  `id_riwayat` int NOT NULL,
  `id_promo` int NOT NULL,
  `tanggal` date NOT NULL,
  `total_penjualan` decimal(15,2) DEFAULT '0.00',
  `total_pesanan` int DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `toko`
--

CREATE TABLE `toko` (
  `id_toko` int NOT NULL,
  `nama_toko` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status_toko` enum('verified_seller','official_store') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'verified_seller',
  `logo_toko` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `banner_toko` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `deskripsi_toko` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `alamat_toko` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `kota` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `provinsi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kode_pos` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `negara` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Indonesia',
  `email_cs` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `whatsapp_cs` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jam_operasional_buka` time DEFAULT NULL,
  `jam_operasional_tutup` time DEFAULT NULL,
  `nama_admin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `username_admin` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email_admin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telepon_admin` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `rating` decimal(3,1) DEFAULT '0.0',
  `total_ulasan` int DEFAULT '0',
  `total_produk` int DEFAULT '0',
  `total_pengikut` int DEFAULT '0',
  `total_penjualan` int DEFAULT '0',
  `pendapatan` decimal(15,2) DEFAULT '0.00',
  `email_verified` tinyint(1) DEFAULT '0',
  `telepon_verified` tinyint(1) DEFAULT '0',
  `identitas_verified` tinyint(1) DEFAULT '0',
  `tanggal_bergabung` date DEFAULT NULL,
  `login_terakhir` datetime DEFAULT NULL,
  `status_akun` enum('aktif','nonaktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'aktif',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `toko`
--

INSERT INTO `toko` (`id_toko`, `nama_toko`, `status_toko`, `logo_toko`, `banner_toko`, `deskripsi_toko`, `alamat_toko`, `kota`, `provinsi`, `kode_pos`, `negara`, `email_cs`, `whatsapp_cs`, `jam_operasional_buka`, `jam_operasional_tutup`, `nama_admin`, `username_admin`, `email_admin`, `telepon_admin`, `rating`, `total_ulasan`, `total_produk`, `total_pengikut`, `total_penjualan`, `pendapatan`, `email_verified`, `telepon_verified`, `identitas_verified`, `tanggal_bergabung`, `login_terakhir`, `status_akun`, `created_at`, `updated_at`) VALUES
(1, 'HIMAGICELL', 'verified_seller', 'uploads/toko/1766321162_d17760452190e1be7c10.png', 'uploads/toko/1765962702_689876f0d3fb92ccb67d.png', 'ISBCOMMERCE adalah marketplace terpercaya yang menyediakan berbagai produk elektronik, fashion, dan kebutuhan sehari-hari dengan kualitas terbaik dan harga terjangkau. Kami berkomitmen memberikan pelayanan terbaik untuk kepuasan pelanggan.', 'Jl. Jenderal Sudirman No. 123, Jakarta Pusat, DKI Jakarta 10220', 'Jakarta Pusat', 'DKI Jakarta', '10220', 'Indonesia', 'cs@isbcommerce.com', '+6281234567890', '09:00:00', '17:00:00', 'Muhammad IskandarD', '@admin_isb', 'admin@isbcommerce.com', '+62 812-3456-7890', '0.0', 0, 0, 0, 0, '0.00', 0, 0, 0, '2025-12-16', NULL, 'aktif', '2025-12-16 16:42:59', '2025-12-21 16:32:13');

-- --------------------------------------------------------

--
-- Table structure for table `ulasan_produk`
--

CREATE TABLE `ulasan_produk` (
  `id_ulasan` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `id_produk` int DEFAULT NULL,
  `rating` int DEFAULT NULL,
  `komentar` text,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `nama_user` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `no_telepon` varchar(20) DEFAULT NULL,
  `foto_user` varchar(255) DEFAULT NULL,
  `google_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `username`, `email`, `password`, `no_telepon`, `foto_user`, `google_id`) VALUES
(1, 'Sandi', 'Sandi', 'Sandi@gmail.com', '12345', '085758020943', NULL, 0),
(2, 'Budi Santoso', 'budisantoso', 'budi.santoso@email.com', 'password123', '081234567890', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `id_voucher` int NOT NULL,
  `kode` varchar(20) DEFAULT NULL,
  `persentase` int DEFAULT NULL,
  `max_potongan` int DEFAULT NULL,
  `min_belanja` int DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_akhir` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `alamat_user`
--
ALTER TABLE `alamat_user`
  ADD PRIMARY KEY (`id_alamat`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `idx_pesan` (`id_pesan`),
  ADD KEY `idx_produk` (`id_produk`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`),
  ADD KEY `idx_status` (`status`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`),
  ADD KEY `idx_kategori` (`id_kategori`),
  ADD KEY `idx_status` (`status`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_payment`),
  ADD KEY `id_pesan` (`id_pesan`);

--
-- Indexes for table `penjual`
--
ALTER TABLE `penjual`
  ADD PRIMARY KEY (`id_penjual`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesan`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_alamat` (`id_alamat`),
  ADD KEY `id_voucher` (`id_voucher`),
  ADD KEY `idx_status` (`status_pesanan`),
  ADD KEY `idx_no_pesanan` (`no_pesanan`),
  ADD KEY `idx_tanggal` (`tanggal_pesan`);

--
-- Indexes for table `pesanan_status_log`
--
ALTER TABLE `pesanan_status_log`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `idx_pesan` (`id_pesan`),
  ADD KEY `idx_tanggal` (`created_at`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `idx_kategori` (`id_kategori`),
  ADD KEY `idx_menu` (`id_menu`),
  ADD KEY `idx_toko` (`id_toko`),
  ADD KEY `idx_status` (`status_produk`),
  ADD KEY `idx_sku` (`sku`);

--
-- Indexes for table `produk_varian`
--
ALTER TABLE `produk_varian`
  ADD PRIMARY KEY (`id_varian`),
  ADD KEY `idx_produk` (`id_produk`);

--
-- Indexes for table `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`id_promo`),
  ADD KEY `idx_toko` (`id_toko`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_tanggal` (`tanggal_mulai`,`tanggal_berakhir`),
  ADD KEY `idx_tipe_promo` (`tipe_promo`),
  ADD KEY `idx_status_promo` (`status`),
  ADD KEY `idx_tanggal_promo` (`tanggal_mulai`,`tanggal_berakhir`);

--
-- Indexes for table `promo_riwayat`
--
ALTER TABLE `promo_riwayat`
  ADD PRIMARY KEY (`id_riwayat`),
  ADD KEY `idx_promo` (`id_promo`),
  ADD KEY `idx_tanggal` (`tanggal`);

--
-- Indexes for table `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id_toko`);

--
-- Indexes for table `ulasan_produk`
--
ALTER TABLE `ulasan_produk`
  ADD PRIMARY KEY (`id_ulasan`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`id_voucher`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `alamat_user`
--
ALTER TABLE `alamat_user`
  MODIFY `id_alamat` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  MODIFY `id_detail` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_payment` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penjual`
--
ALTER TABLE `penjual`
  MODIFY `id_penjual` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pesanan_status_log`
--
ALTER TABLE `pesanan_status_log`
  MODIFY `id_log` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `produk_varian`
--
ALTER TABLE `produk_varian`
  MODIFY `id_varian` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `promo`
--
ALTER TABLE `promo`
  MODIFY `id_promo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `promo_riwayat`
--
ALTER TABLE `promo_riwayat`
  MODIFY `id_riwayat` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `toko`
--
ALTER TABLE `toko`
  MODIFY `id_toko` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ulasan_produk`
--
ALTER TABLE `ulasan_produk`
  MODIFY `id_ulasan` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `id_voucher` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alamat_user`
--
ALTER TABLE `alamat_user`
  ADD CONSTRAINT `alamat_user_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD CONSTRAINT `detail_pesanan_ibfk_1` FOREIGN KEY (`id_pesan`) REFERENCES `pesanan` (`id_pesan`),
  ADD CONSTRAINT `detail_pesanan_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Constraints for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `keranjang_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `fk_menu_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_pesan`) REFERENCES `pesanan` (`id_pesan`);

--
-- Constraints for table `penjual`
--
ALTER TABLE `penjual`
  ADD CONSTRAINT `penjual_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `pesanan_ibfk_2` FOREIGN KEY (`id_alamat`) REFERENCES `alamat_user` (`id_alamat`),
  ADD CONSTRAINT `pesanan_ibfk_3` FOREIGN KEY (`id_voucher`) REFERENCES `voucher` (`id_voucher`);

--
-- Constraints for table `pesanan_status_log`
--
ALTER TABLE `pesanan_status_log`
  ADD CONSTRAINT `fk_log_pesanan` FOREIGN KEY (`id_pesan`) REFERENCES `pesanan` (`id_pesan`) ON DELETE CASCADE;

--
-- Constraints for table `produk_varian`
--
ALTER TABLE `produk_varian`
  ADD CONSTRAINT `fk_produk_varian_produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE;

--
-- Constraints for table `promo_riwayat`
--
ALTER TABLE `promo_riwayat`
  ADD CONSTRAINT `fk_riwayat_promo` FOREIGN KEY (`id_promo`) REFERENCES `promo` (`id_promo`) ON DELETE CASCADE;

--
-- Constraints for table `ulasan_produk`
--
ALTER TABLE `ulasan_produk`
  ADD CONSTRAINT `ulasan_produk_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `ulasan_produk_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
