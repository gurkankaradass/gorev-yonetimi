<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('tasks/create', 'Home::create');
$routes->get('tasks/complete/(:num)', 'Home::complete/$1');
