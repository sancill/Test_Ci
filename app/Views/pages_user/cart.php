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

<div class="cart-container">
    <h1 style="margin-bottom: 32px;">Keranjang Belanja</h1>

    <?php if (empty($cartItems)): ?>
        <div class="cart-empty">
            <p style="font-size: 18px; margin-bottom: 16px;">Keranjang Anda kosong</p>
            <a href="<?= base_url('produk') ?>">Mulai Belanja</a>
        </div>
    <?php else: ?>
        <div style="display: grid; gap: 24px;">
            <?php foreach ($cartItems as $item): ?>
                <div class="cart-card" data-keranjang-id="<?= $item['id_keranjang'] ?>">
                    <a href="<?= base_url('produk/' . $item['id_produk']) ?>">
                        <img src="<?= base_url($item['gambar_utama']) ?>" alt="<?= esc($item['nama_produk']) ?>"
                            style="width: 120px; height: 120px; object-fit: cover; border-radius: 12px; border: 1px solid #e5e7eb;">
                    </a>
                    <div style="flex: 1;">
                        <h3 style="margin-bottom: 8px;">
                            <a href="<?= base_url('produk/' . $item['id_produk']) ?>" style="text-decoration: none; color: inherit;">
                                <?= esc($item['nama_produk']) ?>
                            </a>
                        </h3>
                        <div style="font-size: 14px; color: #6b7280; margin-bottom: 12px;">
                            Harga satuan: Rp <?= number_format($item['harga_display'], 0, ',', '.') ?>
                            <?php if ($item['harga_setelah_diskon'] > 0 && $item['harga_setelah_diskon'] < $item['harga_awal']): ?>
                                <span style="text-decoration: line-through; margin-left: 8px;">
                                    Rp <?= number_format($item['harga_awal'], 0, ',', '.') ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div style="display:flex; align-items:center; gap:20px;">
                            <div class="cart-quantity">
                                <button type="button" onclick="updateQuantity(<?= $item['id_keranjang'] ?>, -1)" 
                                        <?= $item['jumlah'] <= 1 ? 'disabled' : '' ?>>
                                    <img src="<?= base_url('assets/img/minus.png') ?>" alt="Decrease" />
                                </button>
                                <span id="qty-<?= $item['id_keranjang'] ?>"><?= $item['jumlah'] ?></span>
                                <button type="button" onclick="updateQuantity(<?= $item['id_keranjang'] ?>, 1)"
                                        <?= $item['jumlah'] >= $item['stok'] ? 'disabled' : '' ?>>
                                    <img src="<?= base_url('assets/img/plus.png') ?>" alt="Increase" />
                                </button>
                            </div>
                            <div style="font-size: 20px; font-weight: 700; color: #005bff;" id="subtotal-<?= $item['id_keranjang'] ?>">
                                Rp <?= number_format($item['subtotal'], 0, ',', '.') ?>
                            </div>
                        </div>
                        <div class="cart-item-actions">
                            <button type="button" class="cart-remove-btn" onclick="removeItem(<?= $item['id_keranjang'] ?>)">Batalkan</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="cart-summary">
            <div class="cart-summary-row">
                <span>Total Barang</span>
                <span id="total-items"><?= $totalItems ?> item</span>
            </div>
            <div class="cart-summary-row">
                <span>Total Harga</span>
                <span id="total-harga">Rp <?= number_format($totalHarga, 0, ',', '.') ?></span>
            </div>
            <div class="cart-summary-total">
                <div>
                    <p style="margin:0; color:#6b7280;">Total Pembayaran</p>
                    <strong id="total-pembayaran">Rp <?= number_format($totalHarga, 0, ',', '.') ?></strong>
                </div>
                <a href="<?= base_url('pesan') ?>"
                    style="background:#005bff; color:#fff; padding:12px 28px; border-radius:12px; font-weight:600; text-decoration:none;">Checkout</a>
            </div>
        </div>
    <?php endif; ?>
    
    <script>
        function updateQuantity(idKeranjang, change) {
            const qtyElement = document.getElementById('qty-' + idKeranjang);
            const currentQty = parseInt(qtyElement.textContent);
            const newQty = currentQty + change;
            
            if (newQty < 1) return;
            
            // Create form data
            const formData = new URLSearchParams();
            formData.append('id_keranjang', idKeranjang);
            formData.append('jumlah', newQty);
            
            // Get CSRF token
            const csrfTokenName = '<?= csrf_token() ?>';
            const csrfHash = '<?= csrf_hash() ?>';
            formData.append(csrfTokenName, csrfHash);
            
            fetch('<?= base_url('cart/update') ?>', {
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
            .then(data => {
                if (data.success) {
                    qtyElement.textContent = newQty;
                    document.getElementById('subtotal-' + idKeranjang).textContent = 
                        'Rp ' + data.subtotal.toLocaleString('id-ID');
                    location.reload(); // Reload to update totals
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan');
            });
        }
        
        function removeItem(idKeranjang) {
            if (!confirm('Hapus item dari keranjang?')) return;
            
            // Create form data
            const formData = new URLSearchParams();
            formData.append('id_keranjang', idKeranjang);
            
            // Get CSRF token
            const csrfTokenName = '<?= csrf_token() ?>';
            const csrfHash = '<?= csrf_hash() ?>';
            formData.append(csrfTokenName, csrfHash);
            
            console.log('Removing item:', idKeranjang);
            console.log('Form data:', formData.toString());
            
            fetch('<?= base_url('cart/remove') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                credentials: 'same-origin',
                body: formData.toString()
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert('Item berhasil dihapus dari keranjang');
                    location.reload();
                } else {
                    alert(data.message || 'Gagal menghapus item dari keranjang');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menghapus item. Silakan coba lagi.');
            });
        }
    </script>
</div>