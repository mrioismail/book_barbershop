<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Landing page (customer)
$routes->get('/', 'Booking::index');

// formulir booking (customer)
$routes->get('customer/booking/form_booking', 'Booking::booking');
$routes->post('booking/simpanBooking', 'Booking::simpanBooking');
$routes->get('customer/booking/detail/(:num)', 'Booking::detail/$1');

// login Admin
$routes->get('/login', 'Auth::index');
$routes->post('/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');

// admin dashboard
$routes->get('admin/home', 'Admin\Home::index', ['filter' => 'adminFilter']);

// Pengguna
$routes->group('', ['filter' => 'adminFilter'], function ($routes) {
    $routes->get('admin/pengguna', 'Admin\Pengguna::index');
    $routes->get('admin/pengguna/edit/(:num)', 'Admin\Pengguna::edit/$1');
    $routes->post('admin/pengguna/update/(:num)', 'Admin\Pengguna::update/$1');
    $routes->get('admin/ganti_password/(:num)', 'Admin\Pengguna::gantiPassword/$1');
    $routes->post('admin/update_password/(:num)', 'Admin\Pengguna::updatePassword/$1');
    $routes->get('admin/reset_password/(:num)', 'Admin\Pengguna::resetPassword/$1');
});

// CRUD for layanan
$routes->group('', ['filter' => 'adminFilter'], function ($routes) {
    $routes->get('admin/layanan', 'Admin\Layanan::index');
    $routes->get('admin/layanan/detail/(:num)', 'Admin\Layanan::detail/$1');
    $routes->get('admin/layanan/create', 'Admin\Layanan::create');
    $routes->post('admin/layanan/store', 'Admin\Layanan::store');
    $routes->get('admin/layanan/edit/(:num)', 'Admin\Layanan::edit/$1');
    $routes->post('admin/layanan/update/(:num)', 'Admin\Layanan::update/$1');
    $routes->get('admin/layanan/delete/(:num)', 'Admin\Layanan::delete/$1');
});

// CRUD for capster
$routes->group('', ['filter' => 'adminFilter'], function ($routes) {
    $routes->get('admin/capster', 'Admin\Capster::index');
    $routes->get('admin/capster/detail/(:num)', 'Admin\Capster::detail/$1');
    $routes->get('admin/capster/create', 'Admin\Capster::create');
    $routes->post('admin/capster/store', 'Admin\Capster::store');
    $routes->get('admin/capster/edit/(:num)', 'Admin\Capster::edit/$1');
    $routes->post('admin/capster/update/(:num)', 'Admin\Capster::update/$1');
    $routes->get('admin/capster/delete/(:num)', 'Admin\Capster::delete/$1');
});

$routes->group('', ['filter' => 'adminFilter'], function ($routes) {
    // CRUD for jadwal
    $routes->get('admin/jadwal', 'Admin\Jadwal::index');
    $routes->get('admin/jadwal/detail/(:num)', 'Admin\Jadwal::detail/$1');
    $routes->get('admin/jadwal/create', 'Admin\Jadwal::create');
    $routes->post('admin/jadwal/store', 'Admin\Jadwal::store');
    $routes->get('admin/jadwal/edit/(:num)', 'Admin\Jadwal::edit/$1');
    $routes->post('admin/jadwal/update/(:num)', 'Admin\Jadwal::update/$1');
    $routes->get('admin/jadwal/delete/(:num)', 'Admin\Jadwal::delete/$1');
});

// laporan Booking
$routes->group('', ['filter' => 'adminFilter'], function ($routes) {
    $routes->get('admin/booking', 'Admin\Booking::index');
    $routes->get('admin/booking/detail/(:num)', 'Admin\Booking::detail/$1');
    $routes->get('admin/booking/edit/(:num)', 'Admin\Booking::edit/$1');
    $routes->post('admin/booking/update/(:num)', 'Admin\Booking::update/$1');
    $routes->get('admin/booking/delete/(:num)', 'Admin\Booking::delete/$1');
    $routes->get('admin/booking/laporan', 'Admin\Booking::laporan');
    $routes->get('admin/notifikasi', 'Admin\Notifikasi::index');
});
