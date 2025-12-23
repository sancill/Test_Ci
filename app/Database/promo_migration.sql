-- Migration untuk tabel promo - Update untuk support target kategori dan menu
-- Database: isb_marketplace
-- IMPORTANT: Jalankan query ini satu per satu untuk menghindari error jika kolom sudah ada

-- 1. Update tabel promo - tambahkan kolom untuk target kategori dan menu
-- Skip jika kolom sudah ada (cek manual di phpMyAdmin)

-- Tambahkan kolom target_tipe
ALTER TABLE `promo` 
ADD COLUMN `target_tipe` ENUM('produk', 'kategori', 'menu') DEFAULT 'produk' COMMENT 'Tipe target promo' AFTER `tipe_diskon`;

-- Tambahkan kolom target_kategori
ALTER TABLE `promo` 
ADD COLUMN `target_kategori` TEXT NULL DEFAULT NULL COMMENT 'JSON array of kategori IDs' AFTER `target_tipe`;

-- Tambahkan kolom target_menu
ALTER TABLE `promo` 
ADD COLUMN `target_menu` TEXT NULL DEFAULT NULL COMMENT 'JSON array of menu IDs' AFTER `target_kategori`;

-- Tambahkan kolom deskripsi_promo
ALTER TABLE `promo` 
ADD COLUMN `deskripsi_promo` TEXT NULL DEFAULT NULL COMMENT 'Deskripsi dan syarat ketentuan promo' AFTER `target_produk`;

-- Tambahkan kolom limit_stok
ALTER TABLE `promo` 
ADD COLUMN `limit_stok` INT NULL DEFAULT NULL COMMENT 'Limitasi stok promo (NULL = tidak ada limit)' AFTER `deskripsi_promo`;

-- Tambahkan kolom stok_terpakai
ALTER TABLE `promo` 
ADD COLUMN `stok_terpakai` INT DEFAULT 0 COMMENT 'Stok promo yang sudah terpakai' AFTER `limit_stok`;

-- Tambahkan kolom kode_voucher
ALTER TABLE `promo` 
ADD COLUMN `kode_voucher` VARCHAR(50) NULL DEFAULT NULL COMMENT 'Kode voucher untuk tipe voucher' AFTER `stok_terpakai`;

-- Tambahkan kolom total_penjualan
ALTER TABLE `promo` 
ADD COLUMN `total_penjualan` DECIMAL(15,2) DEFAULT 0.00 COMMENT 'Total penjualan dari promo' AFTER `stok_terpakai`;

-- Tambahkan kolom total_pesanan
ALTER TABLE `promo` 
ADD COLUMN `total_pesanan` INT DEFAULT 0 COMMENT 'Total pesanan dari promo' AFTER `total_penjualan`;

-- 2. Update index untuk performa query (skip jika sudah ada)
ALTER TABLE `promo` ADD INDEX `idx_tipe_promo` (`tipe_promo`);
ALTER TABLE `promo` ADD INDEX `idx_status_promo` (`status`);
ALTER TABLE `promo` ADD INDEX `idx_tanggal_promo` (`tanggal_mulai`, `tanggal_berakhir`);

-- 3. Buat tabel riwayat promo untuk analisis (opsional)
CREATE TABLE IF NOT EXISTS `promo_riwayat` (
  `id_riwayat` INT(11) NOT NULL AUTO_INCREMENT,
  `id_promo` INT(11) NOT NULL,
  `tanggal` DATE NOT NULL,
  `total_penjualan` DECIMAL(15,2) DEFAULT 0.00,
  `total_pesanan` INT DEFAULT 0,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_riwayat`),
  KEY `idx_promo` (`id_promo`),
  KEY `idx_tanggal` (`tanggal`),
  CONSTRAINT `fk_riwayat_promo` FOREIGN KEY (`id_promo`) REFERENCES `promo` (`id_promo`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

