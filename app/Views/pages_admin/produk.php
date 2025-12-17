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
            cursor: pointer;
            transition: background 0.2s;
        }

        .action-btn:hover {
            background: #F3F4F6;
        }

        .action-btn img {
            width: 16px;
            height: 20px;
            object-fit: contain;
        }

        .table-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 24px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .table-info {
            font-size: 14px;
            color: #6B7280;
        }

        .pagination {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .page-btn {
            min-width: 40px;
            height: 40px;
            padding: 0 12px;
            border: 1px solid #D1D5DB;
            border-radius: 8px;
            background: #FFFFFF;
            color: #374151;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }

        .page-btn:hover {
            border-color: #2563EB;
            color: #2563EB;
        }

        .page-btn.active {
            background: #2563EB;
            border-color: #2563EB;
            color: #FFFFFF;
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
            width: 100px;
            height: 100px;
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

            .table-footer {
                flex-direction: column;
                align-items: flex-start;
            }

            .pagination {
                flex-wrap: wrap;
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
            padding: clamp(32px, 4vw, 48px);
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
            }

            .btn-submit,
            .btn-cancel,
            .btn-preview {
                width: 100%;
                justify-content: center;
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

            <!-- Products Page Content -->
            <main class="dashboard-main">
                <div class="products-page">
                    <div class="page-header">
                        <h1 class="page-title">Manajemen Produk</h1>
                        <p class="page-subtitle">Kelola semua produk di toko Anda</p>
                    </div>

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

                        <form method="get" action="<?= base_url('admin/produk') ?>" class="filters">
                            <div class="search-filter">
                                <input type="text" name="search" placeholder="Cari produk..." class="filter-input" value="<?= esc($search ?? '') ?>">
                                <svg width="16" height="24" viewBox="0 0 16 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="filter-icon">
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
                                        <th><input type="checkbox"></th>
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
                                        <?php foreach ($produk as $p): ?>
                                            <?php
                                            $produkModel = new \App\Models\ProdukModel();
                                            $fotos = $produkModel->getProdukFoto($p['id_produk']);
                                            $fotoUtama = !empty($fotos) ? base_url($fotos[0]['foto_produk']) : base_url('assets/img/product-placeholder.png');
                                            ?>
                                            <tr>
                                                <td><input type="checkbox"></td>
                                                <td>
                                                    <div class="product-cell">
                                                        <div class="product-image">
                                                            <img src="<?= $fotoUtama ?>" alt="<?= esc($p['nama_produk']) ?>">
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

                        <div class="table-footer">
                            <p class="table-info">Menampilkan 1-4 dari 1,284 produk</p>
                            <div class="pagination">
                                <button class="page-btn">Sebelumnya</button>
                                <button class="page-btn active">1</button>
                                <button class="page-btn">2</button>
                                <button class="page-btn">3</button>
                                <button class="page-btn">Selanjutnya</button>
                            </div>
                        </div>
                    </div>

                    <!-- Add Product Form Section -->
                    <div class="add-product-section">
                        <div class="form-header">
                            <h2 class="form-title">Tambah Produk Baru</h2>
                            <p class="form-subtitle">Lengkapi informasi produk yang akan ditambahkan</p>
                        </div>

                        <form id="addProductForm" action="<?= base_url('admin/simpan_produk') ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="form-grid">
                                <!-- Product Image Upload -->
                                <div class="form-group full-width">
                                    <label class="form-label">Gambar Produk</label>
                                    <div class="upload-area" id="uploadArea">
                                        <svg class="upload-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7 18C4.23858 18 2 15.7614 2 13C2 10.2386 4.23858 8 7 8C7.35138 8 7.68838 8.03357 8.01116 8.09569C8.54744 6.13037 10.3453 4.75 12.5 4.75C15.1234 4.75 17.25 6.87665 17.25 9.5C17.25 9.77614 17.2239 10.0458 17.1746 10.3069C18.4659 10.9846 19.25 12.3515 19.25 13.875C19.25 16.1868 17.4368 18 15.125 18H7Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M12 8V16M8 12H16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        </svg>
                                        <p class="upload-text">Klik untuk upload atau drag & drop</p>
                                        <p class="upload-hint">PNG, JPG, GIF hingga 10MB</p>
                                        <input type="file" id="productImage" name="gambar_produk[]" accept="image/*" style="display: none;" multiple>
                                        <div id="imagePreview" class="image-preview-container"></div>
                                    </div>
                                </div>

                                <!-- Product Name -->
                                <div class="form-group full-width">
                                    <label class="form-label required">Nama Produk</label>
                                    <input type="text" name="nama_produk" class="form-input" placeholder="Masukkan nama produk" required>
                                </div>

                                <!-- Product Description -->
                                <div class="form-group full-width">
                                    <label class="form-label">Deskripsi Produk</label>
                                    <textarea name="deskripsi_produk" class="form-textarea" placeholder="Jelaskan detail produk Anda..."></textarea>
                                </div>

                                <!-- Category -->
                                <div class="form-group">
                                    <label class="form-label required">Kategori</label>
                                    <select name="id_kategori" id="id_kategori" class="form-select" required onchange="loadMenuByKategori(this.value)">
                                        <option value="">Pilih kategori</option>
                                        <?php if (!empty($kategori)): ?>
                                            <?php foreach ($kategori as $kat): ?>
                                                <option value="<?= $kat['id_kategori'] ?>"><?= esc($kat['nama_kategori']) ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>

                                <!-- Menu -->
                                <div class="form-group">
                                    <label class="form-label">Menu</label>
                                    <select name="id_menu" id="id_menu" class="form-select">
                                        <option value="">Pilih menu</option>
                                        <!-- Menu akan di-load via AJAX berdasarkan kategori -->
                                    </select>
                                </div>

                                <!-- Brand -->
                                <div class="form-group">
                                    <label class="form-label">Merek</label>
                                    <input type="text" name="merek" class="form-input" placeholder="Masukkan merek produk">
                                </div>

                                <!-- Harga Awal -->
                                <div class="form-group">
                                    <label class="form-label required">Harga Awal</label>
                                    <div class="price-input-group">
                                        <span class="price-prefix">Rp</span>
                                        <input type="number" id="harga_awal" name="harga_awal" class="form-input" placeholder="0" value="0" min="0" required oninput="calculateHargaSetelahDiskon()">
                                    </div>
                                </div>

                                <!-- Promo Selection -->
                                <div class="form-group">
                                    <label class="form-label">Promo (Opsional)</label>
                                    <select name="id_promo" id="id_promo" class="form-select" onchange="loadPromoDetail(this.value)">
                                        <option value="">Pilih promo</option>
                                        <?php if (!empty($promo)): ?>
                                            <?php foreach ($promo as $pr): ?>
                                                <option value="<?= $pr['id_promo'] ?>" data-tipe="<?= $pr['tipe_diskon'] ?>" data-nilai="<?= $pr['nilai_diskon'] ?>">
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
                                        <option value="persentase">Persentase (%)</option>
                                        <option value="nominal">Nominal (Rp)</option>
                                    </select>
                                </div>

                                <!-- Discount Price -->
                                <div class="form-group">
                                    <label class="form-label">Harga Diskon</label>
                                    <div class="price-input-group">
                                        <span class="price-prefix" id="diskon_prefix">%</span>
                                        <input type="number" id="harga_diskon" name="harga_diskon" class="form-input" placeholder="0" value="0" min="0" oninput="calculateHargaSetelahDiskon()">
                                    </div>
                                </div>

                                <!-- Harga Setelah Diskon (Read-only) -->
                                <div class="form-group">
                                    <label class="form-label">Harga Setelah Diskon</label>
                                    <div class="price-input-group">
                                        <span class="price-prefix">Rp</span>
                                        <input type="text" id="harga_setelah_diskon" class="form-input" readonly style="background-color: #F3F4F6; font-weight: 600; color: #DC2626;" value="0">
                                    </div>
                                </div>

                                <!-- Stock -->
                                <div class="form-group">
                                    <label class="form-label required">Stok</label>
                                    <input type="number" name="stok" class="form-input" placeholder="0" value="0" min="0" required>
                                </div>

                                <!-- SKU -->
                                <div class="form-group">
                                    <label class="form-label">SKU</label>
                                    <input type="text" name="sku" class="form-input" placeholder="SKU-001" value="SKU-<?= str_pad((($totalProduk ?? 0) + 1), 3, '0', STR_PAD_LEFT) ?>">
                                </div>

                                <!-- Weight -->
                                <div class="form-group">
                                    <label class="form-label">Berat (gram)</label>
                                    <input type="number" name="berat" class="form-input" placeholder="0" value="0" min="0">
                                </div>

                                <!-- Product Status -->
                                <div class="form-group full-width">
                                    <label class="form-label">Status Produk</label>
                                    <div class="radio-group">
                                        <div class="radio-option">
                                            <input type="radio" id="status-aktif" name="status_produk" value="aktif" checked>
                                            <label for="status-aktif">Aktif</label>
                                        </div>
                                        <div class="radio-option">
                                            <input type="radio" id="status-draft" name="status_produk" value="draft">
                                            <label for="status-draft">Draft</label>
                                        </div>
                                        <div class="radio-option">
                                            <input type="radio" id="status-tidak-aktif" name="status_produk" value="tidak_aktif">
                                            <label for="status-tidak-aktif">Tidak Aktif</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Featured Product -->
                                <div class="form-group full-width">
                                    <div class="checkbox-group">
                                        <input type="checkbox" id="featured">
                                        <label for="featured">Produk Unggulan</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="form-actions">
                                <div class="form-actions-left">
                                    <button type="submit" class="btn-submit">
                                        <img src="<?= base_url('assets/img/pluswhite.png') ?>" alt="Plus">
                                        <span>Tambah Produk</span>
                                    </button>
                                    <button type="button" class="btn-cancel">Batal</button>
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

    <script>
        // Sidebar Toggle Functionality
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const dashboardContainer = document.querySelector('.dashboard-container');

        function isMobile() {
            return window.innerWidth <= 768;
        }

        // Toggle sidebar
        function toggleSidebar() {
            if (isMobile()) {
                // Mobile: toggle sidebar visibility
                sidebar.classList.toggle('collapsed');
                sidebarOverlay.classList.toggle('active');
            } else {
                // Desktop: toggle collapsed state (icon-only mode)
                dashboardContainer.classList.toggle('sidebar-collapsed');
                sidebar.classList.toggle('collapsed');
                
                // Save state to localStorage (desktop only)
                const isCollapsed = dashboardContainer.classList.contains('sidebar-collapsed');
                localStorage.setItem('sidebarCollapsed', isCollapsed);
            }
        }

        // Toggle sidebar on button click
        sidebarToggle.addEventListener('click', toggleSidebar);

        // Close sidebar when overlay is clicked (mobile only)
        sidebarOverlay.addEventListener('click', () => {
            if (isMobile()) {
                sidebar.classList.add('collapsed');
                sidebarOverlay.classList.remove('active');
            }
        });

        // Load saved sidebar state (desktop only)
        function loadSidebarState() {
            if (!isMobile()) {
                const savedState = localStorage.getItem('sidebarCollapsed');
                if (savedState === 'true') {
                    dashboardContainer.classList.add('sidebar-collapsed');
                    sidebar.classList.add('collapsed');
                } else {
                    // Desktop: sidebar visible by default
                    sidebar.classList.remove('collapsed');
                    dashboardContainer.classList.remove('sidebar-collapsed');
                }
            } else {
                // Mobile: sidebar hidden by default
                sidebar.classList.add('collapsed');
                sidebarOverlay.classList.remove('active');
            }
        }

        // Handle window resize
        window.addEventListener('resize', () => {
            if (isMobile()) {
                // Mobile: hide overlay and sidebar if open
                sidebarOverlay.classList.remove('active');
                if (!sidebar.classList.contains('collapsed')) {
                    sidebar.classList.add('collapsed');
                }
                dashboardContainer.classList.remove('sidebar-collapsed');
            } else {
                // Desktop: remove overlay, restore saved state
                sidebarOverlay.classList.remove('active');
                loadSidebarState();
            }
        });

        // Initialize sidebar state
        loadSidebarState();

        // File Upload Functionality
        const uploadArea = document.getElementById('uploadArea');
        const fileInput = document.getElementById('productImage');

        uploadArea.addEventListener('click', () => {
            fileInput.click();
        });

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
                fileInput.files = files;
                handleFileSelect(files);
            }
        });

        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                handleFileSelect(e.target.files);
            }
        });

        function handleFileSelect(files) {
            // You can add preview functionality here
            console.log('Files selected:', files);
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

        // Load menu by kategori
        function loadMenuByKategori(idKategori) {
            const menuSelect = document.getElementById('id_menu');
            menuSelect.innerHTML = '<option value="">Pilih menu</option>';
            
            if (!idKategori) return;
            
            fetch('<?= base_url('admin/get_menu_by_kategori') ?>?id_kategori=' + idKategori)
                .then(response => response.json())
                .then(data => {
                    data.forEach(menu => {
                        const option = document.createElement('option');
                        option.value = menu.id_menu;
                        option.textContent = menu.nama_menu;
                        menuSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error:', error));
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

        // Edit produk
        function editProduk(id) {
            window.location.href = '<?= base_url('admin/produk') ?>?edit=' + id;
        }

        // Hapus produk
        function hapusProduk(id) {
            if (confirm('Apakah Anda yakin ingin menghapus produk ini?')) {
                window.location.href = '<?= base_url('admin/hapus_produk') ?>/' + id;
            }
        }

        // Preview produk
        function previewProduk(id) {
            window.open('<?= base_url('admin/preview_produk') ?>/' + id, '_blank');
        }

        // Preview form produk (untuk produk baru yang belum disimpan)
        function previewFormProduk() {
            alert('Preview akan menampilkan produk setelah disimpan. Silakan simpan produk terlebih dahulu.');
        }

        // Image preview functionality
        function handleFileSelect(files) {
            const previewContainer = document.getElementById('imagePreview');
            previewContainer.innerHTML = '';
            
            Array.from(files).forEach((file, index) => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const previewItem = document.createElement('div');
                        previewItem.className = 'file-preview-item';
                        previewItem.innerHTML = `
                            <img src="${e.target.result}" alt="Preview ${index + 1}">
                            <button type="button" class="remove-btn" onclick="removePreview(this)">×</button>
                        `;
                        previewContainer.appendChild(previewItem);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        function removePreview(btn) {
            btn.parentElement.remove();
        }

        // Update file input handler
        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                handleFileSelect(e.target.files);
            }
        });

        // Form submission
        document.getElementById('addProductForm').addEventListener('submit', function(e) {
            // Form akan submit normal ke server
        });
    </script>
</body>

</html>

