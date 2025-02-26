<?php

use Bramus\Router\Router;
use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Controllers\UserController;
use App\Middlewares\AdminMiddleware;
use App\Controllers\ProductController;
use App\Controllers\CategoryController;

$router = new Router;


$router->get('/', AuthController::class . '@index');
$router->post('/login', AuthController::class . '@login');
$router->get('/logout',  AuthController::class . '@logout');

$router->before('GET|POST', '/(dashboard|product|category|user)(/.*)?', function () {
    AdminMiddleware::isAdmin();
});
$router->get('/dashboard', HomeController::class . '@index');
$router->mount('/user', function () use ($router) {
    $router->get('/', UserController::class . '@list');
    $router->get('/add', UserController::class . '@add');
    $router->post('/store', UserController::class . '@store');
    $router->get('/update/{id}', UserController::class . '@update');
    $router->post('/post-update/{id}', UserController::class . '@postUpdate');
    $router->get('/delete/{id}', UserController::class . '@delete');
    $router->get('/show/{id}', UserController::class . '@show');
});
$router->mount('/product', function () use ($router) {
    $router->get('/', ProductController::class . '@list');
    $router->get('/add', ProductController::class . '@add');
    $router->post('/store', ProductController::class . '@store');
    $router->get('/update/{id}', ProductController::class . '@update');
    $router->post('/post-update/{id}', ProductController::class . '@postUpdate');
    $router->get('/delete/{id}', ProductController::class . '@delete');
    $router->get('/show/{id}', ProductController::class . '@show');
});
$router->mount('/category', function () use ($router) {
    $router->get('/', CategoryController::class . '@list');
    $router->get('/add', CategoryController::class . '@add');
    $router->post('/store', CategoryController::class . '@store');
    $router->get('/update/{id}', CategoryController::class . '@update');
    $router->post('/post-update/{id}', CategoryController::class . '@postUpdate');
    $router->get('/delete/{id}', CategoryController::class . '@delete');
    $router->get('/show/{id}', CategoryController::class . '@show');
});


$router->run();
