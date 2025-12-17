<?php

namespace App\Controllers;

use App\Models\TokoModel;
use App\Models\ProdukModel;
use App\Models\KategoriModel;
use App\Models\MenuModel;
use App\Models\PromoModel;

class Admin extends BaseController
{
    protected $tokoModel;
    protected $produkModel;
    protected $kategoriModel;
    protected $menuModel;
    protected $promoModel;

    public function __construct()
    {
        $this->tokoModel = new TokoModel();
        $this->produkModel = new ProdukModel();
        $this->kategoriModel = new KategoriModel();
        $this->menuModel = new MenuModel();
        $this->promoModel = new PromoModel();
    }

    public function dashboard(): string
    {
        // Dashboard sudah lengkap dengan HTML, head, dan body
        return view('pages_admin/dashboard');
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

        $data = [
            'produk' => $produkList,
            'kategori' => $this->kategoriModel->getKategoriAktif(),
            'menu' => $this->menuModel->getAllMenu(),
            'promo' => $this->promoModel->getPromoAktif($id_toko),
            'totalProduk' => $totalProduk,
            'search' => $search,
            'filterKategori' => $kategori,
            'filterMenu' => $menu,
            'filterStatus' => $status,
        ];

        return view('pages_admin/produk', $data);
    }

    public function kategori(): string
    {
        $kategori = $this->kategoriModel->getAllKategori();
        $totalKategori = count($kategori);
        
        // Count products per category
        $produkModel = new \App\Models\ProdukModel();
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

    public function orders(): string
    {
        return view('pages_admin/orders');
    }

    public function promo(): string
    {
        return view('pages_admin/promo');
    }

    public function profile_toko(): string
    {
        $toko = $this->tokoModel->getToko();
        if (!$toko) {
            // Jika belum ada data, buat data default
            $toko = [];
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

        // Handle file uploads
        $logoFile = $this->request->getFile('logo_toko');
        if ($logoFile && $logoFile->isValid() && !$logoFile->hasMoved()) {
            $newName = $logoFile->getRandomName();
            $logoFile->move(ROOTPATH . 'public/uploads/toko', $newName);
            $data['logo_toko'] = 'uploads/toko/' . $newName;
        }

        $bannerFile = $this->request->getFile('banner_toko');
        if ($bannerFile && $bannerFile->isValid() && !$bannerFile->hasMoved()) {
            $newName = $bannerFile->getRandomName();
            $bannerFile->move(ROOTPATH . 'public/uploads/toko', $newName);
            $data['banner_toko'] = 'uploads/toko/' . $newName;
        }

        // Set default values if not provided
        if (empty($data['tanggal_bergabung'])) {
            $existing = $this->tokoModel->getToko();
            if (!$existing || empty($existing['tanggal_bergabung'])) {
                $data['tanggal_bergabung'] = date('Y-m-d');
            }
        }

        if ($this->tokoModel->saveToko($data)) {
            return redirect()->to('admin/profile_toko')->with('success', 'Data toko berhasil disimpan');
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

    public function customers(): string
    {
        return view('pages_admin/customers');
    }

    public function simpan_produk()
    {
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

        $data = [
            'id_toko' => $id_toko,
            'nama_produk' => $this->request->getPost('nama_produk'),
            'deskripsi_produk' => $this->request->getPost('deskripsi_produk'),
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

        // Insert product first
        $id_produk = $this->produkModel->insert($data);
        
        if (!$id_produk) {
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan produk');
        }

        // Handle product images
        $files = $this->request->getFiles();
        $uploadedFiles = [];
        
        // Ensure upload directory exists
        $uploadPath = ROOTPATH . 'public/uploads/produk';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }
        
        if (isset($files['gambar_produk'])) {
            $fileArray = $files['gambar_produk'];
            
            // Handle both single file and multiple files
            // In CodeIgniter, multiple files come as an array
            if (!is_array($fileArray)) {
                // Single file upload
                if ($fileArray->isValid() && !$fileArray->hasMoved()) {
                    $newName = $fileArray->getRandomName();
                    if ($fileArray->move($uploadPath, $newName)) {
                        $uploadedFiles[] = 'uploads/produk/' . $newName;
                    }
                }
            } else {
                // Multiple file uploads
                foreach ($fileArray as $file) {
                    // Skip empty file inputs (when user doesn't select a file)
                    if ($file && is_object($file) && $file->isValid() && !$file->hasMoved() && $file->getError() === UPLOAD_ERR_OK) {
                        $newName = $file->getRandomName();
                        if ($file->move($uploadPath, $newName)) {
                            $uploadedFiles[] = 'uploads/produk/' . $newName;
                        }
                    }
                }
            }
        }

        // Insert product images
        if (!empty($uploadedFiles)) {
            $fotoModel = new \App\Models\ProdukFotoModel();
            foreach ($uploadedFiles as $index => $foto) {
                $fotoModel->insert([
                    'id_produk' => $id_produk,
                    'foto_produk' => $foto,
                    'urutan' => $index + 1,
                ]);
            }
        }

        return redirect()->to('admin/produk')->with('success', 'Produk berhasil ditambahkan');
    }

    public function update_produk($id)
    {
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

        $data = [
            'nama_produk' => $this->request->getPost('nama_produk'),
            'deskripsi_produk' => $this->request->getPost('deskripsi_produk'),
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

        // Handle new product images
        $files = $this->request->getFiles();
        if (isset($files['gambar_produk']) && !empty($files['gambar_produk'])) {
            $uploadedFiles = [];
            foreach ($files['gambar_produk'] as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move(ROOTPATH . 'public/uploads/produk', $newName);
                    $uploadedFiles[] = 'uploads/produk/' . $newName;
                }
            }

            // Insert new product images
            if (!empty($uploadedFiles)) {
                $fotoModel = new \App\Models\ProdukFotoModel();
                $existingFotos = $this->produkModel->getProdukFoto($id);
                $maxUrutan = 0;
                if (!empty($existingFotos)) {
                    $maxUrutan = max(array_column($existingFotos, 'urutan'));
                }
                foreach ($uploadedFiles as $index => $foto) {
                    $fotoModel->insert([
                        'id_produk' => $id,
                        'foto_produk' => $foto,
                        'urutan' => $maxUrutan + $index + 1,
                    ]);
                }
            }
        }

        if ($this->produkModel->update($id, $data)) {
            return redirect()->to('admin/produk')->with('success', 'Produk berhasil diupdate');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal mengupdate produk');
        }
    }

    public function hapus_produk($id)
    {
        if ($this->produkModel->delete($id)) {
            return redirect()->to('admin/produk')->with('success', 'Produk berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus produk');
        }
    }

    public function preview_produk($id)
    {
        $produk = $this->produkModel->getProdukById($id);
        if (!$produk) {
            return redirect()->to('admin/produk')->with('error', 'Produk tidak ditemukan');
        }

        $fotos = $this->produkModel->getProdukFoto($id);
        $toko = $this->tokoModel->getToko();

        $data = [
            'produk' => $produk,
            'fotos' => $fotos,
            'toko' => $toko,
        ];

        // Use the existing produk.php view but with preview data
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

