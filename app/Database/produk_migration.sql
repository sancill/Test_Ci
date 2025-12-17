-- Migration untuk table produk (products)
-- Database: isb_marketplace

CREATE TABLE IF NOT EXISTS `produk` (
  `id_produk` int(11) NOT NULL AUTO_INCREMENT,
  `id_toko` int(11) DEFAULT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `deskripsi_produk` text DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `id_menu` int(11) DEFAULT NULL,
  `merek` varchar(100) DEFAULT NULL,
  `harga_awal` decimal(15,2) NOT NULL DEFAULT 0.00,
  `harga_diskon` decimal(15,2) DEFAULT 0.00,
  `tipe_diskon` enum('persentase','nominal') DEFAULT 'persentase',
  `id_promo` int(11) DEFAULT NULL,
  `harga_setelah_diskon` decimal(15,2) DEFAULT 0.00,
  `stok` int(11) NOT NULL DEFAULT 0,
  `sku` varchar(100) DEFAULT NULL,
  `berat` int(11) DEFAULT 0 COMMENT 'Berat dalam gram',
  `status_produk` enum('aktif','tidak_aktif','draft') DEFAULT 'draft',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_produk`),
  KEY `idx_kategori` (`id_kategori`),
  KEY `idx_menu` (`id_menu`),
  KEY `idx_toko` (`id_toko`),
  KEY `idx_status` (`status_produk`),
  KEY `idx_sku` (`sku`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Migration untuk table produk_foto (product images)
-- Database: isb_marketplace

CREATE TABLE IF NOT EXISTS `produk_foto` (
  `id_foto` int(11) NOT NULL AUTO_INCREMENT,
  `id_produk` int(11) NOT NULL,
  `foto_produk` varchar(255) NOT NULL,
  `urutan` int(11) DEFAULT 1,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_foto`),
  KEY `idx_produk` (`id_produk`),
  CONSTRAINT `fk_produk_foto_produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Migration untuk table kategori (categories)
-- Database: isb_marketplace

CREATE TABLE IF NOT EXISTS `kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(100) NOT NULL,
  `deskripsi_kategori` text DEFAULT NULL,
  `icon_kategori` varchar(255) DEFAULT NULL,
  `status` enum('aktif','tidak_aktif') DEFAULT 'aktif',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_kategori`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Migration untuk table menu (menus)
-- Database: isb_marketplace

CREATE TABLE IF NOT EXISTS `menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(11) NOT NULL,
  `nama_menu` varchar(100) NOT NULL,
  `deskripsi_menu` text DEFAULT NULL,
  `status` enum('aktif','tidak_aktif') DEFAULT 'aktif',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_menu`),
  KEY `idx_kategori` (`id_kategori`),
  KEY `idx_status` (`status`),
  CONSTRAINT `fk_menu_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Migration untuk table promo (promotions)
-- Database: isb_marketplace

CREATE TABLE IF NOT EXISTS `promo` (
  `id_promo` int(11) NOT NULL AUTO_INCREMENT,
  `id_toko` int(11) DEFAULT NULL,
  `nama_promo` varchar(255) NOT NULL,
  `tipe_promo` enum('flash_sale','diskon_bundling','voucher') DEFAULT 'flash_sale',
  `tipe_diskon` enum('persentase','nominal') DEFAULT 'persentase',
  `nilai_diskon` decimal(10,2) NOT NULL,
  `tanggal_mulai` datetime NOT NULL,
  `tanggal_berakhir` datetime NOT NULL,
  `target_produk` text DEFAULT NULL COMMENT 'JSON array of product IDs',
  `status` enum('aktif','tidak_aktif','selesai') DEFAULT 'aktif',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_promo`),
  KEY `idx_toko` (`id_toko`),
  KEY `idx_status` (`status`),
  KEY `idx_tanggal` (`tanggal_mulai`, `tanggal_berakhir`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

