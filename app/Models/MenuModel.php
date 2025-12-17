<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table            = 'menu';
    protected $primaryKey       = 'id_menu';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_kategori', 'nama_menu', 'deskripsi_menu', 'status'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'nama_menu' => 'required|min_length[2]|max_length[100]',
        'id_kategori' => 'required|numeric',
    ];

    // Get active menus
    public function getMenuAktif($id_kategori = null)
    {
        $builder = $this->where('status', 'aktif');
        if ($id_kategori !== null) {
            $builder->where('id_kategori', $id_kategori);
        }
        return $builder->orderBy('nama_menu', 'ASC')->findAll();
    }

    // Get all menus
    public function getAllMenu($id_kategori = null)
    {
        $builder = $this->db->table($this->table . ' m');
        $builder->select('m.*, k.nama_kategori');
        $builder->join('kategori k', 'k.id_kategori = m.id_kategori', 'left');
        
        if ($id_kategori !== null) {
            $builder->where('m.id_kategori', $id_kategori);
        }
        
        $builder->orderBy('k.nama_kategori', 'ASC');
        $builder->orderBy('m.nama_menu', 'ASC');
        return $builder->get()->getResultArray();
    }
}

