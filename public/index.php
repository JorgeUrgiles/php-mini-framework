<?php
require __DIR__ . '/../framework/database.php';
$db = new Database();
$routes = require __DIR__ . '/../routes/web.php';

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); //PHP_URL_QUERY

$route = $routes[$requestUri] ?? null;

if ($route) {
    require __DIR__ . '/../' . $route;
} else {
    exit('404 Not Found');
}