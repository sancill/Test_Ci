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
$routes->get('chat_penjual', 'Home::chatPenjual');
$routes->get('cart', 'Home::cart');
$routes->get('pesan', 'Home::pesan');
$routes->get('test', 'Home::test');
$routes->get('profile', 'Home::profile');
$routes->get('kategori', 'Home::kategori');

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
$routes->get('admin/promo', 'Admin::promo');
$routes->get('admin/customers', 'Admin::customers');
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