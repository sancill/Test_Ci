<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use App\Models\KategoriModel;
use App\Models\MenuModel;
use App\Models\PromoModel;
use App\Models\TokoModel;
use App\Models\ProdukVarianModel;
use App\Models\UserModel;
use App\Models\AlamatUserModel;
use App\Models\PesananModel;
use App\Models\DetailPesananModel;

class Home extends BaseController
{
    protected $produkModel;
    protected $kategoriModel;
    protected $menuModel;
    protected $promoModel;
    protected $tokoModel;
    protected $userModel;
    protected $alamatUserModel;
    protected $pesananModel;
    protected $detailPesananModel;

    public function __construct()
    {
        $this->produkModel = new ProdukModel();
        $this->kategoriModel = new KategoriModel();
        $this->menuModel = new MenuModel();
        $this->promoModel = new PromoModel();
        $this->tokoModel = new TokoModel();
        $this->userModel = new UserModel();
        $this->alamatUserModel = new AlamatUserModel();
        $this->pesananModel = new PesananModel();
        $this->detailPesananModel = new DetailPesananModel();
    }

    /**
     * Ambil elemen unik berdasarkan kunci ID.
     */
    private function uniqueById(array $items, string $key): array
    {
        $seen = [];
        $result = [];
        foreach ($items as $item) {
            if (!isset($item[$key])) {
                continue;
            }
            if (isset($seen[$item[$key]])) {
                continue;
            }
            $seen[$item[$key]] = true;
            $result[] = $item;
        }
        return $result;
    }

    public function index(): string
    {
        $toko = $this->tokoModel->getToko();
        $kategori = $this->uniqueById($this->kategoriModel->getAllKategori(), 'id_kategori');
        // Normalisasi path icon kategori supaya mudah dipakai di view
        foreach ($kategori as &$kat) {
            if (!empty($kat['icon_kategori']) && !str_starts_with($kat['icon_kategori'], 'uploads/')) {
                $kat['icon_kategori'] = 'uploads/kategori/' . basename($kat['icon_kategori']);
            }
        }
        $menus = $this->menuModel->getMenuAktif();
        $menusByKategori = [];
        foreach ($menus as $menu) {
            $menusByKategori[$menu['id_kategori']][] = $menu;
        }

        // Ambil produk aktif (status selain draft) dan batasi 8 item untuk homepage
        $produk = array_filter($this->produkModel->getProduk($toko['id_toko'] ?? null), function ($p) {
            return ($p['status_produk'] ?? 'aktif') !== 'draft';
        });
        $produk = array_slice(array_values($produk), 0, 8);

        // Promo aktif (jika ada)
        $promo = $this->promoModel->getPromoAktif($toko['id_toko'] ?? null);

        $data = [
            'toko' => $toko,
            'kategori' => $kategori,
            'menusByKategori' => $menusByKategori,
            'produk' => $produk,
            'promo' => $promo,
        ];

        echo view('layout/header');
        echo view('pages_user/Home', $data);
        echo view('layout/footer');
        return '';
    }

    public function produk($id = null): string
    {
        $toko = $this->tokoModel->getToko();
        $produkId = $id ?? $this->request->getGet('id');
        $produk = null;

        if ($produkId) {
            $produk = $this->produkModel->getProdukById($produkId);
        }

        if (!$produk) {
            // fallback: gunakan produk pertama agar halaman tetap tampil
            $produkList = $this->produkModel->getProduk($toko['id_toko'] ?? null);
            $produk = !empty($produkList) ? $produkList[0] : null;
        }

        $fotos = [];
        if ($produk && !empty($produk['gambar_produk'])) {
            $decoded = json_decode($produk['gambar_produk'], true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $fotos = array_map(function ($path) {
                    return ['foto_produk' => $path];
                }, $decoded);
            } else {
                $fotos = [['foto_produk' => $produk['gambar_produk']]];
            }
        }

        $varianList = [];
        if ($produk && !empty($produk['id_produk'])) {
            $varianModel = new ProdukVarianModel();
            $varianList = $varianModel->getVarianByProduk($produk['id_produk']) ?? [];
            foreach ($varianList as &$varian) {
                if (!empty($varian['gambar_varian'])) {
                    $decoded = json_decode($varian['gambar_varian'], true);
                    $varian['gambar_varian'] = (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) ? $decoded : [];
                } else {
                    $varian['gambar_varian'] = [];
                }
            }
        }

        $data = [
            'produk' => $produk,
            'fotos' => $fotos,
            'toko' => $toko,
            'varianList' => $varianList,
        ];

        echo view('layout/header');
        echo view('pages_user/produk', $data);
        echo view('layout/footer');
        return '';
    }
    
    public function chatPenjual(): string
    {
        $toko = $this->tokoModel->getToko();
        echo view('layout/header');
        echo view('pages_user/chat_penjual', ['toko' => $toko]);
        echo view('layout/footer');
        return '';
    }   

    public function cart(): string
    {
        $toko = $this->tokoModel->getToko();
        $produkListAll = array_filter($this->produkModel->getProduk($toko['id_toko'] ?? null), function ($p) {
            return ($p['status_produk'] ?? 'aktif') !== 'draft';
        });

        // Session cart items: assoc id => qty
        $session = session();
        $cartSession = $session->get('cart_items') ?? [];

        // Handle add via id/ids with qty
        $ids = [];
        $idParam = $this->request->getGet('id');
        $idsParam = $this->request->getGet('ids');
        $qtyParam = $this->request->getGet('qty');
        if ($idParam) {
            $ids[] = (int) $idParam;
        }
        if ($idsParam) {
            $split = array_map('trim', explode(',', $idsParam));
            foreach ($split as $s) {
                if (is_numeric($s)) {
                    $ids[] = (int) $s;
                }
            }
        }
        $ids = array_unique(array_filter($ids));

        // Handle remove single item ?remove=ID
        $removeId = $this->request->getGet('remove');
        if ($removeId && is_numeric($removeId)) {
            unset($cartSession[(int) $removeId]);
            $ids = []; // abaikan penambahan pada request yang sama
        }

        // Handle adjust quantity ?adjust=ID&delta=1/-1
        $adjustId = $this->request->getGet('adjust');
        $delta = $this->request->getGet('delta');
        if ($adjustId && is_numeric($adjustId) && is_numeric($delta)) {
            $pid = (int) $adjustId;
            $currentQty = $cartSession[$pid] ?? 1;
            $newQty = $currentQty + (int) $delta;
            if ($newQty < 1) {
                unset($cartSession[$pid]);
            } else {
                $cartSession[$pid] = min(99, $newQty);
            }
            $ids = []; // tidak menambah ID baru
        }

        // Merge new ids into session (set qty)
        if (!empty($ids)) {
            $qtyVal = (is_numeric($qtyParam) && (int)$qtyParam > 0) ? min(99, (int)$qtyParam) : 1;
            foreach ($ids as $pid) {
                $cartSession[$pid] = $qtyVal;
            }
        }

        // Persist session
        $session->set('cart_items', $cartSession);

        // Build cart items from session IDs
        $produkById = [];
        foreach ($produkListAll as $p) {
            $produkById[(int) $p['id_produk']] = $p;
        }

        $cartItems = [];
        foreach ($cartSession as $pid => $qty) {
            if (!isset($produkById[$pid])) {
                continue;
            }
            $produk = $produkById[$pid];
            $harga = ($produk['harga_setelah_diskon'] ?? 0) > 0 ? $produk['harga_setelah_diskon'] : $produk['harga_awal'];
            $qtyFinal = max(1, (int)$qty);
            $cartItems[] = [
                'produk' => $produk,
                'quantity' => $qtyFinal,
                'harga' => $harga,
                'subtotal' => $harga * $qtyFinal,
            ];
        }

        $totalHarga = array_sum(array_column($cartItems, 'subtotal'));

        $data = [
            'cartItems' => $cartItems,
            'totalHarga' => $totalHarga,
            'toko' => $toko,
        ];

        echo view('layout/header');
        echo view('pages_user/cart', $data);
        echo view('layout/footer');
        return '';
    }

    public function pesan()
    {
        $session = session();
        $userSession = $session->get('user');
        
        // Validasi: User harus login
        if (!$userSession || empty($userSession['id'])) {
            return redirect()->to(base_url('login'))->with('error', 'Silakan login terlebih dahulu untuk membuat pesanan');
        }
        
        $userId = $userSession['id'];
        
        try {
            // Get user data from database
            $user = $this->userModel->find($userId);
            if (!$user) {
                return redirect()->to(base_url('login'))->with('error', 'Data user tidak ditemukan');
            }
            
            // Validasi: User harus memiliki no_telepon
            if (empty($user['no_telepon']) || trim($user['no_telepon']) === '') {
                return redirect()->to(base_url('profile') . '?need_phone=1')->with('error', 'Silakan lengkapi nomor telepon Anda terlebih dahulu untuk membuat pesanan');
            }
        } catch (\Exception $e) {
            // Jika error saat validasi user, log dan redirect ke login
            log_message('error', 'Error in pesan user validation: ' . $e->getMessage());
            log_message('error', 'Stack trace: ' . $e->getTraceAsString());
            return redirect()->to(base_url('login'))->with('error', 'Terjadi kesalahan saat memvalidasi data user');
        }
        
        // Validasi: User harus memiliki alamat lengkap
        try {
            if (!$this->alamatUserModel->hasCompleteAddress($userId)) {
                return redirect()->to(base_url('profile') . '?need_address=1')->with('error', 'Silakan lengkapi alamat Anda terlebih dahulu untuk membuat pesanan');
            }
        } catch (\Exception $e) {
            log_message('error', 'Error in pesan address validation: ' . $e->getMessage());
            log_message('error', 'Stack trace: ' . $e->getTraceAsString());
            // Jika error saat validasi alamat, anggap alamat belum lengkap
            return redirect()->to(base_url('profile') . '?need_address=1')->with('error', 'Silakan lengkapi alamat Anda terlebih dahulu untuk membuat pesanan');
        }
        
        try {
            $toko = $this->tokoModel->getToko() ?? [];
        } catch (\Exception $e) {
            log_message('error', 'Error getting toko: ' . $e->getMessage());
            $toko = [];
        }
        
        try {
            $produkListAll = $this->produkModel->getProduk($toko['id_toko'] ?? null);
        } catch (\Exception $e) {
            log_message('error', 'Error getting produk list: ' . $e->getMessage());
            $produkListAll = [];
        }

        // Sumber prioritas: query id/ids (+qty) -> cart session -> fallback produk pertama
        $cartItemsSession = $session->get('cart_items') ?? [];

        // Sinkronisasi kuantitas dari aksi remove/adjust
        $removeId = $this->request->getGet('remove');
        if ($removeId && is_numeric($removeId)) {
            unset($cartItemsSession[(int) $removeId]);
        }
        $adjustId = $this->request->getGet('adjust');
        $delta = $this->request->getGet('delta');
        if ($adjustId && is_numeric($adjustId) && is_numeric($delta)) {
            $pidAdj = (int) $adjustId;
            $curr = $cartItemsSession[$pidAdj] ?? 1;
            $newQty = $curr + (int) $delta;
            if ($newQty < 1) {
                unset($cartItemsSession[$pidAdj]);
            } else {
                $cartItemsSession[$pidAdj] = min(99, $newQty);
            }
        }

        $ids = [];
        $idParam = $this->request->getGet('id');
        $idsParam = $this->request->getGet('ids');
        $qtyParam = $this->request->getGet('qty');
        $qtyVal = (is_numeric($qtyParam) && (int)$qtyParam > 0) ? min(99, (int)$qtyParam) : 1;
        if ($idParam) {
            $ids[] = (int) $idParam;
        }
        if ($idsParam) {
            $split = array_map('trim', explode(',', $idsParam));
            foreach ($split as $s) {
                if (is_numeric($s)) {
                    $ids[] = (int) $s;
                }
            }
        }
        $ids = array_unique(array_filter($ids));

        $sourceItems = [];
        if (!empty($ids)) {
            foreach ($ids as $pid) {
                $sourceItems[$pid] = $qtyVal;
                // Persist juga ke sesi agar konsisten dengan cart
                $cartItemsSession[$pid] = $qtyVal;
            }
        } elseif (!empty($cartItemsSession)) {
            $sourceItems = $cartItemsSession;
        }

        // Simpan kembali sesi setelah perubahan
        $session->set('cart_items', $cartItemsSession);

        // Map produk by ID untuk lookup cepat
        $produkById = [];
        foreach ($produkListAll as $p) {
            $produkById[(int) $p['id_produk']] = $p;
        }

        $items = [];
        foreach ($sourceItems as $pid => $qty) {
            if (!isset($produkById[$pid])) {
                continue;
            }
            $produk = $produkById[$pid];
            $harga = ($produk['harga_setelah_diskon'] ?? 0) > 0 ? $produk['harga_setelah_diskon'] : $produk['harga_awal'];
            $q = max(1, (int)$qty);
            $items[] = [
                'id_produk' => $produk['id_produk'],
                'nama_produk' => $produk['nama_produk'],
                'gambar' => $this->firstImage($produk),
                'qty' => $q,
                'harga' => $harga,
                'subtotal' => $harga * $q,
            ];
        }

        // Pastikan items selalu array, walaupun kosong
        // View sudah memiliki fallback untuk menampilkan pesan yang tepat jika items kosong

        $total = !empty($items) ? array_sum(array_column($items, 'subtotal')) : 0;

        // Get user address for shipping
        $userAddress = null;
        try {
            $userAddress = $this->alamatUserModel->getFirstAlamatByUserId($userId);
        } catch (\Exception $e) {
            log_message('error', 'Error getting user address: ' . $e->getMessage());
        }

        $data = [
            'toko' => $toko,
            'items' => $items,
            'total' => $total,
            'userId' => $userId,
            'user' => $user ?? null,
            'userAddress' => $userAddress,
        ];

        echo view('layout/header');
        echo view('pages_user/pesan', $data);
        echo view('layout/footer');
        return '';
    }

    public function profile(): string
    {
        $session = session();
        $userSession = $session->get('user');
        $toko = $this->tokoModel->getToko() ?? [];
        
        // Get user data from database if available
        $user = null;
        if ($userSession && !empty($userSession['id'])) {
            $user = $this->userModel->find($userSession['id']);
        }
        
        // Get user address from database
        $userAddress = null;
        if ($user && !empty($user['id_user'])) {
            $userAddress = $this->alamatUserModel->getFirstAlamatByUserId($user['id_user']);
        }
        
        // Use session user data if available, otherwise fallback to toko data
        $profile = [
            'nama' => $userSession['nama'] ?? ($user['nama_user'] ?? $toko['nama_admin'] ?? 'User'),
            'email' => $userSession['email'] ?? ($user['email'] ?? $toko['email_admin'] ?? ($toko['email_cs'] ?? 'user@example.com')),
            'telepon' => $userSession['no_telepon'] ?? ($user['no_telepon'] ?? $toko['telepon_admin'] ?? ($toko['whatsapp_cs'] ?? '')),
            'phone' => $userSession['no_telepon'] ?? ($user['no_telepon'] ?? ''),
            'status' => 'Mahasiswa Aktif',
            'program' => 'Sistem Informasi',
            'avatar' => !empty($userSession['foto_user']) ? base_url($userSession['foto_user']) : (!empty($toko['logo_toko']) ? base_url($toko['logo_toko']) : base_url('assets/img/admin-avatar.png')),
        ];
        
        // Check if redirected from pesan page
        $needPhone = $this->request->getGet('need_phone');
        $needAddress = $this->request->getGet('need_address');
        $errorMessage = $session->getFlashdata('error');

        // Get user's orders from database
        $userOrders = [];
        if ($userSession && !empty($userSession['id'])) {
            try {
                $userOrders = $this->pesananModel->getPesananByUserId($userSession['id'], 5);
                
                // Format orders untuk ditampilkan di view
                if (!empty($userOrders)) {
                    foreach ($userOrders as &$order) {
                        try {
                            // Get order details (products) with product info
                            $orderDetails = $this->detailPesananModel->getDetailByPesanan($order['id_pesan']);
                            $order['details'] = $orderDetails;
                        } catch (\Exception $e) {
                            log_message('error', 'Error getting order details: ' . $e->getMessage());
                            $order['details'] = [];
                        }
                    }
                }
            } catch (\Exception $e) {
                log_message('error', 'Error getting user orders: ' . $e->getMessage());
                $userOrders = [];
            }
        }

        $successMessage = $session->getFlashdata('success');
        
        echo view('layout/header');
        echo view('pages_user/profile', [
            'profile' => $profile,
            'toko' => $toko,
            'needPhone' => $needPhone,
            'needAddress' => $needAddress,
            'errorMessage' => $errorMessage,
            'successMessage' => $successMessage,
            'userOrders' => $userOrders,
            'userId' => $userSession['id'] ?? null,
            'userAddress' => $userAddress,
        ]);
        echo view('layout/footer');
        return '';
    }

    public function updateProfile()
    {
        $session = session();
        $userSession = $session->get('user');
        
        // Validasi: User harus login
        if (!$userSession || empty($userSession['id'])) {
            return redirect()->to(base_url('login'))->with('error', 'Silakan login terlebih dahulu');
        }
        
        $userId = $userSession['id'];
        $success = false;
        $message = '';
        
        try {
            // Update no_telepon di table user
            $noTelepon = $this->request->getPost('phone');
            if ($noTelepon !== null) {
                $userData = [
                    'no_telepon' => trim($noTelepon)
                ];
                
                if ($this->userModel->update($userId, $userData)) {
                    // Update session juga
                    $userSession['no_telepon'] = trim($noTelepon);
                    $session->set('user', $userSession);
                    $success = true;
                    $message = 'Nomor telepon berhasil diperbarui';
                } else {
                    $message = 'Gagal memperbarui nomor telepon: ' . implode(', ', $this->userModel->errors());
                }
            }
            
            // Update atau create alamat di table alamat_user (jika ada data alamat yang dikirim)
            // Check if address data is being sent (if any address field is present in POST)
            $hasAddressData = $this->request->getPost('nama_penerima') !== null 
                || $this->request->getPost('alamat_lengkap') !== null
                || $this->request->getPost('no_hp') !== null;
            
            if ($hasAddressData) {
                // Jika phone di profil diupdate, gunakan untuk alamat juga jika no_hp tidak dikirim
                $noHpAlamat = $this->request->getPost('no_hp');
                if (empty($noHpAlamat) && !empty($noTelepon)) {
                    $noHpAlamat = $noTelepon;
                }
                
                $alamatData = [
                    'id_user' => $userId,
                    'nama_penerima' => trim($this->request->getPost('nama_penerima') ?? ''),
                    'no_hp' => trim($noHpAlamat ?? ''),
                    'alamat_lengkap' => trim($this->request->getPost('alamat_lengkap') ?? ''),
                    'kecamatan' => trim($this->request->getPost('kecamatan') ?? ''),
                    'kabupaten' => trim($this->request->getPost('kabupaten') ?? ''),
                    'provinsi' => trim($this->request->getPost('provinsi') ?? ''),
                    'kode_pos' => trim($this->request->getPost('kode_pos') ?? ''),
                    'catatan' => trim($this->request->getPost('catatan') ?? ''),
                ];
                
                // Remove empty values to avoid overwriting with empty strings
                $alamatData = array_filter($alamatData, function($value, $key) {
                    // Keep id_user even if empty, filter out empty strings for other fields
                    return $key === 'id_user' || $value !== '';
                }, ARRAY_FILTER_USE_BOTH);
                
                // Check if user already has an address
                $existingAlamat = $this->alamatUserModel->getFirstAlamatByUserId($userId);
                
                if ($existingAlamat) {
                    // Update existing address - merge with existing data
                    $updateData = array_merge($existingAlamat, $alamatData);
                    // Remove id_alamat from update data as it's the primary key
                    unset($updateData['id_alamat']);
                    
                    if ($this->alamatUserModel->update($existingAlamat['id_alamat'], $updateData)) {
                        $success = true;
                        $message = $message ? $message . ' dan alamat berhasil diperbarui' : 'Alamat berhasil diperbarui';
                    } else {
                        $message = $message ? $message : 'Gagal memperbarui alamat: ' . implode(', ', $this->alamatUserModel->errors());
                    }
                } else {
                    // Create new address
                    if ($this->alamatUserModel->insert($alamatData)) {
                        $success = true;
                        $message = $message ? $message . ' dan alamat berhasil disimpan' : 'Alamat berhasil disimpan';
                    } else {
                        $message = $message ? $message : 'Gagal menyimpan alamat: ' . implode(', ', $this->alamatUserModel->errors());
                    }
                }
            }
            
        } catch (\Exception $e) {
            log_message('error', 'Error updating profile: ' . $e->getMessage());
            log_message('error', 'Stack trace: ' . $e->getTraceAsString());
            $message = 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage();
        }
        
        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => $success,
                'message' => $message
            ]);
        } else {
            if ($success) {
                return redirect()->to(base_url('profile'))->with('success', $message);
            } else {
                return redirect()->to(base_url('profile'))->with('error', $message);
            }
        }
    }

    public function createOrder()
    {
        $session = session();
        $userSession = $session->get('user');
        
        // Validasi: User harus login
        if (!$userSession || empty($userSession['id'])) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON(['success' => false, 'message' => 'Silakan login terlebih dahulu']);
            }
            return redirect()->to(base_url('login'))->with('error', 'Silakan login terlebih dahulu');
        }
        
        $userId = $userSession['id'];
        
        // Prevent double submission: check if there's a recent order in the last 5 seconds with same items
        $recentOrder = $session->get('last_order_time');
        if ($recentOrder && (time() - $recentOrder) < 5) {
            // Too soon after last order, likely duplicate request
            return $this->response->setJSON(['success' => false, 'message' => 'Permintaan terlalu cepat. Pesanan Anda sedang diproses, mohon tunggu sebentar.']);
        }
        
        try {
            // Get user address
            $alamat = $this->alamatUserModel->getFirstAlamatByUserId($userId);
            if (!$alamat) {
                if ($this->request->isAJAX()) {
                    return $this->response->setJSON(['success' => false, 'message' => 'Silakan lengkapi alamat terlebih dahulu']);
                }
                return redirect()->to(base_url('profile') . '?need_address=1')->with('error', 'Silakan lengkapi alamat terlebih dahulu');
            }
            
            // Get order data from JSON body (since it's sent as application/json)
            $jsonData = $this->request->getJSON(true);
            
            // Fallback to POST if JSON is not available
            if (!$jsonData) {
                $jsonData = [
                    'items' => $this->request->getPost('items'),
                    'shipping_method' => $this->request->getPost('shipping_method'),
                    'payment_method' => $this->request->getPost('payment_method'),
                    'totals' => $this->request->getPost('totals')
                ];
            }
            
            $items = $jsonData['items'] ?? null;
            $shippingMethod = $jsonData['shipping_method'] ?? '';
            $paymentMethod = $jsonData['payment_method'] ?? '';
            $totals = $jsonData['totals'] ?? [];
            
            // Validate items
            if (empty($items) || !is_array($items)) {
                log_message('error', 'Invalid order data - items: ' . print_r($items, true));
                return $this->response->setJSON(['success' => false, 'message' => 'Data pesanan tidak valid: items kosong atau tidak valid']);
            }
            
            // Validate that items have required fields
            foreach ($items as $idx => $item) {
                if (empty($item['pid']) || !isset($item['price']) || !isset($item['qty']) || $item['qty'] <= 0) {
                    log_message('error', 'Invalid item at index ' . $idx . ': ' . print_r($item, true));
                    return $this->response->setJSON(['success' => false, 'message' => 'Data pesanan tidak valid: item ' . ($idx + 1) . ' tidak lengkap (pid, price, atau qty tidak valid)']);
                }
            }
            
            // Calculate totals
            $totalHarga = 0;
            foreach ($items as $item) {
                $totalHarga += (float)($item['price'] ?? 0) * (int)($item['qty'] ?? 1);
            }
            
            $ongkir = $totals['ongkir'] ?? 0;
            $biaya = $totals['biaya'] ?? 0;
            $diskon = $totals['diskon'] ?? 0;
            $totalBayar = ($totals['grand'] ?? 0) > 0 ? $totals['grand'] : ($totalHarga + $ongkir + $biaya - $diskon);
            
            // Additional check: prevent duplicate order within last 10 seconds with same total
            try {
                $recentOrders = $this->pesananModel->where('id_user', $userId)
                    ->where('total_bayar', $totalBayar)
                    ->where('tanggal_pesan >=', date('Y-m-d H:i:s', time() - 10))
                    ->findAll();
                
                if (!empty($recentOrders)) {
                    // Found recent order with same total, likely duplicate
                    return $this->response->setJSON([
                        'success' => false, 
                        'message' => 'Pesanan serupa baru saja dibuat. Silakan cek riwayat pembelian Anda.',
                        'duplicate_order' => true
                    ]);
                }
            } catch (\Exception $e) {
                // If check fails, continue with order creation
                log_message('error', 'Error checking duplicate order: ' . $e->getMessage());
            }
            
            // Generate order number
            $noPesanan = $this->pesananModel->generateNoPesanan();
            
            // Prepare order data
            $pesananData = [
                'no_pesanan' => $noPesanan,
                'id_user' => $userId,
                'id_alamat' => $alamat['id_alamat'],
                'tanggal_pesan' => date('Y-m-d H:i:s'),
                'metode_pengiriman' => $shippingMethod ?? 'Kurir Kampus',
                'ongkir' => $ongkir,
                'total_harga' => $totalHarga,
                'total_bayar' => $totalBayar,
                'status_pesanan' => 'Diproses'
            ];
            
            // Save order to database
            if (!$this->pesananModel->insert($pesananData)) {
                $errors = $this->pesananModel->errors();
                log_message('error', 'Error saving order: ' . implode(', ', $errors));
                return $this->response->setJSON(['success' => false, 'message' => 'Gagal menyimpan pesanan: ' . implode(', ', $errors)]);
            }
            
            $pesananId = $this->pesananModel->getInsertID();
            
            // Save order details
            foreach ($items as $item) {
                $detailData = [
                    'id_pesan' => $pesananId,
                    'id_produk' => (int)($item['pid'] ?? 0),
                    'jumlah' => (int)($item['qty'] ?? 1),
                    'harga' => (int)($item['price'] ?? 0),
                    'subtotal' => (int)(($item['price'] ?? 0) * ($item['qty'] ?? 1))
                ];
                
                // Validate detail data
                if ($detailData['id_produk'] <= 0 || $detailData['jumlah'] <= 0 || $detailData['harga'] <= 0) {
                    log_message('error', 'Invalid detail data: ' . print_r($detailData, true));
                    continue; // Skip invalid items
                }
                
                if (!$this->detailPesananModel->insert($detailData)) {
                    log_message('error', 'Error saving order detail: ' . implode(', ', $this->detailPesananModel->errors()));
                }
            }
            
            // Clear cart session after successful order
            $session->remove('cart_items');
            
            // Set last order time to prevent double submission
            $session->set('last_order_time', time());
            
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Pesanan berhasil dibuat',
                'order_id' => $pesananId,
                'no_pesanan' => $noPesanan
            ]);
            
        } catch (\Exception $e) {
            log_message('error', 'Error creating order: ' . $e->getMessage());
            log_message('error', 'Stack trace: ' . $e->getTraceAsString());
            return $this->response->setJSON(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function search(): string
    {
        $toko = $this->tokoModel->getToko();
        $keyword = $this->request->getGet('q') ?? $this->request->getGet('keyword') ?? '';
        $keyword = trim($keyword);

        // Get all categories for filter
        $kategoriList = $this->uniqueById($this->kategoriModel->getAllKategori(), 'id_kategori');
        foreach ($kategoriList as &$kat) {
            if (!empty($kat['icon_kategori']) && !str_starts_with($kat['icon_kategori'], 'uploads/')) {
                $kat['icon_kategori'] = 'uploads/kategori/' . basename($kat['icon_kategori']);
            }
        }

        // Search products
        $produkList = [];
        if (!empty($keyword)) {
            $produkList = $this->produkModel->searchProduk($keyword, $toko['id_toko'] ?? null);
        } else {
            // If no keyword, show all active products
            $produkList = array_filter($this->produkModel->getProduk($toko['id_toko'] ?? null), function ($p) {
                return ($p['status_produk'] ?? 'aktif') !== 'draft';
            });
        }

        $data = [
            'toko' => $toko,
            'kategoriList' => $kategoriList,
            'produkList' => array_values($produkList),
            'keyword' => $keyword,
            'selectedKategori' => null,
            'menuList' => [],
            'selectedMenu' => null,
        ];

        echo view('layout/header');
        echo view('pages_user/kategori', $data);
        echo view('layout/footer');
        return '';
    }

    public function kategori(): string
    {
        $toko = $this->tokoModel->getToko();
        $kategoriParam = $this->request->getGet('kategori');
        $menuParam = $this->request->getGet('menu');

        $kategoriList = $this->uniqueById($this->kategoriModel->getAllKategori(), 'id_kategori');
        foreach ($kategoriList as &$kat) {
            if (!empty($kat['icon_kategori']) && !str_starts_with($kat['icon_kategori'], 'uploads/')) {
                $kat['icon_kategori'] = 'uploads/kategori/' . basename($kat['icon_kategori']);
            }
        }

        $selectedKategori = null;
        // Prioritas: ID numerik langsung dari query
        if ($kategoriParam && is_numeric($kategoriParam)) {
            $selectedKategori = $this->kategoriModel->find((int) $kategoriParam);
        }
        // Jika belum ketemu, cocokkan dengan nama/slug di daftar yang sudah di-load
        if (!$selectedKategori && $kategoriParam) {
            foreach ($kategoriList as $kat) {
                if ((string)$kat['id_kategori'] === (string)$kategoriParam || strcasecmp($kat['nama_kategori'], $kategoriParam) === 0) {
                    $selectedKategori = $kat;
                    break;
                }
            }
        }
        if (!$selectedKategori && !empty($kategoriList)) {
            $selectedKategori = $kategoriList[0];
        }

        $menuList = $selectedKategori ? $this->menuModel->getMenuAktif($selectedKategori['id_kategori']) : [];
        $selectedMenu = null;
        if ($menuParam) {
            foreach ($menuList as $menu) {
                if ((string)$menu['id_menu'] === (string)$menuParam || strcasecmp($menu['nama_menu'], $menuParam) === 0) {
                    $selectedMenu = $menu;
                    break;
                }
            }
        }
        if (!$selectedMenu && !empty($menuList)) {
            $selectedMenu = $menuList[0];
        }

        $produkList = $this->produkModel->getProduk($toko['id_toko'] ?? null);
        $produkList = array_filter($produkList, function ($p) use ($selectedKategori, $selectedMenu) {
            $kategoriMatch = $selectedKategori ? $p['id_kategori'] == $selectedKategori['id_kategori'] : true;
            $menuMatch = $selectedMenu ? ($p['id_menu'] == $selectedMenu['id_menu']) : true;
            return $kategoriMatch && $menuMatch && ($p['status_produk'] ?? 'aktif') !== 'draft';
        });

        $data = [
            'toko' => $toko,
            'kategoriList' => $kategoriList,
            'selectedKategori' => $selectedKategori,
            'menuList' => $menuList,
            'selectedMenu' => $selectedMenu,
            'produkList' => array_values($produkList),
            'keyword' => '',
        ];

        echo view('layout/header');
        echo view('pages_user/kategori', $data);
        echo view('layout/footer');
        return '';
    }

    private function firstImage(?array $produk): ?string
    {
        if (!$produk || empty($produk['gambar_produk'])) {
            return null;
        }

        $decoded = json_decode($produk['gambar_produk'], true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded) && !empty($decoded[0])) {
            return $decoded[0];
        }

        return $produk['gambar_produk'];
    }
}