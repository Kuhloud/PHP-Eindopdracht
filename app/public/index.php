<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: *");

require __DIR__ . '/../switchrouter.php';

$uri = trim($_SERVER['REQUEST_URI'], '/');

$router = new SwitchRouter();

try {
    $router->route($uri);
} catch (Exception $e) {
    http_response_code(500);
    echo $e;
    die();
}