<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ISBCOMMERCE Landing Page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="/assets/css/style1.css" />

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="./styles.css" />
</head>

<body>
    <div class="page">
        <header class="site-header">
            <div class="container">
                <a href="<?php echo base_url(''); ?>" class="brand" style="text-decoration: none; color: inherit;">
                    <div class="brand__icon">
                        <img src="<?php echo base_url('assets/img/emblemisb.png'); ?>" alt="ISBCOMMERCE emblem" />
                    </div>
                    <span class="brand__name">ISBCOMMERCE</span>
                </a>

                <div class="search-bar">
                    <img src="<?php echo base_url('assets/img/logosearch.png'); ?>" alt="Search" />
                    <input type="text" placeholder="Cari produk, jasa, atau toko..."
                        aria-label="Cari produk, jasa, atau toko" />
                </div>

                <div class="header-actions">
                    <a href="<?php echo base_url('cart'); ?>" class="icon-button" aria-label="Keranjang" style="position: relative; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; border: none; background: transparent; cursor: pointer; padding: 0;">
                        <img src="<?php echo base_url('assets/img/keranjang.png'); ?>" alt="Keranjang" style="width: 24px; height: 24px; display: block; object-fit: contain;" />
                        <span id="cart-badge" style="position: absolute; top: -5px; right: -5px; background: #ef4444; color: white; border-radius: 50%; width: 18px; height: 18px; display: none; align-items: center; justify-content: center; font-size: 10px; font-weight: bold;">0</span>
                    </a>
                    <button class="icon-button" aria-label="Notifications">
                        <img src="<?php echo base_url('assets/img/logolove.png'); ?>" alt="" />
                    </button>
                    <a href="<?php echo base_url('profile'); ?>" class="profile" aria-label="Profil Saya">
                        <img class="profile__photo" src="<?php echo base_url('assets/img/logo.png'); ?>" alt="King Hafiz" />
                        <span>King Hafiz</span>
                    </a>
                </div>
            </div>
        </header>