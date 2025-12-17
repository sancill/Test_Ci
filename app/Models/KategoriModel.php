<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table            = 'kategori';
    protected $primaryKey       = 'id_kategori';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama_kategori', 'deskripsi_kategori', 'icon_kategori', 'status'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'nama_kategori' => 'required|min_length[2]|max_length[100]',
    ];

    // Get active categories
    public function getKategoriAktif()
    {
        return $this->where('status', 'aktif')->orderBy('nama_kategori', 'ASC')->findAll();
    }

    // Get all categories
    public function getAllKategori()
    {
        return $this->orderBy('nama_kategori', 'ASC')->findAll();
    }
}

