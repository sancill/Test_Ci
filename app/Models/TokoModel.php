<?php

namespace App\Models;

use CodeIgniter\Model;

class TokoModel extends Model
{
    protected $table            = 'toko';
    protected $primaryKey       = 'id_toko';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama_toko',
        'status_toko',
        'logo_toko',
        'banner_toko',
        'deskripsi_toko',
        'alamat_toko',
        'kota',
        'provinsi',
        'kode_pos',
        'negara',
        'email_cs',
        'whatsapp_cs',
        'jam_operasional_buka',
        'jam_operasional_tutup',
        'nama_admin',
        'username_admin',
        'email_admin',
        'telepon_admin',
        'rating',
        'total_ulasan',
        'total_produk',
        'total_pengikut',
        'total_penjualan',
        'pendapatan',
        'email_verified',
        'telepon_verified',
        'identitas_verified',
        'tanggal_bergabung',
        'login_terakhir',
        'status_akun'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [
        'nama_toko' => 'required|min_length[3]|max_length[255]',
        'email_admin' => 'valid_email',
        'email_cs' => 'valid_email',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Get toko data (only one record expected)
     */
    public function getToko()
    {
        return $this->first();
    }

    /**
     * Get toko by ID
     */
    public function getTokoById($id)
    {
        return $this->find($id);
    }

    /**
     * Create or update toko
     */
    public function saveToko($data)
    {
        $existing = $this->first();
        
        if ($existing) {
            // Update existing
            return $this->update($existing['id_toko'], $data);
        } else {
            // Insert new
            return $this->insert($data);
        }
    }

    /**
     * Delete toko
     */
    public function deleteToko($id)
    {
        return $this->delete($id);
    }
}

