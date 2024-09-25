<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/', 'Home::register');

$routes->group("",
    function ($routes) {
        $routes->get("login", "AuthController\LoginAuth::loginForm");
        $routes->post("login", "AuthController\LoginAuth::login");
    });