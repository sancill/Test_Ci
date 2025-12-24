<?php

namespace App\Models;

use CodeIgniter\Model;

class PesananModel extends Model
{
    protected $table            = 'pesanan';
    protected $primaryKey       = 'id_pesan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_user', 'id_alamat', 'no_pesanan', 'tanggal_pesan', 'tanggal_kirim', 'tanggal_selesai',
        'metode_pengiriman', 'no_resi', 'ongkir', 'total_harga', 'total_bayar',
        'id_voucher', 'status_pesanan', 'catatan_admin'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'id_user' => 'required|numeric',
        'status_pesanan' => 'permit_empty|in_list[Diproses,Dikirim,Selesai,Dibatalkan]',
    ];

    // Get all orders with relations
    public function getAllPesanan($filters = [])
    {
        try {
            $builder = $this->db->table($this->table . ' p');
            
            // Build select dengan kolom yang aman
            $select = 'p.*, u.nama_user as nama_pelanggan, u.email as email_pelanggan, 
                       u.no_telepon as telepon_pelanggan, a.alamat_lengkap, a.nama_penerima';
            
            // Cek kolom alamat yang tersedia
            try {
                $alamatColumns = $this->db->getFieldNames('alamat_user');
                if (in_array('kecamatan', $alamatColumns)) {
                    $select .= ', a.kecamatan, a.kabupaten, a.provinsi, a.kode_pos, a.catatan';
                }
            } catch (\Exception $e) {
                // Skip jika tabel tidak ada
            }
            
            $builder->select($select);
            $builder->join('user u', 'u.id_user = p.id_user', 'left');
            $builder->join('alamat_user a', 'a.id_alamat = p.id_alamat', 'left');

            // Apply filters
            if (!empty($filters['search'])) {
                $search = $filters['search'];
                $builder->groupStart();
                // Check if no_pesanan column exists
                $columns = $this->db->getFieldNames($this->table);
                if (in_array('no_pesanan', $columns)) {
                    $builder->like('p.no_pesanan', $search);
                }
                $builder->orLike('u.nama_user', $search);
                $builder->orLike('u.email', $search);
                $builder->orLike('CAST(p.id_pesan AS CHAR)', $search);
                $builder->groupEnd();
            }

            if (!empty($filters['status']) && $filters['status'] !== 'all') {
                $builder->where('p.status_pesanan', $filters['status']);
            }

            if (!empty($filters['tanggal_dari'])) {
                $builder->where('DATE(p.tanggal_pesan) >=', $filters['tanggal_dari']);
            }

            if (!empty($filters['tanggal_sampai'])) {
                $builder->where('DATE(p.tanggal_pesan) <=', $filters['tanggal_sampai']);
            }

            $builder->orderBy('p.tanggal_pesan', 'DESC');
            $result = $builder->get()->getResultArray();
            return $result ? $result : [];
        } catch (\Exception $e) {
            log_message('error', 'Error in getAllPesanan: ' . $e->getMessage());
            log_message('error', 'Stack trace: ' . $e->getTraceAsString());
            return [];
        }
    }

    // Get order by ID with full details
    public function getPesananById($id)
    {
        try {
            $builder = $this->db->table($this->table . ' p');
            $builder->select('p.*, u.nama_user as nama_pelanggan, u.email as email_pelanggan, 
                             u.no_telepon as telepon_pelanggan, a.*');
            $builder->join('user u', 'u.id_user = p.id_user', 'left');
            $builder->join('alamat_user a', 'a.id_alamat = p.id_alamat', 'left');
            $builder->where('p.id_pesan', $id);
            return $builder->get()->getRowArray();
        } catch (\Exception $e) {
            log_message('error', 'Error in getPesananById: ' . $e->getMessage());
            return null;
        }
    }

    // Get orders by user ID
    public function getPesananByUserId($userId, $limit = null)
    {
        try {
            $builder = $this->db->table($this->table . ' p');
            $builder->select('p.*, u.nama_user as nama_pelanggan, u.email as email_pelanggan, 
                             u.no_telepon as telepon_pelanggan, a.alamat_lengkap, a.nama_penerima');
            $builder->join('user u', 'u.id_user = p.id_user', 'left');
            $builder->join('alamat_user a', 'a.id_alamat = p.id_alamat', 'left');
            $builder->where('p.id_user', $userId);
            $builder->orderBy('p.tanggal_pesan', 'DESC');
            if ($limit) {
                $builder->limit($limit);
            }
            return $builder->get()->getResultArray();
        } catch (\Exception $e) {
            log_message('error', 'Error in getPesananByUserId: ' . $e->getMessage());
            return [];
        }
    }

    // Generate nomor pesanan
    public function generateNoPesanan()
    {
        // Format: ORD-YYYYMMDD-XXX
        $date = date('Ymd');
        $prefix = 'ORD-' . $date . '-';
        
        // Get last order number today
        $builder = $this->db->table($this->table);
        $builder->like('no_pesanan', $prefix);
        $builder->orderBy('id_pesan', 'DESC');
        $lastOrder = $builder->get()->getRowArray();
        
        if ($lastOrder && !empty($lastOrder['no_pesanan'])) {
            $lastNumber = (int) substr($lastOrder['no_pesanan'], -3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        
        return $prefix . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    // Get order statistics
    public function getOrderStats()
    {
        try {
            $stats = [];
            $statuses = ['Diproses', 'Dikirim', 'Selesai', 'Dibatalkan'];
            
            foreach ($statuses as $status) {
                $stats[$status] = $this->where('status_pesanan', $status)->countAllResults();
            }
            
            $stats['total'] = $this->countAllResults();
            
            return $stats;
        } catch (\Exception $e) {
            log_message('error', 'Error in getOrderStats: ' . $e->getMessage());
            return [
                'Diproses' => 0,
                'Dikirim' => 0,
                'Selesai' => 0,
                'Dibatalkan' => 0,
                'total' => 0
            ];
        }
    }

    // Update order status with logging
    public function updateStatus($id, $statusBaru, $dibuatOleh = null, $keterangan = null)
    {
        try {
            $pesanan = $this->find($id);
            if (!$pesanan) {
                return false;
            }

            $statusSebelumnya = $pesanan['status_pesanan'] ?? 'Diproses';
            
            // Update status
            $updateData = ['status_pesanan' => $statusBaru];
            
            // Update tanggal sesuai status (jika kolom ada)
            try {
                if ($statusBaru === 'Dikirim' && (empty($pesanan['tanggal_kirim']) || !isset($pesanan['tanggal_kirim']))) {
                    $updateData['tanggal_kirim'] = date('Y-m-d H:i:s');
                } elseif ($statusBaru === 'Selesai' && (empty($pesanan['tanggal_selesai']) || !isset($pesanan['tanggal_selesai']))) {
                    $updateData['tanggal_selesai'] = date('Y-m-d H:i:s');
                }
            } catch (\Exception $e) {
                // Kolom mungkin belum ada, skip
                log_message('debug', 'Tanggal column mungkin belum ada: ' . $e->getMessage());
            }
            
            $result = $this->update($id, $updateData);
            
            if ($result) {
                // Log perubahan status (jika tabel ada)
                try {
                    $logModel = new \App\Models\PesananStatusLogModel();
                    $logModel->insert([
                        'id_pesan' => $id,
                        'status_sebelumnya' => $statusSebelumnya,
                        'status_baru' => $statusBaru,
                        'dibuat_oleh' => $dibuatOleh,
                        'keterangan' => $keterangan
                    ]);
                } catch (\Exception $e) {
                    // Tabel log mungkin belum ada, tapi update status tetap berhasil
                    log_message('warning', 'Tabel pesanan_status_log mungkin belum ada: ' . $e->getMessage());
                }
            }
            
            return $result;
        } catch (\Exception $e) {
            log_message('error', 'Error in updateStatus: ' . $e->getMessage());
            return false;
        }
    }
}

