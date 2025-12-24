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

            <?php
                // Siapkan fallback data jika belum ada kiriman dari controller
                $kategoriList = $kategori ?? [];
                if (empty($kategoriList)) {
                    $kategoriList = [
                        ['nama_kategori' => 'Elektronik', 'icon_kategori' => 'assets/img/logo1.png'],
                        ['nama_kategori' => 'Fashion', 'icon_kategori' => 'assets/img/logo2.png'],
                        ['nama_kategori' => 'Buku', 'icon_kategori' => 'assets/img/logo3.png'],
                        ['nama_kategori' => 'Aplikasi & Jasa', 'icon_kategori' => 'assets/img/logo4.png'],
                        ['nama_kategori' => 'Makanan', 'icon_kategori' => 'assets/img/logo5.png'],
                        ['nama_kategori' => 'Lainnya', 'icon_kategori' => 'assets/img/logo6.png'],
                    ];
                }
            ?>
            <section class="categories">
                <div class="section-heading">
                    <div>
                        <h2>Kategori Utama</h2>
                        <p>Temukan berbagai produk dan jasa dari mahasiswa ISB</p>
                    </div>
                </div>
                <div class="category-grid">
                    <?php foreach ($kategoriList as $kat): ?>
                        <a href="<?= base_url('kategori?kategori=' . urlencode($kat['id_kategori'] ?? $kat['nama_kategori'])) ?>" class="category-card">
                            <div class="category-card__icon">
                                <img src="<?= !empty($kat['icon_kategori']) ? base_url($kat['icon_kategori']) : base_url('assets/img/logo1.png') ?>" alt="<?= esc($kat['nama_kategori']) ?>" style="width: 120px; height: 120px; object-fit: cover;" />
                            </div>
                            <h3><?= esc($kat['nama_kategori']) ?></h3>
                        </a>
                    <?php endforeach; ?>
                </div>
            </section>

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

            <section class="products" id="produk">
                <?php
                    $produkList = $produk ?? [];
                ?>
                <div class="section-heading">
                    <div>
                        <h2>Rekomendasi Produk</h2>
                        <p>Produk terbaik dari mahasiswa ISB</p>
                    </div>
                    <a class="link" href="<?= base_url('kategori?kategori=elektronik&menu=menu1') ?>">Lihat Semua</a>
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
                                        <span class="rating__value">Belum ada penilaian</span>
                                    </div>
                                    <p class="price">Rp <?= number_format($hargaTampil ?? 0, 0, ',', '.') ?></p>
                                    <div class="product-card__actions">
                                        <a href="<?= base_url('cart?id=' . ($item['id_produk'] ?? '')) ?>" class="btn btn--primary w-100">Add to Cart</a>
                                    </div>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Belum ada produk yang tersedia.</p>
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