<?php
// Load CSS and JS for profile page
?>
<link rel="stylesheet" href="<?= base_url('assets/css/profile.css') ?>">
<script src="<?= base_url('assets/js/profile.js') ?>" defer></script>

<div class="frame">
    <div class="content-wrapper">
        <!-- Main Content -->
        <div class="body-container">
            <div class="main-content">
                <div class="content-inner">
                    <!-- Sidebar -->
                    <aside class="sidebar">
                        <div class="profile-card">
                            <div class="profile-header">
                                <div class="profile-avatar-wrapper">
                                    <div class="profile-avatar">
                                        <img src="http://localhost:3845/assets/410c340aa057242400c608368f918307cdd72438.png" alt="Ahmad Pratama" class="avatar-img">
                                    </div>
                                </div>
                                <h2 class="profile-name">Ahmad Pratama</h2>
                                <p class="profile-role">Mahasiswa Aktif</p>
                            </div>
                            <div class="profile-nav">
                                <nav class="nav-menu">
                                    <a href="#" class="nav-item active">
                                        <div class="nav-icon">
                                            <svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8 8C10.2091 8 12 6.20914 12 4C12 1.79086 10.2091 0 8 0C5.79086 0 4 1.79086 4 4C4 6.20914 5.79086 8 8 8Z" fill="#2563EB"/>
                                                <path d="M8 10C4.68629 10 2 12.6863 2 16V18H14V16C14 12.6863 11.3137 10 8 10Z" fill="#2563EB"/>
                                            </svg>
                                        </div>
                                        <span class="nav-text">Profil Saya</span>
                                    </a>
                                    <a href="#" class="nav-item">
                                        <div class="nav-icon">
                                            <svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1 1H3.5L5.5 10H14.5L16.5 4H5M5.5 10L4 12H14M5.5 10H14M14 14C13.4477 14 13 13.5523 13 13C13 12.4477 13.4477 12 14 12C14.5523 12 15 12.4477 15 13C15 13.5523 14.5523 14 14 14ZM7 14C6.44772 14 6 13.5523 6 13C6 12.4477 6.44772 12 7 12C7.55228 12 8 12.4477 8 13C8 13.5523 7.55228 14 7 14Z" stroke="#6B7280" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                        <span class="nav-text">Pesanan Saya</span>
                                    </a>
                                    <a href="#" class="nav-item">
                                        <div class="nav-icon">
                                            <svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9 1.5L11.5 5.5L16 6.5L12.5 9.5L13 14L9 12L5 14L5.5 9.5L2 6.5L6.5 5.5L9 1.5Z" stroke="#6B7280" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                        <span class="nav-text">Wishlist</span>
                                    </a>
                                    <a href="#" class="nav-item">
                                        <div class="nav-icon">
                                            <svg width="14" height="18" viewBox="0 0 14 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M7 9C8.65685 9 10 7.65685 10 6C10 4.34315 8.65685 3 7 3C5.34315 3 4 4.34315 4 6C4 7.65685 5.34315 9 7 9Z" stroke="#6B7280" stroke-width="1.5"/>
                                                <path d="M1 6C1 3.23858 3.23858 1 6 1H8C10.7614 1 13 3.23858 13 6C13 8.76142 7 15 7 15C7 15 1 8.76142 1 6Z" stroke="#6B7280" stroke-width="1.5"/>
                                            </svg>
                                        </div>
                                        <span class="nav-text">Alamat</span>
                                    </a>
                                    <a href="#" class="nav-item">
                                        <div class="nav-icon">
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9 11C10.6569 11 12 9.65685 12 8C12 6.34315 10.6569 5 9 5C7.34315 5 6 6.34315 6 8C6 9.65685 7.34315 11 9 11Z" stroke="#6B7280" stroke-width="1.5"/>
                                                <path d="M2.25 6.75L9 1.5L15.75 6.75V15C15.75 15.4142 15.5858 15.75 15.375 15.75H2.625C2.41421 15.75 2.25 15.4142 2.25 15V6.75Z" stroke="#6B7280" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                        <span class="nav-text">Pengaturan</span>
                                    </a>
                                </nav>
                                <div class="logout-section">
                                    <button class="logout-btn">
                                        <div class="logout-icon">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6 14H3C2.44772 14 2 13.5523 2 13V3C2 2.44772 2.44772 2 3 2H6M10 11L14 7M14 7L10 3M14 7H6" stroke="#DC2626" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                        <span class="logout-text">Logout</span>
                                    </button>
                                </div>
                            </div>
    </div>
                    </aside>

                    <!-- Main Content Area -->
                    <div class="main-section">
                        <!-- Account Information Section -->
                        <section class="info-section">
                            <div class="section-header">
                                <h2 class="section-title">Informasi Akun</h2>
                                <div class="section-header-actions">
                                    <button class="edit-profile-btn" id="editProfileBtn">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.3333 2.00001C11.5084 1.82491 11.7163 1.68698 11.9444 1.59526C12.1726 1.50354 12.4159 1.46002 12.6667 1.46002C12.9174 1.46002 13.1607 1.50354 13.3889 1.59526C13.617 1.68698 13.8249 1.82491 14 2.00001C14.1751 2.17511 14.313 2.38298 14.4047 2.61112C14.4965 2.83926 14.54 3.08258 14.54 3.33334C14.54 3.5841 14.4965 3.82742 14.4047 4.05556C14.313 4.2837 14.1751 4.49157 14 4.66667L5.00001 13.6667L1.33334 14.6667L2.33334 11L11.3333 2.00001Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <span class="edit-btn-text">Edit Profil</span>
                                    </button>
                                    <button class="save-profile-btn" id="saveProfileBtn" style="display: none;">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13.3333 4L6 11.3333L2.66667 8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <span>Simpan</span>
                                    </button>
                                    <button class="cancel-profile-btn" id="cancelProfileBtn" style="display: none;">
                                        <span>Batal</span>
                                    </button>
                                </div>
                            </div>
                            <div class="info-fields">
                                <div class="info-column">
                                    <div class="info-field">
                                        <label class="field-label">Nama Lengkap</label>
                                        <div class="field-input">
                                            <svg width="14" height="16" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M7 8C9.20914 8 11 6.20914 11 4C11 1.79086 9.20914 0 7 0C4.79086 0 3 1.79086 3 4C3 6.20914 4.79086 8 7 8Z" fill="#6B7280"/>
                                                <path d="M7 10C3.68629 10 1 12.6863 1 16V18H13V16C13 12.6863 10.3137 10 7 10Z" fill="#6B7280"/>
                                            </svg>
                                            <input type="text" class="field-input-control" value="Ahmad Pratama Wijaya" readonly data-field="nama">
                                        </div>
                                    </div>
                                    <div class="info-field">
                                        <label class="field-label">Email</label>
                                        <div class="field-input">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M2 4L8 9L14 4M2 4H14V12H2V4Z" stroke="#6B7280" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <input type="email" class="field-input-control" value="ahmad.pratama@student.ibs.ac.id" readonly data-field="email">
                                        </div>
                                    </div>
                                    <div class="info-field">
                                        <label class="field-label">NIM</label>
                                        <div class="field-input">
                                            <svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1 2C1 1.44772 1.44772 1 2 1H16C16.5523 1 17 1.44772 17 2V14C17 14.5523 16.5523 15 16 15H2C1.44772 15 1 14.5523 1 14V2Z" stroke="#6B7280" stroke-width="1.5"/>
                                                <path d="M5 5H13M5 8H13M5 11H10" stroke="#6B7280" stroke-width="1.5" stroke-linecap="round"/>
                                            </svg>
                                            <input type="text" class="field-input-control" value="202101234567" readonly data-field="nim">
                                        </div>
                                    </div>
                                </div>
                                <div class="info-column">
                                    <div class="info-field">
                                        <label class="field-label">Nomor HP</label>
                                        <div class="field-input">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M11 1H5C4.44772 1 4 1.44772 4 2V14C4 14.5523 4.44772 15 5 15H11C11.5523 15 12 14.5523 12 14V2C12 1.44772 11.5523 1 11 1Z" stroke="#6B7280" stroke-width="1.5"/>
                                                <path d="M6 3H10" stroke="#6B7280" stroke-width="1.5" stroke-linecap="round"/>
                                            </svg>
                                            <input type="tel" class="field-input-control" value="+62 812-3456-7890" readonly data-field="phone">
                                        </div>
                                    </div>
                                    <div class="info-field">
                                        <label class="field-label">Program Studi</label>
                                        <div class="field-input">
                                            <svg width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10 0L0 4V7C0 11.9706 4.02944 16 9 16H11C15.9706 16 20 11.9706 20 7V4L10 0Z" stroke="#6B7280" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <input type="text" class="field-input-control" value="Sistem Informasi" readonly data-field="program">
                                        </div>
                                    </div>
                                    <div class="info-field">
                                        <label class="field-label">Status</label>
                                        <div class="field-input status-active">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M13.3333 4L6 11.3333L2.66667 8" stroke="#16A34A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <span class="field-value status-text">Mahasiswa Aktif</span>
                                        </div>
                                    </div>
                                </div>
        </div>
                            <div class="google-connection">
                                <button class="google-link">
                                    <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.5 8C9.433 8 11 6.433 11 4.5C11 2.567 9.433 1 7.5 1C5.567 1 4 2.567 4 4.5C4 6.433 5.567 8 7.5 8Z" fill="#4285F4"/>
                                        <path d="M7.5 10C4.46243 10 2 12.4624 2 15.5V16H13V15.5C13 12.4624 10.5376 10 7.5 10Z" fill="#34A853"/>
                                    </svg>
                                    <span>Terhubung dengan Google</span>
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.3333 4L6 11.3333L2.66667 8" stroke="#16A34A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
            </div>
                        </section>

                        <!-- Purchase History Section -->
                        <section class="purchase-section">
                            <div class="section-header">
                                <div class="section-title-group">
                                    <h2 class="section-title">Riwayat Pembelian</h2>
                                    <p class="section-subtitle">5 transaksi terakhir</p>
                                </div>
                                <button class="view-all-btn">
                                    <span>Lihat Semua</span>
                                    <svg width="14" height="16" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5 3L9 8L5 13" stroke="#2563EB" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="purchase-list">
                                <div class="purchase-item">
                                    <div class="purchase-image">
                                        <img src="http://localhost:3845/assets/fe3f605e2cd6f167c45939e4300d5d941a9177ca.png" alt="Laptop ASUS VivoBook 14">
                                    </div>
                                    <div class="purchase-details">
                                        <h3 class="purchase-title">Laptop ASUS VivoBook 14</h3>
                                        <p class="purchase-date">15 Desember 2024</p>
                                        <div class="purchase-meta">
                                            <span class="status-badge status-completed">Selesai</span>
                                            <span class="order-number">Order #ISB2024001</span>
                                        </div>
                                    </div>
                                    <div class="purchase-action">
                                        <p class="purchase-price">Rp 7.500.000</p>
                                        <button class="detail-btn">Lihat Detail</button>
                                    </div>
                                </div>
                                <div class="purchase-item">
                                    <div class="purchase-image">
                                        <img src="http://localhost:3845/assets/629809dc5d984d99f40598484c74b4509c474528.png" alt="Logitech MX Master 3">
                                    </div>
                                    <div class="purchase-details">
                                        <h3 class="purchase-title">Logitech MX Master 3</h3>
                                        <p class="purchase-date">10 Desember 2024</p>
                                        <div class="purchase-meta">
                                            <span class="status-badge status-completed">Selesai</span>
                                            <span class="order-number">Order #ISB2024002</span>
                                        </div>
                                    </div>
                                    <div class="purchase-action">
                                        <p class="purchase-price">Rp 1.250.000</p>
                                        <button class="detail-btn">Lihat Detail</button>
                                    </div>
                                </div>
                                <div class="purchase-item">
                                    <div class="purchase-image">
                                        <img src="http://localhost:3845/assets/7d358cb1ec62f7779239da5652b4350a29881b09.png" alt="TWS Earbuds Pro">
                                    </div>
                                    <div class="purchase-details">
                                        <h3 class="purchase-title">TWS Earbuds Pro</h3>
                                        <p class="purchase-date">5 Desember 2024</p>
                                        <div class="purchase-meta">
                                            <span class="status-badge status-shipped">Dikirim</span>
                                            <span class="order-number">Order #ISB2024003</span>
                                        </div>
                                    </div>
                                    <div class="purchase-action">
                                        <p class="purchase-price">Rp 450.000</p>
                                        <button class="detail-btn">Lacak Paket</button>
                                    </div>
                                </div>
            </div>
                        </section>

                        <!-- Wishlist Section -->
                        <section class="wishlist-section">
                            <div class="section-header">
                                <div class="section-title-group">
                                    <h2 class="section-title">Wishlist</h2>
                                    <p class="section-subtitle">8 produk disimpan</p>
                                </div>
                                <button class="manage-wishlist-btn">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 1V15M1 8H15" stroke="#2563EB" stroke-width="1.5" stroke-linecap="round"/>
                                    </svg>
                                    <span>Kelola Wishlist</span>
                                </button>
                            </div>
                            <div class="wishlist-grid">
                                <div class="wishlist-item">
                                    <div class="wishlist-image-wrapper">
                                        <div class="wishlist-image">
                                            <img src="http://localhost:3845/assets/ad8502a5a5f7166ea6172767ea7f8020fdc4b11c.png" alt="Mechanical Keyboard RGB">
                                        </div>
                                    </div>
                                    <h4 class="wishlist-title">Mechanical Keyboard<br>RGB</h4>
                                    <p class="wishlist-price">Rp 850.000</p>
                                </div>
                                <div class="wishlist-item">
                                    <div class="wishlist-image-wrapper">
                                        <div class="wishlist-image">
                                            <img src="http://localhost:3845/assets/da3cccc71b0f39a836b57b961b55f63a256834d0.png" alt="Gaming Headset Pro">
                                        </div>
                                    </div>
                                    <h4 class="wishlist-title">Gaming Headset Pro</h4>
                                    <p class="wishlist-price">Rp 650.000</p>
                                </div>
                                <div class="wishlist-item">
                                    <div class="wishlist-image-wrapper">
                                        <div class="wishlist-image">
                                            <img src="http://localhost:3845/assets/98a3d924da8fff7bc7b426fb010061cdc0606376.png" alt="Portable Monitor 15&quot;">
                                        </div>
                                    </div>
                                    <h4 class="wishlist-title">Portable Monitor 15"</h4>
                                    <p class="wishlist-price">Rp 2.100.000</p>
                                </div>
                                <div class="wishlist-item">
                                    <div class="wishlist-image-wrapper">
                                        <div class="wishlist-image">
                                            <img src="http://localhost:3845/assets/05061a4c62ff93e613dda0381e268ff2042abbf8.png" alt="Webcam HD 1080p">
                                        </div>
                                    </div>
                                    <h4 class="wishlist-title">Webcam HD 1080p</h4>
                                    <p class="wishlist-price">Rp 550.000</p>
                                </div>
                                <div class="wishlist-item">
                                    <div class="wishlist-image-wrapper">
                                        <div class="wishlist-image">
                                            <img src="http://localhost:3845/assets/ad8502a5a5f7166ea6172767ea7f8020fdc4b11c.png" alt="Wireless Mouse Pro">
                                        </div>
                                    </div>
                                    <h4 class="wishlist-title">Wireless Mouse Pro</h4>
                                    <p class="wishlist-price">Rp 350.000</p>
                                </div>
                                <div class="wishlist-item">
                                    <div class="wishlist-image-wrapper">
                                        <div class="wishlist-image">
                                            <img src="http://localhost:3845/assets/da3cccc71b0f39a836b57b961b55f63a256834d0.png" alt="USB-C Hub 7-in-1">
                                        </div>
                                    </div>
                                    <h4 class="wishlist-title">USB-C Hub 7-in-1</h4>
                                    <p class="wishlist-price">Rp 425.000</p>
                                </div>
                                <div class="wishlist-item">
                                    <div class="wishlist-image-wrapper">
                                        <div class="wishlist-image">
                                            <img src="http://localhost:3845/assets/98a3d924da8fff7bc7b426fb010061cdc0606376.png" alt="Laptop Stand Aluminium">
                                        </div>
                                    </div>
                                    <h4 class="wishlist-title">Laptop Stand<br>Aluminium</h4>
                                    <p class="wishlist-price">Rp 275.000</p>
                                </div>
                                <div class="wishlist-item">
                                    <div class="wishlist-image-wrapper">
                                        <div class="wishlist-image">
                                            <img src="http://localhost:3845/assets/05061a4c62ff93e613dda0381e268ff2042abbf8.png" alt="USB Flash Drive 128GB">
                                        </div>
                                    </div>
                                    <h4 class="wishlist-title">USB Flash Drive<br>128GB</h4>
                                    <p class="wishlist-price">Rp 180.000</p>
                                </div>
            </div>
                        </section>

                        <!-- Account Settings Section -->
                        <section class="settings-section">
                            <h2 class="section-title">Pengaturan Akun</h2>
                            <div class="settings-list">
                                <div class="setting-item">
                                    <div class="setting-content">
                                        <div class="setting-icon bg-blue">
                                            <svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9 11C11.2091 11 13 9.20914 13 7C13 4.79086 11.2091 3 9 3C6.79086 3 5 4.79086 5 7C5 9.20914 6.79086 11 9 11Z" stroke="#2563EB" stroke-width="1.5"/>
                                                <path d="M1 18C1 14.6863 3.68629 12 7 12H11C14.3137 12 17 14.6863 17 18" stroke="#2563EB" stroke-width="1.5" stroke-linecap="round"/>
                                            </svg>
                                        </div>
                                        <div class="setting-info">
                                            <h3 class="setting-title">Ubah Password</h3>
                                            <p class="setting-desc">Terakhir diubah 30 hari lalu</p>
                                        </div>
                                    </div>
                                    <svg width="10" height="16" viewBox="0 0 10 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2 2L8 8L2 14" stroke="#6B7280" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                                <div class="setting-item">
                                    <div class="setting-content">
                                        <div class="setting-icon bg-purple">
                                            <svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9 2C5.68629 2 3 4.68629 3 8V11C3 11.5523 2.55228 12 2 12H1C0.447715 12 0 12.4477 0 13V16C0 16.5523 0.447715 17 1 17H17C17.5523 17 18 16.5523 18 16V13C18 12.4477 17.5523 12 17 12H16C15.4477 12 15 11.5523 15 11V8C15 4.68629 12.3137 2 9 2Z" stroke="#9333EA" stroke-width="1.5"/>
                                            </svg>
                                        </div>
                                        <div class="setting-info">
                                            <h3 class="setting-title">Notifikasi</h3>
                                            <p class="setting-desc">Kelola preferensi notifikasi</p>
                                        </div>
                                    </div>
                                    <label class="toggle-switch">
                                        <input type="checkbox" checked>
                                        <span class="toggle-slider"></span>
                                    </label>
                                </div>
                                <div class="setting-item">
                                    <div class="setting-content">
                                        <div class="setting-icon bg-green">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10 1L2 5V9C2 13.9706 6.02944 18 11 18H13C17.9706 18 22 13.9706 22 9V5L14 1L10 1Z" stroke="#16A34A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                        <div class="setting-info">
                                            <h3 class="setting-title">Keamanan</h3>
                                            <p class="setting-desc">Two-factor authentication</p>
                                        </div>
                                    </div>
                                    <svg width="10" height="16" viewBox="0 0 10 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2 2L8 8L2 14" stroke="#6B7280" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                                <div class="setting-item">
                                    <div class="setting-content">
                                        <div class="setting-icon bg-orange">
                                            <svg width="25" height="20" viewBox="0 0 25 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12.5 1L1 6V9C1 13.9706 5.02944 18 10 18H15C19.9706 18 24 13.9706 24 9V6L12.5 1Z" stroke="#EA580C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M7 8L12.5 11L18 8" stroke="#EA580C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                        <div class="setting-info">
                                            <h3 class="setting-title">Bahasa</h3>
                                            <p class="setting-desc">Bahasa Indonesia</p>
                                        </div>
                                    </div>
                                    <svg width="10" height="16" viewBox="0 0 10 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2 2L8 8L2 14" stroke="#6B7280" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
            </div>
            </div>
                        </section>
    </div>
</div>
        </div>
        </div>
    </div>
</div>
