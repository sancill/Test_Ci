<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pesanan - ISBCOMMERCE</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard.css') ?>">
    <style>
        .orders-page {
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

        .orders-section {
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

        .order-id {
            font-weight: 600;
            color: #2563EB;
        }

        .customer-info {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .customer-name {
            font-weight: 500;
            color: #111827;
        }

        .customer-email {
            font-size: 12px;
            color: #6B7280;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 9999px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-badge.diproses {
            background: #FEF3C7;
            color: #92400E;
        }

        .status-badge.dikirim {
            background: #DBEAFE;
            color: #1E40AF;
        }

        .status-badge.selesai {
            background: #D1FAE5;
            color: #065F46;
        }

        .status-badge.dibatalkan {
            background: #FEE2E2;
            color: #991B1B;
        }

        .status-cell {
            position: relative;
        }

        .status-select {
            padding: 4px 12px;
            border: 1px solid #D1D5DB;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 500;
            background: #FFFFFF;
            cursor: pointer;
            min-width: 120px;
        }

        .status-select:focus {
            outline: none;
            border-color: #2563EB;
        }

        .btn-save-status,
        .btn-cancel-edit {
            width: 32px;
            height: 32px;
            border: none;
            background: #10B981;
            color: white;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-save-status:hover {
            background: #059669;
        }

        .btn-cancel-edit {
            background: #EF4444;
        }

        .btn-cancel-edit:hover {
            background: #DC2626;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            align-items: center;
            flex-wrap: wrap;
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

        .btn-print {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            background: #2563EB;
            color: #FFFFFF;
            border: none;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-print:hover {
            background: #1D4ED8;
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

        @media (max-width: 768px) {
            .orders-page {
                padding: 16px;
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

            .action-buttons {
                flex-direction: column;
                align-items: flex-start;
            }

            .table-footer {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media (max-width: 390px) {
            .orders-page {
                padding: 12px;
            }

            .data-table th,
            .data-table td {
                padding: 8px 4px;
                font-size: 11px;
            }

            .action-btn {
                width: 32px;
                height: 32px;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <?= view('layout/sidebar_admin', ['activeMenu' => 'orders']) ?>

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

            <!-- Orders Page Content -->
            <main class="dashboard-main">
                <div class="orders-page">
                    <div class="page-header">
                        <h1 class="page-title">Manajemen Pesanan</h1>
                        <p class="page-subtitle">Kelola semua pesanan yang masuk</p>
                    </div>

                    <!-- Stats Section -->
                    <?php if (isset($stats) && !empty($stats)): ?>
                    <div class="stats-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 24px;">
                        <div class="stat-card" style="background: #FEF3C7; padding: 16px; border-radius: 8px; border: 1px solid #FCD34D;">
                            <h3 style="font-size: 14px; color: #92400E; margin-bottom: 8px;">Diproses</h3>
                            <p style="font-size: 24px; font-weight: 700; color: #92400E;"><?= $stats['Diproses'] ?? 0 ?></p>
                        </div>
                        <div class="stat-card" style="background: #DBEAFE; padding: 16px; border-radius: 8px; border: 1px solid #60A5FA;">
                            <h3 style="font-size: 14px; color: #1E40AF; margin-bottom: 8px;">Dikirim</h3>
                            <p style="font-size: 24px; font-weight: 700; color: #1E40AF;"><?= $stats['Dikirim'] ?? 0 ?></p>
                        </div>
                        <div class="stat-card" style="background: #D1FAE5; padding: 16px; border-radius: 8px; border: 1px solid #34D399;">
                            <h3 style="font-size: 14px; color: #065F46; margin-bottom: 8px;">Selesai</h3>
                            <p style="font-size: 24px; font-weight: 700; color: #065F46;"><?= $stats['Selesai'] ?? 0 ?></p>
                        </div>
                        <div class="stat-card" style="background: #FEE2E2; padding: 16px; border-radius: 8px; border: 1px solid #F87171;">
                            <h3 style="font-size: 14px; color: #991B1B; margin-bottom: 8px;">Dibatalkan</h3>
                            <p style="font-size: 24px; font-weight: 700; color: #991B1B;"><?= $stats['Dibatalkan'] ?? 0 ?></p>
                        </div>
                        <div class="stat-card" style="background: #F3F4F6; padding: 16px; border-radius: 8px; border: 1px solid #9CA3AF;">
                            <h3 style="font-size: 14px; color: #111827; margin-bottom: 8px;">Total Pesanan</h3>
                            <p style="font-size: 24px; font-weight: 700; color: #111827;"><?= $stats['total'] ?? 0 ?></p>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if (isset($error_message)): ?>
                        <div style="background: #FEE2E2; color: #991B1B; padding: 16px; border-radius: 8px; margin-bottom: 24px; border: 1px solid #FCA5A5;">
                            <strong>Perhatian:</strong> <?= esc($error_message) ?>
                            <br><small>Jalankan file SQL migration: app/Database/orders_migration_safe.sql</small>
                        </div>
                    <?php endif; ?>

                    <div class="orders-section">
                        <div class="section-header">
                            <div class="section-title-group">
                                <h2>Riwayat Pesanan</h2>
                                <p>Total: <?= isset($stats) ? $stats['total'] ?? 0 : 0 ?> pesanan</p>
                            </div>
                        </div>

                        <form method="get" action="<?= site_url('admin/orders') ?>" id="filterForm">
                            <div class="filters">
                                <div class="search-filter">
                                    <input type="text" name="search" placeholder="Cari pesanan, pelanggan, email..." 
                                           class="filter-input" value="<?= esc($filters['search'] ?? '') ?>">
                                    <svg width="16" height="24" viewBox="0 0 16 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" class="filter-icon">
                                        <path
                                            d="M7 14C10.866 14 14 10.866 14 7C14 3.13401 10.866 0 7 0C3.13401 0 0 3.13401 0 7C0 10.866 3.13401 14 7 14Z"
                                            stroke="currentColor" stroke-width="2" />
                                        <path d="M13 13L19 19" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" />
                                    </svg>
                                </div>
                                <select name="status" class="filter-select" onchange="document.getElementById('filterForm').submit();">
                                    <option value="all" <?= ($filters['status'] ?? 'all') == 'all' ? 'selected' : '' ?>>Semua Status</option>
                                    <option value="Diproses" <?= ($filters['status'] ?? '') == 'Diproses' ? 'selected' : '' ?>>Diproses</option>
                                    <option value="Dikirim" <?= ($filters['status'] ?? '') == 'Dikirim' ? 'selected' : '' ?>>Dikirim</option>
                                    <option value="Selesai" <?= ($filters['status'] ?? '') == 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                                    <option value="Dibatalkan" <?= ($filters['status'] ?? '') == 'Dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>
                                </select>
                                <input type="date" name="tanggal_dari" class="filter-select" 
                                       value="<?= esc($filters['tanggal_dari'] ?? '') ?>" 
                                       placeholder="Tanggal Dari"
                                       onchange="document.getElementById('filterForm').submit();">
                                <input type="date" name="tanggal_sampai" class="filter-select" 
                                       value="<?= esc($filters['tanggal_sampai'] ?? '') ?>" 
                                       placeholder="Tanggal Sampai"
                                       onchange="document.getElementById('filterForm').submit();">
                            </div>
                        </form>

                        <div class="table-container">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>ID Pesanan</th>
                                        <th>Pelanggan</th>
                                        <th>Produk</th>
                                        <th>Total</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($orders)): ?>
                                        <?php foreach ($orders as $order): ?>
                                            <?php
                                            $statusClass = strtolower($order['status_pesanan'] ?? 'diproses');
                                            // Generate nomor pesanan jika belum ada
                                            if (!empty($order['no_pesanan'])) {
                                                $noPesanan = $order['no_pesanan'];
                                            } else {
                                                // Format: ORD-XXX
                                                $noPesanan = 'ORD-' . str_pad($order['id_pesan'], 6, '0', STR_PAD_LEFT);
                                            }
                                            $produkList = '';
                                            if (!empty($order['details']) && is_array($order['details'])) {
                                                $produkList = implode(', ', array_map(function($d) {
                                                    return ($d['nama_produk'] ?? '-') . ' (x' . ($d['jumlah'] ?? 1) . ')';
                                                }, $order['details']));
                                            } else {
                                                $produkList = '-';
                                            }
                                            ?>
                                            <tr data-order-id="<?= $order['id_pesan'] ?>">
                                                <td><span class="order-id">#<?= esc($noPesanan) ?></span></td>
                                                <td>
                                                    <div class="customer-info">
                                                        <span class="customer-name"><?= esc($order['nama_pelanggan'] ?? '-') ?></span>
                                                        <span class="customer-email"><?= esc($order['email_pelanggan'] ?? '-') ?></span>
                                                    </div>
                                                </td>
                                                <td><?= esc($produkList ?: '-') ?></td>
                                                <td>Rp <?= number_format($order['total_bayar'] ?? $order['total_harga'] ?? 0, 0, ',', '.') ?></td>
                                                <td><?= date('d M Y', strtotime($order['tanggal_pesan'] ?? 'now')) ?></td>
                                                <td class="status-cell">
                                                    <span class="status-display status-badge <?= $statusClass ?>">
                                                        <?= esc($order['status_pesanan'] ?? 'Diproses') ?>
                                                    </span>
                                                    <select class="status-select" style="display: none;" data-order-id="<?= $order['id_pesan'] ?>">
                                                        <option value="Diproses" <?= ($order['status_pesanan'] ?? '') == 'Diproses' ? 'selected' : '' ?>>Diproses</option>
                                                        <option value="Dikirim" <?= ($order['status_pesanan'] ?? '') == 'Dikirim' ? 'selected' : '' ?>>Dikirim</option>
                                                        <option value="Selesai" <?= ($order['status_pesanan'] ?? '') == 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                                                        <option value="Dibatalkan" <?= ($order['status_pesanan'] ?? '') == 'Dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <div class="action-buttons">
                                                        <a href="<?= site_url('admin/orders/invoice/' . $order['id_pesan']) ?>" 
                                                           class="btn-print" target="_blank">
                                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M6 9V2H18V9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M6 18H4C2.89543 18 2 17.1046 2 16V11C2 9.89543 2.89543 9 4 9H20C21.1046 9 22 9.89543 22 11V16C22 17.1046 21.1046 18 20 18H18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M18 14H6V22H18V14Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                            Invoice
                                                        </a>
                                                        <button class="btn-edit-status action-btn" data-order-id="<?= $order['id_pesan'] ?>" title="Edit Status">
                                                            <img src="<?= base_url('assets/img/icon-edit.png') ?>" alt="Edit">
                                                        </button>
                                                        <button class="btn-save-status" style="display: none;" data-order-id="<?= $order['id_pesan'] ?>" title="Simpan">
                                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                                <polyline points="20 6 9 17 4 12"></polyline>
                                                            </svg>
                                                        </button>
                                                        <button class="btn-cancel-edit" style="display: none;" data-order-id="<?= $order['id_pesan'] ?>" title="Batal">
                                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="7" style="text-align: center; padding: 40px; color: #6B7280;">
                                                Tidak ada pesanan ditemukan
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="table-footer">
                            <p class="table-info">Menampilkan <?= isset($orders) ? count($orders) : 0 ?> pesanan</p>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Sidebar Toggle Script - Centralized -->
    <script src="<?= base_url('assets/js/sidebar.js') ?>"></script>
    
    <script>

        // Inline Edit Status Functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Edit Status Button
            document.querySelectorAll('.btn-edit-status').forEach(btn => {
                btn.addEventListener('click', function() {
                    const orderId = this.dataset.orderId;
                    const row = this.closest('tr');
                    const statusDisplay = row.querySelector('.status-display');
                    const statusSelect = row.querySelector('.status-select');
                    const editBtn = row.querySelector('.btn-edit-status');
                    const saveBtn = row.querySelector('.btn-save-status');
                    const cancelBtn = row.querySelector('.btn-cancel-edit');
                    const invoiceBtn = row.querySelector('.btn-print');

                    // Show select, hide display
                    statusDisplay.style.display = 'none';
                    statusSelect.style.display = 'block';
                    editBtn.style.display = 'none';
                    invoiceBtn.style.display = 'none';
                    saveBtn.style.display = 'flex';
                    cancelBtn.style.display = 'flex';
                });
            });

            // Cancel Edit
            document.querySelectorAll('.btn-cancel-edit').forEach(btn => {
                btn.addEventListener('click', function() {
                    const orderId = this.dataset.orderId;
                    const row = this.closest('tr');
                    const statusDisplay = row.querySelector('.status-display');
                    const statusSelect = row.querySelector('.status-select');
                    const editBtn = row.querySelector('.btn-edit-status');
                    const saveBtn = row.querySelector('.btn-save-status');
                    const cancelBtn = row.querySelector('.btn-cancel-edit');
                    const invoiceBtn = row.querySelector('.btn-print');

                    // Reset select value
                    statusSelect.value = statusDisplay.textContent.trim();

                    // Show display, hide select
                    statusDisplay.style.display = 'inline-block';
                    statusSelect.style.display = 'none';
                    editBtn.style.display = 'flex';
                    invoiceBtn.style.display = 'flex';
                    saveBtn.style.display = 'none';
                    cancelBtn.style.display = 'none';
                });
            });

            // Save Status
            document.querySelectorAll('.btn-save-status').forEach(btn => {
                btn.addEventListener('click', function() {
                    const orderId = this.dataset.orderId;
                    const row = this.closest('tr');
                    const statusSelect = row.querySelector('.status-select');
                    const statusDisplay = row.querySelector('.status-display');
                    const newStatus = statusSelect.value;

                    // Disable button while processing
                    this.disabled = true;
                    this.innerHTML = '<span style="font-size: 12px;">Menyimpan...</span>';

                    // AJAX request
                    fetch('<?= site_url('admin/orders/update_status') ?>/' + orderId, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: 'status_pesanan=' + encodeURIComponent(newStatus)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Update status display
                            statusDisplay.textContent = newStatus;
                            statusDisplay.className = 'status-display status-badge ' + newStatus.toLowerCase();

                            // Show success message (optional)
                            showNotification('Status berhasil diupdate', 'success');

                            // Exit edit mode
                            const editBtn = row.querySelector('.btn-edit-status');
                            const saveBtn = row.querySelector('.btn-save-status');
                            const cancelBtn = row.querySelector('.btn-cancel-edit');
                            const invoiceBtn = row.querySelector('.btn-print');

                            statusDisplay.style.display = 'inline-block';
                            statusSelect.style.display = 'none';
                            editBtn.style.display = 'flex';
                            invoiceBtn.style.display = 'flex';
                            saveBtn.style.display = 'none';
                            cancelBtn.style.display = 'none';

                            // Reload page after 1 second to update stats
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                        } else {
                            showNotification(data.message || 'Gagal mengupdate status', 'error');
                            this.disabled = false;
                            this.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showNotification('Terjadi kesalahan saat mengupdate status', 'error');
                        this.disabled = false;
                        this.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>';
                    });
                });
            });
        });

        // Notification function
        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                padding: 16px 20px;
                background: ${type === 'success' ? '#10B981' : '#EF4444'};
                color: white;
                border-radius: 8px;
                box-shadow: 0 4px 6px rgba(0,0,0,0.1);
                z-index: 10000;
                font-size: 14px;
                font-weight: 500;
            `;
            notification.textContent = message;
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.opacity = '0';
                notification.style.transition = 'opacity 0.3s';
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }, 3000);
        }

        // Alert messages
        <?php if (session()->getFlashdata('success')): ?>
            showNotification('<?= session()->getFlashdata('success') ?>', 'success');
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            showNotification('<?= session()->getFlashdata('error') ?>', 'error');
        <?php endif; ?>
    </script>
</body>

</html>

