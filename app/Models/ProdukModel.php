<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table            = 'produk';
    protected $primaryKey       = 'id_produk';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_toko', 'nama_produk', 'deskripsi_produk', 'gambar_produk', 'id_kategori', 'id_menu',
        'merek', 'harga_awal', 'harga_diskon', 'tipe_diskon', 'id_promo',
        'harga_setelah_diskon', 'stok', 'sku', 'berat', 'status_produk'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'nama_produk' => 'required|min_length[3]|max_length[255]',
        'harga_awal' => 'required|numeric',
        'stok' => 'required|numeric|greater_than_equal_to[0]',
    ];

    // Get all products with relations
    public function getProduk($id_toko = null)
    {
        $builder = $this->db->table($this->table . ' p');
        $builder->select('p.*, k.nama_kategori, m.nama_menu, pr.nama_promo');
        $builder->join('kategori k', 'k.id_kategori = p.id_kategori', 'left');
        $builder->join('menu m', 'm.id_menu = p.id_menu', 'left');
        $builder->join('promo pr', 'pr.id_promo = p.id_promo', 'left');
        
        if ($id_toko !== null) {
            $builder->where('p.id_toko', $id_toko);
        }
        
        $builder->orderBy('p.created_at', 'DESC');
        return $builder->get()->getResultArray();
    }

    // Get product by ID with relations
    public function getProdukById($id)
    {
        $builder = $this->db->table($this->table . ' p');
        $builder->select('p.*, k.nama_kategori, m.nama_menu, pr.nama_promo');
        $builder->join('kategori k', 'k.id_kategori = p.id_kategori', 'left');
        $builder->join('menu m', 'm.id_menu = p.id_menu', 'left');
        $builder->join('promo pr', 'pr.id_promo = p.id_promo', 'left');
        $builder->where('p.id_produk', $id);
        return $builder->get()->getRowArray();
    }


    // Count products by store
    public function countProdukByToko($id_toko)
    {
        return $this->where('id_toko', $id_toko)->countAllResults();
    }

    // Calculate discount price
    public function calculateHargaSetelahDiskon($harga_awal, $harga_diskon, $tipe_diskon)
    {
        if ($tipe_diskon === 'persentase') {
            return $harga_awal - ($harga_awal * $harga_diskon / 100);
        } else {
            return $harga_awal - $harga_diskon;
        }
    }
}

