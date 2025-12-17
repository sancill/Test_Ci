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
                    <a href="<?= base_url('kategori?kategori=elektronik&menu=menu1') ?>" class="category-card">
                        <div class="category-card__icon">
                            <img src="/assets/img/logo1.png" alt="" />
                        </div>
                        <h3>Elektronik</h3>
                    </a>
                    <a href="<?= base_url('kategori?kategori=fashion&menu=menu1') ?>" class="category-card">
                        <div class="category-card__icon">
                            <img src="/assets/img/logo2.png" alt="" />
                        </div>
                        <h3>Fashion</h3>
                    </a>
                    <a href="<?= base_url('kategori?kategori=buku&menu=menu1') ?>" class="category-card">
                        <div class="category-card__icon">
                            <img src="/assets/img/logo3.png" alt="" />
                        </div>
                        <h3>Buku</h3>
                    </a>
                    <a href="<?= base_url('kategori?kategori=aplikasi-jasa&menu=menu1') ?>" class="category-card">
                        <div class="category-card__icon">
                            <img src="/assets/img/logo4.png" alt="" />
                        </div>
                        <h3>Aplikasi &amp; Jasa</h3>
                    </a>
                    <a href="<?= base_url('kategori?kategori=makanan&menu=menu1') ?>" class="category-card">
                        <div class="category-card__icon">
                            <img src="/assets/img/logo5.png" alt="" />
                        </div>
                        <h3>Makanan</h3>
                    </a>
                    <a href="<?= base_url('kategori?kategori=lainnya&menu=menu1') ?>" class="category-card">
                        <div class="category-card__icon">
                            <img src="/assets/img/logo6.png" alt="" />
                        </div>
                        <h3>Lainnya</h3>
                    </a>
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
                <div class="section-heading">
                    <div>
                        <h2>Rekomendasi Produk</h2>
                        <p>Produk terbaik dari mahasiswa ISB</p>
                    </div>
                    <a class="link" href="<?= base_url('kategori?kategori=elektronik&menu=menu1') ?>">Lihat Semua</a>
                </div>
                <div class="product-grid">
                    <!-- Row 1 -->
                    <article class="product-card">
                        <a href="/produk">
                            <img src="/assets/img/gambarprd.png" alt="Laptop Gaming ROG" />
                        </a>
                        <div class="product-card__body">
                            <h3>Laptop Gaming ROG</h3>
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
                            <p class="price">Rp 12.500.000</p>
                            <div class="product-card__actions">
                                <a href="/cart" class="btn btn--primary w-100">Add to Cart</a>
                            </div>
                        </div>
                    </article>
                    <article class="product-card">
                        <a href="/produk">
                            <img src="/assets/img/gambarprd2.png" alt="Laptop Gaming ROG" />
                        </a>
                        <div class="product-card__body">
                            <h3>Tas Ransel Kampus</h3>
                            <div class="rating">
                                <span class="stars" aria-label="Rating 4.2 dari 5">
                                    <img src="/assets/img/stars.png" alt="" />
                                    <img src="/assets/img/stars.png" alt="" />
                                    <img src="/assets/img/stars.png" alt="" />
                                    <img src="/assets/img/stars.png" alt="" />
                                    <img src="/assets/img/stars.png" alt="" />
                                </span>
                                <span class="rating__value">(4.2)</span>
                            </div>
                            <p class="price">Rp 285.000</p>
                            <div class="product-card__actions">
                                <a href="/cart" class="btn btn--primary w-100">Add to Cart</a>
                            </div>
                        </div>
                    </article>
                    <article class="product-card">
                        <a href="/produk">
                            <img src="/assets/img/gambarprd3.png" alt="Laptop Gaming ROG" />
                        </a>
                        <div class="product-card__body">
                            <h3>Buku Algoritma</h3>
                            <div class="rating">
                                <span class="stars" aria-label="Rating 5 dari 5">
                                    <img src="/assets/img/stars.png" alt="" />
                                    <img src="/assets/img/stars.png" alt="" />
                                    <img src="/assets/img/stars.png" alt="" />
                                    <img src="/assets/img/stars.png" alt="" />
                                    <img src="/assets/img/stars.png" alt="" />
                                </span>
                                <span class="rating__value">(5.0)</span>
                            </div>
                            <p class="price">Rp 125.000</p>
                            <div class="product-card__actions">
                                <a href="/cart" class="btn btn--primary w-100">Add to Cart</a>
                            </div>
                        </div>
                    </article>
                    <article class="product-card">
                        <a href="/produk">
                            <img src="/assets/img/gambarprd4.png" alt="Laptop Gaming ROG" />
                        </a>
                        <div class="product-card__body">
                            <h3>iPhone 13 Pro</h3>
                            <div class="rating">
                                <span class="stars" aria-label="Rating 4.6 dari 5">
                                    <img src="/assets/img/stars.png" alt="" />
                                    <img src="/assets/img/stars.png" alt="" />
                                    <img src="/assets/img/stars.png" alt="" />
                                    <img src="/assets/img/stars.png" alt="" />
                                    <img src="/assets/img/stars.png" alt="" />
                                </span>
                                <span class="rating__value">(4.6)</span>
                            </div>
                            <p class="price">Rp 15.500.000</p>
                            <div class="product-card__actions">
                                <a href="/cart" class="btn btn--primary w-100">Add to Cart</a>
                            </div>

                        </div>
                    </article>
                    <!-- Row 2 -->
                    <article class="product-card">
                        <a href="/produk">
                            <img src="/assets/img/gambarprd.png" alt="Laptop Gaming ROG" />
                        </a>
                        <div class="product-card__body">
                            <h3>Laptop Gaming ROG</h3>
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
                            <p class="price">Rp 12.500.000</p>
                            <div class="product-card__actions">
                                <a href="/cart" class="btn btn--primary w-100">Add to Cart</a>
                            </div>
                        </div>
                    </article>
                    <article class="product-card">
                        <a href="/produk">
                            <img src="/assets/img/gambarprd2.png" alt="Laptop Gaming ROG" />
                        </a>
                        <div class="product-card__body">
                            <h3>Tas Ransel Kampus</h3>
                            <div class="rating">
                                <span class="stars" aria-label="Rating 4.2 dari 5">
                                    <img src="/assets/img/stars.png" alt="" />
                                    <img src="/assets/img/stars.png" alt="" />
                                    <img src="/assets/img/stars.png" alt="" />
                                    <img src="/assets/img/stars.png" alt="" />
                                    <img src="/assets/img/stars.png" alt="" />
                                </span>
                                <span class="rating__value">(4.2)</span>
                            </div>
                            <p class="price">Rp 285.000</p>
                            <div class="product-card__actions">
                                <a href="/cart" class="btn btn--primary w-100">Add to Cart</a>
                            </div>

                        </div>
                    </article>
                    <article class="product-card">
                        <a href="/produk">
                            <img src="/assets/img/gambarprd3.png" alt="Laptop Gaming ROG" />
                        </a>
                        <div class="product-card__body">
                            <h3>Buku Algoritma</h3>
                            <div class="rating">
                                <span class="stars" aria-label="Rating 5 dari 5">
                                    <img src="/assets/img/stars.png" alt="" />
                                    <img src="/assets/img/stars.png" alt="" />
                                    <img src="/assets/img/stars.png" alt="" />
                                    <img src="/assets/img/stars.png" alt="" />
                                    <img src="/assets/img/stars.png" alt="" />
                                </span>
                                <span class="rating__value">(5.0)</span>
                            </div>
                            <p class="price">Rp 125.000</p>
                            <div class="product-card__actions">
                                <a href="/cart" class="btn btn--primary w-100">Add to Cart</a>
                            </div>

                        </div>
                    </article>
                    <article class="product-card">
                        <a href="/produk">
                            <img src="/assets/img/gambarprd4.png" alt="Laptop Gaming ROG" />
                        </a>
                        <div class="product-card__body">
                            <h3>iPhone 13 Pro</h3>
                            <div class="rating">
                                <span class="stars" aria-label="Rating 4.6 dari 5">
                                    <img src="/assets/img/stars.png" alt="1" />
                                    <img src="/assets/img/stars.png" alt="2" />
                                    <img src="/assets/img/stars.png" alt="3" />
                                    <img src="/assets/img/stars.png" alt="4" />
                                    <img src="/assets/img/stars.png" alt="5" />
                                </span>
                                <span class="rating__value">(4.6)</span>
                            </div>
                            <p class="price">Rp 15.500.000</p>
                            <div class="product-card__actions">
                                <a href="/cart" class="btn btn--primary w-100">Add to Cart</a>
                            </div>
                        </div>
                    </article>
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