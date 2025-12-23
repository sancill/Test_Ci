<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Toko - ISBCOMMERCE</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard.css') ?>">
    <style>
        .settings-page {
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

        .settings-section {
            background: #FFFFFF;
            border-radius: 12px;
            border: 1px solid #E5E7EB;
            padding: clamp(20px, 2.5vw, 32px);
            margin-bottom: 24px;
        }

        .section-title {
            font-size: clamp(18px, 2vw, 20px);
            font-weight: 600;
            color: #111827;
            margin-bottom: clamp(16px, 2vw, 24px);
            padding-bottom: 12px;
            border-bottom: 1px solid #E5E7EB;
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
            min-height: 120px;
            resize: vertical;
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

        .file-preview-item.banner-item {
            width: 100%;
            height: auto;
            max-height: 300px;
        }

        .file-preview-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .file-preview-item.banner-item img {
            width: 100%;
            height: auto;
            max-height: 300px;
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

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 9999px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-badge.verified {
            background: #D1FAE5;
            color: #065F46;
        }

        .status-badge.official {
            background: #DBEAFE;
            color: #1E40AF;
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

        .time-input-group {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        @media (max-width: 768px) {
            .settings-page {
                padding: 16px;
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

            .time-input-group {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 390px) {
            .settings-page {
                padding: 12px;
            }

            .section-title {
                font-size: 16px;
            }

            .upload-area {
                padding: 24px 16px;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <?= view('layout/sidebar_admin', ['activeMenu' => 'setting_toko']) ?>

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

            <!-- Settings Page Content -->
            <main class="dashboard-main">
                <div class="settings-page">
                    <div class="page-header">
                        <h1 class="page-title">Pengaturan Toko & Branding</h1>
                        <p class="page-subtitle">Kelola informasi toko, branding, dan kontak customer service</p>
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

                    <form id="storeSettingsForm" action="<?= base_url('admin/update_toko') ?>" method="POST" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        
                        <!-- Store Information Section -->
                        <div class="settings-section">
                            <h2 class="section-title">Informasi Toko</h2>
                            <div class="form-grid">
                                <!-- Store Name -->
                                <div class="form-group">
                                    <label class="form-label required">Nama Toko</label>
                                    <input type="text" name="nama_toko" class="form-input" placeholder="Masukkan nama toko" value="<?= esc($toko['nama_toko'] ?? 'ISBCOMMERCE') ?>" required>
                                </div>

                                <!-- Store Status -->
                                <div class="form-group">
                                    <label class="form-label">Status Toko</label>
                                    <div class="radio-group">
                                        <div class="radio-option">
                                            <input type="radio" id="status-verified" name="status_toko" value="verified_seller" <?= ($toko['status_toko'] ?? 'verified_seller') === 'verified_seller' ? 'checked' : '' ?>>
                                            <label for="status-verified">Verified Seller</label>
                                        </div>
                                        <div class="radio-option">
                                            <input type="radio" id="status-official" name="status_toko" value="official_store" <?= ($toko['status_toko'] ?? '') === 'official_store' ? 'checked' : '' ?>>
                                            <label for="status-official">Official Store</label>
                                        </div>
                                    </div>
                                    <div style="margin-top: 8px;">
                                        <span class="status-badge <?= ($toko['status_toko'] ?? 'verified_seller') === 'verified_seller' ? 'verified' : 'official' ?>">
                                            ✓ <?= ($toko['status_toko'] ?? 'verified_seller') === 'verified_seller' ? 'Verified Seller' : 'Official Store' ?>
                                        </span>
                                    </div>
                                </div>

                                <!-- Store Logo -->
                                <div class="form-group">
                                    <label class="form-label">Logo Toko</label>
                                    <div class="upload-area" id="logoUpload">
                                        <svg class="upload-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7 18C4.23858 18 2 15.7614 2 13C2 10.2386 4.23858 8 7 8C7.35138 8 7.68838 8.03357 8.01116 8.09569C8.54744 6.13037 10.3453 4.75 12.5 4.75C15.1234 4.75 17.25 6.87665 17.25 9.5C17.25 9.77614 17.2239 10.0458 17.1746 10.3069C18.4659 10.9846 19.25 12.3515 19.25 13.875C19.25 16.1868 17.4368 18 15.125 18H7Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M12 8V16M8 12H16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        </svg>
                                        <p class="upload-text">Klik untuk upload atau drag & drop</p>
                                        <p class="upload-hint">PNG, JPG, SVG hingga 5MB</p>
                                        <input type="file" name="logo_toko" id="storeLogo" accept="image/*" style="display: none;">
                                        <div id="logoPreviewContainer" class="image-preview-container"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Admin Information Section -->
                        <div class="settings-section">
                            <h2 class="section-title">Informasi Admin</h2>
                            <div class="form-grid">
                                <!-- Admin Name -->
                                <div class="form-group">
                                    <label class="form-label required">Nama Lengkap</label>
                                    <input type="text" name="nama_admin" class="form-input" placeholder="Masukkan nama lengkap" value="<?= esc($toko['nama_admin'] ?? 'Muhammad Iskandar') ?>" required>
                                </div>

                                <!-- Username -->
                                <div class="form-group">
                                    <label class="form-label required">Username</label>
                                    <input type="text" name="username_admin" class="form-input" placeholder="@username" value="<?= esc($toko['username_admin'] ?? '@admin_isb') ?>" required>
                                </div>

                                <!-- Email Admin -->
                                <div class="form-group">
                                    <label class="form-label required">Email Admin</label>
                                    <input type="email" name="email_admin" class="form-input" placeholder="admin@isbcommerce.com" value="<?= esc($toko['email_admin'] ?? 'admin@isbcommerce.com') ?>" required>
                                </div>

                                <!-- Phone Admin -->
                                <div class="form-group">
                                    <label class="form-label required">Nomor Telepon</label>
                                    <input type="text" name="telepon_admin" class="form-input" placeholder="+6281234567890" value="<?= esc($toko['telepon_admin'] ?? '+62 812-3456-7890') ?>" required>
                                </div>
                            </div>
                        </div>

                        <!-- Address & Location Section -->
                        <div class="settings-section">
                            <h2 class="section-title">Alamat & Lokasi Pengiriman</h2>
                            <div class="form-grid">
                                <!-- Full Address -->
                                <div class="form-group full-width">
                                    <label class="form-label required">Alamat Lengkap</label>
                                    <textarea name="alamat_toko" class="form-textarea" placeholder="Masukkan alamat lengkap toko" required><?= esc($toko['alamat_toko'] ?? 'Jl. Jenderal Sudirman No. 123, Jakarta Pusat, DKI Jakarta 10220') ?></textarea>
                                </div>

                                <!-- City -->
                                <div class="form-group">
                                    <label class="form-label required">Kota</label>
                                    <input type="text" name="kota" class="form-input" placeholder="Masukkan kota" value="<?= esc($toko['kota'] ?? 'Jakarta Pusat') ?>" required>
                                </div>

                                <!-- Province -->
                                <div class="form-group">
                                    <label class="form-label required">Provinsi</label>
                                    <input type="text" name="provinsi" class="form-input" placeholder="Masukkan provinsi" value="<?= esc($toko['provinsi'] ?? 'DKI Jakarta') ?>" required>
                                </div>

                                <!-- Postal Code -->
                                <div class="form-group">
                                    <label class="form-label required">Kode Pos</label>
                                    <input type="text" name="kode_pos" class="form-input" placeholder="Masukkan kode pos" value="<?= esc($toko['kode_pos'] ?? '10220') ?>" required>
                                </div>

                                <!-- Country -->
                                <div class="form-group">
                                    <label class="form-label">Negara</label>
                                    <input type="text" name="negara" class="form-input" placeholder="Indonesia" value="<?= esc($toko['negara'] ?? 'Indonesia') ?>">
                                </div>
                            </div>
                        </div>

                        <!-- Customer Service Section -->
                        <div class="settings-section">
                            <h2 class="section-title">Kontak Customer Service</h2>
                            <div class="form-grid">
                                <!-- Email CS -->
                                <div class="form-group">
                                    <label class="form-label required">Email CS</label>
                                    <input type="email" name="email_cs" class="form-input" placeholder="cs@isbcommerce.com" value="<?= esc($toko['email_cs'] ?? 'cs@isbcommerce.com') ?>" required>
                                </div>

                                <!-- WhatsApp CS -->
                                <div class="form-group">
                                    <label class="form-label required">WhatsApp CS</label>
                                    <input type="text" name="whatsapp_cs" class="form-input" placeholder="+6281234567890" value="<?= esc($toko['whatsapp_cs'] ?? '+6281234567890') ?>" required>
                                </div>

                                <!-- Operating Hours -->
                                <div class="form-group full-width">
                                    <label class="form-label required">Jam Operasional</label>
                                    <div class="time-input-group">
                                        <input type="time" name="jam_operasional_buka" class="form-input" value="<?= esc($toko['jam_operasional_buka'] ?? '09:00') ?>" required>
                                        <input type="time" name="jam_operasional_tutup" class="form-input" value="<?= esc($toko['jam_operasional_tutup'] ?? '17:00') ?>" required>
                                    </div>
                                    <p style="font-size: 12px; color: #6B7280; margin-top: 4px;">Format: Jam Buka - Jam Tutup</p>
                                </div>
                            </div>
                        </div>

                        <!-- Store Branding Section -->
                        <div class="settings-section">
                            <h2 class="section-title">Branding Toko</h2>
                            <div class="form-grid">
                                <!-- Store Banner -->
                                <div class="form-group full-width">
                                    <label class="form-label">Banner Toko</label>
                                    <div class="upload-area" id="bannerUpload">
                                        <svg class="upload-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7 18C4.23858 18 2 15.7614 2 13C2 10.2386 4.23858 8 7 8C7.35138 8 7.68838 8.03357 8.01116 8.09569C8.54744 6.13037 10.3453 4.75 12.5 4.75C15.1234 4.75 17.25 6.87665 17.25 9.5C17.25 9.77614 17.2239 10.0458 17.1746 10.3069C18.4659 10.9846 19.25 12.3515 19.25 13.875C19.25 16.1868 17.4368 18 15.125 18H7Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M12 8V16M8 12H16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        </svg>
                                        <p class="upload-text">Klik untuk upload atau drag & drop</p>
                                        <p class="upload-hint">PNG, JPG hingga 10MB (Rekomendasi: 1920x400px)</p>
                                        <input type="file" name="banner_toko" id="storeBanner" accept="image/*" style="display: none;">
                                        <div id="bannerPreviewContainer" class="image-preview-container"></div>
                                    </div>
                                </div>

                                <!-- Store Description -->
                                <div class="form-group full-width">
                                    <label class="form-label required">Deskripsi Profil Toko</label>
                                    <textarea name="deskripsi_toko" class="form-textarea" placeholder="Jelaskan tentang toko Anda..." required><?= esc($toko['deskripsi_toko'] ?? 'ISBCOMMERCE adalah marketplace terpercaya yang menyediakan berbagai produk elektronik, fashion, dan kebutuhan sehari-hari dengan kualitas terbaik dan harga terjangkau. Kami berkomitmen memberikan pelayanan terbaik untuk kepuasan pelanggan.') ?></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="form-actions">
                            <button type="submit" class="btn-submit">
                                <span>Simpan Pengaturan</span>
                            </button>
                            <a href="<?= base_url('admin/profile_toko') ?>" class="btn-cancel" style="text-decoration: none; display: inline-block;">Batal</a>
                            <?php if (!empty($toko['id_toko'])): ?>
                                <button type="button" class="btn-cancel" onclick="if(confirm('Apakah Anda yakin ingin menghapus data toko?')) { window.location.href='<?= base_url('admin/delete_toko/' . $toko['id_toko']) ?>'; }" style="background: #FEE2E2; color: #991B1B;">
                                    Hapus Data
                                </button>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <!-- Sidebar Toggle Script - Centralized -->
    <script src="<?= base_url('assets/js/sidebar.js') ?>"></script>
    
    <script>

        // File Upload Functionality - Consistent with produk.php
        const logoUpload = document.getElementById('logoUpload');
        const storeLogo = document.getElementById('storeLogo');
        const logoPreviewContainer = document.getElementById('logoPreviewContainer');
        let selectedLogoFile = null;

        // Load existing logo if available
        <?php if (!empty($toko['logo_toko'])): ?>
        const existingLogo = '<?= base_url($toko['logo_toko']) ?>';
        logoPreviewContainer.innerHTML = `
            <div class="file-preview-item">
                <img src="${existingLogo}" alt="Logo Preview">
                <button type="button" class="remove-btn" onclick="removeLogoPreview()">×</button>
            </div>
        `;
        <?php endif; ?>

        // Load from localStorage if available
        const savedLogo = localStorage.getItem('toko_logo_preview');
        if (savedLogo && !logoPreviewContainer.innerHTML.trim()) {
            logoPreviewContainer.innerHTML = `
                <div class="file-preview-item">
                    <img src="${savedLogo}" alt="Logo Preview">
                    <button type="button" class="remove-btn" onclick="removeLogoPreview()">×</button>
                </div>
            `;
        }

        logoUpload.addEventListener('click', () => {
            storeLogo.click();
        });

        logoUpload.addEventListener('dragover', (e) => {
            e.preventDefault();
            logoUpload.classList.add('dragover');
        });

        logoUpload.addEventListener('dragleave', () => {
            logoUpload.classList.remove('dragover');
        });

        logoUpload.addEventListener('drop', (e) => {
            e.preventDefault();
            logoUpload.classList.remove('dragover');
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                handleLogoSelect(files[0]);
            }
        });

        storeLogo.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                handleLogoSelect(e.target.files[0]);
            }
        });

        function handleLogoSelect(file) {
            if (file && file.type.startsWith('image/')) {
                selectedLogoFile = file;
                const reader = new FileReader();
                reader.onload = function(e) {
                    logoPreviewContainer.innerHTML = `
                        <div class="file-preview-item">
                            <img src="${e.target.result}" alt="Logo Preview">
                            <button type="button" class="remove-btn" onclick="removeLogoPreview()">×</button>
                        </div>
                    `;
                    // Save to localStorage
                    localStorage.setItem('toko_logo_preview', e.target.result);
                };
                reader.readAsDataURL(file);
            }
        }

        function removeLogoPreview() {
            logoPreviewContainer.innerHTML = '';
            selectedLogoFile = null;
            storeLogo.value = '';
            localStorage.removeItem('toko_logo_preview');
        }

        const bannerUpload = document.getElementById('bannerUpload');
        const storeBanner = document.getElementById('storeBanner');
        const bannerPreviewContainer = document.getElementById('bannerPreviewContainer');
        let selectedBannerFile = null;

        // Load existing banner if available
        <?php if (!empty($toko['banner_toko'])): ?>
        const existingBanner = '<?= base_url($toko['banner_toko']) ?>';
        bannerPreviewContainer.innerHTML = `
            <div class="file-preview-item banner-item">
                <img src="${existingBanner}" alt="Banner Preview">
                <button type="button" class="remove-btn" onclick="removeBannerPreview()">×</button>
            </div>
        `;
        <?php endif; ?>

        // Load from localStorage if available
        const savedBanner = localStorage.getItem('toko_banner_preview');
        if (savedBanner && !bannerPreviewContainer.innerHTML.trim()) {
            bannerPreviewContainer.innerHTML = `
                <div class="file-preview-item banner-item">
                    <img src="${savedBanner}" alt="Banner Preview">
                    <button type="button" class="remove-btn" onclick="removeBannerPreview()">×</button>
                </div>
            `;
        }

        bannerUpload.addEventListener('click', () => {
            storeBanner.click();
        });

        bannerUpload.addEventListener('dragover', (e) => {
            e.preventDefault();
            bannerUpload.classList.add('dragover');
        });

        bannerUpload.addEventListener('dragleave', () => {
            bannerUpload.classList.remove('dragover');
        });

        bannerUpload.addEventListener('drop', (e) => {
            e.preventDefault();
            bannerUpload.classList.remove('dragover');
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                handleBannerSelect(files[0]);
            }
        });

        storeBanner.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                handleBannerSelect(e.target.files[0]);
            }
        });

        function handleBannerSelect(file) {
            if (file && file.type.startsWith('image/')) {
                selectedBannerFile = file;
                const reader = new FileReader();
                reader.onload = function(e) {
                    bannerPreviewContainer.innerHTML = `
                        <div class="file-preview-item banner-item">
                            <img src="${e.target.result}" alt="Banner Preview">
                            <button type="button" class="remove-btn" onclick="removeBannerPreview()">×</button>
                        </div>
                    `;
                    // Save to localStorage
                    localStorage.setItem('toko_banner_preview', e.target.result);
                };
                reader.readAsDataURL(file);
            }
        }

        function removeBannerPreview() {
            bannerPreviewContainer.innerHTML = '';
            selectedBannerFile = null;
            storeBanner.value = '';
            localStorage.removeItem('toko_banner_preview');
        }

        // Clear localStorage on successful form submission
        document.getElementById('storeSettingsForm').addEventListener('submit', function(e) {
            // Don't clear immediately, wait for success response
            // Will be cleared after successful save
        });

        // Clear localStorage if form is successfully submitted
        window.addEventListener('load', function() {
            <?php if (session()->getFlashdata('success')): ?>
                localStorage.removeItem('toko_logo_preview');
                localStorage.removeItem('toko_banner_preview');
            <?php endif; ?>
        });
    </script>
</body>

</html>

