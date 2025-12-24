<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($produk['nama_produk'] ?? 'Detail Produk') ?> - ISBCOMMERCE</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
body {
    background: #f9fafb;
    font-family: 'Inter', sans-serif;
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
    gap: 12px;
    overflow-x: auto;
    overflow-y: hidden;
    padding: 8px 0;
    scrollbar-width: thin;
    scrollbar-color: #CBD5E1 transparent;
}

.product-thumbnails::-webkit-scrollbar {
    height: 6px;
}

.product-thumbnails::-webkit-scrollbar-track {
    background: transparent;
}

.product-thumbnails::-webkit-scrollbar-thumb {
    background: #CBD5E1;
    border-radius: 3px;
}

.product-thumbnails::-webkit-scrollbar-thumb:hover {
    background: #94A3B8;
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
}

.product-thumbnail.active {
    border-color: #1e40af;
}

.product-thumbnail:hover {
    border-color: #3b82f6;
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
    border: 1px solid #2563EB;
    color: #2563EB;
    padding: 8px 16px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
}

.product-info {
    display: flex;
    flex-direction: column;
    gap: 24px;
}

.product-badges {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.product-badge {
    padding: 4px 12px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
}

.product-badge.official {
    background: #DBEAFE;
    color: #1E40AF;
}

.product-badge.stock {
    background: #D1FAE5;
    color: #065F46;
}

.product-title {
    font-size: 24px;
    font-weight: 700;
    line-height: 32px;
    color: #0f172a;
    margin: 0;
}

.product-price-box {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.price-row {
    display: flex;
    align-items: center;
    gap: 16px;
}

.price-current {
    font-size: 32px;
    font-weight: 700;
    color: #2563EB;
}

.price-old {
    font-size: 20px;
    color: #9CA3AF;
    text-decoration: line-through;
}

.discount-badge {
    display: inline-block;
    padding: 4px 8px;
    background: #FEE2E2;
    color: #DC2626;
    border-radius: 4px;
    font-size: 14px;
    font-weight: 600;
    width: fit-content;
}

.description-section {
    background: white;
    border-radius: 12px;
    padding: 32px;
    box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.05);
}

.description-title {
    font-size: 20px;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 16px;
}

.description-text {
    font-size: 16px;
    line-height: 24px;
    color: #475467;
    margin-bottom: 24px;
    white-space: pre-wrap;
    word-wrap: break-word;
}

.description-subtitle {
    font-size: 18px;
    font-weight: 600;
    color: #0f172a;
    margin-top: 24px;
    margin-bottom: 16px;
}

.description-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.description-list li {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 12px;
    font-size: 16px;
    line-height: 24px;
    color: #475467;
}

.description-list li img {
    width: 20px;
    height: 20px;
    margin-top: 2px;
    flex-shrink: 0;
}

@media (max-width: 768px) {
    .product-main {
        padding: 36px 18px;
    }

    .product-content {
        grid-template-columns: 1fr;
    }

    .product-main-image {
        height: 260px;
    }

    .product-title {
        font-size: 22px;
        line-height: 28px;
    }

    .price-current {
        font-size: 24px;
    }
}
    </style>
</head>

<body>
    <nav class="breadcrumbs">
        <a href="<?= base_url() ?>">Beranda</a>
        <?php if (!empty($produk['id_kategori']) && !empty($produk['nama_kategori'])): ?>
            <img src="<?= base_url('assets/img/iconpanah.png') ?>" alt=">" />
            <a href="<?= base_url('kategori?kategori=' . urlencode($produk['id_kategori'])) ?>"><?= esc($produk['nama_kategori']) ?></a>
        <?php endif; ?>
        <?php if (!empty($produk['id_menu']) && !empty($produk['nama_menu'])): ?>
            <img src="<?= base_url('assets/img/iconpanah.png') ?>" alt=">" />
            <a href="<?= base_url('kategori?kategori=' . urlencode($produk['id_kategori']) . '&menu=' . urlencode($produk['id_menu'])) ?>"><?= esc($produk['nama_menu']) ?></a>
        <?php endif; ?>
        <img src="<?= base_url('assets/img/iconpanah.png') ?>" alt=">" />
        <span class="current">Detail Produk</span>
    </nav>

    <main class="product-main">
        <div class="product-container">
            <div class="product-content">
                <div class="product-images">
                    <?php if (!empty($fotos)): ?>
                        <img src="<?= base_url($fotos[0]['foto_produk']) ?>" alt="<?= esc($produk['nama_produk']) ?>" class="product-main-image" id="mainImage" />
                        <div class="product-thumbnails" id="thumbnailContainer">
                            <?php foreach ($fotos as $index => $foto): ?>
                                <img src="<?= base_url($foto['foto_produk']) ?>" alt="Thumbnail <?= $index + 1 ?>" 
                                     class="product-thumbnail <?= $index === 0 ? 'active' : '' ?>" 
                                     onclick="changeMainImage('<?= base_url($foto['foto_produk']) ?>', this)" />
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <img src="<?= base_url('assets/img/product-placeholder.png') ?>" alt="<?= esc($produk['nama_produk']) ?>" class="product-main-image" id="mainImage" />
                        <div class="product-thumbnails" id="thumbnailContainer"></div>
                    <?php endif; ?>
                    
                    <?php if (!empty($toko)): ?>
                        <div class="seller-info">
                            <img src="<?= !empty($toko['logo_toko']) ? base_url($toko['logo_toko']) : base_url('assets/img/admin-avatar.png') ?>" 
                                 alt="<?= esc($toko['nama_toko'] ?? 'Toko') ?>" class="seller-avatar" />
                            <div class="seller-details">
                                <div class="seller-name"><?= esc($toko['nama_toko'] ?? 'Toko') ?></div>
                                <div class="seller-verified">
                                    <img src="<?= base_url('assets/img/verify.png') ?>" alt="Verified" />
                                    <span><?= esc($toko['status_toko'] === 'verified_seller' ? 'Verified Seller' : 'Official Store') ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="product-info">
                    <div class="product-badges">
                        <?php if (!empty($toko) && $toko['status_toko'] === 'official_store'): ?>
                            <span class="product-badge official">Official Store</span>
                        <?php endif; ?>
                        <?php if ($produk['stok'] > 0): ?>
                            <span class="product-badge stock">Ready Stock</span>
                        <?php endif; ?>
                    </div>
                    <h1 class="product-title"><?= esc($produk['nama_produk']) ?></h1>
                    
                    <div class="product-price-box">
                        <div class="price-row">
                            <?php if ($produk['harga_setelah_diskon'] > 0 && $produk['harga_setelah_diskon'] < $produk['harga_awal']): ?>
                                <span class="price-current">Rp <?= number_format($produk['harga_setelah_diskon'], 0, ',', '.') ?></span>
                                <span class="price-old">Rp <?= number_format($produk['harga_awal'], 0, ',', '.') ?></span>
                            <?php else: ?>
                                <span class="price-current">Rp <?= number_format($produk['harga_awal'], 0, ',', '.') ?></span>
                            <?php endif; ?>
                        </div>
                        <?php if ($produk['harga_setelah_diskon'] > 0 && $produk['harga_setelah_diskon'] < $produk['harga_awal']): ?>
                            <?php
                            $diskonPersen = (($produk['harga_awal'] - $produk['harga_setelah_diskon']) / $produk['harga_awal']) * 100;
                            ?>
                            <span class="discount-badge">Hemat <?= round($diskonPersen) ?>%</span>
                        <?php endif; ?>
                    </div>

                    <!-- Varian Produk (jika ada varian dengan gambar) -->
                    <?php 
                    $varianDenganGambar = array_filter($varianList ?? [], function($v) {
                        return !empty($v['gambar_varian']) && is_array($v['gambar_varian']) && count($v['gambar_varian']) > 0;
                    });
                    ?>
                    <?php if (!empty($varianDenganGambar)): ?>
                        <div class="variant-section" style="margin-top: 24px; padding-top: 24px; border-top: 1px solid #E5E7EB;">
                            <h3 style="font-size: 16px; font-weight: 600; color: #1F2937; margin-bottom: 12px;">Pilih Varian</h3>
                            <div class="variant-options" style="display: flex; flex-wrap: wrap; gap: 12px;">
                                <?php foreach ($varianDenganGambar as $index => $varian): ?>
                                    <button type="button" 
                                            class="variant-option" 
                                            data-varian-id="<?= $varian['id_varian'] ?>"
                                            data-start-index="<?= $varianImageIndices[$varian['id_varian']] ?? 0 ?>"
                                            onclick="selectVariant(<?= $varian['id_varian'] ?>, <?= $varianImageIndices[$varian['id_varian']] ?? 0 ?>, this)"
                                            style="padding: 10px 16px; border: 2px solid #D1D5DB; background: white; border-radius: 8px; cursor: pointer; font-size: 14px; font-weight: 500; color: #374151; transition: all 0.2s;">
                                        <?= esc($varian['nama_varian']) ?>: <?= esc($varian['nilai_varian']) ?>
                                    </button>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($produk['deskripsi_produk'])): ?>
                        <div class="description-section">
                            <h2 class="description-title">Deskripsi Produk</h2>
                            <div class="description-text"><?= nl2br(esc($produk['deskripsi_produk'])) ?></div>
                            
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
                </div>
            </div>
        </div>
    </main>

    <script>
        // All images are already displayed in thumbnail list (inti + pendukung + varian)
        function changeMainImage(src, element) {
            const mainImage = document.getElementById('mainImage');
            if (mainImage) {
                mainImage.src = src;
            }
            document.querySelectorAll('.product-thumbnail').forEach(img => img.classList.remove('active'));
            if (element) {
                element.classList.add('active');
                // Scroll thumbnail into view if needed
                element.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
            }
        }
        
        function selectVariant(varianId, startIndex, buttonElement) {
            // Remove active class from all variant buttons
            document.querySelectorAll('.variant-option').forEach(btn => {
                btn.classList.remove('active');
                btn.style.borderColor = '#D1D5DB';
                btn.style.background = 'white';
                btn.style.color = '#374151';
            });
            
            // Add active class to selected button
            buttonElement.classList.add('active');
            buttonElement.style.borderColor = '#2563EB';
            buttonElement.style.background = '#EFF6FF';
            buttonElement.style.color = '#2563EB';
            
            // Get all thumbnails (semua gambar sudah ada di list)
            const thumbnails = document.querySelectorAll('.product-thumbnail');
            if (thumbnails.length > startIndex) {
                // Jump to the first image of this variant (gambar sudah ada di list)
                const targetThumbnail = thumbnails[startIndex];
                if (targetThumbnail) {
                    const imageSrc = targetThumbnail.src;
                    changeMainImage(imageSrc, targetThumbnail);
                }
            }
        }
    </script>
</body>
</html>

