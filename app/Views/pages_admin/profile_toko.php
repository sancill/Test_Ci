<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Toko - ISBCOMMERCE</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard.css') ?>">
    <style>
        .profile-page {
            padding: 0;
        }

        .page-header {
            background: #FFFFFF;
            border-bottom: 1px solid #E5E7EB;
            padding: 24px 32px;
            margin-bottom: 0;
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

        .profile-banner-section {
            background: linear-gradient(135deg, #2563EB 0%, #1D4ED8 50%, #1E40AF 100%);
            position: relative;
            height: 256px;
            margin: 32px;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.05);
        }

        .banner-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.3;
        }

        .change-banner-btn {
            position: absolute;
            top: 16px;
            right: 16px;
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 8px;
            padding: 8px 16px;
            font-size: 14px;
            font-weight: 500;
            color: #374151;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            transition: background 0.2s;
        }

        .change-banner-btn:hover {
            background: #FFFFFF;
        }

        .change-banner-btn img {
            width: 14px;
            height: 14px;
        }

        .profile-picture-container {
            position: absolute;
            left: 50%;
            bottom: -80px;
            transform: translateX(-50%);
            width: 160px;
            height: 160px;
        }

        .profile-picture {
            width: 160px;
            height: 160px;
            border-radius: 50%;
            border: 8px solid #FFFFFF;
            object-fit: cover;
            box-shadow: 0px 8px 10px rgba(0, 0, 0, 0.1);
            background: #FFFFFF;
        }

        .edit-profile-pic-btn {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 40px;
            height: 40px;
            background: #2563EB;
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            transition: background 0.2s;
        }

        .edit-profile-pic-btn:hover {
            background: #1D4ED8;
        }

        .edit-profile-pic-btn img {
            width: 14px;
            height: 14px;
            filter: brightness(0) invert(1);
        }

        .store-info-section {
            margin-top: 120px;
            text-align: center;
            padding: 0 32px;
        }

        .store-name {
            font-size: clamp(24px, 3vw, 30px);
            font-weight: 700;
            color: #1F2937;
            margin-bottom: 8px;
        }

        .store-tagline {
            font-size: clamp(14px, 1.5vw, 16px);
            color: #6B7280;
            margin-bottom: 24px;
        }

        .store-stats {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 24px;
            flex-wrap: wrap;
            margin-bottom: 32px;
        }

        .store-stat-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .store-stat-item img {
            width: 16px;
            height: 16px;
        }

        .stat-value {
            font-weight: 600;
            color: #374151;
            font-size: 14px;
        }

        .stat-label {
            color: #6B7280;
            font-size: 14px;
        }

        .stat-divider {
            width: 1px;
            height: 16px;
            background: #D1D5DB;
        }

        .profile-content {
            display: grid;
            grid-template-columns: 1fr 357px;
            gap: 24px;
            padding: 32px;
        }

        .profile-card {
            background: #FFFFFF;
            border-radius: 16px;
            border: 1px solid #E5E7EB;
            padding: 32px;
            box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.05);
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .card-title {
            font-size: clamp(18px, 2vw, 20px);
            font-weight: 700;
            color: #1F2937;
        }

        .btn-edit {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: #2563EB;
            color: #FFFFFF;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s;
            text-decoration: none;
        }

        .btn-edit:hover {
            background: #1D4ED8;
        }

        .btn-edit img {
            width: 14px;
            height: 14px;
            filter: brightness(0) invert(1);
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
            margin-bottom: 24px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .info-label {
            font-size: 14px;
            font-weight: 500;
            color: #4B5563;
        }

        .info-value {
            background: #F9FAFB;
            border-radius: 8px;
            padding: 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 16px;
            font-weight: 500;
            color: #1F2937;
        }

        .info-value img {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
        }

        .info-item.full-width {
            grid-column: 1 / -1;
        }

        .info-value.full-width {
            padding: 20px 16px;
        }

        .description-text {
            font-size: 16px;
            line-height: 24px;
            color: #1F2937;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
        }

        .stat-card {
            border-radius: 12px;
            padding: 24px;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .stat-card.blue {
            background: linear-gradient(132.99deg, #EFF6FF 0%, #DBEAFE 70.71%);
        }

        .stat-card.green {
            background: linear-gradient(133deg, #F0FDF4 0%, #DCFCE7 70.71%);
        }

        .stat-card.purple {
            background: linear-gradient(132.99deg, #FAF5FF 0%, #F3E8FF 70.71%);
        }

        .stat-card.orange {
            background: linear-gradient(133deg, #FFF7ED 0%, #FFEDD5 70.71%);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stat-icon.blue {
            background: #2563EB;
        }

        .stat-icon.green {
            background: #16A34A;
        }

        .stat-icon.purple {
            background: #9333EA;
        }

        .stat-icon.orange {
            background: #EA580C;
        }

        .stat-icon img {
            width: 20px;
            height: 20px;
            filter: brightness(0) invert(1);
        }

        .stat-label-text {
            font-size: 14px;
            color: #4B5563;
        }

        .stat-value-text {
            font-size: 24px;
            font-weight: 700;
            color: #1F2937;
        }

        .quick-actions {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .quick-action-btn {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }

        .quick-action-btn.primary {
            background: #EFF6FF;
        }

        .quick-action-btn.secondary {
            background: #F9FAFB;
        }

        .quick-action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .quick-action-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .quick-action-icon.blue {
            background: #2563EB;
        }

        .quick-action-icon.gray {
            background: #4B5563;
        }

        .quick-action-icon img {
            width: 16px;
            height: 16px;
            filter: brightness(0) invert(1);
        }

        .quick-action-text {
            font-size: 16px;
            font-weight: 500;
            color: #1F2937;
        }

        .verification-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .verification-item {
            background: #F0FDF4;
            border-radius: 8px;
            padding: 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .verification-item-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .verification-icon {
            width: 20px;
            height: 20px;
        }

        .verification-label {
            font-size: 14px;
            font-weight: 500;
            color: #374151;
        }

        .verification-badge {
            font-size: 12px;
            font-weight: 600;
            color: #16A34A;
        }

        .account-info-list {
            display: flex;
            flex-direction: column;
        }

        .account-info-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #F3F4F6;
        }

        .account-info-item:last-child {
            border-bottom: none;
        }

        .account-info-label {
            font-size: 14px;
            color: #4B5563;
        }

        .account-info-value {
            font-size: 14px;
            font-weight: 600;
            color: #1F2937;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 12px;
            border-radius: 9999px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-badge.active {
            background: #DCFCE7;
            color: #15803D;
        }

        @media (max-width: 1024px) {
            .profile-content {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .profile-page {
                padding: 0;
            }

            .page-header {
                padding: 16px;
            }

            .profile-banner-section {
                margin: 16px;
                height: 200px;
            }

            .profile-picture-container {
                width: 120px;
                height: 120px;
                bottom: -60px;
            }

            .profile-picture {
                width: 120px;
                height: 120px;
                border: 6px solid #FFFFFF;
            }

            .store-info-section {
                margin-top: 80px;
                padding: 0 16px;
            }

            .profile-content {
                padding: 16px;
                gap: 16px;
            }

            .profile-card {
                padding: 24px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 390px) {
            .store-stats {
                flex-direction: column;
                gap: 12px;
            }

            .stat-divider {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <?= view('layout/sidebar_admin', ['activeMenu' => '']) ?>

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

            <!-- Profile Page Content -->
            <main class="dashboard-main">
                <div class="profile-page">
                    <div class="page-header">
                        <h1 class="page-title">Profil Toko</h1>
                        <p class="page-subtitle">Kelola informasi toko dan profil penjual Anda</p>
                    </div>

                    <!-- Banner & Profile Picture Section -->
                    <div class="profile-banner-section">
                        <?php if (!empty($toko['banner_toko'])): ?>
                            <img src="<?= base_url($toko['banner_toko']) ?>" alt="Banner" class="banner-background">
                        <?php endif; ?>
                        <button class="change-banner-btn" onclick="window.location.href='<?= base_url('admin/setting_toko') ?>'">
                            <img src="<?= base_url('assets/img/icon-edit.png') ?>" alt="Edit">
                            <span>Ubah Banner</span>
                        </button>
                        <div class="profile-picture-container">
                            <?php if (!empty($toko['logo_toko'])): ?>
                                <img src="<?= base_url($toko['logo_toko']) ?>" alt="Logo Toko" class="profile-picture">
                            <?php else: ?>
                                <img src="<?= base_url('assets/img/admin-avatar.png') ?>" alt="Logo Toko" class="profile-picture">
                            <?php endif; ?>
                            <button class="edit-profile-pic-btn" onclick="window.location.href='<?= base_url('admin/setting_toko') ?>'">
                                <img src="<?= base_url('assets/img/icon-edit.png') ?>" alt="Edit">
                            </button>
                        </div>
                    </div>

                    <!-- Store Info Section -->
                    <div class="store-info-section">
                        <h2 class="store-name"><?= esc($toko['nama_toko'] ?? 'ISB Commerce Store') ?></h2>
                        <p class="store-tagline">Toko Online Terpercaya</p>
                            <div class="store-stats">
                            <div class="store-stat-item">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8 1L10 5.5L15 6L11.5 9L12.5 14L8 11.5L3.5 14L4.5 9L1 6L6 5.5L8 1Z" fill="#FBBF24" stroke="#FBBF24" stroke-width="0.5"/>
                                </svg>
                                <span class="stat-value"><?= number_format($toko['rating'] ?? 4.8, 1) ?></span>
                                <span class="stat-label">(<?= number_format($toko['total_ulasan'] ?? 2450) ?> ulasan)</span>
                            </div>
                            <div class="stat-divider"></div>
                            <div class="store-stat-item">
                                <img src="<?= base_url('assets/img/product.png') ?>" alt="Products" style="width: 16px; height: 16px;">
                                <span class="stat-value"><?= number_format($toko['total_produk'] ?? 1234) ?></span>
                                <span class="stat-label">Produk</span>
                            </div>
                            <div class="stat-divider"></div>
                            <div class="store-stat-item">
                                <img src="<?= base_url('assets/img/customers.png') ?>" alt="Followers" style="width: 16px; height: 16px;">
                                <span class="stat-value"><?= number_format(($toko['total_pengikut'] ?? 45200) / 1000, 1) ?>K</span>
                                <span class="stat-label">Pengikut</span>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Content Grid -->
                    <div class="profile-content">
                        <!-- Left Column -->
                        <div>
                            <!-- Informasi Admin Card -->
                            <div class="profile-card">
                                <div class="card-header">
                                    <h3 class="card-title">Informasi Admin</h3>
                                    <a href="<?= base_url('admin/setting_toko') ?>" class="btn-edit">
                                        <img src="<?= base_url('assets/img/icon-edit.png') ?>" alt="Edit">
                                        <span>Edit Profil</span>
                                    </a>
                                </div>
                                <div class="info-grid">
                                    <div class="info-item">
                                        <label class="info-label">Nama Lengkap</label>
                                        <div class="info-value">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8 8C9.65685 8 11 6.65685 11 5C11 3.34315 9.65685 2 8 2C6.34315 2 5 3.34315 5 5C5 6.65685 6.34315 8 8 8Z" stroke="currentColor" stroke-width="1.5"/>
                                                <path d="M2 13.3333C2 11.1242 3.79086 9.33333 6 9.33333H10C12.2091 9.33333 14 11.1242 14 13.3333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                            </svg>
                                            <span><?= esc($toko['nama_admin'] ?? 'Muhammad Iskandar') ?></span>
                                        </div>
                                    </div>
                                    <div class="info-item">
                                        <label class="info-label">Username</label>
                                        <div class="info-value">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8 2L10 6L14 6.5L11 10L11.5 14.5L8 12.5L4.5 14.5L5 10L2 6.5L6 6L8 2Z" stroke="currentColor" stroke-width="1.5"/>
                                            </svg>
                                            <span><?= esc($toko['username_admin'] ?? '@admin_isb') ?></span>
                                        </div>
                                    </div>
                                    <div class="info-item">
                                        <label class="info-label">Email</label>
                                        <div class="info-value">
                                            <img src="<?= base_url('assets/img/email.png') ?>" alt="Email">
                                            <span><?= esc($toko['email_admin'] ?? 'admin@isbcommerce.com') ?></span>
                                        </div>
                                    </div>
                                    <div class="info-item">
                                        <label class="info-label">Nomor Telepon</label>
                                        <div class="info-value">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M3 2L5.5 2.5C6.5 2.7 7.1 3.5 6.9 4.5L6.5 6.5C6.3 7.5 7.1 8.1 8.1 7.9L10.1 7.5C11.1 7.3 11.9 7.9 12.1 8.9L12.6 11.4L15 14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                            </svg>
                                            <span><?= esc($toko['telepon_admin'] ?? '+62 812-3456-7890') ?></span>
                                        </div>
                                    </div>
                                    <div class="info-item full-width">
                                        <label class="info-label">Alamat Toko</label>
                                        <div class="info-value">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8 2C5.79086 2 4 3.79086 4 6C4 9 8 13 8 13C8 13 12 9 12 6C12 3.79086 10.2091 2 8 2Z" stroke="currentColor" stroke-width="1.5"/>
                                                <circle cx="8" cy="6" r="1.5" fill="currentColor"/>
                                            </svg>
                                            <span><?= esc($toko['alamat_toko'] ?? 'Jl. Sudirman No. 123, Jakarta Pusat, DKI Jakarta 10220, Indonesia') ?></span>
                                        </div>
                                    </div>
                                    <div class="info-item full-width">
                                        <label class="info-label">Deskripsi Toko</label>
                                        <div class="info-value full-width">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M2 4H14M2 8H14M2 12H10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                            </svg>
                                            <div class="description-text">
                                                <?= esc($toko['deskripsi_toko'] ?? 'Toko online terpercaya yang menyediakan berbagai produk berkualitas dengan harga terjangkau. Kami berkomitmen memberikan pelayanan terbaik dan pengiriman cepat ke seluruh Indonesia.') ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Statistik Toko Card -->
                            <div class="profile-card" style="margin-top: 24px;">
                                <h3 class="card-title" style="margin-bottom: 24px;">Statistik Toko</h3>
                                <div class="stats-grid">
                                    <div class="stat-card blue">
                                        <div class="stat-icon blue">
                                            <img src="<?= base_url('assets/img/product.png') ?>" alt="Sales">
                                        </div>
                                        <p class="stat-label-text">Total Penjualan</p>
                                        <p class="stat-value-text"><?= number_format($toko['total_penjualan'] ?? 8542) ?></p>
                                    </div>
                                    <div class="stat-card green">
                                        <div class="stat-icon green">
                                            <img src="<?= base_url('assets/img/dolar.png') ?>" alt="Revenue">
                                        </div>
                                        <p class="stat-label-text">Pendapatan</p>
                                        <p class="stat-value-text"><?= number_format(($toko['pendapatan'] ?? 2500000) / 1000000, 1) ?>M</p>
                                    </div>
                                    <div class="stat-card purple">
                                        <div class="stat-icon purple">
                                            <img src="<?= base_url('assets/img/product.png') ?>" alt="Products">
                                        </div>
                                        <p class="stat-label-text">Produk Aktif</p>
                                        <p class="stat-value-text"><?= number_format($toko['total_produk'] ?? 1234) ?></p>
                                    </div>
                                    <div class="stat-card orange">
                                        <div class="stat-icon orange">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10 1L12.5 6.5L18.5 7.5L14.5 11.5L15.5 17.5L10 14.5L4.5 17.5L5.5 11.5L1.5 7.5L7.5 6.5L10 1Z" fill="white"/>
                                            </svg>
                                        </div>
                                        <p class="stat-label-text">Rating</p>
                                        <p class="stat-value-text"><?= number_format($toko['rating'] ?? 4.8, 1) ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div>
                            <!-- Aksi Cepat Card -->
                            <div class="profile-card">
                                <h3 class="card-title" style="margin-bottom: 24px;">Aksi Cepat</h3>
                                <div class="quick-actions">
                                    <a href="<?= base_url('admin/produk') ?>" class="quick-action-btn primary">
                                        <div class="quick-action-icon blue">
                                            <img src="<?= base_url('assets/img/pluswhite.png') ?>" alt="Add">
                                        </div>
                                        <span class="quick-action-text">Tambah Produk</span>
                                    </a>
                                    <a href="<?= base_url('admin/dashboard') ?>" class="quick-action-btn secondary">
                                        <div class="quick-action-icon gray">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M2 12L6 8L9 11L14 6" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M12 6H14V8" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                        <span class="quick-action-text">Lihat Laporan</span>
                                    </a>
                                    <a href="<?= base_url('admin/promo') ?>" class="quick-action-btn secondary">
                                        <div class="quick-action-icon gray">
                                            <img src="<?= base_url('assets/img/promotion.png') ?>" alt="Promo">
                                        </div>
                                        <span class="quick-action-text">Buat Promosi</span>
                                    </a>
                                </div>
                            </div>

                            <!-- Status Verifikasi Card -->
                            <div class="profile-card" style="margin-top: 24px;">
                                <h3 class="card-title" style="margin-bottom: 24px;">Status Verifikasi</h3>
                                <div class="verification-list">
                                    <div class="verification-item">
                                        <div class="verification-item-left">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="verification-icon">
                                                <path d="M16.6667 5L7.50004 14.1667L3.33337 10" stroke="#16A34A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <span class="verification-label">Email</span>
                                        </div>
                                        <span class="verification-badge">Terverifikasi</span>
                                    </div>
                                    <div class="verification-item">
                                        <div class="verification-item-left">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="verification-icon">
                                                <path d="M16.6667 5L7.50004 14.1667L3.33337 10" stroke="#16A34A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <span class="verification-label">Telepon</span>
                                        </div>
                                        <span class="verification-badge">Terverifikasi</span>
                                    </div>
                                    <div class="verification-item">
                                        <div class="verification-item-left">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="verification-icon">
                                                <path d="M16.6667 5L7.50004 14.1667L3.33337 10" stroke="#16A34A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <span class="verification-label">Identitas</span>
                                        </div>
                                        <span class="verification-badge">Terverifikasi</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Informasi Akun Card -->
                            <div class="profile-card" style="margin-top: 24px;">
                                <h3 class="card-title" style="margin-bottom: 24px;">Informasi Akun</h3>
                                <div class="account-info-list">
                                    <div class="account-info-item">
                                        <span class="account-info-label">Bergabung Sejak</span>
                                        <span class="account-info-value"><?= !empty($toko['tanggal_bergabung']) ? date('d M Y', strtotime($toko['tanggal_bergabung'])) : '15 Jan 2022' ?></span>
                                    </div>
                                    <div class="account-info-item">
                                        <span class="account-info-label">Login Terakhir</span>
                                        <span class="account-info-value"><?= !empty($toko['login_terakhir']) ? date('H:i', strtotime($toko['login_terakhir'])) : 'Hari ini, 14:30' ?></span>
                                    </div>
                                    <div class="account-info-item">
                                        <span class="account-info-label">Status Akun</span>
                                        <span class="status-badge active"><?= esc($toko['status_akun'] ?? 'aktif') === 'aktif' ? 'Aktif' : 'Nonaktif' ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    </script>
</body>

</html>

