<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kebijakan Privasi - ISBCOMMERCE</title>
    <style>
body { background: #f1f5f9; margin: 0; padding: 0; font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; }
.doc-page { max-width:960px; margin:40px auto; padding:24px; background:#fff; border-radius:16px; box-shadow:0 12px 36px rgba(15,23,42,0.12); }
.doc-page h1 { margin-top:0; color:#0f172a; }
.doc-page h2 { color:#0f172a; margin-top:24px; }
.doc-page p, .doc-page li { color:#475569; line-height:1.6; }
.doc-actions { display:flex; justify-content:flex-end; gap:12px; margin-top:16px; }
.doc-btn { padding:10px 14px; border-radius:10px; border:1px solid #e2e8f0; background:#f8fafc; color:#0f172a; cursor:pointer; }
.doc-btn.primary { background:#2563eb; color:#fff; border-color:#1d4ed8; }
    </style>
</head>
<body>
<div class="doc-page">
  <h1>Kebijakan Privasi</h1>
  <p>Harap baca sampai selesai. Tombol kembali/lanjut akan aktif setelah Anda scroll ke bawah.</p>
  <h2>1. Data yang Dikumpulkan</h2>
  <ul>
    <li>Data akun: nama, email, role, nomor kontak (jika diisi).</li>
    <li>Data transaksi: produk, jumlah, alamat pengiriman, metode pembayaran.</li>
  </ul>
  <h2>2. Penggunaan Data</h2>
  <ul>
    <li>Memproses pesanan, pengiriman, dan pemberitahuan status.</li>
    <li>Menjaga keamanan akun dan mencegah penyalahgunaan (login ganda dibatasi).</li>
    <li>Memberikan dukungan pelanggan dan perbaikan layanan.</li>
  </ul>
  <h2>3. Berbagi Data</h2>
  <ul>
    <li>Dengan kurir/pihak pengiriman (alamat, kontak penerima).</li>
    <li>Dengan penyedia pembayaran (jika digunakan) sesuai kebutuhan transaksi.</li>
  </ul>
  <h2>4. Penyimpanan & Keamanan</h2>
  <ul>
    <li>Password disimpan dalam bentuk hash.</li>
    <li>Sesi tunggal per akun untuk mencegah penggunaan bersamaan.</li>
  </ul>
  <h2>5. Hak Pengguna</h2>
  <ul>
    <li>Mengakses dan memperbarui data akun.</li>
    <li>Meminta penghapusan akun sesuai kebijakan operasional toko.</li>
  </ul>
  <div class="doc-actions">
    <button id="btn-back" class="doc-btn" disabled>Kembali</button>
    <button id="btn-accept" class="doc-btn primary" disabled>Saya sudah baca</button>
  </div>
</div>
<script>
(() => {
  const backBtn = document.getElementById('btn-back');
  const okBtn = document.getElementById('btn-accept');
  let unlocked = false;
  window.addEventListener('scroll', () => {
    if (unlocked) return;
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 10) {
      unlocked = true;
      backBtn.disabled = false;
      okBtn.disabled = false;
    }
  });
  backBtn?.addEventListener('click', () => history.back());
  okBtn?.addEventListener('click', () => history.back());
})();
</script>
</body>
</html>
