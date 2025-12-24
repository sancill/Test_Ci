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
                        <img src="/assets/img/emblemisb.png" alt="ISBCOMMERCE emblem" />
                    </div>
                    <span class="brand__name">ISBCOMMERCE</span>
                </a>

                <form action="<?= base_url('search') ?>" method="get" class="search-bar" style="display: flex; align-items: center; gap: 8px; flex: 1; max-width: 500px;" onsubmit="return this.querySelector('input[name=q]').value.trim() !== '';">
                    <img src="/assets/img/logosearch.png" alt="Search" style="cursor: pointer;" onclick="this.closest('form').submit();" />
                    <input type="text" name="q" placeholder="Cari produk, jasa, atau toko..."
                        aria-label="Cari produk, jasa, atau toko" 
                        value="<?= esc($_GET['q'] ?? '') ?>"
                        style="flex: 1; border: none; outline: none; background: transparent;"
                        onkeypress="if(event.key === 'Enter') { this.closest('form').submit(); }" />
                </form>

                <div class="header-actions">
                    <button class="icon-button" aria-label="Notifications">
                        <img src="/assets/img/logolove.png" alt="" />
                    </button>
                    <?php 
                    $session = session();
                    $userSession = $session->get('user');
                    $userName = $userSession['nama'] ?? 'User';
                    $userPhoto = !empty($userSession['foto_user']) ? base_url($userSession['foto_user']) : base_url('assets/img/logo.png');
                    ?>
                    <a href="<?php echo base_url('profile'); ?>" class="profile" aria-label="Profil Saya">
                        <img class="profile__photo" src="<?= esc($userPhoto) ?>" alt="<?= esc($userName) ?>" />
                        <span><?= esc($userName) ?></span>
                    </a>
                </div>
            </div>
        </header>