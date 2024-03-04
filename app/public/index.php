<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: *");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require __DIR__ . '/../patternrouter.php';

$uri = trim($_SERVER['REQUEST_URI'], '/');

$router = new PatternRouter();

try {
    $router->route($uri);
} catch (Exception $e) {
    http_response_code(500);
    echo $e;
    die();
}