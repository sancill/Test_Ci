-- Migration untuk tabel pesanan dan fitur Orders Management (Safe Version)
-- Database: isb_marketplace
-- Versi ini menggunakan IF NOT EXISTS untuk menghindari error jika kolom sudah ada

-- 1. Update tabel pesanan - ubah status_pesanan menjadi enum
-- Catatan: Jika kolom status_pesanan sudah enum, query ini mungkin error tapi tidak masalah
SET @col_exists = (
    SELECT COUNT(*) 
    FROM INFORMATION_SCHEMA.COLUMNS 
    WHERE TABLE_SCHEMA = DATABASE() 
    AND TABLE_NAME = 'pesanan' 
    AND COLUMN_NAME = 'status_pesanan' 
    AND COLUMN_TYPE LIKE '%ENUM%'
);

SET @sql = IF(@col_exists = 0,
    'ALTER TABLE `pesanan` MODIFY COLUMN `status_pesanan` ENUM(''Diproses'', ''Dikirim'', ''Selesai'', ''Dibatalkan'') DEFAULT ''Diproses''',
    'SELECT ''Column status_pesanan already ENUM'' AS message'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- 2. Tambahkan kolom no_pesanan jika belum ada
SET @col_exists = (
    SELECT COUNT(*) 
    FROM INFORMATION_SCHEMA.COLUMNS 
    WHERE TABLE_SCHEMA = DATABASE() 
    AND TABLE_NAME = 'pesanan' 
    AND COLUMN_NAME = 'no_pesanan'
);

SET @sql = IF(@col_exists = 0,
    'ALTER TABLE `pesanan` ADD COLUMN `no_pesanan` VARCHAR(50) NULL DEFAULT NULL COMMENT ''Nomor pesanan unik (ORD-001)'' AFTER `id_pesan`',
    'SELECT ''Column no_pesanan already exists'' AS message'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- 3. Tambahkan kolom catatan_admin jika belum ada
SET @col_exists = (
    SELECT COUNT(*) 
    FROM INFORMATION_SCHEMA.COLUMNS 
    WHERE TABLE_SCHEMA = DATABASE() 
    AND TABLE_NAME = 'pesanan' 
    AND COLUMN_NAME = 'catatan_admin'
);

SET @sql = IF(@col_exists = 0,
    'ALTER TABLE `pesanan` ADD COLUMN `catatan_admin` TEXT NULL DEFAULT NULL COMMENT ''Catatan admin untuk pesanan'' AFTER `status_pesanan`',
    'SELECT ''Column catatan_admin already exists'' AS message'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- 4. Tambahkan kolom tanggal_kirim jika belum ada
SET @col_exists = (
    SELECT COUNT(*) 
    FROM INFORMATION_SCHEMA.COLUMNS 
    WHERE TABLE_SCHEMA = DATABASE() 
    AND TABLE_NAME = 'pesanan' 
    AND COLUMN_NAME = 'tanggal_kirim'
);

SET @sql = IF(@col_exists = 0,
    'ALTER TABLE `pesanan` ADD COLUMN `tanggal_kirim` DATETIME NULL DEFAULT NULL COMMENT ''Tanggal pengiriman'' AFTER `tanggal_pesan`',
    'SELECT ''Column tanggal_kirim already exists'' AS message'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- 5. Tambahkan kolom tanggal_selesai jika belum ada
SET @col_exists = (
    SELECT COUNT(*) 
    FROM INFORMATION_SCHEMA.COLUMNS 
    WHERE TABLE_SCHEMA = DATABASE() 
    AND TABLE_NAME = 'pesanan' 
    AND COLUMN_NAME = 'tanggal_selesai'
);

SET @sql = IF(@col_exists = 0,
    'ALTER TABLE `pesanan` ADD COLUMN `tanggal_selesai` DATETIME NULL DEFAULT NULL COMMENT ''Tanggal selesai'' AFTER `tanggal_kirim`',
    'SELECT ''Column tanggal_selesai already exists'' AS message'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- 6. Tambahkan kolom created_at jika belum ada
SET @col_exists = (
    SELECT COUNT(*) 
    FROM INFORMATION_SCHEMA.COLUMNS 
    WHERE TABLE_SCHEMA = DATABASE() 
    AND TABLE_NAME = 'pesanan' 
    AND COLUMN_NAME = 'created_at'
);

SET @sql = IF(@col_exists = 0,
    'ALTER TABLE `pesanan` ADD COLUMN `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP',
    'SELECT ''Column created_at already exists'' AS message'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- 7. Tambahkan kolom updated_at jika belum ada
SET @col_exists = (
    SELECT COUNT(*) 
    FROM INFORMATION_SCHEMA.COLUMNS 
    WHERE TABLE_SCHEMA = DATABASE() 
    AND TABLE_NAME = 'pesanan' 
    AND COLUMN_NAME = 'updated_at'
);

SET @sql = IF(@col_exists = 0,
    'ALTER TABLE `pesanan` ADD COLUMN `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
    'SELECT ''Column updated_at already exists'' AS message'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- 8. Tambahkan kolom no_resi jika belum ada
SET @col_exists = (
    SELECT COUNT(*) 
    FROM INFORMATION_SCHEMA.COLUMNS 
    WHERE TABLE_SCHEMA = DATABASE() 
    AND TABLE_NAME = 'pesanan' 
    AND COLUMN_NAME = 'no_resi'
);

SET @sql = IF(@col_exists = 0,
    'ALTER TABLE `pesanan` ADD COLUMN `no_resi` VARCHAR(100) NULL DEFAULT NULL COMMENT ''Nomor resi pengiriman'' AFTER `metode_pengiriman`',
    'SELECT ''Column no_resi already exists'' AS message'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- 9. Buat tabel riwayat status pesanan untuk audit trail
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

-- 10. Tambahkan foreign key untuk pesanan_status_log (jika belum ada)
SET @fk_exists = (
    SELECT COUNT(*) 
    FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE 
    WHERE TABLE_SCHEMA = DATABASE() 
    AND TABLE_NAME = 'pesanan_status_log' 
    AND CONSTRAINT_NAME = 'fk_log_pesanan'
);

SET @sql = IF(@fk_exists = 0,
    'ALTER TABLE `pesanan_status_log` ADD CONSTRAINT `fk_log_pesanan` FOREIGN KEY (`id_pesan`) REFERENCES `pesanan` (`id_pesan`) ON DELETE CASCADE',
    'SELECT ''Foreign key fk_log_pesanan already exists'' AS message'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- 11. Update detail_pesanan - tambahkan timestamps dan index
SET @col_exists = (
    SELECT COUNT(*) 
    FROM INFORMATION_SCHEMA.COLUMNS 
    WHERE TABLE_SCHEMA = DATABASE() 
    AND TABLE_NAME = 'detail_pesanan' 
    AND COLUMN_NAME = 'created_at'
);

SET @sql = IF(@col_exists = 0,
    'ALTER TABLE `detail_pesanan` ADD COLUMN `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP',
    'SELECT ''Column created_at already exists in detail_pesanan'' AS message'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- 12. Tambahkan index untuk detail_pesanan (jika belum ada)
SET @idx_exists = (
    SELECT COUNT(*) 
    FROM INFORMATION_SCHEMA.STATISTICS 
    WHERE TABLE_SCHEMA = DATABASE() 
    AND TABLE_NAME = 'detail_pesanan' 
    AND INDEX_NAME = 'idx_pesan_detail'
);

SET @sql = IF(@idx_exists = 0,
    'ALTER TABLE `detail_pesanan` ADD INDEX `idx_pesan_detail` (`id_pesan`)',
    'SELECT ''Index idx_pesan_detail already exists'' AS message'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SET @idx_exists = (
    SELECT COUNT(*) 
    FROM INFORMATION_SCHEMA.STATISTICS 
    WHERE TABLE_SCHEMA = DATABASE() 
    AND TABLE_NAME = 'detail_pesanan' 
    AND INDEX_NAME = 'idx_produk_detail'
);

SET @sql = IF(@idx_exists = 0,
    'ALTER TABLE `detail_pesanan` ADD INDEX `idx_produk_detail` (`id_produk`)',
    'SELECT ''Index idx_produk_detail already exists'' AS message'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

