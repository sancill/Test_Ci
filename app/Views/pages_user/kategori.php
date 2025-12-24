<?php
    // Utility slug (hindari redeclare)
    if (!function_exists('slugify_kat')) {
        function slugify_kat($text) {
            $text = strtolower(trim($text ?? ''));
            $text = preg_replace('/[^a-z0-9]+/i', '-', $text);
            return trim($text, '-');
        }
    }

    // Data dikirim dari controller Home::kategori atau Home::search
    $kategoriList = $kategoriList ?? [];
    $selectedKategori = $selectedKategori ?? null;
    $menuList = $menuList ?? [];
    $selectedMenu = $selectedMenu ?? null;
    $produkList = $produkList ?? [];
    $keyword = $keyword ?? '';
    $kategoriParamRaw = $_GET['kategori'] ?? '';
    $kategoriParamSlug = slugify_kat($kategoriParamRaw);

    // Fallback jika belum ada data
    if (!$selectedKategori && !empty($kategoriList)) {
        // Cari berdasarkan parameter jika ada
        foreach ($kategoriList as $kat) {
            $katSlug = slugify_kat($kat['nama_kategori'] ?? '');
            if (($kategoriParamRaw && (string)$kategoriParamRaw === (string)($kat['id_kategori'] ?? '')) ||
                ($kategoriParamSlug && $kategoriParamSlug === $katSlug)) {
                $selectedKategori = $kat;
                break;
            }
        }
        if (!$selectedKategori) {
            $selectedKategori = $kategoriList[0];
        }
    }

    $currentCategoryName = $selectedKategori['nama_kategori'] ?? 'Kategori';

    // Perbesar ikon kategori supaya mudah terlihat
?>
<link rel="stylesheet" href="<?= base_url('assets/css/kategori-page.css') ?>">

<style>
.category-card__icon img {
    width: 140px !important;
    height: 140px !important;
    object-fit: cover;
}
.category-card__icon {
    width: 160px !important;
    height: 160px !important;
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>

<main>
    <!-- Category Cards Section -->
    <section class="categories">
        <div class="section-heading">
            <div>
                <h2>Kategori Utama</h2>
                <p>Temukan berbagai produk dan jasa dari mahasiswa ISB</p>
                <p style="margin-top:8px;color:#475467;font-weight:600">
                    Kategori terpilih: <?= esc($currentCategoryName) ?> (ID: <?= esc($selectedKategori['id_kategori'] ?? '-') ?>)
                </p>
            </div>
        </div>
        <div class="category-grid">
            <?php if (!empty($kategoriList)): ?>
                <?php foreach ($kategoriList as $kat): ?>
                    <?php
                        $katSlug = slugify_kat($kat['nama_kategori'] ?? '');
                        $isActive = (!empty($selectedKategori['id_kategori']) && $selectedKategori['id_kategori'] == ($kat['id_kategori'] ?? null))
                            || ($kategoriParamSlug && $kategoriParamSlug === $katSlug)
                            || ($kategoriParamRaw && (string)$kategoriParamRaw === (string)($kat['id_kategori'] ?? ''));
                    ?>
                    <a href="<?= base_url('kategori?kategori=' . urlencode($kat['id_kategori'] ?? $katSlug)) ?>"
                       class="category-card <?= $isActive ? 'active' : '' ?>">
                        <div class="category-card__icon">
                            <img src="<?= !empty($kat['icon_kategori']) ? base_url($kat['icon_kategori']) : base_url('assets/img/logo1.png') ?>" alt="<?= esc($kat['nama_kategori']) ?>" />
                        </div>
                        <h3><?= esc($kat['nama_kategori']) ?></h3>
                        <div style="font-size:12px;color:#64748b">ID: <?= esc($kat['id_kategori'] ?? '-') ?></div>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Belum ada kategori.</p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Category Menu Bar -->
    <section class="category-menu-bar">
        <div class="container">
            <div class="category-menu">
                <?php if (!empty($menuList)): ?>
                    <?php foreach ($menuList as $menuItem): ?>
                        <a href="<?= base_url('kategori?kategori=' . urlencode($selectedKategori['id_kategori'] ?? '') . '&menu=' . urlencode($menuItem['id_menu'])) ?>" 
                           class="category-menu-item <?= (!empty($selectedMenu['id_menu']) && $selectedMenu['id_menu'] == $menuItem['id_menu']) ? 'active' : '' ?>">
                            <?= esc($menuItem['nama_menu']) ?>
                        </a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <span>Tidak ada menu pada kategori ini.</span>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Flash Sale Banner -->
    <section class="flash-sale">
        <div class="flash-sale__content">
            <div>
                <h2>Flash Sale Spesial!</h2>
                <p>Diskon hingga 70% untuk produk pilihan mahasiswa</p>
                <span class="flash-sale__badge">⚡ Berakhir dalam 2 hari</span>
            </div>
            <a class="btn btn--light" href="<?= base_url('#produk') ?>">Lihat Promo</a>
        </div>
    </section>

    <!-- Products Section -->
    <section class="products" id="produk">
        <div class="section-heading">
            <div>
                <?php if (!empty($keyword)): ?>
                    <h2>Hasil Pencarian: "<?= esc($keyword) ?>"</h2>
                    <p>Ditemukan <?= count($produkList) ?> produk untuk "<?= esc($keyword) ?>"</p>
                <?php else: ?>
                    <h2>Produk <?= esc($currentCategoryName) ?></h2>
                    <p>Produk terbaik dari kategori <?= esc($currentCategoryName) ?></p>
                <?php endif; ?>
            </div>
            <a class="link" href="<?= base_url('') ?>">Home</a>
        </div>
        <div class="product-grid">
            <?php if (!empty($produkList)): ?>
                <?php foreach ($produkList as $item): ?>
                    <?php
                        $decodedImg = !empty($item['gambar_produk']) ? json_decode($item['gambar_produk'], true) : [];
                        $firstImg = (json_last_error() === JSON_ERROR_NONE && is_array($decodedImg) && !empty($decodedImg)) ? $decodedImg[0] : ($item['gambar_produk'] ?? 'assets/img/gambarprd.png');
                        $hargaTampil = ($item['harga_setelah_diskon'] ?? 0) > 0 ? $item['harga_setelah_diskon'] : $item['harga_awal'];
                    ?>
                    <article class="product-card">
                        <a href="<?= base_url('produk?id=' . ($item['id_produk'] ?? '')) ?>">
                            <img src="<?= base_url($firstImg) ?>" alt="<?= esc($item['nama_produk'] ?? 'Produk') ?>" />
                        </a>
                        <div class="product-card__body">
                            <h3><?= esc($item['nama_produk'] ?? 'Produk') ?></h3>
                            <div class="rating">
                                <span class="stars" aria-label="Rating">
                                    <img src="/assets/img/stars.png" alt="" />
                                    <img src="/assets/img/stars.png" alt="" />
                                    <img src="/assets/img/stars.png" alt="" />
                                    <img src="/assets/img/stars.png" alt="" />
                                    <img src="/assets/img/stars.png" alt="" />
                                </span>
                                <span class="rating__value">(4.8)</span>
                            </div>
                            <p class="price">Rp <?= number_format($hargaTampil ?? 0, 0, ',', '.') ?></p>
                            <div class="product-card__actions">
                                <a href="<?= base_url('cart?id=' . ($item['id_produk'] ?? '')) ?>" class="btn btn--primary w-100">Add to Cart</a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <?php if (!empty($keyword)): ?>
                    <div style="grid-column: 1 / -1; padding: 40px; text-align: center; color: #64748b;">
                        <p style="font-size: 18px; margin-bottom: 8px;">Tidak ada produk ditemukan untuk "<?= esc($keyword) ?>"</p>
                        <p style="font-size: 14px;">Coba gunakan kata kunci lain atau <a href="<?= base_url('kategori') ?>" style="color: #2563eb; text-decoration: underline;">lihat semua produk</a></p>
                    </div>
                <?php else: ?>
                    <p>Belum ada produk pada kategori ini.</p>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </section>
</main>

