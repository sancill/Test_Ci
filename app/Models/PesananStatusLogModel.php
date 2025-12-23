<?php

namespace App\Models;

use CodeIgniter\Model;

class PesananStatusLogModel extends Model
{
    protected $table            = 'pesanan_status_log';
    protected $primaryKey       = 'id_log';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_pesan', 'status_sebelumnya', 'status_baru', 'dibuat_oleh', 'keterangan'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = null;

    // Get status log by order ID
    public function getLogByPesanan($id_pesan)
    {
        $builder = $this->db->table($this->table . ' l');
        $builder->select('l.*, a.nama_lengkap as admin_nama');
        $builder->join('admin a', 'a.id_admin = l.dibuat_oleh', 'left');
        $builder->where('l.id_pesan', $id_pesan);
        $builder->orderBy('l.created_at', 'DESC');
        return $builder->get()->getResultArray();
    }
}

