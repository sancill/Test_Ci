# Panduan Setup Google API untuk Aplikasi

## API yang Diperlukan (Semua GRATIS dalam batas tertentu)

### 1. ✅ Google Identity Services (Google Sign-In)
**Status**: Wajib diaktifkan
**Biaya**: GRATIS (unlimited requests)
**Kegunaan**: Login user dengan akun Google

**Cara Setup:**
1. Buka [Google Cloud Console](https://console.cloud.google.com/)
2. Buat project baru atau pilih project yang sudah ada
3. **TIDAK PERLU enable API khusus** - Google Identity Services tidak memerlukan API activation
4. Buat OAuth 2.0 Credentials:
   - Buka menu **APIs & Services** > **Credentials**
   - Klik **Create Credentials** > **OAuth client ID**
   - Pilih **Web application**
   - Isi:
     - **Name**: Nama aplikasi Anda (contoh: "ISB Marketplace")
     - **Authorized JavaScript origins**: 
       - `http://localhost:8080` (untuk development)
       - `https://yourdomain.com` (untuk production)
     - **Authorized redirect URIs**: (Opsional untuk Google Identity Services)
       - `http://localhost:8080/auth/google/callback`
       - `https://yourdomain.com/auth/google/callback`
   - Klik **Create**
   - **Copy Client ID** (bukan Client Secret)
   - Paste ke `app/Config/Google.php` di `$clientId`

**Catatan**: 
- Google Identity Services menggunakan JWT token yang di-decode di server
- Tidak memerlukan Client Secret untuk implementasi ini
- Tidak memerlukan API khusus untuk di-enable

---

### 2. ⚠️ Google Maps Embed API (Opsional)
**Status**: Opsional - untuk menampilkan peta di halaman profil
**Biaya**: GRATIS untuk Embed API (unlimited requests)
**Kegunaan**: Menampilkan peta alamat user di halaman profil

**Cara Setup (jika ingin menggunakan):**
1. Di Google Cloud Console, buka **APIs & Services** > **Library**
2. Cari **"Maps Embed API"**
3. Klik **Enable**
4. Buat API Key:
   - Buka **APIs & Services** > **Credentials**
   - Klik **Create Credentials** > **API Key**
   - Copy API Key
   - (Opsional) Klik **Restrict Key** untuk keamanan:
     - **Application restrictions**: HTTP referrers
     - **API restrictions**: Pilih "Maps Embed API" saja
   - Paste ke `app/Views/pages_user/profile.php` line 362, ganti `AIzaSyA-PLACEHOLDER`

**Catatan**: 
- Maps Embed API GRATIS tanpa batas
- Tidak perlu billing account untuk Embed API
- Jika tidak ingin menggunakan fitur peta, bisa diabaikan

---

## API yang TIDAK Diperlukan

### ❌ Google+ API
- **TIDAK PERLU** di-enable (sudah deprecated)
- Google Identity Services tidak memerlukan Google+ API

### ❌ Google Maps JavaScript API
- Tidak digunakan di aplikasi ini
- Hanya menggunakan Maps Embed API (lebih sederhana dan gratis)

### ❌ Google Places API
- Tidak digunakan
- Jika ingin fitur autocomplete alamat, bisa ditambahkan nanti

---

## Ringkasan Setup Minimal

Untuk membuat aplikasi berfungsi, Anda hanya perlu:

1. ✅ **OAuth 2.0 Client ID** (untuk Google Sign-In)
   - Buat di: APIs & Services > Credentials > Create Credentials > OAuth client ID
   - Copy Client ID ke `app/Config/Google.php`

2. ⚠️ **Maps Embed API Key** (opsional, untuk peta)
   - Enable API: APIs & Services > Library > Maps Embed API > Enable
   - Buat API Key: APIs & Services > Credentials > Create Credentials > API Key
   - Paste ke `app/Views/pages_user/profile.php`

---

## Limit Gratis Google API

- **Google Identity Services**: Unlimited (tidak ada limit)
- **Maps Embed API**: Unlimited (tidak ada limit)

**Kedua API ini GRATIS sepenuhnya tanpa perlu billing account!** 🎉

---

## File yang Perlu Diupdate

1. `app/Config/Google.php`
   ```php
   public string $clientId = 'YOUR_CLIENT_ID_HERE'; // Ganti dengan Client ID Anda
   ```

2. `app/Views/pages_user/profile.php` (jika ingin menggunakan peta)
   ```html
   <!-- Line 362 -->
   src="https://www.google.com/maps/embed/v1/place?key=YOUR_API_KEY_HERE&q=..."
   ```

---

## Troubleshooting

### Google Sign-In tidak muncul
- Pastikan Client ID sudah di-set dengan benar
- Pastikan Authorized JavaScript origins sudah include domain Anda
- Cek browser console untuk error

### Maps tidak muncul
- Pastikan Maps Embed API sudah di-enable
- Pastikan API Key valid
- Cek apakah API Key sudah di-restrict (jika ya, pastikan domain sudah ditambahkan)

---

## Sumber Referensi

- [Google Identity Services Documentation](https://developers.google.com/identity/gsi/web)
- [Maps Embed API Documentation](https://developers.google.com/maps/documentation/embed)
- [Google Cloud Console](https://console.cloud.google.com/)

