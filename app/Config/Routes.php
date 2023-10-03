<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/mspl', 'MusicController::index');


$routes->post('/upload', 'MusicController::upload');
$routes->post('/create', 'MusicController::create');
$routes->get('/playlist/(:any)', 'MusicController::playlist/$1');
$routes->get('/search', 'MusicController::search');
$routes->post('/add', 'MusicController::add');


/*
$routes->get('/delete/(:any)', 'ProductController::delete/$1');
$routes->get('/edit/(:any)', 'ProductController::edit/$1');
$routes->get('/pdelete/(:any)', 'ProductController::pdelete/$1');
$routes->get('/pedit/(:any)', 'ProductController::pedit/$1');

*/


