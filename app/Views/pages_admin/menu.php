<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Menu - ISBCOMMERCE</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard.css') ?>">
    <style>
        .menu-page {
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

        .menu-section {
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

        .menu-table-container {
            overflow-x: auto;
        }

        .menu-table {
            width: 100%;
            border-collapse: collapse;
        }

        .menu-table thead {
            background: #F9FAFB;
        }

        .menu-table th {
            padding: 12px 16px;
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            color: #6B7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #E5E7EB;
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

        .category-badge {
            display: inline-block;
            padding: 4px 12px;
            background: #DBEAFE;
            color: #1E40AF;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }

        .menu-table td {
            padding: 16px;
            border-bottom: 1px solid #E5E7EB;
            font-size: 14px;
            color: #111827;
        }

        .menu-table tbody tr:hover {
            background: #F9FAFB;
        }

        .category-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 9999px;
            font-size: 12px;
            font-weight: 500;
            background: #EFF6FF;
            color: #2563EB;
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

        .add-menu-section {
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

        .form-input::placeholder,
        .form-textarea::placeholder {
            font-family: 'Inter', sans-serif;
            color: #9CA3AF;
        }

        .form-input:focus,
        .form-select:focus {
            outline: none;
            border-color: #2563EB;
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

        .action-buttons {
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

        @media (max-width: 768px) {
            .menu-page {
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

            .menu-table {
                font-size: 12px;
            }

            .menu-table th,
            .menu-table td {
                padding: 12px 8px;
            }
        }

        @media (max-width: 390px) {
            .menu-page {
                padding: 12px;
            }

            .form-title {
                font-size: 18px;
            }

            .menu-table th,
            .menu-table td {
                padding: 8px 4px;
                font-size: 11px;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <?= view('layout/sidebar_admin', ['activeMenu' => 'menu']) ?>

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

            <!-- Menu Page Content -->
            <main class="dashboard-main">
                <div class="menu-page">
                    <div class="page-header">
                        <h1 class="page-title">Manajemen Menu</h1>
                        <p class="page-subtitle">Kelola menu produk sesuai dengan kategori</p>
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

                    <!-- Menu List Section -->
                    <div class="menu-section">
                        <div class="section-header">
                            <div class="section-title-group">
                                <h2>Daftar Menu</h2>
                                <p>Total: <?= number_format($totalMenu ?? 0, 0, ',', '.') ?> menu</p>
                            </div>
                            <button class="btn-primary" onclick="document.getElementById('addMenuForm').scrollIntoView({behavior: 'smooth'})">
                                <img src="<?= base_url('assets/img/pluswhite.png') ?>" alt="Tambah Menu">
                                <span>Tambah Menu</span>
                            </button>
                        </div>

                        <div class="menu-table-container">
                            <table class="menu-table">
                                <thead>
                                    <tr>
                                        <th>Nama Menu</th>
                                        <th>Kategori</th>
                                        <th>Jumlah Produk</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($menu)): ?>
                                        <?php foreach ($menu as $m): ?>
                                            <tr>
                                                <td><strong><?= esc($m['nama_menu']) ?></strong></td>
                                                <td><span class="category-badge"><?= esc($m['nama_kategori'] ?? '-') ?></span></td>
                                                <td><?= number_format($m['jumlah_produk'] ?? 0, 0, ',', '.') ?> produk</td>
                                                <td><span class="status-badge <?= $m['status'] === 'aktif' ? 'active' : 'inactive' ?>"><?= $m['status'] === 'aktif' ? 'Aktif' : 'Tidak Aktif' ?></span></td>
                                                <td>
                                                    <div class="action-buttons">
                                                        <button class="action-btn" onclick="editMenu(<?= $m['id_menu'] ?>, '<?= esc($m['nama_menu'], 'js') ?>', <?= $m['id_kategori'] ?>, '<?= esc($m['deskripsi_menu'] ?? '', 'js') ?>', '<?= esc($m['status'], 'js') ?>')">
                                                            <img src="<?= base_url('assets/img/icon-edit.png') ?>" alt="Edit">
                                                        </button>
                                                        <button class="action-btn" onclick="hapusMenu(<?= $m['id_menu'] ?>)">
                                                            <img src="<?= base_url('assets/img/icon-tongsampah.png') ?>" alt="Hapus">
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" style="text-align: center; padding: 40px; color: #6B7280;">
                                                Belum ada menu. Silakan tambah menu baru.
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Add Menu Form Section -->
                    <div class="add-menu-section" id="addMenuForm">
                        <div class="form-header">
                            <h2 class="form-title">Tambah Menu Baru</h2>
                            <p class="form-subtitle">Lengkapi informasi menu yang akan ditambahkan</p>
                        </div>

                        <form id="menuForm" action="<?= base_url('admin/simpan_menu') ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="id_menu" id="id_menu" value="">
                            <div class="form-grid">
                                <!-- Menu Name -->
                                <div class="form-group">
                                    <label class="form-label required">Nama Menu</label>
                                    <input type="text" name="nama_menu" id="nama_menu" class="form-input" placeholder="Masukkan nama menu" required>
                                </div>

                                <!-- Category Selection -->
                                <div class="form-group">
                                    <label class="form-label required">Kategori</label>
                                    <select name="id_kategori" id="id_kategori" class="form-select" required>
                                        <option value="">Pilih kategori</option>
                                        <?php if (!empty($kategori)): ?>
                                            <?php foreach ($kategori as $kat): ?>
                                                <option value="<?= $kat['id_kategori'] ?>"><?= esc($kat['nama_kategori']) ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>

                                <!-- Description -->
                                <div class="form-group full-width">
                                    <label class="form-label">Deskripsi Menu</label>
                                    <textarea name="deskripsi_menu" id="deskripsi_menu" class="form-textarea" placeholder="Masukkan deskripsi menu"></textarea>
                                </div>

                                <!-- Status -->
                                <div class="form-group full-width">
                                    <label class="form-label">Status Menu</label>
                                    <div class="radio-group">
                                        <div class="radio-option">
                                            <input type="radio" id="menu-status-aktif" name="status" value="aktif" checked>
                                            <label for="menu-status-aktif">Aktif</label>
                                        </div>
                                        <div class="radio-option">
                                            <input type="radio" id="menu-status-tidak-aktif" name="status" value="tidak_aktif">
                                            <label for="menu-status-tidak-aktif">Tidak Aktif</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="form-actions">
                                <button type="submit" class="btn-submit" id="submitBtn">
                                    <img src="<?= base_url('assets/img/pluswhite.png') ?>" alt="Plus">
                                    <span id="submitText">Tambah Menu</span>
                                </button>
                                <button type="button" class="btn-cancel" onclick="resetForm()">Batal</button>
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

        // Edit Menu
        function editMenu(id, nama, idKategori, deskripsi, status) {
            document.getElementById('id_menu').value = id;
            document.getElementById('nama_menu').value = nama;
            document.getElementById('id_kategori').value = idKategori;
            document.getElementById('deskripsi_menu').value = deskripsi || '';
            document.getElementById('submitText').textContent = 'Update Menu';
            document.getElementById('menuForm').action = '<?= base_url('admin/update_menu') ?>/' + id;
            
            // Set status radio
            if (status === 'aktif') {
                document.getElementById('menu-status-aktif').checked = true;
            } else {
                document.getElementById('menu-status-tidak-aktif').checked = true;
            }
            
            // Scroll to form
            document.getElementById('addMenuForm').scrollIntoView({behavior: 'smooth'});
        }

        // Hapus Menu
        function hapusMenu(id) {
            if (confirm('Apakah Anda yakin ingin menghapus menu ini?')) {
                window.location.href = '<?= base_url('admin/hapus_menu') ?>/' + id;
            }
        }

        // Reset Form
        function resetForm() {
            document.getElementById('menuForm').reset();
            document.getElementById('id_menu').value = '';
            document.getElementById('submitText').textContent = 'Tambah Menu';
            document.getElementById('menuForm').action = '<?= base_url('admin/simpan_menu') ?>';
            document.getElementById('menu-status-aktif').checked = true;
        }
    </script>
</body>

</html>

