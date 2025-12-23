-- Migration: Hapus tabel produk_foto dan ubah gambar_produk menjadi JSON untuk multiple images
-- Database: isb_marketplace

-- 1. Hapus foreign key constraint dari produk_foto
ALTER TABLE `produk_foto` DROP FOREIGN KEY IF EXISTS `fk_produk_foto_produk`;

-- 2. Hapus tabel produk_foto
DROP TABLE IF EXISTS `produk_foto`;

-- 3. Ubah kolom gambar_produk dari VARCHAR(255) menjadi TEXT untuk menyimpan JSON array
ALTER TABLE `produk` 
MODIFY COLUMN `gambar_produk` TEXT NULL DEFAULT NULL COMMENT 'JSON array of image paths: ["path1.jpg", "path2.jpg"]';

-- 4. Optional: Migrate existing data dari produk_foto ke gambar_produk (jika ada data)
-- UPDATE produk p
-- INNER JOIN (
--     SELECT id_produk, JSON_ARRAYAGG(foto_produk ORDER BY urutan) as foto_array
--     FROM produk_foto
--     GROUP BY id_produk
-- ) pf ON p.id_produk = pf.id_produk
-- SET p.gambar_produk = pf.foto_array
-- WHERE pf.foto_array IS NOT NULL;

