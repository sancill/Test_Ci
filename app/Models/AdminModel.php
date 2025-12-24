<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table            = 'admin';
    protected $primaryKey       = 'id_admin';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama_lengkap',
        'username',
        'password',
        'email',
        'foto_profil',
    ];

    protected $useTimestamps = false;

    protected $validationRules = [
        'nama_lengkap' => 'required|min_length[3]|max_length[100]',
        'username'     => 'required|min_length[3]|max_length[50]|is_unique[admin.username,id_admin,{id_admin}]',
        'email'        => 'required|valid_email|is_unique[admin.email,id_admin,{id_admin}]',
        'password'     => 'required|min_length[5]',
    ];

    protected $validationMessages = [
        'email' => [
            'is_unique' => 'Maaf. Email ini sudah terdaftar.'
        ],
        'username' => [
            'is_unique' => 'Maaf. Username ini sudah terdaftar.'
        ]
    ];

    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password']) && !empty($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }

    public function findByEmail(string $email)
    {
        return $this->where('email', $email)->first();
    }

    public function findByUsername(string $username)
    {
        return $this->where('username', $username)->first();
    }

    public function verifyPassword(string $password, array $admin)
    {
        if (empty($admin['password'])) {
            return false;
        }
        // Check if password is already hashed
        if (password_get_info($admin['password'])['algo'] !== null) {
            return password_verify($password, $admin['password']);
        }
        // For backward compatibility, check plain text
        return $password === $admin['password'];
    }
}

