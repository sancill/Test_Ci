<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'user';
    protected $primaryKey       = 'id_user';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama_user',
        'username',
        'email',
        'password',
        'no_telepon',
        'foto_user',
        'google_id',
    ];

    protected $useTimestamps = false;

    protected $validationRules = [
        'nama_user' => 'permit_empty|min_length[3]|max_length[100]',
        'username'  => 'permit_empty|min_length[3]|max_length[50]',
        'email'     => 'required|valid_email',
        'password'  => 'permit_empty|min_length[5]',
    ];

    protected $validationMessages = [
        'email' => [
            'is_unique' => 'Maaf. Email ini sudah terdaftar.'
        ]
    ];

    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password']) && !empty($data['data']['password'])) {
            // Only hash if password is not already hashed
            if (password_get_info($data['data']['password'])['algo'] === null) {
                $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
            }
        }
        return $data;
    }

    public function findByEmail(string $email): ?array
    {
        return $this->where('email', $email)->first();
    }

    public function findByGoogleId(string $googleId): ?array
    {
        return $this->where('google_id', $googleId)->first();
    }

    public function verifyPassword(string $password, array $user)
    {
        if (empty($user['password'])) {
            return false;
        }
        // Check if password is already hashed
        if (password_get_info($user['password'])['algo'] !== null) {
            return password_verify($password, $user['password']);
        }
        // For backward compatibility, check plain text
        return $password === $user['password'];
    }
}

