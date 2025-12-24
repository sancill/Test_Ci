<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - ISBCOMMERCE</title>
    <style>
body { background: #eaf6f1; margin: 0; padding: 0; font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; }
.split-auth { min-height:100vh; display:flex; align-items:center; justify-content:center; padding:24px; }
.split-card { width: min(1080px, 98%); display:grid; grid-template-columns: 1.1fr 1fr; background:#fff; border-radius:18px; overflow:hidden; box-shadow:0 18px 48px rgba(15,23,42,0.16); }
.left-pane { background: linear-gradient(135deg,#1c5edc,#1c4dbd); color:#fff; padding:44px; display:flex; flex-direction:column; justify-content:center; align-items:center; gap:18px; text-align:center; }
.left-pane .hero-icon { width:96px; height:96px; border-radius:20px; background:rgba(255,255,255,0.16); display:grid; place-items:center; }
.left-pane .hero-icon img { width:60px; height:60px; }
.left-pane h1 { margin:0; font-size:28px; }
.left-pane p { margin:0; max-width:360px; line-height:1.5; opacity:0.95; }
.right-pane { padding:44px 42px; display:flex; flex-direction:column; gap:16px; }
.role-toggle { display:flex; gap:10px; }
.role-toggle button { flex:1; padding:12px; border-radius:12px; border:1px solid #e2e8f0; background:#f8fafc; color:#0f172a; font-weight:700; cursor:pointer; }
.role-toggle .active { background:#1c5edc; color:#fff; border-color:#1c5edc; box-shadow:0 8px 20px rgba(28,94,220,0.25); }
.right-pane h2 { margin:0; color:#0f172a; text-align:center; }
.subtitle { text-align:center; color:#475569; font-size:13px; }
.input { width:100%; padding:12px 14px; border:1px solid #e2e8f0; border-radius:12px; font-size:14px; }
.submit { width:100%; padding:12px 14px; background:#1c5edc; color:#fff; border:none; border-radius:12px; font-weight:800; cursor:pointer; box-shadow:0 10px 28px rgba(28,94,220,0.28); }
.link { color:#1c5edc; font-weight:700; text-decoration:none; }
.muted { color:#64748b; font-size:13px; text-align:center; }
.error { color:#dc2626; font-weight:700; text-align:center; }
@media(max-width:960px){ .split-card{grid-template-columns:1fr;} .left-pane{display:none;} }
    </style>
</head>
<body>
<div class="split-auth">
  <div class="split-card">
    <div class="left-pane">
      <div class="hero-icon"><img src="/assets/img/logo.png" alt="icon"></div>
      <h1>Selamat Datang</h1>
      <p>Masuk sebagai admin/penjual untuk mengelola toko dan pesanan.</p>
    </div>
    <div class="right-pane">
      <div style="text-align:center; margin-bottom:6px;">
        <h2>Masuk ke Akun</h2>
        <div class="subtitle">Pilih metode login sesuai dengan peran Anda</div>
      </div>
      <div class="role-toggle">
        <button type="button" onclick="window.location.href='<?= base_url('login') ?>'">Pembeli</button>
        <button class="active" type="button">Admin</button>
      </div>
      <h3 style="margin:10px 0 4px; text-align:center; color:#0f172a;">Login Admin</h3>
      <?php if (!empty($error)): ?><div class="error"><?= esc($error) ?></div><?php endif; ?>
      <form method="post" action="<?= base_url('auth/login') ?>" style="display:flex; flex-direction:column; gap:12px;">
        <input type="hidden" name="scope" value="admin">
        <input class="input" type="email" name="email" placeholder="Email" required style="margin-bottom:4px;">
        <input class="input" type="password" name="password" placeholder="Password" required style="margin-top:4px;">
        <button type="submit" class="submit">Masuk</button>
      </form>
      <div class="muted">Belum punya akun admin? <a class="link" href="<?= base_url('admin/register') ?>">Daftar sekarang</a></div>
      <div class="muted" style="margin-top:6px;">Dengan masuk, Anda menyetujui<br>
        <a class="link" href="<?= base_url('terms') ?>" target="_blank">Syarat & Ketentuan</a> dan <a class="link" href="<?= base_url('privacy') ?>" target="_blank">Kebijakan Privasi</a>
      </div>
    </div>
  </div>
</div>
</body>
</html>
