<?php
// Get category from URL parameter, default to 'elektronik'
$category = isset($_GET['kategori']) ? $_GET['kategori'] : 'elektronik';
$menu = isset($_GET['menu']) ? $_GET['menu'] : 'menu1';

// Category names mapping
$categoryNames = [
    'elektronik' => 'Elektronik',
    'fashion' => 'Fashion',
    'buku' => 'Buku',
    'aplikasi-jasa' => 'Aplikasi & Jasa',
    'makanan' => 'Makanan',
    'olahraga' => 'Olahraga',
    'lainnya' => 'Lainnya'
];

// Menu items based on category - 8 items for testing
$menuItems = [
    'elektronik' => ['Laptop', 'Smartphone', 'Tablet', 'Aksesoris', 'Gaming', 'Audio', 'Kamera', 'Smartwatch'],
    'fashion' => ['Pakaian', 'Sepatu', 'Tas', 'Aksesoris', 'Jam', 'Perhiasan', 'Kacamata', 'Topi'],
    'buku' => ['Buku Teknik', 'Buku Fiksi', 'Buku Akademik', 'Komik', 'Majalah', 'Novel', 'Biografi', 'Ensiklopedia'],
    'aplikasi-jasa' => ['Aplikasi', 'Desain', 'Programming', 'Marketing', 'Konsultasi', 'Editing', 'Translasi', 'Tutor'],
    'makanan' => ['Makanan Ringan', 'Minuman', 'Kue', 'Makanan Berat', 'Cemilan', 'Buah', 'Sayuran', 'Daging'],
    'olahraga' => ['Sepak Bola', 'Basket', 'Tenis', 'Renang', 'Fitness', 'Lari', 'Yoga', 'Sepeda'],
    'lainnya' => ['Furniture', 'Olahraga', 'Kesehatan', 'Kecantikan', 'Hobi', 'Mainan', 'Dekorasi', 'Alat Rumah']
];

$currentCategoryName = $categoryNames[$category] ?? 'Elektronik';
$currentMenus = $menuItems[$category] ?? $menuItems['elektronik'];
?>

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
            <a href="<?= base_url('kategori?kategori=elektronik&menu=menu1') ?>" class="category-card <?= ($category === 'elektronik') ? 'active' : '' ?>">
                <div class="category-card__icon">
                    <img src="/assets/img/logo1.png" alt="" />
                </div>
                <h3>Elektronik</h3>
            </a>
            <a href="<?= base_url('kategori?kategori=fashion&menu=menu1') ?>" class="category-card <?= ($category === 'fashion') ? 'active' : '' ?>">
                <div class="category-card__icon">
                    <img src="/assets/img/logo2.png" alt="" />
                </div>
                <h3>Fashion</h3>
            </a>
            <a href="<?= base_url('kategori?kategori=buku&menu=menu1') ?>" class="category-card <?= ($category === 'buku') ? 'active' : '' ?>">
                <div class="category-card__icon">
                    <img src="/assets/img/logo3.png" alt="" />
                </div>
                <h3>Buku</h3>
            </a>
            <a href="<?= base_url('kategori?kategori=aplikasi-jasa&menu=menu1') ?>" class="category-card <?= ($category === 'aplikasi-jasa') ? 'active' : '' ?>">
                <div class="category-card__icon">
                    <img src="/assets/img/logo4.png" alt="" />
                </div>
                <h3>Aplikasi &amp; Jasa</h3>
            </a>
            <a href="<?= base_url('kategori?kategori=makanan&menu=menu1') ?>" class="category-card <?= ($category === 'makanan') ? 'active' : '' ?>">
                <div class="category-card__icon">
                    <img src="/assets/img/logo5.png" alt="" />
                </div>
                <h3>Makanan</h3>
            </a>
            <a href="<?= base_url('kategori?kategori=olahraga&menu=menu1') ?>" class="category-card <?= ($category === 'olahraga') ? 'active' : '' ?>">
                <div class="category-card__icon">
                    <img src="/assets/img/logo1.png" alt="" />
                </div>
                <h3>Olahraga</h3>
            </a>
            <a href="<?= base_url('kategori?kategori=lainnya&menu=menu1') ?>" class="category-card <?= ($category === 'lainnya') ? 'active' : '' ?>">
                <div class="category-card__icon">
                    <img src="/assets/img/logo6.png" alt="" />
                </div>
                <h3>Lainnya</h3>
            </a>
        </div>
    </section>

    <!-- Category Menu Bar -->
    <section class="category-menu-bar">
        <div class="container">
            <div class="category-menu">
                <?php foreach ($currentMenus as $index => $menuName): ?>
                    <a href="<?= base_url('kategori?kategori=' . $category . '&menu=menu' . ($index + 1)) ?>" 
                       class="category-menu-item <?= ($menu === 'menu' . ($index + 1)) ? 'active' : '' ?>">
                        <?= $menuName ?>
                    </a>
                <?php endforeach; ?>
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
                <h2>Produk <?= $currentCategoryName ?></h2>
                <p>Produk terbaik dari kategori <?= $currentCategoryName ?></p>
            </div>
            <a class="link" href="<?= base_url('#') ?>">Home</a>
        </div>
        <div class="product-grid">
            <!-- Product Cards -->
            <article class="product-card">
                <a href="<?= base_url('produk') ?>">
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
                        <a href="<?= base_url('cart') ?>" class="btn btn--primary w-100">Add to Cart</a>
                    </div>
                </div>
            </article>

            <article class="product-card">
                <a href="<?= base_url('produk') ?>">
                    <img src="/assets/img/gambarprd2.png" alt="Tas Ransel Kampus" />
                </a>
                <div class="product-card__body">
                    <h3>Mwing</h3>
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
                        <a href="<?= base_url('cart') ?>" class="btn btn--primary w-100">Add to Cart</a>
                    </div>
                </div>
            </article>

            <article class="product-card">
                <a href="<?= base_url('produk') ?>">
                    <img src="/assets/img/gambarprd3.png" alt="Buku Algoritma" />
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
                        <a href="<?= base_url('cart') ?>" class="btn btn--primary w-100">Add to Cart</a>
                    </div>
                </div>
            </article>

            <article class="product-card">
                <a href="<?= base_url('produk') ?>">
                    <img src="/assets/img/gambarprd4.png" alt="iPhone 13 Pro" />
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
                        <a href="<?= base_url('cart') ?>" class="btn btn--primary w-100">Add to Cart</a>
                    </div>
                </div>
            </article>

            <article class="product-card">
                <a href="<?= base_url('produk') ?>">
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
                        <a href="<?= base_url('cart') ?>" class="btn btn--primary w-100">Add to Cart</a>
                    </div>
                </div>
            </article>

            <article class="product-card">
                <a href="<?= base_url('produk') ?>">
                    <img src="/assets/img/gambarprd2.png" alt="Tas Ransel Kampus" />
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
                        <a href="<?= base_url('cart') ?>" class="btn btn--primary w-100">Add to Cart</a>
                    </div>
                </div>
            </article>

            <article class="product-card">
                <a href="<?= base_url('produk') ?>">
                    <img src="/assets/img/gambarprd3.png" alt="Buku Algoritma" />
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
                        <a href="<?= base_url('cart') ?>" class="btn btn--primary w-100">Add to Cart</a>
                    </div>
                </div>
            </article>

            <article class="product-card">
                <a href="<?= base_url('produk') ?>">
                    <img src="/assets/img/gambarprd4.png" alt="iPhone 13 Pro" />
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
                        <a href="<?= base_url('cart') ?>" class="btn btn--primary w-100">Add to Cart</a>
                    </div>
                </div>
            </article>

            <article class="product-card">
                <a href="<?= base_url('produk') ?>">
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
                        <a href="<?= base_url('cart') ?>" class="btn btn--primary w-100">Add to Cart</a>
                    </div>
                </div>
            </article>

            <article class="product-card">
                <a href="<?= base_url('produk') ?>">
                    <img src="/assets/img/gambarprd2.png" alt="Tas Ransel Kampus" />
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
                        <a href="<?= base_url('cart') ?>" class="btn btn--primary w-100">Add to Cart</a>
                    </div>
                </div>
            </article>
        </div>
    </section>
</main>

