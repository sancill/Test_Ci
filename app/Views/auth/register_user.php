<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - ISBCOMMERCE</title>
    <style>
body { background: #f1f5f9; margin: 0; padding: 0; font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; }
.auth-page { display:flex; min-height: 100vh; background:#f1f5f9; }
.auth-card { margin:auto; width: min(960px, 95%); display:grid; grid-template-columns: 1.2fr 1fr; background:#fff; border-radius:20px; overflow:hidden; box-shadow:0 20px 60px rgba(15,23,42,0.15); }
.auth-hero { background: linear-gradient(135deg,#1d4ed8,#2563eb); color:#fff; padding:48px; display:flex; flex-direction:column; gap:16px; justify-content:center; }
.auth-hero h1 { font-size:32px; margin:0; }
.auth-hero p { margin:0; opacity:0.9; }
.auth-form { padding:48px; display:flex; flex-direction:column; gap:16px; }
.auth-form h2 { margin:0; color:#0f172a; }
.auth-input { width:100%; padding:12px 14px; border:1px solid #e2e8f0; border-radius:12px; font-size:14px; }
.auth-btn { background:#1d4ed8; color:#fff; border:none; padding:12px 14px; border-radius:12px; font-weight:700; cursor:pointer; width:100%; box-shadow:0 10px 30px rgba(37,99,235,0.25); }
.auth-btn:disabled { opacity:0.5; cursor:not-allowed; }
.auth-link { color:#2563eb; text-decoration:none; font-weight:600; }
.social-btn { width:100%; padding:12px; border-radius:12px; border:1px solid #e2e8f0; background:#f8fafc; color:#0f172a; display:flex; align-items:center; justify-content:center; gap:10px; font-weight:700; cursor:not-allowed; }
.error { color:#dc2626; font-weight:600; }
.checkbox-row { display:flex; gap:8px; align-items:flex-start; font-size:13px; color:#475569; }
.info-note { font-size:13px; color:#475569; }
@media(max-width:960px){ .auth-card{grid-template-columns:1fr;} .auth-hero{display:none;} }
    </style>
</head>
<body>
<div class="auth-page">
  <div class="auth-card">
    <div class="auth-hero">
      <h1>Daftar</h1>
      <p>Buat akun untuk mulai belanja.</p>
    </div>
    <div class="auth-form">
      <h2>Registrasi User</h2>
      <?php if (!empty($error)): ?><div class="error"><?= esc($error) ?></div><?php endif; ?>
      <button class="social-btn" disabled>Daftar dengan Google (segera hadir)</button>
      <form method="post" action="<?= base_url('auth/register') ?>">
        <input type="hidden" name="scope" value="user">
        <input class="auth-input" type="text" name="nama" placeholder="Nama lengkap" required>
        <input class="auth-input" type="email" name="email" placeholder="Email" required>
        <input class="auth-input" type="password" name="password" placeholder="Password" required>
        <input class="auth-input" type="password" name="password_confirm" placeholder="Konfirmasi Password" required>
        <div class="checkbox-row">
          <input type="checkbox" id="agree" required>
          <label for="agree">Saya setuju dengan <a class="auth-link" href="<?= base_url('terms') ?>" target="_blank">Syarat & Ketentuan</a> serta <a class="auth-link" href="<?= base_url('privacy') ?>" target="_blank">Kebijakan Privasi</a></label>
        </div>
        <button type="submit" class="auth-btn">Daftar</button>
      </form>
      <div class="info-note">Sudah punya akun? <a class="auth-link" href="<?= base_url('login') ?>">Masuk</a></div>
    </div>
  </div>
</div>
</body>
</html>
