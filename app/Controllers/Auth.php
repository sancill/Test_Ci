<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\AdminModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Auth extends Controller
{
    protected $session;
    protected $userModel;
    protected $adminModel;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        $this->session    = session();
        $this->userModel  = new UserModel();
        $this->adminModel = new AdminModel();
    }

    private function render(string $view, array $data = [])
    {
        // Halaman auth tidak menggunakan layout header dan footer
        echo view($view, $data);
        return '';
    }

    public function loginUser()
    {
        $googleConfig = config('Google');
        return $this->render('auth/login_user', [
            'error' => null,
            'googleClientId' => $googleConfig->clientId ?? 'YOUR_GOOGLE_CLIENT_ID_HERE',
        ]);
    }

    public function registerUser()
    {
        return $this->render('auth/register_user', ['error' => null]);
    }

    public function loginAdmin()
    {
        return $this->render('auth/login_admin', ['error' => null]);
    }

    public function registerAdmin()
    {
        return $this->render('auth/register_admin', ['error' => null]);
    }

    public function doLogin()
    {
        $email = $this->request->getPost('email');
        $pass  = $this->request->getPost('password');
        $scope = $this->request->getPost('scope') ?? 'user';

        if ($scope === 'admin') {
            // Admin login menggunakan table admin
            $admin = $this->adminModel->findByEmail($email);
            if (!$admin || !$this->adminModel->verifyPassword($pass, $admin)) {
                return $this->render('auth/login_admin', [
                    'error' => 'Email atau password salah',
                ]);
            }
            // Set session untuk admin
            $this->session->set('admin', [
                'id'           => $admin['id_admin'],
                'nama'         => $admin['nama_lengkap'],
                'email'        => $admin['email'],
                'username'     => $admin['username'],
                'foto_profil'  => $admin['foto_profil'],
                'role'         => 'admin',
            ]);
            return redirect()->to(base_url('admin/dashboard'));
        } else {
            // User login menggunakan table user
            $user = $this->userModel->findByEmail($email);
            if (!$user || !$this->userModel->verifyPassword($pass, $user)) {
                return $this->render('auth/login_user', [
                    'error' => 'Email atau password salah',
                ]);
            }
            // Set session untuk user
            $this->session->set('user', [
                'id'        => $user['id_user'],
                'nama'      => $user['nama_user'],
                'email'     => $user['email'],
                'username'  => $user['username'],
                'foto_user' => $user['foto_user'],
                'role'      => 'user',
            ]);
            return redirect()->to(base_url(''));
        }
    }

    public function doRegister()
    {
        $email = $this->request->getPost('email');
        $pass  = $this->request->getPost('password');
        $name  = $this->request->getPost('nama');
        $role  = $this->request->getPost('role') ?: 'admin';
        $scope = $this->request->getPost('scope') ?? 'user';
        $username = $this->request->getPost('username') ?? strtolower(str_replace(' ', '', $name));

        if ($scope === 'admin') {
            // Admin registration menggunakan table admin
            if ($this->adminModel->findByEmail($email)) {
                return $this->render('auth/register_admin', [
                    'error' => 'Email sudah terdaftar',
                ]);
            }
            if ($this->adminModel->findByUsername($username)) {
                return $this->render('auth/register_admin', [
                    'error' => 'Username sudah terdaftar',
                ]);
            }
            $this->adminModel->insert([
                'nama_lengkap' => $name,
                'username'     => $username,
                'email'        => $email,
                'password'     => $pass,
            ]);
            return redirect()->to(base_url('admin/login'));
        } else {
            // User registration menggunakan table user
            if ($this->userModel->findByEmail($email)) {
                return $this->render('auth/register_user', [
                    'error' => 'Email sudah terdaftar',
                ]);
            }
            $this->userModel->insert([
                'nama_user' => $name,
                'username'  => $username,
                'email'     => $email,
                'password'  => $pass,
                'google_id' => 0,
            ]);
            return redirect()->to(base_url('login'));
        }
    }

    public function logout()
    {
        $user = $this->session->get('user');
        $admin = $this->session->get('admin');
        
        $this->session->destroy();
        
        // Redirect berdasarkan role
        if ($admin) {
            return redirect()->to(base_url('admin/login'));
        }
        return redirect()->to(base_url('login'));
    }

    /**
     * Handle Google OAuth callback for user login
     */
    public function googleCallback()
    {
        $token = $this->request->getPost('credential');
        
        if (empty($token)) {
            return $this->render('auth/login_user', [
                'error' => 'Google login gagal. Silakan coba lagi.',
            ]);
        }

        // Decode JWT token from Google
        $parts = explode('.', $token);
        if (count($parts) !== 3) {
            return $this->render('auth/login_user', [
                'error' => 'Token tidak valid.',
            ]);
        }

        // Decode payload (second part)
        $payload = json_decode(base64_decode(str_replace(['-', '_'], ['+', '/'], $parts[1])), true);
        
        if (!$payload || empty($payload['email'])) {
            return $this->render('auth/login_user', [
                'error' => 'Data Google tidak valid.',
            ]);
        }

        $googleId = $payload['sub'] ?? '';
        $email = $payload['email'];
        $name = $payload['name'] ?? '';
        $picture = $payload['picture'] ?? '';

        // Check if user exists by Google ID
        $user = $this->userModel->findByGoogleId($googleId);
        
        if (!$user) {
            // Check if user exists by email
            $user = $this->userModel->findByEmail($email);
            
            if ($user) {
                // Update existing user with Google ID and picture
                $this->userModel->update($user['id_user'], [
                    'google_id' => $googleId,
                    'foto_user' => $picture,
                ]);
                $user['google_id'] = $googleId;
                $user['foto_user'] = $picture;
            } else {
                // Create new user
                $username = strtolower(str_replace(' ', '', $name));
                // Make username unique if needed
                $existingUser = $this->userModel->where('username', $username)->first();
                if ($existingUser) {
                    $username .= '_' . time();
                }
                
                $userId = $this->userModel->insert([
                    'nama_user' => $name,
                    'username'  => $username,
                    'email'     => $email,
                    'password'  => null, // No password for Google users
                    'google_id' => $googleId,
                    'foto_user' => $picture,
                ]);
                
                $user = $this->userModel->findByEmail($email);
            }
        } else {
            // Update photo if changed
            if ($picture && $user['foto_user'] !== $picture) {
                $this->userModel->update($user['id_user'], [
                    'foto_user' => $picture,
                ]);
                $user['foto_user'] = $picture;
            }
        }

        // Set session
        $this->session->set('user', [
            'id'        => $user['id_user'],
            'nama'      => $user['nama_user'],
            'email'     => $user['email'],
            'username'  => $user['username'],
            'foto_user' => $user['foto_user'],
            'role'      => 'user',
        ]);

        return redirect()->to(base_url(''));
    }

    public function terms()
    {
        return $this->render('auth/terms');
    }

    public function privacy()
    {
        return $this->render('auth/privacy');
    }
}

