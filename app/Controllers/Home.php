<?php

namespace App\Controllers;

use App\Models\KategoriModel;
use App\Models\ProdukModel;
use App\Models\MenuModel;
use App\Models\PromoModel;
use App\Models\TokoModel;

class Home extends BaseController
{
    protected $kategoriModel;
    protected $produkModel;
    protected $menuModel;
    protected $promoModel;
    protected $tokoModel;

    protected function getKategoriModel()
    {
        if (!$this->kategoriModel) {
            try {
                $this->kategoriModel = new KategoriModel();
            } catch (\Exception $e) {
                log_message('error', 'Error initializing KategoriModel: ' . $e->getMessage());
                return null;
            }
        }
        return $this->kategoriModel;
    }

    protected function getProdukModel()
    {
        if (!$this->produkModel) {
            try {
                $this->produkModel = new ProdukModel();
            } catch (\Exception $e) {
                log_message('error', 'Error initializing ProdukModel: ' . $e->getMessage());
                return null;
            }
        }
        return $this->produkModel;
    }

    protected function getMenuModel()
    {
        if (!$this->menuModel) {
            try {
                $this->menuModel = new MenuModel();
            } catch (\Exception $e) {
                log_message('error', 'Error initializing MenuModel: ' . $e->getMessage());
                return null;
            }
        }
        return $this->menuModel;
    }

    protected function getPromoModel()
    {
        if (!$this->promoModel) {
            try {
                $this->promoModel = new PromoModel();
            } catch (\Exception $e) {
                log_message('error', 'Error initializing PromoModel: ' . $e->getMessage());
                return null;
            }
        }
        return $this->promoModel;
    }

    protected function getTokoModel()
    {
        if (!$this->tokoModel) {
            try {
                $this->tokoModel = new TokoModel();
            } catch (\Exception $e) {
                log_message('error', 'Error initializing TokoModel: ' . $e->getMessage());
                return null;
            }
        }
        return $this->tokoModel;
    }

    public function index(): string
    {
        try {
            // Get active categories
            $kategori = [];
            $kategoriModel = $this->getKategoriModel();
            if ($kategoriModel) {
                try {
                    $kategori = $kategoriModel->getKategoriAktif();
                } catch (\Exception $e) {
                    log_message('error', 'Error getting kategori: ' . $e->getMessage());
                }
            }
            
            // Get active products (limit 8 for homepage)
            $produkList = [];
            $produkModel = $this->getProdukModel();
            if ($produkModel) {
                try {
                    $produkList = $produkModel->where('status_produk', 'aktif')
                        ->orderBy('created_at', 'DESC')
                        ->limit(8)
                        ->findAll();
                } catch (\Exception $e) {
                    log_message('error', 'Error getting produk: ' . $e->getMessage());
                }
            }
            
            // Process product images (decode JSON) - use exact path from database
            foreach ($produkList as &$produk) {
                if (!empty($produk['gambar_produk'])) {
                    $decoded = json_decode($produk['gambar_produk'], true);
                    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded) && !empty($decoded)) {
                        // Ambil gambar pertama dari JSON, pastikan path tidak dimulai dengan slash
                        $produk['gambar_utama'] = ltrim($decoded[0], '/');
                    } else {
                        // Jika bukan JSON, gunakan path langsung
                        $produk['gambar_utama'] = ltrim($produk['gambar_produk'], '/');
                    }
                } else {
                    $produk['gambar_utama'] = 'assets/img/gambarprd.png'; // Default image
                }
                
                // Format price
                $produk['harga_display'] = isset($produk['harga_setelah_diskon']) && $produk['harga_setelah_diskon'] > 0 
                    ? $produk['harga_setelah_diskon'] 
                    : ($produk['harga_awal'] ?? 0);
            }
            
            // Get active promo
            $promoAktif = [];
            $tokoModel = $this->getTokoModel();
            $promoModel = $this->getPromoModel();
            if ($tokoModel && $promoModel) {
                try {
                    $toko = $tokoModel->getToko();
                    $id_toko = $toko ? $toko['id_toko'] : null;
                    $promoAktif = $promoModel->getPromoAktif($id_toko);
                } catch (\Exception $e) {
                    log_message('error', 'Error getting promo: ' . $e->getMessage());
                }
            }
            
            $data = [
                'kategori' => $kategori,
                'produk' => $produkList,
                'promoAktif' => $promoAktif,
            ];
            
            echo view('layout/header');
            echo view('pages_user/Home', $data);
            echo view('layout/footer');
            return '';
        } catch (\Exception $e) {
            log_message('error', 'Error in Home::index: ' . $e->getMessage());
            log_message('error', 'Stack trace: ' . $e->getTraceAsString());
            
            // Return view dengan data kosong jika error
            $data = [
                'kategori' => [],
                'produk' => [],
                'promoAktif' => [],
            ];
            
            echo view('layout/header');
            echo view('pages_user/Home', $data);
            echo view('layout/footer');
            return '';
        }
    }

    public function produk(): string
    {
        // Get filter parameters
        $search = $this->request->getGet('search');
        $kategori = $this->request->getGet('kategori');
        $menu = $this->request->getGet('menu');
        
        // Build query for active products
        $produkModel = $this->getProdukModel();
        $produkList = [];
        
        if ($produkModel) {
            try {
                $builder = $produkModel->where('status_produk', 'aktif');
                
                if ($search) {
                    $builder->groupStart()
                        ->like('nama_produk', $search)
                        ->orLike('deskripsi_produk', $search)
                        ->orLike('sku', $search)
                        ->groupEnd();
                }
                
                if ($kategori && $kategori !== 'all') {
                    $builder->where('id_kategori', $kategori);
                }
                
                if ($menu && $menu !== 'all') {
                    $builder->where('id_menu', $menu);
                }
                
                $produkList = $builder->orderBy('created_at', 'DESC')->findAll();
            } catch (\Exception $e) {
                log_message('error', 'Error getting produk list: ' . $e->getMessage());
            }
        }
        
        // Process product images - use exact path from database
        foreach ($produkList as &$produk) {
            if (!empty($produk['gambar_produk'])) {
                $decoded = json_decode($produk['gambar_produk'], true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded) && !empty($decoded)) {
                    // Ambil gambar pertama dari JSON, pastikan path tidak dimulai dengan slash
                    $produk['gambar_utama'] = ltrim($decoded[0], '/');
                } else {
                    // Jika bukan JSON, gunakan path langsung
                    $produk['gambar_utama'] = ltrim($produk['gambar_produk'], '/');
                }
            } else {
                $produk['gambar_utama'] = 'assets/img/gambarprd.png';
            }
            
            $produk['harga_display'] = $produk['harga_setelah_diskon'] > 0 
                ? $produk['harga_setelah_diskon'] 
                : $produk['harga_awal'];
        }
        
        // Get categories and menus for filter
        $kategoriList = [];
        $menuList = [];
        $kategoriModel = $this->getKategoriModel();
        $menuModel = $this->getMenuModel();
        
        if ($kategoriModel) {
            try {
                $kategoriList = $kategoriModel->getKategoriAktif();
            } catch (\Exception $e) {
                log_message('error', 'Error getting kategori list: ' . $e->getMessage());
            }
        }
        
        if ($menuModel) {
            try {
                $menuList = $menuModel->getAllMenu();
            } catch (\Exception $e) {
                log_message('error', 'Error getting menu list: ' . $e->getMessage());
            }
        }
        
        $data = [
            'produk' => $produkList,
            'kategori' => $kategoriList,
            'menu' => $menuList,
            'search' => $search,
            'filterKategori' => $kategori,
            'filterMenu' => $menu,
        ];
        
        echo view('layout/header');
        echo view('pages_user/produk_list', $data);
        echo view('layout/footer');
        return '';
    }
    
    public function produk_detail($id): string
    {
        try {
            $produkModel = $this->getProdukModel();
            if (!$produkModel) {
                return redirect()->to(site_url('produk'))->with('error', 'Database tidak tersedia');
            }
            
            // Validate ID
            if (empty($id) || !is_numeric($id)) {
                return redirect()->to(site_url('produk'))->with('error', 'ID produk tidak valid');
            }
            
            // Get product
            try {
                $produk = $produkModel->getProdukById($id);
            } catch (\Exception $e) {
                log_message('error', 'Error getting produk detail: ' . $e->getMessage());
                log_message('error', 'Stack trace: ' . $e->getTraceAsString());
                return redirect()->to(site_url('produk'))->with('error', 'Produk tidak ditemukan');
            }
            
            if (!$produk || empty($produk)) {
                return redirect()->to(site_url('produk'))->with('error', 'Produk tidak ditemukan');
            }
            
            // Check if product is active
            if (!isset($produk['status_produk']) || $produk['status_produk'] !== 'aktif') {
                return redirect()->to(site_url('produk'))->with('error', 'Produk tidak tersedia');
            }
            
            // Process images - use exact path from database
            $fotos = [];
            if (!empty($produk['gambar_produk'])) {
                try {
                    $decoded = json_decode($produk['gambar_produk'], true);
                    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded) && !empty($decoded)) {
                        // Pastikan semua path tidak dimulai dengan slash
                        $fotos = array_map(function($path) {
                            return ['foto_produk' => ltrim($path, '/')];
                        }, $decoded);
                    } else {
                        // Fallback: jika bukan JSON, gunakan path langsung
                        $fotos = [['foto_produk' => ltrim($produk['gambar_produk'], '/')]];
                    }
                } catch (\Exception $e) {
                    log_message('error', 'Error decoding gambar_produk: ' . $e->getMessage());
                    $fotos = [['foto_produk' => ltrim($produk['gambar_produk'], '/')]];
                }
            }
            
            // If no images, add placeholder
            if (empty($fotos)) {
                $fotos = [['foto_produk' => 'assets/img/gambarprd.png']];
            }
            
            // Get varian produk - initialize variables
            $varianList = [];
            $varianImageIndices = [];
            $currentImageIndex = count($fotos); // Starting index untuk gambar varian
            
            try {
                $produkVarianModel = new \App\Models\ProdukVarianModel();
                $varianList = $produkVarianModel->getVarianByProduk($id);
                
                if (!empty($varianList) && is_array($varianList)) {
                    foreach ($varianList as &$varian) {
                        if (!empty($varian['gambar_varian'])) {
                            try {
                                $decoded = json_decode($varian['gambar_varian'], true);
                                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded) && !empty($decoded)) {
                                    $varian['gambar_varian'] = $decoded;
                                    // Simpan starting index untuk varian ini
                                    if (isset($varian['id_varian'])) {
                                        $varianImageIndices[$varian['id_varian']] = $currentImageIndex;
                                    }
                                    // Tambahkan gambar varian ke list semua foto
                                    foreach ($decoded as $gambarPath) {
                                        $fotoItem = ['foto_produk' => $gambarPath, 'is_variant' => true];
                                        if (isset($varian['id_varian'])) {
                                            $fotoItem['varian_id'] = $varian['id_varian'];
                                        }
                                        $fotos[] = $fotoItem;
                                    }
                                    $currentImageIndex += count($decoded);
                                } else {
                                    $varian['gambar_varian'] = [];
                                }
                            } catch (\Exception $e) {
                                log_message('error', 'Error decoding gambar_varian: ' . $e->getMessage());
                                $varian['gambar_varian'] = [];
                            }
                        } else {
                            $varian['gambar_varian'] = [];
                        }
                    }
                    unset($varian); // Unset reference
                }
            } catch (\Exception $e) {
                log_message('error', 'Error getting varian: ' . $e->getMessage());
                log_message('error', 'Stack trace: ' . $e->getTraceAsString());
                // Continue with empty varian list
            }
            
            // Get toko info
            $toko = null;
            $tokoModel = $this->getTokoModel();
            if ($tokoModel) {
                try {
                    $toko = $tokoModel->getToko();
                } catch (\Exception $e) {
                    log_message('error', 'Error getting toko: ' . $e->getMessage());
                }
            }
            
            // Calculate harga_display for produk
            $produk['harga_display'] = isset($produk['harga_setelah_diskon']) && $produk['harga_setelah_diskon'] > 0 
                ? $produk['harga_setelah_diskon'] 
                : ($produk['harga_awal'] ?? 0);
            
            // Ensure all required data is set with defaults
            $data = [
                'produk' => $produk,
                'toko' => $toko ?? null,
                'fotos' => $fotos ?? [],
                'varianList' => $varianList ?? [],
                'varianImageIndices' => $varianImageIndices ?? [],
            ];
            
            echo view('layout/header');
            echo view('pages_user/produk_detail', $data);
            echo view('layout/footer');
            return '';
        } catch (\Exception $e) {
            log_message('error', 'Error in produk_detail: ' . $e->getMessage());
            log_message('error', 'Stack trace: ' . $e->getTraceAsString());
            
            // Return to product list with error message
            return redirect()->to(site_url('produk'))->with('error', 'Terjadi kesalahan saat memuat detail produk');
        }
    }
    
    public function chatPenjual(): string
    {
        try {
            // Get toko info from database
            $toko = null;
            $tokoModel = $this->getTokoModel();
            if ($tokoModel) {
                try {
                    $toko = $tokoModel->getToko();
                } catch (\Exception $e) {
                    log_message('error', 'Error getting toko: ' . $e->getMessage());
                }
            }
            
            $data = [
                'toko' => $toko,
            ];
            
            echo view('layout/header');
            echo view('pages_user/chat_penjual', $data);
            echo view('layout/footer');
            return '';
        } catch (\Exception $e) {
            log_message('error', 'Error in Home::chatPenjual: ' . $e->getMessage());
            
            $data = [
                'toko' => null,
            ];
            
            echo view('layout/header');
            echo view('pages_user/chat_penjual', $data);
            echo view('layout/footer');
            return '';
        }
    }   

    public function cart(): string
    {
        echo view('layout/header');
        echo view('pages_user/cart');
        echo view('layout/footer');
        return '';
    }

    public function pesan(): string
    {
        echo view('layout/header');
        echo view('pages_user/pesan');
        echo view('layout/footer');
        return '';
    }

    public function profile(): string
    {
        try {
            $id_user = session()->get('id_user') ?? 1;
            
            // Log untuk debugging
            log_message('debug', 'Profile page - User ID: ' . $id_user);
            
            // Get user orders from database
            $pesananList = [];
            try {
                $pesananModel = new \App\Models\PesananModel();
                
                // Get all orders for this user (no limit, or increase limit)
                // Use direct query builder to ensure it works
                $db = \Config\Database::connect();
                $builder = $db->table('pesanan');
                $builder->where('id_user', $id_user);
                $builder->orderBy('tanggal_pesan', 'DESC');
                $pesananList = $builder->get()->getResultArray();
                
                // Convert to array format if needed
                if (!empty($pesananList)) {
                    $pesananList = array_map(function($item) {
                        return (array)$item;
                    }, $pesananList);
                }
                
                log_message('debug', 'Found ' . count($pesananList) . ' orders for user: ' . $id_user);
                if (count($pesananList) > 0) {
                    log_message('debug', 'First order ID: ' . $pesananList[0]['id_pesan']);
                }
                
                // Process orders to get product details
                $produkModel = $this->getProdukModel();
                $detailPesananModel = new \App\Models\DetailPesananModel();
                
                foreach ($pesananList as &$pesanan) {
                    // Get order details
                    try {
                        $details = $detailPesananModel->where('id_pesan', $pesanan['id_pesan'])->findAll();
                        
                        log_message('debug', 'Order ' . $pesanan['id_pesan'] . ' has ' . count($details) . ' detail items');
                        
                        if (!empty($details) && $produkModel) {
                            // Get first product for display
                            $firstDetail = $details[0];
                            $produk = $produkModel->find($firstDetail['id_produk']);
                            
                            if ($produk) {
                                // Process product image - use exact path from database
                                $gambar_utama = 'assets/img/gambarprd.png';
                                if (!empty($produk['gambar_produk'])) {
                                    $decoded = json_decode($produk['gambar_produk'], true);
                                    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded) && !empty($decoded)) {
                                        // Ambil gambar pertama, pastikan path tidak dimulai dengan slash
                                        $gambar_utama = ltrim($decoded[0], '/');
                                    } else {
                                        // Jika bukan JSON, gunakan path langsung
                                        $gambar_utama = ltrim($produk['gambar_produk'], '/');
                                    }
                                }
                                
                                $pesanan['produk_nama'] = $produk['nama_produk'];
                                $pesanan['produk_gambar'] = $gambar_utama;
                                
                                // If multiple products, show count
                                if (count($details) > 1) {
                                    $pesanan['produk_nama'] = $produk['nama_produk'] . ' +' . (count($details) - 1) . ' produk lainnya';
                                }
                            } else {
                                // Fallback if product not found
                                $pesanan['produk_nama'] = 'Produk tidak ditemukan';
                                $pesanan['produk_gambar'] = 'assets/img/gambarprd.png';
                            }
                        } else {
                            // No details found
                            $pesanan['produk_nama'] = 'Tidak ada detail pesanan';
                            $pesanan['produk_gambar'] = 'assets/img/gambarprd.png';
                        }
                    } catch (\Exception $e) {
                        log_message('error', 'Error getting order details for order ' . $pesanan['id_pesan'] . ': ' . $e->getMessage());
                        $pesanan['produk_nama'] = 'Error loading produk';
                        $pesanan['produk_gambar'] = 'assets/img/gambarprd.png';
                    }
                }
                unset($pesanan);
                
                log_message('debug', 'Processed ' . count($pesananList) . ' orders for display');
            } catch (\Exception $e) {
                log_message('error', 'Error getting pesanan: ' . $e->getMessage());
                log_message('error', 'Stack trace: ' . $e->getTraceAsString());
            }
            
            // Get user info (placeholder - should be from User model if available)
            $userInfo = [
                'nama' => 'Ahmad Pratama', // Default, should come from database
                'role' => 'Mahasiswa Aktif',
                'avatar' => 'assets/img/admin-avatar.png',
            ];
            
            // Get user addresses
            $alamatList = [];
            try {
                $alamatModel = new \App\Models\AlamatUserModel();
                $alamatList = $alamatModel->getAlamatByUser($id_user);
            } catch (\Exception $e) {
                log_message('error', 'Error getting alamat: ' . $e->getMessage());
            }
            
            // Ensure pesananList is always an array
            if (!is_array($pesananList)) {
                $pesananList = [];
            }
            
            // Log final data being sent to view
            log_message('debug', 'Sending to view - pesananList count: ' . count($pesananList));
            if (count($pesananList) > 0) {
                log_message('debug', 'First pesanan in list: ' . json_encode($pesananList[0]));
            }
            
            $data = [
                'user' => $userInfo,
                'pesananList' => $pesananList,
                'alamatList' => $alamatList,
            ];
            
            echo view('layout/header');
            echo view('pages_user/profile', $data);
            echo view('layout/footer');
            return '';
        } catch (\Exception $e) {
            log_message('error', 'Error in Home::profile: ' . $e->getMessage());
            
            $data = [
                'user' => [
                    'nama' => 'User',
                    'role' => 'Mahasiswa Aktif',
                    'avatar' => 'assets/img/admin-avatar.png',
                ],
                'pesananList' => [],
            ];
            
            echo view('layout/header');
            echo view('pages_user/profile', $data);
            echo view('layout/footer');
            return '';
        }
    }

    public function logout()
    {
        // Destroy session
        session()->destroy();
        
        // Redirect to home
        return redirect()->to(site_url('/'))->with('success', 'Anda telah berhasil logout');
    }

    public function kategori(): string
    {
        // Get category from URL parameter
        $kategoriParam = $this->request->getGet('kategori');
        $menuParam = $this->request->getGet('menu');
        
        // Get all active categories
        $kategoriList = [];
        $kategoriModel = $this->getKategoriModel();
        if ($kategoriModel) {
            try {
                $kategoriList = $kategoriModel->getKategoriAktif();
            } catch (\Exception $e) {
                log_message('error', 'Error getting kategori: ' . $e->getMessage());
            }
        }
        
        // Get selected category
        $selectedKategori = null;
        $selectedKategoriId = null;
        if ($kategoriParam && $kategoriModel) {
            try {
                // Try to find by ID first
                if (is_numeric($kategoriParam)) {
                    $selectedKategori = $kategoriModel->find($kategoriParam);
                    $selectedKategoriId = $kategoriParam;
                } else {
                    // Find by name (case-insensitive)
                    foreach ($kategoriList as $kat) {
                        if (strtolower($kat['nama_kategori']) === strtolower($kategoriParam)) {
                            $selectedKategori = $kat;
                            $selectedKategoriId = $kat['id_kategori'];
                            break;
                        }
                    }
                }
            } catch (\Exception $e) {
                log_message('error', 'Error finding kategori: ' . $e->getMessage());
            }
        }
        
        // Get menus for selected category
        $menuList = [];
        $menuModel = $this->getMenuModel();
        if ($selectedKategoriId && $menuModel) {
            try {
                $menuList = $menuModel->getMenuAktif($selectedKategoriId);
            } catch (\Exception $e) {
                log_message('error', 'Error getting menu: ' . $e->getMessage());
            }
        }
        
        // Get products for selected category/menu
        $produkList = [];
        $produkModel = $this->getProdukModel();
        if ($produkModel) {
            try {
                if ($selectedKategoriId) {
                    $builder = $produkModel->where('status_produk', 'aktif')
                        ->where('id_kategori', $selectedKategoriId);
                    
                    if ($menuParam && is_numeric($menuParam)) {
                        $builder->where('id_menu', $menuParam);
                    }
                    
                    $produkList = $builder->orderBy('created_at', 'DESC')->findAll();
                } else {
                    // If no category selected, show all active products
                    $produkList = $produkModel->where('status_produk', 'aktif')
                        ->orderBy('created_at', 'DESC')
                        ->findAll();
                }
            } catch (\Exception $e) {
                log_message('error', 'Error getting produk: ' . $e->getMessage());
            }
        }
        
        // Process product images
        foreach ($produkList as &$produk) {
            if (!empty($produk['gambar_produk'])) {
                $decoded = json_decode($produk['gambar_produk'], true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded) && !empty($decoded)) {
                    $produk['gambar_utama'] = $decoded[0];
                } else {
                    // Fallback: jika bukan JSON, anggap sebagai single image
                    $produk['gambar_utama'] = $produk['gambar_produk'];
                }
            } else {
                $produk['gambar_utama'] = 'assets/img/gambarprd.png';
            }
            
            $produk['harga_display'] = $produk['harga_setelah_diskon'] > 0 
                ? $produk['harga_setelah_diskon'] 
                : $produk['harga_awal'];
        }
        
        // Get active promo
        $promoAktif = [];
        $tokoModel = $this->getTokoModel();
        $promoModel = $this->getPromoModel();
        if ($tokoModel && $promoModel) {
            try {
                $toko = $tokoModel->getToko();
                $id_toko = $toko ? $toko['id_toko'] : null;
                $promoAktif = $promoModel->getPromoAktif($id_toko);
            } catch (\Exception $e) {
                log_message('error', 'Error getting promo: ' . $e->getMessage());
            }
        }
        
        $data = [
            'kategoriList' => $kategoriList,
            'selectedKategori' => $selectedKategori,
            'selectedKategoriId' => $selectedKategoriId,
            'menuList' => $menuList,
            'selectedMenu' => $menuParam,
            'produk' => $produkList,
            'promoAktif' => $promoAktif,
        ];
        
        echo view('layout/header');
        echo view('pages_user/kategori', $data);
        echo view('layout/footer');
        return '';
    }
}