<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('products', 'Product::index');
$routes->get('products/(:num)', 'Product::getProductId/$1');
$routes->get('products/insert', 'Product::insert');
$routes->post('products/insert', 'Product::insert');
// $routes->resource('products');
