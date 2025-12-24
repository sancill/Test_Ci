<?php

namespace App\Controllers;

use App\Models\KeranjangModel;
use App\Models\ProdukModel;

class Cart extends BaseController
{
    protected $keranjangModel;
    protected $produkModel;

    public function __construct()
    {
        $this->keranjangModel = new KeranjangModel();
        $this->produkModel = new ProdukModel();
    }

    /**
     * Display cart page
     */
    public function index(): string
    {
        // Get user ID from session (default to 1 for now, should be from login)
        $id_user = session()->get('id_user') ?? 1;
        
        try {
            // Get cart items from database
            $cartItems = $this->keranjangModel->getCartItems($id_user);
            
            // Process cart items
            $processedItems = [];
            $totalItems = 0;
            $totalHarga = 0;
            
            foreach ($cartItems as $item) {
                // Process product images - use exact path from database
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
                
                // Get price
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
                    'stok' => $item['stok'],
                    'subtotal' => $subtotal,
                ];
                
                $totalItems += $item['jumlah'];
                $totalHarga += $subtotal;
            }
            
            $data = [
                'cartItems' => $processedItems,
                'totalItems' => $totalItems,
                'totalHarga' => $totalHarga,
            ];
            
            echo view('layout/header');
            echo view('pages_user/cart', $data);
            echo view('layout/footer');
            return '';
        } catch (\Exception $e) {
            log_message('error', 'Error in Cart::index: ' . $e->getMessage());
            
            $data = [
                'cartItems' => [],
                'totalItems' => 0,
                'totalHarga' => 0,
            ];
            
            echo view('layout/header');
            echo view('pages_user/cart', $data);
            echo view('layout/footer');
            return '';
        }
    }

    /**
     * Add product to cart
     */
    public function add()
    {
        // Set JSON response header
        $this->response->setContentType('application/json');
        
        // Get request method for logging
        $method = $this->request->getMethod();
        
        // Log for debugging
        log_message('debug', 'Cart::add - Method: ' . $method);
        log_message('debug', 'Cart::add - POST data: ' . json_encode($this->request->getPost()));
        log_message('debug', 'Cart::add - GET data: ' . json_encode($this->request->getGet()));
        
        // Try to get data from POST first, then GET (for debugging)
        $id_produk = $this->request->getPost('id_produk') ?? $this->request->getGet('id_produk');
        $jumlah = $this->request->getPost('jumlah') ?? $this->request->getGet('jumlah');
        
        // If no data in POST, it might be a routing issue
        if (empty($id_produk) && strtoupper($method) !== 'POST') {
            log_message('error', 'Cart::add - Invalid method: ' . $method);
            return $this->response->setJSON([
                'success' => false, 
                'message' => 'Method tidak diizinkan. Gunakan POST.',
                'received_method' => $method
            ]);
        }
        
        try {
            $id_user = session()->get('id_user') ?? 1;
            
            // Get data from POST (or GET for debugging)
            if (empty($id_produk)) {
                $id_produk = $this->request->getPost('id_produk');
            }
            if (empty($jumlah)) {
                $jumlah = (int)($this->request->getPost('jumlah') ?? 1);
            }
            $id_varian = $this->request->getPost('id_varian') ?? $this->request->getGet('id_varian');
            
            // Validate input
            if (empty($id_produk) || !is_numeric($id_produk)) {
                return $this->response->setJSON(['success' => false, 'message' => 'ID produk tidak valid']);
            }
            
            if ($jumlah < 1) {
                return $this->response->setJSON(['success' => false, 'message' => 'Jumlah minimal 1']);
            }
            
            // Get product
            $produk = $this->produkModel->find($id_produk);
            if (!$produk || empty($produk)) {
                return $this->response->setJSON(['success' => false, 'message' => 'Produk tidak ditemukan']);
            }
            
            // Check if product is active
            if (!isset($produk['status_produk']) || $produk['status_produk'] !== 'aktif') {
                return $this->response->setJSON(['success' => false, 'message' => 'Produk tidak tersedia']);
            }
            
            // Check stock
            $stokTersedia = isset($produk['stok']) ? $produk['stok'] : 0;
            if ($stokTersedia < $jumlah) {
                return $this->response->setJSON(['success' => false, 'message' => 'Stok tidak mencukupi. Stok tersedia: ' . $stokTersedia]);
            }
            
            // Get price
            $harga = 0;
            if (isset($produk['harga_setelah_diskon']) && $produk['harga_setelah_diskon'] > 0) {
                $harga = $produk['harga_setelah_diskon'];
            } elseif (isset($produk['harga_awal'])) {
                $harga = $produk['harga_awal'];
            }
            
            if ($harga <= 0) {
                return $this->response->setJSON(['success' => false, 'message' => 'Harga produk tidak valid']);
            }
            
            // Add to cart
            $result = $this->keranjangModel->addToCart($id_user, $id_produk, $jumlah, $harga);
            
            if ($result === false) {
                $errors = $this->keranjangModel->errors();
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal menambahkan ke keranjang: ' . implode(', ', $errors)
                ]);
            }
            
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Produk ditambahkan ke keranjang'
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Error in Cart::add: ' . $e->getMessage());
            log_message('error', 'Stack trace: ' . $e->getTraceAsString());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Update quantity dari AJAX request
     */
    public function update_quantity()
    {
        // Set JSON response header
        $this->response->setContentType('application/json');

        // Get request method
        $method = strtoupper($this->request->getMethod());
        
        // Log for debugging
        log_message('debug', 'Cart::update_quantity - Method: ' . $method);
        
        // Accept POST method only
        if ($method !== 'POST') {
            log_message('error', 'Cart::update_quantity - Invalid method: ' . $method);
            return $this->response->setJSON([
                'success' => false, 
                'message' => 'Method tidak diizinkan. Gunakan POST.',
                'received_method' => $method
            ]);
        }

        $id_user = session()->get('id_user') ?? 1;
        $id_keranjang = $this->request->getPost('id_keranjang');
        $jumlah = (int)$this->request->getPost('jumlah') ?? 1;

        try {
            // Validate input
            if (empty($id_keranjang) || !is_numeric($id_keranjang)) {
                return $this->response->setJSON([
                    'success' => false, 
                    'message' => 'ID keranjang tidak valid'
                ]);
            }
            
            if ($jumlah < 1) {
                return $this->response->setJSON([
                    'success' => false, 
                    'message' => 'Quantity minimal 1'
                ]);
            }

            // Get cart item
            $cartItem = $this->keranjangModel->find($id_keranjang);
            if (!$cartItem || $cartItem['id_user'] != $id_user) {
                return $this->response->setJSON([
                    'success' => false, 
                    'message' => 'Item tidak ditemukan'
                ]);
            }
            
            // Get product to check stock
            $produk = $this->produkModel->find($cartItem['id_produk']);
            if (!$produk) {
                return $this->response->setJSON([
                    'success' => false, 
                    'message' => 'Produk tidak ditemukan'
                ]);
            }
            
            if (isset($produk['stok']) && $produk['stok'] < $jumlah) {
                return $this->response->setJSON([
                    'success' => false, 
                    'message' => 'Stok tidak mencukupi. Stok tersedia: ' . $produk['stok']
                ]);
            }
            
            // Update quantity
            $result = $this->keranjangModel->updateQuantity($id_keranjang, $jumlah);
            
            if ($result === false) {
                $errors = $this->keranjangModel->errors();
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal mengupdate quantity: ' . implode(', ', $errors)
                ]);
            }
            
            // Calculate new subtotal
            $harga = $cartItem['harga_saat_itu'] ?? ($produk['harga_setelah_diskon'] > 0 ? $produk['harga_setelah_diskon'] : $produk['harga_awal']);
            $subtotal = $harga * $jumlah;
            
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Quantity updated',
                'quantity' => $jumlah,
                'subtotal' => $subtotal
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Error in Cart::update_quantity: ' . $e->getMessage());
            log_message('error', 'Stack trace: ' . $e->getTraceAsString());
            return $this->response->setJSON([
                'success' => false, 
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Remove item from cart
     */
    public function remove()
    {
        // Set JSON response header
        $this->response->setContentType('application/json');
        
        // Get request method
        $method = strtoupper($this->request->getMethod());
        
        // Log for debugging
        log_message('debug', 'Cart::remove - Method: ' . $method);
        log_message('debug', 'Cart::remove - POST data: ' . json_encode($this->request->getPost()));
        
        // Accept POST method only
        if ($method !== 'POST') {
            log_message('error', 'Cart::remove - Invalid method: ' . $method);
            return $this->response->setJSON([
                'success' => false, 
                'message' => 'Method tidak diizinkan. Gunakan POST.',
                'received_method' => $method
            ]);
        }
        
        try {
            $id_user = session()->get('id_user') ?? 1;
            $id_keranjang = $this->request->getPost('id_keranjang');
            
            // Validate input
            if (empty($id_keranjang) || !is_numeric($id_keranjang)) {
                return $this->response->setJSON([
                    'success' => false, 
                    'message' => 'ID keranjang tidak valid'
                ]);
            }
            
            // Remove from cart
            $result = $this->keranjangModel->removeFromCart($id_keranjang, $id_user);
            
            if ($result === false) {
                $errors = $this->keranjangModel->errors();
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal menghapus item: ' . implode(', ', $errors)
                ]);
            }
            
            return $this->response->setJSON([
                'success' => true, 
                'message' => 'Item dihapus dari keranjang'
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Error in Cart::remove: ' . $e->getMessage());
            log_message('error', 'Stack trace: ' . $e->getTraceAsString());
            return $this->response->setJSON([
                'success' => false, 
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Get current quantity dari session (legacy method)
     */
    public function get_quantity()
    {
        header('Content-Type: application/json');
        $quantity = session()->get('product_quantity') ?? 1;
        return json_encode(['success' => true, 'quantity' => $quantity]);
    }
}
