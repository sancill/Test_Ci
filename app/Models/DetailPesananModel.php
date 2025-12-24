<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailPesananModel extends Model
{
    protected $table            = 'detail_pesanan';
    protected $primaryKey       = 'id_detail';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_pesan', 'id_produk', 'jumlah', 'harga', 'subtotal'
    ];

    protected $useTimestamps = false; // Disable timestamps, let database handle created_at with DEFAULT CURRENT_TIMESTAMP

    // Get order details by order ID
    public function getDetailByPesanan($id_pesan)
    {
        try {
            $builder = $this->db->table($this->table . ' d');
            $builder->select('d.*, p.nama_produk, p.gambar_produk, p.sku');
            $builder->join('produk p', 'p.id_produk = d.id_produk', 'left');
            $builder->where('d.id_pesan', $id_pesan);
            $result = $builder->get()->getResultArray();
            return $result ? $result : [];
        } catch (\Exception $e) {
            log_message('error', 'Error in getDetailByPesanan: ' . $e->getMessage());
            return [];
        }
    }
}

