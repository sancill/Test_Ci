<?php

namespace App\Controllers;

use App\Models\TokoModel;
use App\Models\ProdukModel;
use App\Models\KategoriModel;
use App\Models\MenuModel;
use App\Models\PromoModel;
use App\Models\PesananModel;
use App\Models\DetailPesananModel;
use App\Models\PesananStatusLogModel;

class Admin extends BaseController
{
    protected $tokoModel;
    protected $produkModel;
    protected $kategoriModel;
    protected $menuModel;
    protected $promoModel;
    protected $pesananModel;
    protected $detailPesananModel;

    public function __construct()
    {
        $this->tokoModel = new TokoModel();
        $this->produkModel = new ProdukModel();
        $this->kategoriModel = new KategoriModel();
        $this->menuModel = new MenuModel();
        $this->promoModel = new PromoModel();
        $this->pesananModel = new PesananModel();
        $this->detailPesananModel = new DetailPesananModel();
    }

    public function dashboard(): string
    {
        // Get toko ID
        $toko = $this->tokoModel->getToko();
        $id_toko = $toko ? $toko['id_toko'] : null;
        
        // Get statistics
        $totalProduk = $id_toko ? $this->produkModel->where('id_toko', $id_toko)->countAllResults() : $this->produkModel->countAllResults();
        $totalOrders = $this->pesananModel->countAllResults();
        
        // Get total revenue (sum of total_bayar from completed orders)
        $builder = $this->pesananModel->db->table('pesanan');
        $builder->selectSum('total_bayar');
        $builder->where('status_pesanan', 'Selesai');
        $revenueResult = $builder->get()->getRowArray();
        $totalRevenue = $revenueResult['total_bayar'] ?? 0;
        
        // Get recent products (limit 4)
        $produkList = $this->produkModel->getProduk($id_toko);
        $produkRecent = array_slice($produkList, 0, 4);
        
        // Get categories with product count
        $kategoriList = $this->kategoriModel->getAllKategori();
        foreach ($kategoriList as &$kategori) {
            $kategori['jumlah_produk'] = $this->produkModel->where('id_kategori', $kategori['id_kategori'])->countAllResults();
        }
        // Limit to 2 categories for display
        $kategoriRecent = array_slice($kategoriList, 0, 2);
        
        // Get order stats
        $orderStats = $this->pesananModel->getOrderStats();
        
        // Calculate percentage changes (simplified - you can enhance this with date comparisons)
        // For now, we'll just show static badges
        
        $data = [
            'totalProduk' => $totalProduk,
            'totalOrders' => $totalOrders,
            'totalRevenue' => $totalRevenue,
            'produkRecent' => $produkRecent,
            'kategoriRecent' => $kategoriRecent,
            'orderStats' => $orderStats,
        ];
        
        return view('pages_admin/dashboard', $data);
    }

    public function produk(): string
    {
        // Get toko ID (assuming single store for now)
        $toko = $this->tokoModel->getToko();
        $id_toko = $toko ? $toko['id_toko'] : null;

        // Get filter parameters
        $search = $this->request->getGet('search');
        $kategori = $this->request->getGet('kategori');
        $menu = $this->request->getGet('menu');
        $status = $this->request->getGet('status');

        // Get products with filters
        $produkList = $this->produkModel->getProduk($id_toko);
        
        // Apply filters
        if ($search) {
            $produkList = array_filter($produkList, function($p) use ($search) {
                return stripos($p['nama_produk'], $search) !== false || 
                       stripos($p['sku'] ?? '', $search) !== false;
            });
        }
        if ($kategori && $kategori !== 'all') {
            $produkList = array_filter($produkList, function($p) use ($kategori) {
                return $p['id_kategori'] == $kategori;
            });
        }
        if ($menu && $menu !== 'all') {
            $produkList = array_filter($produkList, function($p) use ($menu) {
                return $p['id_menu'] == $menu;
            });
        }
        if ($status && $status !== 'all') {
            $produkList = array_filter($produkList, function($p) use ($status) {
                return $p['status_produk'] == $status;
            });
        }

        // Re-index array after filtering
        $produkList = array_values($produkList);

        // Get total count
        $totalProduk = $id_toko ? $this->produkModel->countProdukByToko($id_toko) : count($produkList);

        // Handle edit mode
        $editId = $this->request->getGet('edit');
        $produkEdit = null;
        $menuByKategori = [];
        if ($editId) {
            $produkEdit = $this->produkModel->getProdukById($editId);
            if ($produkEdit) {
                // Load menu by kategori untuk edit mode
                if (!empty($produkEdit['id_kategori'])) {
                    $menuByKategori = $this->menuModel->getMenuAktif($produkEdit['id_kategori']);
                }
                // Load varian produk dengan decode gambar_varian
                $produkVarianModel = new \App\Models\ProdukVarianModel();
                $varianList = $produkVarianModel->getVarianByProduk($editId);
                // Decode gambar_varian JSON untuk setiap varian
                foreach ($varianList as &$varian) {
                    if (!empty($varian['gambar_varian'])) {
                        $decoded = json_decode($varian['gambar_varian'], true);
                        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                            $varian['gambar_varian'] = $decoded;
                        } else {
                            $varian['gambar_varian'] = [];
                        }
                    } else {
                        $varian['gambar_varian'] = [];
                    }
                }
                $produkEdit['varian'] = $varianList;
                // Decode JSON images to array
                if (!empty($produkEdit['gambar_produk'])) {
                    $decoded = json_decode($produkEdit['gambar_produk'], true);
                    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                        $produkEdit['fotos'] = array_map(function($path) {
                            return ['foto_produk' => $path];
                        }, $decoded);
                    } else {
                        // Fallback: jika bukan JSON, anggap sebagai single image
                        $produkEdit['fotos'] = [['foto_produk' => $produkEdit['gambar_produk']]];
                    }
                } else {
                    $produkEdit['fotos'] = [];
                }
            }
        }

        // Get all menus grouped by kategori for form population
        $allMenus = $this->menuModel->getAllMenu();
        $menusByKategoriId = [];
        foreach ($allMenus as $menuItem) {
            $katId = $menuItem['id_kategori'];
            if (!isset($menusByKategoriId[$katId])) {
                $menusByKategoriId[$katId] = [];
            }
            $menusByKategoriId[$katId][] = $menuItem;
        }

        $data = [
            'produk' => $produkList,
            'kategori' => $this->kategoriModel->getKategoriAktif(),
            'menu' => $this->menuModel->getAllMenu(),
            'menusByKategoriId' => $menusByKategoriId,
            'menuByKategori' => $menuByKategori,
            'promo' => $this->promoModel->getPromoAktif($id_toko),
            'totalProduk' => $totalProduk,
            'search' => $search,
            'filterKategori' => $kategori,
            'filterMenu' => $menu,
            'filterStatus' => $status,
            'produkEdit' => $produkEdit,
            'editId' => $editId,
        ];

        return view('pages_admin/produk', $data);
    }

    public function kategori(): string
    {
        $kategori = $this->kategoriModel->getAllKategori();
        $totalKategori = count($kategori);
        
        // Count products per category
        $produkModel = new \App\Models\ProdukModel();
        $kategoriEdit = null;
        $editId = $this->request->getGet('edit');
        
        if ($editId) {
            $kategoriEdit = $this->kategoriModel->find($editId);
        }
        
        foreach ($kategori as &$kat) {
            $kat['jumlah_produk'] = $produkModel->where('id_kategori', $kat['id_kategori'])->countAllResults();
            // Ensure icon_kategori path is available
            if (!empty($kat['icon_kategori']) && !str_starts_with($kat['icon_kategori'], 'uploads/')) {
                $kat['icon_kategori'] = 'uploads/kategori/' . basename($kat['icon_kategori']);
            }
        }

        $data = [
            'kategori' => $kategori,
            'totalKategori' => $totalKategori,
            'kategoriEdit' => $kategoriEdit,
            'editId' => $editId,
        ];

        return view('pages_admin/kategori', $data);
    }

    public function simpan_kategori()
    {
        $rules = [
            'nama_kategori' => 'required|min_length[2]|max_length[100]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Get all post data with trimming
        $nama_kategori = trim($this->request->getPost('nama_kategori'));
        $deskripsi_kategori = trim($this->request->getPost('deskripsi_kategori')) ?: null;
        $status = $this->request->getPost('status') ?: 'aktif';
        
        if (empty($nama_kategori)) {
            return redirect()->back()->withInput()->with('error', 'Nama kategori tidak boleh kosong');
        }
        
        $data = [
            'nama_kategori' => $nama_kategori,
            'deskripsi_kategori' => $deskripsi_kategori,
            'status' => $status,
        ];

        // Handle icon upload
        $iconFile = $this->request->getFile('icon_kategori');
        if ($iconFile && $iconFile->isValid() && !$iconFile->hasMoved()) {
            // Ensure directory exists
            $uploadPath = ROOTPATH . 'public/uploads/kategori';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            $newName = $iconFile->getRandomName();
            if ($iconFile->move($uploadPath, $newName)) {
                $data['icon_kategori'] = 'uploads/kategori/' . $newName;
            }
        }

        try {
            $insertId = $this->kategoriModel->insert($data);
            if ($insertId) {
                return redirect()->to('admin/kategori')->with('success', 'Kategori berhasil ditambahkan');
            } else {
                $errors = $this->kategoriModel->errors();
                $errorMsg = !empty($errors) ? implode(', ', $errors) : 'Gagal menyimpan kategori';
                return redirect()->back()->withInput()->with('error', $errorMsg);
            }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function update_kategori($id)
    {
        $rules = [
            'nama_kategori' => 'required|min_length[2]|max_length[100]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nama_kategori' => $this->request->getPost('nama_kategori'),
            'deskripsi_kategori' => $this->request->getPost('deskripsi_kategori') ?? null,
            'status' => $this->request->getPost('status') ?? 'aktif',
        ];

        // Handle icon upload
        $iconFile = $this->request->getFile('icon_kategori');
        if ($iconFile && $iconFile->isValid() && !$iconFile->hasMoved()) {
            // Ensure directory exists
            $uploadPath = ROOTPATH . 'public/uploads/kategori';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            // Delete old icon if exists
            $existing = $this->kategoriModel->find($id);
            if ($existing && !empty($existing['icon_kategori'])) {
                $oldIconPath = ROOTPATH . 'public/' . $existing['icon_kategori'];
                if (file_exists($oldIconPath)) {
                    @unlink($oldIconPath);
                }
            }
            
            $newName = $iconFile->getRandomName();
            if ($iconFile->move($uploadPath, $newName)) {
                $data['icon_kategori'] = 'uploads/kategori/' . $newName;
            }
        }

        try {
            if ($this->kategoriModel->update($id, $data)) {
                return redirect()->to('admin/kategori')->with('success', 'Kategori berhasil diupdate');
            } else {
                $errors = $this->kategoriModel->errors();
                $errorMsg = !empty($errors) ? implode(', ', $errors) : 'Gagal mengupdate kategori';
                return redirect()->back()->withInput()->with('error', $errorMsg);
            }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function hapus_kategori($id)
    {
        if ($this->kategoriModel->delete($id)) {
            return redirect()->to('admin/kategori')->with('success', 'Kategori berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus kategori');
        }
    }

    public function menu(): string
    {
        $menu = $this->menuModel->getAllMenu();
        $kategori = $this->kategoriModel->getAllKategori();
        $totalMenu = count($menu);
        
        // Count products per menu
        $produkModel = new \App\Models\ProdukModel();
        foreach ($menu as &$m) {
            $m['jumlah_produk'] = $produkModel->where('id_menu', $m['id_menu'])->countAllResults();
        }

        $data = [
            'menu' => $menu,
            'kategori' => $kategori,
            'totalMenu' => $totalMenu,
        ];

        return view('pages_admin/menu', $data);
    }

    public function simpan_menu()
    {
        $validation = \Config\Services::validation();
        
        $rules = [
            'nama_menu' => 'required|min_length[2]|max_length[100]',
            'id_kategori' => 'required|numeric',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'id_kategori' => (int) $this->request->getPost('id_kategori'),
            'nama_menu' => $this->request->getPost('nama_menu'),
            'deskripsi_menu' => $this->request->getPost('deskripsi_menu'),
            'status' => $this->request->getPost('status') ?? 'aktif',
        ];

        if ($this->menuModel->insert($data)) {
            return redirect()->to('admin/menu')->with('success', 'Menu berhasil ditambahkan');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan menu');
        }
    }

    public function update_menu($id)
    {
        $validation = \Config\Services::validation();
        
        $rules = [
            'nama_menu' => 'required|min_length[2]|max_length[100]',
            'id_kategori' => 'required|numeric',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'id_kategori' => (int) $this->request->getPost('id_kategori'),
            'nama_menu' => $this->request->getPost('nama_menu'),
            'deskripsi_menu' => $this->request->getPost('deskripsi_menu'),
            'status' => $this->request->getPost('status') ?? 'aktif',
        ];

        if ($this->menuModel->update($id, $data)) {
            return redirect()->to('admin/menu')->with('success', 'Menu berhasil diupdate');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal mengupdate menu');
        }
    }

    public function hapus_menu($id)
    {
        if ($this->menuModel->delete($id)) {
            return redirect()->to('admin/menu')->with('success', 'Menu berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus menu');
        }
    }

    public function orders()
    {
        try {
            // Get filters
            $search = $this->request->getGet('search');
            $status = $this->request->getGet('status');
            $tanggalDari = $this->request->getGet('tanggal_dari');
            $tanggalSampai = $this->request->getGet('tanggal_sampai');

            $filters = [
                'search' => $search,
                'status' => $status ?? 'all',
                'tanggal_dari' => $tanggalDari,
                'tanggal_sampai' => $tanggalSampai,
            ];

            // Get orders with filters
            $orders = $this->pesananModel->getAllPesanan($filters);
            
            // Get order statistics
            $stats = $this->pesananModel->getOrderStats();

            // Get order details for each order
            if (!empty($orders)) {
                foreach ($orders as &$order) {
                    try {
                        $order['details'] = $this->detailPesananModel->getDetailByPesanan($order['id_pesan']);
                    } catch (\Exception $e) {
                        log_message('error', 'Error getting order details: ' . $e->getMessage());
                        $order['details'] = [];
                    }
                }
            }

            $data = [
                'orders' => $orders ?? [],
                'stats' => $stats ?? [
                    'Diproses' => 0,
                    'Dikirim' => 0,
                    'Selesai' => 0,
                    'Dibatalkan' => 0,
                    'total' => 0
                ],
                'filters' => $filters,
            ];

            return view('pages_admin/orders', $data);
        } catch (\Exception $e) {
            log_message('error', 'Error in orders method: ' . $e->getMessage());
            log_message('error', 'Stack trace: ' . $e->getTraceAsString());
            
            // Return view dengan data kosong jika error
            return view('pages_admin/orders', [
                'orders' => [],
                'stats' => [
                    'Diproses' => 0,
                    'Dikirim' => 0,
                    'Selesai' => 0,
                    'Dibatalkan' => 0,
                    'total' => 0
                ],
                'filters' => [
                    'search' => '',
                    'status' => 'all',
                    'tanggal_dari' => '',
                    'tanggal_sampai' => ''
                ],
                'error_message' => 'Terjadi kesalahan saat memuat data pesanan. Pastikan database sudah di-update dengan migration.'
            ]);
        }
    }

    public function update_status_pesanan($id)
    {
        $statusBaru = $this->request->getPost('status_pesanan');
        $keterangan = $this->request->getPost('keterangan');

        if (!$id || !$statusBaru) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'ID pesanan dan status harus diisi'
            ]);
        }

        // Validasi status
        $validStatuses = ['Diproses', 'Dikirim', 'Selesai', 'Dibatalkan'];
        if (!in_array($statusBaru, $validStatuses)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Status tidak valid'
            ]);
        }

        // Get admin ID (bisa dari session)
        $adminId = session()->get('admin_id') ?? null;

        // Update status dengan logging
        $result = $this->pesananModel->updateStatus($id, $statusBaru, $adminId, $keterangan);

        if ($result) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Status pesanan berhasil diupdate'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal mengupdate status pesanan'
            ]);
        }
    }

    public function invoice_pesanan($id)
    {
        $pesanan = $this->pesananModel->getPesananById($id);
        if (!$pesanan) {
            return redirect()->to(site_url('admin/orders'))->with('error', 'Pesanan tidak ditemukan');
        }

        $details = $this->detailPesananModel->getDetailByPesanan($id);
        $toko = $this->tokoModel->getToko();

        $data = [
            'pesanan' => $pesanan,
            'details' => $details,
            'toko' => $toko,
        ];

        return view('pages_admin/invoice', $data);
    }

    public function riwayat_status($id)
    {
        $logModel = new PesananStatusLogModel();
        $logs = $logModel->getLogByPesanan($id);

        return $this->response->setJSON([
            'success' => true,
            'logs' => $logs
        ]);
    }

    public function promo()
    {
        $toko = $this->tokoModel->getToko();
        $id_toko = $toko ? $toko['id_toko'] : null;
        
        // Get edit ID if exists
        $editId = $this->request->getGet('edit');
        $promoEdit = null;
        
        if ($editId) {
            $promoEdit = $this->promoModel->getPromoById($editId);
        }
        
        // Get all promos
        $promos = $this->promoModel->getAllPromo($id_toko);
        
        // Get active promos count
        $promoAktif = $this->promoModel->getPromoAktif($id_toko);
        
        $data = [
            'promos' => $promos,
            'promoAktif' => $promoAktif,
            'promoEdit' => $promoEdit,
            'editId' => $editId,
            'kategori' => $this->kategoriModel->getKategoriAktif(),
            'menu' => $this->menuModel->getAllMenu(),
            'produk' => $this->produkModel->getProduk($id_toko),
        ];
        
        return view('pages_admin/promo', $data);
    }

    public function simpan_promo()
    {
        try {
            $toko = $this->tokoModel->getToko();
            $id_toko = $toko ? $toko['id_toko'] : 1;
            
            // Validate required fields
            $validation = \Config\Services::validation();
            $rules = [
                'nama_promo' => 'required|min_length[3]|max_length[255]',
                'tipe_promo' => 'required|in_list[flash_sale,diskon_bundling,voucher]',
                'tipe_diskon' => 'required|in_list[persentase,nominal]',
                'nilai_diskon' => 'required|numeric|greater_than[0]',
                'tanggal_mulai' => 'required|valid_date',
                'tanggal_berakhir' => 'required|valid_date',
                'target_tipe' => 'required|in_list[produk,kategori,menu]',
            ];
            
            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }
            
            // Get form data
            $targetTipe = $this->request->getPost('target_tipe');
            $targetProduk = [];
            $targetKategori = [];
            $targetMenu = [];
            
            // Process target based on type
            if ($targetTipe === 'produk') {
                $targetProduk = $this->request->getPost('target_produk') ?: [];
                if (is_string($targetProduk)) {
                    $targetProduk = json_decode($targetProduk, true) ?: [];
                }
            } elseif ($targetTipe === 'kategori') {
                $targetKategori = $this->request->getPost('target_kategori') ?: [];
                if (is_string($targetKategori)) {
                    $targetKategori = json_decode($targetKategori, true) ?: [];
                }
            } elseif ($targetTipe === 'menu') {
                $targetMenu = $this->request->getPost('target_menu') ?: [];
                if (is_string($targetMenu)) {
                    $targetMenu = json_decode($targetMenu, true) ?: [];
                }
            }
            
            // Generate voucher code if voucher type
            $kodeVoucher = null;
            if ($this->request->getPost('tipe_promo') === 'voucher') {
                $kodeVoucher = $this->request->getPost('kode_voucher') ?: strtoupper(substr(md5(uniqid()), 0, 8));
            }
            
            $data = [
                'id_toko' => $id_toko,
                'nama_promo' => $this->request->getPost('nama_promo'),
                'tipe_promo' => $this->request->getPost('tipe_promo'),
                'tipe_diskon' => $this->request->getPost('tipe_diskon'),
                'nilai_diskon' => (float) $this->request->getPost('nilai_diskon'),
                'tanggal_mulai' => $this->request->getPost('tanggal_mulai'),
                'tanggal_berakhir' => $this->request->getPost('tanggal_berakhir'),
                'target_tipe' => $targetTipe,
                'target_produk' => !empty($targetProduk) ? json_encode($targetProduk) : null,
                'target_kategori' => !empty($targetKategori) ? json_encode($targetKategori) : null,
                'target_menu' => !empty($targetMenu) ? json_encode($targetMenu) : null,
                'deskripsi_promo' => $this->request->getPost('deskripsi_promo'),
                'limit_stok' => $this->request->getPost('limit_stok') ? (int) $this->request->getPost('limit_stok') : null,
                'kode_voucher' => $kodeVoucher,
                'status' => 'aktif',
            ];
            
            // Insert promo
            $id_promo = $this->promoModel->insert($data);
            
            if ($id_promo === false) {
                $errors = $this->promoModel->errors();
                return redirect()->back()->withInput()->with('error', 'Gagal menyimpan promo: ' . implode(', ', $errors));
            }
            
            return redirect()->to(site_url('admin/promo'))->with('success', 'Promo berhasil ditambahkan');
            
        } catch (\Exception $e) {
            log_message('error', 'Error in simpan_promo: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan promo: ' . $e->getMessage());
        }
    }

    public function update_promo($id)
    {
        try {
            if (!$id) {
                return redirect()->to(site_url('admin/promo'))->with('error', 'ID promo tidak valid');
            }
            
            // Validate required fields
            $validation = \Config\Services::validation();
            $rules = [
                'nama_promo' => 'required|min_length[3]|max_length[255]',
                'tipe_promo' => 'required|in_list[flash_sale,diskon_bundling,voucher]',
                'tipe_diskon' => 'required|in_list[persentase,nominal]',
                'nilai_diskon' => 'required|numeric|greater_than[0]',
                'tanggal_mulai' => 'required|valid_date',
                'tanggal_berakhir' => 'required|valid_date',
                'target_tipe' => 'required|in_list[produk,kategori,menu]',
            ];
            
            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }
            
            // Get form data
            $targetTipe = $this->request->getPost('target_tipe');
            $targetProduk = [];
            $targetKategori = [];
            $targetMenu = [];
            
            // Process target based on type
            if ($targetTipe === 'produk') {
                $targetProduk = $this->request->getPost('target_produk') ?: [];
                if (is_string($targetProduk)) {
                    $targetProduk = json_decode($targetProduk, true) ?: [];
                }
            } elseif ($targetTipe === 'kategori') {
                $targetKategori = $this->request->getPost('target_kategori') ?: [];
                if (is_string($targetKategori)) {
                    $targetKategori = json_decode($targetKategori, true) ?: [];
                }
            } elseif ($targetTipe === 'menu') {
                $targetMenu = $this->request->getPost('target_menu') ?: [];
                if (is_string($targetMenu)) {
                    $targetMenu = json_decode($targetMenu, true) ?: [];
                }
            }
            
            $data = [
                'nama_promo' => $this->request->getPost('nama_promo'),
                'tipe_promo' => $this->request->getPost('tipe_promo'),
                'tipe_diskon' => $this->request->getPost('tipe_diskon'),
                'nilai_diskon' => (float) $this->request->getPost('nilai_diskon'),
                'tanggal_mulai' => $this->request->getPost('tanggal_mulai'),
                'tanggal_berakhir' => $this->request->getPost('tanggal_berakhir'),
                'target_tipe' => $targetTipe,
                'target_produk' => !empty($targetProduk) ? json_encode($targetProduk) : null,
                'target_kategori' => !empty($targetKategori) ? json_encode($targetKategori) : null,
                'target_menu' => !empty($targetMenu) ? json_encode($targetMenu) : null,
                'deskripsi_promo' => $this->request->getPost('deskripsi_promo'),
                'limit_stok' => $this->request->getPost('limit_stok') ? (int) $this->request->getPost('limit_stok') : null,
                'kode_voucher' => $this->request->getPost('kode_voucher'),
            ];
            
            // Update promo
            if (!$this->promoModel->update($id, $data)) {
                $errors = $this->promoModel->errors();
                return redirect()->back()->withInput()->with('error', 'Gagal mengupdate promo: ' . implode(', ', $errors));
            }
            
            return redirect()->to(site_url('admin/promo'))->with('success', 'Promo berhasil diupdate');
            
        } catch (\Exception $e) {
            log_message('error', 'Error in update_promo: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat mengupdate promo: ' . $e->getMessage());
        }
    }

    public function hapus_promo($id)
    {
        if (!$id) {
            return redirect()->to(site_url('admin/promo'))->with('error', 'ID promo tidak valid');
        }
        
        if ($this->promoModel->delete($id)) {
            return redirect()->to(site_url('admin/promo'))->with('success', 'Promo berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus promo');
        }
    }

    public function toggle_status_promo($id)
    {
        if (!$id) {
            return redirect()->to(site_url('admin/promo'))->with('error', 'ID promo tidak valid');
        }
        
        $promo = $this->promoModel->find($id);
        if (!$promo) {
            return redirect()->to(site_url('admin/promo'))->with('error', 'Promo tidak ditemukan');
        }
        
        $newStatus = $promo['status'] === 'aktif' ? 'tidak_aktif' : 'aktif';
        
        if ($this->promoModel->update($id, ['status' => $newStatus])) {
            return redirect()->to(site_url('admin/promo'))->with('success', 'Status promo berhasil diubah');
        } else {
            return redirect()->back()->with('error', 'Gagal mengubah status promo');
        }
    }

    public function profile_toko(): string
    {
        $toko = $this->tokoModel->getToko();
        if (!$toko) {
            // Jika belum ada data, buat data default
            $toko = [];
        }
        
        // Get toko ID
        $id_toko = $toko ? $toko['id_toko'] : null;
        
        // Get statistics from database
        $totalProduk = $id_toko ? $this->produkModel->where('id_toko', $id_toko)->countAllResults() : $this->produkModel->countAllResults();
        $totalPenjualan = $this->pesananModel->where('status_pesanan', 'Selesai')->countAllResults();
        
        // Get total revenue
        $builder = $this->pesananModel->db->table('pesanan');
        $builder->selectSum('total_bayar');
        $builder->where('status_pesanan', 'Selesai');
        $revenueResult = $builder->get()->getRowArray();
        $totalRevenue = $revenueResult['total_bayar'] ?? 0;
        
        // Merge statistics to toko array
        if ($toko) {
            $toko['total_produk'] = $totalProduk;
            $toko['total_penjualan'] = $totalPenjualan;
            $toko['pendapatan'] = $totalRevenue;
            // Rating and total_ulasan, total_pengikut tetap dari database toko jika ada
        }
        
        return view('pages_admin/profile_toko', ['toko' => $toko]);
    }

    public function setting_toko(): string
    {
        $toko = $this->tokoModel->getToko();
        if (!$toko) {
            $toko = [];
        }
        return view('pages_admin/setting_toko', ['toko' => $toko]);
    }

    public function update_toko()
    {
        $validation = \Config\Services::validation();
        
        $rules = [
            'nama_toko' => 'required|min_length[3]|max_length[255]',
            'email_admin' => 'valid_email',
            'email_cs' => 'valid_email',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'nama_toko' => $this->request->getPost('nama_toko'),
            'status_toko' => $this->request->getPost('status_toko') ?? 'verified_seller',
            'deskripsi_toko' => $this->request->getPost('deskripsi_toko'),
            'alamat_toko' => $this->request->getPost('alamat_toko'),
            'kota' => $this->request->getPost('kota'),
            'provinsi' => $this->request->getPost('provinsi'),
            'kode_pos' => $this->request->getPost('kode_pos'),
            'negara' => $this->request->getPost('negara') ?? 'Indonesia',
            'email_cs' => $this->request->getPost('email_cs'),
            'whatsapp_cs' => $this->request->getPost('whatsapp_cs'),
            'jam_operasional_buka' => $this->request->getPost('jam_operasional_buka'),
            'jam_operasional_tutup' => $this->request->getPost('jam_operasional_tutup'),
            'nama_admin' => $this->request->getPost('nama_admin'),
            'username_admin' => $this->request->getPost('username_admin'),
            'email_admin' => $this->request->getPost('email_admin'),
            'telepon_admin' => $this->request->getPost('telepon_admin'),
        ];

        // Handle file uploads - Consistent with produk upload
        $uploadPath = ROOTPATH . 'public/uploads/toko';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        $logoFile = $this->request->getFile('logo_toko');
        if ($logoFile && $logoFile->isValid() && !$logoFile->hasMoved() && $logoFile->getError() === UPLOAD_ERR_OK) {
            $newName = $logoFile->getRandomName();
            if ($logoFile->move($uploadPath, $newName)) {
                $data['logo_toko'] = 'uploads/toko/' . $newName;
            }
        }

        $bannerFile = $this->request->getFile('banner_toko');
        if ($bannerFile && $bannerFile->isValid() && !$bannerFile->hasMoved() && $bannerFile->getError() === UPLOAD_ERR_OK) {
            $newName = $bannerFile->getRandomName();
            if ($bannerFile->move($uploadPath, $newName)) {
                $data['banner_toko'] = 'uploads/toko/' . $newName;
            }
        }

        // Set default values if not provided
        if (empty($data['tanggal_bergabung'])) {
            $existing = $this->tokoModel->getToko();
            if (!$existing || empty($existing['tanggal_bergabung'])) {
                $data['tanggal_bergabung'] = date('Y-m-d');
            }
        }

        if ($this->tokoModel->saveToko($data)) {
            return redirect()->to('admin/setting_toko')->with('success', 'Data toko berhasil disimpan');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data toko');
        }
    }

    public function delete_toko($id = null)
    {
        if ($id === null) {
            $toko = $this->tokoModel->getToko();
            if ($toko) {
                $id = $toko['id_toko'];
            }
        }

        if ($id && $this->tokoModel->deleteToko($id)) {
            return redirect()->to('admin/profile_toko')->with('success', 'Data toko berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus data toko');
        }
    }


    public function simpan_produk()
    {
        try {
            $validation = \Config\Services::validation();
            
            $rules = [
                'nama_produk' => 'required|min_length[3]|max_length[255]',
                'harga_awal' => 'required|numeric|greater_than[0]',
                'stok' => 'required|numeric|greater_than_equal_to[0]',
                'id_kategori' => 'required|numeric',
                'id_menu' => 'permit_empty|numeric',
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }

            // Get toko ID
            $toko = $this->tokoModel->getToko();
            $id_toko = $toko ? $toko['id_toko'] : null;

            $harga_awal = (float) $this->request->getPost('harga_awal');
            $harga_diskon = (float) ($this->request->getPost('harga_diskon') ?? 0);
            $tipe_diskon = $this->request->getPost('tipe_diskon') ?? 'persentase';
            $id_promo = $this->request->getPost('id_promo') ? (int) $this->request->getPost('id_promo') : null;

            // Calculate harga setelah diskon
            $harga_setelah_diskon = $this->produkModel->calculateHargaSetelahDiskon(
                $harga_awal, 
                $harga_diskon, 
                $tipe_diskon
            );

            // Handle product images - Sesi 1: Gambar Inti (urutan 1, hanya 1 gambar)
            // Sesi 2: Gambar Pendukung (urutan 2, 3, 4, dst - multiple)
            $files = $this->request->getFiles();
            $gambarArray = [];
            
            // Ensure upload directory exists
            $uploadPath = ROOTPATH . 'public/uploads/produk';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            // Handle Gambar Inti (urutan 1) - hanya 1 file
            $gambarIntiFile = $this->request->getFile('gambar_inti');
            if ($gambarIntiFile && $gambarIntiFile->isValid() && !$gambarIntiFile->hasMoved() && $gambarIntiFile->getError() === UPLOAD_ERR_OK) {
                $newName = $gambarIntiFile->getRandomName();
                if ($gambarIntiFile->move($uploadPath, $newName)) {
                    $gambarArray[] = 'uploads/produk/' . $newName; // Urutan 1
                }
            }
            
            // Handle Gambar Pendukung (urutan 2+) - multiple files
            if (isset($files['gambar_pendukung']) && !empty($files['gambar_pendukung'])) {
                $fileArray = $files['gambar_pendukung'];
                if (is_array($fileArray)) {
                    foreach ($fileArray as $file) {
                        if ($file && is_object($file) && $file->isValid() && !$file->hasMoved() && $file->getError() === UPLOAD_ERR_OK) {
                            $newName = $file->getRandomName();
                            if ($file->move($uploadPath, $newName)) {
                                $gambarArray[] = 'uploads/produk/' . $newName; // Urutan 2, 3, 4, dst
                            }
                        }
                    }
                }
            }
            
            // Convert array to JSON string for storage
            $gambarProduk = !empty($gambarArray) ? json_encode($gambarArray) : null;

            $data = [
                'id_toko' => $id_toko,
                'nama_produk' => $this->request->getPost('nama_produk'),
                'deskripsi_produk' => $this->request->getPost('deskripsi_produk'),
                'gambar_produk' => $gambarProduk,
                'id_kategori' => (int) $this->request->getPost('id_kategori'),
                'id_menu' => $this->request->getPost('id_menu') ? (int) $this->request->getPost('id_menu') : null,
                'merek' => $this->request->getPost('merek'),
                'harga_awal' => $harga_awal,
                'harga_diskon' => $harga_diskon,
                'tipe_diskon' => $tipe_diskon,
                'id_promo' => $id_promo,
                'harga_setelah_diskon' => $harga_setelah_diskon,
                'stok' => (int) $this->request->getPost('stok'),
                'sku' => $this->request->getPost('sku'),
                'berat' => (int) ($this->request->getPost('berat') ?? 0),
                'status_produk' => $this->request->getPost('status_produk') ?? 'draft',
            ];

            // Insert product with image
            $id_produk = $this->produkModel->insert($data);
            
            // In CodeIgniter, insert() returns the insert ID on success, or false on failure
            if ($id_produk === false) {
                $errors = $this->produkModel->errors();
                return redirect()->back()->withInput()->with('error', 'Gagal menyimpan produk: ' . implode(', ', $errors));
            }

            // Images sudah disimpan sebagai JSON di gambar_produk, tidak perlu save ke produk_foto lagi

            // Save varian produk dengan gambar varian (Sesi 3)
            $varianData = $this->request->getPost('varian');
            if (!empty($varianData) && is_array($varianData)) {
                $produkVarianModel = new \App\Models\ProdukVarianModel();
                
                foreach ($varianData as $varianIndex => $varian) {
                    if (!empty($varian['nama_varian']) && !empty($varian['nilai_varian'])) {
                        // Handle gambar varian untuk varian ini
                        $gambarVarianArray = [];
                        if (isset($files['varian']) && isset($files['varian'][$varianIndex]['gambar_varian'])) {
                            $varianImageFiles = $files['varian'][$varianIndex]['gambar_varian'];
                            if (is_array($varianImageFiles)) {
                                foreach ($varianImageFiles as $varianFile) {
                                    if ($varianFile && is_object($varianFile) && $varianFile->isValid() && !$varianFile->hasMoved() && $varianFile->getError() === UPLOAD_ERR_OK) {
                                        $newName = $varianFile->getRandomName();
                                        if ($varianFile->move($uploadPath, $newName)) {
                                            $gambarVarianArray[] = 'uploads/produk/' . $newName;
                                        }
                                    }
                                }
                            }
                        }
                        
                        $produkVarianModel->insert([
                            'id_produk' => $id_produk,
                            'nama_varian' => $varian['nama_varian'],
                            'nilai_varian' => $varian['nilai_varian'],
                            'harga_tambahan' => (float) ($varian['harga_tambahan'] ?? 0),
                            'stok_varian' => (int) ($varian['stok_varian'] ?? 0),
                            'sku_varian' => $varian['sku_varian'] ?? null,
                            'gambar_varian' => !empty($gambarVarianArray) ? json_encode($gambarVarianArray) : null,
                        ]);
                    }
                }
            }

            // Redirect to product list with success message
            return redirect()->to(site_url('admin/produk'))->with('success', 'Produk berhasil ditambahkan');
            
        } catch (\Exception $e) {
            // Log the full error
            log_message('error', 'Error in simpan_produk: ' . $e->getMessage());
            log_message('error', 'Stack trace: ' . $e->getTraceAsString());
            
            // Return with error message
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan produk: ' . $e->getMessage());
        }
    }

    public function update_produk($id)
    {
        try {
            if (!$id) {
                return redirect()->to(site_url('admin/produk'))->with('error', 'ID produk tidak valid');
            }

            // Check if product exists
            $produkLama = $this->produkModel->find($id);
            if (!$produkLama) {
                return redirect()->to(site_url('admin/produk'))->with('error', 'Produk tidak ditemukan');
            }

            $validation = \Config\Services::validation();
            
            $rules = [
                'nama_produk' => 'required|min_length[3]|max_length[255]',
                'harga_awal' => 'required|numeric|greater_than[0]',
                'stok' => 'required|numeric|greater_than_equal_to[0]',
                'id_kategori' => 'required|numeric',
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }

            $harga_awal = (float) $this->request->getPost('harga_awal');
            $harga_diskon = (float) ($this->request->getPost('harga_diskon') ?? 0);
            $tipe_diskon = $this->request->getPost('tipe_diskon') ?? 'persentase';
            $id_promo = $this->request->getPost('id_promo') ? (int) $this->request->getPost('id_promo') : null;

            // Calculate harga setelah diskon
            $harga_setelah_diskon = $this->produkModel->calculateHargaSetelahDiskon(
                $harga_awal, 
                $harga_diskon, 
                $tipe_diskon
            );

            // Handle product images - Sesi 1: Gambar Inti, Sesi 2: Gambar Pendukung
            $files = $this->request->getFiles();
            $gambarLama = $produkLama['gambar_produk'] ?? null;
            
            // Decode existing images from JSON
            $existingImages = [];
            if (!empty($gambarLama)) {
                $decoded = json_decode($gambarLama, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    $existingImages = $decoded;
                } else {
                    // Fallback: jika bukan JSON, anggap sebagai single image
                    $existingImages = [$gambarLama];
                }
            }
            
            $gambarInti = !empty($existingImages[0]) ? $existingImages[0] : null;
            $gambarPendukung = count($existingImages) > 1 ? array_slice($existingImages, 1) : [];
            
            // Handle delete gambar inti
            $deleteGambarInti = $this->request->getPost('delete_gambar_inti');
            if (!empty($deleteGambarInti)) {
                $filePath = ROOTPATH . 'public/' . $deleteGambarInti;
                if (file_exists($filePath)) {
                    @unlink($filePath);
                }
                $gambarInti = null;
            }
            
            // Handle delete gambar pendukung
            $deleteImagesPendukung = $this->request->getPost('delete_images_pendukung');
            if (!empty($deleteImagesPendukung) && is_array($deleteImagesPendukung)) {
                foreach ($deleteImagesPendukung as $imgPath) {
                    $gambarPendukung = array_filter($gambarPendukung, function($path) use ($imgPath) {
                        return $path !== $imgPath;
                    });
                    $filePath = ROOTPATH . 'public/' . $imgPath;
                    if (file_exists($filePath)) {
                        @unlink($filePath);
                    }
                }
                $gambarPendukung = array_values($gambarPendukung);
            }
            
            // Handle upload gambar inti baru (menggantikan yang lama jika ada)
            $uploadPath = ROOTPATH . 'public/uploads/produk';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            $gambarIntiFile = $this->request->getFile('gambar_inti');
            if ($gambarIntiFile && $gambarIntiFile->isValid() && !$gambarIntiFile->hasMoved() && $gambarIntiFile->getError() === UPLOAD_ERR_OK) {
                // Delete old gambar inti if exists
                if ($gambarInti) {
                    $oldPath = ROOTPATH . 'public/' . $gambarInti;
                    if (file_exists($oldPath)) {
                        @unlink($oldPath);
                    }
                }
                $newName = $gambarIntiFile->getRandomName();
                if ($gambarIntiFile->move($uploadPath, $newName)) {
                    $gambarInti = 'uploads/produk/' . $newName;
                }
            }
            
            // Handle upload gambar pendukung baru (ditambahkan ke existing)
            if (isset($files['gambar_pendukung']) && !empty($files['gambar_pendukung'])) {
                $fileArray = $files['gambar_pendukung'];
                if (is_array($fileArray)) {
                    foreach ($fileArray as $file) {
                        if ($file && is_object($file) && $file->isValid() && !$file->hasMoved() && $file->getError() === UPLOAD_ERR_OK) {
                            $newName = $file->getRandomName();
                            if ($file->move($uploadPath, $newName)) {
                                $gambarPendukung[] = 'uploads/produk/' . $newName;
                            }
                        }
                    }
                }
            }
            
            // Combine gambar inti dan pendukung
            $gambarArray = [];
            if ($gambarInti) {
                $gambarArray[] = $gambarInti; // Urutan 1
            }
            $gambarArray = array_merge($gambarArray, $gambarPendukung); // Urutan 2+
            
            // Convert array to JSON string
            $gambarProduk = !empty($gambarArray) ? json_encode($gambarArray) : null;

            $data = [
                'nama_produk' => $this->request->getPost('nama_produk'),
                'deskripsi_produk' => $this->request->getPost('deskripsi_produk'),
                'gambar_produk' => $gambarProduk,
                'id_kategori' => (int) $this->request->getPost('id_kategori'),
                'id_menu' => $this->request->getPost('id_menu') ? (int) $this->request->getPost('id_menu') : null,
                'merek' => $this->request->getPost('merek'),
                'harga_awal' => $harga_awal,
                'harga_diskon' => $harga_diskon,
                'tipe_diskon' => $tipe_diskon,
                'id_promo' => $id_promo,
                'harga_setelah_diskon' => $harga_setelah_diskon,
                'stok' => (int) $this->request->getPost('stok'),
                'sku' => $this->request->getPost('sku'),
                'berat' => (int) ($this->request->getPost('berat') ?? 0),
                'status_produk' => $this->request->getPost('status_produk') ?? 'draft',
            ];

            // Update product
            if (!$this->produkModel->update($id, $data)) {
                return redirect()->back()->withInput()->with('error', 'Gagal mengupdate produk');
            }

            // Images sudah disimpan sebagai JSON di gambar_produk, tidak perlu save ke produk_foto lagi

            // Update varian produk
            $varianData = $this->request->getPost('varian');
            $produkVarianModel = new \App\Models\ProdukVarianModel();
            
            // Delete existing varian if no varian data or checkbox unchecked
            if (empty($varianData) || !is_array($varianData)) {
                $produkVarianModel->deleteByProduk($id);
            } else {
                // Get existing varian IDs
                $existingVarians = $produkVarianModel->where('id_produk', $id)->findAll();
                $existingIds = array_column($existingVarians, 'id_varian');
                $submittedIds = [];
                
                // Update or insert varian dengan gambar varian
                foreach ($varianData as $varianIndex => $varian) {
                    if (!empty($varian['nama_varian']) && !empty($varian['nilai_varian'])) {
                        // Handle gambar varian untuk varian ini
                        $gambarVarianArray = [];
                        $isUpdate = !empty($varian['id_varian']) && in_array($varian['id_varian'], $existingIds);
                        
                        if ($isUpdate) {
                            // Get existing gambar varian
                            $existingVarian = $produkVarianModel->find($varian['id_varian']);
                            if (!empty($existingVarian['gambar_varian'])) {
                                $decoded = json_decode($existingVarian['gambar_varian'], true);
                                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                                    $gambarVarianArray = $decoded;
                                }
                            }
                            
                            // Handle delete gambar varian
                            if (isset($varian['delete_images']) && is_array($varian['delete_images'])) {
                                foreach ($varian['delete_images'] as $imgPath) {
                                    $gambarVarianArray = array_filter($gambarVarianArray, function($path) use ($imgPath) {
                                        return $path !== $imgPath;
                                    });
                                    $filePath = ROOTPATH . 'public/' . $imgPath;
                                    if (file_exists($filePath)) {
                                        @unlink($filePath);
                                    }
                                }
                                $gambarVarianArray = array_values($gambarVarianArray);
                            }
                        }
                        
                        // Handle upload gambar varian baru
                        if (isset($files['varian']) && isset($files['varian'][$varianIndex]['gambar_varian'])) {
                            $varianImageFiles = $files['varian'][$varianIndex]['gambar_varian'];
                            if (is_array($varianImageFiles)) {
                                foreach ($varianImageFiles as $varianFile) {
                                    if ($varianFile && is_object($varianFile) && $varianFile->isValid() && !$varianFile->hasMoved() && $varianFile->getError() === UPLOAD_ERR_OK) {
                                        $newName = $varianFile->getRandomName();
                                        if ($varianFile->move($uploadPath, $newName)) {
                                            $gambarVarianArray[] = 'uploads/produk/' . $newName;
                                        }
                                    }
                                }
                            }
                        }
                        
                        $varianDataToSave = [
                            'id_produk' => $id,
                            'nama_varian' => $varian['nama_varian'],
                            'nilai_varian' => $varian['nilai_varian'],
                            'harga_tambahan' => (float) ($varian['harga_tambahan'] ?? 0),
                            'stok_varian' => (int) ($varian['stok_varian'] ?? 0),
                            'sku_varian' => $varian['sku_varian'] ?? null,
                            'gambar_varian' => !empty($gambarVarianArray) ? json_encode($gambarVarianArray) : null,
                        ];
                        
                        if ($isUpdate) {
                            // Update existing
                            $produkVarianModel->update($varian['id_varian'], $varianDataToSave);
                            $submittedIds[] = $varian['id_varian'];
                        } else {
                            // Insert new
                            $produkVarianModel->insert($varianDataToSave);
                        }
                    }
                }
                
                // Delete varian that are not in submitted data
                $toDelete = array_diff($existingIds, $submittedIds);
                if (!empty($toDelete)) {
                    foreach ($toDelete as $varianId) {
                        $produkVarianModel->delete($varianId);
                    }
                }
            }

            return redirect()->to(site_url('admin/produk'))->with('success', 'Produk berhasil diupdate');
        } catch (\Exception $e) {
            log_message('error', 'Error in update_produk: ' . $e->getMessage());
            log_message('error', 'Stack trace: ' . $e->getTraceAsString());
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat mengupdate produk: ' . $e->getMessage());
        }
    }

    public function hapus_produk($id)
    {
        if (!$id) {
            return redirect()->to(site_url('admin/produk'))->with('error', 'ID produk tidak valid');
        }

        // Get product to delete image files
        $produk = $this->produkModel->find($id);
        if ($produk && !empty($produk['gambar_produk'])) {
            // Decode JSON images
            $decoded = json_decode($produk['gambar_produk'], true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                // Delete all images in array
                foreach ($decoded as $imgPath) {
                    $filePath = ROOTPATH . 'public/' . $imgPath;
                    if (file_exists($filePath)) {
                        @unlink($filePath);
                    }
                }
            } else {
                // Fallback: single image (old format)
                $filePath = ROOTPATH . 'public/' . $produk['gambar_produk'];
                if (file_exists($filePath)) {
                    @unlink($filePath);
                }
            }
        }

        // Delete product
        if ($this->produkModel->delete($id)) {
            return redirect()->to(site_url('admin/produk'))->with('success', 'Produk berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus produk');
        }
    }

    public function preview_produk($id)
    {
        $produk = $this->produkModel->getProdukById($id);
        if (!$produk) {
            return redirect()->to(site_url('admin/produk'))->with('error', 'Produk tidak ditemukan');
        }

        $toko = $this->tokoModel->getToko();
        
        // Get multiple images from JSON gambar_produk (Gambar Inti + Pendukung)
        $fotos = [];
        if (!empty($produk['gambar_produk'])) {
            $decoded = json_decode($produk['gambar_produk'], true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                // Valid JSON array
                $fotos = array_map(function($path) {
                    return ['foto_produk' => $path];
                }, $decoded);
            } else {
                // Fallback: jika bukan JSON, anggap sebagai single image
                $fotos = [['foto_produk' => $produk['gambar_produk']]];
            }
        }

        // Get varian produk dengan gambar_varian
        $produkVarianModel = new \App\Models\ProdukVarianModel();
        $varianList = $produkVarianModel->getVarianByProduk($id);
        // Decode gambar_varian JSON untuk setiap varian dan hitung starting index
        $currentImageIndex = count($fotos); // Starting index untuk gambar varian
        $varianImageIndices = []; // Map varian ID ke starting index gambar
        
        foreach ($varianList as &$varian) {
            if (!empty($varian['gambar_varian'])) {
                $decoded = json_decode($varian['gambar_varian'], true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    $varian['gambar_varian'] = $decoded;
                    // Simpan starting index untuk varian ini
                    $varianImageIndices[$varian['id_varian']] = $currentImageIndex;
                    // Tambahkan gambar varian ke list semua foto
                    foreach ($decoded as $gambarPath) {
                        $fotos[] = ['foto_produk' => $gambarPath, 'is_variant' => true, 'varian_id' => $varian['id_varian']];
                    }
                    $currentImageIndex += count($decoded);
                } else {
                    $varian['gambar_varian'] = [];
                }
            } else {
                $varian['gambar_varian'] = [];
            }
        }

        $data = [
            'produk' => $produk,
            'toko' => $toko,
            'fotos' => $fotos, // Semua gambar: inti + pendukung + varian
            'varianList' => $varianList,
            'varianImageIndices' => $varianImageIndices, // Map varian ID ke starting index
        ];

        // Use the existing produk_detail view for preview
        echo view('layout/header');
        echo view('pages_user/produk_detail', $data);
        echo view('layout/footer');
        return '';
    }

    public function get_menu_by_kategori()
    {
        $id_kategori = $this->request->getGet('id_kategori');
        if (!$id_kategori) {
            return $this->response->setJSON([]);
        }

        $menu = $this->menuModel->getMenuAktif($id_kategori);
        return $this->response->setJSON($menu);
    }
}


