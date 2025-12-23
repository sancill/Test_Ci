<?php

namespace App\Models;

use CodeIgniter\Model;

class PromoModel extends Model
{
    protected $table            = 'promo';
    protected $primaryKey       = 'id_promo';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_toko', 'nama_promo', 'tipe_promo', 'tipe_diskon', 'nilai_diskon',
        'tanggal_mulai', 'tanggal_berakhir', 'target_tipe', 'target_produk', 
        'target_kategori', 'target_menu', 'deskripsi_promo', 'limit_stok', 
        'stok_terpakai', 'kode_voucher', 'total_penjualan', 'total_pesanan', 'status'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'nama_promo' => 'required|min_length[3]|max_length[255]',
        'nilai_diskon' => 'required|numeric',
        'tanggal_mulai' => 'required|valid_date',
        'tanggal_berakhir' => 'required|valid_date',
    ];

    // Get active promos
    public function getPromoAktif($id_toko = null)
    {
        $builder = $this->where('status', 'aktif');
        $builder->where('tanggal_mulai <=', date('Y-m-d H:i:s'));
        $builder->where('tanggal_berakhir >=', date('Y-m-d H:i:s'));
        
        if ($id_toko !== null) {
            $builder->where('id_toko', $id_toko);
        }
        
        return $builder->orderBy('tanggal_mulai', 'DESC')->findAll();
    }

    // Get all promos with statistics
    public function getAllPromo($id_toko = null)
    {
        $builder = $this->db->table($this->table);
        
        if ($id_toko !== null) {
            $builder->where('id_toko', $id_toko);
        }
        
        $builder->orderBy('created_at', 'DESC');
        $promos = $builder->get()->getResultArray();
        
        // Decode JSON fields and calculate stats
        foreach ($promos as &$promo) {
            // Decode target fields
            $promo['target_produk_array'] = !empty($promo['target_produk']) ? json_decode($promo['target_produk'], true) : [];
            $promo['target_kategori_array'] = !empty($promo['target_kategori']) ? json_decode($promo['target_kategori'], true) : [];
            $promo['target_menu_array'] = !empty($promo['target_menu']) ? json_decode($promo['target_menu'], true) : [];
            
            // Count target products
            $promo['jumlah_produk'] = $this->countTargetProduk($promo);
        }
        
        return $promos;
    }

    // Get promo by ID
    public function getPromoById($id)
    {
        $promo = $this->find($id);
        if ($promo) {
            $promo['target_produk_array'] = !empty($promo['target_produk']) ? json_decode($promo['target_produk'], true) : [];
            $promo['target_kategori_array'] = !empty($promo['target_kategori']) ? json_decode($promo['target_kategori'], true) : [];
            $promo['target_menu_array'] = !empty($promo['target_menu']) ? json_decode($promo['target_menu'], true) : [];
        }
        return $promo;
    }

    // Count target products based on target type
    public function countTargetProduk($promo)
    {
        $produkModel = new \App\Models\ProdukModel();
        $count = 0;
        
        if ($promo['target_tipe'] === 'produk' && !empty($promo['target_produk'])) {
            $targetIds = json_decode($promo['target_produk'], true);
            $count = is_array($targetIds) ? count($targetIds) : 0;
        } elseif ($promo['target_tipe'] === 'kategori' && !empty($promo['target_kategori'])) {
            $kategoriIds = json_decode($promo['target_kategori'], true);
            if (is_array($kategoriIds)) {
                foreach ($kategoriIds as $katId) {
                    $count += $produkModel->where('id_kategori', $katId)->countAllResults();
                }
            }
        } elseif ($promo['target_tipe'] === 'menu' && !empty($promo['target_menu'])) {
            $menuIds = json_decode($promo['target_menu'], true);
            if (is_array($menuIds)) {
                foreach ($menuIds as $menuId) {
                    $count += $produkModel->where('id_menu', $menuId)->countAllResults();
                }
            }
        }
        
        return $count;
    }

    // Get products affected by promo
    public function getProdukByPromo($promo)
    {
        $produkModel = new \App\Models\ProdukModel();
        $produkIds = [];
        
        if ($promo['target_tipe'] === 'produk' && !empty($promo['target_produk'])) {
            $produkIds = json_decode($promo['target_produk'], true);
        } elseif ($promo['target_tipe'] === 'kategori' && !empty($promo['target_kategori'])) {
            $kategoriIds = json_decode($promo['target_kategori'], true);
            if (is_array($kategoriIds)) {
                foreach ($kategoriIds as $katId) {
                    $produks = $produkModel->where('id_kategori', $katId)->findAll();
                    foreach ($produks as $p) {
                        $produkIds[] = $p['id_produk'];
                    }
                }
            }
        } elseif ($promo['target_tipe'] === 'menu' && !empty($promo['target_menu'])) {
            $menuIds = json_decode($promo['target_menu'], true);
            if (is_array($menuIds)) {
                foreach ($menuIds as $menuId) {
                    $produks = $produkModel->where('id_menu', $menuId)->findAll();
                    foreach ($produks as $p) {
                        $produkIds[] = $p['id_produk'];
                    }
                }
            }
        }
        
        return array_unique($produkIds);
    }

    // Update promo statistics
    public function updateStatistik($id_promo, $total_penjualan, $total_pesanan)
    {
        $promo = $this->find($id_promo);
        if ($promo) {
            $this->update($id_promo, [
                'total_penjualan' => ($promo['total_penjualan'] ?? 0) + $total_penjualan,
                'total_pesanan' => ($promo['total_pesanan'] ?? 0) + $total_pesanan,
            ]);
        }
    }
}

