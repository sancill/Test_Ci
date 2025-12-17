<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pelanggan - ISBCOMMERCE</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard.css') ?>">
    <style>
        .customers-page {
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

        .customers-section {
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

        .customer-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .customer-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: #E5E7EB;
            flex-shrink: 0;
        }

        .customer-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .customer-info {
            flex: 1;
            min-width: 0;
        }

        .customer-name {
            font-weight: 600;
            color: #111827;
            margin-bottom: 4px;
            font-size: 14px;
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

        .status-badge.active {
            background: #D1FAE5;
            color: #065F46;
        }

        .status-badge.inactive {
            background: #F3F4F6;
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

        @media (max-width: 768px) {
            .customers-page {
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

            .table-footer {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media (max-width: 390px) {
            .customers-page {
                padding: 12px;
            }

            .data-table th,
            .data-table td {
                padding: 8px 4px;
                font-size: 11px;
            }

            .customer-avatar {
                width: 40px;
                height: 40px;
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
        <?= view('layout/sidebar_admin', ['activeMenu' => 'customers']) ?>

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

            <!-- Customers Page Content -->
            <main class="dashboard-main">
                <div class="customers-page">
                    <div class="page-header">
                        <h1 class="page-title">Manajemen Pelanggan</h1>
                        <p class="page-subtitle">Kelola data pelanggan yang terdaftar di toko Anda</p>
                    </div>

                    <div class="customers-section">
                        <div class="section-header">
                            <div class="section-title-group">
                                <h2>Daftar Pelanggan</h2>
                                <p>Total: 1,245 pelanggan</p>
                            </div>
                        </div>

                        <div class="filters">
                            <div class="search-filter">
                                <input type="text" placeholder="Cari pelanggan..." class="filter-input">
                                <svg width="16" height="24" viewBox="0 0 16 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="filter-icon">
                                    <path
                                        d="M7 14C10.866 14 14 10.866 14 7C14 3.13401 10.866 0 7 0C3.13401 0 0 3.13401 0 7C0 10.866 3.13401 14 7 14Z"
                                        stroke="currentColor" stroke-width="2" />
                                    <path d="M13 13L19 19" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" />
                                </svg>
                            </div>
                            <select class="filter-select">
                                <option>Semua Status</option>
                                <option>Aktif</option>
                                <option>Tidak Aktif</option>
                            </select>
                            <select class="filter-select">
                                <option>Semua Tanggal</option>
                                <option>Hari Ini</option>
                                <option>Minggu Ini</option>
                                <option>Bulan Ini</option>
                            </select>
                        </div>

                        <div class="table-container">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Pelanggan</th>
                                        <th>Email</th>
                                        <th>Telepon</th>
                                        <th>Total Pesanan</th>
                                        <th>Total Belanja</th>
                                        <th>Status</th>
                                        <th>Tanggal Daftar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="customer-cell">
                                                <div class="customer-avatar">
                                                    <img src="<?= base_url('assets/img/admin-avatar.png') ?>" alt="Ahmad Rizki">
                                                </div>
                                                <div class="customer-info">
                                                    <div class="customer-name">Ahmad Rizki</div>
                                                    <div class="customer-email">ahmad@example.com</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>ahmad@example.com</td>
                                        <td>+6281234567890</td>
                                        <td>12 pesanan</td>
                                        <td>Rp 45.500.000</td>
                                        <td><span class="status-badge active">Aktif</span></td>
                                        <td>15 Jan 2025</td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="action-btn">
                                                    <img src="<?= base_url('assets/img/icon-edit.png') ?>" alt="Edit">
                                                </button>
                                                <button class="action-btn">
                                                    <img src="<?= base_url('assets/img/icon-tongsampah.png') ?>" alt="Hapus">
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="customer-cell">
                                                <div class="customer-avatar">
                                                    <img src="<?= base_url('assets/img/admin-avatar.png') ?>" alt="Siti Nurhaliza">
                                                </div>
                                                <div class="customer-info">
                                                    <div class="customer-name">Siti Nurhaliza</div>
                                                    <div class="customer-email">siti@example.com</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>siti@example.com</td>
                                        <td>+6281234567891</td>
                                        <td>8 pesanan</td>
                                        <td>Rp 28.000.000</td>
                                        <td><span class="status-badge active">Aktif</span></td>
                                        <td>20 Feb 2025</td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="action-btn">
                                                    <img src="<?= base_url('assets/img/icon-edit.png') ?>" alt="Edit">
                                                </button>
                                                <button class="action-btn">
                                                    <img src="<?= base_url('assets/img/icon-tongsampah.png') ?>" alt="Hapus">
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="customer-cell">
                                                <div class="customer-avatar">
                                                    <img src="<?= base_url('assets/img/admin-avatar.png') ?>" alt="Budi Santoso">
                                                </div>
                                                <div class="customer-info">
                                                    <div class="customer-name">Budi Santoso</div>
                                                    <div class="customer-email">budi@example.com</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>budi@example.com</td>
                                        <td>+6281234567892</td>
                                        <td>5 pesanan</td>
                                        <td>Rp 12.500.000</td>
                                        <td><span class="status-badge active">Aktif</span></td>
                                        <td>10 Mar 2025</td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="action-btn">
                                                    <img src="<?= base_url('assets/img/icon-edit.png') ?>" alt="Edit">
                                                </button>
                                                <button class="action-btn">
                                                    <img src="<?= base_url('assets/img/icon-tongsampah.png') ?>" alt="Hapus">
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="customer-cell">
                                                <div class="customer-avatar">
                                                    <img src="<?= base_url('assets/img/admin-avatar.png') ?>" alt="Dewi Lestari">
                                                </div>
                                                <div class="customer-info">
                                                    <div class="customer-name">Dewi Lestari</div>
                                                    <div class="customer-email">dewi@example.com</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>dewi@example.com</td>
                                        <td>+6281234567893</td>
                                        <td>3 pesanan</td>
                                        <td>Rp 8.000.000</td>
                                        <td><span class="status-badge inactive">Tidak Aktif</span></td>
                                        <td>05 Apr 2025</td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="action-btn">
                                                    <img src="<?= base_url('assets/img/icon-edit.png') ?>" alt="Edit">
                                                </button>
                                                <button class="action-btn">
                                                    <img src="<?= base_url('assets/img/icon-tongsampah.png') ?>" alt="Hapus">
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="table-footer">
                            <p class="table-info">Menampilkan 1-4 dari 1,245 pelanggan</p>
                            <div class="pagination">
                                <button class="page-btn">Sebelumnya</button>
                                <button class="page-btn active">1</button>
                                <button class="page-btn">2</button>
                                <button class="page-btn">3</button>
                                <button class="page-btn">Selanjutnya</button>
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

