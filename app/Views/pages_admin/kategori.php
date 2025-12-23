<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kategori - ISBCOMMERCE</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard.css') ?>">
    <style>
        .categories-page {
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

        .categories-section {
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

        .category-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }

        .category-card {
            border: 1px solid #E5E7EB;
            border-radius: 12px;
            padding: 21px;
            position: relative;
            transition: all 0.2s;
        }

        .category-card:hover {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .category-icon {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            overflow: hidden;
        }

        .category-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 8px;
        }

        .category-actions {
            position: absolute;
            top: 21px;
            right: 21px;
            display: flex;
            gap: 8px;
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

        .category-name {
            font-size: 18px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 8px;
        }

        .category-count {
            font-size: 14px;
            color: #6B7280;
            margin-bottom: 12px;
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

        .add-category-section {
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

        .upload-icon {
            width: 40px;
            height: 40px;
            margin: 0 auto 12px;
            color: #9CA3AF;
        }

        .upload-text {
            font-size: 14px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 4px;
        }

        .upload-hint {
            font-size: 12px;
            color: #6B7280;
        }

        .preview-image {
            width: 100%;
            max-width: 150px;
            height: auto;
            border-radius: 8px;
            margin: 12px auto 0;
            display: block;
            object-fit: cover;
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
            .categories-page {
                padding: 16px;
            }

            .category-grid {
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
            .categories-page {
                padding: 12px;
            }

            .category-card {
                padding: 16px;
            }

            .category-icon {
                width: 40px;
                height: 40px;
            }

            .form-title {
                font-size: 18px;
            }

            .upload-area {
                padding: 24px 16px;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <?= view('layout/sidebar_admin', ['activeMenu' => 'kategori']) ?>

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

            <!-- Categories Page Content -->
            <main class="dashboard-main">
                <div class="categories-page">
                    <div class="page-header">
                        <h1 class="page-title">Manajemen Kategori</h1>
                        <p class="page-subtitle">Kelola kategori produk di toko Anda</p>
                    </div>

                    <!-- Success/Error Messages -->
                    <?php if (session()->getFlashdata('success')): ?>
                        <div style="background: #D1FAE5; color: #065F46; padding: 12px 16px; border-radius: 8px; margin-bottom: 24px; border: 1px solid #A7F3D0;">
                            <?= session()->getFlashdata('success') ?>
                        </div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('error')): ?>
                        <div style="background: #FEE2E2; color: #991B1B; padding: 12px 16px; border-radius: 8px; margin-bottom: 24px; border: 1px solid #FECACA;">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('errors')): ?>
                        <div style="background: #FEE2E2; color: #991B1B; padding: 12px 16px; border-radius: 8px; margin-bottom: 24px; border: 1px solid #FECACA;">
                            <ul style="margin: 0; padding-left: 20px;">
                                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                    <li><?= $error ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <!-- Categories List Section -->
                    <div class="categories-section">
                        <div class="section-header">
                            <div class="section-title-group">
                                <h2>Daftar Kategori</h2>
                                <p>Total: <?= number_format($totalKategori ?? 0, 0, ',', '.') ?> kategori</p>
                            </div>
                            <button class="btn-primary" onclick="document.getElementById('addCategoryForm').scrollIntoView({behavior: 'smooth'})">
                                <img src="<?= base_url('assets/img/pluswhite.png') ?>" alt="Tambah Kategori">
                                <span>Tambah Kategori</span>
                            </button>
                        </div>

                        <div class="category-grid">
                            <?php if (!empty($kategori)): ?>
                                <?php 
                                $colors = ['#F3E8FF', '#DBEAFE', '#FEF3C7', '#D1FAE5', '#FCE7F3', '#E0E7FF', '#FFEDD5', '#DCFCE7'];
                                foreach ($kategori as $index => $kat): 
                                    $bgColor = $colors[$index % count($colors)];
                                ?>
                                    <div class="category-card">
                                        <div class="category-icon" style="background: <?= $bgColor ?>;">
                                            <?php if (!empty($kat['icon_kategori'])): ?>
                                                <img src="<?= base_url($kat['icon_kategori']) ?>" alt="<?= esc($kat['nama_kategori']) ?>">
                                            <?php else: ?>
                                                <img src="<?= base_url('assets/img/categories.png') ?>" alt="<?= esc($kat['nama_kategori']) ?>">
                                            <?php endif; ?>
                                        </div>
                                        <div class="category-actions">
                                            <button class="action-btn" onclick="window.location.href='<?= base_url('admin/kategori?edit=' . $kat['id_kategori']) ?>'" title="Edit Kategori">
                                                <img src="<?= base_url('assets/img/icon-edit.png') ?>" alt="Edit">
                                            </button>
                                            <button class="action-btn" onclick="hapusKategori(<?= $kat['id_kategori'] ?>)" title="Hapus Kategori">
                                                <img src="<?= base_url('assets/img/icon-tongsampah.png') ?>" alt="Hapus">
                                            </button>
                                        </div>
                                        <h3 class="category-name"><?= esc($kat['nama_kategori']) ?></h3>
                                        <p class="category-count"><?= number_format($kat['jumlah_produk'] ?? 0, 0, ',', '.') ?> produk</p>
                                        <span class="status-badge <?= $kat['status'] === 'aktif' ? 'active' : 'inactive' ?>">
                                            <?= $kat['status'] === 'aktif' ? 'Aktif' : 'Tidak Aktif' ?>
                                        </span>
                                        <div style="margin-top: 12px;">
                                            <a href="<?= base_url('admin/produk?kategori=' . $kat['id_kategori']) ?>" class="btn-primary" style="text-decoration: none; display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; font-size: 13px; border-radius: 8px;">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 14px; height: 14px;">
                                                    <path d="M12 5V19M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                                <span>Tambah Produk</span>
                                            </a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #6B7280;">
                                    Belum ada kategori. Silakan tambah kategori baru.
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Add Category Form Section -->
                    <div class="add-category-section" id="addCategoryForm">
                        <div class="form-header">
                            <h2 class="form-title"><?= isset($editId) && $editId ? 'Edit Kategori' : 'Tambah Kategori Baru' ?></h2>
                            <p class="form-subtitle"><?= isset($editId) && $editId ? 'Ubah informasi kategori yang ada' : 'Lengkapi informasi kategori yang akan ditambahkan' ?></p>
                        </div>

                        <form id="categoryForm" action="<?= isset($editId) && $editId ? base_url('admin/update_kategori/' . $editId) : base_url('admin/simpan_kategori') ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <input type="hidden" name="id_kategori" id="id_kategori" value="<?= isset($editId) && $editId ? $editId : '' ?>">
                            <div class="form-grid">
                                <!-- Category Icon Upload -->
                                <div class="form-group">
                                    <label class="form-label">Icon Kategori</label>
                                    <div class="upload-area" id="categoryIconUpload">
                                        <?php if (isset($kategoriEdit) && $kategoriEdit && !empty($kategoriEdit['icon_kategori'])): ?>
                                            <img id="iconPreview" class="preview-image" src="<?= base_url($kategoriEdit['icon_kategori']) ?>" alt="Icon Preview">
                                            <svg class="upload-icon" id="uploadIconSvg" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                                <path d="M7 18C4.23858 18 2 15.7614 2 13C2 10.2386 4.23858 8 7 8C7.35138 8 7.68838 8.03357 8.01116 8.09569C8.54744 6.13037 10.3453 4.75 12.5 4.75C15.1234 4.75 17.25 6.87665 17.25 9.5C17.25 9.77614 17.2239 10.0458 17.1746 10.3069C18.4659 10.9846 19.25 12.3515 19.25 13.875C19.25 16.1868 17.4368 18 15.125 18H7Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M12 8V16M8 12H16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                            </svg>
                                            <p class="upload-text" id="uploadText">Klik untuk mengganti icon</p>
                                        <?php else: ?>
                                            <img id="iconPreview" class="preview-image" src="" alt="Icon Preview" style="display: none;">
                                            <svg class="upload-icon" id="uploadIconSvg" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M7 18C4.23858 18 2 15.7614 2 13C2 10.2386 4.23858 8 7 8C7.35138 8 7.68838 8.03357 8.01116 8.09569C8.54744 6.13037 10.3453 4.75 12.5 4.75C15.1234 4.75 17.25 6.87665 17.25 9.5C17.25 9.77614 17.2239 10.0458 17.1746 10.3069C18.4659 10.9846 19.25 12.3515 19.25 13.875C19.25 16.1868 17.4368 18 15.125 18H7Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M12 8V16M8 12H16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                            </svg>
                                            <p class="upload-text" id="uploadText">Klik untuk upload</p>
                                        <?php endif; ?>
                                        <p class="upload-hint">PNG, JPG, GIF hingga 5MB</p>
                                        <input type="file" id="categoryIcon" name="icon_kategori" accept="image/*" style="display: none;">
                                    </div>
                                </div>

                                <!-- Category Name -->
                                <div class="form-group">
                                    <label class="form-label required">Nama Kategori</label>
                                    <input type="text" name="nama_kategori" id="nama_kategori" class="form-input" placeholder="Masukkan nama kategori" value="<?= isset($kategoriEdit) && $kategoriEdit ? esc($kategoriEdit['nama_kategori']) : '' ?>" required>
                                </div>

                                <!-- Category Description -->
                                <div class="form-group full-width">
                                    <label class="form-label">Deskripsi Kategori</label>
                                    <textarea name="deskripsi_kategori" id="deskripsi_kategori" class="form-textarea" placeholder="Jelaskan kategori produk..."><?= isset($kategoriEdit) && $kategoriEdit ? esc($kategoriEdit['deskripsi_kategori'] ?? '') : '' ?></textarea>
                                </div>

                                <!-- Status -->
                                <div class="form-group full-width">
                                    <label class="form-label">Status Kategori</label>
                                    <div class="radio-group">
                                        <div class="radio-option">
                                            <input type="radio" id="cat-status-aktif" name="status" value="aktif" <?= (isset($kategoriEdit) && $kategoriEdit && ($kategoriEdit['status'] ?? 'aktif') === 'aktif') || !isset($kategoriEdit) ? 'checked' : '' ?>>
                                            <label for="cat-status-aktif">Aktif</label>
                                        </div>
                                        <div class="radio-option">
                                            <input type="radio" id="cat-status-tidak-aktif" name="status" value="tidak_aktif" <?= (isset($kategoriEdit) && $kategoriEdit && ($kategoriEdit['status'] ?? '') === 'tidak_aktif') ? 'checked' : '' ?>>
                                            <label for="cat-status-tidak-aktif">Tidak Aktif</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="form-actions">
                                <button type="submit" class="btn-submit" id="submitBtn">
                                    <img src="<?= base_url('assets/img/pluswhite.png') ?>" alt="Plus">
                                    <span id="submitText"><?= isset($editId) && $editId ? 'Update Kategori' : 'Tambah Kategori' ?></span>
                                </button>
                                <?php if (isset($editId) && $editId): ?>
                                    <a href="<?= base_url('admin/kategori') ?>" class="btn-cancel" style="text-decoration: none; display: inline-flex; align-items: center;">Batal Edit</a>
                                <?php else: ?>
                                    <button type="button" class="btn-cancel" onclick="resetForm()">Batal</button>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Sidebar Toggle Script - Centralized -->
    <script src="<?= base_url('assets/js/sidebar.js') ?>"></script>
    
    <script>

        // File Upload
        const categoryIconUpload = document.getElementById('categoryIconUpload');
        const categoryIcon = document.getElementById('categoryIcon');

        categoryIconUpload.addEventListener('click', () => {
            categoryIcon.click();
        });

        categoryIcon.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                const file = e.target.files[0];
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('iconPreview');
                    const uploadSvg = document.getElementById('uploadIconSvg');
                    const uploadText = document.getElementById('uploadText');
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    uploadSvg.style.display = 'none';
                    uploadText.textContent = 'Klik untuk mengganti icon';
                };
                reader.readAsDataURL(file);
            }
        });

        // Edit Kategori
        function editKategori(id, nama, deskripsi, status, iconPath) {
            document.getElementById('id_kategori').value = id;
            document.getElementById('nama_kategori').value = nama;
            document.getElementById('deskripsi_kategori').value = deskripsi || '';
            document.getElementById('submitText').textContent = 'Update Kategori';
            document.getElementById('categoryForm').action = '<?= base_url('admin/update_kategori') ?>/' + id;
            
            // Set icon preview if exists
            if (iconPath) {
                const preview = document.getElementById('iconPreview');
                const uploadSvg = document.getElementById('uploadIconSvg');
                const uploadText = document.getElementById('uploadText');
                preview.src = '<?= base_url() ?>' + iconPath;
                preview.style.display = 'block';
                uploadSvg.style.display = 'none';
                uploadText.textContent = 'Klik untuk mengganti icon';
            }
            
            // Set status radio
            if (status === 'aktif') {
                document.getElementById('cat-status-aktif').checked = true;
            } else {
                document.getElementById('cat-status-tidak-aktif').checked = true;
            }
            
            // Scroll to form
            document.getElementById('addCategoryForm').scrollIntoView({behavior: 'smooth'});
        }

        // Hapus Kategori
        function hapusKategori(id) {
            if (confirm('Apakah Anda yakin ingin menghapus kategori ini?')) {
                window.location.href = '<?= base_url('admin/hapus_kategori') ?>/' + id;
            }
        }

        // Reset Form
        function resetForm() {
            document.getElementById('categoryForm').reset();
            document.getElementById('id_kategori').value = '';
            document.getElementById('submitText').textContent = 'Tambah Kategori';
            document.getElementById('categoryForm').action = '<?= base_url('admin/simpan_kategori') ?>';
            const preview = document.getElementById('iconPreview');
            const uploadSvg = document.getElementById('uploadIconSvg');
            const uploadText = document.getElementById('uploadText');
            preview.style.display = 'none';
            uploadSvg.style.display = 'block';
            uploadText.textContent = 'Klik untuk upload';
            document.getElementById('cat-status-aktif').checked = true;
        }
    </script>
</body>

</html>

