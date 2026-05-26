<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->post('auth', 'LoginController::auth');
$routes->post('regist', 'LoginController::regist');
// logout
$routes->get('/logout', 'LoginController::logout');
// ADMIN
$routes->get('/admin/dashboard', 'AdminController::index');
// GURU
$routes->get('/guru/dashboard', 'Guru::dashboard');
// MURID
$routes->get('/murid/dashboard', 'Murid::dashboard');
// WALI
$routes->get('/wali/dashboard', 'Wali::dashboard');
