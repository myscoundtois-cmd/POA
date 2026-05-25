<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->post('auth', 'LoginController::auth');
$routes->post('regist', 'LoginController::regist');
