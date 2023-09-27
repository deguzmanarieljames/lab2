<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/mspl', 'MusicController::mspl/$1');
$routes->post('/save', 'MusicController::save');
$routes->post('/psave', 'MusicController::psave');
$routes->get('/delete/(:any)', 'ProductController::delete/$1');
$routes->get('/edit/(:any)', 'ProductController::edit/$1');
$routes->get('/pdelete/(:any)', 'ProductController::pdelete/$1');
$routes->get('/pedit/(:any)', 'ProductController::pedit/$1');
