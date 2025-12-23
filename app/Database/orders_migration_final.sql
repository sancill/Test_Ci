-- Migration untuk tabel pesanan dan fitur Orders Management
-- Database: isb_marketplace
-- IMPORTANT: Jalankan query ini satu per satu untuk menghindari error jika kolom sudah ada

-- 1. Update kolom status_pesanan menjadi ENUM (jalankan ini dulu)
-- Jika error "Duplicate column name" atau "Unknown column", skip query ini
ALTER TABLE `pesanan` 
MODIFY COLUMN `status_pesanan` ENUM('Diproses', 'Dikirim', 'Selesai', 'Dibatalkan') DEFAULT 'Diproses';

-- 2. Tambahkan kolom no_pesanan (skip jika sudah ada)
ALTER TABLE `pesanan` 
ADD COLUMN `no_pesanan` VARCHAR(50) NULL DEFAULT NULL COMMENT 'Nomor pesanan unik (ORD-001)' AFTER `id_pesan`;

-- 3. Tambahkan kolom catatan_admin (skip jika sudah ada)
ALTER TABLE `pesanan` 
ADD COLUMN `catatan_admin` TEXT NULL DEFAULT NULL COMMENT 'Catatan admin untuk pesanan' AFTER `status_pesanan`;

-- 4. Tambahkan kolom tanggal_kirim (skip jika sudah ada)
ALTER TABLE `pesanan` 
ADD COLUMN `tanggal_kirim` DATETIME NULL DEFAULT NULL COMMENT 'Tanggal pengiriman' AFTER `tanggal_pesan`;

-- 5. Tambahkan kolom tanggal_selesai (skip jika sudah ada)
ALTER TABLE `pesanan` 
ADD COLUMN `tanggal_selesai` DATETIME NULL DEFAULT NULL COMMENT 'Tanggal selesai' AFTER `tanggal_kirim`;

-- 6. Tambahkan kolom created_at (skip jika sudah ada)
ALTER TABLE `pesanan` 
ADD COLUMN `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP;

-- 7. Tambahkan kolom updated_at (skip jika sudah ada)
ALTER TABLE `pesanan` 
ADD COLUMN `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;

-- 8. Tambahkan kolom no_resi (skip jika sudah ada)
ALTER TABLE `pesanan`
ADD COLUMN `no_resi` VARCHAR(100) NULL DEFAULT NULL COMMENT 'Nomor resi pengiriman' AFTER `metode_pengiriman`;

-- 9. Tambahkan index (skip jika sudah ada)
-- Index idx_status
ALTER TABLE `pesanan` ADD INDEX `idx_status` (`status_pesanan`);

-- Index idx_no_pesanan
ALTER TABLE `pesanan` ADD INDEX `idx_no_pesanan` (`no_pesanan`);

-- Index idx_tanggal
ALTER TABLE `pesanan` ADD INDEX `idx_tanggal` (`tanggal_pesan`);

-- 10. Buat tabel pesanan_status_log untuk audit trail
CREATE TABLE IF NOT EXISTS `pesanan_status_log` (
  `id_log` INT(11) NOT NULL AUTO_INCREMENT,
  `id_pesan` INT(11) NOT NULL,
  `status_sebelumnya` VARCHAR(20) NULL DEFAULT NULL,
  `status_baru` VARCHAR(20) NOT NULL,
  `dibuat_oleh` INT(11) NULL DEFAULT NULL COMMENT 'ID admin yang mengubah status',
  `keterangan` TEXT NULL DEFAULT NULL COMMENT 'Keterangan perubahan status',
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_log`),
  KEY `idx_pesan` (`id_pesan`),
  KEY `idx_tanggal` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 11. Tambahkan foreign key untuk pesanan_status_log (skip jika sudah ada)
ALTER TABLE `pesanan_status_log` 
ADD CONSTRAINT `fk_log_pesanan` FOREIGN KEY (`id_pesan`) REFERENCES `pesanan` (`id_pesan`) ON DELETE CASCADE;

-- 12. Update detail_pesanan - tambahkan created_at (skip jika sudah ada)
ALTER TABLE `detail_pesanan`
ADD COLUMN `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP;

-- 13. Tambahkan index untuk detail_pesanan (skip jika sudah ada)
ALTER TABLE `detail_pesanan` ADD INDEX `idx_pesan_detail` (`id_pesan`);
ALTER TABLE `detail_pesanan` ADD INDEX `idx_produk_detail` (`id_produk`);

