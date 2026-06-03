<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
//LOGIN
$routes->post('/auth', 'LoginController::auth');
$routes->post('/regist', 'LoginController::regist');
//LOGOUT
$routes->get('/logout', 'LoginController::logout');
// ADMIN
$routes->get('/admin/dashboard', 'AdminController::index');
// GURU
$routes->get('/guru/dashboard', 'GuruController::index');
// MURID
$routes->get('/murid/dashboard', 'MuridController::index');
// WALI
$routes->get('/wali/dashboard', 'WaliController::index');

//CRUD
$routes->post('/edit', 'ProfileController::edit');
$routes->post('/editpas', 'ProfileController::editpas');

//MAPEL
$routes->post('/mapel', 'MapelController::create');
$routes->post('/materi', 'MapelController::c_materi');
$routes->get(
    'materi/(:segment)/(:segment)',
    'AdminController::lihatMateri/$1/$2'
);
$routes->post('soaluji/simpan', 'MapelController::simpanSoal');
