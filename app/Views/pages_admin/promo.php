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

                    <!-- Promo List Section -->
                    <div class="promo-section">
                        <div class="section-header">
                            <div class="section-title-group">
                                <h2>Daftar Promo Aktif</h2>
                                <p>Total: 5 promo aktif</p>
                            </div>
                            <button class="btn-primary" onclick="document.getElementById('addPromoForm').scrollIntoView({behavior: 'smooth'})">
                                <img src="<?= base_url('assets/img/pluswhite.png') ?>" alt="Tambah Promo">
                                <span>Tambah Promo</span>
                            </button>
                        </div>

                        <div class="promo-grid">
                            <div class="promo-card">
                                <div class="promo-actions">
                                    <button class="action-btn">
                                        <img src="<?= base_url('assets/img/icon-edit.png') ?>" alt="Edit">
                                    </button>
                                    <button class="action-btn">
                                        <img src="<?= base_url('assets/img/icon-tongsampah.png') ?>" alt="Hapus">
                                    </button>
                                </div>
                                <div class="promo-header">
                                    <span class="promo-type flash-sale">Flash Sale</span>
                                </div>
                                <h3 class="promo-title">Flash Sale Elektronik</h3>
                                <div class="promo-details">
                                    <div class="promo-detail-item">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8 2V6M16 2V6M3 10H21M5 4H19C20.1046 4 21 4.89543 21 6V20C21 21.1046 20.1046 22 19 22H5C3.89543 22 3 21.1046 3 20V6C3 4.89543 3.89543 4 5 4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <span>01 Des - 07 Des 2025</span>
                                    </div>
                                    <div class="promo-detail-item">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <span>15 produk</span>
                                    </div>
                                    <div class="promo-detail-item">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <span>Diskon hingga 50%</span>
                                    </div>
                                </div>
                                <div class="promo-stats">
                                    <div class="stat-item">
                                        <div class="stat-label">Total Penjualan</div>
                                        <div class="stat-value">Rp 125M</div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-label">Pesanan</div>
                                        <div class="stat-value">1,245</div>
                                    </div>
                                </div>
                            </div>

                            <div class="promo-card">
                                <div class="promo-actions">
                                    <button class="action-btn">
                                        <img src="<?= base_url('assets/img/icon-edit.png') ?>" alt="Edit">
                                    </button>
                                    <button class="action-btn">
                                        <img src="<?= base_url('assets/img/icon-tongsampah.png') ?>" alt="Hapus">
                                    </button>
                                </div>
                                <div class="promo-header">
                                    <span class="promo-type diskon">Diskon Bundling</span>
                                </div>
                                <h3 class="promo-title">Beli 2 Gratis 1</h3>
                                <div class="promo-details">
                                    <div class="promo-detail-item">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8 2V6M16 2V6M3 10H21M5 4H19C20.1046 4 21 4.89543 21 6V20C21 21.1046 20.1046 22 19 22H5C3.89543 22 3 21.1046 3 20V6C3 4.89543 3.89543 4 5 4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <span>15 Nov - 30 Nov 2025</span>
                                    </div>
                                    <div class="promo-detail-item">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <span>8 produk</span>
                                    </div>
                                </div>
                                <div class="promo-stats">
                                    <div class="stat-item">
                                        <div class="stat-label">Total Penjualan</div>
                                        <div class="stat-value">Rp 45M</div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-label">Pesanan</div>
                                        <div class="stat-value">523</div>
                                    </div>
                                </div>
                            </div>

                            <div class="promo-card">
                                <div class="promo-actions">
                                    <button class="action-btn">
                                        <img src="<?= base_url('assets/img/icon-edit.png') ?>" alt="Edit">
                                    </button>
                                    <button class="action-btn">
                                        <img src="<?= base_url('assets/img/icon-tongsampah.png') ?>" alt="Hapus">
                                    </button>
                                </div>
                                <div class="promo-header">
                                    <span class="promo-type voucher">Voucher Toko</span>
                                </div>
                                <h3 class="promo-title">Voucher Lebaran 2025</h3>
                                <div class="promo-details">
                                    <div class="promo-detail-item">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8 2V6M16 2V6M3 10H21M5 4H19C20.1046 4 21 4.89543 21 6V20C21 21.1046 20.1046 22 19 22H5C3.89543 22 3 21.1046 3 20V6C3 4.89543 3.89543 4 5 4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <span>01 Apr - 30 Apr 2025</span>
                                    </div>
                                    <div class="promo-detail-item">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <span>Diskon Rp 50.000</span>
                                    </div>
                                </div>
                                <div class="promo-stats">
                                    <div class="stat-item">
                                        <div class="stat-label">Voucher Terpakai</div>
                                        <div class="stat-value">2,456</div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-label">Total Diskon</div>
                                        <div class="stat-value">Rp 123M</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Add Promo Form Section -->
                    <div class="add-promo-section" id="addPromoForm">
                        <div class="form-header">
                            <h2 class="form-title">Tambah Promo Baru</h2>
                            <p class="form-subtitle">Buat flash sale, diskon bundling, atau voucher toko</p>
                        </div>

                        <form id="promoForm">
                            <div class="form-grid">
                                <!-- Promo Type -->
                                <div class="form-group">
                                    <label class="form-label required">Tipe Promo</label>
                                    <select class="form-select" id="promoType" required>
                                        <option value="">Pilih tipe promo</option>
                                        <option value="flash-sale">Flash Sale</option>
                                        <option value="diskon-bundling">Diskon Bundling</option>
                                        <option value="voucher">Voucher Toko</option>
                                    </select>
                                </div>

                                <!-- Promo Title -->
                                <div class="form-group">
                                    <label class="form-label required">Nama Promo</label>
                                    <input type="text" class="form-input" placeholder="Masukkan nama promo" required>
                                </div>

                                <!-- Start Date -->
                                <div class="form-group">
                                    <label class="form-label required">Tanggal Mulai</label>
                                    <input type="datetime-local" class="form-input" required>
                                </div>

                                <!-- End Date -->
                                <div class="form-group">
                                    <label class="form-label required">Tanggal Berakhir</label>
                                    <input type="datetime-local" class="form-input" required>
                                </div>

                                <!-- Discount Type -->
                                <div class="form-group">
                                    <label class="form-label required">Tipe Diskon</label>
                                    <select class="form-select" required>
                                        <option value="">Pilih tipe diskon</option>
                                        <option value="percentage">Persentase (%)</option>
                                        <option value="fixed">Nominal (Rp)</option>
                                    </select>
                                </div>

                                <!-- Discount Value -->
                                <div class="form-group">
                                    <label class="form-label required">Nilai Diskon</label>
                                    <div class="discount-input-group">
                                        <input type="number" class="form-input" placeholder="0" min="0" required>
                                        <span class="discount-suffix">%</span>
                                    </div>
                                </div>

                                <!-- Target Products -->
                                <div class="form-group full-width">
                                    <label class="form-label required">Produk Target</label>
                                    <div class="product-select-list">
                                        <div class="product-checkbox-item">
                                            <input type="checkbox" id="product-1" value="1">
                                            <label for="product-1">Laptop Gaming ROG</label>
                                        </div>
                                        <div class="product-checkbox-item">
                                            <input type="checkbox" id="product-2" value="2">
                                            <label for="product-2">Smartphone Pro Max</label>
                                        </div>
                                        <div class="product-checkbox-item">
                                            <input type="checkbox" id="product-3" value="3">
                                            <label for="product-3">Headphone Wireless</label>
                                        </div>
                                        <div class="product-checkbox-item">
                                            <input type="checkbox" id="product-4" value="4">
                                            <label for="product-4">Smartwatch Series 8</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="form-group full-width">
                                    <label class="form-label">Deskripsi Promo</label>
                                    <textarea class="form-textarea" placeholder="Jelaskan detail promo..."></textarea>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="form-actions">
                                <button type="submit" class="btn-submit">
                                    <img src="<?= base_url('assets/img/pluswhite.png') ?>" alt="Plus">
                                    <span>Tambah Promo</span>
                                </button>
                                <button type="button" class="btn-cancel">Batal</button>
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

        function toggleSidebar() {
            if (isMobile()) {
                sidebar.classList.toggle('collapsed');
                sidebarOverlay.classList.toggle('active');
            } else {
                dashboardContainer.classList.toggle('sidebar-collapsed');
                sidebar.classList.toggle('collapsed');
                const isCollapsed = dashboardContainer.classList.contains('sidebar-collapsed');
                localStorage.setItem('sidebarCollapsed', isCollapsed);
            }
        }

        sidebarToggle.addEventListener('click', toggleSidebar);
        sidebarOverlay.addEventListener('click', () => {
            if (isMobile()) {
                sidebar.classList.add('collapsed');
                sidebarOverlay.classList.remove('active');
            }
        });

        function loadSidebarState() {
            if (!isMobile()) {
                const savedState = localStorage.getItem('sidebarCollapsed');
                if (savedState === 'true') {
                    dashboardContainer.classList.add('sidebar-collapsed');
                    sidebar.classList.add('collapsed');
                } else {
                    sidebar.classList.remove('collapsed');
                    dashboardContainer.classList.remove('sidebar-collapsed');
                }
            } else {
                sidebar.classList.add('collapsed');
                sidebarOverlay.classList.remove('active');
            }
        }

        window.addEventListener('resize', () => {
            if (isMobile()) {
                sidebarOverlay.classList.remove('active');
                if (!sidebar.classList.contains('collapsed')) {
                    sidebar.classList.add('collapsed');
                }
                dashboardContainer.classList.remove('sidebar-collapsed');
            } else {
                sidebarOverlay.classList.remove('active');
                loadSidebarState();
            }
        });

        loadSidebarState();

        // Discount Type Change
        const discountTypeSelect = document.querySelector('select[required]');
        const discountSuffix = document.querySelector('.discount-suffix');
        
        if (discountTypeSelect) {
            discountTypeSelect.addEventListener('change', (e) => {
                if (e.target.value === 'percentage') {
                    discountSuffix.textContent = '%';
                } else if (e.target.value === 'fixed') {
                    discountSuffix.textContent = 'Rp';
                }
            });
        }

        // Form Submit
        document.getElementById('promoForm').addEventListener('submit', (e) => {
            e.preventDefault();
            console.log('Promo form submitted');
        });
    </script>
</body>

</html>

