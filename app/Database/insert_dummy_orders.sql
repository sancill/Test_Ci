-- Insert Dummy Data untuk Testing Orders Page
-- Database: isb_marketplace
-- Pastikan database sudah memiliki produk dengan id_produk = 20 (Indomie pack)

-- 1. Tambahkan 1 user baru (pelanggan kedua)
-- Note: Tidak hardcode id_user, biarkan AUTO_INCREMENT
INSERT INTO `user` (`nama_user`, `username`, `email`, `password`, `no_telepon`, `foto_user`) VALUES
('Budi Santoso', 'budisantoso', 'budi.santoso@email.com', 'password123', '081234567890', NULL);

SET @user_id_2 = LAST_INSERT_ID();

-- 2. Tambahkan alamat untuk user 1 (Sandi) dan user 2 (Budi)
-- Insert alamat untuk user 1 (id_user = 1, sudah ada di database)
INSERT INTO `alamat_user` (`id_user`, `nama_penerima`, `no_hp`, `alamat_lengkap`, `kecamatan`, `kabupaten`, `provinsi`, `kode_pos`, `catatan`) VALUES
(1, 'Sandi', '085758020943', 'Jl. Raya Sudirman No. 45, RT 05/RW 02', 'Kebon Jeruk', 'Jakarta Barat', 'DKI Jakarta', '11530', 'Tolong di depan rumah ya');

SET @alamat_id_1 = LAST_INSERT_ID();

-- Insert alamat untuk user 2 (user baru yang baru saja di-insert)
INSERT INTO `alamat_user` (`id_user`, `nama_penerima`, `no_hp`, `alamat_lengkap`, `kecamatan`, `kabupaten`, `provinsi`, `kode_pos`, `catatan`) VALUES
(@user_id_2, 'Budi Santoso', '081234567890', 'Jl. Gatot Subroto No. 88, Gedung Plaza', 'Kuningan', 'Jakarta Selatan', 'DKI Jakarta', '12950', 'Ambil di lobby gedung');

SET @alamat_id_2 = LAST_INSERT_ID();

-- 3. Tambahkan 2 pesanan dari 2 pelanggan berbeda
-- Pesanan 1: Dari Sandi (user 1) - Status: Diproses
-- Note: ongkir, total_harga, total_bayar menggunakan tipe INT sesuai struktur tabel
INSERT INTO `pesanan` (`no_pesanan`, `id_user`, `id_alamat`, `tanggal_pesan`, `tanggal_kirim`, `tanggal_selesai`, `metode_pengiriman`, `no_resi`, `ongkir`, `total_harga`, `total_bayar`, `id_voucher`, `status_pesanan`, `catatan_admin`, `created_at`, `updated_at`) VALUES
('ORD-20251221-001', 1, @alamat_id_1, '2025-12-21 10:30:00', NULL, NULL, 'Kurir Kampus', NULL, 15000, 9500, 24500, NULL, 'Diproses', 'Pesanan baru, segera proses', '2025-12-21 10:30:00', '2025-12-21 10:30:00');

SET @pesanan_id_1 = LAST_INSERT_ID();

-- Pesanan 2: Dari Budi (user 2) - Status: Dikirim
INSERT INTO `pesanan` (`no_pesanan`, `id_user`, `id_alamat`, `tanggal_pesan`, `tanggal_kirim`, `tanggal_selesai`, `metode_pengiriman`, `no_resi`, `ongkir`, `total_harga`, `total_bayar`, `id_voucher`, `status_pesanan`, `catatan_admin`, `created_at`, `updated_at`) VALUES
('ORD-20251221-002', @user_id_2, @alamat_id_2, '2025-12-21 14:15:00', '2025-12-21 15:00:00', NULL, 'Kurir Kampus', 'KRS-20251221-001', 20000, 19000, 39000, NULL, 'Dikirim', 'Pesanan sudah dikirim hari ini', '2025-12-21 14:15:00', '2025-12-21 15:00:00');

SET @pesanan_id_2 = LAST_INSERT_ID();

-- 4. Tambahkan detail pesanan untuk pesanan 1 (Sandi)
-- Pesanan 1: 2x Indomie pack (harga 4750, subtotal 9500)
-- Note: harga, subtotal menggunakan tipe INT sesuai struktur tabel
INSERT INTO `detail_pesanan` (`id_pesan`, `id_produk`, `jumlah`, `harga`, `subtotal`, `created_at`) VALUES
(@pesanan_id_1, 20, 2, 4750, 9500, '2025-12-21 10:30:00');

-- 5. Tambahkan detail pesanan untuk pesanan 2 (Budi)
-- Pesanan 2: 4x Indomie pack (harga 4750, subtotal 19000)
INSERT INTO `detail_pesanan` (`id_pesan`, `id_produk`, `jumlah`, `harga`, `subtotal`, `created_at`) VALUES
(@pesanan_id_2, 20, 4, 4750, 19000, '2025-12-21 14:15:00');

-- Catatan:
-- - Pesanan 1: Total harga produk = 9500, ongkir = 15000, total_bayar = 24500
-- - Pesanan 2: Total harga produk = 19000, ongkir = 20000, total_bayar = 39000
-- - Produk yang digunakan: id_produk = 20 (Indomie pack)
-- - Harga per item = 4750 (harga_setelah_diskon dari produk)

