<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukVarianModel extends Model
{
    protected $table            = 'produk_varian';
    protected $primaryKey       = 'id_varian';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_produk', 'nama_varian', 'nilai_varian', 'harga_tambahan', 'stok_varian', 'sku_varian', 'gambar_varian'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Get all variants for a product
    public function getVarianByProduk($id_produk)
    {
        return $this->where('id_produk', $id_produk)->orderBy('created_at', 'ASC')->findAll();
    }

    // Delete all variants for a product
    public function deleteByProduk($id_produk)
    {
        return $this->where('id_produk', $id_produk)->delete();
    }
}

