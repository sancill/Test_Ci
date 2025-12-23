    <style>
body {
    background: #f9fafb;
}

.checkout-header {
    background: white;
    border-bottom: 1px solid #e4e7ec;
    height: 75px;
    position: sticky;
    top: 0;
    z-index: 100;
}

.checkout-header__content {
    max-width: 1280px;
    margin: 0 auto;
    padding: clamp(12px, 2vw, 16px) clamp(20px, 5vw, 80px);
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: clamp(12px, 2vw, 24px);
}

.checkout-header__left {
    display: flex;
    align-items: center;
    gap: 32px;
}

.checkout-search {
    position: relative;
    width: 100%;
    max-width: 384px;
    min-width: 200px;
}

.checkout-search input {
    width: 100%;
    height: 42px;
    padding: 0 12px 0 39px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-size: 16px;
    color: #adaebc;
}

.checkout-search img {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    width: 16px;
    height: 16px;
}

.checkout-header__right {
    display: flex;
    align-items: center;
    gap: 24px;
}

.checkout-header__actions {
    display: flex;
    align-items: center;
    gap: 16px;
}

.checkout-header__actions img {
    width: 20px;
    height: 20px;
}

.checkout-user {
    display: flex;
    align-items: center;
    gap: 12px;
    padding-left: 24px;
    border-left: 1px solid #e4e7ec;
}

.checkout-user img {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    object-fit: cover;
}

.checkout-user span {
    font-size: 14px;
    font-weight: 500;
    color: #334155;
}

.breadcrumbs {
    max-width: 1280px;
    margin: 0 auto;
    padding: clamp(16px, 3vw, 32px) clamp(20px, 5vw, 80px) 0;
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: clamp(12px, 1.5vw, 14px);
    color: #475467;
    flex-wrap: wrap;
}

.breadcrumbs a {
    color: #475467;
}

.breadcrumbs .current {
    color: #0f172a;
    font-weight: 500;
}

.breadcrumbs img {
    width: 7.5px;
    height: 12px;
}

.checkout-main {
    max-width: 1280px;
    margin: 0 auto;
    padding: clamp(24px, 4vw, 43px) clamp(20px, 5vw, 80px);
    display: grid;
    grid-template-columns: 1fr;
    gap: clamp(16px, 2vw, 24px);
    align-items: start;
    justify-items: center;
}

.checkout-left {
    width: 100%;
}

.checkout-right {
    width: 100%;
}

@media (min-width: 1024px) {
    .checkout-main {
        grid-template-columns: 1fr 395px;
        gap: 24px;
        justify-content: center;
    }
    
    .checkout-left {
        max-width: 813px;
        width: 100%;
    }
    
    .checkout-right {
        max-width: 395px;
        width: 100%;
    }
}

@media (min-width: 1200px) {
    .checkout-main {
        grid-template-columns: 813px 395px;
        justify-content: center;
        max-width: 1280px;
        margin: 0 auto;
        padding-left: clamp(20px, 5vw, 80px);
        padding-right: clamp(20px, 5vw, 80px);
    }
    
    .checkout-left {
        max-width: 813px;
        width: 813px;
    }
    
    .checkout-right {
        max-width: 395px;
        width: 395px;
    }
}

.checkout-section {
    background: white;
    border: 1px solid #e4e7ec;
    border-radius: 12px;
    padding: clamp(16px, 2vw, 24px);
    margin-bottom: clamp(16px, 2vw, 24px);
    box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.05);
}

.checkout-section__header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 24px;
}

.checkout-section__title {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: clamp(16px, 2vw, 18px);
    font-weight: 700;
    color: #0f172a;
}

.checkout-section__title img {
    width: 18px;
    height: 18px;
}

.address-card {
    border: 1px solid #e4e7ec;
    border-radius: 8px;
    padding: clamp(12px, 1.5vw, 16px);
    margin-top: clamp(16px, 2vw, 24px);
}

.address-header {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 16px;
}

.address-name {
    font-weight: 600;
    color: #0f172a;
    margin-right: 8px;
}

.address-divider {
    color: #94a3b8;
}

.address-phone {
    color: #475467;
}

.address-text {
    color: #475467;
    font-size: 14px;
    line-height: 23px;
    margin-bottom: 16px;
}

.address-badge {
    display: inline-block;
    background: rgba(37, 99, 235, 0.1);
    color: #2563eb;
    padding: 4px 12px;
    border-radius: 9999px;
    font-size: 12px;
    font-weight: 500;
}

.product-item {
    border: 1px solid #e4e7ec;
    border-radius: 8px;
    padding: clamp(12px, 1.5vw, 16px);
    margin-top: clamp(16px, 2vw, 24px);
}

.product-store {
    display: flex;
    align-items: center;
    gap: 8px;
    padding-bottom: 16px;
    border-bottom: 1px solid #e4e7ec;
    margin-bottom: 16px;
}

.product-store img {
    width: 18px;
    height: 18px;
}

.product-store-name {
    font-weight: 600;
    color: #0f172a;
    margin-right: 8px;
}

.official-badge {
    background: #2563eb;
    color: white;
    padding: 2px 8px;
    border-radius: 4px;
    font-size: 12px;
}

.product-details {
    display: flex;
    gap: clamp(12px, 1.5vw, 16px);
    flex-wrap: wrap;
}

.product-image {
    width: 96px;
    height: 96px;
    border-radius: 8px;
    object-fit: cover;
    background: #f2f4f7;
}

.product-info {
    flex: 1;
}

.product-title {
    font-weight: 600;
    color: #0f172a;
    margin-bottom: 8px;
}

.product-variant {
    color: #475467;
    font-size: 14px;
    margin-bottom: 12px;
}

.product-price-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.product-price {
    display: flex;
    align-items: center;
    gap: 8px;
}

.product-price-current {
    font-size: clamp(16px, 2vw, 18px);
    font-weight: 700;
    color: #0f172a;
}

.product-price-old {
    font-size: 14px;
    color: #94a3b8;
    text-decoration: line-through;
}

.product-quantity {
    color: #475467;
    font-size: 14px;
}

.quantity-section {
    display: flex;
    align-items: center;
    gap: 16px;
}

.quantity-input-group {
    display: flex;
    border: 2px solid #d1d5db;
    border-radius: 8px;
    width: 160px;
    align-items: center;
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
    padding: 0;
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

.message-box {
    background: #f9fafb;
    border-radius: 8px;
    padding: 16px;
    margin-top: 24px;
}

.message-header {
    display: flex;
    justify-content: space-between;
    margin-bottom: 12px;
}

.message-label {
    color: #475467;
    font-size: 14px;
}

.message-counter {
    color: #94a3b8;
    font-size: 12px;
}

.message-input {
    width: 100%;
    height: 38px;
    padding: 0 15px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-size: 14px;
    color: #adaebc;
}

.shipping-option,
.payment-option {
    border: 2px solid #e4e7ec;
    border-radius: 8px;
    padding: clamp(12px, 1.5vw, 16px);
    margin-bottom: clamp(8px, 1vw, 12px);
    cursor: pointer;
    transition: all 0.2s;
}

.shipping-option:hover,
.payment-option:hover {
    border-color: #cbd5e1;
}

.shipping-option.selected,
.payment-option.selected {
    background: rgba(37, 99, 235, 0.05);
    border-color: #2563eb;
}

.option-content {
    display: flex;
    align-items: center;
    gap: clamp(12px, 1.5vw, 16px);
    flex-wrap: wrap;
}

.option-radio {
    width: 20px;
    height: 20px;
    border: 0.5px solid #0075ff;
    border-radius: 50%;
    position: relative;
    flex-shrink: 0;
}

.option-radio.selected::after {
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

.option-info {
    flex: 1;
}

.option-header {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 4px;
}

.option-name {
    font-weight: 600;
    color: #0f172a;
}

.option-badge {
    padding: 2px 8px;
    border-radius: 4px;
    font-size: 12px;
}

.option-badge.hemat {
    background: #dcfce7;
    color: #15803d;
}

.option-badge.cepat {
    background: #2563eb;
    color: white;
}

.option-desc {
    color: #475467;
    font-size: 14px;
}

.option-price {
    font-size: 16px;
    font-weight: 700;
    color: #0f172a;
}

.payment-icon {
    width: 48px;
    height: 32px;
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 12px;
}

.payment-icon.visa {
    background: linear-gradient(90deg, #2563eb, #60a5fa);
}

.payment-icon.bca {
    background: #2563eb;
}

.payment-icon.ewallet {
    background: #2563eb;
}

.payment-icon.cod {
    background: #334155;
}

.payment-icon img {
    width: 22.5px;
    height: 20px;
}

.summary-section {
    background: white;
    border: 1px solid #e4e7ec;
    border-radius: 12px;
    padding: clamp(16px, 2vw, 24px);
    box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.05);
    position: relative;
}

@media (min-width: 1024px) {
    .summary-section {
        position: sticky;
        top: 91px;
    }
}

.summary-title {
    font-size: clamp(16px, 2vw, 18px);
    font-weight: 700;
    color: #0f172a;
    margin-bottom: clamp(16px, 2vw, 24px);
}

.summary-row {
    display: flex;
    justify-content: space-between;
    padding: 8px 0;
    font-size: 14px;
}

.summary-label {
    color: #475467;
}

.summary-value {
    color: #0f172a;
    font-weight: 500;
}

.summary-value.discount {
    color: #16a34a;
}

.summary-divider {
    border-top: 1px solid #e4e7ec;
    margin: 16px 0;
}

.promo-section {
    margin: 24px 0;
}

.promo-header {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 12px;
}

.promo-header img {
    width: 18px;
    height: 18px;
}

.promo-header span {
    font-weight: 600;
    color: #0f172a;
    font-size: 14px;
}

.promo-input-group {
    display: flex;
    gap: 8px;
}

.promo-input {
    flex: 1;
    height: 38px;
    padding: 0 11px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-size: 14px;
    color: #adaebc;
}

.promo-button {
    background: #2563eb;
    color: white;
    border: none;
    border-radius: 8px;
    padding: 0 16px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    height: 38px;
}

.coins-section {
    background: linear-gradient(90deg, rgba(37, 99, 235, 0.1), #eff6ff);
    border: 1px solid #bfdbfe;
    border-radius: 8px;
    padding: 16px;
    margin: 24px 0;
}

.coins-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
}

.coins-title {
    font-weight: 600;
    color: #0f172a;
    font-size: 14px;
}

.coins-toggle {
    width: 44px;
    height: 24px;
    background: #d1d5db;
    border-radius: 9999px;
    position: relative;
    cursor: pointer;
}

.coins-toggle.active {
    background: #2563eb;
}

.coins-toggle::after {
    content: '';
    position: absolute;
    top: 2px;
    left: 2px;
    width: 20px;
    height: 20px;
    background: white;
    border-radius: 50%;
    transition: transform 0.2s;
}

.coins-toggle.active::after {
    transform: translateX(20px);
}

.coins-info {
    display: flex;
    justify-content: space-between;
    font-size: 12px;
}

.coins-balance {
    color: #475467;
}

.coins-save {
    color: #2563eb;
    font-weight: 500;
}

.total-section {
    border-top: 2px solid #e4e7ec;
    padding-top: 24px;
    margin-top: 24px;
}

.total-label {
    font-weight: 600;
    color: #0f172a;
    font-size: 16px;
    margin-bottom: 12px;
}

.total-amount {
    text-align: right;
}

.total-current {
    font-size: clamp(20px, 3vw, 24px);
    font-weight: 700;
    color: #2563eb;
    margin-bottom: 4px;
}

.total-old {
    font-size: 12px;
    color: #64748b;
    text-decoration: line-through;
}

.order-button {
    width: 100%;
    background: #2563eb;
    color: white;
    border: none;
    border-radius: 8px;
    padding: clamp(12px, 1.5vw, 16px);
    font-size: clamp(14px, 1.8vw, 16px);
    font-weight: 700;
    cursor: pointer;
    margin-top: clamp(16px, 2vw, 24px);
    box-shadow: 0px 4px 6px 0px rgba(37, 99, 235, 0.3),
        0px 10px 15px 0px rgba(37, 99, 235, 0.3);
}

.order-button:hover {
    background: #1d4ed8;
}

.secure-text {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    margin-top: 12px;
    font-size: 12px;
    color: #64748b;
}

.secure-text img {
    width: 12px;
    height: 12px;
}

.info-box {
    background: #eff6ff;
    border: 1px solid #bfdbfe;
    border-radius: 8px;
    padding: 16px;
    margin-top: 24px;
}

.info-header {
    display: flex;
    align-items: flex-start;
    gap: 12px;
}

.info-icon {
    width: 18px;
    height: 18px;
    flex-shrink: 0;
    margin-top: 2px;
}

.info-content h4 {
    font-weight: 600;
    color: #334155;
    font-size: 12px;
    margin-bottom: 8px;
}

.info-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.info-list li {
    font-size: 12px;
    color: #334155;
    line-height: 20px;
    margin-bottom: 4px;
}

.checkout-footer {
    background: #0f172a;
    color: white;
    padding: clamp(32px, 4vw, 48px) clamp(20px, 5vw, 80px) clamp(16px, 2vw, 24px);
    margin-top: clamp(32px, 4vw, 48px);
}

.footer-content {
    max-width: 1280px;
    margin: 0 auto;
}

.footer-top {
    display: grid;
    grid-template-columns: 1fr;
    gap: clamp(24px, 3vw, 32px);
    margin-bottom: clamp(24px, 3vw, 32px);
}

@media (min-width: 768px) {
    .footer-top {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (min-width: 1024px) {
    .footer-top {
        grid-template-columns: 474px repeat(3, 1fr);
    }
}

.footer-col h4 {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 16px;
}

.footer-col p {
    color: #94a3b8;
    font-size: 14px;
    line-height: 23px;
    margin: 12px 0 16px;
}

.footer-col ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-col ul li {
    margin-bottom: 8px;
}

.footer-col ul li a {
    color: #cbd5e1;
    font-size: 14px;
}

.footer-socials {
    display: flex;
    gap: 12px;
    margin-top: 16px;
}

.footer-socials a {
    width: 36px;
    height: 36px;
    background: #1e293b;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.footer-socials img {
    width: 16px;
    height: 16px;
}

.footer-payment {
    display: flex;
    gap: 8px;
}

.footer-payment-item {
    width: 68px;
    height: 44px;
    background: white;
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.footer-payment-item img {
    width: 22.5px;
    height: 20px;
}

.footer-bottom {
    border-top: 1px solid #1e293b;
    padding-top: clamp(16px, 2vw, 24px);
    display: flex;
    flex-direction: column;
    gap: 16px;
    justify-content: space-between;
    align-items: flex-start;
}

@media (min-width: 768px) {
    .footer-bottom {
        flex-direction: row;
        align-items: center;
    }
}

.footer-bottom p {
    color: #cbd5e1;
    font-size: 14px;
}

.footer-links {
    display: flex;
    gap: clamp(12px, 2vw, 24px);
    flex-wrap: wrap;
}

.footer-links a {
    color: #cbd5e1;
    font-size: 14px;
}
/* Responsive Design */
@media (max-width: 1024px) {
    .checkout-header__content {
        flex-wrap: wrap;
    }

    .checkout-search {
        order: 3;
        width: 100%;
        max-width: 100%;
        margin-top: 12px;
    }

    .checkout-header__left {
        flex: 1;
        min-width: 0;
    }

    .checkout-header__right {
        flex-shrink: 0;
    }
}

@media (max-width: 768px) {
    .checkout-header__content {
        padding: 10px 16px;
        gap: 12px;
    }

    .checkout-search {
        order: 2;
        width: 100%;
        max-width: 100%;
        margin-top: 8px;
    }

    .checkout-search input {
        height: 40px;
        font-size: 14px;
    }

    .checkout-user span {
        display: none;
    }

    .checkout-user {
        padding-left: 12px;
    }

    .breadcrumbs {
        padding: 16px 16px 0;
        font-size: 12px;
    }

    .checkout-section__header {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
    }

    .product-details {
        flex-direction: column;
        gap: 12px;
    }

    .product-image {
        width: 100%;
        max-width: 200px;
        height: auto;
        aspect-ratio: 1;
    }

    .product-price-row {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
    }

    .option-content {
        flex-wrap: wrap;
        gap: 12px;
    }

    .option-price {
        width: 100%;
        text-align: right;
    }

    .promo-input-group {
        flex-direction: column;
    }

    .promo-button {
        width: 100%;
    }
}

@media (max-width: 480px) {
    .checkout-header__content {
        padding: 8px 12px;
        gap: 8px;
    }

    .checkout-search {
        margin-top: 8px;
    }

    .checkout-search input {
        height: 38px;
        font-size: 12px;
        padding: 0 10px 0 36px;
    }

    .checkout-user {
        padding-left: 8px;
        gap: 8px;
    }

    .checkout-user img {
        width: 32px;
        height: 32px;
    }

    .breadcrumbs {
        padding: 12px 12px 0;
        font-size: 11px;
    }

    .checkout-section {
        padding: 16px;
        margin-bottom: 16px;
    }

    .checkout-section__title {
        font-size: 16px;
    }

    .address-card,
    .product-item {
        padding: 12px;
    }

    .summary-section {
        padding: 16px;
    }

    .summary-title {
        font-size: 16px;
        margin-bottom: 16px;
    }

    .summary-row {
        font-size: 13px;
        padding: 6px 0;
    }

    .total-current {
        font-size: 20px;
    }

    .order-button {
        padding: 14px;
        font-size: 14px;
    }

    .footer-top {
        grid-template-columns: 1fr;
        gap: 24px;
    }

    .footer-bottom {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
    }

    .footer-links {
        flex-direction: column;
        gap: 8px;
    }
}

@media (max-width: 390px) {
    .checkout-header__content {
        padding: 8px 10px;
    }

    .checkout-search input {
        height: 36px;
        font-size: 11px;
        padding: 0 8px 0 32px;
    }

    .checkout-user img {
        width: 28px;
        height: 28px;
    }

    .breadcrumbs {
        padding: 10px 10px 0;
        font-size: 10px;
    }

    .checkout-section {
        padding: 12px;
    }

    .checkout-section__title {
        font-size: 14px;
    }

    .address-card,
    .product-item {
        padding: 10px;
    }

    .product-image {
        max-width: 150px;
    }

    .summary-section {
        padding: 12px;
    }

    .summary-title {
        font-size: 14px;
    }

    .total-current {
        font-size: 18px;
    }

    .order-button {
        padding: 12px;
        font-size: 13px;
    }
}
    </style>
    </head>

    <body>
        <nav class="breadcrumbs">
            <a href="<?= base_url() ?>">Beranda</a>
            <img src="<?= base_url('assets/img/iconpanah.png') ?>" alt=">" />
            <a href="<?= base_url('cart') ?>">Keranjang</a>
            <img src="<?= base_url('assets/img/iconpanah.png') ?>" alt=">" />
            <span class="current">Checkout</span>
        </nav>

        <!-- Error/Success Messages -->
        <?php if (session()->getFlashdata('error')): ?>
            <div style="position: fixed; top: 80px; left: 50%; transform: translateX(-50%); z-index: 9999; background: #FEE2E2; color: #991B1B; padding: 16px 24px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); border: 1px solid #FCA5A5; max-width: 500px; text-align: center;">
                <strong>Error!</strong> <?= session()->getFlashdata('error') ?>
            </div>
            <script>
                setTimeout(function() {
                    document.querySelector('[style*="position: fixed"]').style.display = 'none';
                }, 5000);
            </script>
        <?php endif; ?>
        
        <?php if (session()->getFlashdata('success')): ?>
            <div style="position: fixed; top: 80px; left: 50%; transform: translateX(-50%); z-index: 9999; background: #D1FAE5; color: #065F46; padding: 16px 24px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); border: 1px solid #34D399; max-width: 500px; text-align: center;">
                <strong>Berhasil!</strong> <?= session()->getFlashdata('success') ?>
            </div>
            <script>
                setTimeout(function() {
                    document.querySelector('[style*="position: fixed"]').style.display = 'none';
                }, 5000);
            </script>
        <?php endif; ?>
        
        <!-- Error/Success Messages -->
        <?php if (session()->getFlashdata('error')): ?>
            <div id="error-message" style="position: fixed; top: 80px; left: 50%; transform: translateX(-50%); z-index: 9999; background: #FEE2E2; color: #991B1B; padding: 16px 24px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); border: 1px solid #FCA5A5; max-width: 500px; text-align: center;">
                <strong>Error!</strong> <?= esc(session()->getFlashdata('error')) ?>
            </div>
            <script>
                setTimeout(function() {
                    const errorMsg = document.getElementById('error-message');
                    if (errorMsg) {
                        errorMsg.style.display = 'none';
                    }
                }, 5000);
            </script>
        <?php endif; ?>
        
        <?php if (session()->getFlashdata('success')): ?>
            <div id="success-message" style="position: fixed; top: 80px; left: 50%; transform: translateX(-50%); z-index: 9999; background: #D1FAE5; color: #065F46; padding: 16px 24px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); border: 1px solid #34D399; max-width: 500px; text-align: center;">
                <strong>Berhasil!</strong> <?= esc(session()->getFlashdata('success')) ?>
            </div>
            <script>
                setTimeout(function() {
                    const successMsg = document.getElementById('success-message');
                    if (successMsg) {
                        successMsg.style.display = 'none';
                    }
                }, 5000);
            </script>
        <?php endif; ?>
        
        <main class="checkout-main">
            <div class="checkout-left">
                <section class="checkout-section">
                    <div class="checkout-section__header">
                        <div class="checkout-section__title">
                            <img src="<?= base_url('assets/img/icon-location.svg') ?>"
                                alt="Location" />
                            <span>Alamat Pengiriman</span>
                        </div>
                        <button id="btn-ubah-alamat" style="
                background: none;
                border: none;
                color: #2563eb;
                font-size: 14px;
                font-weight: 500;
                cursor: pointer;
              ">
                            Ubah Alamat
                        </button>
                    </div>
                    <?php if (!empty($selectedAlamat)): ?>
                        <div class="address-card">
                            <div class="address-header">
                                <span class="address-name"><?= esc($selectedAlamat['nama_penerima']) ?></span>
                                <span class="address-divider">|</span>
                                <span class="address-phone"><?= esc($selectedAlamat['no_hp']) ?></span>
                            </div>
                            <p class="address-text">
                                <?= esc($selectedAlamat['alamat_lengkap']) ?>, 
                                <?= esc($selectedAlamat['kecamatan']) ?>, 
                                <?= esc($selectedAlamat['kabupaten']) ?>, 
                                <?= esc($selectedAlamat['provinsi']) ?> 
                                <?= !empty($selectedAlamat['kode_pos']) ? esc($selectedAlamat['kode_pos']) : '' ?>
                            </p>
                            <?php if (!empty($selectedAlamat['catatan'])): ?>
                                <p style="color: #475467; font-size: 14px; margin-top: 8px;">
                                    <strong>Catatan:</strong> <?= esc($selectedAlamat['catatan']) ?>
                                </p>
                            <?php endif; ?>
                            <span class="address-badge">Alamat Utama</span>
                        </div>
                    <?php else: ?>
                        <div class="address-card">
                            <p style="color: #64748b; margin-bottom: 16px;">Belum ada alamat tersimpan</p>
                            <button style="background: #2563eb; color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer;">
                                Tambah Alamat
                            </button>
                        </div>
                    <?php endif; ?>
                </section>

                <section class="checkout-section">
                    <div class="checkout-section__header">
                        <div class="checkout-section__title">
                            <img src="<?= base_url('assets/img/icon-tas.svg') ?>"
                                alt="Shopping" />
                            <span>Produk Pesanan</span>
                        </div>
                    </div>
                    <?php foreach ($cartItems as $item): ?>
                        <div class="product-item">
                            <?php if (!empty($toko)): ?>
                                <div class="product-store">
                                    <img src="<?= base_url('assets/img/icon-store.svg') ?>" alt="Store" />
                                    <span class="product-store-name"><?= esc($toko['nama_toko']) ?></span>
                                    <?php if ($toko['status_toko'] === 'official_store'): ?>
                                        <span class="official-badge">Official Store</span>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            <div class="product-details">
                                <img src="<?= base_url($item['gambar_utama']) ?>" 
                                     alt="<?= esc($item['nama_produk']) ?>" class="product-image" />
                                <div class="product-info">
                                    <h3 class="product-title"><?= esc($item['nama_produk']) ?></h3>
                                    <div class="product-price-row">
                                        <div class="product-price">
                                            <span class="product-price-current">Rp <?= number_format($item['harga_display'], 0, ',', '.') ?></span>
                                            <?php if ($item['harga_setelah_diskon'] > 0 && $item['harga_setelah_diskon'] < $item['harga_awal']): ?>
                                                <span class="product-price-old">Rp <?= number_format($item['harga_awal'], 0, ',', '.') ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="product-quantity">
                                            Jumlah: <?= $item['jumlah'] ?> x Rp <?= number_format($item['harga_display'], 0, ',', '.') ?> = 
                                            <strong>Rp <?= number_format($item['subtotal'], 0, ',', '.') ?></strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="message-box">
                        <div class="message-header">
                            <span class="message-label">Pesan untuk penjual (Opsional)</span>
                            <span class="message-counter">0/100</span>
                        </div>
                        <input type="text" class="message-input" placeholder="Tulis pesan untuk penjual..." />
                    </div>
                </section>

                <section class="checkout-section">
                    <div class="checkout-section__header">
                        <div class="checkout-section__title">
                            <img src="<?= base_url('assets/img/icon-shipping.svg') ?>"
                                alt="Shipping" />
                            <span>Metode Pengiriman</span>
                        </div>
                    </div>
                    <?php foreach ($shippingOptions as $index => $shipping): ?>
                        <div class="shipping-option <?= $index === 0 ? 'selected' : '' ?>" 
                             onclick="selectShipping('<?= esc($shipping['name']) ?>', <?= $shipping['price'] ?>, this)">
                            <div class="option-content">
                                <div class="option-radio <?= $index === 0 ? 'selected' : '' ?>"></div>
                                <div class="option-info">
                                    <div class="option-header">
                                        <span class="option-name"><?= esc($shipping['name']) ?></span>
                                        <span class="option-badge <?= strtolower($shipping['badge']) ?>"><?= esc($shipping['badge']) ?></span>
                                    </div>
                                    <p class="option-desc"><?= esc($shipping['desc']) ?></p>
                                </div>
                                <span class="option-price">Rp <?= number_format($shipping['price'], 0, ',', '.') ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </section>

                <section class="checkout-section">
                    <div class="checkout-section__header">
                        <div class="checkout-section__title">
                            <img src="<?= base_url('assets/img/icon-payment.svg') ?>"
                                alt="Payment" />
                            <span>Metode Pembayaran</span>
                        </div>
                    </div>
                    <?php foreach ($paymentOptions as $index => $payment): ?>
                        <div class="payment-option <?= $index === 0 ? 'selected' : '' ?>" 
                             onclick="selectPayment('<?= esc($payment['name']) ?>', this)">
                            <div class="option-content">
                                <div class="option-radio <?= $index === 0 ? 'selected' : '' ?>"></div>
                                <div style="display: flex; align-items: center; gap: 12px">
                                    <div class="payment-icon <?= esc($payment['icon']) ?>">
                                        <?php if ($payment['icon'] === 'bca'): ?>
                                            <span style="color: white; font-size: 12px; font-weight: 700">BCA</span>
                                        <?php elseif ($payment['icon'] === 'visa'): ?>
                                            <img src="<?= base_url('assets/img/payment-visa-mastercard.svg') ?>" alt="Visa" />
                                        <?php elseif ($payment['icon'] === 'ewallet'): ?>
                                            <img src="<?= base_url('assets/img/payment-ewallet.svg') ?>" alt="E-Wallet" />
                                        <?php elseif ($payment['icon'] === 'cod'): ?>
                                            <img src="<?= base_url('assets/img/payment-cod.svg') ?>" alt="COD" />
                                        <?php endif; ?>
                                    </div>
                                    <div class="option-info">
                                        <div class="option-header">
                                            <span class="option-name"><?= esc($payment['name']) ?></span>
                                        </div>
                                        <p class="option-desc"><?= esc($payment['desc']) ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </section>
            </div>

            <div class="checkout-right">
                <section class="summary-section">
                    <h2 class="summary-title">Ringkasan Belanja</h2>
                    <div class="summary-row">
                        <span class="summary-label">Total Harga (<?= count($cartItems) ?> barang)</span>
                        <span class="summary-value" id="summary-total-harga">Rp <?= number_format($totalHarga, 0, ',', '.') ?></span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Total Ongkos Kirim</span>
                        <span class="summary-value" id="summary-ongkir">Rp 15.000</span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Biaya Layanan</span>
                        <span class="summary-value">Rp 1.000</span>
                    </div>
                    <div class="summary-row" id="summary-diskon" style="display: none;">
                        <span class="summary-label">Diskon</span>
                        <span class="summary-value discount" id="summary-diskon-value">- Rp 0</span>
                    </div>
                    <div class="summary-divider"></div>

                    <div class="promo-section">
                        <div class="promo-header">
                            <img src="<?= base_url('assets/img/icon-tag.svg') ?>"
                                alt="Promo" />
                            <span>Kode Promo</span>
                        </div>
                        <div class="promo-input-group">
                            <input type="text" class="promo-input" placeholder="Masukkan kode promo" />
                            <button class="promo-button">Pakai</button>
                        </div>
                    </div>

                    <div class="coins-section">
                        <div class="coins-header">
                            <span class="coins-title">ISB Coins</span>
                            <div class="coins-toggle active"></div>
                        </div>
                        <div class="coins-info">
                            <span class="coins-balance">Saldo: 25.000 coins</span>
                            <span class="coins-save">Hemat Rp 25.000</span>
                        </div>
                    </div>

                    <div class="total-section">
                        <div class="total-label">Total Pembayaran</div>
                        <div class="total-amount">
                            <div class="total-current" id="total-bayar">Rp <?= number_format($totalHarga + 15000 + 1000, 0, ',', '.') ?></div>
                        </div>
                    </div>

                    <form method="POST" action="<?= base_url('pesan/checkout') ?>" id="checkout-form" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <input type="hidden" name="id_alamat" id="input-id-alamat" value="<?= isset($selectedAlamat['id_alamat']) ? $selectedAlamat['id_alamat'] : '' ?>" />
                        <input type="hidden" name="metode_pengiriman" id="input-metode-pengiriman" value="<?= isset($shippingOptions[0]['name']) ? $shippingOptions[0]['name'] : '' ?>" />
                        <input type="hidden" name="ongkir" id="input-ongkir" value="<?= isset($shippingOptions[0]['price']) ? $shippingOptions[0]['price'] : 0 ?>" />
                        <input type="hidden" name="metode_pembayaran" id="input-metode-pembayaran" value="<?= isset($paymentOptions[0]['name']) ? $paymentOptions[0]['name'] : '' ?>" />
                        <input type="hidden" name="kode_voucher" id="input-kode-voucher" value="" />
                        <input type="hidden" name="catatan" id="input-catatan" value="" />
                        <button type="submit" class="order-button" id="btn-buat-pesanan">Buat Pesanan</button>
                    </form>
                    <div class="secure-text">
                        <img src="<?= base_url('assets/img/icon-shield.svg') ?>"
                            alt="Secure" />
                        <span>Transaksi Aman & Terpercaya</span>
                    </div>

                    <div class="info-box">
                        <div class="info-header">
                            <img src="<?= base_url('assets/img/icon-info.svg') ?>"
                                alt="Info" class="info-icon" />
                            <div class="info-content">
                                <h4>Informasi Penting:</h4>
                                <ul class="info-list">
                                    <li>Pastikan alamat pengiriman sudah benar</li>
                                    <li>Pesanan akan diproses setelah pembayaran</li>
                                    <li>Simpan bukti pembayaran Anda</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main>
        
        <script>
            let selectedShipping = {
                name: '<?= isset($shippingOptions[0]['name']) ? $shippingOptions[0]['name'] : '' ?>',
                price: <?= isset($shippingOptions[0]['price']) ? $shippingOptions[0]['price'] : 0 ?>
            };
            let selectedPayment = '<?= isset($paymentOptions[0]['name']) ? $paymentOptions[0]['name'] : '' ?>';
            let totalHarga = <?= $totalHarga ?? 0 ?>;
            let biayaLayanan = 1000;
            
            // Initialize form fields on page load
            document.addEventListener('DOMContentLoaded', function() {
                const inputIdAlamat = document.getElementById('input-id-alamat');
                const inputMetodePengiriman = document.getElementById('input-metode-pengiriman');
                const inputOngkir = document.getElementById('input-ongkir');
                const inputMetodePembayaran = document.getElementById('input-metode-pembayaran');
                
                // Ensure default values are set
                <?php if (!empty($selectedAlamat) && isset($selectedAlamat['id_alamat'])): ?>
                if (inputIdAlamat && !inputIdAlamat.value) {
                    inputIdAlamat.value = '<?= $selectedAlamat['id_alamat'] ?>';
                }
                <?php endif; ?>
                
                if (inputMetodePengiriman && !inputMetodePengiriman.value && selectedShipping.name) {
                    inputMetodePengiriman.value = selectedShipping.name;
                }
                
                if (inputOngkir && !inputOngkir.value) {
                    inputOngkir.value = selectedShipping.price;
                }
                
                if (inputMetodePembayaran && !inputMetodePembayaran.value && selectedPayment) {
                    inputMetodePembayaran.value = selectedPayment;
                }
                
                console.log('Form initialized:', {
                    idAlamat: inputIdAlamat?.value,
                    metodePengiriman: inputMetodePengiriman?.value,
                    ongkir: inputOngkir?.value,
                    metodePembayaran: inputMetodePembayaran?.value
                });
            });
            
            function selectShipping(name, price, element) {
                selectedShipping = { name, price };
                document.getElementById('input-metode-pengiriman').value = name;
                document.getElementById('input-ongkir').value = price;
                document.getElementById('summary-ongkir').textContent = 'Rp ' + price.toLocaleString('id-ID');
                
                // Update selected state
                document.querySelectorAll('.shipping-option').forEach(opt => {
                    opt.classList.remove('selected');
                    opt.querySelector('.option-radio').classList.remove('selected');
                });
                element.classList.add('selected');
                element.querySelector('.option-radio').classList.add('selected');
                
                updateTotal();
            }
            
            function selectPayment(name, element) {
                selectedPayment = name;
                document.getElementById('input-metode-pembayaran').value = name;
                
                // Update selected state
                document.querySelectorAll('.payment-option').forEach(opt => {
                    opt.classList.remove('selected');
                    opt.querySelector('.option-radio').classList.remove('selected');
                });
                element.classList.add('selected');
                element.querySelector('.option-radio').classList.add('selected');
            }
            
            let potonganVoucher = 0;
            let voucherData = null;
            
            function updateTotal() {
                const totalBayar = totalHarga + selectedShipping.price + biayaLayanan - potonganVoucher;
                document.getElementById('total-bayar').textContent = 'Rp ' + Math.max(0, totalBayar).toLocaleString('id-ID');
                
                // Update diskon display
                const diskonRow = document.getElementById('summary-diskon');
                if (potonganVoucher > 0) {
                    diskonRow.style.display = 'flex';
                    document.getElementById('summary-diskon-value').textContent = '- Rp ' + potonganVoucher.toLocaleString('id-ID');
                } else {
                    diskonRow.style.display = 'none';
                }
            }
            
            // Promo code handler
            const promoButton = document.querySelector('.promo-button');
            const promoInput = document.querySelector('.promo-input');
            
            if (promoButton && promoInput) {
                promoButton.addEventListener('click', function() {
                    const kode = promoInput.value.trim();
                    if (!kode) {
                        alert('Masukkan kode promo terlebih dahulu');
                        return;
                    }
                    
                    // Disable button
                    promoButton.disabled = true;
                    promoButton.textContent = 'Memvalidasi...';
                    
                    // Validate promo code via AJAX
                    const formData = new URLSearchParams();
                    formData.append('kode_voucher', kode);
                    formData.append('total_harga', totalHarga);
                    
                    // Add CSRF token
                    const csrfTokenName = '<?= csrf_token() ?>';
                    const csrfHash = '<?= csrf_hash() ?>';
                    formData.append(csrfTokenName, csrfHash);
                    
                    fetch('<?= base_url('pesan/validate_voucher') ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        },
                        credentials: 'same-origin',
                        body: formData.toString()
                    })
                    .then(response => response.json())
                    .then(response => {
                        if (!response.ok) {
                            return response.json().then(errorData => {
                                throw new Error(errorData.message || 'Network response was not ok');
                            });
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            potonganVoucher = data.potongan || 0;
                            voucherData = data.promo || data.voucher;
                            document.getElementById('input-kode-voucher').value = kode;
                            updateTotal();
                            alert('Kode promo berhasil diterapkan! Diskon: Rp ' + potonganVoucher.toLocaleString('id-ID'));
                            promoInput.style.borderColor = '#10b981';
                        } else {
                            potonganVoucher = 0;
                            voucherData = null;
                            document.getElementById('input-kode-voucher').value = '';
                            updateTotal();
                            alert(data.message || 'Kode promo tidak valid');
                            promoInput.style.borderColor = '#ef4444';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat validasi kode promo');
                    })
                    .finally(() => {
                        promoButton.disabled = false;
                        promoButton.textContent = 'Pakai';
                    });
                });
            }
            
            // Message counter
            const messageInput = document.querySelector('.message-input');
            const messageCounter = document.querySelector('.message-counter');
            if (messageInput && messageCounter) {
                messageInput.addEventListener('input', function() {
                    const length = this.value.length;
                    messageCounter.textContent = length + '/100';
                    document.getElementById('input-catatan').value = this.value;
                });
            }
            
            // Handle form submission - SIMPLIFIED: Let form submit naturally, only validate
            const checkoutForm = document.getElementById('checkout-form');
            if (checkoutForm) {
                checkoutForm.addEventListener('submit', function(e) {
                    // Get form values
                    const idAlamat = document.getElementById('input-id-alamat')?.value || '';
                    const metodePengiriman = document.getElementById('input-metode-pengiriman')?.value || '';
                    const metodePembayaran = document.getElementById('input-metode-pembayaran')?.value || '';
                    
                    console.log('=== CHECKOUT FORM SUBMISSION ===');
                    console.log('idAlamat:', idAlamat);
                    console.log('metodePengiriman:', metodePengiriman);
                    console.log('metodePembayaran:', metodePembayaran);
                    console.log('Form method:', this.method);
                    console.log('Form action:', this.action);
                    
                    // Validation - only prevent if validation fails
                    if (!idAlamat || idAlamat.trim() === '') {
                        e.preventDefault();
                        alert('Pilih alamat pengiriman terlebih dahulu!');
                        return false;
                    }
                    
                    if (!metodePengiriman || metodePengiriman.trim() === '') {
                        e.preventDefault();
                        alert('Pilih metode pengiriman terlebih dahulu!');
                        return false;
                    }
                    
                    if (!metodePembayaran || metodePembayaran.trim() === '') {
                        e.preventDefault();
                        alert('Pilih metode pembayaran terlebih dahulu!');
                        return false;
                    }
                    
                    // Disable button to prevent double submit
                    const btnBuatPesanan = document.getElementById('btn-buat-pesanan');
                    if (btnBuatPesanan) {
                        btnBuatPesanan.disabled = true;
                        btnBuatPesanan.textContent = 'Memproses...';
                    }
                    
                    // IMPORTANT: Don't prevent default - let form submit naturally with POST method
                    console.log('Form validation passed, submitting as POST...');
                    // Return true or don't return anything to allow natural submission
                });
            }
            
            // REMOVED DUPLICATE - using the one above
            
            // Edit address functionality
            const btnUbahAlamat = document.getElementById('btn-ubah-alamat');
            if (btnUbahAlamat) {
                btnUbahAlamat.addEventListener('click', function() {
                    <?php if (!empty($alamatList) && count($alamatList) > 1): ?>
                    const addressOptions = <?= json_encode(array_map(function($a) {
                        return [
                            'id' => $a['id_alamat'],
                            'label' => $a['nama_penerima'] . ' - ' . substr($a['alamat_lengkap'], 0, 50) . '...'
                        ];
                    }, $alamatList)) ?>;
                    
                    let optionsText = 'Pilih alamat:\n\n';
                    addressOptions.forEach((addr, index) => {
                        optionsText += (index + 1) + '. ' + addr.label + '\n';
                    });
                    
                    const choice = prompt(optionsText + '\nMasukkan nomor (1-' + addressOptions.length + '):');
                    if (choice && !isNaN(choice) && choice >= 1 && choice <= addressOptions.length) {
                        const selectedAddr = addressOptions[parseInt(choice) - 1];
                        document.getElementById('input-id-alamat').value = selectedAddr.id;
                        alert('Alamat berhasil diubah. Halaman akan dimuat ulang.');
                        location.reload();
                    }
                    <?php else: ?>
                    alert('Hanya ada satu alamat tersimpan. Silakan tambah alamat baru di menu profil.');
                    <?php endif; ?>
                });
            }
        </script>