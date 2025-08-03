<?php

require __DIR__ . '/../app/Controllers/AboutController.php';
require __DIR__ . '/../app/Controllers/HomeController.php';
require __DIR__ . '/../app/Controllers/LinkController.php';
require __DIR__ . '/../app/Controllers/PostController.php';
require __DIR__ . '/../app/Controllers/BlogController.php';

$router->get('/', [HomeController::class, 'index']);
$router->get('/about', [AboutController::class, 'index']);
$router->get('/post', [PostController::class, 'show']);
$router->get('/blog', [BlogController::class, 'index']);

$router->get('/links', [LinkController::class, 'index']);
$router->get('/links/create', [LinkController::class, 'create']);
$router->post('/links/store', [LinkController::class, 'store']);
$router->get('/links/edit',[LinkController::class,  'edit']);
$router->put('/links/update',[LinkController::class,  'update']);
$router->delete('/links/delete',[LinkController::class,  'destroy']);