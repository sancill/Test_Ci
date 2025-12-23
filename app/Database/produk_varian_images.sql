-- Migration untuk tabel produk_foto (multiple images) dan produk_varian
-- Database: isb_marketplace

-- 1. Buat tabel produk_foto untuk menyimpan multiple images produk
CREATE TABLE IF NOT EXISTS `produk_foto` (
  `id_foto` INT(11) NOT NULL AUTO_INCREMENT,
  `id_produk` INT(11) NOT NULL,
  `foto_produk` VARCHAR(255) NOT NULL COMMENT 'Path gambar produk',
  `urutan` INT(11) DEFAULT 1 COMMENT 'Urutan tampil gambar',
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_foto`),
  KEY `idx_produk` (`id_produk`),
  KEY `idx_urutan` (`urutan`),
  CONSTRAINT `fk_produk_foto_produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 2. Buat tabel produk_varian untuk menyimpan varian produk
CREATE TABLE IF NOT EXISTS `produk_varian` (
  `id_varian` INT(11) NOT NULL AUTO_INCREMENT,
  `id_produk` INT(11) NOT NULL,
  `nama_varian` VARCHAR(255) NOT NULL COMMENT 'Nama varian (contoh: Warna, Ukuran)',
  `nilai_varian` VARCHAR(255) NOT NULL COMMENT 'Nilai varian (contoh: Merah, XL)',
  `harga_tambahan` DECIMAL(15,2) DEFAULT 0.00 COMMENT 'Harga tambahan untuk varian ini',
  `stok_varian` INT(11) DEFAULT 0 COMMENT 'Stok untuk varian ini',
  `sku_varian` VARCHAR(100) DEFAULT NULL COMMENT 'SKU khusus untuk varian',
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_varian`),
  KEY `idx_produk` (`id_produk`),
  CONSTRAINT `fk_produk_varian_produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

