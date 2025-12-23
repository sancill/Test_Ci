-- SQL Migration: Hapus tabel produk_foto dan tambahkan kolom gambar_produk ke tabel produk
-- Database: isb_marketplace

-- 1. Hapus foreign key constraint jika ada
ALTER TABLE `produk_foto` DROP FOREIGN KEY IF EXISTS `fk_produk_foto_produk`;

-- 2. Hapus tabel produk_foto
DROP TABLE IF EXISTS `produk_foto`;

-- 3. Tambahkan kolom gambar_produk ke tabel produk
ALTER TABLE `produk` 
ADD COLUMN `gambar_produk` VARCHAR(255) NULL DEFAULT NULL COMMENT 'Path gambar produk' AFTER `deskripsi_produk`;

-- 4. Optional: Jika ingin memindahkan data dari produk_foto ke produk sebelum menghapus tabel
-- UPDATE produk p
-- INNER JOIN (
--     SELECT id_produk, foto_produk, MIN(urutan) as min_urutan
--     FROM produk_foto
--     GROUP BY id_produk
-- ) pf ON p.id_produk = pf.id_produk
-- SET p.gambar_produk = pf.foto_produk
-- WHERE pf.urutan = pf.min_urutan;

