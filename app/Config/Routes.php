<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('auth', function($routes) {
    $routes->get('/', 'Auth::index');
    $routes->post('login', 'Auth::login');
});
