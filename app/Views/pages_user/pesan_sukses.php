<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Berhasil</title>
    <style>
        .success-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 40px;
            text-align: center;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .success-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: #10b981;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: scaleIn 0.5s ease-out;
        }
        .success-icon svg {
            width: 50px;
            height: 50px;
            stroke: white;
            stroke-width: 3;
            fill: none;
        }
        @keyframes scaleIn {
            from {
                transform: scale(0);
            }
            to {
                transform: scale(1);
            }
        }
        .success-title {
            font-size: 24px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 10px;
        }
        .success-message {
            font-size: 16px;
            color: #6b7280;
            margin-bottom: 30px;
        }
        .order-info {
            background: #f9fafb;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            text-align: left;
        }
        .order-info-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .order-info-item:last-child {
            margin-bottom: 0;
        }
        .order-info-label {
            color: #6b7280;
            font-size: 14px;
        }
        .order-info-value {
            color: #1f2937;
            font-weight: 500;
            font-size: 14px;
        }
        .product-list {
            margin-bottom: 30px;
        }
        .product-item {
            display: flex;
            align-items: center;
            padding: 15px;
            background: #f9fafb;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        .product-item:last-child {
            margin-bottom: 0;
        }
        .product-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 15px;
        }
        .product-details {
            flex: 1;
            text-align: left;
        }
        .product-name {
            font-size: 14px;
            font-weight: 500;
            color: #1f2937;
            margin-bottom: 5px;
        }
        .product-meta {
            font-size: 12px;
            color: #6b7280;
        }
        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
        }
        .btn {
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
        }
        .btn-primary {
            background: #2563eb;
            color: white;
        }
        .btn-primary:hover {
            background: #1d4ed8;
        }
        .btn-secondary {
            background: #f3f4f6;
            color: #1f2937;
        }
        .btn-secondary:hover {
            background: #e5e7eb;
        }
    </style>
</head>
<body>
    <div class="success-container">
        <div class="success-icon">
            <svg viewBox="0 0 24 24">
                <path d="M20 6L9 17l-5-5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <h1 class="success-title">Pesanan Anda Berhasil Dibuat</h1>
        <p class="success-message">Terima kasih telah berbelanja di toko kami. Pesanan Anda sedang diproses.</p>
        
        <?php if (!empty($pesanan)): ?>
        <div class="order-info">
            <div class="order-info-item">
                <span class="order-info-label">Nomor Pesanan</span>
                <span class="order-info-value"><?= esc($pesanan['no_pesanan'] ?? 'N/A') ?></span>
            </div>
            <div class="order-info-item">
                <span class="order-info-label">Tanggal Pesan</span>
                <span class="order-info-value"><?= !empty($pesanan['tanggal_pesan']) ? date('d F Y, H:i', strtotime($pesanan['tanggal_pesan'])) : 'N/A' ?></span>
            </div>
            <div class="order-info-item">
                <span class="order-info-label">Status</span>
                <span class="order-info-value"><?= esc($pesanan['status_pesanan'] ?? 'Diproses') ?></span>
            </div>
            <div class="order-info-item">
                <span class="order-info-label">Total Pembayaran</span>
                <span class="order-info-value">Rp <?= number_format($pesanan['total_bayar'] ?? 0, 0, ',', '.') ?></span>
            </div>
        </div>
        <?php endif; ?>
        
        <?php if (!empty($detailPesanan)): ?>
        <div class="product-list">
            <h3 style="text-align: left; font-size: 16px; font-weight: 600; color: #1f2937; margin-bottom: 15px;">Produk yang Dipesan</h3>
            <?php foreach ($detailPesanan as $detail): ?>
            <div class="product-item">
                <img src="<?= base_url($detail['gambar_utama'] ?? 'assets/img/gambarprd.png') ?>" alt="<?= esc($detail['nama_produk'] ?? 'Produk') ?>" class="product-image">
                <div class="product-details">
                    <div class="product-name"><?= esc($detail['nama_produk'] ?? 'Produk') ?></div>
                    <div class="product-meta">
                        Jumlah: <?= $detail['jumlah'] ?? 0 ?> x Rp <?= number_format($detail['harga'] ?? 0, 0, ',', '.') ?>
                    </div>
                </div>
                <div style="font-weight: 600; color: #1f2937;">
                    Rp <?= number_format($detail['subtotal'] ?? 0, 0, ',', '.') ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        
        <div class="action-buttons">
            <a href="<?= base_url('profile#pesanan') ?>" class="btn btn-primary" id="goToOrders">Lihat Pesanan Saya</a>
            <a href="<?= base_url() ?>" class="btn btn-secondary">Kembali ke Beranda</a>
        </div>
    </div>
    
    <script>
        // Auto redirect to profile with pesanan section after 3 seconds
        setTimeout(function() {
            window.location.href = '<?= base_url('profile#pesanan') ?>';
        }, 3000);
        
        // Manual redirect when button clicked
        document.getElementById('goToOrders').addEventListener('click', function(e) {
            e.preventDefault();
            window.location.href = '<?= base_url('profile#pesanan') ?>';
        });
    </script>
</body>
</html>


