<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// the code above forces errors to show

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: *");



if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require __DIR__ . '/vendor/autoload.php';

$uri = trim($_SERVER['REQUEST_URI'], '/');

$router = new App\PatternRouter();

try {
    $router->route($uri);
} catch (Exception $e) {
    http_response_code(500);
    echo $e;
    die();
}