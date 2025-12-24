<?php

namespace App\Models;

use CodeIgniter\Model;

class AlamatUserModel extends Model
{
    protected $table            = 'alamat_user';
    protected $primaryKey       = 'id_alamat';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_user',
        'nama_penerima',
        'no_hp',
        'alamat_lengkap',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'kode_pos',
        'catatan',
    ];

    protected $useTimestamps = false;

    protected $validationRules = [
        'id_user' => 'required|numeric',
        'nama_penerima' => 'permit_empty|max_length[100]',
        'no_hp' => 'permit_empty|max_length[20]',
        'alamat_lengkap' => 'permit_empty',
    ];

    /**
     * Get alamat by user ID
     */
    public function getAlamatByUserId($id_user)
    {
        return $this->where('id_user', $id_user)->findAll();
    }

    /**
     * Get first alamat by user ID (default alamat)
     */
    public function getFirstAlamatByUserId($id_user)
    {
        return $this->where('id_user', $id_user)->first();
    }

    /**
     * Check if user has complete address (alamat_lengkap is not empty)
     */
    public function hasCompleteAddress($id_user)
    {
        try {
            $alamat = $this->where('id_user', $id_user)->findAll();
            if (empty($alamat)) {
                return false;
            }
            // Check if any address has non-empty alamat_lengkap
            foreach ($alamat as $addr) {
                if (!empty($addr['alamat_lengkap']) && trim($addr['alamat_lengkap']) !== '') {
                    return true;
                }
            }
            return false;
        } catch (\Exception $e) {
            log_message('error', 'Error in hasCompleteAddress: ' . $e->getMessage());
            return false;
        }
    }
}

