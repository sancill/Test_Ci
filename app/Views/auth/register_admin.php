<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Admin - ISBCOMMERCE</title>
    <style>
body { background: #0b1a44; margin: 0; padding: 0; font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; }
.auth-page { display:flex; min-height: 100vh; background:#0b1a44; }
.auth-card { margin:auto; width: min(900px, 95%); display:grid; grid-template-columns: 1fr 1fr; background:#0f172a; border-radius:20px; overflow:hidden; box-shadow:0 20px 60px rgba(8,47,73,0.45); border:1px solid #1e293b; }
.auth-hero { background: linear-gradient(135deg,#0ea5e9,#2563eb); color:#fff; padding:42px; display:flex; flex-direction:column; gap:14px; justify-content:center; }
.auth-hero h1 { font-size:28px; margin:0; }
.auth-hero p { margin:0; opacity:0.95; }
.auth-form { padding:42px; display:flex; flex-direction:column; gap:14px; color:#e2e8f0; }
.auth-form h2 { margin:0; color:#fff; }
.auth-input { width:100%; padding:12px 14px; border:1px solid #334155; background:#0b162b; color:#e2e8f0; border-radius:12px; font-size:14px; }
.auth-select { width:100%; padding:12px 14px; border:1px solid #334155; background:#0b162b; color:#e2e8f0; border-radius:12px; font-size:14px; }
.auth-btn { background:#0ea5e9; color:#0b172a; border:none; padding:12px 14px; border-radius:12px; font-weight:800; cursor:pointer; width:100%; box-shadow:0 12px 30px rgba(14,165,233,0.35); }
.auth-link { color:#38bdf8; text-decoration:none; font-weight:700; }
.error { color:#fca5a5; font-weight:700; }
.checkbox-row { display:flex; gap:8px; align-items:flex-start; font-size:13px; color:#cbd5e1; }
.info-note { font-size:13px; color:#cbd5e1; }
@media(max-width:900px){ .auth-card{grid-template-columns:1fr;} .auth-hero{display:none;} }
    </style>
</head>
<body>
<div class="auth-page">
  <div class="auth-card">
    <div class="auth-hero">
      <h1>Registrasi Admin</h1>
      <p>Khusus penjual, pemilik toko, dan admin.</p>
    </div>
    <div class="auth-form">
      <h2>Daftar Admin</h2>
      <?php if (!empty($error)): ?><div class="error"><?= esc($error) ?></div><?php endif; ?>
      <form method="post" action="<?= base_url('auth/register') ?>">
        <input type="hidden" name="scope" value="admin">
        <input class="auth-input" type="text" name="nama" placeholder="Nama lengkap" required>
        <input class="auth-input" type="text" name="username" placeholder="Username" required>
        <input class="auth-input" type="email" name="email" placeholder="Email" required>
        <select class="auth-select" name="role" required>
          <option value="admin">Admin</option>
          <option value="pemilik">Pemilik Toko</option>
          <option value="penjual">Penjual</option>
        </select>
        <input class="auth-input" type="password" name="password" placeholder="Password" required>
        <input class="auth-input" type="password" name="password_confirm" placeholder="Konfirmasi Password" required>
        <div class="checkbox-row">
          <input type="checkbox" id="agree" required>
          <label for="agree">Saya setuju dengan <a class="auth-link" href="<?= base_url('terms') ?>" target="_blank">Syarat & Ketentuan</a> serta <a class="auth-link" href="<?= base_url('privacy') ?>" target="_blank">Kebijakan Privasi</a></label>
        </div>
        <button type="submit" class="auth-btn">Daftar</button>
      </form>
      <div class="info-note">Sudah punya akun? <a class="auth-link" href="<?= base_url('admin/login') ?>">Masuk</a></div>
    </div>
  </div>
</div>
</body>
</html>
