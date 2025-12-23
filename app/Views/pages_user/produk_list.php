<link rel="stylesheet" href="<?= base_url('assets/css/kategori-page.css') ?>">

<main>
    <!-- Products Section -->
    <section class="products" id="produk" style="padding-top: 40px;">
        <div class="section-heading">
            <div>
                <h2>Semua Produk</h2>
                <p>Jelajahi semua produk yang tersedia</p>
            </div>
        </div>
        
        <!-- Filter Section -->
        <div style="max-width: 1280px; margin: 0 auto; padding: 0 80px 24px;">
            <form method="get" action="<?= base_url('produk') ?>" style="display: flex; gap: 16px; flex-wrap: wrap; align-items: center;">
                <input type="text" name="search" placeholder="Cari produk..." 
                       value="<?= esc($search ?? '') ?>" 
                       style="flex: 1; min-width: 200px; padding: 12px; border: 2px solid #e4e7ec; border-radius: 8px; font-size: 16px;">
                
                <select name="kategori" style="padding: 12px; border: 2px solid #e4e7ec; border-radius: 8px; font-size: 16px;">
                    <option value="all" <?= ($filterKategori ?? 'all') === 'all' ? 'selected' : '' ?>>Semua Kategori</option>
                    <?php if (!empty($kategori)): ?>
                        <?php foreach ($kategori as $kat): ?>
                            <option value="<?= $kat['id_kategori'] ?>" <?= ($filterKategori ?? '') == $kat['id_kategori'] ? 'selected' : '' ?>>
                                <?= esc($kat['nama_kategori']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                
                <select name="menu" style="padding: 12px; border: 2px solid #e4e7ec; border-radius: 8px; font-size: 16px;">
                    <option value="all" <?= ($filterMenu ?? 'all') === 'all' ? 'selected' : '' ?>>Semua Menu</option>
                    <?php if (!empty($menu)): ?>
                        <?php foreach ($menu as $m): ?>
                            <option value="<?= $m['id_menu'] ?>" <?= ($filterMenu ?? '') == $m['id_menu'] ? 'selected' : '' ?>>
                                <?= esc($m['nama_menu']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                
                <button type="submit" style="padding: 12px 24px; background: #1e40af; color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer;">
                    Cari
                </button>
                
                <?php if ($search || ($filterKategori && $filterKategori !== 'all') || ($filterMenu && $filterMenu !== 'all')): ?>
                    <a href="<?= base_url('produk') ?>" style="padding: 12px 24px; background: #ef4444; color: white; border: none; border-radius: 8px; font-weight: 600; text-decoration: none; display: inline-block;">
                        Reset
                    </a>
                <?php endif; ?>
            </form>
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
                    Tidak ada produk yang ditemukan. Silakan coba filter lain atau cari dengan kata kunci berbeda.
                </p>
            <?php endif; ?>
        </div>
    </section>
</main>

