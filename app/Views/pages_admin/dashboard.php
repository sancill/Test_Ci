<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - ISBCOMMERCE</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard.css') ?>">
</head>

<body>
    <div class="dashboard-container">
        <?= view('layout/sidebar_admin', ['activeMenu' => 'dashboard']) ?>

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

            <!-- Dashboard Content -->
            <main class="dashboard-main">
                <!-- Dashboard Overview -->
                <div class="dashboard-overview">
                    <h2 class="overview-title">Dashboard Overview</h2>
                    <p class="overview-subtitle">Welcome back! Here's what's happening with your store today.</p>
                </div>

                <!-- Stats Cards -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon" style="background: #DBEAFE;">
                                <img src="<?= base_url('assets/img/package.png') ?>" alt="Total Products">
                            </div>
                            <span class="stat-badge positive">+12%</span>
                        </div>
                        <h3 class="stat-label">Total Products</h3>
                        <p class="stat-value">1,248</p>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon" style="background: #F3E8FF;">
                                <img src="<?= base_url('assets/img/keranjangwarna.png') ?>" alt="Total Orders">
                            </div>
                            <span class="stat-badge positive">+8%</span>
                        </div>
                        <h3 class="stat-label">Total Orders</h3>
                        <p class="stat-value">892</p>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon" style="background: #FFEDD5;">
                                <img src="<?= base_url('assets/img/orangan.png') ?>" alt="Total Visitors">
                            </div>
                            <span class="stat-badge positive">+23%</span>
                        </div>
                        <h3 class="stat-label">Total Visitors</h3>
                        <p class="stat-value">12,459</p>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon" style="background: #DCFCE7;">
                                <img src="<?= base_url('assets/img/dolar.png') ?>" alt="Total Revenue">
                            </div>
                            <span class="stat-badge positive">+18%</span>
                        </div>
                        <h3 class="stat-label">Total Revenue</h3>
                        <p class="stat-value">Rp 45.2M</p>
                    </div>
                </div>

                <!-- Product Management Section -->
                <section class="management-section">
                    <div class="section-header">
                        <div class="section-title-group">
                            <h2 class="section-title">Manajemen Produk</h2>
                            <p class="section-subtitle">Kelola semua produk di toko Anda</p>
                        </div>
                        <button class="btn-primary">
                            <img src="<?= base_url('assets/img/plusputih.svg') ?>" alt="Tambah Produk">
                            <span>Tambah Produk</span>
                        </button>
                    </div>

                    <div class="section-content">
                        <div class="filters">
                            <div class="search-filter">
                                <input type="text" placeholder="Cari produk..." class="filter-input">
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
                                <option>Semua Kategori</option>
                            </select>
                            <select class="filter-select">
                                <option>Semua Status</option>
                            </select>
                        </div>

                        <div class="table-container">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>A/T</th>
                                        <th>Produk</th>
                                        <th>Kategori</th>
                                        <th>Menu</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="checkbox"></td>
                                        <td>
                                            <div class="product-cell">
                                                <div class="product-image" style="background: #E5E7EB;">
                                                    <img src="<?= base_url('assets/img/product-laptop.png') ?>"
                                                        alt="Laptop Gaming ROG">
                                                </div>
                                                <div class="product-info">
                                                    <p class="product-name">Laptop Gaming ROG</p>
                                                    <p class="product-sku">SKU: LPT-001</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Elektronik</td>
                                        <td>Laptop</td>
                                        <td>Rp 15.000.000</td>
                                        <td>45</td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="action-btn">
                                                    <img src="<?= base_url('assets/img/icon-edit.png') ?>" alt="Edit">
                                                </button>
                                                <button class="action-btn">
                                                    <img src="<?= base_url('assets/img/icon-tongsampah.png') ?>"
                                                        alt="Hapus">
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"></td>
                                        <td>
                                            <div class="product-cell">
                                                <div class="product-image" style="background: #E5E7EB;">
                                                    <img src="<?= base_url('assets/img/product-smartphone.png') ?>"
                                                        alt="Smartphone Pro Max">
                                                </div>
                                                <div class="product-info">
                                                    <p class="product-name">Smartphone Pro Max</p>
                                                    <p class="product-sku">SKU: PHN-002</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Elektronik</td>
                                        <td>Smartphone</td>
                                        <td>Rp 12.500.000</td>
                                        <td>23</td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="action-btn">
                                                    <img src="<?= base_url('assets/img/icon-edit.png') ?>" alt="Edit">
                                                </button>
                                                <button class="action-btn">
                                                    <img src="<?= base_url('assets/img/icon-tongsampah.png') ?>"
                                                        alt="Hapus">
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"></td>
                                        <td>
                                            <div class="product-cell">
                                                <div class="product-image" style="background: #E5E7EB;">
                                                    <img src="<?= base_url('assets/img/product-headphone.png') ?>"
                                                        alt="Headphone Wireless">
                                                </div>
                                                <div class="product-info">
                                                    <p class="product-name">Headphone Wireless</p>
                                                    <p class="product-sku">SKU: AUD-003</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Audio</td>
                                        <td>Headphone</td>
                                        <td>Rp 2.500.000</td>
                                        <td style="color: #DC2626;">5</td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="action-btn">
                                                    <img src="<?= base_url('assets/img/icon-edit.png') ?>" alt="Edit">
                                                </button>
                                                <button class="action-btn">
                                                    <img src="<?= base_url('assets/img/icon-tongsampah.png') ?>"
                                                        alt="Hapus">
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"></td>
                                        <td>
                                            <div class="product-cell">
                                                <div class="product-image" style="background: #E5E7EB;">
                                                    <img src="<?= base_url('assets/img/product-smartwatch.png') ?>"
                                                        alt="Smartwatch Series 8">
                                                </div>
                                                <div class="product-info">
                                                    <p class="product-name">Smartwatch Series 8</p>
                                                    <p class="product-sku">SKU: WTC-004</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Wearable</td>
                                        <td>Smartwatch</td>
                                        <td>Rp 5.500.000</td>
                                        <td>67</td>
                                        <td>
                                            <div class="action-buttons">
                                                <button class="action-btn">
                                                    <img src="<?= base_url('assets/img/icon-edit.png') ?>" alt="Edit">
                                                </button>
                                                <button class="action-btn">
                                                    <img src="<?= base_url('assets/img/icon-tongsampah.png') ?>"
                                                        alt="Hapus">
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
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
                </section>

                <!-- Category Management Section -->
                <section class="management-section">
                    <div class="section-header">
                        <div class="section-title-group">
                            <h2 class="section-title">Manajemen Kategori</h2>
                            <p class="section-subtitle">Kelola kategori produk di toko Anda</p>
                        </div>
                        <button class="btn-primary">
                            <img src="<?= base_url('assets/img/plusputih.svg') ?>" alt="Tambah Kategori">
                            <span>Tambah Kategori</span>
                        </button>
                    </div>

                    <div class="section-content">
                        <div class="category-grid">
                            <div class="category-card">
                                <div class="category-icon" style="background: #F3E8FF;">
                                    <img src="<?= base_url('assets/img/categories.png') ?>" alt="Elektronik">
                                </div>
                                <div class="category-actions">
                                    <div class="action-buttons">
                                        <button class="action-btn">
                                            <img src="<?= base_url('assets/img/icon-edit.png') ?>" alt="Edit">
                                        </button>
                                        <button class="action-btn">
                                            <img src="<?= base_url('assets/img/icon-tongsampah.png') ?>" alt="Hapus">
                                        </button>
                                    </div>
                                </div>
                                <h3 class="category-name">Elektronik</h3>
                                <p class="category-count">456 produk</p>
                                <span class="status-badge active">Aktif</span>
                            </div>

                            <div class="category-card">
                                <div class="category-icon" style="background: #DBEAFE;">
                                    <img src="<?= base_url('assets/img/categories.png') ?>" alt="Fashion">
                                </div>
                                <div class="category-actions">
                                    <div class="action-buttons">
                                        <button class="action-btn">
                                            <img src="<?= base_url('assets/img/icon-edit.png') ?>" alt="Edit">
                                        </button>
                                        <button class="action-btn">
                                            <img src="<?= base_url('assets/img/icon-tongsampah.png') ?>" alt="Hapus">
                                        </button>
                                    </div>
                                </div>
                                <h3 class="category-name">Fashion</h3>
                                <p class="category-count">234 produk</p>
                                <span class="status-badge active">Aktif</span>
                            </div>
                        </div>
                    </div>
                </section>
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
    </script>
</body>

</html>