<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        echo view('layout/header');
        echo view('pages_user/Home');
        echo view('layout/footer');
        return '';
    }

    public function produk(): string
    {
        echo view('layout/header');
        echo view('pages_user/produk');
        echo view('layout/footer');
        return '';
    }
    
    public function chatPenjual(): string
    {
        echo view('layout/header');
        echo view('pages_user/chat_penjual');
        echo view('layout/footer');
        return '';
    }   

    public function cart(): string
    {
        echo view('layout/header');
        echo view('pages_user/cart');
        echo view('layout/footer');
        return '';
    }

    public function pesan(): string
    {
        echo view('layout/header');
        echo view('pages_user/pesan');
        echo view('layout/footer');
        return '';
    }

    public function profile(): string
    {
        echo view('layout/header');
        echo view('pages_user/profile');
        echo view('layout/footer');
        return '';
    }

    public function kategori(): string
    {
        echo view('layout/header');
        echo view('pages_user/kategori');
        echo view('layout/footer');
        return '';
    }
}