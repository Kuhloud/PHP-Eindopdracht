<?php
header("Access-Control-Allow-Origin: http://localhost/user, http://localhost/board, http://localhost/thread, http://localhost/");
header("Access-Control-Allow-Headers: http://localhost/user, http://localhost/board,  http://localhost/thread, http://localhost/");

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