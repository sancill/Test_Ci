<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setDefaultNamespace('App\\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

// Default home route
$routes->get('/', 'Home::index');

// User routes
$routes->get('Home/index', 'Home::index');
$routes->get('produk', 'Home::produk');
$routes->get('produk/(:num)', 'Home::produk_detail/$1');
$routes->get('chat_penjual', 'Home::chatPenjual');
$routes->get('cart', 'Cart::index');
$routes->post('cart/add', 'Cart::add');
$routes->post('cart/update', 'Cart::update_quantity');
$routes->post('cart/remove', 'Cart::remove');
$routes->get('pesan', 'Pesan::index');
$routes->post('pesan/checkout', 'Pesan::checkout');
$routes->post('pesan/validate_voucher', 'Pesan::validate_voucher');
$routes->get('pesan/sukses/(:num)', 'Pesan::sukses/$1');
$routes->get('test', 'Home::test');
$routes->get('profile', 'Home::profile');
$routes->get('kategori', 'Home::kategori');
$routes->get('logout', 'Home::logout');

// Admin routes
$routes->get('admin/dashboard', 'Admin::dashboard');
$routes->get('dashboard', 'Admin::dashboard');
$routes->get('admin/produk', 'Admin::produk');
$routes->get('admin/kategori', 'Admin::kategori');
$routes->post('admin/simpan_kategori', 'Admin::simpan_kategori');
$routes->post('admin/update_kategori/(:num)', 'Admin::update_kategori/$1');
$routes->get('admin/hapus_kategori/(:num)', 'Admin::hapus_kategori/$1');
$routes->get('admin/menu', 'Admin::menu');
$routes->post('admin/simpan_menu', 'Admin::simpan_menu');
$routes->post('admin/update_menu/(:num)', 'Admin::update_menu/$1');
$routes->get('admin/hapus_menu/(:num)', 'Admin::hapus_menu/$1');
$routes->get('admin/orders', 'Admin::orders');
$routes->post('admin/orders/update_status/(:num)', 'Admin::update_status_pesanan/$1');
$routes->get('admin/orders/invoice/(:num)', 'Admin::invoice_pesanan/$1');
$routes->get('admin/orders/riwayat/(:num)', 'Admin::riwayat_status/$1');
$routes->get('admin/promo', 'Admin::promo');
$routes->post('admin/simpan_promo', 'Admin::simpan_promo');
$routes->post('admin/update_promo/(:num)', 'Admin::update_promo/$1');
$routes->get('admin/hapus_promo/(:num)', 'Admin::hapus_promo/$1');
$routes->get('admin/toggle_promo/(:num)', 'Admin::toggle_status_promo/$1');
$routes->get('admin/profile_toko', 'Admin::profile_toko');
$routes->get('admin/setting_toko', 'Admin::setting_toko');
$routes->post('admin/update_toko', 'Admin::update_toko');
$routes->get('admin/delete_toko/(:num)', 'Admin::delete_toko/$1');
$routes->post('admin/simpan_produk', 'Admin::simpan_produk');
$routes->post('admin/update_produk/(:num)', 'Admin::update_produk/$1');
$routes->get('admin/hapus_produk/(:num)', 'Admin::hapus_produk/$1');
$routes->get('admin/preview_produk/(:num)', 'Admin::preview_produk/$1');
$routes->get('admin/get_menu_by_kategori', 'Admin::get_menu_by_kategori');
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}