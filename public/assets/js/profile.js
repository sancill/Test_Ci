// Interactive functionality for the landing page

document.addEventListener('DOMContentLoaded', function() {
    const formatIDR = (val) => 'Rp ' + Number(val || 0).toLocaleString('id-ID');
    const ensureInvoiceModal = () => {
        let modal = document.getElementById('invoice-viewer');
        if (!modal) {
            modal = document.createElement('div');
            modal.id = 'invoice-viewer';
            modal.style.position = 'fixed';
            modal.style.inset = '0';
            modal.style.background = 'rgba(15,23,42,0.45)';
            modal.style.display = 'none';
            modal.style.alignItems = 'center';
            modal.style.justifyContent = 'center';
            modal.style.zIndex = '9999';
            modal.innerHTML = `
                <div style="background:#fff; border-radius:12px; max-width:720px; width:90%; max-height:90vh; overflow:auto; box-shadow:0 20px 50px rgba(15,23,42,0.3); padding:20px; position:relative;">
                    <button id="invoice-close" style="position:absolute; top:12px; right:12px; border:none; background:#e2e8f0; width:32px; height:32px; border-radius:8px; cursor:pointer;">✕</button>
                    <div id="invoice-content"></div>
                </div>`;
            document.body.appendChild(modal);
            modal.querySelector('#invoice-close').addEventListener('click', () => {
                modal.style.display = 'none';
            });
        }
        return modal;
    };

    // Navigation items click handlers with smooth scroll
    const navItems = document.querySelectorAll('.nav-item');
    navItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.dataset.target;
            if (targetId) {
                const el = document.getElementById(targetId);
                if (el) {
                    el.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }
            navItems.forEach(nav => nav.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Edit Profile functionality
    const editProfileBtn = document.getElementById('editProfileBtn');
    const saveProfileBtn = document.getElementById('saveProfileBtn');
    const cancelProfileBtn = document.getElementById('cancelProfileBtn');
    const fieldInputs = document.querySelectorAll('.field-input-control');
    const fieldContainers = document.querySelectorAll('.field-input');
    
    let originalValues = {};

    // Sync phone from profile to address section
    const phoneInputInProfile = document.querySelector('input[data-field="phone"]');
    const addrPhoneForSync = document.getElementById('addrPhone');
    
    if (phoneInputInProfile && addrPhoneForSync) {
        // When phone in profile changes, sync to address phone if address phone is empty
        phoneInputInProfile.addEventListener('input', function() {
            if (addrPhoneForSync && (!addrPhoneForSync.value || addrPhoneForSync.value.trim() === '')) {
                addrPhoneForSync.value = this.value;
            }
        });
        
        // When phone in profile is edited, also update address phone if empty
        phoneInputInProfile.addEventListener('change', function() {
            if (addrPhoneForSync && (!addrPhoneForSync.value || addrPhoneForSync.value.trim() === '')) {
                addrPhoneForSync.value = this.value;
            }
        });
    }

    if (editProfileBtn) {
        editProfileBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Sync phone when edit button is clicked
            setTimeout(() => {
                if (phoneInputInProfile && addrPhoneForSync && phoneInputInProfile.value && (!addrPhoneForSync.value || addrPhoneForSync.value.trim() === '')) {
                    addrPhoneForSync.value = phoneInputInProfile.value;
                }
            }, 100);
            
            // Store original values
            fieldInputs.forEach(input => {
                if (input.dataset.field) {
                    originalValues[input.dataset.field] = input.value;
                }
            });
            
            // Make fields editable
            fieldInputs.forEach(input => {
                input.removeAttribute('readonly');
                input.style.cursor = 'text';
            });
            
            // Add editing class to containers
            fieldContainers.forEach(container => {
                container.classList.add('editing');
            });
            
            // Show/hide buttons
            editProfileBtn.style.display = 'none';
            saveProfileBtn.style.display = 'flex';
            cancelProfileBtn.style.display = 'flex';
        });
    }

    if (saveProfileBtn) {
        saveProfileBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Collect new values
            const newValues = {};
            fieldInputs.forEach(input => {
                if (input.dataset.field) {
                    newValues[input.dataset.field] = input.value;
                }
            });
            
            // Send data to server via AJAX
            const formData = new FormData();
            if (newValues.phone !== undefined) {
                formData.append('phone', newValues.phone);
            }
            
            fetch((typeof window.baseUrl !== 'undefined' ? window.baseUrl : '') + 'profile/save', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message || 'Profil berhasil disimpan!');
                    // Make fields read-only again
                    fieldInputs.forEach(input => {
                        input.setAttribute('readonly', 'readonly');
                        input.style.cursor = 'default';
                    });
                    // Remove editing class
                    fieldContainers.forEach(container => {
                        container.classList.remove('editing');
                    });
                    // Show/hide buttons
                    editProfileBtn.style.display = 'flex';
                    saveProfileBtn.style.display = 'none';
                    cancelProfileBtn.style.display = 'none';
                    // Update original values
                    originalValues = { ...newValues };
                    // Reload page to show updated data
                    window.location.reload();
                } else {
                    alert(data.message || 'Gagal menyimpan profil');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menyimpan profil');
            });
        });
    }

    if (cancelProfileBtn) {
        cancelProfileBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Restore original values
            fieldInputs.forEach(input => {
                if (input.dataset.field && originalValues[input.dataset.field]) {
                    input.value = originalValues[input.dataset.field];
                }
                input.setAttribute('readonly', 'readonly');
                input.style.cursor = 'default';
            });
            
            // Remove editing class
            fieldContainers.forEach(container => {
                container.classList.remove('editing');
            });
            
            // Show/hide buttons
            editProfileBtn.style.display = 'flex';
            saveProfileBtn.style.display = 'none';
            cancelProfileBtn.style.display = 'none';
        });
    }

    // Wishlist render from localStorage
    const wishlistGrid = document.querySelector('#wishlist-grid');
    const wishlistSubtitle = document.querySelector('.wishlist-subtitle');
    function renderWishlist() {
        if (!wishlistGrid) return;
        let wish = [];
        try {
            const raw = localStorage.getItem('wishlist_items');
            const parsed = JSON.parse(raw || '[]');
            wish = Array.isArray(parsed) ? parsed : [];
        } catch (e) {
            wish = [];
        }
        if (wish.length === 0) {
            wishlistGrid.innerHTML = '<div style="padding:12px; color:#64748b;">Belum ada wishlist. Klik ikon hati di halaman produk untuk menambahkan.</div>';
            if (wishlistSubtitle) wishlistSubtitle.textContent = 'Belum ada wishlist';
            return;
        }
        wishlistGrid.innerHTML = '';
        wish.forEach(item => {
            const card = document.createElement('div');
            card.className = 'wishlist-item';
            card.innerHTML = `
                <div class="wishlist-image-wrapper">
                    <div class="wishlist-image">
                        <img src="${item.img || '/assets/img/logo.png'}" alt="${item.title}">
                    </div>
                </div>
                <h4 class="wishlist-title">${item.title || 'Produk'}</h4>
                <p class="wishlist-price">${formatIDR(item.price || 0)}</p>
                <button class="detail-btn" style="margin-top:8px;" data-pid="${item.pid || ''}">Lihat</button>
            `;
            card.querySelector('.detail-btn').addEventListener('click', () => {
                if (item.pid) {
                    window.location.href = `/produk?id=${item.pid}`;
                }
            });
            wishlistGrid.appendChild(card);
        });
        wishlistGrid.style.overflowX = 'auto';
        wishlistGrid.style.overflowY = 'hidden';
        wishlistGrid.style.flexWrap = 'nowrap';
        if (wishlistSubtitle) wishlistSubtitle.textContent = `${wish.length} produk disimpan`;
    }
    renderWishlist();

    // View All button
    const viewAllBtn = document.querySelector('.view-all-btn');
    if (viewAllBtn) {
        viewAllBtn.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('View All clicked');
            // Add your view all functionality here
        });
    }

    // Get user ID from PHP variable (will be injected by view)
    const userId = typeof window.userId !== 'undefined' ? window.userId : null;
    
    // Render purchase history from localStorage (orders disimpan setelah checkout)
    // Menggunakan key per user: order_history_user_{userId}
    const purchaseList = document.querySelector('#purchase-list');
    let renderedOrders = [];
    if (purchaseList && userId) {
        let orders = [];
        try {
            const storageKey = 'order_history_user_' + userId;
            const raw = localStorage.getItem(storageKey);
            const parsed = JSON.parse(raw || '[]');
            orders = Array.isArray(parsed) ? parsed : [];
        } catch (err) {
            orders = [];
        }

        // Only render if there are orders in localStorage AND the list is empty (no database orders)
        if (orders.length > 0 && purchaseList.children.length === 0) {
            renderedOrders = orders;
            const highlightId = new URLSearchParams(window.location.search).get('order');
            purchaseList.innerHTML = '';
            orders.forEach(order => {
                const firstItem = order.items?.[0] || {};
                const itemTitle = firstItem.title || 'Produk';
                const itemImg = firstItem.img || '/assets/img/gambarprd.png';
                const created = order.createdAt ? new Date(order.createdAt).toLocaleDateString('id-ID') : '';
                const statusText = order.status || 'Diproses';
                const statusClass = statusText.toLowerCase() === 'selesai' ? 'status-completed' : 'status-shipped';
                const orderPrice = order.totals?.grand ?? firstItem.subtotal ?? 0;

                const wrapper = document.createElement('div');
                wrapper.className = 'purchase-item';
                wrapper.dataset.orderId = order.id || '';
                if (highlightId && highlightId === order.id) {
                    wrapper.style.border = '1px solid #2563eb';
                    wrapper.style.boxShadow = '0 6px 20px rgba(37,99,235,0.12)';
                }
                wrapper.innerHTML = `
                    <div class="purchase-image">
                        <img src="${itemImg}" alt="${itemTitle}">
                    </div>
                    <div class="purchase-details">
                        <h3 class="purchase-title">${itemTitle}</h3>
                        <p class="purchase-date">${created}</p>
                        <div class="purchase-meta">
                            <span class="status-badge ${statusClass}">${statusText}</span>
                            <span class="order-number">${order.id || ''}</span>
                        </div>
                    </div>
                    <div class="purchase-action">
                        <p class="purchase-price">${formatIDR(orderPrice)}</p>
                        <button class="detail-btn">Lihat Invoice</button>
                    </div>
                `;
                purchaseList.appendChild(wrapper);
            });

            // Attach invoice view handlers
            purchaseList.querySelectorAll('.detail-btn').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    const pid = btn.closest('.purchase-item')?.dataset.orderId;
                    if (!pid) return;
                    const order = renderedOrders.find(o => (o.id || '') === pid);
                    if (!order) return;
                    const firstItem = (order.items || [])[0] || {};
                    const modal = ensureInvoiceModal();
                    const host = modal.querySelector('#invoice-content');
                    const itemsHtml = (order.items || []).map((it, idx) => `
                        <tr>
                            <td style="padding:8px 10px; border:1.5px solid #cbd5e1;">${idx + 1}</td>
                            <td style="padding:8px 10px; border:1.5px solid #cbd5e1;">
                                <div style="font-weight:700;">${it.title}</div>
                                <div style="font-size:12px; color:#475569;">Qty: ${it.qty}</div>
                            </td>
                            <td style="padding:8px 10px; border:1.5px solid #cbd5e1; text-align:right;">${formatIDR(it.price)}</td>
                            <td style="padding:8px 10px; border:1.5px solid #cbd5e1; text-align:right;">${formatIDR(it.subtotal)}</td>
                        </tr>
                    `).join('');
                    host.innerHTML = `
                        <div style="text-align:center; margin-bottom:16px;">
                            <div style="font-size:12px; color:#475569;"><?= esc($toko['nama_toko'] ?? 'HIMAGICELL') ?></div>
                            <div style="font-size:20px; font-weight:800; color:#0f172a; letter-spacing:0.5px;">INVOICE</div>
                            <div style="font-size:12px; color:#475569; margin-top:4px;">No: ${order.id}</div>
                            <div style="font-size:12px; color:#475569;">Tanggal: ${order.createdAt ? new Date(order.createdAt).toLocaleDateString('id-ID') : ''}</div>
                            <div style="font-size:12px; color:#16a34a; font-weight:700; margin-top:4px;">${order.status || 'Diproses'}</div>
                        </div>
                        <div style="display:flex; justify-content:space-between; gap:16px; margin-bottom:12px; align-items:flex-start;">
                            <div style="font-size:12px; color:#475569;">
                                <div style="font-weight:700; color:#111827; margin-bottom:4px;">Toko</div>
                                <div><?= esc($toko['nama_toko'] ?? 'HIMAGICELL') ?></div>
                                <div style="max-width:320px;"><?= esc($toko['alamat_toko'] ?? 'Alamat belum diisi') ?></div>
                                <div><?= esc($toko['telepon_admin'] ?? ($toko['whatsapp_cs'] ?? '')) ?></div>
                            </div>
                        <div style="font-size:12px; color:#475569; text-align:right;">
                            <div style="font-weight:700; color:#111827; margin-bottom:4px;">Pembeli</div>
                            <div>${order.buyerName || 'Pembeli'}</div>
                            <div style="max-width:180px; margin-left:auto;">${order.shippingMethod ? 'Metode: ' + order.shippingMethod : ''}</div>
                            </div>
                        </div>
                        <table style="width:100%; border-collapse:collapse; margin-top:8px; font-size:13px; border:1.5px solid #cbd5e1;">
                            <thead>
                                <tr style="background:#f1f5f9;">
                                    <th style="padding:8px 10px; border:1.5px solid #cbd5e1; text-align:left; width:40px;">No</th>
                                    <th style="padding:8px 10px; border:1.5px solid #cbd5e1; text-align:left;">Produk</th>
                                    <th style="padding:8px 10px; border:1.5px solid #cbd5e1; text-align:right; width:120px;">Harga</th>
                                    <th style="padding:8px 10px; border:1.5px solid #cbd5e1; text-align:right; width:140px;">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>${itemsHtml}</tbody>
                        </table>
                        <div style="margin-top:12px; display:flex; justify-content:flex-end; border:1.5px solid #cbd5e1; border-radius:8px; padding:10px;">
                            <div style="min-width:240px;">
                                <div style="display:flex; justify-content:space-between; padding:4px 0;"><span>Subtotal</span><span>${formatIDR(order.totals?.harga || 0)}</span></div>
                                <div style="display:flex; justify-content:space-between; padding:4px 0;"><span>Ongkir (${order.shippingMethod || '-'})</span><span>${formatIDR(order.totals?.ongkir || 0)}</span></div>
                                <div style="display:flex; justify-content:space-between; padding:4px 0;"><span>Biaya</span><span>${formatIDR(order.totals?.biaya || 0)}</span></div>
                                <div style="display:flex; justify-content:space-between; padding:4px 0;"><span>Diskon</span><span>- ${formatIDR(order.totals?.diskon || 0)}</span></div>
                                <div style="display:flex; justify-content:space-between; padding:6px 0; font-weight:800; border-top:1.5px solid #cbd5e1; margin-top:6px;"><span>TOTAL</span><span>${formatIDR(order.totals?.grand || 0)}</span></div>
                            </div>
                        </div>
                    `;
                    modal.style.display = 'flex';
                });
            });
        }
    }

    // Manage Wishlist button (clear)
    const manageWishlistBtn = document.querySelector('.manage-wishlist-btn');
    if (manageWishlistBtn) {
        manageWishlistBtn.addEventListener('click', function(e) {
            e.preventDefault();
            if (confirm('Kosongkan wishlist?')) {
                localStorage.removeItem('wishlist_items');
                renderWishlist();
            }
        });
    }

    // Invoice buttons for database orders
    const invoiceButtons = document.querySelectorAll('.invoice-btn');
    invoiceButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const orderDataStr = btn.getAttribute('data-order-data');
            if (!orderDataStr) return;
            
            try {
                const orderData = JSON.parse(orderDataStr);
                const modal = ensureInvoiceModal();
                const host = modal.querySelector('#invoice-content');
                
                // Format order details items
                const itemsHtml = (orderData.details || []).map((it, idx) => {
                    const itemPrice = Number(it.harga || it.price || 0);
                    const itemQty = Number(it.jumlah || it.qty || 1);
                    const itemSubtotal = Number(it.subtotal || (itemPrice * itemQty));
                    const itemName = it.nama_produk || it.title || 'Produk';
                    
                    return `
                        <tr>
                            <td style="padding:8px 10px; border:1.5px solid #cbd5e1;">${idx + 1}</td>
                            <td style="padding:8px 10px; border:1.5px solid #cbd5e1;">
                                <div style="font-weight:700;">${itemName}</div>
                                <div style="font-size:12px; color:#475569;">Qty: ${itemQty}</div>
                            </td>
                            <td style="padding:8px 10px; border:1.5px solid #cbd5e1; text-align:right;">${formatIDR(itemPrice)}</td>
                            <td style="padding:8px 10px; border:1.5px solid #cbd5e1; text-align:right;">${formatIDR(itemSubtotal)}</td>
                        </tr>
                    `;
                }).join('');
                
                // Calculate totals
                const subtotal = orderData.total_harga || 0;
                const ongkir = orderData.ongkir || 0;
                const total = orderData.total_bayar || (subtotal + ongkir);
                
                // Get toko data from PHP (will be injected)
                const tokoNama = typeof window.tokoNama !== 'undefined' ? window.tokoNama : 'HIMAGICELL';
                const tokoAlamat = typeof window.tokoAlamat !== 'undefined' ? window.tokoAlamat : 'Alamat belum diisi';
                const tokoTelepon = typeof window.tokoTelepon !== 'undefined' ? window.tokoTelepon : '';
                const buyerName = typeof window.buyerName !== 'undefined' ? window.buyerName : 'Pembeli';
                
                // Format date
                const orderDate = orderData.tanggal_pesan ? new Date(orderData.tanggal_pesan).toLocaleDateString('id-ID', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                }) : '';
                
                host.innerHTML = `
                    <div style="text-align:center; margin-bottom:16px;">
                        <div style="font-size:12px; color:#475569;">${tokoNama}</div>
                        <div style="font-size:20px; font-weight:800; color:#0f172a; letter-spacing:0.5px;">INVOICE</div>
                        <div style="font-size:12px; color:#475569; margin-top:4px;">No: ${orderData.id}</div>
                        <div style="font-size:12px; color:#475569;">Tanggal: ${orderDate}</div>
                        <div style="font-size:12px; color:#16a34a; font-weight:700; margin-top:4px;">${orderData.status || 'Diproses'}</div>
                    </div>
                    <div style="display:flex; justify-content:space-between; gap:16px; margin-bottom:12px; align-items:flex-start;">
                        <div style="font-size:12px; color:#475569;">
                            <div style="font-weight:700; color:#111827; margin-bottom:4px;">Toko</div>
                            <div>${tokoNama}</div>
                            <div style="max-width:320px;">${tokoAlamat}</div>
                            <div>${tokoTelepon}</div>
                        </div>
                        <div style="font-size:12px; color:#475569; text-align:right;">
                            <div style="font-weight:700; color:#111827; margin-bottom:4px;">Pembeli</div>
                            <div>${buyerName}</div>
                            <div style="max-width:180px; margin-left:auto;">${orderData.metode_pengiriman ? 'Metode: ' + orderData.metode_pengiriman : ''}</div>
                        </div>
                    </div>
                    <table style="width:100%; border-collapse:collapse; margin-top:16px;">
                        <thead>
                            <tr style="background:#f1f5f9;">
                                <th style="padding:10px; text-align:left; border:1.5px solid #cbd5e1; font-weight:700;">No</th>
                                <th style="padding:10px; text-align:left; border:1.5px solid #cbd5e1; font-weight:700;">Produk</th>
                                <th style="padding:10px; text-align:right; border:1.5px solid #cbd5e1; font-weight:700;">Harga</th>
                                <th style="padding:10px; text-align:right; border:1.5px solid #cbd5e1; font-weight:700;">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${itemsHtml}
                        </tbody>
                    </table>
                    <div style="margin-top:12px; display:flex; justify-content:flex-end;">
                        <div style="min-width:240px;">
                            <div style="display:flex; justify-content:space-between; padding:4px 0;"><span>Subtotal</span><span>${formatIDR(subtotal)}</span></div>
                            <div style="display:flex; justify-content:space-between; padding:4px 0;"><span>Ongkir (${orderData.metode_pengiriman || '-'})</span><span>${formatIDR(ongkir)}</span></div>
                            <div style="display:flex; justify-content:space-between; padding:6px 0; font-weight:800; border-top:1px solid #e2e8f0; margin-top:6px;"><span>TOTAL</span><span>${formatIDR(total)}</span></div>
                        </div>
                    </div>
                `;
                modal.style.display = 'flex';
            } catch (err) {
                console.error('Error parsing order data:', err);
                alert('Terjadi kesalahan saat menampilkan invoice');
            }
        });
    });

    // Logout button
    const logoutBtn = document.querySelector('.logout-btn');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', function(e) {
            e.preventDefault();
            if (confirm('Apakah Anda yakin ingin logout?')) {
                window.location.href = '/logout';
            }
        });
    }

    // Settings items click handlers
    const settingItems = document.querySelectorAll('.setting-item');
    settingItems.forEach(item => {
        item.addEventListener('click', function(e) {
            // Don't trigger if clicking on toggle switch
            if (!e.target.closest('.toggle-switch')) {
                console.log('Setting item clicked');
                // Add your settings navigation functionality here
            }
        });
    });

    // Address handling
    const addrName = document.getElementById('addrName');
    const addrPhoneForAddress = document.getElementById('addrPhone'); // For address section
    const addrFull = document.getElementById('addrFull');
    const addrLat = document.getElementById('addrLat');
    const addrLng = document.getElementById('addrLng');
    const addrMap = document.getElementById('addrMap');
    const saveAddressBtn = document.getElementById('saveAddressBtn');
    const openMapBtn = document.getElementById('openMapBtn');

    function loadAddress() {
        // Address data is now loaded from database via PHP, so we don't need to load from localStorage
        // But we keep this function for backward compatibility and for latitude/longitude
        try {
            const raw = localStorage.getItem('user_address');
            const data = JSON.parse(raw || '{}');
            // Only load lat/lng from localStorage if not already set from database
            if (addrLat && !addrLat.value && data.lat) {
                addrLat.value = data.lat || '';
            }
            if (addrLng && !addrLng.value && data.lng) {
                addrLng.value = data.lng || '';
            }
            if (addrLat || addrLng) {
                updateMap();
            }
        } catch (e) {}
    }
    function updateMap() {
        if (!addrMap) return;
        const q = encodeURIComponent((addrLat?.value || '') + ',' + (addrLng?.value || '') + ' ' + (addrFull?.value || 'Jakarta'));
        addrMap.src = `https://www.google.com/maps/embed/v1/place?key=AIzaSyC55F_qKKV8WREdk8Wv-o6HMvfFvEpst48&q=${q}`;
    }
    saveAddressBtn?.addEventListener('click', (e) => {
        e.preventDefault();
        
        // Get phone from profile if address phone is empty
        const phoneInputInProfile = document.querySelector('input[data-field="phone"]');
        const addrPhoneElement = document.getElementById('addrPhone');
        let phoneToSave = addrPhoneElement?.value || '';
        if (!phoneToSave && phoneInputInProfile && phoneInputInProfile.value) {
            phoneToSave = phoneInputInProfile.value;
        }
        
        // Validate required fields
        if (!addrName?.value || !addrName.value.trim()) {
            alert('Mohon isi nama penerima terlebih dahulu');
            return;
        }
        
        if (!addrFull?.value || !addrFull.value.trim()) {
            alert('Mohon isi alamat lengkap terlebih dahulu');
            return;
        }
        
        // Collect address data
        const formData = new FormData();
        formData.append('nama_penerima', addrName.value.trim());
        formData.append('no_hp', phoneToSave.trim());
        formData.append('alamat_lengkap', addrFull.value.trim());
        formData.append('kecamatan', ''); // Can be added later if needed
        formData.append('kabupaten', ''); // Can be added later if needed
        formData.append('provinsi', ''); // Can be added later if needed
        formData.append('kode_pos', ''); // Can be added later if needed
        formData.append('catatan', ''); // Can be added later if needed
        
        // Send to server
        const baseUrl = (typeof window.baseUrl !== 'undefined' ? window.baseUrl : '');
        fetch(baseUrl + 'profile/save', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                alert(data.message || 'Alamat berhasil disimpan');
                // Also save to localStorage as backup
                const localData = {
                    name: addrName.value || '',
                    phone: phoneToSave || '',
                    full: addrFull.value || '',
                    lat: addrLat?.value || '',
                    lng: addrLng?.value || ''
                };
                localStorage.setItem('user_address', JSON.stringify(localData));
                updateMap();
                // Reload page to show updated data
                window.location.reload();
            } else {
                alert(data.message || 'Gagal menyimpan alamat');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menyimpan alamat: ' + error.message);
        });
    });
    openMapBtn?.addEventListener('click', (e) => {
        e.preventDefault();
        const q = encodeURIComponent((addrFull?.value || '') || 'Jakarta');
        window.open(`https://www.google.com/maps/search/?api=1&query=${q}`, '_blank');
    });
    addrLat?.addEventListener('change', updateMap);
    addrLng?.addEventListener('change', updateMap);
    addrFull?.addEventListener('change', updateMap);
    loadAddress();

    // Google connection link
    const googleLink = document.querySelector('.google-link');
    if (googleLink) {
        googleLink.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Google connection clicked');
            // Add your Google connection functionality here
        });
    }

    // Header icon buttons
    const notificationBtn = document.querySelector('.notification-btn');
    if (notificationBtn) {
        notificationBtn.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Notifications clicked');
            // Add your notifications functionality here
        });
    }

    const cartBtn = document.querySelector('.cart-btn');
    if (cartBtn) {
        cartBtn.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Cart clicked');
            // Add your cart functionality here
        });
    }

    // Handle window resize for wishlist - always keep scrollable
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            const wishlistGrid = document.querySelector('.wishlist-grid');
            if (wishlistGrid) {
                wishlistGrid.style.overflowX = 'auto';
                wishlistGrid.style.overflowY = 'hidden';
                wishlistGrid.style.flexWrap = 'nowrap';
            }
        }, 250);
    });
});

