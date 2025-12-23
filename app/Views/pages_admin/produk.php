<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk - ISBCOMMERCE</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard.css') ?>">
    <style>
        .products-page {
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

        .products-section {
            background: #FFFFFF;
            border-radius: 12px;
            border: 1px solid #E5E7EB;
            padding: clamp(16px, 2vw, 24px);
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

        .filters {
            display: flex;
            gap: 12px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .search-filter {
            flex: 1;
            min-width: 200px;
            position: relative;
        }

        .filter-input {
            width: 100%;
            height: 44px;
            padding: 0 16px 0 44px;
            border: 1px solid #D1D5DB;
            border-radius: 8px;
            font-size: 14px;
            color: #111827;
        }

        .filter-input:focus {
            outline: none;
            border-color: #2563EB;
        }

        .filter-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            width: 16px;
            height: 16px;
            color: #9CA3AF;
            pointer-events: none;
        }

        .filter-select {
            min-width: 160px;
            height: 44px;
            padding: 0 16px;
            border: 1px solid #D1D5DB;
            border-radius: 8px;
            font-size: 14px;
            color: #111827;
            background: #FFFFFF;
            cursor: pointer;
        }

        .filter-select:focus {
            outline: none;
            border-color: #2563EB;
        }

        .table-container {
            overflow-x: auto;
            overflow-y: auto;
            max-height: 600px;
            -webkit-overflow-scrolling: touch;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table thead {
            background: #F9FAFB;
        }

        .data-table th {
            padding: 12px 16px;
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            color: #6B7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #E5E7EB;
            white-space: nowrap;
        }

        .data-table td {
            padding: 16px;
            border-bottom: 1px solid #E5E7EB;
            font-size: 14px;
            color: #111827;
        }

        .data-table tbody tr:hover {
            background: #F9FAFB;
        }

        .product-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .product-image {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: #E5E7EB;
            flex-shrink: 0;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-info {
            flex: 1;
            min-width: 0;
        }

        .product-name {
            font-weight: 600;
            color: #111827;
            margin-bottom: 4px;
            font-size: 14px;
        }

        .product-sku {
            font-size: 12px;
            color: #6B7280;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .action-btn {
            width: 40px;
            height: 40px;
            border: none;
            background: transparent;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer !important;
            transition: background 0.2s;
            pointer-events: auto !important;
            position: relative;
            z-index: 10;
        }

        .action-btn:hover {
            background: #F3F4F6;
        }

        .action-btn img,
        .action-btn svg {
            width: 16px;
            height: 20px;
            object-fit: contain;
            pointer-events: none;
        }


        .btn-primary {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 24px;
            background: #2563EB;
            color: #FFFFFF;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            line-height: 1.21;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-primary:hover {
            background: #1D4ED8;
        }

        .btn-primary img {
            width: 14px;
            height: 14px;
            object-fit: contain;
        }

        .image-preview-container {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 16px;
        }

        .file-preview-item {
            position: relative;
            width: 200px;
            height: 200px;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #E5E7EB;
        }

        .file-preview-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .remove-btn {
            position: absolute;
            top: 4px;
            right: 4px;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: rgba(0, 0, 0, 0.6);
            color: white;
            border: none;
            cursor: pointer;
            font-size: 18px;
            line-height: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .remove-btn:hover {
            background: rgba(0, 0, 0, 0.8);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .products-page {
                padding: 16px;
            }

            .section-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .filters {
                flex-direction: column;
            }

            .search-filter,
            .filter-select {
                width: 100%;
            }

            .data-table {
                font-size: 12px;
            }

            .data-table th,
            .data-table td {
                padding: 12px 8px;
            }

            .product-cell {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }

        }

        @media (max-width: 390px) {
            .products-page {
                padding: 12px;
            }

            .page-title {
                font-size: 20px;
            }

            .data-table th,
            .data-table td {
                padding: 8px 4px;
                font-size: 11px;
            }

            .product-image {
                width: 40px;
                height: 40px;
            }

            .action-btn {
                width: 32px;
                height: 32px;
            }

            .action-btn img {
                width: 14px;
                height: 18px;
            }
        }

        /* Add Product Form Styles */
        .add-product-section {
            background: #FFFFFF;
            border-radius: 12px;
            border: 1px solid #E5E7EB;
            padding: clamp(20px, 2.5vw, 32px);
            margin-top: 32px;
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
        .form-textarea,
        .form-select {
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
        .form-textarea:focus,
        .form-select:focus {
            outline: none;
            border-color: #2563EB;
        }

        .form-textarea {
            min-height: 120px;
            resize: vertical;
        }

        .form-input::placeholder,
        .form-textarea::placeholder {
            color: #9CA3AF;
        }

        .price-input-group {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .price-prefix {
            font-size: 14px;
            font-weight: 500;
            color: #374151;
        }

        .dimensions-group {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }

        .dimension-input {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .dimension-label {
            font-size: 12px;
            color: #6B7280;
        }

        .upload-area {
            border: 2px dashed #D1D5DB;
            border-radius: 8px;
            padding: 32px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            background: #F9FAFB;
        }

        .upload-area:hover {
            border-color: #2563EB;
            background: #EFF6FF;
        }

        .upload-area.dragover {
            border-color: #2563EB;
            background: #EFF6FF;
        }

        .upload-icon {
            width: 48px;
            height: 48px;
            margin: 0 auto 16px;
            color: #9CA3AF;
        }

        .upload-text {
            font-size: 14px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 8px;
        }

        .upload-hint {
            font-size: 12px;
            color: #6B7280;
        }

        .radio-group {
            display: flex;
            gap: 24px;
            flex-wrap: wrap;
        }

        .radio-option {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .radio-option input[type="radio"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .radio-option label {
            font-size: 14px;
            color: #374151;
            cursor: pointer;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .checkbox-group input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .checkbox-group label {
            font-size: 14px;
            color: #374151;
            cursor: pointer;
        }

        .form-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: clamp(24px, 3vw, 32px);
            gap: 16px;
            flex-wrap: wrap;
        }

        .form-actions-left {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            align-items: center;
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
            width: 16px;
            height: 16px;
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

        .btn-preview {
            display: flex;
            align-items: center;
            gap: 8px;
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

        .btn-preview:hover {
            background: #E5E7EB;
        }

        .btn-preview svg {
            width: 16px;
            height: 16px;
        }

        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .dimensions-group {
                grid-template-columns: 1fr;
            }

            .form-actions {
                flex-direction: column;
                align-items: stretch;
            }

            .form-actions-left {
                width: 100%;
                flex-direction: column;
                gap: 8px;
            }

            .btn-submit,
            .btn-cancel,
            .btn-preview,
            .form-actions-left a {
                width: 100%;
                justify-content: center;
                display: flex;
                align-items: center;
            }
        }

        @media (max-width: 390px) {
            .add-product-section {
                padding: 16px;
                margin-top: 24px;
            }

            .form-title {
                font-size: 18px;
            }

            .upload-area {
                padding: 24px 16px;
            }

            .upload-icon {
                width: 40px;
                height: 40px;
            }

            .radio-group {
                flex-direction: column;
                gap: 12px;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <?= view('layout/sidebar_admin', ['activeMenu' => 'produk']) ?>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            <header class="dashboard-header">
                <button class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle sidebar" type="button">
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

            <!-- Products Page Content -->
            <main class="dashboard-main">
                <div class="products-page">
                    <div class="page-header">
                        <h1 class="page-title">Manajemen Produk</h1>
                        <p class="page-subtitle">Kelola semua produk di toko Anda</p>
                    </div>

                    <?php if (session()->getFlashdata('success')): ?>
                        <div style="background: #D1FAE5; color: #065F46; padding: 12px 16px; border-radius: 8px; margin-bottom: 24px;">
                            <?= session()->getFlashdata('success') ?>
                        </div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('error')): ?>
                        <div style="background: #FEE2E2; color: #991B1B; padding: 12px 16px; border-radius: 8px; margin-bottom: 24px;">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('errors')): ?>
                        <div style="background: #FEE2E2; color: #991B1B; padding: 12px 16px; border-radius: 8px; margin-bottom: 24px;">
                            <ul style="margin: 0; padding-left: 20px;">
                                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <div class="products-section">
                        <div class="section-header">
                            <div class="section-title-group">
                                <h2>Daftar Produk</h2>
                                <p>Total: <?= number_format($totalProduk ?? 0, 0, ',', '.') ?> produk</p>
                            </div>
                            <button class="btn-primary" onclick="document.getElementById('addProductForm').scrollIntoView({behavior: 'smooth'})">
                                <img src="<?= base_url('assets/img/pluswhite.png') ?>" alt="Tambah Produk">
                                <span>Tambah Produk</span>
                            </button>
                        </div>

                        <form method="get" action="<?= base_url('admin/produk') ?>" class="filters" id="filterForm">
                            <div class="search-filter">
                                <input type="text" name="search" id="searchInput" placeholder="Cari produk..." class="filter-input" value="<?= esc($search ?? '') ?>" onkeypress="if(event.key === 'Enter') { event.preventDefault(); document.getElementById('filterForm').submit(); }">
                                <svg width="16" height="24" viewBox="0 0 16 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="filter-icon" style="cursor: pointer;" onclick="document.getElementById('filterForm').submit();">
                                    <path
                                        d="M7 14C10.866 14 14 10.866 14 7C14 3.13401 10.866 0 7 0C3.13401 0 0 3.13401 0 7C0 10.866 3.13401 14 7 14Z"
                                        stroke="currentColor" stroke-width="2" />
                                    <path d="M13 13L19 19" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" />
                                </svg>
                            </div>
                            <select name="kategori" class="filter-select" onchange="this.form.submit()">
                                <option value="all">Semua Kategori</option>
                                <?php if (!empty($kategori)): ?>
                                    <?php foreach ($kategori as $kat): ?>
                                        <option value="<?= $kat['id_kategori'] ?>" <?= (isset($filterKategori) && $filterKategori == $kat['id_kategori']) ? 'selected' : '' ?>>
                                            <?= esc($kat['nama_kategori']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <select name="menu" class="filter-select" onchange="this.form.submit()">
                                <option value="all">Semua Menu</option>
                                <?php if (!empty($menu)): ?>
                                    <?php foreach ($menu as $m): ?>
                                        <option value="<?= $m['id_menu'] ?>" <?= (isset($filterMenu) && $filterMenu == $m['id_menu']) ? 'selected' : '' ?>>
                                            <?= esc($m['nama_menu']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <select name="status" class="filter-select" onchange="this.form.submit()">
                                <option value="all">Semua Status</option>
                                <option value="aktif" <?= (isset($filterStatus) && $filterStatus == 'aktif') ? 'selected' : '' ?>>Aktif</option>
                                <option value="tidak_aktif" <?= (isset($filterStatus) && $filterStatus == 'tidak_aktif') ? 'selected' : '' ?>>Tidak Aktif</option>
                                <option value="draft" <?= (isset($filterStatus) && $filterStatus == 'draft') ? 'selected' : '' ?>>Draft</option>
                            </select>
                        </form>

                        <div class="table-container">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Produk</th>
                                        <th>Kategori</th>
                                        <th>Menu</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($produk)): ?>
                                        <?php $no = 1; foreach ($produk as $p): ?>
                                            <?php
                                            // Get product image from database (from produk table)
                                            $fotoUtama = null;
                                            // Get gambar urutan 1 (gambar inti) dari JSON
                                            $fotoUtama = base_url('assets/img/product.png'); // Default fallback
                                            if (!empty($p['gambar_produk'])) {
                                                $decoded = json_decode($p['gambar_produk'], true);
                                                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded) && !empty($decoded)) {
                                                    // Ambil gambar pertama (urutan 1 - gambar inti)
                                                    $fotoPath = $decoded[0];
                                                    $fotoPath = ltrim($fotoPath, '/');
                                                    $fotoUtama = base_url($fotoPath);
                                                } else {
                                                    // Fallback: jika bukan JSON, anggap sebagai single image
                                                    $fotoPath = $p['gambar_produk'];
                                                    $fotoPath = ltrim($fotoPath, '/');
                                                    $fotoUtama = base_url($fotoPath);
                                                }
                                            }
                                            
                                            // Fallback jika tidak ada gambar
                                            if (empty($p['gambar_produk'])) {
                                                // No image in database - use placeholder
                                                $fotoUtama = base_url('assets/img/product.png');
                                            }
                                            ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td>
                                                    <div class="product-cell">
                                                        <div class="product-image">
                                                            <img src="<?= $fotoUtama ?>" alt="<?= esc($p['nama_produk']) ?>" onerror="this.src='<?= base_url('assets/img/product.png') ?>'">
                                                        </div>
                                                        <div class="product-info">
                                                            <p class="product-name"><?= esc($p['nama_produk']) ?></p>
                                                            <p class="product-sku">SKU: <?= esc($p['sku'] ?? '-') ?></p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><?= esc($p['nama_kategori'] ?? '-') ?></td>
                                                <td><?= esc($p['nama_menu'] ?? '-') ?></td>
                                                <td>
                                                    <?php if ($p['harga_setelah_diskon'] > 0 && $p['harga_setelah_diskon'] < $p['harga_awal']): ?>
                                                        <span style="text-decoration: line-through; color: #9CA3AF; font-size: 12px;">Rp <?= number_format($p['harga_awal'], 0, ',', '.') ?></span><br>
                                                        <span style="color: #DC2626; font-weight: 600;">Rp <?= number_format($p['harga_setelah_diskon'], 0, ',', '.') ?></span>
                                                    <?php else: ?>
                                                        Rp <?= number_format($p['harga_awal'], 0, ',', '.') ?>
                                                    <?php endif; ?>
                                                </td>
                                                <td style="<?= ($p['stok'] < 10) ? 'color: #DC2626;' : '' ?>"><?= $p['stok'] ?></td>
                                                <td>
                                                    <div class="action-buttons">
                                                        <button class="action-btn" onclick="editProduk(<?= $p['id_produk'] ?>)">
                                                            <img src="<?= base_url('assets/img/icon-edit.png') ?>" alt="Edit">
                                                        </button>
                                                        <button class="action-btn" onclick="previewProduk(<?= $p['id_produk'] ?>)">
                                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12C23 12 19 20 12 20C5 20 1 12 1 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"/>
                                                            </svg>
                                                        </button>
                                                        <button class="action-btn" onclick="hapusProduk(<?= $p['id_produk'] ?>)">
                                                            <img src="<?= base_url('assets/img/icon-tongsampah.png') ?>" alt="Hapus">
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="7" style="text-align: center; padding: 40px; color: #6B7280;">
                                                Belum ada produk. Silakan tambah produk baru.
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Add/Edit Product Form Section -->
                    <div class="add-product-section">
                        <div class="form-header">
                            <h2 class="form-title"><?= isset($editId) && $editId ? 'Edit Produk' : 'Tambah Produk Baru' ?></h2>
                            <p class="form-subtitle"><?= isset($editId) && $editId ? 'Ubah informasi produk yang ada' : 'Lengkapi informasi produk yang akan ditambahkan' ?></p>
                        </div>

                        <form id="addProductForm" action="<?= isset($editId) && $editId ? base_url('admin/update_produk/' . $editId) : base_url('admin/simpan_produk') ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="form-grid">
                                <!-- Gambar Inti (Urutan 1) - Hanya 1 gambar -->
                                <div class="form-group full-width">
                                    <label class="form-label required">Gambar Inti Produk <span style="color: #6B7280; font-weight: normal;">(Gambar utama untuk tampilan produk)</span></label>
                                    <div class="upload-area" id="uploadAreaInti">
                                        <svg class="upload-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7 18C4.23858 18 2 15.7614 2 13C2 10.2386 4.23858 8 7 8C7.35138 8 7.68838 8.03357 8.01116 8.09569C8.54744 6.13037 10.3453 4.75 12.5 4.75C15.1234 4.75 17.25 6.87665 17.25 9.5C17.25 9.77614 17.2239 10.0458 17.1746 10.3069C18.4659 10.9846 19.25 12.3515 19.25 13.875C19.25 16.1868 17.4368 18 15.125 18H7Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M12 8V16M8 12H16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        </svg>
                                        <p class="upload-text">Klik untuk upload atau drag & drop</p>
                                        <p class="upload-hint">PNG, JPG, GIF hingga 10MB (Hanya 1 gambar)</p>
                                        <input type="file" id="productImageInti" name="gambar_inti" accept="image/*" style="display: none;">
                                        <div id="imagePreviewInti" class="image-preview-container"></div>
                                    </div>
                                </div>

                                <!-- Gambar Pendukung (Urutan 2, 3, 4, dst) - Multiple gambar -->
                                <div class="form-group full-width">
                                    <label class="form-label">Gambar Pendukung Produk <span style="color: #6B7280; font-weight: normal;">(Gambar tambahan, opsional)</span></label>
                                    <div class="upload-area" id="uploadAreaPendukung">
                                        <svg class="upload-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7 18C4.23858 18 2 15.7614 2 13C2 10.2386 4.23858 8 7 8C7.35138 8 7.68838 8.03357 8.01116 8.09569C8.54744 6.13037 10.3453 4.75 12.5 4.75C15.1234 4.75 17.25 6.87665 17.25 9.5C17.25 9.77614 17.2239 10.0458 17.1746 10.3069C18.4659 10.9846 19.25 12.3515 19.25 13.875C19.25 16.1868 17.4368 18 15.125 18H7Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M12 8V16M8 12H16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        </svg>
                                        <p class="upload-text">Klik untuk upload atau drag & drop</p>
                                        <p class="upload-hint">PNG, JPG, GIF hingga 10MB (Bisa multiple gambar)</p>
                                        <input type="file" id="productImagePendukung" name="gambar_pendukung[]" accept="image/*" style="display: none;" multiple>
                                        <div id="imagePreviewPendukung" class="image-preview-container"></div>
                                    </div>
                                </div>

                                <!-- Product Name -->
                                <div class="form-group full-width">
                                    <label class="form-label required">Nama Produk</label>
                                    <input type="text" name="nama_produk" id="nama_produk" class="form-input" placeholder="Masukkan nama produk" value="<?= isset($produkEdit) && $produkEdit ? esc($produkEdit['nama_produk']) : '' ?>" required>
                                </div>

                                <!-- Product Description -->
                                <div class="form-group full-width">
                                    <label class="form-label">Deskripsi Produk</label>
                                    <textarea name="deskripsi_produk" id="deskripsi_produk" class="form-textarea" placeholder="Jelaskan detail produk Anda..."><?= isset($produkEdit) && $produkEdit ? esc($produkEdit['deskripsi_produk']) : '' ?></textarea>
                                </div>

                                <!-- Category -->
                                <div class="form-group">
                                    <label class="form-label required">Kategori</label>
                                    <select name="id_kategori" id="id_kategori" class="form-select" required onchange="loadMenuByKategori(this.value)">
                                        <option value="">Pilih kategori</option>
                                        <?php if (!empty($kategori)): ?>
                                            <?php foreach ($kategori as $kat): ?>
                                                <option value="<?= $kat['id_kategori'] ?>" <?= (isset($produkEdit) && $produkEdit && $produkEdit['id_kategori'] == $kat['id_kategori']) ? 'selected' : '' ?>><?= esc($kat['nama_kategori']) ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>

                                <!-- Menu -->
                                <div class="form-group">
                                    <label class="form-label">Menu</label>
                                    <select name="id_menu" id="id_menu" class="form-select">
                                        <option value="">Pilih menu</option>
                                        <?php if (!empty($menuByKategori)): ?>
                                            <?php foreach ($menuByKategori as $menuItem): ?>
                                                <option value="<?= $menuItem['id_menu'] ?>" <?= (isset($produkEdit) && $produkEdit && isset($produkEdit['id_menu']) && $produkEdit['id_menu'] == $menuItem['id_menu']) ? 'selected' : '' ?>><?= esc($menuItem['nama_menu']) ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>

                                <!-- Brand -->
                                <div class="form-group">
                                    <label class="form-label">Merek</label>
                                    <input type="text" name="merek" id="merek" class="form-input" placeholder="Masukkan merek produk" value="<?= isset($produkEdit) && $produkEdit ? esc($produkEdit['merek'] ?? '') : '' ?>">
                                </div>

                                <!-- Harga Awal -->
                                <div class="form-group">
                                    <label class="form-label required">Harga Awal</label>
                                    <div class="price-input-group">
                                        <span class="price-prefix">Rp</span>
                                        <input type="number" id="harga_awal" name="harga_awal" class="form-input" placeholder="0" value="<?= isset($produkEdit) && $produkEdit ? $produkEdit['harga_awal'] : '0' ?>" min="0" required oninput="calculateHargaSetelahDiskon()">
                                    </div>
                                </div>

                                <!-- Promo Selection -->
                                <div class="form-group">
                                    <label class="form-label">Promo (Opsional)</label>
                                    <select name="id_promo" id="id_promo" class="form-select" onchange="loadPromoDetail(this.value)">
                                        <option value="">Pilih promo</option>
                                        <?php if (!empty($promo)): ?>
                                            <?php foreach ($promo as $pr): ?>
                                                <option value="<?= $pr['id_promo'] ?>" data-tipe="<?= $pr['tipe_diskon'] ?>" data-nilai="<?= $pr['nilai_diskon'] ?>" <?= (isset($produkEdit) && $produkEdit && $produkEdit['id_promo'] == $pr['id_promo']) ? 'selected' : '' ?>>
                                                    <?= esc($pr['nama_promo']) ?> (<?= $pr['tipe_diskon'] == 'persentase' ? $pr['nilai_diskon'] . '%' : 'Rp ' . number_format($pr['nilai_diskon'], 0, ',', '.') ?>)
                                                </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>

                                <!-- Discount Type -->
                                <div class="form-group">
                                    <label class="form-label">Tipe Diskon</label>
                                    <select name="tipe_diskon" id="tipe_diskon" class="form-select" onchange="calculateHargaSetelahDiskon()">
                                        <option value="persentase" <?= (isset($produkEdit) && $produkEdit && ($produkEdit['tipe_diskon'] ?? 'persentase') == 'persentase') || !isset($produkEdit) ? 'selected' : '' ?>>Persentase (%)</option>
                                        <option value="nominal" <?= isset($produkEdit) && $produkEdit && ($produkEdit['tipe_diskon'] ?? '') == 'nominal' ? 'selected' : '' ?>>Nominal (Rp)</option>
                                    </select>
                                </div>

                                <!-- Discount Price -->
                                <div class="form-group">
                                    <label class="form-label">Harga Diskon</label>
                                    <div class="price-input-group">
                                        <span class="price-prefix" id="diskon_prefix">%</span>
                                        <input type="number" id="harga_diskon" name="harga_diskon" class="form-input" placeholder="0" value="<?= isset($produkEdit) && $produkEdit ? $produkEdit['harga_diskon'] : '0' ?>" min="0" oninput="calculateHargaSetelahDiskon()">
                                    </div>
                                </div>

                                <!-- Harga Setelah Diskon (Read-only) -->
                                <div class="form-group">
                                    <label class="form-label">Harga Setelah Diskon</label>
                                    <div class="price-input-group">
                                        <span class="price-prefix">Rp</span>
                                        <input type="text" id="harga_setelah_diskon" class="form-input" readonly style="background-color: #F3F4F6; font-weight: 600; color: #DC2626;" value="<?= isset($produkEdit) && $produkEdit ? number_format($produkEdit['harga_setelah_diskon'] ?? 0, 0, ',', '.') : '0' ?>">
                                    </div>
                                </div>

                                <!-- Stock -->
                                <div class="form-group">
                                    <label class="form-label required">Stok</label>
                                    <input type="number" name="stok" id="stok" class="form-input" placeholder="0" value="<?= isset($produkEdit) && $produkEdit ? $produkEdit['stok'] : '0' ?>" min="0" required>
                                </div>

                                <!-- SKU -->
                                <div class="form-group">
                                    <label class="form-label">SKU</label>
                                    <input type="text" name="sku" id="sku" class="form-input" placeholder="SKU-001" value="<?= isset($produkEdit) && $produkEdit ? esc($produkEdit['sku']) : 'SKU-' . str_pad((($totalProduk ?? 0) + 1), 3, '0', STR_PAD_LEFT) ?>">
                                </div>

                                <!-- Weight -->
                                <div class="form-group">
                                    <label class="form-label">Berat (gram)</label>
                                    <input type="number" name="berat" id="berat" class="form-input" placeholder="0" value="<?= isset($produkEdit) && $produkEdit ? $produkEdit['berat'] : '0' ?>" min="0">
                                </div>

                                <!-- Product Status -->
                                <div class="form-group full-width">
                                    <label class="form-label">Status Produk</label>
                                    <div class="radio-group">
                                        <div class="radio-option">
                                            <input type="radio" id="status-aktif" name="status_produk" value="aktif" <?= (isset($produkEdit) && $produkEdit && $produkEdit['status_produk'] == 'aktif') || !isset($produkEdit) ? 'checked' : '' ?>>
                                            <label for="status-aktif">Aktif</label>
                                        </div>
                                        <div class="radio-option">
                                            <input type="radio" id="status-draft" name="status_produk" value="draft" <?= isset($produkEdit) && $produkEdit && $produkEdit['status_produk'] == 'draft' ? 'checked' : '' ?>>
                                            <label for="status-draft">Draft</label>
                                        </div>
                                        <div class="radio-option">
                                            <input type="radio" id="status-tidak-aktif" name="status_produk" value="tidak_aktif" <?= isset($produkEdit) && $produkEdit && $produkEdit['status_produk'] == 'tidak_aktif' ? 'checked' : '' ?>>
                                            <label for="status-tidak-aktif">Tidak Aktif</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Varian Produk -->
                                <div class="form-group full-width">
                                    <div class="checkbox-group" style="margin-bottom: 16px;">
                                        <input type="checkbox" id="enableVarian" onchange="toggleVarianSection(this.checked)">
                                        <label for="enableVarian">Gunakan Varian Produk</label>
                                    </div>
                                    
                                    <div id="varianSection" style="display: none; margin-top: 16px;">
                                        <div id="varianList">
                                            <!-- Varian items will be added here dynamically -->
                                        </div>
                                        <button type="button" onclick="addVarianRow()" style="display: flex; align-items: center; gap: 8px; margin-top: 12px; padding: 8px 16px; background: #2563EB; color: white; border: none; border-radius: 8px; cursor: pointer; font-size: 14px; font-weight: 500;">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 5V19M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <span>Tambah Varian</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="form-actions">
                                <div class="form-actions-left">
                                    <button type="submit" class="btn-submit">
                                        <img src="<?= base_url('assets/img/pluswhite.png') ?>" alt="Plus">
                                        <span><?= isset($editId) && $editId ? 'Update Produk' : 'Tambah Produk' ?></span>
                                    </button>
                                    <?php if (isset($editId) && $editId): ?>
                                        <a href="<?= base_url('admin/produk') ?>" class="btn-cancel" style="text-decoration: none; display: inline-flex; align-items: center;">Batal Edit</a>
                                    <?php else: ?>
                                        <button type="button" class="btn-cancel" onclick="clearProductForm()">Batal</button>
                                    <?php endif; ?>
                                </div>
                                <button type="button" class="btn-preview" onclick="previewFormProduk()">
                                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12C23 12 19 20 12 20C5 20 1 12 1 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"/>
                                    </svg>
                                    <span>Preview</span>
                                </button>
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
        // ====================================================================
        // FUNGSI AKSI PRODUK (Edit, Preview, Hapus) - LOAD FIRST
        // ====================================================================
        // Pastikan fungsi ini tersedia segera, sebelum DOM ready
        window.editProduk = function(id) {
            if (!id) {
                alert('ID produk tidak valid');
                return false;
            }
            window.location.href = '<?= base_url('admin/produk') ?>?edit=' + id;
            return false;
        };

        window.hapusProduk = function(id) {
            if (!id) {
                alert('ID produk tidak valid');
                return false;
            }
            if (confirm('Apakah Anda yakin ingin menghapus produk ini?')) {
                window.location.href = '<?= base_url('admin/hapus_produk') ?>/' + id;
            }
            return false;
        };

        window.previewProduk = function(id) {
            if (!id) {
                alert('ID produk tidak valid');
                return false;
            }
            window.open('<?= base_url('admin/preview_produk') ?>/' + id, '_blank');
            return false;
        };
    </script>
    
    <script>

        // Load menu and data on page load if editing
        <?php if (isset($produkEdit) && $produkEdit && !empty($produkEdit['id_kategori'])): ?>
        window.addEventListener('load', function() {
            const kategoriId = document.getElementById('id_kategori').value;
            if (kategoriId) {
                loadMenuByKategori(kategoriId);
            }
            
            // Load promo if exists
            <?php if (!empty($produkEdit['id_promo'])): ?>
            const promoSelect = document.getElementById('id_promo');
            if (promoSelect) {
                promoSelect.value = <?= $produkEdit['id_promo'] ?>;
                loadPromoDetail(<?= $produkEdit['id_promo'] ?>);
            }
            <?php endif; ?>
            
            // Set tipe diskon
            const tipeDiskon = document.getElementById('tipe_diskon');
            if (tipeDiskon && '<?= $produkEdit['tipe_diskon'] ?? 'persentase' ?>') {
                tipeDiskon.value = '<?= $produkEdit['tipe_diskon'] ?? 'persentase' ?>';
                updateDiskonPrefix();
                calculateHargaSetelahDiskon();
            }
            
            // Load existing images from JSON gambar_produk
            <?php if (!empty($produkEdit['fotos'])): ?>
            const previewContainer = document.getElementById('imagePreview');
            if (previewContainer) {
                <?php foreach ($produkEdit['fotos'] as $index => $foto): ?>
                const existingImg<?= $index ?> = document.createElement('div');
                existingImg<?= $index ?>.className = 'file-preview-item';
                existingImg<?= $index ?>.setAttribute('data-existing-image', '<?= $foto['foto_produk'] ?>');
                existingImg<?= $index ?>.innerHTML = `
                    <img src="<?= base_url($foto['foto_produk']) ?>" alt="Preview">
                    <button type="button" class="remove-btn" onclick="removeExistingImage(this, '<?= $foto['foto_produk'] ?>')">×</button>
                `;
                previewContainer.appendChild(existingImg<?= $index ?>);
                <?php endforeach; ?>
            }
            <?php endif; ?>
        });
        <?php endif; ?>

        // ====================================================================
        // FILE UPLOAD FUNCTIONALITY - GAMBAR INTI (Urutan 1, hanya 1 gambar)
        // ====================================================================
        const uploadAreaInti = document.getElementById('uploadAreaInti');
        const productImageInti = document.getElementById('productImageInti');
        const imagePreviewContainerInti = document.getElementById('imagePreviewInti');
        let selectedFileInti = null;

        // Load existing gambar inti (urutan 1) if in edit mode
        <?php if (isset($produkEdit) && $produkEdit && !empty($produkEdit['fotos'])): ?>
        const gambarInti = <?= json_encode(isset($produkEdit['fotos'][0]) ? $produkEdit['fotos'][0] : null) ?>;
        if (gambarInti && imagePreviewContainerInti) {
            const existingImgInti = document.createElement('div');
            existingImgInti.className = 'file-preview-item';
            existingImgInti.setAttribute('data-existing-image', gambarInti.foto_produk);
            existingImgInti.innerHTML = `
                <img src="<?= base_url() ?>${gambarInti.foto_produk}" alt="Gambar Inti">
                <button type="button" class="remove-btn" onclick="removeExistingImageInti(this, '${gambarInti.foto_produk}')">×</button>
            `;
            imagePreviewContainerInti.appendChild(existingImgInti);
        }
        <?php endif; ?>

        if (uploadAreaInti && productImageInti) {
            uploadAreaInti.addEventListener('click', () => {
                productImageInti.click();
            });

            uploadAreaInti.addEventListener('dragover', (e) => {
                e.preventDefault();
                uploadAreaInti.classList.add('dragover');
            });

            uploadAreaInti.addEventListener('dragleave', () => {
                uploadAreaInti.classList.remove('dragover');
            });

            uploadAreaInti.addEventListener('drop', (e) => {
                e.preventDefault();
                uploadAreaInti.classList.remove('dragover');
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    handleFileSelectInti(files[0]); // Hanya ambil file pertama
                }
            });

            productImageInti.addEventListener('change', (e) => {
                if (e.target.files.length > 0) {
                    handleFileSelectInti(e.target.files[0]); // Hanya ambil file pertama
                }
            });
        }

        function handleFileSelectInti(file) {
            if (!imagePreviewContainerInti || !file || !file.type.startsWith('image/')) return;
            
            selectedFileInti = file;
            const reader = new FileReader();
            reader.onload = function(e) {
                // Clear existing preview (only 1 image allowed)
                imagePreviewContainerInti.innerHTML = '';
                
                const previewItem = document.createElement('div');
                previewItem.className = 'file-preview-item';
                previewItem.setAttribute('data-filename', file.name);
                previewItem.setAttribute('data-filesize', file.size);
                previewItem.innerHTML = `
                    <img src="${e.target.result}" alt="Gambar Inti">
                    <button type="button" class="remove-btn" onclick="removePreviewInti(this, '${file.name}', ${file.size})">×</button>
                `;
                imagePreviewContainerInti.appendChild(previewItem);
            };
            reader.readAsDataURL(file);
        }

        function removePreviewInti(btn, filename, filesize) {
            selectedFileInti = null;
            if (productImageInti) {
                productImageInti.value = '';
            }
            if (btn && btn.parentElement) {
                btn.parentElement.remove();
            }
        }

        function removeExistingImageInti(btn, imagePath) {
            if (confirm('Apakah Anda yakin ingin menghapus gambar inti ini? Gambar akan dihapus saat produk diupdate.')) {
                const form = document.getElementById('addProductForm');
                if (form) {
                    const deleteInput = document.createElement('input');
                    deleteInput.type = 'hidden';
                    deleteInput.name = 'delete_gambar_inti';
                    deleteInput.value = imagePath;
                    form.appendChild(deleteInput);
                }
                if (btn && btn.parentElement) {
                    btn.parentElement.remove();
                }
            }
        }

        // ====================================================================
        // FILE UPLOAD FUNCTIONALITY - GAMBAR PENDUKUNG (Urutan 2, 3, 4, dst)
        // ====================================================================
        const uploadAreaPendukung = document.getElementById('uploadAreaPendukung');
        const productImagePendukung = document.getElementById('productImagePendukung');
        const imagePreviewContainerPendukung = document.getElementById('imagePreviewPendukung');
        let selectedFilesPendukung = [];

        // Load existing gambar pendukung (urutan 2+) if in edit mode
        <?php if (isset($produkEdit) && $produkEdit && !empty($produkEdit['fotos']) && count($produkEdit['fotos']) > 1): ?>
        const gambarPendukung = <?= json_encode(array_slice($produkEdit['fotos'], 1)) ?>;
        if (gambarPendukung && imagePreviewContainerPendukung) {
            gambarPendukung.forEach((foto, idx) => {
                const existingImg = document.createElement('div');
                existingImg.className = 'file-preview-item';
                existingImg.setAttribute('data-existing-image', foto.foto_produk);
                existingImg.innerHTML = `
                    <img src="<?= base_url() ?>${foto.foto_produk}" alt="Gambar Pendukung">
                    <button type="button" class="remove-btn" onclick="removeExistingImagePendukung(this, '${foto.foto_produk}')">×</button>
                `;
                imagePreviewContainerPendukung.appendChild(existingImg);
            });
        }
        <?php endif; ?>

        if (uploadAreaPendukung && productImagePendukung) {
            uploadAreaPendukung.addEventListener('click', () => {
                productImagePendukung.click();
            });

            uploadAreaPendukung.addEventListener('dragover', (e) => {
                e.preventDefault();
                uploadAreaPendukung.classList.add('dragover');
            });

            uploadAreaPendukung.addEventListener('dragleave', () => {
                uploadAreaPendukung.classList.remove('dragover');
            });

            uploadAreaPendukung.addEventListener('drop', (e) => {
                e.preventDefault();
                uploadAreaPendukung.classList.remove('dragover');
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    handleFileSelectPendukung(files);
                }
            });

            productImagePendukung.addEventListener('change', (e) => {
                if (e.target.files.length > 0) {
                    handleFileSelectPendukung(e.target.files);
                }
            });
        }

        function handleFileSelectPendukung(files) {
            if (!imagePreviewContainerPendukung) return;
            
            Array.from(files).forEach((file) => {
                // Check if file already exists (by name and size)
                const exists = selectedFilesPendukung.some(f => f.name === file.name && f.size === file.size);
                if (!exists && file.type.startsWith('image/')) {
                    selectedFilesPendukung.push(file);
                    
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const previewItem = document.createElement('div');
                        previewItem.className = 'file-preview-item';
                        previewItem.setAttribute('data-filename', file.name);
                        previewItem.setAttribute('data-filesize', file.size);
                        previewItem.innerHTML = `
                            <img src="${e.target.result}" alt="Gambar Pendukung">
                            <button type="button" class="remove-btn" onclick="removePreviewPendukung(this, '${file.name}', ${file.size})">×</button>
                        `;
                        imagePreviewContainerPendukung.appendChild(previewItem);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        function removePreviewPendukung(btn, filename, filesize) {
            selectedFilesPendukung = selectedFilesPendukung.filter(f => !(f.name === filename && f.size === filesize));
            if (btn && btn.parentElement) {
                btn.parentElement.remove();
            }
        }

        function removeExistingImagePendukung(btn, imagePath) {
            if (confirm('Apakah Anda yakin ingin menghapus gambar pendukung ini? Gambar akan dihapus saat produk diupdate.')) {
                const form = document.getElementById('addProductForm');
                if (form) {
                    const deleteInput = document.createElement('input');
                    deleteInput.type = 'hidden';
                    deleteInput.name = 'delete_images_pendukung[]';
                    deleteInput.value = imagePath;
                    form.appendChild(deleteInput);
                }
                if (btn && btn.parentElement) {
                    btn.parentElement.remove();
                }
            }
        }

        // Calculate harga setelah diskon
        function calculateHargaSetelahDiskon() {
            const hargaAwal = parseFloat(document.getElementById('harga_awal').value) || 0;
            const hargaDiskon = parseFloat(document.getElementById('harga_diskon').value) || 0;
            const tipeDiskon = document.getElementById('tipe_diskon').value;
            const hargaSetelahDiskonInput = document.getElementById('harga_setelah_diskon');
            
            let hargaSetelahDiskon = 0;
            if (tipeDiskon === 'persentase') {
                hargaSetelahDiskon = hargaAwal - (hargaAwal * hargaDiskon / 100);
            } else {
                hargaSetelahDiskon = hargaAwal - hargaDiskon;
            }
            
            if (hargaSetelahDiskon < 0) hargaSetelahDiskon = 0;
            
            hargaSetelahDiskonInput.value = hargaSetelahDiskon.toLocaleString('id-ID');
        }

        // Menu data from database (server-side rendered)
        const menusByKategori = <?= json_encode($menusByKategoriId ?? []) ?>;
        
        // Load menu by kategori from pre-loaded data
        function loadMenuByKategori(idKategori) {
            const menuSelect = document.getElementById('id_menu');
            if (!menuSelect) return;
            
            menuSelect.innerHTML = '<option value="">Pilih menu</option>';
            
            if (!idKategori) {
                menuSelect.disabled = false;
                return;
            }
            
            // Get menus from pre-loaded data
            const menus = menusByKategori[idKategori] || [];
            
            if (menus.length > 0) {
                menus.forEach(menu => {
                        const option = document.createElement('option');
                        option.value = menu.id_menu;
                        option.textContent = menu.nama_menu;
                        menuSelect.appendChild(option);
                    });
            }
            
            menuSelect.disabled = false;
            
            // Restore selected menu if in edit mode
            <?php if (isset($produkEdit) && $produkEdit && isset($produkEdit['id_menu'])): ?>
            if (menuSelect.value === '' && <?= $produkEdit['id_menu'] ?? 'null' ?>) {
                const editMenuId = <?= $produkEdit['id_menu'] ?? 'null' ?>;
                // Wait a bit for options to be added
                setTimeout(() => {
                    if (menuSelect.querySelector(`option[value="${editMenuId}"]`)) {
                        menuSelect.value = editMenuId;
                    }
                }, 100);
            }
            <?php endif; ?>
        }

        // Load promo detail
        function loadPromoDetail(idPromo) {
            const promoSelect = document.getElementById('id_promo');
            const selectedOption = promoSelect.options[promoSelect.selectedIndex];
            
            if (!idPromo || !selectedOption) {
                document.getElementById('tipe_diskon').value = 'persentase';
                document.getElementById('harga_diskon').value = 0;
                updateDiskonPrefix();
                calculateHargaSetelahDiskon();
                return;
            }
            
            const tipeDiskon = selectedOption.getAttribute('data-tipe');
            const nilaiDiskon = selectedOption.getAttribute('data-nilai');
            
            document.getElementById('tipe_diskon').value = tipeDiskon;
            document.getElementById('harga_diskon').value = nilaiDiskon;
            updateDiskonPrefix();
            calculateHargaSetelahDiskon();
        }

        // Update diskon prefix
        function updateDiskonPrefix() {
            const tipeDiskon = document.getElementById('tipe_diskon').value;
            const diskonPrefix = document.getElementById('diskon_prefix');
            diskonPrefix.textContent = tipeDiskon === 'persentase' ? '%' : 'Rp';
        }

        // Initialize diskon prefix
        document.getElementById('tipe_diskon').addEventListener('change', function() {
            updateDiskonPrefix();
            calculateHargaSetelahDiskon();
        });

        // ====================================================================
        // FUNGSI AKSI PRODUK sudah didefinisikan di atas (sebelum DOMContentLoaded)
        // ====================================================================

        // Preview form produk (untuk produk baru yang belum disimpan)
        function previewFormProduk() {
            alert('Preview akan menampilkan produk setelah disimpan. Silakan simpan produk terlebih dahulu.');
        }

        // Clear form function
        function clearProductForm() {
            if (confirm('Apakah Anda yakin ingin membersihkan semua data yang telah diinput? Semua data termasuk gambar yang sudah diupload akan dihapus.')) {
                // Reset form
                const form = document.getElementById('addProductForm');
                if (form) {
                    form.reset();
                }
                
                // Clear image previews
                const imagePreviewInti = document.getElementById('imagePreviewInti');
                const imagePreviewPendukung = document.getElementById('imagePreviewPendukung');
                if (imagePreviewInti) {
                    imagePreviewInti.innerHTML = '';
                }
                if (imagePreviewPendukung) {
                    imagePreviewPendukung.innerHTML = '';
                }
                
                // Clear selected files
                if (typeof selectedFilesInti !== 'undefined') {
                    selectedFilesInti = [];
                }
                if (typeof selectedFilesPendukung !== 'undefined') {
                    selectedFilesPendukung = [];
                }
                
                // Clear varian section
                const varianSection = document.getElementById('varianSection');
                if (varianSection) {
                    varianSection.style.display = 'none';
                }
                const enableVarian = document.getElementById('enableVarian');
                if (enableVarian) {
                    enableVarian.checked = false;
                }
                const varianList = document.getElementById('varianList');
                if (varianList) {
                    varianList.innerHTML = '';
                }
                if (typeof varianCounter !== 'undefined') {
                    varianCounter = 0;
                }
                
                // Clear localStorage for image previews
                try {
                    localStorage.removeItem('productImagePreviewInti');
                    localStorage.removeItem('productImagePreviewPendukung');
                } catch (e) {
                    console.log('Error clearing localStorage:', e);
                }
                
                // Reset file inputs
                const fileInputInti = document.getElementById('productImageInti');
                const fileInputPendukung = document.getElementById('productImagePendukung');
                if (fileInputInti) {
                    fileInputInti.value = '';
                }
                if (fileInputPendukung) {
                    fileInputPendukung.value = '';
                }
            }
        }

        // Varian Produk Functions - Fixed
        let varianCounter = 0;

        function toggleVarianSection(enable) {
            const varianSection = document.getElementById('varianSection');
            if (!varianSection) {
                console.error('Varian section not found');
                return;
            }
            
            if (enable) {
                varianSection.style.display = 'block';
                varianSection.style.visibility = 'visible';
                if (varianCounter === 0) {
                    addVarianRow();
                }
            } else {
                varianSection.style.display = 'none';
                varianSection.style.visibility = 'hidden';
                const varianList = document.getElementById('varianList');
                if (varianList) {
                    varianList.innerHTML = '';
                }
                varianCounter = 0;
            }
        }

        // Ensure checkbox works properly
        document.addEventListener('DOMContentLoaded', function() {
            const enableCheckbox = document.getElementById('enableVarian');
            if (enableCheckbox) {
                // Add event listener as backup
                enableCheckbox.addEventListener('change', function() {
                    toggleVarianSection(this.checked);
                });
                
                // Check if editing and has varian data
                <?php if (isset($produkEdit) && !empty($produkEdit['varian'])): ?>
                    enableCheckbox.checked = true;
                    toggleVarianSection(true);
                <?php endif; ?>
            }
        });

        function addVarianRow(varianData = null) {
            varianCounter++;
            const varianList = document.getElementById('varianList');
            const varianItem = document.createElement('div');
            varianItem.className = 'varian-item';
            varianItem.setAttribute('data-varian-index', varianCounter);
            varianItem.style.cssText = 'margin-bottom: 16px; padding: 16px; background: #F9FAFB; border-radius: 8px;';
            
            const varianId = varianData ? varianData.id_varian : '';
            
            varianItem.innerHTML = `
                <div style="display: grid; grid-template-columns: 2fr 2fr 1fr 1fr auto; gap: 12px; align-items: end; margin-bottom: 12px;">
                    <div>
                        <label style="display: block; margin-bottom: 6px; font-size: 14px; font-weight: 500; color: #374151;">Nama Varian</label>
                        <input type="text" name="varian[${varianCounter}][nama_varian]" class="form-input" placeholder="Contoh: Warna, Ukuran" value="${varianData ? (varianData.nama_varian || '') : ''}" required>
                        ${varianId ? `<input type="hidden" name="varian[${varianCounter}][id_varian]" value="${varianId}">` : ''}
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 6px; font-size: 14px; font-weight: 500; color: #374151;">Nilai Varian</label>
                        <input type="text" name="varian[${varianCounter}][nilai_varian]" class="form-input" placeholder="Contoh: Merah, XL" value="${varianData ? (varianData.nilai_varian || '') : ''}" required>
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 6px; font-size: 14px; font-weight: 500; color: #374151;">Harga Tambahan</label>
                        <input type="number" name="varian[${varianCounter}][harga_tambahan]" class="form-input" placeholder="0" value="${varianData ? (varianData.harga_tambahan || 0) : 0}" min="0">
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 6px; font-size: 14px; font-weight: 500; color: #374151;">Stok</label>
                        <input type="number" name="varian[${varianCounter}][stok_varian]" class="form-input" placeholder="0" value="${varianData ? (varianData.stok_varian || 0) : 0}" min="0">
                    </div>
                    <button type="button" onclick="removeVarianRow(this)" style="width: 40px; height: 40px; border: 1px solid #DC2626; background: white; color: #DC2626; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 20px;" title="Hapus Varian">×</button>
                </div>
                <div style="margin-top: 12px;">
                    <div style="margin-bottom: 8px;">
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                            <input type="checkbox" class="varian-gambar-checkbox" data-varian-index="${varianCounter}" onchange="toggleVarianGambarUpload(${varianCounter}, this.checked)">
                            <span style="font-size: 14px; font-weight: 500; color: #374151;">Tambah gambar varian</span>
                        </label>
                    </div>
                    <div id="varianGambarUpload${varianCounter}" style="display: none;">
                        <div class="upload-area varian-upload-area" id="uploadAreaVarian${varianCounter}" style="padding: 24px;">
                            <svg class="upload-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 40px; height: 40px;">
                                <path d="M7 18C4.23858 18 2 15.7614 2 13C2 10.2386 4.23858 8 7 8C7.35138 8 7.68838 8.03357 8.01116 8.09569C8.54744 6.13037 10.3453 4.75 12.5 4.75C15.1234 4.75 17.25 6.87665 17.25 9.5C17.25 9.77614 17.2239 10.0458 17.1746 10.3069C18.4659 10.9846 19.25 12.3515 19.25 13.875C19.25 16.1868 17.4368 18 15.125 18H7Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 8V16M8 12H16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                            <p class="upload-text" style="font-size: 13px; margin: 8px 0 4px;">Klik untuk upload gambar varian</p>
                            <p class="upload-hint" style="font-size: 11px;">PNG, JPG, GIF hingga 10MB</p>
                            <input type="file" id="varianImage${varianCounter}" name="varian[${varianCounter}][gambar_varian][]" accept="image/*" style="display: none;" multiple>
                            <div id="varianImagePreview${varianCounter}" class="image-preview-container" style="margin-top: 12px;"></div>
                        </div>
                    </div>
                </div>
            `;
            varianList.appendChild(varianItem);
            
            // Initialize upload area for this varian
            initVarianUploadArea(varianCounter, varianData);
        }

        function toggleVarianGambarUpload(varianIndex, checked) {
            const uploadContainer = document.getElementById('varianGambarUpload' + varianIndex);
            if (uploadContainer) {
                uploadContainer.style.display = checked ? 'block' : 'none';
            }
        }

        function initVarianUploadArea(varianIndex, varianData = null) {
            const uploadArea = document.getElementById('uploadAreaVarian' + varianIndex);
            const fileInput = document.getElementById('varianImage' + varianIndex);
            const previewContainer = document.getElementById('varianImagePreview' + varianIndex);

            if (!uploadArea || !fileInput || !previewContainer) return;

            // Load existing images if editing
            if (varianData && varianData.gambar_varian) {
                try {
                    const existingImages = typeof varianData.gambar_varian === 'string' 
                        ? JSON.parse(varianData.gambar_varian) 
                        : varianData.gambar_varian;
                    
                    if (Array.isArray(existingImages)) {
                        existingImages.forEach((imgPath, idx) => {
                            const previewItem = document.createElement('div');
                            previewItem.className = 'file-preview-item';
                            previewItem.setAttribute('data-existing-image', imgPath);
                            previewItem.innerHTML = `
                                <img src="<?= base_url() ?>${imgPath}" alt="Varian Preview">
                                <button type="button" class="remove-btn" onclick="removeVarianImage(this, '${imgPath}', ${varianIndex})">×</button>
                            `;
                            previewContainer.appendChild(previewItem);
                        });
                    }
                } catch (e) {
                    console.error('Error loading varian images:', e);
                }
            }

            // Click handler
            uploadArea.addEventListener('click', () => {
                fileInput.click();
            });

            // Drag and drop
            uploadArea.addEventListener('dragover', (e) => {
                e.preventDefault();
                uploadArea.classList.add('dragover');
            });

            uploadArea.addEventListener('dragleave', () => {
                uploadArea.classList.remove('dragover');
            });

            uploadArea.addEventListener('drop', (e) => {
                e.preventDefault();
                uploadArea.classList.remove('dragover');
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    handleVarianFileSelect(files, varianIndex, previewContainer);
                }
            });

            // File change handler
            fileInput.addEventListener('change', (e) => {
                if (e.target.files.length > 0) {
                    handleVarianFileSelect(e.target.files, varianIndex, previewContainer);
                }
            });
        }

        function handleVarianFileSelect(files, varianIndex, previewContainer) {
            Array.from(files).forEach((file) => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const previewItem = document.createElement('div');
                        previewItem.className = 'file-preview-item';
                        previewItem.setAttribute('data-filename', file.name);
                        previewItem.setAttribute('data-filesize', file.size);
                        previewItem.innerHTML = `
                            <img src="${e.target.result}" alt="Varian Preview">
                            <button type="button" class="remove-btn" onclick="removeVarianPreview(this, '${file.name}', ${file.size}, ${varianIndex})">×</button>
                        `;
                        previewContainer.appendChild(previewItem);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        function removeVarianPreview(btn, filename, filesize, varianIndex) {
            if (btn && btn.parentElement) {
            btn.parentElement.remove();
            }
        }

        function removeVarianImage(btn, imagePath, varianIndex) {
            if (confirm('Apakah Anda yakin ingin menghapus gambar varian ini?')) {
                // Add hidden input to mark for deletion
                const form = document.getElementById('addProductForm');
                if (form) {
                    const deleteInput = document.createElement('input');
                    deleteInput.type = 'hidden';
                    deleteInput.name = `varian[${varianIndex}][delete_images][]`;
                    deleteInput.value = imagePath;
                    form.appendChild(deleteInput);
                }
                
                if (btn && btn.parentElement) {
                    btn.parentElement.remove();
                }
            }
        }

        function removeVarianRow(btn) {
            btn.parentElement.remove();
        }

        <?php if (isset($editId) && $editId && isset($produkEdit)): ?>
        // Load existing varian if in edit mode
        const produkVarian = <?= json_encode(isset($produkEdit['varian']) ? $produkEdit['varian'] : []) ?>;
        if (produkVarian && produkVarian.length > 0) {
            document.getElementById('enableVarian').checked = true;
            toggleVarianSection(true);
            produkVarian.forEach(varian => {
                addVarianRow(varian);
            });
        }
        <?php endif; ?>
    </script>
</body>

</html>

