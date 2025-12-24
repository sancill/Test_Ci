<style>
.cart-container {
    max-width: 1280px;
    margin: 0 auto;
    padding: 40px 20px 80px;
    font-family: 'Inter', sans-serif;
}

.cart-card {
    background: #ffffff;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
    display: flex;
    gap: 24px;
    align-items: center;
    border: 1px solid #e5e7eb;
}

.cart-quantity {
    display: flex;
    border: 2px solid #d1d5db;
    border-radius: 8px;
    width: 160px;
    align-items: center;
}

.cart-quantity button {
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

.cart-quantity button img {
    width: 14px;
    height: 16px;
}

.cart-quantity span {
    width: 64px;
    height: 44px;
    text-align: center;
    font-weight: 700;
    font-size: 16px;
    color: #0f172a;
    display: flex;
    align-items: center;
    justify-content: center;
    border-left: 2px solid #d1d5db;
    border-right: 2px solid #d1d5db;
    line-height: 1;
}

.cart-item-actions {
    display: flex;
    gap: 12px;
    margin-top: 12px;
}

.cart-remove-btn {
    border: none;
    background: #fee2e2;
    color: #b91c1c;
    padding: 10px 16px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
}

.cart-summary {
    margin-top: 32px;
    background: #ffffff;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
    border: 1px solid #e5e7eb;
}

.cart-summary-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 12px;
    color: #4b5563;
}

.cart-summary-total {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 16px;
    padding-top: 16px;
    border-top: 1px solid #e5e7eb;
}

.cart-summary-total strong {
    font-size: 28px;
    color: #005bff;
}

.cart-empty {
    text-align: center;
    padding: 80px 20px;
    color: #6b7280;
}

.cart-empty a {
    color: #005bff;
    font-weight: 600;
    text-decoration: none;
}
</style>

<?php
    $cartItems = $cartItems ?? [];
    $totalHarga = $totalHarga ?? array_sum(array_column($cartItems, 'subtotal')) ?? 0;
?>

<div class="cart-container">
    <h1 style="margin-bottom: 32px;">Keranjang Belanja</h1>

    <div style="display: grid; gap: 24px;">
        <?php foreach ($cartItems as $idx => $item): ?>
            <?php
                $produk = $item['produk'] ?? [];
                $decodedImg = !empty($produk['gambar_produk']) ? json_decode($produk['gambar_produk'], true) : [];
                $firstImg = (json_last_error() === JSON_ERROR_NONE && is_array($decodedImg) && !empty($decodedImg)) ? $decodedImg[0] : ($produk['gambar_produk'] ?? 'assets/img/gambarprd.png');
                $qty = $item['quantity'] ?? 1;
                $harga = $item['harga'] ?? 0;
                $subtotal = $item['subtotal'] ?? ($harga * $qty);
            ?>
            <div class="cart-card" data-price="<?= $harga ?>" data-qty="<?= $qty ?>" data-pid="<?= esc($produk['id_produk'] ?? '') ?>">
                <img src="<?= base_url($firstImg) ?>" alt="<?= esc($produk['nama_produk'] ?? 'Produk') ?>"
                    style="width: 120px; height: 120px; object-fit: cover; border-radius: 12px; border: 1px solid #e5e7eb;">
                <div style="flex: 1;">
                    <h3 style="margin-bottom: 8px;"><?= esc($produk['nama_produk'] ?? 'Produk') ?></h3>
                    <div style="font-size: 14px; color: #6b7280; margin-bottom: 12px;">
                        Harga satuan: Rp <?= number_format($harga, 0, ',', '.') ?>
                    </div>
                    <div style="display:flex; align-items:center; gap:20px;">
                        <div class="cart-quantity">
                            <button type="button" class="btn-dec">
                                <img src="/assets/img/minus.png" alt="Decrease" />
                            </button>
                            <span class="cart-qty-val"><?= $qty ?></span>
                            <button type="button" class="btn-inc">
                                <img src="/assets/img/plus.png" alt="Increase" />
                            </button>
                        </div>
                        <div style="font-size: 20px; font-weight: 700; color: #005bff;">
                            Rp <span class="cart-subtotal"><?= number_format($subtotal, 0, ',', '.') ?></span>
                        </div>
                    </div>
                    <div class="cart-item-actions">
                        <button type="button" class="cart-remove-btn">Batalkan</button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <?php if (empty($cartItems)): ?>
            <div class="cart-empty"><p>Keranjang kosong.</p><a href="<?= base_url() ?>">Belanja sekarang</a></div>
        <?php endif; ?>
    </div>

    <div class="cart-summary">
        <div class="cart-summary-row">
            <span>Total Barang</span>
            <span id="cart-total-items"><?= count($cartItems) ?> item</span>
        </div>
        <div class="cart-summary-row">
            <span>Total Harga</span>
            <span id="cart-total-harga">Rp <?= number_format($totalHarga ?? 0, 0, ',', '.') ?></span>
        </div>
        <div class="cart-summary-total">
            <div>
                <p style="margin:0; color:#6b7280;">Total Pembayaran</p>
                <strong id="cart-grand-total">Rp <?= number_format($totalHarga ?? 0, 0, ',', '.') ?></strong>
            </div>
            <a href="/pesan"
                style="background:#005bff; color:#fff; padding:12px 28px; border-radius:12px; font-weight:600; text-decoration:none;">Checkout</a>
        </div>
    </div>
</div>
<script>
    (function () {
        const cards = document.querySelectorAll('.cart-card');
        const totalItemsEl = document.getElementById('cart-total-items');
        const totalHargaEl = document.getElementById('cart-total-harga');
        const grandTotalEl = document.getElementById('cart-grand-total');
        const container = document.querySelector('.cart-container');

        const formatIDR = (val) => 'Rp ' + Number(val).toLocaleString('id-ID');

        function recalc() {
            const cardList = document.querySelectorAll('.cart-card');
            let totalItems = 0;
            let totalHarga = 0;
            cardList.forEach(card => {
                const qty = Number(card.dataset.qty || 1);
                const price = Number(card.dataset.price || 0);
                totalItems += qty;
                totalHarga += qty * price;
            });
            totalItemsEl.textContent = totalItems + ' item';
            totalHargaEl.textContent = formatIDR(totalHarga);
            grandTotalEl.textContent = formatIDR(totalHarga);

            if (cardList.length === 0) {
                container.innerHTML = '<div class="cart-empty"><p>Keranjang kosong.</p><a href="<?= base_url() ?>">Belanja sekarang</a></div>';
            }
        }

        document.querySelectorAll('.cart-card').forEach(card => {
            const qtyEl = card.querySelector('.cart-qty-val');
            const subtotalEl = card.querySelector('.cart-subtotal');
            const dec = card.querySelector('.btn-dec');
            const inc = card.querySelector('.btn-inc');
            const removeBtn = card.querySelector('.cart-remove-btn');
            const price = Number(card.dataset.price || 0);
            const pid = card.dataset.pid;

            function goAdjust(delta) {
                if (!pid) return;
                const url = new URL('<?= base_url('cart') ?>', window.location.origin);
                url.searchParams.set('adjust', pid);
                url.searchParams.set('delta', delta);
                window.location.href = url.toString();
            }

            dec?.addEventListener('click', () => goAdjust(-1));
            inc?.addEventListener('click', () => goAdjust(1));
            removeBtn?.addEventListener('click', () => {
                const url = new URL('<?= base_url('cart') ?>', window.location.origin);
                if (pid) {
                    url.searchParams.set('remove', pid);
                    window.location.href = url.toString();
                    return;
                }
                // fallback jika pid tidak ada
                card.remove();
                recalc();
            });
        });

        recalc();
    })();
</script>