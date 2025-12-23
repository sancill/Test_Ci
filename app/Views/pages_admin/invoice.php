<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #<?= esc($pesanan['no_pesanan'] ?? 'ORD-' . $pesanan['id_pesan']) ?> - ISBCOMMERCE</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            color: #333;
            background: #f5f5f5;
            padding: 20px;
        }
        
        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        
        .invoice-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 2px solid #e5e7eb;
        }
        
        .company-info h1 {
            font-size: 24px;
            color: #111827;
            margin-bottom: 8px;
        }
        
        .company-info p {
            color: #6b7280;
            font-size: 14px;
            line-height: 1.6;
        }
        
        .invoice-info {
            text-align: right;
        }
        
        .invoice-info h2 {
            font-size: 20px;
            color: #111827;
            margin-bottom: 8px;
        }
        
        .invoice-info p {
            color: #6b7280;
            font-size: 14px;
        }
        
        .invoice-body {
            margin-bottom: 40px;
        }
        
        .billing-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }
        
        .info-section h3 {
            font-size: 16px;
            color: #111827;
            margin-bottom: 12px;
            padding-bottom: 8px;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .info-section p {
            color: #6b7280;
            font-size: 14px;
            line-height: 1.8;
            margin-bottom: 4px;
        }
        
        .table-wrapper {
            margin-top: 30px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        thead {
            background: #f9fafb;
        }
        
        th {
            padding: 12px;
            text-align: left;
            font-weight: 600;
            color: #111827;
            font-size: 14px;
            border-bottom: 2px solid #e5e7eb;
        }
        
        td {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 14px;
            color: #374151;
        }
        
        .text-right {
            text-align: right;
        }
        
        .invoice-summary {
            margin-top: 30px;
            display: flex;
            justify-content: flex-end;
        }
        
        .summary-table {
            width: 300px;
        }
        
        .summary-table td {
            padding: 8px 12px;
            border: none;
        }
        
        .summary-table td:last-child {
            text-align: right;
            font-weight: 600;
        }
        
        .total-row {
            border-top: 2px solid #111827;
            font-size: 18px;
            color: #111827;
        }
        
        .invoice-footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid #e5e7eb;
            text-align: center;
            color: #6b7280;
            font-size: 14px;
        }
        
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }
        
        .status-diproses { background: #FEF3C7; color: #92400E; }
        .status-dikirim { background: #DBEAFE; color: #1E40AF; }
        .status-selesai { background: #D1FAE5; color: #065F46; }
        .status-dibatalkan { background: #FEE2E2; color: #991B1B; }
        
        @media print {
            body {
                background: white;
                padding: 0;
            }
            
            .invoice-container {
                box-shadow: none;
                padding: 20px;
            }
            
            .no-print {
                display: none !important;
            }
        }
        
        .print-actions {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .btn-print-page {
            display: inline-block;
            padding: 12px 24px;
            background: #3B82F6;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            font-size: 14px;
        }
        
        .btn-print-page:hover {
            background: #2563EB;
        }
    </style>
</head>
<body>
    <div class="print-actions no-print">
        <button class="btn-print-page" onclick="window.print()">Cetak Invoice</button>
        <a href="<?= site_url('admin/orders') ?>" class="btn-print-page" style="background: #6B7280; margin-left: 10px;">Kembali</a>
    </div>

    <div class="invoice-container">
        <div class="invoice-header">
            <div class="company-info">
                <h1><?= esc($toko['nama_toko'] ?? 'ISBCOMMERCE') ?></h1>
                <p><?= esc($toko['alamat_toko'] ?? '') ?></p>
                <p><?= esc($toko['kota'] ?? '') ?>, <?= esc($toko['provinsi'] ?? '') ?> <?= esc($toko['kode_pos'] ?? '') ?></p>
                <p>Telp: <?= esc($toko['telepon_admin'] ?? '-') ?> | Email: <?= esc($toko['email_cs'] ?? '-') ?></p>
            </div>
            <div class="invoice-info">
                <h2>INVOICE</h2>
                <p><strong>No. Invoice:</strong> <?= esc($pesanan['no_pesanan'] ?? 'ORD-' . str_pad($pesanan['id_pesan'], 6, '0', STR_PAD_LEFT)) ?></p>
                <p><strong>Tanggal:</strong> <?= date('d M Y', strtotime($pesanan['tanggal_pesan'])) ?></p>
                <p>
                    <strong>Status:</strong> 
                    <span class="status-badge status-<?= strtolower($pesanan['status_pesanan'] ?? 'diproses') ?>">
                        <?= esc($pesanan['status_pesanan'] ?? 'Diproses') ?>
                    </span>
                </p>
            </div>
        </div>

        <div class="invoice-body">
            <div class="billing-info">
                <div class="info-section">
                    <h3>Informasi Pelanggan</h3>
                    <p><strong><?= esc($pesanan['nama_penerima'] ?? $pesanan['nama_pelanggan'] ?? '-') ?></strong></p>
                    <p><?= esc($pesanan['email_pelanggan'] ?? '-') ?></p>
                    <p><?= esc($pesanan['telepon_pelanggan'] ?? '-') ?></p>
                </div>
                <div class="info-section">
                    <h3>Alamat Pengiriman</h3>
                    <p><?= esc($pesanan['alamat_lengkap'] ?? '-') ?></p>
                    <p><?= esc($pesanan['kecamatan'] ?? '') ?>, <?= esc($pesanan['kabupaten'] ?? '') ?></p>
                    <p><?= esc($pesanan['provinsi'] ?? '') ?> <?= esc($pesanan['kode_pos'] ?? '') ?></p>
                    <?php if (!empty($pesanan['catatan'])): ?>
                        <p style="margin-top: 8px;"><strong>Catatan:</strong> <?= esc($pesanan['catatan']) ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Produk</th>
                            <th class="text-right">Jumlah</th>
                            <th class="text-right">Harga</th>
                            <th class="text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        $total = 0;
                        foreach ($details as $detail): 
                            $subtotal = $detail['subtotal'];
                            $total += $subtotal;
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td>
                                <strong><?= esc($detail['nama_produk']) ?></strong>
                                <?php if (!empty($detail['sku'])): ?>
                                    <br><small style="color: #6b7280;">SKU: <?= esc($detail['sku']) ?></small>
                                <?php endif; ?>
                            </td>
                            <td class="text-right"><?= esc($detail['jumlah']) ?></td>
                            <td class="text-right">Rp <?= number_format($detail['harga'], 0, ',', '.') ?></td>
                            <td class="text-right">Rp <?= number_format($subtotal, 0, ',', '.') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="invoice-summary">
                <table class="summary-table">
                    <tr>
                        <td>Subtotal</td>
                        <td>Rp <?= number_format($pesanan['total_harga'] ?? $total, 0, ',', '.') ?></td>
                    </tr>
                    <?php if (!empty($pesanan['ongkir']) && $pesanan['ongkir'] > 0): ?>
                    <tr>
                        <td>Ongkir (<?= esc($pesanan['metode_pengiriman'] ?? 'Kurir Internal') ?>)</td>
                        <td>Rp <?= number_format($pesanan['ongkir'], 0, ',', '.') ?></td>
                    </tr>
                    <?php endif; ?>
                    <?php if (!empty($pesanan['id_voucher'])): ?>
                    <tr>
                        <td>Diskon Voucher</td>
                        <td>-</td>
                    </tr>
                    <?php endif; ?>
                    <tr class="total-row">
                        <td><strong>TOTAL</strong></td>
                        <td><strong>Rp <?= number_format($pesanan['total_bayar'] ?? $pesanan['total_harga'] ?? $total, 0, ',', '.') ?></strong></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="invoice-footer">
            <p>Terima kasih telah berbelanja di <?= esc($toko['nama_toko'] ?? 'ISBCOMMERCE') ?></p>
            <p>Invoice ini sah sebagai bukti pembelian</p>
        </div>
    </div>
</body>
</html>

