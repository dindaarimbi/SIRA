<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::login');
// ROUTE FORM LOGIN
$routes->get('login', 'Auth::login');
$routes->post('login/action', 'Auth::login_action');
$routes->get('logout', 'Auth::logout');
$routes->get('kriteria', 'Dashboard::index');

//MENAMPILKAN FORM INPUT
$routes->get('/forminput', 'FormInput::index');

$routes->get('/kriteria', 'FormInput::listKriteria');
$routes->get('/forminput/(:num)', 'FormInput::kriteria/$1');
$routes->post('/forminput/simpan', 'FormInput::simpan');

// ROUTE UNTUK MELIHAT VIEW HASIL PENILAIAN
$routes->get('/hasil/(:num)', 'FormInput::hasilPenilaian/$1');

// ROUTE UNTUK MENGHAPUS PENILAIAN
$routes->get('/hasil/hapus/(:num)', 'FormInput::hapus/$1');

// Rute untuk Dashboard Utama
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/logout', 'Dashboard::logout');