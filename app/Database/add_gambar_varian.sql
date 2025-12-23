-- Migration: Tambahkan kolom gambar_varian ke tabel produk_varian
-- Database: isb_marketplace

ALTER TABLE `produk_varian`
ADD COLUMN `gambar_varian` TEXT NULL DEFAULT NULL COMMENT 'JSON array of image paths for this variant: ["path1.jpg", "path2.jpg"]' AFTER `sku_varian`;

