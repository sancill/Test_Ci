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
    gap: 12px;
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

.rating-stars img {
    width: 18px;
    height: 18px;
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
    font-weight: 700;
    color: #374155;
    line-height: 24px;
    margin-bottom: 24px;
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
        <nav class="breadcrumbs">
            <a href="#">Beranda</a>
            <img src="/assets/img/iconpanah.png" alt=">" />
            <a href="#">Elektronik</a>
            <img src="/assets/img/iconpanah.png" alt=">" />
            <a href="#">Laptop</a>
            <img src="/assets/img/iconpanah.png" alt=">" />
            <span class="current">Detail Produk</span>
        </nav>

        <main class="product-main">
            <div class="product-container">
                <div class="product-content">
                    <div class="product-images">
                        <img src="/assets/img/product-laptop.png"
                            alt="Laptop Gaming ASUS ROG Strix G15" class="product-main-image" />
                        <div class="product-thumbnails">
                            <img src="/assets/img/laptop1.svg"
                                alt="Thumbnail 1" class="product-thumbnail active" />
                            <img src="/assets/img/laptop2.svg"
                                alt="Thumbnail 2" class="product-thumbnail" />
                            <img src="/assets/img/laptop3.svg"
                                alt="Thumbnail 3" class="product-thumbnail" />
                            <img src="/assets/img/laptop4.svg"
                                alt="Thumbnail 4" class="product-thumbnail" />
                        </div>
                        <div class="seller-info">
                            <img src="/assets/img/laptop1.svg"
                                alt="ASUS Official Store" class="seller-avatar" />
                            <div class="seller-details">
                                <div class="seller-name">ASUS Official Store</div>
                                <div class="seller-verified">
                                    <img src="/assets/img/verify.png" alt="Verified" />
                                    <span>Verified Seller</span>
                                </div>
                            </div>
                            <button class="visit-store-btn">
                                <img src="/assets/img/toko.png" alt="Store" />
                                Kunjungi Toko
                            </button>
                        </div>
                    </div>

                    <div class="product-info">
                        <div class="product-badges">
                            <span class="product-badge official">Official Store</span>
                            <span class="product-badge stock">Ready Stock</span>
                        </div>
                        <h1 class="product-title">
                            Laptop Gaming ASUS ROG Strix G15 - Intel Core i7 Gen 12, RTX
                            3060, 16GB RAM
                        </h1>
                        <div class="product-rating">
                            <div class="rating-stars">
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
                            <span class="rating-value">4.9</span>
                            <span class="rating-divider">|</span>
                            <span class="rating-text">2.847 Penilaian</span>
                            <span class="rating-divider">|</span>
                            <span class="rating-text">5.234 Terjual</span>
                        </div>
                        <div class="product-price-box">
                            <div class="price-row">
                                <span class="price-current">Rp 18.999.000</span>
                                <span class="price-old">Rp 22.500.000</span>
                            </div>
                            <span class="discount-badge">Hemat 16%</span>
                        </div>
                        <div class="shipping-section">
                            <div class="shipping-title">
                                <img src="/assets/img/mobil.png" alt="Shopping" />
                                <span>Metode Pengiriman</span>
                            </div>
                            <div class="shipping-option selected">
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
                            <div class="shipping-option">
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
                                <button class="variant-button selected">
                                    16GB RAM / 512GB SSD
                                </button>
                                <button class="variant-button">32GB RAM / 1TB SSD</button>
                            </div>
                        </div>
                        <div class="quantity-section">
                            <div class="variant-label">Jumlah:</div>
                            <div class="quantity-control">
                                <div class="quantity-input-group">
                                    <button type="button" class="quantity-btn" onclick="updateQuantity(-1)">
                                        <img src="/assets/img/minus.png" alt="Decrease" />
                                    </button>
                                    <input type="number" name="quantity" id="quantityInput" class="quantity-input"
                                        value="1" min="1" max="10" readonly />
                                    <button type="button" class="quantity-btn" onclick="updateQuantity(1)">
                                        <img src="/assets/img/plus.png" alt="Increase" />
                                    </button>
                                </div>
                                <span class="stock-info">Stok: 47 unit</span>
                            </div>
                        </div>
                        <div class="product-actions">
                            <button class="btn-cart">
                                <img src="/assets/img/keranjang.png" alt="Cart" /><a href="/cart">
                                    Tambah ke Keranjang
                                </a>
                            </button>
                            <button class="btn-order"><a href="/pesan">Buat Pesanan</a></button>
                            <button class="btn-wishlist">
                                <img src="/assets/img/love.png" alt="Wishlist" />
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="description-section">
                <h2 class="description-title">Deskripsi Produk</h2>
                <p class="description-text">
                    Laptop Gaming ASUS ROG Strix G15 hadir dengan performa maksimal untuk
                    para gamers profesional. Ditenagai oleh prosesor Intel Core i7
                    Generasi ke-12 dan GPU NVIDIA GeForce RTX 3060, laptop ini mampu
                    menjalankan game AAA terbaru dengan lancar.
                </p>
                <h3 class="description-subtitle">Spesifikasi:</h3>
                <ul class="description-list">
                    <li>
                        <img src="/assets/img/centang.png" alt="Check" />
                        Prosesor: Intel Core i7-12700H (14 Core, 20 Thread, up to 4.7GHz)
                    </li>
                    <li>
                        <img src="/assets/img/centang.png" alt="Check" />
                        GPU: NVIDIA GeForce RTX 3060 6GB GDDR6
                    </li>
                    <li>
                        <img src="/assets/img/centang.png" alt="Check" />
                        RAM: 16GB DDR5 4800MHz (Upgradeable to 32GB)
                    </li>
                    <li>
                        <img src="/assets/img/centang.png" alt="Check" />
                        Storage: 512GB NVMe SSD PCIe 4.0
                    </li>
                    <li>
                        <img src="/assets/img/centang.png" alt="Check" />
                        Display: 15.6" FHD (1920x1080) 144Hz IPS-Level
                    </li>
                    <li>
                        <img src="/assets/img/centang.png" alt="Check" />
                        Keyboard: RGB Per-Key Backlit
                    </li>
                    <li>
                        <img src="/assets/img/centang.png" alt="Check" />
                        Cooling: ROG Intelligent Cooling dengan Dual Fan
                    </li>
                    <li>
                        <img src="/assets/img/centang.png" alt="Check" />
                        Battery: 90Wh dengan Fast Charging
                    </li>
                </ul>
                <h3 class="description-subtitle">Dalam Paket:</h3>
                <ul class="description-list">
                    <li>
                        <img src="/assets/img/paket.png" alt="Check" />
                        1x Laptop ASUS ROG Strix G15
                    </li>
                    <li>
                        <img src="/assets/img/paket.png" alt="Check" />
                        1x Adaptor 240W
                    </li>
                    <li>
                        <img src="/assets/img/paket.png" alt="Check" />
                        1x Buku Manual & Kartu Garansi
                    </li>
                    <li>
                        <img src="/assets/img/paket.png" alt="Check" />
                        Bonus: Gaming Mouse Pad ROG
                    </li>
                </ul>
            </div>

            <div class="reviews-section">
                <div class="reviews-header">
                    <h2 class="reviews-title">Ulasan Pembeli</h2>
                    <a href="#" class="reviews-link">Lihat Semua</a>
                </div>
                <div class="reviews-summary">
                    <div class="reviews-rating">
                        <div class="reviews-rating-value">4.9</div>
                        <div class="reviews-rating-stars">
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
                        <div class="reviews-rating-text">dari 2.847 ulasan</div>
                    </div>
                    <div class="reviews-distribution">
                        <div class="reviews-bar">
                            <span class="reviews-bar-label">5★</span>
                            <div class="reviews-bar-track">
                                <div class="reviews-bar-fill" style="width: 87%;"></div>
                            </div>
                            <span class="reviews-bar-count">2,477</span>
                        </div>
                        <div class="reviews-bar">
                            <span class="reviews-bar-label">4★</span>
                            <div class="reviews-bar-track">
                                <div class="reviews-bar-fill" style="width: 10%;"></div>
                            </div>
                            <span class="reviews-bar-count">285</span>
                        </div>
                        <div class="reviews-bar">
                            <span class="reviews-bar-label">3★</span>
                            <div class="reviews-bar-track">
                                <div class="reviews-bar-fill" style="width: 2%;"></div>
                            </div>
                            <span class="reviews-bar-count">57</span>
                        </div>
                        <div class="reviews-bar">
                            <span class="reviews-bar-label">2★</span>
                            <div class="reviews-bar-track">
                                <div class="reviews-bar-fill" style="width: 1%;"></div>
                            </div>
                            <span class="reviews-bar-count">19</span>
                        </div>
                        <div class="reviews-bar">
                            <span class="reviews-bar-label">1★</span>
                            <div class="reviews-bar-track">
                                <div class="reviews-bar-fill" style="width: 0.3%;"></div>
                            </div>
                            <span class="reviews-bar-count">9</span>
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
        /**
         * Update quantity berdasarkan increment/decrement
         * @param {number} change - nilai perubahan (-1 untuk kurang, 1 untuk tambah)
         */
        function updateQuantity(change) {
            const quantityInput = document.getElementById('quantityInput');
            let currentValue = parseInt(quantityInput.value) || 1;
            const maxStock = 47; // Sesuaikan dengan nilai stok
            const minQuantity = 1;

            // Hitung nilai baru
            let newValue = currentValue + change;

            // Validasi batas min dan max
            if (newValue < minQuantity) {
                newValue = minQuantity;
            } else if (newValue > maxStock) {
                newValue = maxStock;
            }

            // Update input value
            quantityInput.value = newValue;

            // Optional: Lakukan AJAX call ke server jika diperlukan
            // saveQuantityToSession(newValue);
        }

        /**
         * Optional: Simpan quantity ke session/server via AJAX
         * @param {number} quantity - jumlah yang akan disimpan
         */
        function saveQuantityToSession(quantity) {
            fetch('<?= site_url('cart/update_quantity') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        quantity: quantity
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('Quantity updated:', data);
                    }
                })
                .catch(error => console.error('Error:', error));
        }
        </script>
    </body>

    </html>