<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', function () {
    return redirect()->to('/login');
});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::loginProcess');

$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::registerProcess');

$routes->get('/logout', 'Auth::logout');

/*
|--------------------------------------------------------------------------
| AUTH AREA
|--------------------------------------------------------------------------
*/

$routes->group('', ['filter' => 'auth'], function ($routes) {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    $routes->get('/dashboard', 'Dashboard::index');

    /*
    |--------------------------------------------------------------------------
    | PRODUK
    |--------------------------------------------------------------------------
    */

    $routes->get('/produk', 'Produk::index');

    $routes->post('/produk/store', 'Produk::store');

    $routes->post('/produk/update/(:num)', 'Produk::update/$1');

    $routes->get('/produk/delete/(:num)', 'Produk::delete/$1');

    /*
    |--------------------------------------------------------------------------
    | PENJUALAN
    |--------------------------------------------------------------------------
    */

    $routes->get('/penjualan', 'Penjualan::index');

    $routes->post('/penjualan/store', 'Penjualan::store');

    $routes->post('/penjualan/update/(:num)', 'Penjualan::update/$1');

    $routes->get('/penjualan/delete/(:num)', 'Penjualan::delete/$1');

    /*
    |--------------------------------------------------------------------------
    | LAPORAN
    |--------------------------------------------------------------------------
    */

    $routes->get('/laporan', 'Laporan::index');

    $routes->get('/laporan/export-pdf', 'Laporan::exportPdf');

    $routes->get('/laporan/export-excel', 'Laporan::exportExcel');

    /*
    |--------------------------------------------------------------------------
    | PROFIL
    |--------------------------------------------------------------------------
    */

    $routes->get('/profil', 'Profil::index');

    $routes->post('/profil/update', 'Profil::update');

    $routes->post('/profil/logo', 'Profil::logo');

    /*
    |--------------------------------------------------------------------------
    | DOWNLOAD API
    |--------------------------------------------------------------------------
    */

    $routes->get('/api-download/pdf', 'ApiDownload::pdf');

    $routes->get('/api-download/excel', 'ApiDownload::excel');

});

/*
|--------------------------------------------------------------------------
| SUPER ADMIN
|--------------------------------------------------------------------------
*/

$routes->group('admin', ['filter' => 'super_admin'], function ($routes) {

    $routes->get('usaha', 'Admin::index');

    $routes->get('usaha/delete/(:num)', 'Admin::delete/$1');

});
