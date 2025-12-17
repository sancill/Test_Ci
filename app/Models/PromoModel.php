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
        'tanggal_mulai', 'tanggal_berakhir', 'target_produk', 'status'
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

    // Get all promos
    public function getAllPromo($id_toko = null)
    {
        $builder = $this->db->table($this->table);
        
        if ($id_toko !== null) {
            $builder->where('id_toko', $id_toko);
        }
        
        $builder->orderBy('created_at', 'DESC');
        return $builder->get()->getResultArray();
    }
}

