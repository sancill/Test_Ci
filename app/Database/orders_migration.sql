-- Migration untuk tabel pesanan dan fitur Orders Management
-- Database: isb_marketplace

-- 1. Update tabel pesanan - ubah status_pesanan menjadi enum dan tambahkan kolom yang diperlukan
-- Periksa dan update kolom status_pesanan jika belum enum
ALTER TABLE `pesanan` 
MODIFY COLUMN `status_pesanan` ENUM('Diproses', 'Dikirim', 'Selesai', 'Dibatalkan') DEFAULT 'Diproses';

-- Tambahkan kolom jika belum ada (gunakan IF NOT EXISTS logic)
ALTER TABLE `pesanan` 
ADD COLUMN IF NOT EXISTS `no_pesanan` VARCHAR(50) NULL DEFAULT NULL COMMENT 'Nomor pesanan unik (ORD-001)' AFTER `id_pesan`;

ALTER TABLE `pesanan` 
ADD COLUMN IF NOT EXISTS `catatan_admin` TEXT NULL DEFAULT NULL COMMENT 'Catatan admin untuk pesanan' AFTER `status_pesanan`;

ALTER TABLE `pesanan` 
ADD COLUMN IF NOT EXISTS `tanggal_kirim` DATETIME NULL DEFAULT NULL COMMENT 'Tanggal pengiriman' AFTER `tanggal_pesan`;

ALTER TABLE `pesanan` 
ADD COLUMN IF NOT EXISTS `tanggal_selesai` DATETIME NULL DEFAULT NULL COMMENT 'Tanggal selesai' AFTER `tanggal_kirim`;

ALTER TABLE `pesanan` 
ADD COLUMN IF NOT EXISTS `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP;

ALTER TABLE `pesanan` 
ADD COLUMN IF NOT EXISTS `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;

-- Tambahkan index jika belum ada
CREATE INDEX IF NOT EXISTS `idx_status` ON `pesanan` (`status_pesanan`);
CREATE INDEX IF NOT EXISTS `idx_no_pesanan` ON `pesanan` (`no_pesanan`);
CREATE INDEX IF NOT EXISTS `idx_tanggal` ON `pesanan` (`tanggal_pesan`);

-- 2. Buat tabel riwayat status pesanan untuk audit trail
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
  KEY `idx_tanggal` (`created_at`),
  CONSTRAINT `fk_log_pesanan` FOREIGN KEY (`id_pesan`) REFERENCES `pesanan` (`id_pesan`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 3. Update detail_pesanan - tambahkan timestamps dan index
ALTER TABLE `detail_pesanan`
ADD COLUMN IF NOT EXISTS `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP;

CREATE INDEX IF NOT EXISTS `idx_pesan` ON `detail_pesanan` (`id_pesan`);
CREATE INDEX IF NOT EXISTS `idx_produk` ON `detail_pesanan` (`id_produk`);

-- 4. Update tabel pesanan untuk menambahkan kolom resi jika diperlukan
ALTER TABLE `pesanan`
ADD COLUMN IF NOT EXISTS `no_resi` VARCHAR(100) NULL DEFAULT NULL COMMENT 'Nomor resi pengiriman' AFTER `metode_pengiriman`;

