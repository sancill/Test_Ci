# Sidebar Centralized System

## ✅ **FILE TERPUSAT UNTUK SIDEBAR**

File JavaScript sidebar sekarang sudah dipusatkan di:
**`public/assets/js/sidebar.js`**

## 📋 **CARA MENGGUNAKAN**

### Di semua halaman admin, cukup tambahkan 1 baris ini:

```html
<!-- Sidebar Toggle Script - Centralized -->
<script src="<?= base_url('assets/js/sidebar.js') ?>"></script>
```

## ✅ **FILE YANG SUDAH DIUPDATE**

Semua file admin sudah diupdate untuk menggunakan `sidebar.js`:
- ✅ `app/Views/pages_admin/dashboard.php`
- ✅ `app/Views/pages_admin/produk.php`
- ✅ `app/Views/pages_admin/kategori.php`
- ✅ `app/Views/pages_admin/menu.php`
- ✅ `app/Views/pages_admin/orders.php`
- ✅ `app/Views/pages_admin/promo.php`
- ✅ `app/Views/pages_admin/setting_toko.php`
- ✅ `app/Views/pages_admin/profile_toko.php`

## 🔧 **KEUNTUNGAN**

1. **Single Source of Truth**: Semua logika sidebar ada di 1 file saja
2. **Konsistensi**: Semua halaman menggunakan kode yang sama
3. **Maintainability**: Perubahan cukup dilakukan di 1 file
4. **No Duplication**: Tidak ada kode duplikat di setiap file
5. **Isolated**: Tidak akan konflik dengan kode lain

## 📝 **UNTUK PERUBAHAN DI MASA DEPAN**

Jika ingin mengubah fungsi sidebar (open/close), cukup edit:
**`public/assets/js/sidebar.js`**

Perubahan akan otomatis berlaku di semua halaman admin!

## 🎯 **FITUR YANG DITANGANI OLEH sidebar.js**

- ✅ Toggle sidebar (buka/tutup)
- ✅ Auto-close saat layout mengecil (mobile)
- ✅ Save/restore state di localStorage (desktop)
- ✅ Handle overlay click untuk close (mobile)
- ✅ MediaQueryList API untuk deteksi resize yang reliable
- ✅ Debounce untuk mencegah rapid clicks
- ✅ Error handling dengan try-catch
- ✅ Cleanup function untuk testing

