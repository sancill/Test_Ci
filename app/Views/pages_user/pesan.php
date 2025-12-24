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

<?php
    // Data checkout dikirim dari controller; fallback agar halaman tetap tampil
    $items = $items ?? [];
    if (empty($items)) {
        $items = [
            [
                'nama_produk' => 'Produk Contoh',
                'gambar' => 'assets/img/gambarprd.png',
                'qty' => 1,
                'harga' => 100000,
                'subtotal' => 100000,
            ],
        ];
    }
    $total = $total ?? array_sum(array_column($items, 'subtotal'));
    $ongkir = 15000;
    $biayaLayanan = 1000;
    $diskon = 0;
    $grandTotal = $total + $ongkir + $biayaLayanan - $diskon;

    $toko = $toko ?? [];
    $user = $user ?? null;
    $userAddress = $userAddress ?? null;
    
    // Use user address if available, otherwise fallback to toko data
    if ($userAddress) {
        $namaPenerima = $userAddress['nama_penerima'] ?? ($user['nama_user'] ?? 'Pengguna');
        $teleponRaw = $userAddress['no_hp'] ?? ($user['no_telepon'] ?? '');
        
        // Format phone number: add +62 if starts with 0 or 8
        if (!empty($teleponRaw)) {
            $teleponRaw = trim($teleponRaw);
            if (preg_match('/^0/', $teleponRaw)) {
                $teleponPenerima = '+62' . substr($teleponRaw, 1);
            } elseif (preg_match('/^8/', $teleponRaw)) {
                $teleponPenerima = '+62' . $teleponRaw;
            } elseif (preg_match('/^\+62/', $teleponRaw)) {
                $teleponPenerima = $teleponRaw;
            } else {
                $teleponPenerima = $teleponRaw;
            }
            // Format: +62 812-3456-7890
            if (strlen($teleponPenerima) > 6 && preg_match('/^\+62(\d{3})(\d{4})(\d+)$/', $teleponPenerima, $matches)) {
                $teleponPenerima = '+62 ' . $matches[1] . '-' . $matches[2] . '-' . $matches[3];
            }
        } else {
            $teleponPenerima = '+62';
        }
        
        $alamatLengkap = $userAddress['alamat_lengkap'] ?? 'Alamat belum diisi';
        
        // Add additional address details if available
        $addressParts = [];
        if (!empty($userAddress['kecamatan'])) {
            $addressParts[] = $userAddress['kecamatan'];
        }
        if (!empty($userAddress['kabupaten'])) {
            $addressParts[] = $userAddress['kabupaten'];
        }
        if (!empty($userAddress['provinsi'])) {
            $addressParts[] = $userAddress['provinsi'];
        }
        if (!empty($userAddress['kode_pos'])) {
            $addressParts[] = $userAddress['kode_pos'];
        }
        
        if (!empty($addressParts)) {
            $alamatLengkap .= ' - ' . implode(', ', $addressParts);
        }
    } else {
        // Fallback to toko data
        $namaPenerima = $toko['nama_admin'] ?? 'Pengguna';
        $teleponPenerima = $toko['telepon_admin'] ?? ($toko['whatsapp_cs'] ?? '+62');
        $alamatLengkap = $toko['alamat_toko'] ?? 'Alamat belum diisi';
        $kota = $toko['kota'] ?? '';
        $provinsi = $toko['provinsi'] ?? '';
        if ($kota || $provinsi) {
            $alamatLengkap .= ' - ' . trim($kota . ', ' . $provinsi, ', ');
        }
    }
?>
    </head>

    <body>
        <nav class="breadcrumbs">
            <a href="<?= base_url() ?>">Beranda</a>
            <img src="/assets/img/iconpanah.png" alt=">" />
            <span class="current">Checkout</span>
        </nav>

        <main class="checkout-main">
            <div class="checkout-left">
                <section class="checkout-section">
                    <div class="checkout-section__header">
                        <div class="checkout-section__title">
                            <img src="<?= base_url('assets/img/icon-location.svg') ?>"
                                alt="Location" />
                            <span>Alamat Pengiriman</span>
                        </div>
                        <a href="<?= base_url('profile') ?>#section-address" style="
                background: none;
                border: none;
                color: #2563eb;
                font-size: 14px;
                font-weight: 500;
                cursor: pointer;
                text-decoration: none;
              ">
                            Ubah Alamat
                        </a>
                    </div>
                    <div class="address-card">
                        <div class="address-header">
                            <span class="address-name"><?= esc($namaPenerima) ?></span>
                            <span class="address-divider">|</span>
                            <span class="address-phone"><?= esc($teleponPenerima) ?></span>
                        </div>
                        <p class="address-text">
                            <?= esc($alamatLengkap) ?>
                        </p>
                        <span class="address-badge">Alamat Utama</span>
                    </div>
                </section>

                <section class="checkout-section">
                    <div class="checkout-section__header">
                        <div class="checkout-section__title">
                            <img src="<?= base_url('assets/img/icon-tas.svg') ?>"
                                alt="Shopping" />
                            <span>Produk Pesanan</span>
                        </div>
                    </div>
                    <?php foreach ($items as $idx => $item): ?>
                        <?php
                            $foto = !empty($item['gambar']) ? $item['gambar'] : 'assets/img/product-headphones.png';
                            $qty = $item['qty'] ?? 1;
                            $harga = $item['harga'] ?? 0;
                            $pid = $item['id_produk'] ?? '';
                        ?>
                        <div class="product-item" data-idx="<?= $idx ?>" data-pid="<?= esc($pid) ?>" data-price="<?= $harga ?>" data-qty="<?= $qty ?>">
                            <div class="product-store">
                                <img src="<?= base_url('assets/img/icon-store.svg') ?>"
                                    alt="Store" />
                                <span class="product-store-name"><?= esc($toko['nama_toko'] ?? 'Toko') ?></span>
                                <span class="official-badge"><?= esc($toko['status_toko'] ?? 'Official Store') ?></span>
                                <button type="button" class="quantity-btn qty-remove" style="margin-left:auto;">Batalkan</button>
                            </div>
                            <div class="product-details">
                                <img src="<?= base_url($foto) ?>"
                                    alt="<?= esc($item['nama_produk']) ?>" class="product-image" />
                                <div class="product-info">
                                    <h3 class="product-title">
                                        <?= esc($item['nama_produk']) ?>
                                    </h3>
                                    <p class="product-variant">Jumlah: <?= $qty ?></p>
                                    <div class="product-price-row">
                                        <div class="product-price">
                                            <span class="product-price-current item-unit">Rp <?= number_format($harga, 0, ',', '.') ?></span>
                                        </div>
                                        <div class="quantity-section">
                                            <div class="quantity-input-group">
                                                <button type="button" class="quantity-btn qty-dec">
                                                    <img src="/assets/img/minus.png" alt="Decrease" />
                                                </button>
                                                <input type="number" class="quantity-input qty-input" value="<?= $qty ?>" min="1" max="99" readonly />
                                                <button type="button" class="quantity-btn qty-inc">
                                                    <img src="/assets/img/plus.png" alt="Increase" />
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-quantity">Subtotal: <span class="item-subtotal">Rp <?= number_format($harga * $qty, 0, ',', '.') ?></span></div>
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
                    <div class="shipping-option selected" data-method="antar" data-ongkir="15000">
                        <div class="option-content">
                            <div class="option-radio selected"></div>
                            <div class="option-info">
                                <div class="option-header">
                                    <span class="option-name">Antar Sekarang</span>
                                    <span class="option-badge hemat">Hemat</span>
                                </div>
                                <p class="option-desc">Estimasi tiba 15 - 20 m</p>
                            </div>
                            <span class="option-price">Rp 15.000</span>
                        </div>
                    </div>
                    <div class="shipping-option" data-method="datang" data-ongkir="30000">
                        <div class="option-content">
                            <div class="option-radio"></div>
                            <div class="option-info">
                                <div class="option-header">
                                    <span class="option-name">Datang ke Tempat</span>
                                    <span class="option-badge cepat">Cepat</span>
                                </div>
                                <p class="option-desc">Estimasi tiba menyesuaikan</p>
                            </div>
                            <span class="option-price">Rp 30.000</span>
                        </div>
                    </div>
                </section>

                <section class="checkout-section">
                    <div class="checkout-section__header">
                        <div class="checkout-section__title">
                            <img src="<?= base_url('assets/img/icon-payment.svg') ?>"
                                alt="Payment" />
                            <span>Metode Pembayaran</span>
                        </div>
                    </div>
                    <div class="payment-option selected" data-method="kartu">
                        <div class="option-content">
                            <div class="option-radio selected"></div>
                            <div style="display: flex; align-items: center; gap: 12px">
                                <div class="payment-icon visa">
                                    <img src="<?= base_url('assets/img/payment-visa-mastercard.svg') ?>"
                                        alt="Visa" />
                                </div>
                                <div class="option-info">
                                    <div class="option-header">
                                        <span class="option-name">Kartu Kredit/Debit</span>
                                    </div>
                                    <p class="option-desc">Visa, Mastercard, JCB</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="payment-option" data-method="bank">
                        <div class="option-content">
                            <div class="option-radio"></div>
                            <div style="display: flex; align-items: center; gap: 12px">
                                <div class="payment-icon bca">
                                    <span style="color: white; font-size: 12px; font-weight: 700">BCA</span>
                                </div>
                                <div class="option-info">
                                    <div class="option-header">
                                        <span class="option-name">Transfer Bank</span>
                                    </div>
                                    <p class="option-desc">BCA, Mandiri, BNI, BRI</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="payment-option" data-method="ewallet">
                        <div class="option-content">
                            <div class="option-radio"></div>
                            <div style="display: flex; align-items: center; gap: 12px">
                                <div class="payment-icon ewallet">
                                    <img src="<?= base_url('assets/img/payment-ewallet.svg') ?>"
                                        alt="E-Wallet" />
                                </div>
                                <div class="option-info">
                                    <div class="option-header">
                                        <span class="option-name">E-Wallet</span>
                                    </div>
                                    <p class="option-desc">GoPay, OVO, DANA, ShopeePay</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="payment-option" data-method="cod">
                        <div class="option-content">
                            <div class="option-radio"></div>
                            <div style="display: flex; align-items: center; gap: 12px">
                                <div class="payment-icon cod">
                                    <img src="<?= base_url('assets/img/payment-cod.svg') ?>"
                                        alt="COD" />
                                </div>
                                <div class="option-info">
                                    <div class="option-header">
                                        <span class="option-name">COD (Bayar di Tempat)</span>
                                    </div>
                                    <p class="option-desc">Bayar saat barang diterima</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <div class="checkout-right">
                <section class="summary-section">
                    <h2 class="summary-title">Ringkasan Belanja</h2>
                    <div class="summary-row">
                        <span class="summary-label">Total Harga (<?= count($items) ?> barang)</span>
                        <span class="summary-value" id="summary-total-harga">Rp <?= number_format($total, 0, ',', '.') ?></span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Total Ongkos Kirim</span>
                        <span class="summary-value" id="summary-ongkir">Rp <?= number_format($ongkir, 0, ',', '.') ?></span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Biaya Layanan</span>
                        <span class="summary-value" id="summary-biaya">Rp <?= number_format($biayaLayanan, 0, ',', '.') ?></span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Diskon Produk</span>
                        <span class="summary-value discount" id="summary-diskon">- Rp <?= number_format($diskon, 0, ',', '.') ?></span>
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
                            <div class="total-current" id="summary-grand">Rp <?= number_format($grandTotal, 0, ',', '.') ?></div>
                            <div class="total-old" id="summary-old">Rp <?= number_format($total + $ongkir + $biayaLayanan + 500000, 0, ',', '.') ?></div>
                        </div>
                    </div>

                    <button class="order-button" id="btn-order">Buat Pesanan</button>
                    <div id="invoice-modal" style="display:none; margin-top:12px; border:1px solid #e2e8f0; border-radius:12px; background:#fff; padding:16px; box-shadow:0 12px 32px rgba(15,23,42,0.12);">
                        <div style="display:flex; align-items:center; gap:8px; margin-bottom:12px;">
                            <span style="display:inline-flex; width:24px; height:24px; border-radius:50%; background:#22c55e; color:white; align-items:center; justify-content:center;">✔</span>
                            <div>
                                <div style="font-weight:700; color:#0f172a;">Pesanan Berhasil</div>
                                <div style="font-size:12px; color:#475569;">Invoice tersedia di bawah.</div>
                            </div>
                        </div>
                        <div id="invoice-body" style="font-size:13px; color:#1f2937;"></div>
                    </div>
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
            (function () {
                const formatIDR = (val) => 'Rp ' + Number(val).toLocaleString('id-ID');

                const itemEls = document.querySelectorAll('.product-item');
                const summaryCountLabel = document.querySelector('.summary-label');
                const summaryHargaEl = document.getElementById('summary-total-harga');
                const summaryOngkirEl = document.getElementById('summary-ongkir');
                const summaryBiayaEl = document.getElementById('summary-biaya');
                const summaryDiskonEl = document.getElementById('summary-diskon');
                const summaryGrandEl = document.getElementById('summary-grand');
                const summaryOldEl = document.getElementById('summary-old');

                let ongkir = Number(document.querySelector('.shipping-option.selected')?.dataset.ongkir || 0);
                const biaya = Number(summaryBiayaEl?.textContent.replace(/\D/g, '') || 0);
                let diskon = Number(summaryDiskonEl?.textContent.replace(/\D/g, '') || 0);
                let selectedShipping = document.querySelector('.shipping-option.selected') || null;
                let selectedPayment = document.querySelector('.payment-option.selected') || null;
                const orderBtn = document.getElementById('btn-order');
                const invoiceModal = document.getElementById('invoice-modal');
                const invoiceBody = document.getElementById('invoice-body');
                let totals = { harga: 0, qty: 0, grand: 0, ongkir: ongkir, biaya: biaya, diskon: diskon };

                function recalc() {
                    let totalHarga = 0;
                    let totalQty = 0;
                    itemEls.forEach(el => {
                        const price = Number(el.dataset.price || 0);
                        const qty = Number(el.dataset.qty || 1);
                        totalQty += qty;
                        totalHarga += price * qty;
                        const subEl = el.querySelector('.item-subtotal');
                        if (subEl) subEl.textContent = formatIDR(price * qty);
                    });
                    const grand = totalHarga + ongkir + biaya - diskon;
                    totals = { harga: totalHarga, qty: totalQty, grand, ongkir, biaya, diskon };
                    if (summaryCountLabel) summaryCountLabel.textContent = 'Total Harga (' + totalQty + ' barang)';
                    if (summaryHargaEl) summaryHargaEl.textContent = formatIDR(totalHarga);
                    if (summaryOngkirEl) summaryOngkirEl.textContent = formatIDR(ongkir);
                    if (summaryBiayaEl) summaryBiayaEl.textContent = formatIDR(biaya);
                    if (summaryDiskonEl) summaryDiskonEl.textContent = '- ' + formatIDR(diskon);
                    if (summaryGrandEl) summaryGrandEl.textContent = formatIDR(grand);
                    if (summaryOldEl) summaryOldEl.textContent = formatIDR(grand + 500000);
                }

                itemEls.forEach(el => {
                    const dec = el.querySelector('.qty-dec');
                    const inc = el.querySelector('.qty-inc');
                    const input = el.querySelector('.qty-input');
                    const unitPriceEl = el.querySelector('.item-unit');
                    const unitPrice = Number(el.dataset.price || 0);
                    const pid = el.dataset.pid;
                    if (unitPriceEl) unitPriceEl.textContent = formatIDR(unitPrice);

                    function goAdjust(delta) {
                        if (!pid) return;
                        const url = new URL('<?= base_url('pesan') ?>', window.location.origin);
                        url.searchParams.set('adjust', pid);
                        url.searchParams.set('delta', delta);
                        window.location.href = url.toString();
                    }

                    dec?.addEventListener('click', () => goAdjust(-1));
                    inc?.addEventListener('click', () => goAdjust(1));
                    el.querySelector('.qty-remove')?.addEventListener('click', () => {
                        if (!pid) {
                            el.remove();
                            recalc();
                            return;
                        }
                        const url = new URL('<?= base_url('pesan') ?>', window.location.origin);
                        url.searchParams.set('remove', pid);
                        window.location.href = url.toString();
                    });
                });

                function markShipping(opt) {
                    document.querySelectorAll('.shipping-option').forEach(o => {
                        o.classList.remove('selected');
                        const radio = o.querySelector('.option-radio');
                        radio?.classList.remove('selected');
                    });
                    opt.classList.add('selected');
                    const radio = opt.querySelector('.option-radio');
                    radio?.classList.add('selected');
                    ongkir = Number(opt.dataset.ongkir || 0);
                    selectedShipping = opt;
                    const method = opt.dataset.method || '';
                    if (method) {
                        localStorage.setItem('shipping_method', method);
                    }
                    recalc();
                }

                document.querySelectorAll('.shipping-option').forEach(opt => {
                    opt.addEventListener('click', () => markShipping(opt));
                });

                // Restore shipping choice
                const savedShipping = localStorage.getItem('shipping_method');
                if (savedShipping) {
                    const targetOpt = document.querySelector(`.shipping-option[data-method="${savedShipping}"]`);
                    if (targetOpt) {
                        markShipping(targetOpt);
                    }
                } else {
                    const defaultOpt = document.querySelector('.shipping-option.selected');
                    if (defaultOpt) {
                        markShipping(defaultOpt);
                    }
                }

                function markPayment(opt) {
                    document.querySelectorAll('.payment-option').forEach(o => {
                        o.classList.remove('selected');
                        const radio = o.querySelector('.option-radio');
                        radio?.classList.remove('selected');
                    });
                    opt.classList.add('selected');
                    const radio = opt.querySelector('.option-radio');
                    radio?.classList.add('selected');
                    selectedPayment = opt;
                    const method = opt.dataset.method || '';
                    if (method) {
                        localStorage.setItem('payment_method', method);
                    }
                }

                document.querySelectorAll('.payment-option').forEach(opt => {
                    opt.addEventListener('click', () => markPayment(opt));
                });

                const savedPayment = localStorage.getItem('payment_method');
                if (savedPayment) {
                    const targetPay = document.querySelector(`.payment-option[data-method="${savedPayment}"]`);
                    if (targetPay) {
                        markPayment(targetPay);
                    }
                } else {
                    const defaultPay = document.querySelector('.payment-option.selected');
                    if (defaultPay) {
                        markPayment(defaultPay);
                    }
                }

                function saveOrderHistory(order) {
                    try {
                        const userId = window.userId || null;
                        const storageKey = userId ? 'order_history_user_' + userId : 'order_history';
                        const raw = localStorage.getItem(storageKey);
                        const parsed = JSON.parse(raw || '[]');
                        const list = Array.isArray(parsed) ? parsed : [];
                        list.unshift(order);
                        localStorage.setItem(storageKey, JSON.stringify(list.slice(0, 20)));
                    } catch (err) {
                        const userId = window.userId || null;
                        const storageKey = userId ? 'order_history_user_' + userId : 'order_history';
                        localStorage.setItem(storageKey, JSON.stringify([order]));
                    }
                }

                function renderInvoice(order) {
                    if (!invoiceBody || !invoiceModal) return;
                    const itemsHtml = order.items.map((it, idx) => `
                        <tr>
                            <td style="padding:6px 8px; border:1px solid #e2e8f0;">${idx + 1}</td>
                            <td style="padding:6px 8px; border:1px solid #e2e8f0;">
                                <div style="font-weight:700;">${it.title}</div>
                                <div style="font-size:12px; color:#475569;">Qty: ${it.qty}</div>
                            </td>
                            <td style="padding:6px 8px; border:1px solid #e2e8f0; text-align:right;">${formatIDR(it.price)}</td>
                            <td style="padding:6px 8px; border:1px solid #e2e8f0; text-align:right;">${formatIDR(it.subtotal)}</td>
                        </tr>
                    `).join('');
                    invoiceBody.innerHTML = `
                        <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:12px;">
                            <div>
                                <div style="font-size:18px; font-weight:800; color:#111827;"><?= esc($toko['nama_toko'] ?? 'HIMAGICELL') ?></div>
                                <div style="font-size:12px; color:#475569; max-width:320px;"><?= esc($toko['alamat_toko'] ?? 'Alamat belum diisi') ?></div>
                                <div style="font-size:12px; color:#475569;"><?= esc($toko['telepon_admin'] ?? ($toko['whatsapp_cs'] ?? '')) ?></div>
                            </div>
                            <div style="text-align:right;">
                                <div style="font-size:16px; font-weight:700;">INVOICE</div>
                                <div style="font-size:12px; color:#475569;">No: ${order.id}</div>
                                <div style="font-size:12px; color:#475569;">Tanggal: ${new Date(order.createdAt).toLocaleDateString('id-ID')}</div>
                                <div style="font-size:12px; color:#16a34a; font-weight:700;">DIPROSES</div>
                            </div>
                        </div>
                        <table style="width:100%; border-collapse:collapse; margin-top:8px; font-size:13px;">
                            <thead>
                                <tr style="background:#f8fafc;">
                                    <th style="padding:6px 8px; border:1px solid #e2e8f0; text-align:left; width:40px;">No</th>
                                    <th style="padding:6px 8px; border:1px solid #e2e8f0; text-align:left;">Produk</th>
                                    <th style="padding:6px 8px; border:1px solid #e2e8f0; text-align:right; width:120px;">Harga</th>
                                    <th style="padding:6px 8px; border:1px solid #e2e8f0; text-align:right; width:140px;">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>${itemsHtml}</tbody>
                        </table>
                        <div style="margin-top:12px; display:flex; justify-content:flex-end;">
                            <div style="min-width:240px;">
                                <div style="display:flex; justify-content:space-between; padding:4px 0;"><span>Subtotal</span><span>${formatIDR(order.totals.harga)}</span></div>
                                <div style="display:flex; justify-content:space-between; padding:4px 0;"><span>Ongkir (${order.shippingMethod || '-'})</span><span>${formatIDR(order.totals.ongkir)}</span></div>
                                <div style="display:flex; justify-content:space-between; padding:4px 0;"><span>Biaya</span><span>${formatIDR(order.totals.biaya)}</span></div>
                                <div style="display:flex; justify-content:space-between; padding:4px 0;"><span>Diskon</span><span>- ${formatIDR(order.totals.diskon)}</span></div>
                                <div style="display:flex; justify-content:space-between; padding:6px 0; font-weight:800; border-top:1px solid #e2e8f0; margin-top:6px;"><span>TOTAL</span><span>${formatIDR(order.totals.grand)}</span></div>
                            </div>
                        </div>
                    `;
                    invoiceModal.style.display = 'block';
                    invoiceModal.scrollIntoView({ behavior: 'smooth' });
                }

                orderBtn?.addEventListener('click', (e) => {
                    e.preventDefault();
                    // Auto-pilih default bila belum ada (hindari blokir)
                    if (!selectedShipping) {
                        const firstShip = document.querySelector('.shipping-option');
                        if (firstShip) markShipping(firstShip);
                    }
                    if (!selectedPayment) {
                        const firstPay = document.querySelector('.payment-option');
                        if (firstPay) markPayment(firstPay);
                    }
                    if (!selectedShipping || !selectedPayment) {
                        alert('Pilih metode pengiriman dan pembayaran.');
                        return;
                    }
                    const itemsPayload = Array.from(itemEls).map(el => {
                        const title = el.querySelector('.product-title')?.textContent?.trim() || 'Produk';
                        const img = el.querySelector('.product-image')?.getAttribute('src') || '';
                        const price = Number(el.dataset.price || 0);
                        const qty = Number(el.dataset.qty || 1);
                        const pid = el.dataset.pid || '';
                        
                        // Validate required fields
                        if (!pid || !price || !qty || qty <= 0) {
                            console.error('Invalid item data:', { pid, price, qty, el });
                            return null;
                        }
                        
                        return {
                            title,
                            img,
                            price: price,
                            qty: qty,
                            subtotal: price * qty,
                            pid: String(pid) // Ensure pid is string
                        };
                    }).filter(item => item !== null); // Remove null items
                    
                    // Validate items payload
                    if (itemsPayload.length === 0) {
                        alert('Tidak ada produk yang valid untuk dipesan');
                        orderBtn.disabled = false;
                        orderBtn.dataset.processing = 'false';
                        orderBtn.textContent = 'Buat Pesanan';
                        return;
                    }
                    // Prevent double submission: check if already processing
                    if (orderBtn.dataset.processing === 'true') {
                        return; // Already processing, ignore click
                    }
                    
                    // Mark as processing and disable button
                    orderBtn.dataset.processing = 'true';
                    orderBtn.disabled = true;
                    orderBtn.textContent = 'Menyimpan pesanan...';
                    
                    // Prepare data for server
                    const orderDataForServer = {
                        items: itemsPayload,
                        shipping_method: selectedShipping?.dataset.method || '',
                        payment_method: selectedPayment?.dataset.method || '',
                        totals: totals
                    };
                    
                    // Send order to server
                    const baseUrl = (typeof window.baseUrl !== 'undefined' ? window.baseUrl : '<?= base_url() ?>');
                    fetch(baseUrl + 'pesan/create', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify(orderDataForServer)
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok: ' + response.status);
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (!data || !data.hasOwnProperty('success')) {
                            throw new Error('Invalid response format');
                        }
                        if (data.success) {
                            // Prepare order data for localStorage (fallback)
                            const orderData = {
                                id: data.no_pesanan || ('INV-' + Date.now()),
                                order_id: data.order_id,
                                createdAt: new Date().toISOString(),
                                items: itemsPayload,
                                shippingMethod: selectedShipping?.dataset.method || '',
                                paymentMethod: selectedPayment?.dataset.method || '',
                                totals,
                                status: 'Diproses',
                                buyerName: 'Pembeli'
                            };
                            
                            // Save to localStorage as backup
                            saveOrderHistory(orderData);
                            
                            // Render invoice
                            renderInvoice(orderData);
                            
                            // Redirect to profile after delay
                            setTimeout(() => {
                                window.location.href = '<?= base_url('profile') ?>';
                            }, 1500);
                        } else {
                            alert(data.message || 'Gagal membuat pesanan');
                            orderBtn.disabled = false;
                            orderBtn.dataset.processing = 'false';
                            orderBtn.textContent = 'Buat Pesanan';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat membuat pesanan: ' + error.message);
                        orderBtn.disabled = false;
                        orderBtn.dataset.processing = 'false';
                        orderBtn.textContent = 'Buat Pesanan';
                    });
                });

                recalc();
                
                // Pass userId to JavaScript
                window.userId = <?= json_encode($userId ?? null) ?>;
            })();
        </script>