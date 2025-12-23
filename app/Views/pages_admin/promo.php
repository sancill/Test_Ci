<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Promo - ISBCOMMERCE</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard.css') ?>">
    <style>
        .promo-page {
            padding: 24px 32px;
        }

        .page-header {
            margin-bottom: 32px;
        }

        .page-title {
            font-size: clamp(24px, 3vw, 30px);
            font-weight: 700;
            line-height: 1.2;
            color: #111827;
            margin-bottom: 8px;
        }

        .page-subtitle {
            font-size: clamp(14px, 1.5vw, 16px);
            color: #6B7280;
        }

        .promo-section {
            background: #FFFFFF;
            border-radius: 12px;
            border: 1px solid #E5E7EB;
            padding: clamp(16px, 2vw, 24px);
            margin-bottom: 32px;
        }

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: clamp(16px, 2vw, 24px);
            flex-wrap: wrap;
            gap: 16px;
        }

        .section-title-group h2 {
            font-size: clamp(18px, 2vw, 20px);
            font-weight: 600;
            color: #111827;
            margin-bottom: 4px;
        }

        .section-title-group p {
            font-size: clamp(12px, 1.2vw, 14px);
            color: #6B7280;
        }

        .promo-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 20px;
        }

        .promo-card {
            border: 1px solid #E5E7EB;
            border-radius: 12px;
            padding: 20px;
            position: relative;
            transition: all 0.2s;
        }

        .promo-card:hover {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .promo-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .promo-type {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 9999px;
            font-size: 12px;
            font-weight: 600;
        }

        .promo-type.flash-sale {
            background: #FEE2E2;
            color: #991B1B;
        }

        .promo-type.diskon {
            background: #DBEAFE;
            color: #1E40AF;
        }

        .promo-type.voucher {
            background: #D1FAE5;
            color: #065F46;
        }

        .promo-title {
            font-size: 18px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 8px;
        }

        .promo-details {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 16px;
        }

        .promo-detail-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: #6B7280;
        }

        .promo-detail-item svg {
            width: 16px;
            height: 16px;
            color: #9CA3AF;
        }

        .promo-stats {
            display: flex;
            gap: 16px;
            padding-top: 16px;
            border-top: 1px solid #E5E7EB;
        }

        .stat-item {
            flex: 1;
        }

        .stat-label {
            font-size: 12px;
            color: #6B7280;
            margin-bottom: 4px;
        }

        .stat-value {
            font-size: 16px;
            font-weight: 600;
            color: #111827;
        }

        .promo-actions {
            position: absolute;
            top: 20px;
            right: 20px;
            display: flex;
            gap: 8px;
        }

        .action-btn {
            width: 36px;
            height: 36px;
            border: none;
            background: transparent;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.2s;
        }

        .action-btn:hover {
            background: #F3F4F6;
        }

        .action-btn img {
            width: 14px;
            height: 18px;
            object-fit: contain;
        }

        .add-promo-section {
            background: #FFFFFF;
            border-radius: 12px;
            border: 1px solid #E5E7EB;
            padding: clamp(20px, 2.5vw, 32px);
        }

        .form-header {
            margin-bottom: clamp(20px, 2.5vw, 32px);
        }

        .form-title {
            font-size: clamp(20px, 2.5vw, 24px);
            font-weight: 700;
            color: #111827;
            margin-bottom: 8px;
        }

        .form-subtitle {
            font-size: clamp(13px, 1.5vw, 14px);
            color: #6B7280;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: clamp(16px, 2vw, 24px);
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-label {
            font-size: 14px;
            font-weight: 500;
            color: #374151;
        }

        .form-label.required::after {
            content: '*';
            color: #DC2626;
            margin-left: 4px;
        }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #D1D5DB;
            border-radius: 8px;
            font-size: 14px;
            color: #111827;
            font-family: 'Inter', sans-serif;
            transition: border-color 0.2s;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: #2563EB;
        }

        .form-textarea {
            min-height: 100px;
            resize: vertical;
        }

        .discount-input-group {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .discount-input-group input {
            flex: 1;
        }

        .discount-suffix {
            font-size: 14px;
            color: #6B7280;
        }

        .product-select-list {
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid #D1D5DB;
            border-radius: 8px;
            padding: 8px;
        }

        .product-checkbox-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px;
            border-radius: 4px;
            transition: background 0.2s;
        }

        .product-checkbox-item:hover {
            background: #F9FAFB;
        }

        .product-checkbox-item input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .product-checkbox-item label {
            font-size: 14px;
            color: #374151;
            cursor: pointer;
            flex: 1;
        }

        .form-actions {
            display: flex;
            gap: 12px;
            margin-top: clamp(24px, 3vw, 32px);
            flex-wrap: wrap;
        }

        .btn-submit {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            background: #2563EB;
            color: #FFFFFF;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-submit:hover {
            background: #1D4ED8;
        }

        .btn-submit img {
            width: 14px;
            height: 14px;
        }

        .btn-cancel {
            padding: 12px 24px;
            background: #F3F4F6;
            color: #374151;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-cancel:hover {
            background: #E5E7EB;
        }

        @media (max-width: 768px) {
            .promo-page {
                padding: 16px;
            }

            .promo-grid {
                grid-template-columns: 1fr;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn-submit,
            .btn-cancel {
                width: 100%;
            }
        }

        @media (max-width: 390px) {
            .promo-page {
                padding: 12px;
            }

            .promo-card {
                padding: 16px;
            }

            .form-title {
                font-size: 18px;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <?= view('layout/sidebar_admin', ['activeMenu' => 'promo']) ?>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            <header class="dashboard-header">
                <button class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle sidebar">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 12H21M3 6H21M3 18H21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                <div class="header-search">
                    <div class="search-input-wrapper">
                        <input type="text" placeholder="Search products, orders, customers..." class="search-input">
                        <svg width="16" height="24" viewBox="0 0 16 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                            class="search-icon">
                            <path
                                d="M7 14C10.866 14 14 10.866 14 7C14 3.13401 10.866 0 7 0C3.13401 0 0 3.13401 0 7C0 10.866 3.13401 14 7 14Z"
                                stroke="currentColor" stroke-width="2" />
                            <path d="M13 13L19 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="icon-btn notification-btn">
                        <img src="<?= base_url('assets/img/notif.png') ?>" alt="Notifications">
                        <span class="notification-badge"></span>
                    </button>
                    <button class="icon-btn">
                        <img src="<?= base_url('assets/img/email.png') ?>" alt="Email">
                    </button>
                </div>
            </header>

            <!-- Promo Page Content -->
            <main class="dashboard-main">
                <div class="promo-page">
                    <div class="page-header">
                        <h1 class="page-title">Manajemen Promo & Diskon</h1>
                        <p class="page-subtitle">Kelola flash sale, diskon bundling, dan voucher toko</p>
                    </div>

                    <!-- Alert Messages -->
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success" style="background: #D1FAE5; color: #065F46; padding: 16px; border-radius: 8px; margin-bottom: 24px; border: 1px solid #34D399;">
                            <strong>Berhasil!</strong> <?= session()->getFlashdata('success') ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-error" style="background: #FEE2E2; color: #991B1B; padding: 16px; border-radius: 8px; margin-bottom: 24px; border: 1px solid #FCA5A5;">
                            <strong>Error!</strong> <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>

                    <!-- Promo List Section -->
                    <div class="promo-section">
                        <div class="section-header">
                            <div class="section-title-group">
                                <h2>Daftar Promo Aktif</h2>
                                <p>Total: <?= isset($promoAktif) ? count($promoAktif) : 0 ?> promo aktif</p>
                            </div>
                            <button class="btn-primary" onclick="document.getElementById('addPromoForm').scrollIntoView({behavior: 'smooth'})">
                                <img src="<?= base_url('assets/img/pluswhite.png') ?>" alt="Tambah Promo">
                                <span>Tambah Promo</span>
                            </button>
                        </div>

                        <div class="promo-grid">
                            <?php if (!empty($promos)): ?>
                                <?php foreach ($promos as $promo): ?>
                                    <?php
                                    $tipePromoClass = '';
                                    $tipePromoLabel = '';
                                    if ($promo['tipe_promo'] === 'flash_sale') {
                                        $tipePromoClass = 'flash-sale';
                                        $tipePromoLabel = 'Flash Sale';
                                    } elseif ($promo['tipe_promo'] === 'diskon_bundling') {
                                        $tipePromoClass = 'diskon';
                                        $tipePromoLabel = 'Diskon Bundling';
                                    } else {
                                        $tipePromoClass = 'voucher';
                                        $tipePromoLabel = 'Voucher Toko';
                                    }
                                    
                                    $diskonText = '';
                                    if ($promo['tipe_diskon'] === 'persentase') {
                                        $diskonText = 'Diskon ' . number_format($promo['nilai_diskon'], 0) . '%';
                                    } else {
                                        $diskonText = 'Diskon Rp ' . number_format($promo['nilai_diskon'], 0, ',', '.');
                                    }
                                    
                                    $tanggalMulai = date('d M', strtotime($promo['tanggal_mulai']));
                                    $tanggalBerakhir = date('d M Y', strtotime($promo['tanggal_berakhir']));
                                    $jumlahProduk = $promo['jumlah_produk'] ?? 0;
                                    $totalPenjualan = $promo['total_penjualan'] ?? 0;
                                    $totalPesanan = $promo['total_pesanan'] ?? 0;
                                    ?>
                                    <div class="promo-card">
                                        <div class="promo-actions">
                                            <a href="<?= site_url('admin/promo?edit=' . $promo['id_promo']) ?>" class="action-btn" title="Edit">
                                                <img src="<?= base_url('assets/img/icon-edit.png') ?>" alt="Edit">
                                            </a>
                                            <a href="<?= site_url('admin/hapus_promo/' . $promo['id_promo']) ?>" 
                                               class="action-btn" 
                                               title="Hapus"
                                               onclick="return confirm('Apakah Anda yakin ingin menghapus promo ini?')">
                                                <img src="<?= base_url('assets/img/icon-tongsampah.png') ?>" alt="Hapus">
                                            </a>
                                        </div>
                                        <div class="promo-header">
                                            <span class="promo-type <?= $tipePromoClass ?>"><?= esc($tipePromoLabel) ?></span>
                                            <?php if ($promo['status'] === 'tidak_aktif'): ?>
                                                <span style="background: #F3F4F6; color: #6B7280; padding: 4px 12px; border-radius: 9999px; font-size: 12px; font-weight: 600;">Tidak Aktif</span>
                                            <?php endif; ?>
                                        </div>
                                        <h3 class="promo-title"><?= esc($promo['nama_promo']) ?></h3>
                                        <div class="promo-details">
                                            <div class="promo-detail-item">
                                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M8 2V6M16 2V6M3 10H21M5 4H19C20.1046 4 21 4.89543 21 6V20C21 21.1046 20.1046 22 19 22H5C3.89543 22 3 21.1046 3 20V6C3 4.89543 3.89543 4 5 4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                                <span><?= $tanggalMulai ?> - <?= $tanggalBerakhir ?></span>
                                            </div>
                                            <div class="promo-detail-item">
                                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                                <span><?= $jumlahProduk ?> produk</span>
                                            </div>
                                            <div class="promo-detail-item">
                                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                                <span><?= esc($diskonText) ?></span>
                                            </div>
                                        </div>
                                        <div class="promo-stats">
                                            <div class="stat-item">
                                                <div class="stat-label">Total Penjualan</div>
                                                <div class="stat-value">Rp <?= number_format($totalPenjualan / 1000000, 1) ?>M</div>
                                            </div>
                                            <div class="stat-item">
                                                <div class="stat-label">Pesanan</div>
                                                <div class="stat-value"><?= number_format($totalPesanan, 0, ',', '.') ?></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #6B7280;">
                                    <p>Tidak ada promo aktif</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Add/Edit Promo Form Section -->
                    <div class="add-promo-section" id="addPromoForm">
                        <div class="form-header">
                            <h2 class="form-title"><?= isset($editId) && $editId ? 'Edit Promo' : 'Tambah Promo Baru' ?></h2>
                            <p class="form-subtitle"><?= isset($editId) && $editId ? 'Ubah informasi promo yang ada' : 'Buat flash sale, diskon bundling, atau voucher toko' ?></p>
                        </div>

                        <form id="promoForm" action="<?= isset($editId) && $editId ? base_url('admin/update_promo/' . $editId) : base_url('admin/simpan_promo') ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="form-grid">
                                <!-- Promo Type -->
                                <div class="form-group">
                                    <label class="form-label required">Tipe Promo</label>
                                    <select name="tipe_promo" id="tipePromo" class="form-select" required>
                                        <option value="">Pilih tipe promo</option>
                                        <option value="flash_sale" <?= (isset($promoEdit) && $promoEdit['tipe_promo'] === 'flash_sale') ? 'selected' : '' ?>>Flash Sale</option>
                                        <option value="diskon_bundling" <?= (isset($promoEdit) && $promoEdit['tipe_promo'] === 'diskon_bundling') ? 'selected' : '' ?>>Diskon Bundling</option>
                                        <option value="voucher" <?= (isset($promoEdit) && $promoEdit['tipe_promo'] === 'voucher') ? 'selected' : '' ?>>Voucher Toko</option>
                                    </select>
                                </div>

                                <!-- Promo Name -->
                                <div class="form-group">
                                    <label class="form-label required">Nama Promo</label>
                                    <input type="text" name="nama_promo" class="form-input" 
                                           placeholder="Masukkan nama promo" 
                                           value="<?= isset($promoEdit) ? esc($promoEdit['nama_promo']) : '' ?>" required>
                                </div>

                                <!-- Start Date -->
                                <div class="form-group">
                                    <label class="form-label required">Tanggal Mulai</label>
                                    <input type="datetime-local" name="tanggal_mulai" class="form-input" 
                                           value="<?= isset($promoEdit) ? date('Y-m-d\TH:i', strtotime($promoEdit['tanggal_mulai'])) : '' ?>" required>
                                </div>

                                <!-- End Date -->
                                <div class="form-group">
                                    <label class="form-label required">Tanggal Berakhir</label>
                                    <input type="datetime-local" name="tanggal_berakhir" class="form-input" 
                                           value="<?= isset($promoEdit) ? date('Y-m-d\TH:i', strtotime($promoEdit['tanggal_berakhir'])) : '' ?>" required>
                                </div>

                                <!-- Discount Type -->
                                <div class="form-group">
                                    <label class="form-label required">Tipe Diskon</label>
                                    <select name="tipe_diskon" id="tipeDiskon" class="form-select" required>
                                        <option value="">Pilih tipe diskon</option>
                                        <option value="persentase" <?= (isset($promoEdit) && $promoEdit['tipe_diskon'] === 'persentase') ? 'selected' : '' ?>>Persentase (%)</option>
                                        <option value="nominal" <?= (isset($promoEdit) && $promoEdit['tipe_diskon'] === 'nominal') ? 'selected' : '' ?>>Nominal (Rp)</option>
                                    </select>
                                </div>

                                <!-- Discount Value -->
                                <div class="form-group">
                                    <label class="form-label required">Nilai Diskon</label>
                                    <div class="discount-input-group">
                                        <input type="number" name="nilai_diskon" id="nilaiDiskon" class="form-input" 
                                               placeholder="0" min="0" step="0.01"
                                               value="<?= isset($promoEdit) ? esc($promoEdit['nilai_diskon']) : '' ?>" required>
                                        <span class="discount-suffix" id="discountSuffix">%</span>
                                    </div>
                                </div>

                                <!-- Target Type -->
                                <div class="form-group full-width">
                                    <label class="form-label required">Tipe Target</label>
                                    <select name="target_tipe" id="targetTipe" class="form-select" required>
                                        <option value="">Pilih tipe target</option>
                                        <option value="produk" <?= (isset($promoEdit) && ($promoEdit['target_tipe'] ?? 'produk') === 'produk') ? 'selected' : '' ?>>Produk</option>
                                        <option value="kategori" <?= (isset($promoEdit) && ($promoEdit['target_tipe'] ?? '') === 'kategori') ? 'selected' : '' ?>>Kategori</option>
                                        <option value="menu" <?= (isset($promoEdit) && ($promoEdit['target_tipe'] ?? '') === 'menu') ? 'selected' : '' ?>>Menu</option>
                                    </select>
                                </div>

                                <!-- Target Selection (Dynamic based on target_tipe) -->
                                <div class="form-group full-width" id="targetSelection">
                                    <label class="form-label required">Pilih Target</label>
                                    <div id="targetContainer">
                                        <!-- Will be populated by JavaScript -->
                                    </div>
                                </div>

                                <!-- Voucher Code (only for voucher type) -->
                                <div class="form-group" id="voucherCodeGroup" style="display: none;">
                                    <label class="form-label">Kode Voucher</label>
                                    <input type="text" name="kode_voucher" class="form-input" 
                                           placeholder="Kode voucher (kosongkan untuk auto-generate)"
                                           value="<?= isset($promoEdit) ? esc($promoEdit['kode_voucher'] ?? '') : '' ?>">
                                </div>

                                <!-- Limit Stok (Optional) -->
                                <div class="form-group">
                                    <label class="form-label">Limit Stok Promo</label>
                                    <input type="number" name="limit_stok" class="form-input" 
                                           placeholder="Kosongkan jika tidak ada limit"
                                           min="0"
                                           value="<?= isset($promoEdit) ? esc($promoEdit['limit_stok'] ?? '') : '' ?>">
                                    <small style="color: #6B7280; font-size: 12px;">Kosongkan jika tidak ada batasan jumlah</small>
                                </div>

                                <!-- Description -->
                                <div class="form-group full-width">
                                    <label class="form-label">Deskripsi Promo</label>
                                    <textarea name="deskripsi_promo" class="form-textarea" rows="4" placeholder="Jelaskan detail promo, syarat & ketentuan..."><?= isset($promoEdit) ? esc($promoEdit['deskripsi_promo'] ?? '') : '' ?></textarea>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="form-actions">
                                <button type="submit" class="btn-submit">
                                    <img src="<?= base_url('assets/img/pluswhite.png') ?>" alt="Plus">
                                    <span><?= isset($editId) && $editId ? 'Update Promo' : 'Tambah Promo' ?></span>
                                </button>
                                <?php if (isset($editId) && $editId): ?>
                                    <a href="<?= site_url('admin/promo') ?>" class="btn-cancel">Batal Edit</a>
                                <?php else: ?>
                                    <button type="button" class="btn-cancel" onclick="document.getElementById('promoForm').reset()">Batal</button>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Sidebar Toggle Script - Centralized -->
    <script src="<?= base_url('assets/js/sidebar.js') ?>"></script>
    
    <script>
        // Promo Form Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const tipeDiskon = document.getElementById('tipeDiskon');
            const nilaiDiskon = document.getElementById('nilaiDiskon');
            const discountSuffix = document.getElementById('discountSuffix');
            const targetTipe = document.getElementById('targetTipe');
            const targetContainer = document.getElementById('targetContainer');
            const tipePromo = document.getElementById('tipePromo');
            const voucherCodeGroup = document.getElementById('voucherCodeGroup');

            // Data untuk target selection
            const produkData = <?= json_encode($produk ?? []) ?>;
            const kategoriData = <?= json_encode($kategori ?? []) ?>;
            const menuData = <?= json_encode($menu ?? []) ?>;

            // Edit mode data
            const promoEdit = <?= json_encode($promoEdit ?? null) ?>;

            // Handle discount type change
            if (tipeDiskon) {
                tipeDiskon.addEventListener('change', function() {
                    if (this.value === 'persentase') {
                        discountSuffix.textContent = '%';
                        nilaiDiskon.step = '0.01';
                    } else {
                        discountSuffix.textContent = 'Rp';
                        nilaiDiskon.step = '1';
                    }
                });
            }

            // Handle promo type change (show/hide voucher code)
            if (tipePromo) {
                tipePromo.addEventListener('change', function() {
                    if (this.value === 'voucher') {
                        voucherCodeGroup.style.display = 'block';
                    } else {
                        voucherCodeGroup.style.display = 'none';
                    }
                });
                
                // Trigger on load
                if (tipePromo.value === 'voucher') {
                    voucherCodeGroup.style.display = 'block';
                }
            }

            // Function to render target selection
            function renderTargetSelection(tipe) {
            targetContainer.innerHTML = '';
            
            if (tipe === 'produk') {
                const container = document.createElement('div');
                container.className = 'product-select-list';
                container.style.cssText = 'max-height: 300px; overflow-y: auto; border: 1px solid #E5E7EB; border-radius: 8px; padding: 12px;';
                
                produkData.forEach(produk => {
                    const item = document.createElement('div');
                    item.className = 'product-checkbox-item';
                    item.style.cssText = 'display: flex; align-items: center; gap: 8px; padding: 8px;';
                    
                    const checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.name = 'target_produk[]';
                    checkbox.value = produk.id_produk;
                    checkbox.id = 'produk-' + produk.id_produk;
                    
                    // Check if in edit mode
                    if (promoEdit && promoEdit.target_produk_array && promoEdit.target_produk_array.includes(produk.id_produk)) {
                        checkbox.checked = true;
                    }
                    
                    const label = document.createElement('label');
                    label.htmlFor = 'produk-' + produk.id_produk;
                    label.textContent = produk.nama_produk;
                    label.style.cssText = 'cursor: pointer; flex: 1;';
                    
                    item.appendChild(checkbox);
                    item.appendChild(label);
                    container.appendChild(item);
                });
                
                targetContainer.appendChild(container);
            } else if (tipe === 'kategori') {
                const container = document.createElement('div');
                container.className = 'kategori-select-list';
                container.style.cssText = 'max-height: 300px; overflow-y: auto; border: 1px solid #E5E7EB; border-radius: 8px; padding: 12px;';
                
                kategoriData.forEach(kat => {
                    const item = document.createElement('div');
                    item.className = 'kategori-checkbox-item';
                    item.style.cssText = 'display: flex; align-items: center; gap: 8px; padding: 8px;';
                    
                    const checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.name = 'target_kategori[]';
                    checkbox.value = kat.id_kategori;
                    checkbox.id = 'kategori-' + kat.id_kategori;
                    
                    // Check if in edit mode
                    if (promoEdit && promoEdit.target_kategori_array && promoEdit.target_kategori_array.includes(kat.id_kategori)) {
                        checkbox.checked = true;
                    }
                    
                    const label = document.createElement('label');
                    label.htmlFor = 'kategori-' + kat.id_kategori;
                    label.textContent = kat.nama_kategori;
                    label.style.cssText = 'cursor: pointer; flex: 1;';
                    
                    item.appendChild(checkbox);
                    item.appendChild(label);
                    container.appendChild(item);
                });
                
                targetContainer.appendChild(container);
            } else if (tipe === 'menu') {
                const container = document.createElement('div');
                container.className = 'menu-select-list';
                container.style.cssText = 'max-height: 300px; overflow-y: auto; border: 1px solid #E5E7EB; border-radius: 8px; padding: 12px;';
                
                menuData.forEach(menu => {
                    const item = document.createElement('div');
                    item.className = 'menu-checkbox-item';
                    item.style.cssText = 'display: flex; align-items: center; gap: 8px; padding: 8px;';
                    
                    const checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.name = 'target_menu[]';
                    checkbox.value = menu.id_menu;
                    checkbox.id = 'menu-' + menu.id_menu;
                    
                    // Check if in edit mode
                    if (promoEdit && promoEdit.target_menu_array && promoEdit.target_menu_array.includes(menu.id_menu)) {
                        checkbox.checked = true;
                    }
                    
                    const label = document.createElement('label');
                    label.htmlFor = 'menu-' + menu.id_menu;
                    label.textContent = menu.nama_menu;
                    label.style.cssText = 'cursor: pointer; flex: 1;';
                    
                    item.appendChild(checkbox);
                    item.appendChild(label);
                    container.appendChild(item);
                });
                
                targetContainer.appendChild(container);
            }
        }

            // Handle target type change
            if (targetTipe) {
                targetTipe.addEventListener('change', function() {
                    renderTargetSelection(this.value);
                });
                
                // Load initial target selection if in edit mode
                if (promoEdit && promoEdit.target_tipe) {
                    renderTargetSelection(promoEdit.target_tipe);
                } else if (targetTipe.value) {
                    renderTargetSelection(targetTipe.value);
                }
            }

            // Initialize discount suffix on load
            if (tipeDiskon && tipeDiskon.value) {
                tipeDiskon.dispatchEvent(new Event('change'));
            }
        }); // End of DOMContentLoaded
    </script>
</body>

</html>

