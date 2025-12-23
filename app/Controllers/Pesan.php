<?php

namespace App\Controllers;

use App\Models\KeranjangModel;
use App\Models\AlamatUserModel;
use App\Models\ProdukModel;
use App\Models\TokoModel;
use App\Models\VoucherModel;
use App\Models\PromoModel;
use App\Models\PesananModel;
use App\Models\DetailPesananModel;

class Pesan extends BaseController
{
    protected $keranjangModel;
    protected $alamatModel;
    protected $produkModel;
    protected $tokoModel;
    protected $voucherModel;
    protected $promoModel;
    protected $pesananModel;
    protected $detailPesananModel;
    protected $db;

    public function __construct()
    {
        $this->keranjangModel = new KeranjangModel();
        $this->alamatModel = new AlamatUserModel();
        $this->produkModel = new ProdukModel();
        $this->tokoModel = new TokoModel();
        $this->voucherModel = new VoucherModel();
        $this->promoModel = new PromoModel();
        $this->pesananModel = new PesananModel();
        $this->detailPesananModel = new DetailPesananModel();
        $this->db = \Config\Database::connect();
    }

    /**
     * Display checkout page
     */
    public function index()
    {
        $id_user = session()->get('id_user') ?? 1;
        
        try {
            // Get cart items
            $cartItems = $this->keranjangModel->getCartItems($id_user);
            
            if (empty($cartItems)) {
                return redirect()->to(site_url('cart'))->with('error', 'Keranjang kosong');
            }
            
            // Process cart items
            $processedItems = [];
            $totalHarga = 0;
            
            foreach ($cartItems as $item) {
                // Process images - use exact path from database
                $gambar_utama = 'assets/img/gambarprd.png';
                if (!empty($item['gambar_produk'])) {
                    $decoded = json_decode($item['gambar_produk'], true);
                    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded) && !empty($decoded)) {
                        // Ambil gambar pertama, pastikan path tidak dimulai dengan slash
                        $gambar_utama = ltrim($decoded[0], '/');
                    } else {
                        // Jika bukan JSON, gunakan path langsung
                        $gambar_utama = ltrim($item['gambar_produk'], '/');
                    }
                }
                
                $harga = $item['harga_saat_itu'] ?? ($item['harga_setelah_diskon'] > 0 ? $item['harga_setelah_diskon'] : $item['harga_awal']);
                $subtotal = $harga * $item['jumlah'];
                
                $processedItems[] = [
                    'id_keranjang' => $item['id_keranjang'],
                    'id_produk' => $item['id_produk'],
                    'nama_produk' => $item['nama_produk'],
                    'gambar_utama' => $gambar_utama,
                    'harga_awal' => $item['harga_awal'],
                    'harga_setelah_diskon' => $item['harga_setelah_diskon'],
                    'harga_display' => $harga,
                    'jumlah' => $item['jumlah'],
                    'subtotal' => $subtotal,
                ];
                
                $totalHarga += $subtotal;
            }
            
            // Get addresses
            $alamatList = $this->alamatModel->getAlamatByUser($id_user);
            $selectedAlamat = !empty($alamatList) ? $alamatList[0] : null;
            
            // Get toko info
            $toko = $this->tokoModel->getToko();
            
            // Shipping options
            $shippingOptions = [
                ['name' => 'Antar Sekarang', 'desc' => 'Estimasi tiba 15 - 20 m', 'price' => 15000, 'badge' => 'Hemat'],
                ['name' => 'Datang ke Tempat', 'desc' => 'Estimasi tiba menyesuaikan', 'price' => 30000, 'badge' => 'Cepat'],
            ];
            
            // Payment options
            $paymentOptions = [
                ['name' => 'Kartu Kredit/Debit', 'desc' => 'Visa, Mastercard, JCB', 'icon' => 'visa'],
                ['name' => 'Transfer Bank', 'desc' => 'BCA, Mandiri, BNI, BRI', 'icon' => 'bca'],
                ['name' => 'E-Wallet', 'desc' => 'GoPay, OVO, DANA, ShopeePay', 'icon' => 'ewallet'],
                ['name' => 'COD (Bayar di Tempat)', 'desc' => 'Bayar saat barang diterima', 'icon' => 'cod'],
            ];
            
            $data = [
                'cartItems' => $processedItems,
                'totalHarga' => $totalHarga,
                'alamatList' => $alamatList,
                'selectedAlamat' => $selectedAlamat,
                'toko' => $toko,
                'shippingOptions' => $shippingOptions,
                'paymentOptions' => $paymentOptions,
            ];
            
            echo view('layout/header');
            echo view('pages_user/pesan', $data);
            echo view('layout/footer');
            return '';
        } catch (\Exception $e) {
            log_message('error', 'Error in Pesan::index: ' . $e->getMessage());
            return redirect()->to(site_url('cart'))->with('error', 'Terjadi kesalahan');
        }
    }

    /**
     * Validate promo code via AJAX
     */
    public function validate_voucher()
    {
        $this->response->setContentType('application/json');
        
        try {
            // Get kode promo from POST (preferred) or GET
            $kode_promo = '';
            $total_harga = 0;
            
            if ($this->request->getMethod() === 'post') {
                $kode_promo = trim($this->request->getPost('kode_voucher') ?? '');
                $total_harga = (float)($this->request->getPost('total_harga') ?? 0);
            } else {
                $kode_promo = trim($this->request->getGet('kode_voucher') ?? '');
                $total_harga = (float)($this->request->getGet('total_harga') ?? 0);
            }
            
            // Normalize: remove extra spaces and ensure proper encoding
            $kode_promo = trim(preg_replace('/\s+/', ' ', $kode_promo));
            
            if (empty($kode_promo)) {
                return $this->response->setJSON(['success' => false, 'message' => 'Kode promo tidak boleh kosong']);
            }
            
            // Log untuk debugging
            log_message('debug', 'Validating promo code: [' . $kode_promo . '] (length: ' . strlen($kode_promo) . ')');
            
            // Cari promo berdasarkan nama_promo atau kode_voucher
            // Gunakan exact match untuk nama_promo (case-sensitive sesuai database)
            $promo = $this->promoModel->where('nama_promo', $kode_promo)->first();
            
            // Jika tidak ditemukan, coba cari berdasarkan kode_voucher
            if (!$promo && !empty($kode_promo)) {
                $promo = $this->promoModel->where('kode_voucher', $kode_promo)->first();
            }
            
            if (!$promo) {
                log_message('debug', 'Promo not found for code: [' . $kode_promo . ']');
                // Coba cari semua promo aktif untuk debugging
                $allPromos = $this->promoModel->where('status', 'aktif')->findAll();
                $promoNames = array_column($allPromos, 'nama_promo');
                log_message('debug', 'Available promo names: ' . implode(', ', $promoNames));
                return $this->response->setJSON(['success' => false, 'message' => 'Kode promo tidak ditemukan']);
            }
            
            log_message('debug', 'Promo found: ' . ($promo['nama_promo'] ?? 'N/A') . ' (ID: ' . ($promo['id_promo'] ?? 'N/A') . ')');
            
            // Validasi status promo
            if (!isset($promo['status']) || $promo['status'] !== 'aktif') {
                return $this->response->setJSON(['success' => false, 'message' => 'Promo tidak aktif']);
            }
            
            // Validasi tanggal dari database
            $now = date('Y-m-d H:i:s');
            if (isset($promo['tanggal_mulai']) && $promo['tanggal_mulai'] > $now) {
                return $this->response->setJSON(['success' => false, 'message' => 'Promo belum dimulai']);
            }
            
            if (isset($promo['tanggal_berakhir']) && $promo['tanggal_berakhir'] < $now) {
                return $this->response->setJSON(['success' => false, 'message' => 'Promo sudah kadaluarsa']);
            }
            
            // Validasi limit stok jika ada
            if (isset($promo['limit_stok']) && $promo['limit_stok'] !== null && $promo['limit_stok'] > 0) {
                $stok_terpakai = $promo['stok_terpakai'] ?? 0;
                if ($stok_terpakai >= $promo['limit_stok']) {
                    return $this->response->setJSON(['success' => false, 'message' => 'Promo sudah habis']);
                }
            }
            
            // Validasi field yang diperlukan
            if (!isset($promo['tipe_diskon']) || !isset($promo['nilai_diskon'])) {
                log_message('error', 'Promo missing required fields: tipe_diskon or nilai_diskon');
                return $this->response->setJSON(['success' => false, 'message' => 'Data promo tidak lengkap']);
            }
            
            // Hitung diskon berdasarkan tipe_diskon
            $potongan = 0;
            $nilai_diskon = (float)($promo['nilai_diskon'] ?? 0);
            
            if ($promo['tipe_diskon'] === 'persentase') {
                if ($nilai_diskon > 0 && $nilai_diskon <= 100) {
                    $potongan = ($total_harga * $nilai_diskon) / 100;
                }
            } elseif ($promo['tipe_diskon'] === 'nominal') {
                $potongan = $nilai_diskon;
                // Pastikan potongan tidak melebihi total harga
                if ($potongan > $total_harga) {
                    $potongan = $total_harga;
                }
            }
            
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Kode promo valid',
                'potongan' => round($potongan, 2),
                'promo' => [
                    'id_promo' => $promo['id_promo'] ?? null,
                    'nama_promo' => $promo['nama_promo'] ?? '',
                    'tipe_diskon' => $promo['tipe_diskon'] ?? '',
                    'nilai_diskon' => $nilai_diskon
                ]
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Error in validate_voucher: ' . $e->getMessage());
            log_message('error', 'Stack trace: ' . $e->getTraceAsString());
            log_message('error', 'File: ' . $e->getFile() . ' Line: ' . $e->getLine());
            
            // Return error message yang lebih user-friendly
            $errorMessage = 'Terjadi kesalahan saat validasi kode promo';
            if (ENVIRONMENT === 'development') {
                $errorMessage .= ': ' . $e->getMessage();
            }
            
            return $this->response->setJSON(['success' => false, 'message' => $errorMessage]);
        }
    }

    /**
     * Process checkout
     */
    public function checkout()
    {
        // Check request method - use multiple methods to detect
        $requestMethod = strtolower($this->request->getMethod());
        $serverMethod = strtolower($_SERVER['REQUEST_METHOD'] ?? '');
        $hasPostData = !empty($this->request->getPost());
        
        log_message('debug', '=== CHECKOUT REQUEST ===');
        log_message('debug', 'Request method (CI): ' . $requestMethod);
        log_message('debug', 'Request method (SERVER): ' . $serverMethod);
        log_message('debug', 'Request URI: ' . $this->request->getUri()->getPath());
        log_message('debug', 'POST data exists: ' . ($hasPostData ? 'yes' : 'no'));
        log_message('debug', 'POST data: ' . json_encode($this->request->getPost()));
        
        // Accept POST method - check multiple ways
        // If there's POST data, assume it's a POST request (even if method detection fails)
        $isPost = ($requestMethod === 'post' || $serverMethod === 'post' || $hasPostData);
        
        if (!$isPost) {
            log_message('error', 'Checkout called with wrong method. CI: ' . $requestMethod . ', SERVER: ' . $serverMethod . ', Has POST data: ' . ($hasPostData ? 'yes' : 'no'));
            return redirect()->to(site_url('pesan'))->with('error', 'Method tidak diizinkan. Request method: ' . strtoupper($requestMethod ?: $serverMethod ?: 'UNKNOWN'));
        }
        
        $id_user = session()->get('id_user') ?? 1;
        
        // Get form data
        $id_alamat = $this->request->getPost('id_alamat');
        $metode_pengiriman = $this->request->getPost('metode_pengiriman');
        $ongkir = (int)($this->request->getPost('ongkir') ?? 0);
        $metode_pembayaran = $this->request->getPost('metode_pembayaran');
        $kode_voucher = trim($this->request->getPost('kode_voucher') ?? '');
        $catatan = $this->request->getPost('catatan');
        
        try {
            // Log incoming data for debugging
            log_message('debug', 'Checkout request received');
            log_message('debug', 'id_alamat: ' . ($id_alamat ?? 'null'));
            log_message('debug', 'metode_pengiriman: ' . ($metode_pengiriman ?? 'null'));
            log_message('debug', 'metode_pembayaran: ' . ($metode_pembayaran ?? 'null'));
            log_message('debug', 'ongkir: ' . $ongkir);
            log_message('debug', 'kode_voucher: ' . $kode_voucher);
            
            // VALIDASI: Alamat harus diisi
            if (empty($id_alamat) || !is_numeric($id_alamat)) {
                log_message('error', 'Validation failed: Alamat tidak dipilih');
                return redirect()->to(site_url('pesan'))->with('error', 'Alamat pengiriman harus dipilih');
            }
            
            // VALIDASI: Metode pengiriman harus diisi
            if (empty($metode_pengiriman)) {
                log_message('error', 'Validation failed: Metode pengiriman tidak dipilih');
                return redirect()->to(site_url('pesan'))->with('error', 'Metode pengiriman harus dipilih');
            }
            
            // VALIDASI: Metode pembayaran harus diisi
            if (empty($metode_pembayaran)) {
                log_message('error', 'Validation failed: Metode pembayaran tidak dipilih');
                return redirect()->to(site_url('pesan'))->with('error', 'Metode pembayaran harus dipilih');
            }
            
            // Validasi alamat milik user
            $alamat = $this->alamatModel->getAlamatById($id_alamat, $id_user);
            if (!$alamat) {
                return redirect()->to(site_url('pesan'))->with('error', 'Alamat tidak ditemukan');
            }
            
            // Get cart items
            $cartItems = $this->keranjangModel->getCartItems($id_user);
            if (empty($cartItems)) {
                return redirect()->to(site_url('cart'))->with('error', 'Keranjang kosong');
            }
            
            // Calculate totals
            $total_harga = 0;
            foreach ($cartItems as $item) {
                $harga = $item['harga_saat_itu'] ?? ($item['harga_setelah_diskon'] > 0 ? $item['harga_setelah_diskon'] : $item['harga_awal']);
                $total_harga += $harga * $item['jumlah'];
            }
            
            // Apply promo if any
            $potongan_voucher = 0;
            $id_voucher = null;
            if (!empty($kode_voucher)) {
                try {
                    // Cari promo berdasarkan nama_promo atau kode_voucher
                    // Coba cari berdasarkan nama_promo dulu
                    $promo = $this->promoModel->where('nama_promo', $kode_voucher)->first();
                    
                    // Jika tidak ditemukan, coba cari berdasarkan kode_voucher
                    if (!$promo) {
                        $promo = $this->promoModel->where('kode_voucher', $kode_voucher)->first();
                    }
                    
                    if ($promo) {
                        // Validasi status promo
                        if ($promo['status'] !== 'aktif') {
                            return redirect()->to(site_url('pesan'))->with('error', 'Promo tidak aktif');
                        }
                        
                        // Validasi tanggal dari database
                        $now = date('Y-m-d H:i:s');
                        if ($promo['tanggal_mulai'] > $now) {
                            return redirect()->to(site_url('pesan'))->with('error', 'Promo belum dimulai');
                        }
                        
                        if ($promo['tanggal_berakhir'] < $now) {
                            return redirect()->to(site_url('pesan'))->with('error', 'Promo sudah kadaluarsa');
                        }
                        
                        // Validasi limit stok jika ada
                        if (isset($promo['limit_stok']) && $promo['limit_stok'] !== null && $promo['limit_stok'] > 0) {
                            $stok_terpakai = $promo['stok_terpakai'] ?? 0;
                            if ($stok_terpakai >= $promo['limit_stok']) {
                                return redirect()->to(site_url('pesan'))->with('error', 'Promo sudah habis');
                            }
                        }
                        
                        // Hitung diskon berdasarkan tipe_diskon
                        if ($promo['tipe_diskon'] === 'persentase') {
                            $potongan_voucher = ($total_harga * $promo['nilai_diskon']) / 100;
                        } elseif ($promo['tipe_diskon'] === 'nominal') {
                            $potongan_voucher = $promo['nilai_diskon'];
                            // Pastikan potongan tidak melebihi total harga
                            if ($potongan_voucher > $total_harga) {
                                $potongan_voucher = $total_harga;
                            }
                        }
                        
                        // Simpan id_promo ke id_voucher (karena tabel pesanan menggunakan id_voucher)
                        $id_voucher = $promo['id_promo'];
                    } else {
                        return redirect()->to(site_url('pesan'))->with('error', 'Kode promo tidak ditemukan');
                    }
                } catch (\Exception $e) {
                    log_message('error', 'Error validating promo: ' . $e->getMessage());
                    return redirect()->to(site_url('pesan'))->with('error', 'Terjadi kesalahan saat validasi promo');
                }
            }
            
            $biaya_layanan = 1000;
            $total_bayar = $total_harga + $ongkir + $biaya_layanan - $potongan_voucher;
            
            // Ensure total_bayar is not negative
            if ($total_bayar < 0) {
                $total_bayar = 0;
            }
            
            // Generate order number
            $no_pesanan = 'ORD-' . date('Ymd') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
            
            // Create order
            $pesananData = [
                'no_pesanan' => $no_pesanan,
                'id_user' => $id_user,
                'id_alamat' => $id_alamat,
                'tanggal_pesan' => date('Y-m-d H:i:s'),
                'metode_pengiriman' => $metode_pengiriman,
                'ongkir' => $ongkir,
                'total_harga' => $total_harga,
                'total_bayar' => $total_bayar,
                'id_voucher' => $id_voucher,
                'status_pesanan' => 'Diproses',
            ];
            
            // Start database transaction
            $this->db->transStart();
            
            try {
                log_message('debug', 'Inserting pesanan data: ' . json_encode($pesananData));
                $id_pesan = $this->pesananModel->insert($pesananData);
                
                if ($id_pesan === false) {
                    $errors = $this->pesananModel->errors();
                    $this->db->transRollback();
                    $errorMsg = !empty($errors) ? implode(', ', $errors) : 'Unknown error';
                    log_message('error', 'Failed to insert pesanan: ' . $errorMsg);
                    log_message('error', 'Pesanan data that failed: ' . json_encode($pesananData));
                    return redirect()->to(site_url('pesan'))->with('error', 'Gagal membuat pesanan: ' . $errorMsg);
                }
                
                log_message('debug', 'Pesanan inserted successfully with ID: ' . $id_pesan);
                
                // Ensure id_pesan is integer
                $id_pesan = (int)$id_pesan;
                if ($id_pesan <= 0) {
                    $this->db->transRollback();
                    log_message('error', 'Invalid pesanan ID returned: ' . $id_pesan);
                    return redirect()->to(site_url('pesan'))->with('error', 'Gagal membuat pesanan: ID tidak valid');
                }
                
                // Create order details (optimized batch processing)
                $detailData = [];
                $stockUpdates = [];
                
                foreach ($cartItems as $item) {
                    $harga = $item['harga_saat_itu'] ?? ($item['harga_setelah_diskon'] > 0 ? $item['harga_setelah_diskon'] : $item['harga_awal']);
                    $subtotal = $harga * $item['jumlah'];
                    
                    $detailData[] = [
                        'id_pesan' => $id_pesan,
                        'id_produk' => $item['id_produk'],
                        'jumlah' => $item['jumlah'],
                        'harga' => $harga,
                        'subtotal' => $subtotal,
                    ];
                    
                    // Prepare stock updates
                    $stockUpdates[$item['id_produk']] = ($stockUpdates[$item['id_produk']] ?? 0) + $item['jumlah'];
                }
                
                // Insert order details (one by one for better error handling)
                if (!empty($detailData)) {
                    log_message('debug', 'Preparing to insert ' . count($detailData) . ' detail pesanan items');
                    
                    foreach ($detailData as $index => $detail) {
                        // Validate data before insert
                        if (empty($detail['id_pesan']) || empty($detail['id_produk']) || empty($detail['jumlah'])) {
                            $this->db->transRollback();
                            log_message('error', 'Invalid detail data at index ' . $index . ': ' . json_encode($detail));
                            return redirect()->to(site_url('pesan'))->with('error', 'Data detail pesanan tidak valid');
                        }
                        
                        // Ensure numeric values - database expects INT for harga and subtotal
                        $detail['id_pesan'] = (int)$detail['id_pesan'];
                        $detail['id_produk'] = (int)$detail['id_produk'];
                        $detail['jumlah'] = (int)$detail['jumlah'];
                        $detail['harga'] = (int)round($detail['harga']); // Convert to int for database
                        $detail['subtotal'] = (int)round($detail['subtotal']); // Convert to int for database
                        
                        log_message('debug', 'Inserting detail pesanan ' . ($index + 1) . ': ' . json_encode($detail));
                        
                        // Try direct database insert if model insert fails
                        try {
                            $detailInserted = $this->detailPesananModel->insert($detail);
                            
                            if ($detailInserted === false) {
                                // Try direct database insert as fallback
                                $builder = $this->db->table('detail_pesanan');
                                $builder->insert($detail);
                                $detailInserted = $this->db->insertID();
                                
                                if ($detailInserted <= 0) {
                                    throw new \Exception('Failed to insert detail pesanan');
                                }
                                
                                log_message('debug', 'Detail pesanan inserted via direct DB insert with ID: ' . $detailInserted);
                            }
                        } catch (\Exception $e) {
                            $this->db->transRollback();
                            $errors = $this->detailPesananModel->errors();
                            $errorMsg = !empty($errors) ? implode(', ', $errors) : $e->getMessage();
                            log_message('error', 'Failed to insert detail pesanan at index ' . $index . ': ' . $errorMsg);
                            log_message('error', 'Exception: ' . $e->getMessage());
                            log_message('error', 'Detail data that failed: ' . json_encode($detail));
                            log_message('error', 'Model errors: ' . json_encode($errors));
                            log_message('error', 'Stack trace: ' . $e->getTraceAsString());
                            return redirect()->to(site_url('pesan'))->with('error', 'Gagal membuat detail pesanan: ' . $errorMsg);
                        }
                        
                        log_message('debug', 'Detail pesanan ' . ($index + 1) . ' inserted successfully with ID: ' . $detailInserted);
                    }
                    log_message('debug', 'All detail pesanan inserted successfully: ' . count($detailData) . ' items');
                } else {
                    log_message('error', 'No detail data to insert');
                    $this->db->transRollback();
                    return redirect()->to(site_url('pesan'))->with('error', 'Tidak ada item untuk dipesan');
                }
                
                // Update product stock
                foreach ($stockUpdates as $id_produk => $jumlah) {
                    $produk = $this->produkModel->find($id_produk);
                    if ($produk) {
                        $newStok = ($produk['stok'] ?? 0) - $jumlah;
                        if ($newStok < 0) {
                            $newStok = 0;
                        }
                        $this->produkModel->update($id_produk, ['stok' => $newStok]);
                    }
                }
                
                // Clear cart
                $clearResult = $this->keranjangModel->clearCart($id_user);
                if ($clearResult === false) {
                    log_message('warning', 'Failed to clear cart for user: ' . $id_user);
                }
                
                // Commit transaction
                $this->db->transComplete();
                
                if ($this->db->transStatus() === false) {
                    $errors = $this->db->error();
                    log_message('error', 'Transaction failed in checkout');
                    log_message('error', 'DB Error: ' . json_encode($errors));
                    return redirect()->to(site_url('pesan'))->with('error', 'Gagal menyimpan pesanan');
                }
                
                // Redirect to success page immediately
                log_message('info', 'Order created successfully: ' . $id_pesan);
                log_message('debug', 'Redirecting to: pesan/sukses/' . $id_pesan);
                $redirectUrl = site_url('pesan/sukses/' . $id_pesan);
                log_message('debug', 'Redirect URL: ' . $redirectUrl);
                return redirect()->to($redirectUrl)->with('success', 'Pesanan berhasil dibuat');
                
            } catch (\Exception $e) {
                $this->db->transRollback();
                log_message('error', 'Exception in checkout: ' . $e->getMessage());
                log_message('error', 'Stack trace: ' . $e->getTraceAsString());
                return redirect()->to(site_url('pesan'))->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
            }
        } catch (\Exception $e) {
            log_message('error', 'Error in Pesan::checkout: ' . $e->getMessage());
            log_message('error', 'Stack trace: ' . $e->getTraceAsString());
            return redirect()->to(site_url('pesan'))->with('error', 'Terjadi kesalahan saat membuat pesanan: ' . $e->getMessage());
        }
    }

    /**
     * Display success page after checkout
     */
    public function sukses($id_pesan = null)
    {
        log_message('debug', 'Sukses method called with id_pesan: ' . ($id_pesan ?? 'null'));
        $id_user = session()->get('id_user') ?? 1;
        
        try {
            if (!$id_pesan) {
                log_message('error', 'No id_pesan provided to sukses method');
                return redirect()->to(site_url('profile'))->with('error', 'Pesanan tidak ditemukan');
            }
            
            // Get order details
            $pesanan = $this->pesananModel->find($id_pesan);
            log_message('debug', 'Pesanan found: ' . ($pesanan ? 'yes (ID: ' . $pesanan['id_pesan'] . ')' : 'no'));
            
            if (!$pesanan) {
                log_message('error', 'Pesanan not found: ' . $id_pesan);
                return redirect()->to(site_url('profile'))->with('error', 'Pesanan tidak ditemukan');
            }
            
            if ($pesanan['id_user'] != $id_user) {
                log_message('error', 'Pesanan user mismatch. Pesanan user: ' . $pesanan['id_user'] . ', Current user: ' . $id_user);
                return redirect()->to(site_url('profile'))->with('error', 'Pesanan tidak ditemukan');
            }
            
            // Get order details with product info
            $detailPesanan = $this->detailPesananModel->getDetailByPesanan($id_pesan);
            
            // Process product images for each detail - use exact path from database
            foreach ($detailPesanan as &$detail) {
                if (!empty($detail['gambar_produk'])) {
                    $decoded = json_decode($detail['gambar_produk'], true);
                    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded) && !empty($decoded)) {
                        // Ambil gambar pertama, pastikan path tidak dimulai dengan slash
                        $detail['gambar_utama'] = ltrim($decoded[0], '/');
                    } else {
                        // Jika bukan JSON, gunakan path langsung
                        $detail['gambar_utama'] = ltrim($detail['gambar_produk'], '/');
                    }
                } else {
                    $detail['gambar_utama'] = 'assets/img/gambarprd.png';
                }
            }
            
            $data = [
                'pesanan' => $pesanan,
                'detailPesanan' => $detailPesanan,
            ];
            
            echo view('layout/header');
            echo view('pages_user/pesan_sukses', $data);
            echo view('layout/footer');
            return '';
        } catch (\Exception $e) {
            log_message('error', 'Error in Pesan::sukses: ' . $e->getMessage());
            return redirect()->to(site_url('profile'))->with('error', 'Terjadi kesalahan');
        }
    }
}

