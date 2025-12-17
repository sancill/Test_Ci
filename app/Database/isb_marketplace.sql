-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 17 Des 2025 pada 09.16
-- Versi server: 8.0.30
-- Versi PHP: 8.1.10

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
-- Struktur dari tabel `admin`
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
-- Struktur dari tabel `alamat_user`
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `id_detail` int NOT NULL,
  `id_pesan` int DEFAULT NULL,
  `id_produk` int DEFAULT NULL,
  `jumlah` int DEFAULT NULL,
  `harga` int DEFAULT NULL,
  `subtotal` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int NOT NULL,
  `nama_kategori` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi_kategori` text COLLATE utf8mb4_general_ci,
  `icon_kategori` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` enum('aktif','tidak_aktif') COLLATE utf8mb4_general_ci DEFAULT 'aktif',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `deskripsi_kategori`, `icon_kategori`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Makanan', 'Makanan yang fresh dan terjamin baru dikirim dari pusat', 'uploads/kategori/1765950298_12ff773d6ae945158311.jpg', 'aktif', '2025-12-17 05:44:58', '2025-12-17 05:44:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
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
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id_menu` int NOT NULL,
  `id_kategori` int NOT NULL,
  `nama_menu` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi_menu` text COLLATE utf8mb4_general_ci,
  `status` enum('aktif','tidak_aktif') COLLATE utf8mb4_general_ci DEFAULT 'aktif',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id_menu`, `id_kategori`, `nama_menu`, `deskripsi_menu`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Indomie', 'Makanan pemersatu bangsa', 'aktif', '2025-12-17 05:46:07', '2025-12-17 05:46:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
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
-- Struktur dari tabel `penjual`
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
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesan` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `id_alamat` int DEFAULT NULL,
  `tanggal_pesan` datetime DEFAULT NULL,
  `metode_pengiriman` varchar(50) DEFAULT NULL,
  `ongkir` int DEFAULT NULL,
  `total_harga` int DEFAULT NULL,
  `total_bayar` int DEFAULT NULL,
  `id_voucher` int DEFAULT NULL,
  `status_pesanan` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int NOT NULL,
  `id_toko` int DEFAULT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi_produk` text COLLATE utf8mb4_general_ci,
  `id_kategori` int DEFAULT NULL,
  `id_menu` int DEFAULT NULL,
  `merek` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `harga_awal` decimal(15,2) NOT NULL DEFAULT '0.00',
  `harga_diskon` decimal(15,2) DEFAULT '0.00',
  `tipe_diskon` enum('persentase','nominal') COLLATE utf8mb4_general_ci DEFAULT 'persentase',
  `id_promo` int DEFAULT NULL,
  `harga_setelah_diskon` decimal(15,2) DEFAULT '0.00',
  `stok` int NOT NULL DEFAULT '0',
  `sku` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `berat` int DEFAULT '0' COMMENT 'Berat dalam gram',
  `status_produk` enum('aktif','tidak_aktif','draft') COLLATE utf8mb4_general_ci DEFAULT 'draft',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk_foto`
--

CREATE TABLE `produk_foto` (
  `id_foto` int NOT NULL,
  `id_produk` int NOT NULL,
  `foto_produk` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `urutan` int DEFAULT '1',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `promo`
--

CREATE TABLE `promo` (
  `id_promo` int NOT NULL,
  `id_toko` int DEFAULT NULL,
  `nama_promo` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `tipe_promo` enum('flash_sale','diskon_bundling','voucher') COLLATE utf8mb4_general_ci DEFAULT 'flash_sale',
  `tipe_diskon` enum('persentase','nominal') COLLATE utf8mb4_general_ci DEFAULT 'persentase',
  `nilai_diskon` decimal(10,2) NOT NULL,
  `tanggal_mulai` datetime NOT NULL,
  `tanggal_berakhir` datetime NOT NULL,
  `target_produk` text COLLATE utf8mb4_general_ci COMMENT 'JSON array of product IDs',
  `status` enum('aktif','tidak_aktif','selesai') COLLATE utf8mb4_general_ci DEFAULT 'aktif',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `toko`
--

CREATE TABLE `toko` (
  `id_toko` int NOT NULL,
  `nama_toko` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status_toko` enum('verified_seller','official_store') COLLATE utf8mb4_general_ci DEFAULT 'verified_seller',
  `logo_toko` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `banner_toko` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `deskripsi_toko` text COLLATE utf8mb4_general_ci,
  `alamat_toko` text COLLATE utf8mb4_general_ci,
  `kota` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `provinsi` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kode_pos` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `negara` varchar(100) COLLATE utf8mb4_general_ci DEFAULT 'Indonesia',
  `email_cs` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `whatsapp_cs` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jam_operasional_buka` time DEFAULT NULL,
  `jam_operasional_tutup` time DEFAULT NULL,
  `nama_admin` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `username_admin` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email_admin` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telepon_admin` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
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
  `status_akun` enum('aktif','nonaktif') COLLATE utf8mb4_general_ci DEFAULT 'aktif',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `toko`
--

INSERT INTO `toko` (`id_toko`, `nama_toko`, `status_toko`, `logo_toko`, `banner_toko`, `deskripsi_toko`, `alamat_toko`, `kota`, `provinsi`, `kode_pos`, `negara`, `email_cs`, `whatsapp_cs`, `jam_operasional_buka`, `jam_operasional_tutup`, `nama_admin`, `username_admin`, `email_admin`, `telepon_admin`, `rating`, `total_ulasan`, `total_produk`, `total_pengikut`, `total_penjualan`, `pendapatan`, `email_verified`, `telepon_verified`, `identitas_verified`, `tanggal_bergabung`, `login_terakhir`, `status_akun`, `created_at`, `updated_at`) VALUES
(1, 'HIMAGICELL', 'official_store', 'uploads/toko/1765962349_f060b38a45306e498003.png', 'uploads/toko/1765962702_689876f0d3fb92ccb67d.png', 'ISBCOMMERCE adalah marketplace terpercaya yang menyediakan berbagai produk elektronik, fashion, dan kebutuhan sehari-hari dengan kualitas terbaik dan harga terjangkau. Kami berkomitmen memberikan pelayanan terbaik untuk kepuasan pelanggan.', 'Jl. Jenderal Sudirman No. 123, Jakarta Pusat, DKI Jakarta 10220', 'Jakarta Pusat', 'DKI Jakarta', '10220', 'Indonesia', 'cs@isbcommerce.com', '+6281234567890', '09:00:00', '17:00:00', 'Muhammad IskandarD', '@admin_isb', 'admin@isbcommerce.com', '+62 812-3456-7890', 0.0, 0, 0, 0, 0, 0.00, 0, 0, 0, '2025-12-16', NULL, 'aktif', '2025-12-16 16:42:59', '2025-12-17 09:11:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ulasan_produk`
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
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `nama_user` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `no_telepon` varchar(20) DEFAULT NULL,
  `foto_user` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `username`, `email`, `password`, `no_telepon`, `foto_user`) VALUES
(1, 'Sandi', 'Sandi', 'Sandi@gmail.com', '12345', '085758020943', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `voucher`
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
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `alamat_user`
--
ALTER TABLE `alamat_user`
  ADD PRIMARY KEY (`id_alamat`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_pesan` (`id_pesan`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`),
  ADD KEY `idx_status` (`status`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`),
  ADD KEY `idx_kategori` (`id_kategori`),
  ADD KEY `idx_status` (`status`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_payment`),
  ADD KEY `id_pesan` (`id_pesan`);

--
-- Indeks untuk tabel `penjual`
--
ALTER TABLE `penjual`
  ADD PRIMARY KEY (`id_penjual`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesan`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_alamat` (`id_alamat`),
  ADD KEY `id_voucher` (`id_voucher`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `idx_kategori` (`id_kategori`),
  ADD KEY `idx_menu` (`id_menu`),
  ADD KEY `idx_toko` (`id_toko`),
  ADD KEY `idx_status` (`status_produk`),
  ADD KEY `idx_sku` (`sku`);

--
-- Indeks untuk tabel `produk_foto`
--
ALTER TABLE `produk_foto`
  ADD PRIMARY KEY (`id_foto`),
  ADD KEY `idx_produk` (`id_produk`);

--
-- Indeks untuk tabel `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`id_promo`),
  ADD KEY `idx_toko` (`id_toko`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_tanggal` (`tanggal_mulai`,`tanggal_berakhir`);

--
-- Indeks untuk tabel `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id_toko`);

--
-- Indeks untuk tabel `ulasan_produk`
--
ALTER TABLE `ulasan_produk`
  ADD PRIMARY KEY (`id_ulasan`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`id_voucher`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `alamat_user`
--
ALTER TABLE `alamat_user`
  MODIFY `id_alamat` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  MODIFY `id_detail` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_payment` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `penjual`
--
ALTER TABLE `penjual`
  MODIFY `id_penjual` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesan` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `produk_foto`
--
ALTER TABLE `produk_foto`
  MODIFY `id_foto` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `promo`
--
ALTER TABLE `promo`
  MODIFY `id_promo` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `toko`
--
ALTER TABLE `toko`
  MODIFY `id_toko` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `ulasan_produk`
--
ALTER TABLE `ulasan_produk`
  MODIFY `id_ulasan` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `voucher`
--
ALTER TABLE `voucher`
  MODIFY `id_voucher` int NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `alamat_user`
--
ALTER TABLE `alamat_user`
  ADD CONSTRAINT `alamat_user_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD CONSTRAINT `detail_pesanan_ibfk_1` FOREIGN KEY (`id_pesan`) REFERENCES `pesanan` (`id_pesan`),
  ADD CONSTRAINT `detail_pesanan_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Ketidakleluasaan untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `keranjang_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Ketidakleluasaan untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `fk_menu_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_pesan`) REFERENCES `pesanan` (`id_pesan`);

--
-- Ketidakleluasaan untuk tabel `penjual`
--
ALTER TABLE `penjual`
  ADD CONSTRAINT `penjual_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `pesanan_ibfk_2` FOREIGN KEY (`id_alamat`) REFERENCES `alamat_user` (`id_alamat`),
  ADD CONSTRAINT `pesanan_ibfk_3` FOREIGN KEY (`id_voucher`) REFERENCES `voucher` (`id_voucher`);

--
-- Ketidakleluasaan untuk tabel `produk_foto`
--
ALTER TABLE `produk_foto`
  ADD CONSTRAINT `fk_produk_foto_produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ulasan_produk`
--
ALTER TABLE `ulasan_produk`
  ADD CONSTRAINT `ulasan_produk_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `ulasan_produk_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
