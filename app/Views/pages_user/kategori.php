<link rel="stylesheet" href="<?= base_url('assets/css/kategori-page.css') ?>">

<main>
    <!-- Category Cards Section -->
    <section class="categories">
        <div class="section-heading">
            <div>
                <h2>Kategori Utama</h2>
                <p>Temukan berbagai produk dan jasa dari mahasiswa ISB</p>
            </div>
        </div>
        <div class="category-grid">
            <?php if (!empty($kategoriList)): ?>
                <?php 
                $iconIndex = 1;
                foreach ($kategoriList as $kat): 
                    $iconPath = !empty($kat['icon_kategori']) ? base_url($kat['icon_kategori']) : base_url('assets/img/logo' . $iconIndex . '.png');
                    if ($iconIndex > 6) $iconIndex = 1;
                    $isActive = $selectedKategoriId == $kat['id_kategori'];
                ?>
                    <a href="<?= base_url('kategori?kategori=' . $kat['id_kategori']) ?>" 
                       class="category-card <?= $isActive ? 'active' : '' ?>">
                        <div class="category-card__icon">
                            <img src="<?= $iconPath ?>" alt="<?= esc($kat['nama_kategori']) ?>" />
                        </div>
                        <h3><?= esc($kat['nama_kategori']) ?></h3>
                    </a>
                <?php 
                    $iconIndex++;
                endforeach; 
                ?>
            <?php else: ?>
                <p style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #64748b;">
                    Belum ada kategori tersedia.
                </p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Category Menu Bar -->
    <?php if (!empty($menuList)): ?>
        <section class="category-menu-bar">
            <div class="container">
                <div class="category-menu">
                    <a href="<?= base_url('kategori?kategori=' . $selectedKategoriId) ?>" 
                       class="category-menu-item <?= empty($selectedMenu) ? 'active' : '' ?>">
                        Semua
                    </a>
                    <?php foreach ($menuList as $menu): ?>
                        <a href="<?= base_url('kategori?kategori=' . $selectedKategoriId . '&menu=' . $menu['id_menu']) ?>" 
                           class="category-menu-item <?= ($selectedMenu == $menu['id_menu']) ? 'active' : '' ?>">
                            <?= esc($menu['nama_menu']) ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- Flash Sale Banner -->
    <?php if (!empty($promoAktif)): ?>
        <?php 
        $promo = $promoAktif[0];
        $tanggalBerakhir = new \DateTime($promo['tanggal_berakhir']);
        $sekarang = new \DateTime();
        $selisih = $sekarang->diff($tanggalBerakhir);
        $hariTersisa = $selisih->days;
        ?>
        <section class="flash-sale">
            <div class="flash-sale__content">
                <div>
                    <h2><?= esc($promo['nama_promo']) ?></h2>
                    <p><?= esc($promo['deskripsi_promo'] ?? 'Diskon spesial untuk produk pilihan mahasiswa') ?></p>
                    <span class="flash-sale__badge">⚡ Berakhir dalam <?= $hariTersisa ?> hari</span>
                </div>
                <a class="btn btn--light" href="<?= base_url('#produk') ?>">Lihat Promo</a>
            </div>
        </section>
    <?php else: ?>
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
    <?php endif; ?>

    <!-- Products Section -->
    <section class="products" id="produk">
        <div class="section-heading">
            <div>
                <h2>Produk <?= $selectedKategori ? esc($selectedKategori['nama_kategori']) : 'Semua Kategori' ?></h2>
                <p>Produk terbaik dari kategori <?= $selectedKategori ? esc($selectedKategori['nama_kategori']) : 'semua kategori' ?></p>
            </div>
            <a class="link" href="<?= base_url() ?>">Home</a>
        </div>
        <div class="product-grid">
            <?php if (!empty($produk)): ?>
                <?php foreach ($produk as $p): ?>
                    <article class="product-card">
                        <a href="<?= base_url('produk/' . $p['id_produk']) ?>">
                            <img src="<?= base_url($p['gambar_utama']) ?>" alt="<?= esc($p['nama_produk']) ?>" />
                        </a>
                        <div class="product-card__body">
                            <h3><?= esc($p['nama_produk']) ?></h3>
                            <?php if (!empty($p['nama_kategori'])): ?>
                                <p style="font-size: 12px; color: #64748b; margin-bottom: 8px;"><?= esc($p['nama_kategori']) ?></p>
                            <?php endif; ?>
                            <div class="rating">
                                <span class="stars" aria-label="Rating 4.8 dari 5">
                                    <img src="/assets/img/stars.png" alt="" />
                                    <img src="/assets/img/stars.png" alt="" />
                                    <img src="/assets/img/stars.png" alt="" />
                                    <img src="/assets/img/stars.png" alt="" />
                                    <img src="/assets/img/stars.png" alt="" />
                                </span>
                                <span class="rating__value">(4.8)</span>
                            </div>
                            <p class="price">Rp <?= number_format($p['harga_display'], 0, ',', '.') ?></p>
                            <?php if ($p['harga_setelah_diskon'] > 0 && $p['harga_setelah_diskon'] < $p['harga_awal']): ?>
                                <p class="price-old" style="text-decoration: line-through; color: #94a3b8; font-size: 14px;">
                                    Rp <?= number_format($p['harga_awal'], 0, ',', '.') ?>
                                </p>
                            <?php endif; ?>
                            <div class="product-card__actions">
                                <a href="<?= base_url('produk/' . $p['id_produk']) ?>" class="btn btn--primary w-100">Lihat Detail</a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #64748b;">
                    Belum ada produk tersedia untuk kategori ini.
                </p>
            <?php endif; ?>
        </div>
    </section>
</main>
