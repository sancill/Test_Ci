        <main>
            <section class="hero">
                <div class="hero__content">
                    <h1>
                        Marketplace Resmi <span>ISB Atma Luhur</span>
                    </h1>
                    <p class="hero__subtitle">
                        Platform jual beli barang &amp; jasa untuk seluruh civitas kampus.
                    </p>
                    <div class="hero__actions">
                        <a class="btn btn--primary" href="#produk">Mulai Belanja</a>
                        <a class="btn btn--outline" href="#produk">Jual Barang</a>
                    </div>
                </div>
                <div class="hero__art">
                    <img src="/assets/img/gambards.png" alt="Hero illustration" />
                </div>
            </section>

            <section class="categories">
                <div class="section-heading">
                    <div>
                        <h2>Kategori Utama</h2>
                        <p>Temukan berbagai produk dan jasa dari mahasiswa ISB</p>
                    </div>
                </div>
                <div class="category-grid">
                    <?php if (!empty($kategori)): ?>
                        <?php 
                        $iconIndex = 1;
                        foreach ($kategori as $kat): 
                            $iconPath = !empty($kat['icon_kategori']) ? base_url($kat['icon_kategori']) : base_url('assets/img/logo' . $iconIndex . '.png');
                            if ($iconIndex > 6) $iconIndex = 1;
                        ?>
                            <a href="<?= base_url('kategori?kategori=' . $kat['id_kategori']) ?>" class="category-card">
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
                        <!-- Fallback jika tidak ada kategori -->
                        <a href="<?= base_url('kategori') ?>" class="category-card">
                            <div class="category-card__icon">
                                <img src="/assets/img/logo1.png" alt="" />
                            </div>
                            <h3>Semua Kategori</h3>
                        </a>
                    <?php endif; ?>
                </div>
            </section>

            <?php if (!empty($promoAktif)): ?>
                <?php 
                $promo = $promoAktif[0]; // Ambil promo pertama
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
                        <a class="btn btn--light" href="#produk">Lihat Promo</a>
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
                        <a class="btn btn--light" href="#produk">Lihat Promo</a>
                    </div>
                </section>
            <?php endif; ?>

            <section class="products" id="produk">
                <div class="section-heading">
                    <div>
                        <h2>Rekomendasi Produk</h2>
                        <p>Produk terbaik dari mahasiswa ISB</p>
                    </div>
                    <a class="link" href="<?= base_url('produk') ?>">Lihat Semua</a>
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
                            Belum ada produk tersedia. Silakan cek kembali nanti.
                        </p>
                    <?php endif; ?>
                </div>
            </section>

            <section class="about">
                <div class="about__content">
                    <div class="eyebrow-tag">Tentang ISBCOMMERCE</div>
                    <h2>Platform Marketplace Terpercaya untuk Semua Kebutuhan Anda</h2>
                    <p>
                        ISBCOMMERCE adalah marketplace online terkemuka yang menghadirkan
                        pengalaman berbelanja modern, aman, dan terpercaya. Kami
                        menghubungkan jutaan pembeli dengan ribuan penjual terbaik di
                        seluruh Indonesia.
                    </p>
                    <p>
                        Dengan komitmen terhadap kualitas produk, keamanan transaksi, dan
                        kepuasan pelanggan, ISBCOMMERCE telah menjadi pilihan utama untuk
                        belanja online. Kami menyediakan berbagai kategori produk mulai
                        dari elektronik, fashion, furniture, hingga kebutuhan sehari-hari
                        dengan harga kompetitif.
                    </p>
                </div>
                <div class="about__media">
                    <div class="about__highlights">
                        <article>
                            <div class="icon-pill">
                                <img src="/assets/img/1.png" alt="" />
                            </div>
                            <p>Kualitas Terjamin</p>
                        </article>
                        <article>
                            <div class="icon-pill">
                                <img src="/assets/img/2.png" alt="" />
                            </div>
                            <p>Seller Terverifikasi</p>
                        </article>
                        <article>
                            <div class="icon-pill">
                                <img src="/assets/img/3.png" alt="" />
                            </div>
                            <p>Pembayaran Aman</p>
                        </article>
                    </div>
                    <div class="about__image">
                        <img src="/assets/img/gambarfooter.png" alt="Marketplace dashboard on laptop" />
                    </div>
                    <div class="stat-cards">
                        <div class="stat-card stat-card--blue">
                            <div class="stat-card__icon">
                                <img src="/assets/img/paket.png" alt="" />
                            </div>
                            <div>
                                <p class="stat-card__value">5000+</p>
                                <p class="stat-card__label">Transaksi/Hari</p>
                            </div>
                        </div>
                        <div class="stat-card stat-card--green">
                            <div class="stat-card__icon">
                                <img src="/assets/img/rating.png" alt="" />
                            </div>
                            <div>
                                <p class="stat-card__value">4.8/5</p>
                                <p class="stat-card__label">Rating Pengguna</p>
                            </div>
                        </div>
                    </div>
            </section>
        </main>