    <style>
body {
    background: #f9fafb;
    font-family: 'Inter', sans-serif;
}

.product-header {
    background: white;
    border-bottom: 1px solid #e4e7ec;
    height: 72px;
    position: sticky;
    top: 0;
    z-index: 100;
    box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.05);
}

.product-header__content {
    max-width: 1280px;
    margin: 0 auto;
    padding: 16px 80px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.product-header__left {
    display: flex;
    align-items: center;
    gap: 32px;
}

.product-nav {
    display: flex;
    gap: 24px;
}

.product-nav a {
    font-size: 16px;
    font-weight: 700;
    color: #475467;
    text-decoration: none;
}

.product-header__right {
    display: flex;
    align-items: center;
    gap: 16px;
}

.icon-badge {
    position: relative;
    width: 28px;
    height: 28px;
}

.icon-badge img {
    width: 20px;
    height: 20px;
}

.badge-count {
    position: absolute;
    top: -4px;
    right: -4px;
    width: 16px;
    height: 16px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: 700;
    color: white;
}

.badge-count.red {
    background: #ef4444;
}

.badge-count.blue {
    background: #1e40af;
}

.product-user {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 2px solid #e4e7ec;
    object-fit: cover;
}

.breadcrumbs {
    max-width: 1280px;
    margin: 0 auto;
    padding: 32px 80px 0;
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
}

.breadcrumbs a {
    color: #475467;
    font-weight: 700;
    text-decoration: none;
}

.breadcrumbs .current {
    color: #0f172a;
    font-weight: 700;
}

.breadcrumbs img {
    width: 7.5px;
    height: 12px;
}

.product-main {
    max-width: 1280px;
    margin: 0 auto;
    padding: 76px 80px;
}

.product-container {
    background: white;
    border-radius: 12px;
    padding: 32px;
    box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.05);
    margin-bottom: 24px;
}

.product-content {
    display: grid;
    grid-template-columns: 357px 1fr;
    gap: 32px;
}

.product-images {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.product-main-image {
    width: 100%;
    height: 384px;
    border-radius: 12px;
    object-fit: cover;
    background: #f2f4f7;
}

.product-thumbnails {
    display: flex;
    gap: 8px;
    overflow-x: auto;
    padding-bottom: 6px;
    scrollbar-width: thin;
    scrollbar-color: #cbd5e1 transparent;
}

.product-thumbnails::-webkit-scrollbar {
    height: 6px;
}

.product-thumbnails::-webkit-scrollbar-track {
    background: transparent;
}

.product-thumbnails::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 999px;
}

.product-thumbnail {
    width: 80px;
    height: 80px;
    border-radius: 8px;
    object-fit: cover;
    background: #f2f4f7;
    cursor: pointer;
    border: 2px solid transparent;
    transition: border-color 0.2s;
    flex-shrink: 0;
}

.product-thumbnail.active {
    border-color: #1e40af;
}

.product-thumbnail:hover {
    border-color: #3b82f6;
}

/* Hide real reviews when none exist */
.review-item {
    display: none;
}
.reviews-link {
    display: none;
}

.seller-info {
    border-top: 1px solid #e4e7ec;
    padding-top: 24px;
    margin-top: 24px;
    display: flex;
    align-items: center;
    gap: 16px;
    flex-wrap: wrap;
}

.seller-avatar {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    object-fit: cover;
}

.seller-details {
    flex: 1;
    min-width: 0;
}

.seller-name {
    font-weight: 600;
    color: #0f172a;
    margin-bottom: 8px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.seller-verified {
    display: flex;
    align-items: center;
    gap: 4px;
    font-size: 14px;
    font-weight: 700;
    color: #475467;
}

.seller-verified img {
    width: 14px;
    height: 14px;
}

.visit-store-btn {
    background: transparent;
    border: 2px solid #1e40af;
    color: #1e40af;
    padding: 10px 24px;
    border-radius: 8px;
    font-weight: 700;
    font-size: 16px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    margin-left: auto;
    margin-top: 8px;
    flex-shrink: 0;
}

.visit-store-btn img {
    width: 18px;
    height: 18px;
}

.product-info {
    padding-left: 9px;
}

.product-badges {
    display: flex;
    gap: 8px;
    margin-bottom: 12px;
}

.product-badge {
    padding: 4px 12px;
    border-radius: 9999px;
    font-size: 12px;
    font-weight: 600;
}

.product-badge.official {
    background: #1e40af;
    color: white;
}

.product-badge.stock {
    background: #dcfce7;
    color: #15803d;
}

.product-title {
    font-size: 30px;
    font-weight: 700;
    color: #0f172a;
    line-height: 36px;
    margin-bottom: 16px;
}

.product-rating {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 24px;
}

.rating-stars {
    display: flex;
    gap: 4px;
}

.rating-star {
    font-size: 18px;
    color: #e5e7eb;
    line-height: 1;
}

.rating-star.filled {
    color: #f59e0b;
}

.rating-value {
    font-weight: 600;
    color: #0f172a;
    font-size: 14px;
}

.rating-divider {
    color: #94a3b8;
    font-weight: 700;
}

.rating-text {
    color: #475467;
    font-weight: 700;
    font-size: 14px;
}

.product-price-box {
    background: #eff6ff;
    border-radius: 12px;
    padding: 24px;
    margin-bottom: 24px;
}

.price-row {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 12px;
}

.price-current {
    font-size: 36px;
    font-weight: 700;
    color: #1e40af;
    line-height: 40px;
}

.price-old {
    font-size: 20px;
    color: #94a3b8;
    text-decoration: line-through;
    line-height: 28px;
}

.discount-badge {
    background: #ef4444;
    color: white;
    padding: 5px 12px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
}

.shipping-section {
    margin-bottom: 24px;
}

.shipping-title {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 18px;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 16px;
}

.shipping-title img {
    width: 22.5px;
    height: 18px;
}

.shipping-option {
    border: 2px solid #e4e7ec;
    border-radius: 8px;
    padding: 16px;
    margin-bottom: 12px;
    cursor: pointer;
    transition: all 0.2s;
}

.shipping-option:hover {
    border-color: #cbd5e1;
}

.shipping-option.selected {
    background: rgba(37, 99, 235, 0.05);
    border-color: #2563eb;
}

.shipping-content {
    display: flex;
    align-items: center;
    gap: 16px;
}

.shipping-radio {
    width: 20px;
    height: 20px;
    border: 0.5px solid #0075ff;
    border-radius: 50%;
    position: relative;
    flex-shrink: 0;
}

.shipping-radio.selected::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 10px;
    height: 10px;
    background: #2563eb;
    border-radius: 50%;
}

.shipping-info {
    flex: 1;
}

.shipping-header {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 4px;
}

.shipping-name {
    font-weight: 600;
    color: #0f172a;
    font-size: 16px;
}

.shipping-badge {
    padding: 2px 8px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 700;
}

.shipping-badge.hemat {
    background: #dcfce7;
    color: #15803d;
}

.shipping-badge.cepat {
    background: #2563eb;
    color: white;
}

.shipping-desc {
    color: #475467;
    font-size: 14px;
    font-weight: 700;
}

.shipping-price {
    font-size: 16px;
    font-weight: 700;
    color: #0f172a;
}

.variant-section {
    margin-bottom: 24px;
}

.variant-label {
    font-weight: 600;
    color: #0f172a;
    font-size: 14px;
    margin-bottom: 12px;
}

.variant-buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
}

.variant-button {
    padding: 10px 24px;
    border: 2px solid #d1d5db;
    border-radius: 8px;
    background: white;
    color: #374151;
    font-weight: 700;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.2s;
}

.variant-button:hover {
    border-color: #9ca3af;
}

.variant-button.selected {
    background: #eff6ff;
    border-color: #1e40af;
    color: #1e40af;
}

.quantity-section {
    margin-bottom: 24px;
}

.quantity-label {
    font-weight: 600;
    color: #0f172a;
    font-size: 14px;
    margin-bottom: 12px;
}

.quantity-control {
    display: flex;
    align-items: center;
    gap: 16px;
}

.quantity-input-group {
    display: flex;
    border: 2px solid #d1d5db;
    border-radius: 8px;
    width: 160px;
}

.quantity-btn {
    width: 46px;
    height: 44px;
    background: transparent;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
}

.quantity-btn img {
    width: 14px;
    height: 16px;
}

.quantity-input {
    width: 64px;
    height: 44px;
    border-left: 2px solid #d1d5db;
    border-right: 2px solid #d1d5db;
    border-top: none;
    border-bottom: none;
    text-align: center;
    font-size: 16px;
    font-weight: 700;
    color: #0f172a;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0;
    line-height: 1;
}

.stock-info {
    color: #64748b;
    font-weight: 700;
    font-size: 14px;
}

.product-actions {
    display: flex;
    gap: 12px;
    margin-bottom: 24px;
}

.btn-cart {
    background: #1e40af;
    color: white;
    border: none;
    border-radius: 12px;
    padding: 18px 24px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0px 4px 6px 0px #bfdbfe, 0px 10px 15px 0px #bfdbfe;
}

.btn-cart img {
    width: 18px;
    height: 18px;
}

.btn-order {
    background: #1e40af;
    color: white;
    border: none;
    border-radius: 12px;
    padding: 18px 24px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    box-shadow: 0px 4px 6px 0px #bfdbfe, 0px 10px 15px 0px #bfdbfe;
}

.btn-wishlist {
    width: 56px;
    height: 56px;
    border: 2px solid #1e40af;
    background: white;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
}

.btn-wishlist img {
    width: 20px;
    height: 20px;
}

.description-section {
    background: white;
    border-radius: 12px;
    padding: 32px;
    box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.05);
    margin-bottom: 24px;
}

.description-title {
    font-size: 24px;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 24px;
}

.description-text {
    font-size: 16px;
    font-weight: 400;
    color: #475467;
    line-height: 24px;
    margin-bottom: 24px;
    white-space: pre-wrap;
    word-wrap: break-word;
}

.description-subtitle {
    font-size: 18px;
    font-weight: 600;
    color: #0f172a;
    margin-bottom: 16px;
}

.description-list {
    list-style: none;
    padding: 0;
    margin: 0 0 24px 20px;
}

.description-list li {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 12px;
    font-size: 16px;
    font-weight: 700;
    color: #374155;
    line-height: 24px;
}

.description-list li img {
    width: 14px;
    height: 16px;
    margin-top: 4px;
    flex-shrink: 0;
}

.reviews-section {
    background: white;
    border-radius: 12px;
    padding: 32px;
    box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.05);
}

.reviews-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
}

.reviews-title {
    font-size: 24px;
    font-weight: 700;
    color: #0f172a;
}

.reviews-link {
    color: #1e40af;
    font-weight: 600;
    font-size: 16px;
    text-decoration: none;
}

.reviews-summary {
    display: flex;
    gap: 24px;
    margin-bottom: 24px;
    padding-bottom: 24px;
    border-bottom: 1px solid #e4e7ec;
}

.reviews-rating {
    text-align: center;
}

.reviews-rating-value {
    font-size: 48px;
    font-weight: 700;
    color: #0f172a;
    line-height: 1;
    margin-bottom: 8px;
}

.reviews-rating-stars {
    display: flex;
    justify-content: center;
    gap: 4px;
    margin-bottom: 8px;
}

.reviews-rating-stars img {
    width: 18px;
    height: 18px;
}

.reviews-rating-text {
    font-size: 14px;
    font-weight: 700;
    color: #475467;
}

.reviews-distribution {
    flex: 1;
}

.reviews-bar {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 8px;
}

.reviews-bar-label {
    width: 48px;
    font-size: 14px;
    font-weight: 700;
    color: #475467;
}

.reviews-bar-track {
    flex: 1;
    height: 12px;
    background: #e5e7eb;
    border-radius: 9999px;
    overflow: hidden;
}

.reviews-bar-fill {
    height: 100%;
    background: #facc15;
}

.reviews-bar-count {
    width: 48px;
    text-align: right;
    font-size: 14px;
    font-weight: 700;
    color: #475467;
}

.review-item {
    padding: 24px 0;
    border-bottom: 1px solid #e4e7ec;
}

.review-item:last-child {
    border-bottom: none;
}

.review-header {
    display: flex;
    align-items: flex-start;
    gap: 16px;
    margin-bottom: 12px;
}

.review-avatar {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    object-fit: cover;
}

.review-info {
    flex: 1;
}

.review-name-row {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 8px;
}

.review-name {
    font-weight: 600;
    color: #0f172a;
    font-size: 16px;
}

.review-verified {
    display: flex;
    align-items: center;
    gap: 4px;
    font-size: 14px;
    font-weight: 700;
    color: #64748b;
}

.review-verified img {
    width: 14px;
    height: 14px;
}

.review-date {
    font-size: 14px;
    font-weight: 700;
    color: #64748b;
}

.review-stars {
    display: flex;
    gap: 4px;
    margin-bottom: 12px;
}

.review-stars img {
    width: 15.75px;
    height: 14px;
}

.review-text {
    font-size: 16px;
    font-weight: 700;
    color: #374155;
    line-height: 24px;
    margin-bottom: 12px;
}

.review-actions {
    display: flex;
    gap: 16px;
}

.review-action {
    display: flex;
    align-items: center;
    gap: 4px;
    background: none;
    border: none;
    color: #64748b;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
}

.review-action img {
    width: 14px;
    height: 14px;
}

/* Responsive breakpoints to match site layout behavior (desktop -> tablet -> mobile) */
@media (max-width: 1024px) {
    .product-main {
        padding: 56px 32px;
    }

    .product-content {
        grid-template-columns: 1fr;
        gap: 20px;
    }

    .product-images {
        order: -1;
        width: 100%;
    }

    .product-main-image {
        height: 320px;
    }

    .product-thumbnails {
        overflow-x: auto;
        padding-bottom: 8px;
    }

    .product-container {
        padding: 20px;
    }

    .breadcrumbs {
        padding: 20px 24px 0;
    }
}

@media (max-width: 768px) {
    .product-main {
        padding: 36px 18px;
    }

    .product-main-image {
        height: 260px;
    }

    .product-thumbnail {
        width: 64px;
        height: 64px;
    }

    .product-title {
        font-size: 22px;
        line-height: 28px;
    }

    .product-actions {
        flex-direction: column;
        gap: 12px;
    }

    .btn-cart,
    .btn-order {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .product-main {
        padding: 24px 12px;
    }

    .product-main-image {
        height: 200px;
    }

    .product-thumbnail {
        width: 56px;
        height: 56px;
    }

    .product-title {
        font-size: 18px;
        line-height: 24px;
    }

    .product-header__content {
        padding: 10px 14px;
    }

    .breadcrumbs {
        padding: 16px 12px 0;
        font-size: 13px;
    }
}
    </style>
    </head>

    <body>
        <?php
            $produk = $produk ?? null;
            $toko = $toko ?? [];
            $fotos = $fotos ?? [];
            if (empty($fotos) && $produk && !empty($produk['gambar_produk'])) {
                $decoded = json_decode($produk['gambar_produk'], true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    $fotos = array_map(fn($p) => ['foto_produk' => $p], $decoded);
                } else {
                    $fotos = [['foto_produk' => $produk['gambar_produk']]];
                }
            }
            $mainImg = !empty($fotos) ? $fotos[0]['foto_produk'] : 'assets/img/product-laptop.png';
            $hargaTampil = ($produk['harga_setelah_diskon'] ?? 0) > 0 ? $produk['harga_setelah_diskon'] : ($produk['harga_awal'] ?? 0);
            $hargaAwal = $produk['harga_awal'] ?? 0;
            $kategoriNama = $produk['nama_kategori'] ?? 'Kategori';
            $kategoriId = $produk['id_kategori'] ?? null;
            $menuNama = $produk['nama_menu'] ?? null;
            $menuId = $produk['id_menu'] ?? null;
            // Siapkan gambar varian per tombol
            $variantImagesMap = [];
            if (!empty($varianList)) {
                foreach ($varianList as $v) {
                    $imgs = [];
                    if (!empty($v['gambar_varian']) && is_array($v['gambar_varian'])) {
                        $imgs = $v['gambar_varian'];
                    }
                    $variantImagesMap[] = $imgs;
                }
            }
        ?>
        <nav class="breadcrumbs">
            <a href="<?= base_url() ?>">Beranda</a>
            <?php if ($kategoriId && $kategoriNama): ?>
                <img src="/assets/img/iconpanah.png" alt=">" />
                <a href="<?= base_url('kategori?kategori=' . urlencode($kategoriId)) ?>"><?= esc($kategoriNama) ?></a>
            <?php endif; ?>
            <?php if ($menuId && $menuNama): ?>
                <img src="/assets/img/iconpanah.png" alt=">" />
                <a href="<?= base_url('kategori?kategori=' . urlencode($kategoriId) . '&menu=' . urlencode($menuId)) ?>"><?= esc($menuNama) ?></a>
            <?php endif; ?>
            <img src="/assets/img/iconpanah.png" alt=">" />
            <span class="current">Detail Produk</span>
        </nav>

        <main class="product-main">
            <div class="product-container">
                <div class="product-content">
                    <div class="product-images">
                        <img src="<?= base_url($mainImg) ?>"
                            alt="<?= esc($produk['nama_produk'] ?? 'Produk') ?>" class="product-main-image" id="mainImage" />
                        <div class="product-thumbnails" id="thumbnailContainer">
                            <?php foreach ($fotos as $index => $foto): ?>
                                <img src="<?= base_url($foto['foto_produk']) ?>"
                                    alt="Thumbnail <?= $index + 1 ?>" class="product-thumbnail <?= $index === 0 ? 'active' : '' ?>"
                                    data-src="<?= base_url($foto['foto_produk']) ?>" />
                            <?php endforeach; ?>
                        </div>
                        <div class="seller-info">
                            <img src="<?= !empty($toko['logo_toko']) ? base_url($toko['logo_toko']) : base_url('assets/img/laptop1.svg') ?>"
                                alt="<?= esc($toko['nama_toko'] ?? 'Toko') ?>" class="seller-avatar" />
                            <div class="seller-details">
                                <div class="seller-name"><?= esc($toko['nama_toko'] ?? 'Toko') ?></div>
                                <div class="seller-verified">
                                    <img src="/assets/img/verify.png" alt="Verified" />
                                    <span><?= ($toko['status_toko'] ?? '') === 'verified_seller' ? 'Verified Seller' : 'Official Store' ?></span>
                                </div>
                            </div>
                            <button class="visit-store-btn">
                                <img src="/assets/img/toko.png" alt="Store" />
                                Kunjungi Toko
                            </button>
                        </div>
                    </div>

                    <div class="product-info">
                        <?php
                            $ratingValue = isset($produk['rating']) ? (float)$produk['rating'] : 0.0;
                            $ratingCount = isset($produk['jumlah_penilaian']) ? (int)$produk['jumlah_penilaian'] : 0;
                            $terjual = isset($produk['terjual']) ? (int)$produk['terjual'] : 0;
                            $ratingLabel = $ratingCount > 0 ? number_format($ratingValue, 1, ',', '.') : '0.0';
                            $penilaianLabel = $ratingCount > 0 ? number_format($ratingCount, 0, ',', '.') . ' Penilaian' : 'Belum ada penilaian';
                            $terjualLabel = $terjual > 0 ? number_format($terjual, 0, ',', '.') . ' Terjual' : '0 Terjual';
                        ?>
                        <div class="product-badges">
                            <?php if (($toko['status_toko'] ?? '') === 'official_store'): ?>
                                <span class="product-badge official">Official Store</span>
                            <?php endif; ?>
                            <?php if (($produk['stok'] ?? 0) > 0): ?>
                                <span class="product-badge stock">Ready Stock</span>
                            <?php endif; ?>
                        </div>
                        <h1 class="product-title">
                            <?= esc($produk['nama_produk'] ?? 'Produk') ?>
                        </h1>
                        <div class="product-rating">
                            <div class="rating-stars">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <?php $filled = $ratingValue >= $i - 0.5; ?>
                                    <span class="rating-star <?= $filled ? 'filled' : '' ?>">★</span>
                                <?php endfor; ?>
                            </div>
                            <span class="rating-value"><?= esc($ratingLabel) ?></span>
                            <span class="rating-divider">|</span>
                            <span class="rating-text"><?= esc($penilaianLabel) ?></span>
                            <span class="rating-divider">|</span>
                            <span class="rating-text"><?= esc($terjualLabel) ?></span>
                        </div>
                        <div class="product-price-box">
                            <div class="price-row">
                                <span class="price-current" id="priceCurrent">Rp <?= number_format($hargaTampil, 0, ',', '.') ?></span>
                                <?php if ($hargaAwal > 0 && $hargaAwal > $hargaTampil): ?>
                                    <span class="price-old" id="priceOld">Rp <?= number_format($hargaAwal, 0, ',', '.') ?></span>
                                <?php else: ?>
                                    <span class="price-old" id="priceOld" style="display:none;">Rp <?= number_format($hargaAwal, 0, ',', '.') ?></span>
                                <?php endif; ?>
                            </div>
                            <?php if ($hargaAwal > 0 && $hargaAwal > $hargaTampil): ?>
                                <?php $diskonPersen = round((($hargaAwal - $hargaTampil) / $hargaAwal) * 100); ?>
                                <span class="discount-badge">Hemat <?= $diskonPersen ?>%</span>
                            <?php endif; ?>
                        </div>
                        <div class="shipping-section">
                            <div class="shipping-title">
                                <img src="/assets/img/mobil.png" alt="Shopping" />
                                <span>Metode Pengiriman</span>
                            </div>
                            <div class="shipping-option selected" data-method="antar">
                                <div class="shipping-content">
                                    <div class="shipping-radio selected"></div>
                                    <div class="shipping-info">
                                        <div class="shipping-header">
                                            <span class="shipping-name">Antar Sekarang</span>
                                            <span class="shipping-badge hemat">Hemat</span>
                                        </div>
                                        <p class="shipping-desc">Estimasi tiba 15 - 20 m</p>
                                    </div>
                                    <span class="shipping-price">Rp 15.000</span>
                                </div>
                            </div>
                            <div class="shipping-option" data-method="datang">
                                <div class="shipping-content">
                                    <div class="shipping-radio"></div>
                                    <div class="shipping-info">
                                        <div class="shipping-header">
                                            <span class="shipping-name">Datang ke Tempat</span>
                                            <span class="shipping-badge cepat">Cepat</span>
                                        </div>
                                        <p class="shipping-desc">Estimasi tiba menyesuaikan</p>
                                    </div>
                                    <span class="shipping-price">Rp 30.000</span>
                                </div>
                            </div>
                        </div>
                        <div class="variant-section">
                            <div class="variant-label">Pilih Varian:</div>
                            <div class="variant-buttons">
                                <?php if (!empty($varianList)): ?>
                                    <?php foreach ($varianList as $i => $varian): ?>
                                        <button class="variant-button <?= $i === 0 ? 'selected' : '' ?>"
                                            data-additional="<?= (float)($varian['harga_tambahan'] ?? 0) ?>"
                                            data-images='<?= json_encode($varian['gambar_varian'] ?? []) ?>'>
                                            <?= esc($varian['nama_varian'] . ' / ' . $varian['nilai_varian']) ?>
                                        </button>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <button class="variant-button selected">Default</button>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="quantity-section">
                            <div class="variant-label">Jumlah:</div>
                            <div class="quantity-control">
                                <div class="quantity-input-group">
                                    <button type="button" class="quantity-btn qty-dec">
                                        <img src="/assets/img/minus.png" alt="Decrease" />
                                    </button>
                                    <input type="number" name="quantity" id="quantityInput" class="quantity-input"
                                        value="1" min="1" max="99" readonly />
                                    <button type="button" class="quantity-btn qty-inc">
                                        <img src="/assets/img/plus.png" alt="Increase" />
                                    </button>
                                </div>
                                <span class="stock-info">Stok: 47 unit</span>
                            </div>
                        </div>
                        <div class="product-actions">
                            <input type="hidden" id="shippingChoice" value="antar">
                            <a class="btn-cart" id="addToCartBtn" href="#">
                                <img src="/assets/img/keranjang.png" alt="Cart" />
                                Tambah ke Keranjang
                            </a>
                            <a class="btn-order" id="orderNowBtn" href="#">Buat Pesanan</a>
                            <button class="btn-wishlist" aria-label="Tambah ke Wishlist">
                                <img src="/assets/img/love.png" alt="Wishlist" />
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <?php if (!empty($produk['deskripsi_produk'])): ?>
            <div class="description-section">
                <h2 class="description-title">Deskripsi Produk</h2>
                <div class="description-text">
                    <?= nl2br(esc($produk['deskripsi_produk'])) ?>
                </div>
                
                <?php if (!empty($produk['merek'])): ?>
                    <h3 class="description-subtitle">Merek:</h3>
                    <p class="description-text"><?= esc($produk['merek']) ?></p>
                <?php endif; ?>
                
                <?php if (!empty($produk['sku'])): ?>
                    <h3 class="description-subtitle">SKU:</h3>
                    <p class="description-text"><?= esc($produk['sku']) ?></p>
                <?php endif; ?>
                
                <?php if (!empty($produk['berat']) && $produk['berat'] > 0): ?>
                    <h3 class="description-subtitle">Berat:</h3>
                    <p class="description-text"><?= number_format($produk['berat'], 0, ',', '.') ?> gram</p>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <div class="reviews-section">
                <div class="reviews-header">
                    <h2 class="reviews-title">Ulasan Pembeli</h2>
                    <a href="#" class="reviews-link">Lihat Semua</a>
                </div>
                <div class="reviews-summary">
                    <div class="reviews-rating">
                        <div class="reviews-rating-value">0.0</div>
                        <div class="reviews-rating-stars">
                            <span class="rating-star">★</span>
                            <span class="rating-star">★</span>
                            <span class="rating-star">★</span>
                            <span class="rating-star">★</span>
                            <span class="rating-star">★</span>
                        </div>
                        <div class="reviews-rating-text">Belum ada ulasan</div>
                    </div>
                    <div class="reviews-distribution">
                        <div class="reviews-bar">
                            <span class="reviews-bar-label">5★</span>
                            <div class="reviews-bar-track">
                                <div class="reviews-bar-fill" style="width: 0%;"></div>
                            </div>
                            <span class="reviews-bar-count">0</span>
                        </div>
                        <div class="reviews-bar">
                            <span class="reviews-bar-label">4★</span>
                            <div class="reviews-bar-track">
                                <div class="reviews-bar-fill" style="width: 0%;"></div>
                            </div>
                            <span class="reviews-bar-count">0</span>
                        </div>
                        <div class="reviews-bar">
                            <span class="reviews-bar-label">3★</span>
                            <div class="reviews-bar-track">
                                <div class="reviews-bar-fill" style="width: 0%;"></div>
                            </div>
                            <span class="reviews-bar-count">0</span>
                        </div>
                        <div class="reviews-bar">
                            <span class="reviews-bar-label">2★</span>
                            <div class="reviews-bar-track">
                                <div class="reviews-bar-fill" style="width: 0%;"></div>
                            </div>
                            <span class="reviews-bar-count">0</span>
                        </div>
                        <div class="reviews-bar">
                            <span class="reviews-bar-label">1★</span>
                            <div class="reviews-bar-track">
                                <div class="reviews-bar-fill" style="width: 0%;"></div>
                            </div>
                            <span class="reviews-bar-count">0</span>
                        </div>
                    </div>
                </div>
                <div class="review-item">
                    <div class="review-header">
                        <img src="/assets/img/logo.png"
                            alt="Rizki Pratama" class="review-avatar" />
                        <div class="review-info">
                            <div class="review-name-row">
                                <div>
                                    <div class="review-name">Rizki Pratama</div>
                                </div>
                                <span class="review-date">2 hari yang lalu</span>
                            </div>
                            <div class="review-stars">
                                <img src="/assets/img/rating.png"
                                    alt="Star" />
                                <img src="/assets/img/rating.png"
                                    alt="Star" />
                                <img src="/assets/img/rating.png"
                                    alt="Star" />
                                <img src="/assets/img/rating.png"
                                    alt="Star" />
                                <img src="/assets/img/rating.png"
                                    alt="Star" />
                            </div>
                            <p class="review-text">
                                Laptop gaming terbaik yang pernah saya beli! Performa luar
                                biasa, bisa main game berat dengan setting ultra lancar jaya.
                                Cooling systemnya juga mantap, ga overheat. Packing rapi dan
                                pengiriman cepat. Highly recommended!
                            </p>
                            <div class="review-actions">
                                <button class="review-action">
                                    <img src="/assets/img/like.png"
                                        alt="Helpful" />
                                    Membantu (234)
                                </button>
                                <button class="review-action">
                                    <img src="/assets/img/chat.png"
                                        alt="Reply" />
                                    Balas
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="review-item">
                    <div class="review-header">
                        <img src="/assets/img/logo.png"
                            alt="Siti Nurhaliza" class="review-avatar" />
                        <div class="review-info">
                            <div class="review-name-row">
                                <div>
                                    <div class="review-name">Siti Nurhaliza</div>
                                </div>
                                <span class="review-date">5 hari yang lalu</span>
                            </div>
                            <div class="review-stars">
                                <img src="/assets/img/rating.png"
                                    alt="Star" />
                                <img src="/assets/img/rating.png"
                                    alt="Star" />
                                <img src="/assets/img/rating.png"
                                    alt="Star" />
                                <img src="/assets/img/rating.png"
                                    alt="Star" />
                                <img src="/assets/img/rating.png"
                                    alt="Star" />
                            </div>
                            <p class="review-text">
                                Sangat puas dengan pembelian ini! Layar 144Hz-nya smooth banget,
                                keyboard RGB-nya keren, dan build quality premium. Untuk editing
                                video dan gaming sempurna. Seller responsif dan profesional.
                                Worth every penny!
                            </p>
                            <div class="review-actions">
                                <button class="review-action">
                                    <img src="/assets/img/like.png"
                                        alt="Helpful" />
                                    Membantu (189)
                                </button>
                                <button class="review-action">
                                    <img src="/assets/img/chat.png"
                                        alt="Reply" />
                                    Balas
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="review-item">
                    <div class="review-header">
                        <img src="/assets/img/logo.png"
                            alt="Ahmad Fauzi" class="review-avatar" />
                        <div class="review-info">
                            <div class="review-name-row">
                                <div>
                                    <div class="review-name">Ahmad Fauzi</div>
                                </div>
                                <span class="review-date">1 minggu yang lalu</span>
                            </div>
                            <div class="review-stars">
                                <img src="/assets/img/rating.png"
                                    alt="Star" />
                                <img src="/assets/img/rating.png"
                                    alt="Star" />
                                <img src="/assets/img/rating.png"
                                    alt="Star" />
                                <img src="/assets/img/rating.png"
                                    alt="Star" />
                                <img src="/assets/img/rating.png"
                                    alt="Star" />
                            </div>
                            <p class="review-text">
                                Laptop impian akhirnya terwujud! RTX 3060 nya gahar banget, bisa
                                ray tracing dengan fps stabil. Suara speakernya juga bagus.
                                Bonus mouse pad-nya juga keren. Terima kasih ISBCOMMERCE!
                            </p>
                            <div class="review-actions">
                                <button class="review-action">
                                    <img src="/assets/img/like.png"
                                        alt="Helpful" />
                                    Membantu (156)
                                </button>
                                <button class="review-action">
                                    <img src="/assets/img/chat.png"
                                        alt="Reply" />
                                    Balas
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <script>
            (function () {
                const basePrice = <?= (int) $hargaTampil ?>;
                const basePriceOriginal = <?= (int) $hargaAwal ?>;
                let variantExtra = 0;
                const defaultImages = <?= json_encode(array_values(array_map(fn($f) => base_url($f['foto_produk']), $fotos))) ?>;

                const priceCurrentEl = document.getElementById('priceCurrent');
                const priceOldEl = document.getElementById('priceOld');
                const qtyInput = document.getElementById('quantityInput');
                const decBtn = document.querySelector('.qty-dec');
                const incBtn = document.querySelector('.qty-inc');
                const variantButtons = document.querySelectorAll('.variant-button');
                const mainImageEl = document.getElementById('mainImage');
                const thumbnailContainer = document.getElementById('thumbnailContainer');
                const shippingOptions = document.querySelectorAll('.shipping-option');
                let selectedShipping = document.querySelector('.shipping-option.selected') || null;

                const formatIDR = (val) => 'Rp ' + Number(val).toLocaleString('id-ID');

                function setMainImage(src) {
                    if (!mainImageEl) return;
                    mainImageEl.src = src;
                    if (!thumbnailContainer) return;
                    thumbnailContainer.querySelectorAll('.product-thumbnail').forEach(el => {
                        el.classList.toggle('active', el.dataset.src === src);
                    });
                }

                function ensureThumbnail(src) {
                    if (!thumbnailContainer) return;
                    const exists = Array.from(thumbnailContainer.querySelectorAll('.product-thumbnail')).some(el => el.dataset.src === src);
                    if (exists) return;
                    const imgEl = document.createElement('img');
                    imgEl.src = src;
                    imgEl.dataset.src = src;
                    imgEl.alt = 'Thumbnail';
                    imgEl.className = 'product-thumbnail';
                    imgEl.onclick = () => setMainImage(src);
                    thumbnailContainer.appendChild(imgEl);
                }

                // Inisialisasi klik pada thumbnail yang sudah ada
                thumbnailContainer?.querySelectorAll('.product-thumbnail').forEach(el => {
                    el.dataset.src = el.dataset.src || el.src;
                    el.onclick = () => setMainImage(el.dataset.src);
                });

                function refreshPrice() {
                    const current = basePrice + variantExtra;
                    const original = basePriceOriginal + variantExtra;
                    priceCurrentEl.textContent = formatIDR(current);
                    if (original > current && original > 0) {
                        priceOldEl.style.display = '';
                        priceOldEl.textContent = formatIDR(original);
                    } else {
                        priceOldEl.style.display = 'none';
                    }
                }

                variantButtons.forEach((btn) => {
                    btn.addEventListener('click', () => {
                        variantButtons.forEach(b => b.classList.remove('selected'));
                        btn.classList.add('selected');
                        variantExtra = Number(btn.dataset.additional || 0);
                        refreshPrice();

                        const imgs = (() => {
                            try {
                                const parsed = JSON.parse(btn.dataset.images || '[]');
                                if (Array.isArray(parsed) && parsed.length) {
                                    return parsed.map(src => src.startsWith('http') ? src : '<?= base_url() ?>/' + src);
                                }
                            } catch (e) {}
                            return defaultImages;
                        })();

                        // Pastikan semua gambar varian ditambahkan tanpa menghapus thumbnail yang sudah ada
                        imgs.forEach(src => ensureThumbnail(src));
                        if (imgs.length) {
                            setMainImage(imgs[0]);
                        } else if (defaultImages.length) {
                            setMainImage(defaultImages[0]);
                        }
                    });
                });

                function selectShipping(opt) {
                    shippingOptions.forEach(o => {
                        o.classList.remove('selected');
                        const radio = o.querySelector('.shipping-radio');
                        radio?.classList.remove('selected');
                    });
                    opt.classList.add('selected');
                    const radio = opt.querySelector('.shipping-radio');
                    radio?.classList.add('selected');
                    selectedShipping = opt;
                    const method = opt.dataset.method || '';
                    if (method) {
                        localStorage.setItem('shipping_method', method);
                    }
                }

                shippingOptions.forEach(opt => {
                    opt.addEventListener('click', () => selectShipping(opt));
                });

                // Restore shipping choice
                const savedShipping = localStorage.getItem('shipping_method');
                if (savedShipping) {
                    const target = document.querySelector(`.shipping-option[data-method="${savedShipping}"]`);
                    if (target) {
                        selectShipping(target);
                    }
                } else if (selectedShipping) {
                    selectShipping(selectedShipping);
                }

                function updateQty(delta) {
                    if (!qtyInput) return;
                    const min = Number(qtyInput.min) || 1;
                    const max = Number(qtyInput.max) || 99;
                    let val = Number(qtyInput.value) || min;
                    val = Math.min(max, Math.max(min, val + delta));
                    qtyInput.value = val;
                    attachCartLinks();
                }

                decBtn?.addEventListener('click', () => updateQty(-1));
                incBtn?.addEventListener('click', () => updateQty(1));

                function attachCartLinks() {
                    const addBtn = document.getElementById('addToCartBtn');
                    const orderBtn = document.getElementById('orderNowBtn');
                    const pid = '<?= $produk['id_produk'] ?? '' ?>';
                    const currentShipping = localStorage.getItem('shipping_method') || 'antar';
                    const qtyVal = qtyInput ? qtyInput.value : 1;
                    if (addBtn) {
                        addBtn.href = `<?= base_url('cart') ?>?id=${pid}&qty=${qtyVal}`;
                    }
                    if (orderBtn) {
                        orderBtn.href = `<?= base_url('pesan') ?>?id=${pid}&qty=${qtyVal}&shipping=${currentShipping}`;
                    }
                }

                document.getElementById('addToCartBtn')?.addEventListener('click', (e) => {
                    e.preventDefault();
                    attachCartLinks();
                    const href = e.currentTarget.getAttribute('href');
                    window.location.href = href;
                });

                document.getElementById('orderNowBtn')?.addEventListener('click', (e) => {
                    e.preventDefault();
                    attachCartLinks();
                    const href = e.currentTarget.getAttribute('href');
                    window.location.href = href;
                });

                qtyInput?.addEventListener('change', attachCartLinks);
                qtyInput?.addEventListener('input', attachCartLinks);
                attachCartLinks();

                // Wishlist toggle (save to localStorage)
                const wishlistBtn = document.querySelector('.btn-wishlist');
                const mainImgEl = document.querySelector('.product-main-image');
                function addToWishlist() {
                    const pid = '<?= $produk['id_produk'] ?? '' ?>';
                    const title = '<?= esc($produk['nama_produk'] ?? 'Produk') ?>';
                    const priceText = document.getElementById('priceCurrent')?.textContent || '0';
                    const priceNum = Number((priceText || '').replace(/[^0-9]/g, '')) || 0;
                    const img = mainImgEl?.getAttribute('src') || '';
                    let list = [];
                    try {
                        list = JSON.parse(localStorage.getItem('wishlist_items') || '[]');
                        if (!Array.isArray(list)) list = [];
                    } catch (e) { list = []; }
                    const filtered = list.filter(i => (i.pid || '') !== pid);
                    filtered.unshift({ pid, title, price: priceNum, img });
                    localStorage.setItem('wishlist_items', JSON.stringify(filtered.slice(0, 50)));
                    if (wishlistBtn) {
                        const label = wishlistBtn.querySelector('span') || wishlistBtn;
                        label.textContent = 'Sudah di Wishlist';
                        wishlistBtn.style.borderColor = '#2563eb';
                        wishlistBtn.style.color = '#2563eb';
                    }
                }
                wishlistBtn?.addEventListener('click', (e) => {
                    e.preventDefault();
                    addToWishlist();
                });

                refreshPrice();
            })();
        </script>
    </body>

    </html>