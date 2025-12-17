<?php
// Sidebar Admin Partial
// Usage: view('layout/sidebar_admin', ['activeMenu' => 'dashboard'])
// activeMenu options: dashboard, produk, kategori, menu, orders, promo, customers, setting_toko

$activeMenu = $activeMenu ?? '';

// Get toko data for user profile display
$tokoModel = new \App\Models\TokoModel();
$toko = $tokoModel->getToko();
?>

<!-- Sidebar Overlay (for mobile) -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <h1 class="sidebar-logo">ISBCOMMERCE</h1>
        <p class="sidebar-subtitle">ISB Atma Luhur Admin</p>
    </div>

    <nav class="sidebar-nav">
        <a href="<?= base_url('admin/dashboard') ?>" class="nav-item <?= $activeMenu === 'dashboard' ? 'active' : '' ?>">
            <img src="<?= base_url('assets/img/dashboard.png') ?>" alt="Dashboard">
            <span>Dashboard</span>
        </a>
        <a href="<?= base_url('admin/produk') ?>" class="nav-item <?= $activeMenu === 'produk' ? 'active' : '' ?>">
            <img src="<?= base_url('assets/img/product.png') ?>" alt="Products">
            <span>Products</span>
        </a>
        <a href="<?= base_url('admin/kategori') ?>" class="nav-item <?= $activeMenu === 'kategori' ? 'active' : '' ?>">
            <img src="<?= base_url('assets/img/categori.png') ?>" alt="Categories">
            <span>Categories</span>
        </a>
        <a href="<?= base_url('admin/menu') ?>" class="nav-item <?= $activeMenu === 'menu' ? 'active' : '' ?>">
            <img src="<?= base_url('assets/img/menu.png') ?>" alt="Menu">
            <span>Menu</span>
        </a>
        <a href="<?= base_url('admin/orders') ?>" class="nav-item <?= $activeMenu === 'orders' ? 'active' : '' ?>">
            <img src="<?= base_url('assets/img/orders.png') ?>" alt="Orders">
            <span>Orders</span>
        </a>
        <a href="<?= base_url('admin/promo') ?>" class="nav-item <?= $activeMenu === 'promo' ? 'active' : '' ?>">
            <img src="<?= base_url('assets/img/promotion.png') ?>" alt="Promo">
            <span>Promo</span>
        </a>
        <a href="<?= base_url('admin/customers') ?>" class="nav-item <?= $activeMenu === 'customers' ? 'active' : '' ?>">
            <img src="<?= base_url('assets/img/customers.png') ?>" alt="Customers">
            <span>Customers</span>
        </a>
        <a href="<?= base_url('admin/setting_toko') ?>" class="nav-item <?= $activeMenu === 'setting_toko' ? 'active' : '' ?>">
            <img src="<?= base_url('assets/img/setting.png') ?>" alt="Settings">
            <span>Settings</span>
        </a>
    </nav>

    <div class="sidebar-footer">
        <a href="<?= base_url('admin/profile_toko') ?>" class="user-profile-link">
            <div class="user-profile">
                <?php if (!empty($toko['logo_toko'])): ?>
                    <img src="<?= base_url($toko['logo_toko']) ?>" alt="<?= esc($toko['nama_admin'] ?? 'Admin User') ?>" class="user-avatar">
                <?php else: ?>
                    <img src="<?= base_url('assets/img/admin-avatar.png') ?>" alt="Admin User" class="user-avatar">
                <?php endif; ?>
                <div class="user-info">
                    <p class="user-name"><?= esc($toko['nama_admin'] ?? 'Admin User') ?></p>
                    <p class="user-email"><?= esc($toko['email_admin'] ?? 'admin@isb.ac.id') ?></p>
                </div>
            </div>
        </a>
    </div>
</aside>