<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukFotoModel extends Model
{
    protected $table            = 'produk_foto';
    protected $primaryKey       = 'id_foto';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_produk', 'foto_produk', 'urutan'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = null;
    protected $deletedField  = null;
}

