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
                        </div>
                        <h3 class="stat-label">Total Products</h3>
                        <p class="stat-value"><?= number_format($totalProduk ?? 0, 0, ',', '.') ?></p>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon" style="background: #F3E8FF;">
                                <img src="<?= base_url('assets/img/keranjangwarna.png') ?>" alt="Total Orders">
                            </div>
                        </div>
                        <h3 class="stat-label">Total Orders</h3>
                        <p class="stat-value"><?= number_format($totalOrders ?? 0, 0, ',', '.') ?></p>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon" style="background: #FFEDD5;">
                                <img src="<?= base_url('assets/img/orangan.png') ?>" alt="Total Customers">
                            </div>
                        </div>
                        <h3 class="stat-label">Total Customers</h3>
                        <p class="stat-value"><?= number_format(($orderStats['total'] ?? 0), 0, ',', '.') ?></p>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon" style="background: #DCFCE7;">
                                <img src="<?= base_url('assets/img/dolar.png') ?>" alt="Total Revenue">
                            </div>
                        </div>
                        <h3 class="stat-label">Total Revenue</h3>
                        <p class="stat-value">Rp <?= number_format($totalRevenue ?? 0, 0, ',', '.') ?></p>
                    </div>
                </div>

                <!-- Product Management Section -->
                <section class="management-section">
                    <div class="section-header">
                        <div class="section-title-group">
                            <h2 class="section-title">Manajemen Produk</h2>
                            <p class="section-subtitle">Kelola semua produk di toko Anda</p>
                        </div>
                        <a href="<?= base_url('admin/produk') ?>" class="btn-primary" style="text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                            <img src="<?= base_url('assets/img/plusputih.svg') ?>" alt="Tambah Produk">
                            <span>Tambah Produk</span>
                        </a>
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
                            <a href="<?= base_url('admin/produk') ?>" class="btn-primary" style="text-decoration: none; display: inline-flex; align-items: center; gap: 8px; padding: 8px 16px; border-radius: 8px;">
                                <span>Lihat Semua Produk</span>
                            </a>
                        </div>

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
                                    <?php if (!empty($produkRecent)): ?>
                                        <?php $no = 1; foreach ($produkRecent as $p): ?>
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
                                                        <div class="product-image" style="background: #E5E7EB;">
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
                                                        <button class="action-btn" onclick="window.location.href='<?= base_url('admin/produk?edit=' . $p['id_produk']) ?>'">
                                                            <img src="<?= base_url('assets/img/icon-edit.png') ?>" alt="Edit">
                                                        </button>
                                                        <button class="action-btn" onclick="if(confirm('Apakah Anda yakin ingin menghapus produk ini?')) { window.location.href='<?= base_url('admin/hapus_produk/' . $p['id_produk']) ?>'; }">
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
                </section>

                <!-- Category Management Section -->
                <section class="management-section">
                    <div class="section-header">
                        <div class="section-title-group">
                            <h2 class="section-title">Manajemen Kategori</h2>
                            <p class="section-subtitle">Kelola kategori produk di toko Anda</p>
                        </div>
                        <a href="<?= base_url('admin/kategori') ?>" class="btn-primary" style="text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                            <img src="<?= base_url('assets/img/plusputih.svg') ?>" alt="Tambah Kategori">
                            <span>Tambah Kategori</span>
                        </a>
                    </div>

                    <div class="section-content">
                        <div class="category-grid">
                            <?php if (!empty($kategoriRecent)): ?>
                                <?php 
                                $iconColors = ['#F3E8FF', '#DBEAFE', '#FFEDD5', '#DCFCE7'];
                                $colorIndex = 0;
                                ?>
                                <?php foreach ($kategoriRecent as $kategori): ?>
                                    <div class="category-card">
                                        <div class="category-icon" style="background: <?= $iconColors[$colorIndex % count($iconColors)] ?>;">
                                            <?php if (!empty($kategori['icon_kategori'])): ?>
                                                <img src="<?= base_url($kategori['icon_kategori']) ?>" alt="<?= esc($kategori['nama_kategori']) ?>" onerror="this.src='<?= base_url('assets/img/categories.png') ?>'">
                                            <?php else: ?>
                                                <img src="<?= base_url('assets/img/categories.png') ?>" alt="<?= esc($kategori['nama_kategori']) ?>">
                                            <?php endif; ?>
                                        </div>
                                        <div class="category-actions">
                                            <div class="action-buttons">
                                                <button class="action-btn" onclick="window.location.href='<?= base_url('admin/kategori?edit=' . $kategori['id_kategori']) ?>'">
                                                    <img src="<?= base_url('assets/img/icon-edit.png') ?>" alt="Edit">
                                                </button>
                                                <button class="action-btn" onclick="if(confirm('Apakah Anda yakin ingin menghapus kategori ini?')) { window.location.href='<?= base_url('admin/hapus_kategori/' . $kategori['id_kategori']) ?>'; }">
                                                    <img src="<?= base_url('assets/img/icon-tongsampah.png') ?>" alt="Hapus">
                                                </button>
                                            </div>
                                        </div>
                                        <h3 class="category-name"><?= esc($kategori['nama_kategori']) ?></h3>
                                        <p class="category-count"><?= number_format($kategori['jumlah_produk'] ?? 0, 0, ',', '.') ?> produk</p>
                                        <span class="status-badge <?= ($kategori['status_kategori'] ?? 'aktif') === 'aktif' ? 'active' : '' ?>"><?= ucfirst($kategori['status_kategori'] ?? 'aktif') ?></span>
                                    </div>
                                    <?php $colorIndex++; ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #6B7280;">
                                    Belum ada kategori. Silakan tambah kategori baru.
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </div>

    <script>
    </script>
    
    <!-- Sidebar Toggle Script - Centralized -->
    <script src="<?= base_url('assets/js/sidebar.js') ?>"></script>
</body>

</html>